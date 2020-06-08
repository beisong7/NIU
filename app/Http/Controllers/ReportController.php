<?php

namespace App\Http\Controllers;

use App\Models\Cashflow;
use App\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //

    public function index(){
        return view('pages.admin.report.index');
    }

    public function summary($year){
        $start = strtotime("$year-01-01");
        $end = strtotime('today');
        $k = 60 * 60 * 24 * 31;

        $months = array();
        $leads = array();
        $opportunity = array();
        $sales = array();

        while ($end > $start){
            array_push($months, date('M', $start));

            $lead = User::where('status', 'lead')
                ->where('created_at', '>=', date('Y-m-d h:i:s', $start))
                ->where('created_at', '<', date('Y-m-d h:i:s', $start+$k))
                ->get()->count();
            array_push($leads, $lead);

            $opp = User::where('status', 'opportunity')
                ->where('created_at', '>=', date('Y-m-d h:i:s', $start))
                ->where('created_at', '<', date('Y-m-d h:i:s', $start+$k))
                ->get()->count();
            array_push($opportunity, $opp);

            $sale = User::where('status', 'outright sale')
                ->where('created_at', '>=', date('Y-m-d h:i:s', $start))
                ->where('created_at', '<', date('Y-m-d h:i:s', $start+$k))
                ->get()->count();
            array_push($sales, $sale);

            $start+=$k;
        }

        return [
            $months,
            $leads,
            $opportunity,
            $sales,
        ];

    }

    public function financial($start, $end){
        $start = strtotime($start);
        $end = strtotime($end);
        $k = 60 * 60 * 24 * 31;

        $months = array();
        $opportunity = array();
        $sales = array();

        while ($end > $start){
            array_push($months, date('M', $start));
            $amountA = 0;
            $amountB = 0;
            $opp = Cashflow::where('type', 'opportunity')
                ->where('created_at', '>=', date('Y-m-d h:i:s', $start))
                ->where('created_at', '<', date('Y-m-d h:i:s', $start+$k))
                ->get();
            foreach ($opp as $cash){
                $amountA += $cash->amount;
            }
            array_push($sales, $amountA);

            $sale = Cashflow::where('type', 'outright sale')
                ->where('created_at', '>=', date('Y-m-d h:i:s', $start))
                ->where('created_at', '<', date('Y-m-d h:i:s', $start+$k))
                ->get();
            foreach ($sale as $cash){
                $amountB += $cash->amount;
            }
            array_push($opportunity, $amountB);

            $start+=$k;
        }

        return [
            $months,
            $opportunity,
            $sales,
        ];

    }

    public function financialUpdate(Request $request){
        $start = $request->input('start');
        $end = $request->input('end');
        $start = intval($start);
        $end = intval($end);
        $k = 60 * 60 * 24 * 31;

        $months = array();
        $opportunity = array();
        $sales = array();

        while ($end > $start){
            array_push($months, date('M', $start));
            $amountA = 0;
            $amountB = 0;
            $opp = Cashflow::where('type', 'opportunity')
                ->where('created_at', '>=', date('Y-m-d h:i:s', $start))
                ->where('created_at', '<', date('Y-m-d h:i:s', $start+$k))
                ->get();
            foreach ($opp as $cash){
                $amountA += $cash->amount;
            }
            array_push($sales, $amountA);

            $sale = Cashflow::where('type', 'outright sale')
                ->where('created_at', '>=', date('Y-m-d h:i:s', $start))
                ->where('created_at', '<', date('Y-m-d h:i:s', $start+$k))
                ->get();
            foreach ($sale as $cash){
                $amountB += $cash->amount;
            }
            array_push($opportunity, $amountB);

            $start+=$k;
        }

        return [
            $months,
            $opportunity,
            $sales,
        ];

    }
}
