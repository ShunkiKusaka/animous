<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellRequest;
use App\Models\Item;

use Illuminate\Http\Request;
use App\Models\PrimaryCategory;
use App\Models\ItemCondition;

use Illuminate\Support\Facades\Auth;

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

    public function sellItem(SellRequest $request)//バリデーションメッセージの日本語化
    {
        $user = Auth::user();

        $item                        = new Item();
        $item->seller_id             = $user->id;
        $item->name                  = $request->input('name');
        $item->description           = $request->input('description');
        $item->secondary_category_id = $request->input('category');
        $item->item_condition_id     = $request->input('condition');
        $item->price                 = $request->input('price');
        $item->state                 = Item::STATE_SELLING;//募集中
        $item->save();//DB保存

        return redirect()->back()->with('status', '商品を出品しました。');
    }
}
