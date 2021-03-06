<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerContact;
use App\Models\QuoteItem;
use App\Models\Quoterevisionlog;
use App\Models\Quotes;
use App\Models\User;
use App\Notifications\CustomNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

use Yajra\DataTables\DataTables;
class QuotesController extends Controller
{
    public function index(){
        $this->authorize('quote-index');
        $customers=Customer::orderBY('reg_name')->get();
        $tms=User::where('department',3)->get();
        return view('quotes.index',compact('customers','tms'));
    }
    public function get_principal($id){
        $customer=Customer::where('id',$id)->with('contacts',function ($query){
            $query->where('type','principal')->orwhere('type','purchase');
        })->first();
        $contact=$customer['contacts'];
        return response()->json($contact);
    }
    public function fetch(Request $request){
        $this->authorize('quote-index');
        if ($request->search=='not-sent-to-customer'){
            $data=Quotes::with('customers')->where('status',1)->get();
        }
        if ($request->search=='approval-waiting'){
            $data=Quotes::with('customers')->where('status',2)->get();
        }
        if ($request->search=='approved'){
            $data=Quotes::with('customers')->where('status',3)->get();
        }
        if ($request->search=='all'){
            $data=Quotes::with('customers')->where('status','>',0)->get();
        }

        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->cid;
            })
            ->addColumn('customer', function ($data) {
                return $data->customers->reg_name;
            })
            ->addColumn('principal', function ($data) {
                $principals=null;
                $principals.=$data->principals->name;
                if ($data->principals->email){
                    $principals.='<br>'.$data->principals->email;
                }
                if ($data->principals->phone){
                    $principals.='<br>'.$data->principals->phone;
                }
                return $principals;
            })

            ->addColumn('location', function ($data) {
                return ucfirst($data->location);
            })
            ->addColumn('type', function ($data) {
                return $data->type;
            })
                ->addColumn('status', function ($data) {

                if ($data->status==1){
                    $status= '<b class="badge badge-info p-1 px-2 mt-2">To be Sent</b>';
                }
                if ($data->status==2){
                    $status= '<b class="badge badge-primary p-1 px-2 mt-2">Waiting Customer Approval</b>';
                }
                if ($data->status==3){
                    $status= '<b class="badge badge-success p-1 px-2 mt-2">Approved</b>';
                }
                return $status;
            })
            ->addColumn('turnaround', function ($data) {
                return $data->turnaround;
            })
            ->addColumn('total', function ($data) {
                $total=QuoteItem::where('quote_id',$data->id)->count();
                return $total;
            })
            ->addColumn('options', function ($data) {
                $token=csrf_token();
                $action=null;
                $action.="<a title='view' href=".url('/quotes/view/'.$data->id)." class='btn btn-sm btn-dark'><i class='fa fa-eye'></i></a>";

                $action.="<a onclick=\"window.open('".url('/quotes/print/'.$data->id)."','newwindow','width=1100,height=1000');return false;\"
                href=".url('/quotes/print/'.$data->id)." 
                class='btn btn-sm btn-danger'><b>QF</b></a>";

                if ($data->status==1){
                    $action.="<a title='Send to Customer' class='btn btn-outline-success btn-sm sendtocustomer' href
                   data-id='".$data->id."'><i class='fa fa-paper-plane'></i></a>";
                }

                $items=QuoteItem::where('quote_id',$data->id)->get();
                $show=false;
                foreach ($items as $item){
                    if ($item->status>0){
                        $show=true;
                    }
                }
                if ($show==true){
                    $action.="<a onclick=\"window.open('".url('/print_rf/'.$data->id)."','newwindow','width=1100,height=1000');return false;\"
                href=".url('print_rf/'.$data->id)." 
                title='Print' class='btn btn-sm btn-info'><b>RF</b></a>";
                }

                $action.="<a class='btn btn-danger btn-sm delete' href='#' data-id='{$data->id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$data->id\" action=\"{{action('QuotesController@destroy', $data->id)}}\" method=\"post\" role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";

                return "&emsp;".$action;
            })
            ->rawColumns(['options','status','principal'])
            ->make(true);
    }
    public function store(Request $request){
        //dd($request->all());
        $this->authorize('quote-create');
        $this->validate(request(), [
            'customer' => 'required',
            'principal' => 'required',
            'rfq_mode' => 'required',
            'rfq_mode_details' => 'required',

        ],[
            'customer.required' => 'Customer field is required *',
            'principal.required' => 'Customer field is required *',
            'rfq_mode.required' => 'Customer field is required *',
            'rfq_mode_details.required' => 'Customer field is required *',

        ]);
        $checks=Quotes::where('customer_id',$request->customer)->get();
        foreach ($checks as $check) {
            if ($check->status===0){
                return response()->json(['errors'=>'Already in progress']);
            }
            else if ($check->status===1){
                return response()->json(['errors'=>'Already in progress']);
            }
        }
        $session=new Quotes();
        $session->customer_id=$request->customer;
        $session->principal=$request->principal;
        $session->tm=$request->tm;
        $session->rfq_mode=$request->rfq_mode;
        $session->rfq_mode_details=$request->rfq_mode_details;
        $session->cid='QTN/';
        $session->save();
        $session->cid='QTN/'.str_pad($session->id, 6, '0', STR_PAD_LEFT);
        $session->save();
        return response()->json(['success'=>'Added successfully']);
    }
    public function update(Request $request){
        $this->authorize('quote-edit');
        $this->validate(request(), [            'customer' => 'required',
            'principal' => 'required',
            'rfq_mode' => 'required',
            'rfq_mode_details' => 'required',

        ],[
            'customer.required' => 'Customer field is required *',
            'principal.required' => 'Customer field is required *',
            'rfq_mode.required' => 'Customer field is required *',
            'rfq_mode_details.required' => 'Customer field is required *',
        ]);
        $session=Quotes::find($request->id);
        $session->customer_id=$request->customer;
        $session->principal=$request->principal;
        $session->tm=$request->tm;
        $session->rfq_mode=$request->rfq_mode;
        $session->rfq_mode_details=$request->rfq_mode_details;
        $session->save();
        return response()->json(['success'=>'Updated successfully']);
    }

    public function edit(Request $request){
        $this->authorize('quote-edit');
        $edit=Quotes::find($request->id);
        return response()->json($edit);
    }
    public function show($id){
        $this->authorize('quote-view');
        $show=Quotes::find($id);
        $tms=User::where('department',3)->get();
        $items=QuoteItem::where('quote_id',$id)->get();
        $noaction=false;
        foreach ($items as $item){
            if ($item->status==1){
                $noaction=true;
            }
        }

        return view('quotes.show',compact('show','id','tms','items','noaction'));
    }

    public function sendmail($id){
        $this->authorize('quote-send-to-customer');
        if (QuoteItem::where('quote_id',$id)->where('not_available','!=',null)->count()>0){
            return redirect('/sessions')->with('failed','Because of non-listed pending items, Email cant send');
        }
        if (QuoteItem::where('quote_id',$id)->count()==0){
            return redirect('/sessions')->with('failed','Session is empty, Fill session and then send email');

        }
        $session=Quotes::find($id);
        return view('quotes.mail',compact('session'));
    }

    /*public function sendtocustomer($id,Request $request){

        $this->authorize('quote-send-to-customer');
        $this->validate(request(),[
           'message'=>'required',
           'attachment'=>'required',
        ]);
        $attachment=time()."-".$request->attachment->getClientOriginalName();
        $request->attachment->move(public_path().'/img/quotes/',$attachment);

        //Storage::disk('local')->put('/public/quotes/'.$attachment, File::get($request->attachment));

        if (Item::where('quote_id',$id)->where('not_available','!=',null)->count()>0){
            return redirect('/sessions')->with('failed','Because of non-listed pending items, Email cant send');
        }
        if (Item::where('quote_id',$id)->count()==0){
            return redirect('/sessions')->with('failed','Session is empty, Fill session and then send email');

        }
        $approval=Quotes::find($id);
        $approval->status=2;
        $approval->save();
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 4;
        $mail->isSMTP();
        $mail->Host = "700rdns1.websouls.net";
        $mail->SMTPAuth = true;
        $mail->Username = $request->from;
        $mail->Password = '4Ghulamhussain@472';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom($request->from, 'info@aimscal.com');
        $mail->addAddress('emazeem07@gmail.com', 'Joe User');     // Add a recipient
        $mail->addAddress($request->to);               // Name is optional
        //$mail->AddEmbeddedImage('http://aimslims.com/img/card.jpg','card','CARD');
        $mail->addAttachment(public_path('img/quotes/'.$attachment),$attachment);
        $mail->isHTML(true);
        $mail->Subject = $request->subject;
        $path='http://aimslims.com/img/card.jpg';
        $mail->Body    = $request->message."<img src='".$path."'>";
        //if ($mail->send()) {
            return response()->json(['success'=>'Quote sent successfully']);
        //} else {
            //echo 'Mailer Error: ' . $mail->ErrorInfo;
        //}
        return redirect('/sessions')->with('success','Email sent successfully');


    }
    */
    public function getprintdetails(Request $request){
        $this->authorize('quote-print-details');
        $session=Quotes::with('customers')->find($request->id);
        //dd($session);
        return response()->json($session);
    }
    public function purchase_details(Request $request){
        $this->validate(request(), [
            'pur_name' => 'required',
            'pur_email'=>'required_without:pur_phone',
            'pur_phone'=>'required_without:pur_email',
        ],[
            'pur_name.required' => 'Purchase Name field is required *',
        ]);
        $contact=new CustomerContact();
        $contact->customer_id=$request->customer;
        $contact->type='purchase';
        $contact->name=$request->pur_name;
        $contact->email=$request->pur_phone?$request->pur_phone:null;
        $contact->phone=$request->pur_email?$request->pur_email:null;
        $contact->save();
        return response()->json(['success'=>'Customer purchase details updated successfully']);
    }
    public function approval_details(Request $request){
        //$this->authorize('quote-print-details');
        $session=Quotes::find($request->id);
        $this->validate(request(),[
            'mode'=>'required',
            'details'=>'required',
            'approval_date'=>'required',
        ],[
            'mode.required'=>'RFQ Approval mode field is required. *',
            'details.required'=>'RFQ Approval details are required. *',
        ]);
        $session->approval_mode=($request->mode)?$request->mode:null;
        $session->approval_mode_details=($request->details)?$request->details:null;
        $session->approval_date=$request->approval_date;

        $session->save();
        return response()->json(['success'=>'Quote details updated successfully']);
    }

    public function prints($id){
        //$this->authorize('quote-print-details');
        $session=Quotes::find($id);
        $items=[];
        $groups=[];
        foreach ($session->items as $item){
            if ($item->group_id==null){
                $items[]=$item;
            }else{
                $groups[]=$item->group_id;
            }
        }
        $groups=array_unique($groups);$groups=array_values($groups);
        $prices=[];
        foreach ($groups as $group){
            $p=0;
            foreach ($session->items as $item){
                if ($item->group_id==$group){
                    $p=$p+$item->price;
                }
            }
            $prices[$group]=$p;
        }
        return view('quotes.print',compact('session','items','groups','prices'));
    }
    public function print_rf($id){
        //$this->authorize('quote-print-details');
        $quotes=Quotes::find($id);
        $items=QuoteItem::where('status','>',0)->where('quote_id',$quotes->id)->get();
        return view('quotes.review',compact('quotes','items'));
    }
    public function approved($id){
        $this->authorize('quote-accept');
        $checktypes=QuoteItem::where('quote_id',$id)->get();
        $totalrecords=$checktypes->count();
        $incrementforsite=0;
        $incrementforlab=0;
        foreach($checktypes as $checktype){
            if ($checktype->location=='lab'){
                $incrementforlab++;
            }
            if ($checktype->location=='site'){
                $incrementforsite++;
            }
        }
        $type=null;
        if ($incrementforlab == $totalrecords) {
            $type .= "LAB";
        } else if ($incrementforsite == $totalrecords) {
            $type .= "SITE";
        } else {
            $type .= 'SPLIT';
        }
        $approval=Quotes::findOrFail($id);
        $approval->status=3;
        $approval->type=$type;
        $approval->save();
        $users = User::whereIn('user_type', [1,8])->get();
        $url = '/quotes/view/'.$approval->id;
        $message = collect(['title' => 'RFQ has been approved','by'=>auth()->user()->id, 'body' => \auth()->user()->fname.' '.\auth()->user()->lname.' has approved '.$approval->cid, 'redirectURL' => $url]);
        Notification::send($users, new CustomNotification($message));

        return response()->json(['success'=>'Quote approved successfully']);
    }
    public function revised($id){
        $this->authorize('quote-revised');
        $approval=Quotes::find($id);
        $approval->status=0;
        $approval->revision=$approval->revision+1;
        $approval->save();
        return response()->json(['success'=>'You can review your quote now']);
    }
    public function complete(Request $request){
        $this->authorize('quote-revised');
        $complete=true;
        $items = QuoteItem::where('quote_id',$request->id)->get();
        foreach ($items as $item){
            if ($item->status==1){
                $complete=false;
            }
        }
        if ($complete==false) {
            return response()->json(['success'=>'Items are in review, Cant completed']);
        }else{
            $approval=Quotes::find($request->id);
            $approval->status=1;
            $approval->save();

            $users = User::where('user_type', 1)->get();
            $url = '/quotes/view/'.$approval->id;
            $message = collect(['title' => 'RFQ has been marked as complete','by'=>auth()->user()->id, 'body' => \auth()->user()->fname.' '.\auth()->user()->lname.' has marked this RFQ '.$approval->cid .' as completed. ', 'redirectURL' => $url]);
            Notification::send($users, new CustomNotification($message));
            return response()->json(['success'=>'Quote is marked as complete']);
        }

    }
    public function sendtocustomer(Request $request){
        $this->authorize('quote-revised');
        $approval=Quotes::find($request->id);
        $approval->status=2;
        $approval->sendtocustomer_date=date('Y-m-d');
        $approval->save();
        return response()->json(['success'=>'Quote is marked as sent to customer']);
    }
    public function discount(Request $request){
        $this->validate($request,[
           'discount'=>'required'
        ]);
        $items=QuoteItem::where('quote_id',$request->id)->get();
        foreach ($items as $item){
            if ($item->status==0 || $item->status==2){
                $update=QuoteItem::find($item->id);

                $log=new Quoterevisionlog();
                $log->quote_id=$item->quote_id;
                $log->description= $item->quotes->cid.'('.$item->id.')'.$request->discount.'% Discount applied with old value of '.$update->price.' and new price is '.($update->price-(($request->discount/100)*$update->price));

                $update->price=$update->price-(($request->discount/100)*$update->price);
                if ($update->save()){
                    $log->save();
                }
            }
        }
        $revision=Quotes::find($request->id);
        $revision->revision=$revision->revision+1;
        $revision->save();
        return response()->json(['success'=>'Discount applied successfully']);
    }
    public function remarks(Request $request){
        $this->validate(request(),[
            'turnaround'=>'required',
        ]);
        $quote=Quotes::find($request->id);
        $quote->remarks=($request->remarks)?$request->remarks:null;
        $quote->turnaround=$request->turnaround;
        $quote->save();
        return response()->json(['success'=>'Remarks & Turnaround added successfully']);
    }
    public function destroy(Request $request){
        QuoteItem::where('quote_id',$request->id)->delete();
        Quotes::find($request->id)->delete();
        return response()->json(['success'=>'Quote Deleted successfully']);
    }
}
