require('./bootstrap');

//font-awesomeの画像8つを読み込み
import { library, dom } from '@fortawesome/fontawesome-svg-core'
import { faAddressCard, faClock } from '@fortawesome/free-regular-svg-icons'
import { faSearch, faStoreAlt, faShoppingBag, faSignOutAlt, faYenSign, faCamera } from '@fortawesome/free-solid-svg-icons'

library.add(faSearch, faAddressCard, faStoreAlt, faShoppingBag, faSignOutAlt, faYenSign, faClock, faCamera);

dom.watch();

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