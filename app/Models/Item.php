<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // 募集中
    const STATE_SELLING = 'selling';
    // 締め切り済み
    const STATE_BOUGHT = 'bought';
}
