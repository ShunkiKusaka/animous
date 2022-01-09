<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrimaryCategory;
use App\Models\ItemCondition;

class SellController extends Controller
{
    public function showSellForm()
    {
        $categories = PrimaryCategory::orderBy('sort_no')->get();
        $conditions = ItemCondition::orderBy('sort_no')->get();//商品の状態を取得 | getメソッドでクエリを発行

        return view('sell')
        ->with('categories', $categories)
        ->with('conditions', $conditions);
    }
}
