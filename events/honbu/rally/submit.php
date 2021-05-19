<?php
require_once('../../../php_helpers/config.php');
require_once('../../../php_helpers/db_helper.php');
$request = isset($_SERVER['HTTP_X_REQUESTED_WITH'])? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
if($request !== 'xmlhttprequest') exit;
$input=file_get_contents("php://input");
$input=json_decode($input,true);
$name=$input[0];
$msg=$input[1];
$count=0;
if(mb_strlen($name)<=10 && mb_strlen($msg)>0 && mb_strlen($msg)<=100){//一応文字数とかのバリデーションをしてる
    $sql="insert into messages(account,msg) value (:account,:msg) ";
    header('Content-type: application/json; charset=utf-8');
    $pdo=get_db_connect();
    $stmt=$pdo->prepare($sql);
    $stmt->bindvalue(':account',$name,PDO::PARAM_STR);
    $stmt->bindvalue(':msg',$msg,PDO::PARAM_STR);
    $stmt->execute();
    $count=$stmt->rowcount();
}
if($count==1){
    $data='メッセージを投稿しました。';
    $send=true;
}else{
    $data='エラーが発生しました。もう一度やり直して下さい。';
    $send=false;
}
echo json_encode($data);
//slack
//Cf.https://api.slack.com/methods/chat.postMessage
if($send===true){
    $url = 'https://slack.com/api/chat.postMessage';//使用するAPI。このあたりはSlackのマニュアルとか参照
 
$post = array(
    "channel"=>"C01RVUSJ2G1",//チャンネルID
    "text"=>"ユーザー名：".$name."\nメッセージ：".$msg//Slackへの投稿内容
);
 
$options = array(
  'http' => array(
    'method'  => 'POST',//推奨はPOSTなので
    'content' => json_encode( $post ),//先ほど作った投稿内容
    'header'=>  "Content-Type: application/json\r\n" .
                "Authorization: Bearer xoxb-1852589012599-1891261069184-jTNa3a0dYf8198aioMo2XlyT\r\n"//xoxb~yTまでがボットトークン。ここだけ書き換えればとりあえず良いはず
                //"Accept: application/json\r\n"//返り値が要らないので消した
    )
);
 
$context  = stream_context_create( $options );//この辺はお約束らしい
$result = file_get_contents( $url, false, $context );
}

?>