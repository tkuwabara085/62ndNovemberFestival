<?php
require_once('../php_helpers/config.php');
require_once('../php_helpers/db_helper.php');
$request = isset($_SERVER['HTTP_X_REQUESTED_WITH'])? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
if($request !== 'xmlhttprequest') exit;
$faq=file_get_contents("php://input");
$faq=json_decode($faq,true);
$id=$faq[0];
$question=$faq[1];
$answer=$faq[2];
$plans=$faq[3];
$importance=$faq[4];
$sql="update FAQ  set question=:question,answer=:answer,type=:type,importance=:importance where id=:id";
header('Content-type: application/json; charset=utf-8');
$pdo=get_db_connect();
$stmt=$pdo->prepare($sql);
$stmt->bindvalue(':id',$id,PDO::PARAM_STR);
$stmt->bindvalue(':question',$question,PDO::PARAM_STR);
$stmt->bindvalue(':answer',$answer,PDO::PARAM_STR);
$stmt->bindvalue(':type',$plans,PDO::PARAM_STR);
$stmt->bindvalue(':importance',$importance,PDO::PARAM_STR);
$stmt->execute();
$count=$stmt->rowcount();
echo json_encode($count);
?>