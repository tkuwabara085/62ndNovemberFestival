<?php
require_once('../php_helpers/config.php');
require_once('../php_helpers/db_helper.php');
$request = isset($_SERVER['HTTP_X_REQUESTED_WITH'])? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
if($request !== 'xmlhttprequest') exit;
$edit=file_get_contents("php://input");
$edit=json_decode($edit,true);
$id=$edit[0];
$explanation=$edit[1];
$need=$edit[2];
$date=$edit[3];
$sql="update plans set explanation= :explanation,need=:need,date=:date where id=:id";
header('Content-type: application/json; charset=utf-8');
$pdo=get_db_connect();
$stmt=$pdo->prepare($sql);
$stmt->bindvalue(':id',$id,PDO::PARAM_STR);
$stmt->bindvalue(':explanation',$explanation,PDO::PARAM_STR);
$stmt->bindvalue(':need',$need,PDO::PARAM_STR);
$stmt->bindvalue(':date',$date,PDO::PARAM_STR);
$stmt->execute();
$count=$stmt->rowcount();
echo json_encode($count);
?>