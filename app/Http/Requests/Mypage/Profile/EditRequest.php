<?php

namespace App\Http\Requests\Mypage\Profile;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()//リソースを操作する権限を持っているかを調べる
    {
        return true;//権限があればtrue,なければfalse
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'avatar' => ['file', 'image'],//ファイルかどうか | jpeg, png, bmp, gif, svg, webpのいずれかのファイルであることを検証
            'name' => ['required', 'string', 'max:255'],
        ];
    }
}
