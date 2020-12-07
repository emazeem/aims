<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Quotes;
use App\Models\User;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use Yajra\DataTables\DataTables;
use NumConvert;
class QuotesController extends Controller
{
    public function index(){
        $this->authorize('quote-index');
        $customers=Customer::orderBY('reg_name')->get();
        $tms=User::where('department',3)->get();
        return view('quotes.index',compact('customers','tms'));
    }
    public function get_principal($id){
        $user=Customer::find($id);
        return response()->json($user);
    }
    public function fetch(){
        $this->authorize('quote-index');
        $data=Quotes::with('customers')->get();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return 'QT/'.date('y').'/'.$data->id;
            })
            ->addColumn('customer', function ($data) {
                return $data->customers->reg_name;
            })
            ->addColumn('location', function ($data) {
                return ucfirst($data->location);
            })
            ->addColumn('type', function ($data) {
                $checktypes=Item::where('quote_id',$data->id)->get();
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
                if($totalrecords==0){
                    $type.='-----';
                }else{
                    if ($incrementforlab==$totalrecords){
                        $type.="LAB";
                    }
                    else if ($incrementforsite==$totalrecords){
                        $type.="SITE";
                    }
                    else{
                        $type.='SPLIT';
                    }
                }
                return $type;
            })
            ->addColumn('status', function ($data) {
                //Items are adding
                if ($data->status==0){
                    $status= '<b class="badge badge-secondary">Pending</b>';
                }
                //Session email send, awaiting customer approval
                if ($data->status==1){
                    $status= '<b class="badge badge-success">Awaiting Customer Approval</b>';
                }
                //Session is approved or working.
                if ($data->status==2){
                    $status= '<b class="badge badge-success">Closed</b>';
                }
                //Team is working
                if ($data->status==3){
                    $status= '<b class="badge badge-danger">Approved</b>';
                }
                //Team is working
                if ($data->status==4){
                    $status= '<b class="badge badge-danger">Team is working</b>';
                }
                return $status;
            })
            ->addColumn('turnaround', function ($data) {
                return $data->turnaround;
            })
            ->addColumn('total', function ($data) {
                $total=Item::where('quote_id',$data->id)->count();
                return $total;
            })
            ->addColumn('options', function ($data) {
                $token=csrf_token();
                $action=null;
                $action.="<a title='view' href=".url('/quotes/view/'.$data->id)." class='btn btn-sm btn-dark'><i class='fa fa-eye'></i></a>";
                $action.="<button type='button' title='Edit' class='btn edit btn-sm btn-success' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-edit'></i></button>";
                $action.="<a href=".url('/quotes/print/'.$data->id)." title='Print' class='btn btn-sm btn-danger'><b>QF</b></a>";
                $action.="<a href=".url('print_rf/'.$data->id)." title='Print' class='btn btn-sm btn-info'><b>RF</b></a>";
                return "&emsp;".$action;
            })
            ->rawColumns(['options','status'])
            ->make(true);
    }
    public function store(Request $request){
        //dd($request->all());
        $this->authorize('quote-create');
        $this->validate(request(), [
            'customer' => 'required',

        ],[
            'customer.required' => 'Customer field is required *',

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
        $session->turnaround=$request->turnaround;
        $session->customer_id=$request->customer;
        $session->turnaround=$request->turnaround;
        $session->principal=$request->principal;
        $session->tm=$request->tm;
        $session->save();
        return response()->json(['success'=>'Added successfully']);
    }
    public function update(Request $request){
        $this->authorize('quote-edit');
        $this->validate(request(), [
            'customer' => 'required',

        ],[
            'customer.required' => 'Customer field is required *',
        ]);
        $session=Quotes::find($request->id);
        $session->turnaround=$request->turnaround;
        $session->customer_id=$request->customer;
        $session->turnaround=$request->turnaround;
        $session->principal=$request->principal;
        $session->tm=$request->tm;
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
        $items=Item::where('quote_id',$id)->get();
        return view('quotes.show',compact('show','id','tms','items'));
    }

    public function sendmail($id){
        $this->authorize('quote-send-to-customer');
        if (Item::where('quote_id',$id)->where('not_available','!=',null)->count()>0){
            return redirect('/sessions')->with('failed','Because of non-listed pending items, Email cant send');
        }
        if (Item::where('quote_id',$id)->count()==0){
            return redirect('/sessions')->with('failed','Session is empty, Fill session and then send email');

        }
        $session=Quotes::find($id);
        return view('quotes.mail',compact('session'));
    }
    public function sendtocustomer($id,Request $request){

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
    public function getprintdetails(Request $request){
        $this->authorize('quote-print-details');
        $session=Quotes::with('customers')->find($request->id);
        //dd($session);
        return response()->json($session);
    }
    public function approval_details(Request $request){
        $this->authorize('quote-print-details');
        $session=Quotes::find($request->id);
        if (isset($request->mode)){
            $this->validate(request(),[
                'mode'=>'required',
                'details'=>'required',
                'approval_date'=>'required',
            ]);
            $session->mode=($request->mode)?$request->mode:null;
            $session->details=($request->details)?$request->details:null;
            $session->approval_date=$request->approval_date;
        }
        $session->save();

        /*if (isset($request->pur_name)){
            $this->validate(request(),[
                'pur_name'=>'required',
                'pur_phone_1'=>'required',
                'pur_email'=>'required',
            ]);
            $customer=Customer::find($session->customer_id);
            $customer->pur_name=($request->pur_name)?$request->pur_name:null;
            $customer->pur_phone=$request->pur_phone_1."-".$request->pur_phone_2;
            $customer->pur_email=($request->pur_email)?$request->pur_email:null;
            $customer->save();
        }*/
        return back()->with('success','Quote details added successfully');
    }

    public function prints($id){
        $this->authorize('quote-print-details');
        $session=Quotes::find($id);
        return view('quotes.print',compact('session'));
    }
    public function print_rf($id){
        //$this->authorize('quote-print-details');
        $quotes=Quotes::find($id);
        $nlitems=Item::where('status','>',0)->where('quote_id',$quotes->id)->get();
        return view('quotes.review',compact('quotes','nlitems'));
    }

    public function approved($id){
        $this->authorize('quote-accept');
        $checktypes=Item::where('quote_id',$id)->get();
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
        $approval->status=4;
        $approval->type=$type;
        $approval->save();
        return response()->json(['success'=>'Quote approved successfully']);
    }
    public function revised($id){
        $this->authorize('quote-revised');
        $approval=Quotes::find($id);
        $approval->status=0;
        $approval->save();
        return response()->json(['success'=>'You can review your quote now']);
    }
    public function complete(Request $request){
        $this->authorize('quote-revised');
        $approval=Quotes::find($request->id);
        $approval->status=1;
        $approval->save();
        return response()->json(['success'=>'Quote is marked as complete']);
    }
}
