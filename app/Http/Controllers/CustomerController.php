<?php

namespace App\Http\Controllers;
use App\Models\Chartofaccount;
use App\Models\Customer;
use App\Models\CustomerContact;
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
        $customers=Customer::all();
        foreach ($customers as $customer){
            if ($customer->acc_name){
                $contact=new CustomerContact();
                $contact->customer_id=$customer->id;
                $contact->type='account';
                $contact->name=$customer->acc_name;
                $contact->email=$customer->acc_email;
                $contact->phone=$customer->acc_phone;
                $contact->save();
            }
            if ($customer->pur_name){
                $contact=new CustomerContact();
                $contact->customer_id=$customer->id;
                $contact->type='purchase';
                $contact->name=$customer->pur_name;
                $contact->email=$customer->pur_email;
                $contact->phone=$customer->pur_phone;
                $contact->save();
            }
            foreach (explode('**',$customer->prin_name) as $k=>$principal) {

                $pemail=explode('**',$customer->prin_email);
                $pphone=explode('**',$customer->prin_phone);


                $contact=new CustomerContact();
                $contact->customer_id=$customer->id;
                $contact->type='principal';
                $contact->name=$principal;
                $contact->email=array_key_exists($k, $pemail)==true?$pemail[$k]:null;
                $contact->phone=array_key_exists($k, $pphone)==true?$pphone[$k]:null;
                $contact->save();
            }
        }
        dd('contacts saved');
        $saletaxes=Preference::where('category',1)->get();
        $this->authorize('customer-index');
        $customers=Customer::orderBy('reg_name','ASC')->get();
        return view('customers.index',compact('saletaxes','customers'));
    }
    public function create(){
        $this->authorize('customer-create');
        $saletaxes=Preference::where('category',1)->get();
        return view('customers.create',compact('saletaxes'));
    }
    public function edit(Request $request){
        $this->authorize('customer-edit');
        $edit=Customer::find($request->id);
        return response()->json($edit);
    }

    public function show(Request $request){
        $this->authorize('customer-view');

        $show=Customer::where('id',$request->id)->with(['contacts' => function ($q) {
            $q->orderBy('type','ASC');
        }])->first();

        $show->region=\App\Models\Preference::find($show->region)->name;
        if($show->tax_case==1){
            $tax_case="<b>Case-1 : Income Tax By AIMS + Service Tax By AIMS</b>";
        }elseif($show->tax_case==2){
            $tax_case="<b>Case-2 : Income Tax At SOURCE + Service Tax By SOURCE</b>";
        }elseif($show->tax_case==3){
            $tax_case="<b>Case-3 : Income Tax At SOURCE + Service Tax By AIMS</b>";
        }
        $show->tax_case=$tax_case;
        $show['contacts']=$show->contacts;
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
                    $action.="<a title='Show Customer' class='btn view-customer btn-sm btn-success' href data-id='".$data->id."'><i class='fa fa-eye'></i></a>";
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
            'credit_limit' => 'required',
            'industry' => 'required',
            'plant' => 'required',
            'region' => 'required',
            'tax_case' => 'required',

        ],[
            'name.required' => 'Company Name field is required *',
            'region.required' => 'Region field is required *',
            'ntn.required' => 'NTN / FTN field is required *',
            'address.required' => 'Company Address field is required *',
            'pay_type.required' => 'Payment Type field is required *',
            'pay_way.required' => 'Payment Way field is required *',
            'industry.required' => 'Industry field is required *',
            'credit_limit.required' => 'Credit Limit field is required *',

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

            return response()->json(['success'=>'Customer added successfully']);
        }
    }

    public function destroy(Request $request){
        $this->authorize('customer-delete');
        Customer::find($request->id)->delete();
        return response()->json(['success'=>'Customer deleted successfully']);
    }
}