<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function showItems(Request $request)
    {
        $query = Item::query();
 
        // カテゴリで絞り込み
        if ($request->filled('category')) {//categoryという名前のパラメータが指定されているかどうかを調べる
            list($categoryType, $categoryID) = explode(':', $request->input('category'));//分割代入

            if ($categoryType === 'primary') {
                $query->whereHas('secondaryCategory', function ($query) use ($categoryID) {//リレーション先のテーブルのカラムを基に絞り込む
                    $query->where('primary_category_id', $categoryID);
                });
                //無名関数（クロージャ）でリレーション先のテーブルに対する絞り込みを行う
            } else if ($categoryType === 'secondary') {
                $query->where('secondary_category_id', $categoryID);
            }
            //secandary_category_idはitemテーブルにあるが、primarycategory_idはitemにはなく
            //リレーション先のsecandary_categoriesの中にあるから、絞り込むときはwhereHas()を使う
        }

        // キーワードで絞り込み
        if ($request->filled('keyword')) {
            $keyword = '%' . $this->escape($request->input('keyword')) . '%';
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', $keyword);
                $query->orWhere('description', 'LIKE', $keyword);
            });
        }

        $items = $query->orderByRaw( "FIELD(state, '" . Item::STATE_SELLING . "', '" . Item::STATE_BOUGHT . "')" )//出品中の商品を先に、購入済みの商品を後に表示
            ->orderBy('id', 'DESC')//さらにidの降順（最近出品された順）で並べ替え
            ->get();

        return view('items.items')
            ->with('items', $items);
    }

    private function escape(string $value)//特殊文字をエスケープ
    {
        return str_replace(
            ['\\', '%', '_'],
            ['\\\\', '\\%', '\\_'],
            $value
        );
    }

    public function showItemDetail(Item $item)
    {
        return view('items.item_detail')
            ->with('item', $item);
    }
}
