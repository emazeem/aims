<?php

namespace App\Http\Controllers;

use App\Models\Uncertainty;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UncertaintyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('uncertainty');
        //
    }

    public function fetch(){
        $data=Uncertainty::all();
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('slug', function ($data) {
                return $data->slug;
            })

            ->addColumn('options', function ($data) {

                return "&emsp;
                    <button type='button' title='Edit' class='btn edit btn-sm btn-success' data-toggle='modal' data-id='" . $data->id . "'><i class='fa fa-edit'></i></button>
                  ";

            })
            ->rawColumns(['options'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //dd($request->all());
        $this->validate($request,[
            'name'=>'required',
        ]);
        $slugify = new Slugify();
        $column=new Uncertainty();
        $column->slug=$slugify->slugify($request->name);;
        $column->name=$request->name;
        $column->save();
        return response()->json(['success'=>'Uncertainty added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request){
        $edit=Uncertainty::find($request->id);
        return response()->json($edit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        //dd($request->all());
        $this->validate($request,[
            'name'=>'required',
        ]);
        //$slugify = new Slugify();
        $column=Uncertainty::find($request->id);
        //$column->slug=$slugify->slugify($request->name);;
        $column->name=$request->name;
        $column->save();
        return response()->json(['success'=>'Uncertainty updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
