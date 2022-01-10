<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function showBuyItemForm(Item $item)
    {
        if (!$item->isStateSelling) {
            abort(404);
        }

        return view('items.item_buy_form')
            ->with('item', $item);
    }

    //商品を購入する処理
    public function buyItem(Request $request, Item $item)
    {
        $user = Auth::user();

        if (!$item->isStateSelling) {
            abort(404);
        }

        $token = $request->input('card-token');

        try {
            $this->settlement($item->id, $item->seller->id, $user->id, $token);//決済処理
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()
                ->with('type', 'danger')
                ->with('message', '購入処理が失敗しました。');
        }

        return redirect()->route('item', [$item->id])
            ->with('message', '商品を購入しました。');
    }

    //決済メソッド
    //商品データに購入者や購入日時を記録し、会員データに売り上げ金額を記録し、トランザクションをコミット
    private function settlement($itemID, $sellerID, $buyerID, $token)
    {
        DB::beginTransaction();

        try {
            $seller = User::lockForUpdate()->find($sellerID);//レコードを排他ロック
            $item   = Item::lockForUpdate()->find($itemID);//レコードを排他ロック

            if ($item->isStateBought) {
                throw new \Exception('多重決済');
            }

            $item->state     = Item::STATE_BOUGHT;
            $item->bought_at = Carbon::now();
            $item->buyer_id  = $buyerID;
            $item->save();

            $seller->sales += $item->price;
            $seller->save();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
    }
}
