<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemCondition;

class SellController extends Controller
{
    public function showSellForm()
    {
        $conditions = ItemCondition::orderBy('sort_no')->get();//商品の状態を取得 | getメソッドでクエリを発行

        return view('sell')->with('conditions', $conditions);
    }
}
