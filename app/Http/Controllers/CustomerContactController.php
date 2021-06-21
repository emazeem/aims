<?php

namespace App\Http\Controllers;


use App\Models\CustomerContact;
use Illuminate\Http\Request;

class CustomerContactController extends Controller
{
    //
    public function store(Request $request){
        $this->validate(request(), [
            'add_contact_customer' => 'required',
            'add_contact_type' => 'required',
            'add_contact_name' => 'required',

        ],[
            'add_contact_customer.required' => 'Contact Customer field is required *',
            'add_contact_type.required' => 'Contact Type field is required *',
            'add_contact_name.required' => 'Contact Name field is required *',
        ]);
        $contact=new CustomerContact();
        $contact->customer_id=$request->add_contact_customer;
        $contact->type=$request->add_contact_type;
        $contact->name=$request->add_contact_name;
        $contact->email=$request->add_contact_email?$request->add_contact_email:null;
        $contact->phone=$request->add_contact_phone?$request->add_contact_phone:null;
        $contact->save();
        return response()->json(['success'=>'Customer Contact Added Successfully!']);
    }
    public function destroy(Request $request){
        CustomerContact::find($request->id)->delete();
        return response()->json(['success'=>'Customer Contact Deleted Successfully!']);
    }
}
