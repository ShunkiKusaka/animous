<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function soldItems()
    {
        return $this->hasMany(Item::class, 'seller_id');
        //1対多のリレーションを定義
        //第二引数には多側のキー(外部キー)であるseller_idを指定
    }

    public function boughtItems()
    {
        return $this->hasMany(Item::class, 'buyer_id');
        //1対多のリレーションを定義
        //商品テーブルの'buyer_id'カラムを取得し、ログインしているユーザーのidと同じ値のものを取得して、表示する
    }
}
