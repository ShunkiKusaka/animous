<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoldItemsController extends Controller
{
    public function showSoldItems()//ログインしているユーザが出品した商品を取得
    {
        $user = Auth::user();

        $items = $user->soldItems()->orderBy('id', 'DESC')->get();

        return view('mypage.sold_items')
            ->with('items', $items);
    }
}
