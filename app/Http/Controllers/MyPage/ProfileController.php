<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Mypage\Profile\EditRequest;
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

    public function editProfile(EditRequest $request)
    {
        $user = Auth::user();//ログインしているユーザの情報を取得

        $user->name = $request->input('name');//取得したいinputタグのname属性の値
        $user->save();//DBに保存

        return redirect()->back()//直前のページにリダイレクトするレスポンスを生成
            ->with('status', 'プロフィールを変更しました。');//セッションに値を保存
    }
}
