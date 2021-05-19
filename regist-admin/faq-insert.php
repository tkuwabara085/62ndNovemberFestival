<?php
require_once('../php_helpers/config.php');
require_once('../php_helpers/db_helper.php');
$request = isset($_SERVER['HTTP_X_REQUESTED_WITH'])? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
if($request !== 'xmlhttprequest') exit;
$faq=file_get_contents("php://input");
$faq=json_decode($faq,true);
$question=$faq[0];
$answer=$faq[1];
$plans=$faq[2];
$importance=$faq[3];
$sql="insert into FAQ (id,question,answer,type,importance) value(null,:question,:answer,:type,:importance)";
header('Content-type: application/json; charset=utf-8');
$pdo=get_db_connect();
$stmt=$pdo->prepare($sql);
$stmt->bindvalue(':question',$question,PDO::PARAM_STR);
$stmt->bindvalue(':answer',$answer,PDO::PARAM_STR);
$stmt->bindvalue(':type',$plans,PDO::PARAM_STR);
$stmt->bindvalue(':importance',$importance,PDO::PARAM_STR);
$stmt->execute();
$count=$stmt->rowcount();
echo json_encode($count);
?>