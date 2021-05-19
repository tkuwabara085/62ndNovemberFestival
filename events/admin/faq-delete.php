<?php
require_once('../../php_helpers/config.php');
require_once('../../php_helpers/db_helper.php');
$request = isset($_SERVER['HTTP_X_REQUESTED_WITH'])? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
if($request !== 'xmlhttprequest') exit;
$faq=file_get_contents("php://input");
$faq=json_decode($faq,true);
$code=$faq[0];
$pass=$faq[1];
$id=$faq[2];
$sql="delete from qanda where id =:id";
header('Content-type: application/json; charset=utf-8');
$auth=check_pass($code,$pass);
if($auth==1){
    $pdo=get_db_connect();
    $stmt=$pdo->prepare($sql);
    $stmt->bindValue(':id',$id,PDO::PARAM_STR);
    $stmt->execute();
    $count=$stmt->rowcount();
}else{
    $count=0;
}
echo json_encode($count);
?>