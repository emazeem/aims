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
        $account=Chartofaccount::where('acc_code',$request->account)->first();
        $opening_balance=$account->opening_balance;
        $dates=null;
        $closing=0;
        if ($request->daterange) {
            $dates=explode('-',$request->daterange);
            $dates[0]=date('Y-m-d',strtotime($dates[0]));
            $dates[1]=date('Y-m-d',strtotime($dates[1]));
            $entries = JournalDetails::where('acc_code',$request->account)->whereHas('parent', function($q) use($dates){
                $q->where('date','>=',$dates[0])->where('date','<=',$dates[1]);
            })->get();
            $opening = JournalDetails::where('acc_code',$request->account)->whereHas('parent', function($q) use($dates){
                $q->where('date','<',$dates[0]);
            })->get();
            $closing = JournalDetails::where('acc_code',$request->account)->whereHas('parent', function($q) use($dates){
                $q->where('date','>',$dates[1]);
            })->get();

            foreach ($opening as $item){
                if (isset($item->dr)){
                    $opening_balance=$opening_balance+$item->dr;
                }
                if (isset($item->cr)){
                    $opening_balance=$opening_balance-$item->cr;
                }
            }

        }else{
            $entries = JournalDetails::where('acc_code',$request->account)->get();
        }
        return view('journal.ledger',compact('entries','account','dates','opening_balance','closing'));
    }
    public function income(Request $request){

        if ($request->daterange){
            $dates=explode('-',$request->daterange);
            $dates[0]=date('Y-m-d',strtotime($dates[0]));
            $dates[1]=date('Y-m-d',strtotime($dates[1]));
            $accounts=AccLevelOne::with('leveltwo')
                ->whereIn('code1',[4,5])
                ->get();
            foreach ($accounts as $account){
                foreach ($account->leveltwo as $value){
                    foreach ($value->levelthree as $item) {
                        $chartofaccounts= Chartofaccount::where('code3',$item->id)->get();
                        foreach ($chartofaccounts as $chartofaccount){
                            $balances[$chartofaccount->acc_code]=0;
                            $dr=$chartofaccount->opening_balance;$cr=0;
                            $journals = JournalDetails::where('acc_code',$chartofaccount->acc_code)->whereHas('parent', function($q) use($dates){
                                $q->where('date','>=',$dates[0])->where('date','<=',$dates[1]);
                            })->get();
                            foreach ($journals as $journal){
                                if ($journal->dr){
                                    $dr=$dr+$journal->dr;
                                }
                                if ($journal->cr){
                                    $cr=$cr+$journal->cr;
                                }
                            }
                            $balances[$chartofaccount->acc_code]=$dr-$cr;
                        }
                    }
                }
            }
        }
        else{
            $accounts=AccLevelOne::with('leveltwo')
                ->whereIn('code1',[4,5])
                ->get();
            foreach ($accounts as $account){
                foreach ($account->leveltwo as $value){
                    foreach ($value->levelthree as $item) {
                        $chartofaccounts= Chartofaccount::where('code3',$item->id)->get();
                        foreach ($chartofaccounts as $chartofaccount){
                            $balances[$chartofaccount->acc_code]=0;
                            $dr=$chartofaccount->opening_balance;$cr=0;
                            $journals = JournalDetails::where('acc_code',$chartofaccount->acc_code)->get();
                            foreach ($journals as $journal){
                                if ($journal->dr){
                                    $dr=$dr+$journal->dr;
                                }
                                if ($journal->cr){
                                    $cr=$cr+$journal->cr;
                                }
                            }
                            $balances[$chartofaccount->acc_code]=$dr-$cr;
                        }
                    }
                }
            }
        }


        return view('journal.income',compact('accounts','balances'));
    }

    public function trail_balance(Request $request){

        //dd($request->all());
        $dates=null;
        if ($request->daterange){
            $dates=explode('-',$request->daterange);
            $dates[0]=date('Y-m-d',strtotime($dates[0]));
            $dates[1]=date('Y-m-d',strtotime($dates[1]));
            $accounts=Chartofaccount::all();
            foreach ($accounts as $jaccount){
                $dr=$jaccount->opening_balance;$cr=0;
                $temps = JournalDetails::where('acc_code',$jaccount->acc_code)->whereHas('parent', function($q) use($dates){
                    $q->where('date','>=',$dates[0])->where('date','<=',$dates[1]);
                })->get();

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
        }else{
            $accounts=Chartofaccount::all();
            foreach ($accounts as $jaccount){
                $dr=$jaccount->opening_balance;$cr=0;
                $temps =JournalDetails::where('acc_code',$jaccount->acc_code)->get();
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
        }

        return view('journal.trailbalance',compact('dates','accounts','entries'));
    }



    public function balance_sheet(Request $request){

        if ($request->daterange){
            $dates=explode('-',$request->daterange);
            $dates[0]=date('Y-m-d',strtotime($dates[0]));
            $dates[1]=date('Y-m-d',strtotime($dates[1]));
            $accounts=AccLevelOne::with('leveltwo')
                ->whereIn('code1',[1,2,3])
                ->get();
            foreach ($accounts as $account){
                foreach ($account->leveltwo as $value){
                    foreach ($value->levelthree as $item) {
                        $chartofaccounts= Chartofaccount::where('code3',$item->id)->get();
                        foreach ($chartofaccounts as $chartofaccount){
                            $balances[$chartofaccount->acc_code]=0;
                            $dr=$chartofaccount->opening_balance;$cr=0;
                            $journals = JournalDetails::where('acc_code',$chartofaccount->acc_code)->whereHas('parent', function($q) use($dates){
                                $q->where('date','>=',$dates[0])->where('date','<=',$dates[1]);
                            })->get();
                            foreach ($journals as $journal){
                                if ($journal->dr){
                                    $dr=$dr+$journal->dr;
                                }
                                if ($journal->cr){
                                    $cr=$cr+$journal->cr;
                                }
                            }
                            $balances[$chartofaccount->acc_code]=$dr-$cr;
                        }
                    }
                }
            }
        }
        else{
            $accounts=AccLevelOne::with('leveltwo')
                ->whereIn('code1',[1,2,3])
                ->get();
            foreach ($accounts as $account){
                foreach ($account->leveltwo as $value){
                    foreach ($value->levelthree as $item) {
                        $chartofaccounts= Chartofaccount::where('code3',$item->id)->get();
                        foreach ($chartofaccounts as $chartofaccount){
                            $balances[$chartofaccount->acc_code]=0;
                            $dr=$chartofaccount->opening_balance;$cr=0;
                            $journals = JournalDetails::where('acc_code',$chartofaccount->acc_code)->get();
                            foreach ($journals as $journal){
                                if ($journal->dr){
                                    $dr=$dr+$journal->dr;
                                }
                                if ($journal->cr){
                                    $cr=$cr+$journal->cr;
                                }
                            }
                            $balances[$chartofaccount->acc_code]=$dr-$cr;
                        }
                    }
                }
            }
        }


        return view('journal.balance_sheet',compact('accounts','balances'));
    }

}