<?php
namespace App\Http\Controllers;
use App\Models\AccLevelOne;
use App\Models\Chartofaccount;
use App\Models\Journal;
use App\Models\JournalDetails;
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
        $data=JournalDetails::with('parent')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('customize_id', function ($data) {
                return $data->parent->customize_id;
            })
            ->addColumn('acc_id', function ($data) {
                return $data->acc_code;
            })
            ->addColumn('acc_title', function ($data) {
                $account=Chartofaccount::where('acc_code',$data->acc_code)->first();
                return $account->title;
            })
            ->addColumn('type', function ($data) {
                return ucwords(str_replace('-',' ',$data->parent->type));
            })

            ->addColumn('date', function ($data) {
                return $data->parent->date->format('d-M-Y');
                //return $data->v_date->format('d-M-Y');
            })
            ->addColumn('dr', function ($data) {
                return $data->dr;
            })
            ->addColumn('cr', function ($data) {
                return $data->cr;
            })
            ->addColumn('created_by', function ($data) {
                return $data->parent->createdby->fname.' '.$data->parent->createdby->lname;
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
    public function income(Request $request){
        $validator = Validator::make($request->all(), [
            'daterange' => 'required'
        ]);
        if ($validator->fails()) {
            return  redirect()->back()->with('failed', 'Please select date range');
        }
        $dates=explode('-',$request->daterange);
        $dates[0]=date('Y-m-d',strtotime($dates[0]));
        $dates[1]=date('Y-m-d',strtotime($dates[1]));
        $accounts=AccLevelOne::with('leveltwo')
            ->whereIn('code1',[2,1])
            ->get();
        foreach ($accounts as $account){
            foreach ($account->leveltwo as $value){
                foreach ($value->levelthree as $item) {
                    $chartofaccounts= Chartofaccount::where('code3',$item->id)->get();
                    $dr=0;$cr=0;
                    foreach ($chartofaccounts as $chartofaccount){
                        $journals=Journal::where('acc_code',$chartofaccount->acc_code)->get();
                        foreach ($journals as $journal){
                            if ($journal->dr){
                                $dr=$dr+$journal->dr;
                            }
                            if ($journal->cr){
                                $cr=$cr+$journal->cr;
                            }
                        }
                    }
                    $three[$item->id]=$dr-$cr;
                }
            }
        }

        return view('journal.income',compact('accounts','three'));
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