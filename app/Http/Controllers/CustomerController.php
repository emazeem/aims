<?php

namespace App\Http\Controllers;
use App\Models\Chartofaccount;
use App\Models\Customer;
use App\Models\Preference;
use App\Models\User;
use App\Notifications\CustomerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Yajra\DataTables\DataTables;
class CustomerController extends Controller
{
    public function index(){
        $saletaxes=Preference::where('category',1)->get();
        $this->authorize('customer-index');
        return view('customers.index',compact('saletaxes'));
    }
    public function create(){
        $this->authorize('customer-create');
        $saletaxes=Preference::where('category',1)->get();
        return view('customers.create',compact('saletaxes'));
    }
    public function edit(Request $request){
        $this->authorize('customer-edit');
        $edit=Customer::find($request->id);

        $pnames=explode(',',$edit->prin_name);
        $pphones=explode(',',$edit->prin_phone);
        $pemails=explode(',',$edit->prin_email);

        $purphones=explode(',',$edit->pur_phone);
        $accphones=explode(',',$edit->acc_phone);

        $edit->prin_name_1=$pnames[0];
        $edit->prin_name_2=count($pnames)==2?$pnames[1]:'';
        $edit->prin_name_3=count($pnames)==3?$pnames[2]:'';

        $edit->prin_phone_1=$pphones[0];
        $edit->prin_phone_2=count($pphones)==2?$pphones[1]:'';
        $edit->prin_phone_3=count($pphones)==3?$pphones[2]:'';

        $edit->prin_email_1=$pemails[0];
        $edit->prin_email_2=count($pemails)==2?$pemails[1]:'';
        $edit->prin_email_3=count($pemails)==3?$pemails[2]:'';

        $edit->pur_phone_1=$purphones[0];
        $edit->pur_phone_2=count($purphones)==2?$purphones[1]:'';

        $edit->pur_email_1=$purphones[0];
        $edit->pur_email_2=count($purphones)==2?$purphones[1]:'';

        return response()->json($edit);
    }

    public function show(Request $request){
        $this->authorize('customer-view');
        $show=Customer::find($request->id);
        $show->region=\App\Models\Preference::find($show->region)->name;
        if($show->tax_case==1){
            $tax_case="<b>Case-1 : Income Tax By AIMS + Service Tax By AIMS</b>";
        }elseif($show->tax_case==2){
            $tax_case="<b>Case-2 : Income Tax At SOURCE + Service Tax By SOURCE</b>";
        }elseif($show->tax_case==3){
            $tax_case="<b>Case-3 : Income Tax At SOURCE + Service Tax By AIMS</b>";
        }
        $show->tax_case=$tax_case;
        $colors=['badge-primary','badge-dark','badge-warning'];
        $principals=null;
        foreach (explode(',',$show->prin_name) as $key=>$item) {
            $principals.='<span class="badge '.$colors[$key].'">'.$item.'</span><br>';
        }
        $phones=null;
        foreach (explode(',',$show->prin_phone) as $k=>$item) {
            $phones.='<span class="badge '.$colors[$k].'">'.$item.'</span><br>';
        }
        $emails=null;
        foreach (explode(',',$show->prin_email) as $k=>$item) {
            $emails.='<span class="badge '.$colors[$k].'">'.$item.'</span><br>';
        }
        $show->prin_name=$principals;
        $show->prin_phone=$phones;
        $show->prin_email=$emails;
        return response()->json($show);
    }
    public function fetch(Request $request){
        $data=Customer::all();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->reg_name;
            })
            ->addColumn('address', function ($data) {
                return $data->address.'-'.$data->plant;
            })
            ->addColumn('options', function ($data) {
                $token=csrf_token();
                $action=null;
                if (Auth::user()->can('customer-edit')) {
                    $action.="<a title='Edit Customer' class='btn edit btn-sm btn-warning' href data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>";
                }

                if (Auth::user()->can('customer-view')) {
                    $action.="<a title='Show Customer' class='btn view-customer btn-sm btn-success' href data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>";
                }
                if (Auth::user()->can('customer-delete')){
                    $action.="<a class='btn btn-danger btn-sm delete' href='#' data-id='{$data->id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$data->id\" method='post' role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$data->id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";
                }

                return $action;
            })
            ->rawColumns(['options','prin_name','prin_phone'])
            ->make(true);

    }
    public function store(Request $request){
        //dd($request->all());
        $this->authorize('customer-create');
        $this->validate(request(), [
            'name' => 'required',
            'ntn' => 'required',
            'address' => 'required',
            'pay_type' => 'required',
            'pay_way' => 'required',
            'credit_limit' => 'required',
            'industry' => 'required',
            'plant' => 'required',
            'region' => 'required',
            'tax_case' => 'required',
            'prin_name.0' => 'required',
        ],[
            'name.required' => 'Company Name field is required *',
            'region.required' => 'Region field is required *',
            'ntn.required' => 'NTN / FTN field is required *',
            'address.required' => 'Company Address field is required *',
            'pay_type.required' => 'Payment Type field is required *',
            'pay_way.required' => 'Payment Way field is required *',
            'prin_name.0.required' => 'Principal Name field is required *',
        ]);
        if ($request->id){
            $customer=Customer::find($request->id);
            $customer->reg_name=$request->name;
            $customer->ntn=$request->ntn;
            $customer->credit_limit=$request->credit_limit;
            $customer->industry=$request->industry;
            $customer->plant=$request->plant;

            $customer->address=$request->address;
            $customer->customer_type=$request->pay_type;
            $customer->tax_case=$request->tax_case;
            $customer->region=$request->region;
            $customer->pay_terms=$request->pay_way;
            $customer->bill_to_address=$request->bill_to_address;
            $customer->prin_name=implode(',',$request->prin_name);
            $customer->prin_phone=implode(',',$request->prin_phone);
            $customer->prin_email=implode(',',$request->prin_email);

            if ($request->pur_name or $request->pur_phone[0] or $request->pur_phone[1] or $request->pur_email ){
                $this->validate(request(), [
                    'pur_name' => 'required',
                ],[
                    'pur_name.required' => 'Purchase Name field is required *',

                ]);
                $customer->pur_name=$request->pur_name;
                $customer->pur_phone=implode(',',$request->pur_phone);
                $customer->pur_email=$request->pur_email;
            }
            if ($request->acc_name or $request->acc_phone[0] or $request->acc_phone[1] or $request->acc_email ){
                $this->validate(request(), [
                    'acc_name' => 'required',

                ],[
                    'acc_name.required' => 'Account Name field is required *',
                ]);

                $customer->acc_name=$request->acc_name;
                $customer->acc_phone=implode(',',$request->acc_phone);
                $customer->acc_email=$request->acc_email;
            }
            $customer->save();
            return response()->json(['success'=>'Customer updated successfully']);

        }else{
            $customer=new Customer();
            $customer->reg_name=$request->name;
            $customer->credit_limit=$request->credit_limit;
            $customer->industry=$request->industry;
            $customer->plant=$request->plant;
            $customer->ntn=$request->ntn;
            $customer->address=$request->address;
            $customer->customer_type=$request->pay_type;
            $customer->tax_case=$request->tax_case;
            $customer->region=$request->region;
            $customer->bill_to_address=$request->bill_to_address;
            $customer->pay_terms=$request->pay_way;
            $customer->prin_name=implode(',',array_filter($request->prin_name));
            $customer->prin_phone=implode(',',array_filter($request->prin_phone));
            $customer->prin_email=implode(',',array_filter($request->prin_email));

            if ($request->pur_name or $request->pur_phone[0] or $request->pur_phone[1] or $request->pur_email ){
                $this->validate(request(), [
                    'pur_name' => 'required',
                ],[
                    'pur_name.required' => 'Purchase Name field is required *',
                ]);
                $customer->pur_name=$request->pur_name;
                $customer->pur_phone=implode(',',array_filter($request->pur_phone));
                $customer->pur_email=$request->pur_email;
            }
            if ($request->acc_name or $request->acc_phone[0] or $request->acc_phone[1] or $request->acc_email ){
                $this->validate(request(), [
                    'acc_name' => 'required',

                ],[
                    'acc_name.required' => 'Account Name field is required *',
                ]);
                $customer->acc_name=$request->acc_name;
                $customer->acc_phone=implode(',',array_filter($request->acc_phone));
                $customer->acc_email=$request->acc_email;
            }

            $acc = new Chartofaccount();
            $acc->code4 = 000;
            $acc->code3 = 3;
            $acc->code2 = 1;
            $acc->code1 = 1;
            $acc->title = $customer->reg_name;
            $code4=(Chartofaccount::withTrashed()->where('code3',3)->count());
            $acc->acc_code = 10103 .str_pad($code4+1, 3, '0', STR_PAD_LEFT);;
            $acc->code4 = str_pad($code4+1, 3, '0', STR_PAD_LEFT);
            $acc->save();

            $customer->acc_code=$acc->acc_code;
            $customer->save();

            $users = User::where('user_type', 1)->get();
            $url = '/customers/view/'.$customer->id;
            $creator = auth()->user()->fname . ' ' . auth()->user()->lname;
            $message = collect(['title' => 'New customer added','by'=>auth()->user()->id, 'body' => 'A new customer ( '.$customer->reg_name.' ) has been added.', 'redirectURL' => $url]);
            Notification::send($users, new CustomerNotification($message));
            return response()->json(['success'=>'Customer added successfully']);
        }
    }

    public function destroy(Request $request){
        $this->authorize('customer-delete');
        Customer::find($request->id)->delete();
        return response()->json(['success'=>'Customer deleted successfully']);
    }
}