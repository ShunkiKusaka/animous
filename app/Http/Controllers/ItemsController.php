<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function showItems(Request $request)
    {
        $items = Item::orderByRaw( "FIELD(state, '" . Item::STATE_SELLING . "', '" . Item::STATE_BOUGHT . "')" )//出品中の商品を先に、購入済みの商品を後に表示
            ->orderBy('id', 'DESC')//さらにidの降順（最近出品された順）で並べ替え
            ->get();

        return view('items.items')
            ->with('items', $items);
    }

    public function showItemDetail(Item $item)
    {
        return view('items.item_detail')
            ->with('item', $item);
    }
}
