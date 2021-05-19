<?php
require_once('../../../../php_helpers/config.php');
require_once('../../../../php_helpers/db_helper.php');
$request = isset($_SERVER['HTTP_X_REQUESTED_WITH'])? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
if($request !== 'xmlhttprequest') exit;
$search=file_get_contents("php://input");
$search=json_decode($search,true);
$keyword=$search[0];
header('Content-type: application/json; charset=utf-8');
$pdo=get_db_connect();
    $sql="select * from messages where account like :keyword or msg like :keyword";
    $stmt=$pdo->prepare($sql);
    $stmt->bindvalue(':keyword','%'.$keyword.'%',PDO::PARAM_STR);
$stmt->execute();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $data[]=$row;
}
echo json_encode($data);
?>