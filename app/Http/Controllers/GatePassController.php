<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\GatePass;
use App\Models\GatePassItems;
use App\Models\SitePlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class GatePassController extends Controller
{
    public function index()
    {
        $this->authorize('gp-items-in-out-index');
        return view('gp_items_in_out.index');
    }
    public function check_in_out($id)
    {
        $this->authorize('gate-pass-items-checkin-checkout');
        $show=GatePass::find($id);
        return view('gp_items_in_out.show',compact('show'));
    }

    public function fetch()
    {
        $this->authorize('gp-items-in-out-index');
        $data = GatePass::all()->where('out_received_by',\auth()->user()->id);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->cid;
            })
            ->addColumn('customer', function ($data) {
                return $data->plan->jobs->quotes->customers->reg_name;
            })
            ->addColumn('job', function ($data) {
                return $data->plan->jobs->cid;
            })
            ->addColumn('options', function ($data) {
                $action = null;
                if (Auth::user()->can('gate-pass-items-checkin-checkout')){
                    $action = "<a title='view' href=" . url('gate_pass/check-in-out/'.$data->id)." class='btn btn-sm btn-dark'><i class='fa fa-eye'></i></a>";
                }
                return $action;
            })
            ->rawColumns(['options', 'status'])
            ->make(true);
    }

    public function get_items(Request $request)
    {
        $plan = SitePlan::find($request->id);
        $aids = explode(',', $plan->assigned_assets);
        $uids = explode(',', $plan->assigned_users);
        $data['assets'] = Asset::whereIn('id', $aids)->get();
        $data['users'] = User::whereIn('id', $uids)->get();
        return response()->json($data);
    }

    public function store_out(Request $request)
    {
        $this->authorize('create-gate-pass');
        $this->validate($request, [
            'handed_over_to' => 'required',
            'gp_items' => 'required',
            'date_out' => 'required',
            'time_out' => 'required',
        ]);
        //dd($request->all());
        $gp = new GatePass();
        $gp->plan_id = $request->plan_id;
        $gp->out_received_by = $request->handed_over_to;
        $gp->out_handed_over_by = auth()->user()->id;
        //d-m-Y H:i:s
        $gp->out = $request->date_out . ' ' . $request->time_out;
        $gp->save();
        $gp->cid = 'GP/' . str_pad($gp->id, 7, '0', STR_PAD_LEFT);
        $gp->save();

        foreach ($request->gp_items as $item) {
            $gpitems = new GatePassItems();
            $gpitems->gp_id = $gp->id;
            $gpitems->item_id = $item;
            $gpitems->save();
        }
        return response()->json(['success' => 'Gate Pass ( ' . $gp->cid . ') created successfully!']);
    }
    public function store_in(Request $request)
    {
        $this->authorize('create-gate-pass');
        $this->validate($request, [
            'date_in' => 'required',
            'time_in' => 'required',
        ]);
        //dd($request->all());
        $gp = GatePass::find($request->gp_id);
        $gp->in_received_by = auth()->user()->id;
        //d-m-Y H:i:s
        $gp->in = $request->date_in . ' ' . $request->time_in;
        $gp->save();
        return response()->json(['success' => 'Gate Pass ( ' . $gp->cid . ') received successfully!']);
    }
    public function prints($id)
    {
        $this->authorize('print-gate-pass');
        $gp = GatePass::find($id);
        return view('gatepass.print', compact('gp'));
    }
}
