require('./bootstrap');

document.querySelector('.image-picker input')//画像を選択するinputタグのDOMを取得
.addEventListener('change', (e) => {
    const input = e.target;//イベントが発生したDOMを取得
    const reader = new FileReader();
    reader.onload = (e) => {//画像の読み込みが完了したタイミングでこの関数が実行
        input.closest('.image-picker').querySelector('img').src = e.target.result
        //imgタグのsrc属性を更新するために、imgタグのDOMを取得
        //読み込んだ結果をimgタグのsrcフィールドに代入
        //読み込んだ結果(e.target.result)には画像データをbase64エンコードしてData URL形式にした文字列が格納
    };
    reader.readAsDataURL(input.files[0]);//inputタグのDOMのfilesフィールドに格納されている、Fileオブジェクトを指定
});