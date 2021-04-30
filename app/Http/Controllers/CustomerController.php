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

/*        $customers=Customer::all();
        foreach ($customers as $customer){
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
        }
        dd('saved');*/
        $this->authorize('customer-index');
        return view('customers.index');
    }
    public function create(){
        $this->authorize('customer-create');
        $saletaxes=Preference::where('category',1)->get();
        return view('customers.create',compact('saletaxes'));
    }
    public function edit($id){
        $this->authorize('customer-edit');
        $edit=Customer::find($id);
        $saletaxes=Preference::where('category',1)->get();
        return view('customers.edit',compact('edit','saletaxes'));
    }

    public function show($id){
        $this->authorize('customer-view');
        $show=Customer::find($id);
        return view('customers.show',compact('show'));
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
                return $data->address;
            })
            ->addColumn('acc_code', function ($data) {
                return $data->acc_code;
            })

            ->addColumn('prin_name', function ($data) {
                $colors=['badge-primary','badge-dark','badge-warning'];
                $principals=null;
                foreach (explode(',',$data->prin_name) as $key=>$item) {
                    $principals.='<span class="badge '.$colors[$key].'">'.$item.'</span>';
                }
                return $principals;
            })
            ->addColumn('prin_phone', function ($data) {
                $colors=['badge-primary','badge-dark','badge-warning','badge-warning'];
                $phones=null;
                foreach (explode(',',$data->prin_phone) as $k=>$item) {
                    $phones.='<span class="badge '.$colors[$k].'">'.$item.'</span>';
                }
                return $phones;
            })
            ->addColumn('options', function ($data) {
                $token=csrf_token();
                $action=null;
                if (Auth::user()->can('customer-edit')) {
                    $action.="<a title='Edit' class='btn btn-sm btn-warning' href='" . url('/customers/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-pencil'></i></a>";
                }
                if (Auth::user()->can('customer-view')) {
                    $action.="<a title='Detail' class='btn btn-sm btn-success' href='" . url('/customers/view/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>";
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
        $this->authorize('customer-create');
        $this->validate(request(), [
            'name' => 'required',
            'ntn' => 'required',
            'address' => 'required',
            'pay_type' => 'required',
            'pay_way' => 'required',
            'region' => 'required',
            'prin_name.0' => 'required',
            'prin_phone.0' => 'required',
            'prin_email.0' => 'required',
        ],[
            'name.required' => 'Company Name field is required *',
            'region.required' => 'Region field is required *',
            'ntn.required' => 'NTN / FTN field is required *',
            'address.required' => 'Company Address field is required *',
            'pay_type.required' => 'Payment Type field is required *',
            'pay_way.required' => 'Payment Way field is required *',
            'prin_name.0.required' => 'Principal Name field is required *',
            'prin_email.0.required' => 'Principal Email field is required *',
            'prin_phone.0.required' => 'Principal Phone field is required *',
        ]);
        if ($request->prin_name[1]!=null or $request->prin_email[1]!=null or $request->prin_phone[1]!=null ){
            $this->validate(request(), [
                'prin_name.1' => 'required',
                'prin_phone.1' => 'required',
                'prin_email.1' => 'required',
            ],[

                'prin_name.1.required' => 'Principal Name field is required *',
                'prin_email.1.required' => 'Principal Email field is required *',
                'prin_phone.1.required' => 'Principal Phone field is required *',
            ]);
        }

        $customer=new Customer();
        $customer->reg_name=$request->name;
        $customer->ntn=$request->ntn;
        $customer->address=$request->address;
        $customer->customer_type=$request->pay_type;
        $customer->region=$request->region;
        $customer->pay_terms=$request->pay_way;
        $customer->credit_limit=0;
        $customer->prin_name=implode(',',$request->prin_name);
        $customer->prin_phone=implode(',',$request->prin_phone);
        $customer->prin_email=implode(',',$request->prin_email);

        if ($request->pur_name or $request->pur_phone[0] or $request->pur_phone[1] or $request->pur_email ){
            $this->validate(request(), [
                'pur_name' => 'required',
                'pur_email' => 'required',
            ],[
                'pur_name.required' => 'Purchase Name field is required *',
                'pur_email.required' => 'Purchase Email field is required *',
            ]);
            $customer->pur_name=$request->pur_name;
            $customer->pur_phone=implode(',',$request->pur_phone);
            $customer->pur_email=$request->pur_email;
        }
        if ($request->acc_name or $request->acc_phone[0] or $request->acc_phone[1] or $request->acc_email ){
            $this->validate(request(), [
                'acc_name' => 'required',
                'acc_email' => 'required',

            ],[
                'acc_name.required' => 'Account Name field is required *',
                'acc_email.required' => 'Account Email field is required *',
            ]);

            $customer->acc_name=$request->acc_name;
            $customer->acc_phone=implode(',',$request->acc_phone);
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

        return redirect()->back()->with('success', 'Customer added successfully');
    }
    public function update($id,Request $request){
        $this->authorize('customer-edit');
        $this->validate(request(), [
            'name' => 'required',
            'ntn' => 'required',
            'address' => 'required',
            'pay_type' => 'required',
            'pay_way' => 'required',
            'region' => 'required',
            'prin_name.0' => 'required',
            'prin_phone.0' => 'required',
            'prin_email.0' => 'required',
        ],[
            'name.required' => 'Company Name field is required *',
            'region.required' => 'Region field is required *',
            'ntn.required' => 'NTN / FTN field is required *',
            'address.required' => 'Company Address field is required *',
            'pay_type.required' => 'Payment Type field is required *',
            'pay_way.required' => 'Payment Way field is required *',
            'prin_name.0.required' => 'Principal Name field is required *',
            'prin_email.0.required' => 'Principal Email field is required *',
            'prin_phone.0.required' => 'Principal Phone field is required *',
        ]);
        if ($request->prin_name[1]!=null or $request->prin_email[1]!=null or $request->prin_phone[1]!=null ){
            $this->validate(request(), [
                'prin_name.1' => 'required',
                'prin_phone.1' => 'required',
                'prin_email.1' => 'required',
            ],[

                'prin_name.1.required' => 'Principal Name field is required *',
                'prin_email.1.required' => 'Principal Email field is required *',
                'prin_phone.1.required' => 'Principal Phone field is required *',
            ]);
        }

        $customer=Customer::find($id);
        $customer->reg_name=$request->name;
        $customer->ntn=$request->ntn;
        $customer->address=$request->address;
        $customer->customer_type=$request->pay_type;
        $customer->region=$request->region;
        $customer->pay_terms=$request->pay_way;
        $customer->credit_limit=0;
        $customer->prin_name=implode(',',$request->prin_name);
        $customer->prin_phone=implode(',',$request->prin_phone);
        $customer->prin_email=implode(',',$request->prin_email);

        if ($request->pur_name or $request->pur_phone[0] or $request->pur_phone[1] or $request->pur_email ){
            $this->validate(request(), [
                'pur_name' => 'required',
                'pur_email' => 'required',
            ],[
                'pur_name.required' => 'Purchase Name field is required *',
                'pur_email.required' => 'Purchase Email field is required *',
            ]);
            $customer->pur_name=$request->pur_name;
            $customer->pur_phone=implode(',',$request->pur_phone);
            $customer->pur_email=$request->pur_email;
        }
        if ($request->acc_name or $request->acc_phone[0] or $request->acc_phone[1] or $request->acc_email ){
            $this->validate(request(), [
                'acc_name' => 'required',
                'acc_email' => 'required',

            ],[
                'acc_name.required' => 'Account Name field is required *',
                'acc_email.required' => 'Account Email field is required *',
            ]);

            $customer->acc_name=$request->acc_name;
            $customer->acc_phone=implode(',',$request->acc_phone);
            $customer->acc_email=$request->acc_email;
        }
        $customer->save();
        return redirect()->back()->with('success', 'Customer updated successfully');
    }
    public function destroy(Request $request){
        $this->authorize('customer-delete');
        Customer::find($request->id)->delete();
        return response()->json(['success'=>'Customer deleted successfully']);
    }
}