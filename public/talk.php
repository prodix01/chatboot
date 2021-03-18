<?php

// パラメータ取得
$message = (isset($_POST['message'])) ? trim($_POST['message']) : '';
 
// パラメータチェック
if(mb_strlen($message) <= 0) {
    header('HTTP', true, 400);
    exit();
}
 
// APIキーを設定
$apiKey = 'DZZuVlmEsC0w76gkZdPdmmeVuDWOk6JA';
 
// エンドポイントURLを設定
$endPoint = 'https://api.a3rt.recruit-tech.co.jp/talk/v1/smalltalk';
 
// 送信データを作成
$data = [
    'apikey' => $apiKey,
    'query' => $message,
];
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $endPoint);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
 
$responseJsonStr = curl_exec($ch);
 
// エラーチェック
$errorNo = curl_errno($ch);
$errorMsg = curl_error($ch);
if (CURLE_OK !== $errorNo) {
    echo sprintf("[CurlErrorCode: %s] %s", $errorNo, $errorMsg);
}
 
curl_close($ch);
 
// 結果をPHP配列化
$result = json_decode($responseJsonStr, true);
if($result === false || is_null($result)) {
    header('HTTP', true, 500);
    exit();
}
 
// 結果ステータスチェック
if($result['status'] != 0) {
    header('HTTP', true, 500);
    exit();
}
 
// 画面に返す形を作成
$responseText = $result['results'][0]['reply'];
$response = [
    'message' => $responseText,
];
 
// JSON出力
header('content-type: application/json; charset=utf-8');
echo json_encode($response);

exit();