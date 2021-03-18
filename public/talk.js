/*---------------------------------------*/
/* HTML(だけ)の読み込みが完了したら */
/*---------------------------------------*/
window.addEventListener('DOMContentLoaded',()=>{
    //- イベントリスナー登録
    document.getElementById('talkapi__request').addEventListener('click',handler_request_reply);
});

/*---------------------------------------*/
/* 返答をリクエスト */
/*---------------------------------------*/
function handler_request_reply(ev){
    /*---------------------------------------*/
    /* コメント取得 */
    /*---------------------------------------*/
    const comment = document.getElementById('talkapi__input').value;

    /*---------------------------------------*/
    /* レクエストデータ */
    /*---------------------------------------*/
    let formdata = new FormData();
    //- apikeyパラメーター 
    formdata.append('apikey','DZZuVlmEsC0w76gkZdPdmmeVuDWOk6JA');
    //- コメント
    formdata.append('query',comment);

    /*---------------------------------------*/
    /* リクエスト */
    /*---------------------------------------*/
    fetch('https://api.a3rt.recruit-tech.co.jp/talk/v1/smalltalk',{
        method: 'post',
        body: formdata,
    }).then(response => {
        //- レスポンス取得
        response.json().then(data => {
            //- 返答取得
            const reply = data.results[0].reply;
            //- 出力
            document.getElementById('talkapi__reply').innerHTML = reply;
        });
    });

}