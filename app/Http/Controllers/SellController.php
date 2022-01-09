<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrimaryCategory;
use App\Models\ItemCondition;

class SellController extends Controller
{
    public function showSellForm()
    {
        $categories = PrimaryCategory::query()
            ->with([//Eager Loding
                'secondaryCategories' => function ($query) {
                    $query->orderBy('sort_no');
                }//PrimaryCategoryのレコードを取得した後に、紐づくSecondaryCategoryのレコードをまとめて取得
            ])
            ->orderBy('sort_no')
            ->get();

        $conditions = ItemCondition::orderBy('sort_no')->get();//商品の状態を取得 | getメソッドでクエリを発行

        return view('sell')
        ->with('categories', $categories)
        ->with('conditions', $conditions);
    }
}
