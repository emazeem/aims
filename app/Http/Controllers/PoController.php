<?php

namespace App\Http\Controllers;

use App\Models\Po;
use App\Models\Purchaseindent;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PoController extends Controller
{

    public function index()
    {
        return view('po.index');
    }

    public function fetch()
    {
        $data = Po::with('createdBy')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return 'PO # '.$data->id;
            })
            ->addColumn('indent_id', function ($data) {
                return 'IND # '.$data->indent_id;
            })
            ->addColumn('date', function ($data) {
                return $data->created_at->format('d M y');
            })
            ->addColumn('created_by', function ($data) {
                return $data->createdBy->fname.' '.$data->createdBy->lname;
            })
            ->addColumn('options', function ($data) {
                return "&emsp;
                  <a title='Edit' class='btn btn-sm btn-success edit' href='#' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                  <a title='Show' class='btn btn-sm btn-warning' href='" . url('/purchase-order/show/' . $data->id) . "'><i class='fa fa-eye'></i></a>
                  ";
            })
            ->rawColumns(['options'])
            ->make(true);

    }

    public function create($id)
    {
        $po=Po::find($id);
        $indents=Purchaseindent::find($po->indent_id);
        return view('po.create',compact('id','indents'));
    }

    public function edit(Request $request)
    {
        $po=Po::find($request->id);
        return response()->json($po);
    }
    public function prints($id)
    {
        $show=Po::find($id);
        return view('po.print',compact('show'));
    }


    public function show($id)
    {
        $show=Po::find($id);
        return view('po.show',compact('show'));
    }
    public function store(Request $request)
    {

        $this->validate(request(), [
            'purchase_indent' => 'required',
            'payment_term' => 'required',
            'currency' => 'required',
            'delivery_term' => 'required',
        ]);
        if (isset($request->edit_id)){
            $po=Po::find($request->edit_id);
        }else{
            $po=new Po();
        }
        $po->indent_id=$request->purchase_indent;
        $po->created_by=auth()->user()->id;
        $po->payment_term=$request->payment_term;
        $po->delivery_term=$request->delivery_term;
        $po->currency=$request->currency;
        $po->save();
        return redirect('/purchase-order/show/'.$po->id)->with('success', 'PO generated successfully');
    }
    //
}
