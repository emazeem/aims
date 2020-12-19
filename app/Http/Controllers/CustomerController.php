<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Preference;
use App\Models\User;
use App\Notifications\CustomerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Yajra\DataTables\DataTables;
class CustomerController extends Controller
{
    public function index(){
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
        //$this->authorize('customer-view');
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
            ->addColumn('prin_name', function ($data) {
                return $data->prin_name_1.",".$data->prin_name_2.",".$data->prin_name_3;
            })
            ->addColumn('prin_phone', function ($data) {
                $phone=null;
                $phone.=$data->prin_phone_1;
                $phone.=($data->prin_phone_2)?"-".$data->prin_phone_2:"";
                $phone.=($data->prin_phone_3)?"-".$data->prin_phone_3:"";
                return $phone;
            })
            ->addColumn('options', function ($data) {
                return "&emsp;
                  <a title='Edit' class='btn btn-sm btn-warning' href='" . url('/customers/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-pencil'></i></a>
                    <a title='Detail' class='btn btn-sm btn-success' href='" . url('/customers/view/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>
                  ";

            })
            ->rawColumns(['options'])
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
            'prin_name_1' => 'required',
            'prin_phone_1' => 'required',
            'prin_email_1' => 'required',

        ],[
            'name.required' => 'Company Name field is required *',
            'region.required' => 'Region field is required *',
            'ntn.required' => 'NTN / FTN field is required *',
            'address.required' => 'Company Address field is required *',
            'pay_type.required' => 'Payment Type field is required *',
            'pay_way.required' => 'Payment Way field is required *',
            'prin_name_1.required' => 'Principal Name field is required *',
            'prin_phone_1.required' => 'Principal Phone field is required *',
            'prin_email_1.required' => 'Principal Email field is required *',
        ]);
        $customer=new Customer();
        $customer->reg_name=$request->name;
        $customer->ntn=$request->ntn;
        $customer->address=$request->address;
        $customer->customer_type=$request->pay_type;
        $customer->region=$request->region;
        $customer->pay_terms=$request->pay_way;
        $customer->credit_limit=0;
        $customer->prin_name_1=$request->prin_name_1;
        $customer->prin_phone_1=$request->prin_phone_1;
        $customer->prin_email_1=$request->prin_email_1;
        $customer->prin_name_2=($request->prin_name_2)?$request->prin_name_2:null;
        $customer->prin_phone_2=($request->prin_phone_2)?$request->prin_phone_2:null;
        $customer->prin_email_2=($request->prin_email_2)?$request->prin_email_2:null;
        $customer->prin_name_3=($request->prin_name_3)?$request->prin_name_3:null;
        $customer->prin_phone_3=($request->prin_phone_3)?$request->prin_phone_3:null;
        $customer->prin_email_3=($request->prin_email_3)?$request->prin_email_3:null;
        $customer->pur_name=($request->pur_name)?$request->pur_name:null;
        $purchase_phone=null;
        $account_phone=null;
        if ($request->pur_phone_1){
            if ($request->pur_phone_2) {
                $purchase_phone=$request->pur_phone_1.','.$request->pur_phone_2;
            }else{
                $purchase_phone=$request->pur_phone_1;
            }
        }
        $customer->pur_phone=($purchase_phone)?$purchase_phone:null;
        $customer->pur_email=($request->pur_email)?$request->pur_email:null;
        $customer->acc_name=($request->acc_name)?$request->acc_name:null;
        if ($request->acc_phone_1){
            if ($request->acc_phone_2) {
                $account_phone=$request->acc_phone_1.','.$request->acc_phone_2;
            }else{
                $account_phone=$request->acc_phone_1;
            }
        }
        $customer->acc_phone=$account_phone;
        $customer->acc_email=($request->acc_email)?$request->acc_email:null;
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
            'prin_name_1' => 'required',
            'prin_phone_1' => 'required',
            'prin_email_1' => 'required',
            'region' => 'required',
        ],[
            'name.required' => 'Company Name field is required *',
            'ntn.required' => 'NTN / FTN field is required *',
            'address.required' => 'Company Address field is required *',
            'pay_type.required' => 'Payment Type field is required *',
            'pay_way.required' => 'Payment Way field is required *',
            'prin_name_1.required' => 'Principal Name field is required *',
            'prin_phone_1.required' => 'Principal Phone field is required *',
            'prin_email_1.required' => 'Principal Email field is required *',
            'region.required' => 'Region field is required *',
        ]);

        $customer=Customer::find($id);
        $customer->reg_name=$request->name;
        $customer->ntn=$request->ntn;
        $customer->address=$request->address;
        $customer->customer_type=$request->pay_type;
        $customer->pay_terms=$request->pay_way;
        $customer->credit_limit=0;
        $customer->region=$request->region;
        $customer->prin_name_1=$request->prin_name_1;
        $customer->prin_phone_1=$request->prin_phone_1;
        $customer->prin_email_1=$request->prin_email_1;
        $customer->prin_name_2=($request->prin_name_2)?$request->prin_name_2:null;
        $customer->prin_phone_2=($request->prin_phone_2)?$request->prin_phone_2:null;
        $customer->prin_email_2=($request->prin_email_2)?$request->prin_email_2:null;
        $customer->prin_name_3=($request->prin_name_3)?$request->prin_name_3:null;
        $customer->prin_phone_3=($request->prin_phone_3)?$request->prin_phone_3:null;
        $customer->prin_email_3=($request->prin_email_3)?$request->prin_email_3:null;

        $customer->pur_name=($request->pur_name)?$request->pur_name:null;
        //$customer->pur_phone=($request->pur_phone_1)?$request->pur_phone_1:null.",".($request->pur_phone_2)?$request->pur_phone_2:null;
        $customer->pur_email=($request->pur_email)?$request->pur_email:null;
        $customer->acc_name=($request->acc_name)?$request->acc_name:null;
        //$customer->acc_phone=($request->acc_phone_1)?$request->acc_phone_1:null.",".($request->acc_phone_2)?$request->acc_phone_2:null;
        $customer->acc_email=($request->acc_email)?$request->acc_email:null;
        $customer->save();
        return redirect()->back()->with('success', 'Customer Updated Successfully');
    }
    //
}
