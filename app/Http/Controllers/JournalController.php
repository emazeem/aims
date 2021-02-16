<?php
namespace App\Http\Controllers;
use App\Models\AccLevelOne;
use App\Models\Chartofaccount;
use App\Models\Journal;
use     Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
class JournalController extends Controller
{
    public function index(){
        $chartofaccounts=Chartofaccount::all();
        return view('journal.index',compact('chartofaccounts'));
    }

    public function fetch(){
        $data=Journal::with('createdby')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('customize_id', function ($data) {
                return $data->customize_id;
            })
            ->addColumn('acc_id', function ($data) {
                return $data->acc_code;
            })
            ->addColumn('acc_title', function ($data) {
                $account=Chartofaccount::where('acc_code',$data->acc_code)->first();
                return $account->title;
            })
            ->addColumn('type', function ($data) {
                return ucwords(str_replace('-',' ',$data->v_type)).' Voucher';
            })

            ->addColumn('date', function ($data) {
                return $data->date;
                //return $data->v_date->format('d-M-Y');
            })
            ->addColumn('dr', function ($data) {
                return $data->dr;
            })
            ->addColumn('cr', function ($data) {
                return $data->cr;
            })
            ->addColumn('created_by', function ($data) {
                return $data->createdby->fname.' '.$data->createdby->lname;
            })->make(true);
    }
    public function ledger(Request $request){
        $validator = Validator::make($request->all(), [
                'account' => 'required'
            ]);
        if ($validator->fails()) {
            return  redirect()->back()->with('failed', 'Please select account to continue');
        }
        if ($request->daterange) {
            $dates=explode('-',$request->daterange);
            $dates[0]=date('Y-m-d',strtotime($dates[0]));
            $dates[1]=date('Y-m-d',strtotime($dates[1]));
            $entries=Journal::where('acc_code',$request->account)->where('date','>=',$dates[0])->where('date','<=',$dates[1])->get();
        }else{
            $entries=Journal::all()->where('acc_code',$request->account);
        }
        $account=Chartofaccount::where('acc_code',$request->account)->first();
        return view('journal.ledger',compact('entries','account','dates'));
    }
    public function income(){
        $entries=Journal::all();
        return view('journal.income',compact('entries'));
    }
    public function trail_balance(Request $request){
        $validator = Validator::make($request->all(), [
            'daterange' => 'required'
        ]);
        if ($validator->fails()) {
            return  redirect()->back()->with('failed', 'Please select date range');
        }
        $dates=explode('-',$request->daterange);
        $dates[0]=date('Y-m-d',strtotime($dates[0]));
        $dates[1]=date('Y-m-d',strtotime($dates[1]));
        $jaccounts=Journal::distinct()->get('acc_code')->toArray();
        $accounts=Chartofaccount::whereIn('acc_code',$jaccounts)->get();
        foreach ($jaccounts as $jaccount){
            $dr=0;$cr=0;
            $temps=Journal::where('acc_code',$jaccount)->where('date','>=',$dates[0])->where('date','<=',$dates[1])->get();
            foreach ($temps as $temp) {
                if ($temp->dr){
                    $dr=$dr+$temp->dr;
                }
                if ($temp->cr){
                    $cr=$cr+$temp->cr;
                }
            }
            $entries[$jaccount['acc_code']]=$dr-$cr;
        }
        return view('journal.trailbalance',compact('dates','accounts','entries'));
    }
}