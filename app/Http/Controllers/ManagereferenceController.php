<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Managereference;
use App\Models\Parameter;
use App\Models\Preference;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ManagereferenceController extends Controller
{
    //
    public function index(){

        //$multiples=Managereference::whereIn('id',$id)->get();
        $this->authorize('manage-reference-index');
        return view('reference_errors.index');
    }
    public function fetch(){
        $temps=Managereference::get()->unique('asset');
        $asset_units=array();
        foreach ($temps as $temp) {
            $forassets=Managereference::where('asset',$temp->asset)->get();
            $its_assets=[];
            foreach ($forassets as $forasset){
                $its_assets[]=$forasset->unit;
            }
            $its_assets=array_unique($its_assets);
            $its_assets=array_values($its_assets);
            $asset_units[$temp->asset]=$its_assets;
        }
        $ids=[];
        foreach ($asset_units as $key=>$unit){
            foreach ($unit as $item){
                $rough=Managereference::where('asset',$key)->where('unit',$item)->first();
                $ids[]=$rough->id;
            }
        }
        $data=Managereference::whereIn('id',$ids)->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('asset', function ($data) {
                return $data->assets->name.'='.$data->assets->code;
            })
            ->addColumn('unit', function ($data) {
                return $data->units->unit;
            })
            ->addColumn('ref', function ($data) {
                return $data->ref;
            })
            ->addColumn('error', function ($data) {
                return $data->error;
            })
            ->addColumn('uncertainty', function ($data) {
                return $data->uncertainty;
            })
            ->addColumn('options', function ($data) {

                return "&emsp;<a title='Show' class='btn btn-sm btn-primary' href='" . url('/manage-reference/show/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>
                  <a title='Edit' class='btn btn-sm btn-success' href='" . url('/manage-reference/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>";

            })
            ->rawColumns(['options','status'])
            ->make(true);

    }


    public function create(){
        //$units=Unit::all();
        $this->authorize('manage-reference-index');
        $parameters=Parameter::all();
        return view('reference_errors.create',compact('parameters'));
    }
    public function edit($id){
        $this->authorize('manage-reference-index');
        $parameters=Parameter::all();
        $edit=Managereference::find($id);
        $multiples=Managereference::where('asset',$edit->asset)->get();
        $hasChannels=Preference::where('slug','has-channels')->first();
        $hasChannels=explode(',',$hasChannels->value);

        $show_channels=false;
        if (in_array($edit->asset,$hasChannels)){
            $show_channels=true;
        }
        $channels=Preference::where('slug','channels')->first();
        $channels=explode(',',$channels->value);
        return view('reference_errors.edit',compact('parameters','edit','multiples','show_channels','channels'));
    }

    public function store(Request $request){
        $reference=array();
        $uuc=array();
        $uncertainty=array();
        foreach ($request->reference as $item) {
            $reference[]=$item;
        }
        foreach ($request->uuc as $item) {
            $uuc[]=$item;

        }
        foreach ($request->uncertainty as $item) {
            $uncertainty[]=$item;
        }
        $this->validate(request(), [
            'parameter' => 'required',
            'assets' => 'required',
            'uuc' => 'required',
            'units' => 'required',
            'reference' => 'required',
            'uncertainty' => 'required',
        ],[
            'parameter.required' => 'Parameter name field is required *',
        ]);

        $hasChannels=Preference::where('slug','has-channels')->first();
        $hasChannels=explode(',',$hasChannels->value);

        for ($i=0;$i<count($reference);$i++){
            $manageref=new Managereference();
            $manageref->parameter=$request->parameter;
            $manageref->asset=$request->assets;
            if (in_array($request->assets,$hasChannels)){
                $this->validate(request(), [
                    'channels' => 'required',
                ],[
                    'channels.required'=>'Channels field is required *',
                ]);
                $manageref->channel=$request->channels;
            }
            $manageref->unit=$request->units;
            $manageref->uuc=$uuc[$i];
            $manageref->ref=$reference[$i];
            $manageref->error=$uuc[$i]-$reference[$i];
            $manageref->uncertainty=$uncertainty[$i];
            $manageref->save();
        }

        return back()->with('success','Error & uncertainty added successfully');
    }
    public function update(Request $request){
        $delentries=Managereference::where('asset',$request->assets)->get();

        $reference=array();
        $uuc=array();
        $uncertainty=array();
        foreach ($request->reference as $item) {
            $reference[]=$item;
        }
        foreach ($request->uuc as $item) {
            $uuc[]=$item;

        }
        foreach ($request->uncertainty as $item) {
            $uncertainty[]=$item;
        }

        $hasChannels=Preference::where('slug','has-channels')->first();
        $hasChannels=explode(',',$hasChannels->value);


        $this->validate(request(), [
            'parameter' => 'required',
            'assets' => 'required',
            'uuc' => 'required',
            'units' => 'required',
            'reference' => 'required',
            'uncertainty' => 'required',
        ],[
            'parameter.required' => 'Parameter name field is required *',
        ]);
        for ($i=0;$i<count($reference);$i++){
            $manageref=new Managereference();
            $manageref->parameter=$request->parameter;
            $manageref->asset=$request->assets;

            if (in_array($request->assets,$hasChannels)){
                $this->validate(request(), [
                    'channels' => 'required',
                ],[
                    'channels.required'=>'Channels field is required *',
                ]);
                $manageref->channel=$request->channels;
            }

            $manageref->unit=$request->units;
            $manageref->uuc=$uuc[$i];
            $manageref->ref=$reference[$i];
            $manageref->error=$uuc[$i]-$reference[$i];
            $manageref->uncertainty=$uncertainty[$i];
            foreach ($delentries as $delentry){
                $delentry->delete();
            }
            $manageref->save();
        }

        return redirect('manage-reference')->with('success','Error & uncertainty added successfully');
    }
    public function show($id){
        $show=Managereference::find($id);
        $multiples=Managereference::where('asset',$show->asset)->get();
        $units=array();
        foreach ($multiples as $multiple){
            $units[]=$multiple->unit;
        }
        $units=array_unique($units);
        $units=array_values($units);
        return view('reference_errors.show',compact('show','multiples','units'));
    }
}
