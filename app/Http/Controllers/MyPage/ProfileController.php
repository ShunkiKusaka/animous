<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Mypage\Profile\EditRequest;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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

        if ($request->has('avatar')) {//アバター画像が指定されている場合 | 第一引数はinputのname属性
            $fileName = $this->saveAvatar($request->file('avatar'));//アバター画像をストレージに保存 | 返り値はUploadedFileクラスのインスタンス 後ほど
            $user->avatar_file_name = $fileName;//ファイル名をDBに保存
        }

        $user->save();//DBに保存

        return redirect()->back()//直前のページにリダイレクトするレスポンスを生成
            ->with('status', 'プロフィールを変更しました。');//セッションに値を保存
    }

    /**
    * アバター画像をリサイズして保存
    *
    * @param UploadedFile $file アップロードされたアバター画像
    * @return string ファイル名
    */
    private function saveAvatar(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();//一時ファイルを生成してパスを取得 後ほど

        Image::make($file)->fit(200, 200)->save($tempPath);//Intervention Imageを使用して、画像をリサイズ後、一時ファイルに保存
        //第一引数には画像を保存するパス
        $filePath = Storage::disk('public')//Storageファサードを使用して画像をディスクに保存 利用者が閲覧できる画像をローカルに保存するためpublicを使用
            ->putFile('avatars', new File($tempPath));//画像を保存

        return basename($filePath);
    }

    /**
    * 一時的なファイルを生成してパスを返します。
    *
    * @return string ファイルパス
    */
    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();//一時ファイルを生成 ファイルポインタが返ってくる
        $meta   = stream_get_meta_data($tmp_fp);//ファイルのメタ情報を取得 | 返り値はメタ情報が格納された連想配列
        return $meta["uri"];//メタ情報からURI(ファイルのパス)を取得し、返す
    }
}
