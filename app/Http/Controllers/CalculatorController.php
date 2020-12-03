<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Labjob;
use App\Models\Parameter;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class CalculatorController extends Controller
{
    public function index($location,$id){
        //location 0 is lab, location 1 is site
        if ($location==0){
            $show=Labjob::find($id);

            $parameters=[];
            $assets=explode(',',$show->assign_assets);
            foreach ($assets as $asset){
                $parameters[]=Asset::find($asset)->parameter;
            }
            $parameters=array_unique($parameters);
            $parameters=Parameter::whereIn('id',$parameters)->get();
            $assets=Asset::whereIn('id',$assets)->get();
        }
        return view('calculator.create',compact('show','location','parameters','assets','location'));
    }

    //
}
