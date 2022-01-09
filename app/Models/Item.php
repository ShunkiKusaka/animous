<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // 募集中
    const STATE_SELLING = 'selling';
    // 締め切り済み
    const STATE_BOUGHT = 'bought';

    public function secondaryCategory()
    {
        return $this->belongsTo(SecondaryCategory::class);
        //商品とカテゴリの間の1対多のリレーションを定義
    }

    public function seller()//動物に紐づく投稿者の状態を取得
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function condition()//動物に紐づく動物の状態を取得
    {
        return $this->belongsTo(ItemCondition::class, 'item_condition_id');
    }

    public function getIsStateSellingAttribute()
    {
        return $this->state === self::STATE_SELLING;
    }

    public function getIsStateBoughtAttribute()
    {
        return $this->state === self::STATE_BOUGHT;
    }
}
