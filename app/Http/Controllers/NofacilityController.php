<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Nofacility;
use App\Models\Quotes;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NofacilityController extends Controller
{
    public function index()
    {
        return view('nofacility');
    }
    public function fetch()
    {
        $data = Nofacility::all();
        return DataTables::of($data)
            ->addColumn('item', function ($data) {
                return $data->capability;
            })
            ->addColumn('quote', function ($data) {
                return 'QTN/'.date('y',strtotime(Item::find($data->item_id)->quotes->created_at)).'/'.Item::find($data->item_id)->quote_id;

            })
            ->addColumn('customer', function ($data) {
                return Item::find($data->item_id)->quotes->customers->reg_name;
            })
            ->make(true);
    }
    //
}
