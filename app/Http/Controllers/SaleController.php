<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use DB;

class SaleController extends Controller
{
    public function graph(){
        //First Graph
        $items = DB::table('sales')->select('product_line')->distinct()->get();
        $i=0;
        foreach ($items as $item) {
            $prod[$i] = $item;
            $nb[$i] = Sale::where('product_line', $item)->count();
            $i++;
        }
        
        //Second Graph
        $groupFM = Sale::where(['gender' => 'Female', 'customer_type' => 'Member' ])->count();
        $groupMM = Sale::where(['gender' => 'Male', 'customer_type' => 'Member' ])->count();
        $groupFN = Sale::where(['gender' => 'Female', 'customer_type' => 'Normal' ])->count();
        $groupMN = Sale::where(['gender' => 'Male', 'customer_type' => 'Normal' ])->count();
        
        //Third graph
        $femCount = Sale::where('gender', 'Female')->count();
        $MaleCount = Sale::where('gender', 'Male')->count();
        $ratF = DB::table('sales')->where('gender', 'Female')->get()->sum('rating');
        $ratM = DB::table('sales')->where('gender', 'Male')->get()->sum('rating');
        $totalRatF = $ratF/$femCount;
        $totalRatM = $ratM/$MaleCount;
        //dd($femCount, $nbRatF, $totalRatF, $nbRatM, $totalRatM);
        return view('sales.index', compact('nb', 'prod', 'groupFM', 'groupMM', 'groupFN', 'groupMN', 'totalRatF', 'totalRatM'));
    }
}
