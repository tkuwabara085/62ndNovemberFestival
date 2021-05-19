<?php
require_once('../../php_helpers/config.php');
require_once('../../php_helpers/db_helper.php');
$request = isset($_SERVER['HTTP_X_REQUESTED_WITH'])? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
if($request !== 'xmlhttprequest') exit;
$faq=file_get_contents("php://input");
$faq=json_decode($faq,true);
$code=$faq[0];
$pass=$faq[1];
$question=$faq[2];
$answer=$faq[3];
$importance=$faq[4];
$sql="insert into qanda (id,code,question,answer,importance) value(null,:code,:question,:answer,:importance)";
header('Content-type: application/json; charset=utf-8');
$auth=check_pass($code,$pass);
if($auth==1){
    $pdo=get_db_connect();
    $stmt=$pdo->prepare($sql);
    $stmt->bindValue(':question',$question,PDO::PARAM_STR);
    $stmt->bindValue(':answer',$answer,PDO::PARAM_STR);
    $stmt->bindValue(':code',$code,PDO::PARAM_STR);
    $stmt->bindValue(':importance',$importance,PDO::PARAM_STR);
    $stmt->execute();
    $count=$stmt->rowcount();
}else{
    $count=0;
}
echo json_encode($count);
?>