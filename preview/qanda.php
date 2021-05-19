<?php
require_once('../php_helpers/config.php');
require_once('../php_helpers/db_helper.php');
$request = isset($_SERVER['HTTP_X_REQUESTED_WITH'])? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
if($request !== 'xmlhttprequest') exit;
$search=file_get_contents("php://input");
$search=json_decode($search,true);
$code=$search[0];
$keyword=$search[1];
$sql="select * from qanda where code = :code and (question like :keyword or answer like :keyword) order by importance desc";
header('Content-type: application/json; charset=utf-8');
$pdo=get_db_connect();
$stmt=$pdo->prepare($sql);
$stmt->bindvalue(':code',$code,PDO::PARAM_STR);
$stmt->bindvalue(':keyword','%'.$keyword.'%',PDO::PARAM_STR);
$stmt->execute();
$data=array();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $data[]=$row;
}
echo json_encode($data);
?>