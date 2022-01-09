<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfileEditForm()
    {
        return view('mypage.profile_edit_form')->with('user', Auth::user());
        //userという変数名でログインしているユーザの情報を'mypage.profile_edit_form'に渡している
        //ログインしている場合は、app\Models\Userのインスタンス（usersテーブルのレコード）を返す
        //ログインしていない場合は、nullを返す
    }
}
