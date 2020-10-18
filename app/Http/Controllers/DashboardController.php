<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Storeorder;
use DB;
use Carbon\Carbon;
use Carbon\Carbonperiod;

class DashboardController extends Controller
{
    public function index()
    {
        $user_id = Session::get('user_id');
        $buktitransfer = Storeorder::select(
                            DB::raw('count(*) as totalrecordbukti'),
                            DB::raw('sum(price_product * qty) as totalpricebukti')
                         )
                         ->where('seller_user_id', '=', $user_id)
                         ->where('status', '=', 1)
                         ->first();
        $totpemapp     = Storeorder::select(
                            DB::raw('count(*) as totalrecordapp'),
                            DB::raw('sum(price_product * qty) * sum(qty) as totalpriceapp')
                         )
                         ->where('seller_user_id', '=', $user_id)
                         ->where('status', '=', 3)
                         ->first();
        $minmaxdate   = Storeorder::select(
                            DB::raw('min(datetime) as mindate'), 
                            DB::raw('max(datetime) as maxdate')
                        )
                        ->where('datetime', '>=', DB::raw('DATE_SUB(NOW(),INTERVAL 1 YEAR)'))
                        ->first();
        $totpemappgraphic = Storeorder::select(
                            DB::raw('count(*) as totalrecordapp'),
                            DB::raw('sum(price_product * qty) * sum(qty) as totalpriceapp'),
                            'datetime'
                         )
                         ->where('seller_user_id', '=', $user_id)
                         ->where('status', '=', 3)
                         ->groupBy(DB::raw('month(datetime)'))
                         ->get();
        $datenow = Carbon::now('GMT+7');
        $period = CarbonPeriod::create($minmaxdate->mindate, '1 month', $datenow);
        $price = array();
        $datetot = array();
        foreach($period as $dt):
            foreach($totpemappgraphic as $totgraph):
                if(date_format(date_create($totgraph->datetime), 'M-y') === $dt->format('M-y')):
                    $price[] .= $totgraph->totalpriceapp;
                    $datetot[] .= date_format(date_create($totgraph->datetime), 'M-y');
                endif;
            endforeach;
            if(!in_array($dt->format('M-y'), $datetot)): 
                $price[] .= 0;
            endif;
        endforeach;
        $implodeprice = implode(',', $price);
        return view('pages.dashboard', compact('buktitransfer', 'totpemapp', 'period', 'totpemappgraphic', 'implodeprice'));
    }
}
