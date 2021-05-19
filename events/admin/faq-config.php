<?php
require_once('../../php_helpers/config.php');
require_once('../../php_helpers/db_helper.php');
$request = isset($_SERVER['HTTP_X_REQUESTED_WITH'])? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
if($request !== 'xmlhttprequest') exit;
$search=file_get_contents("php://input");
$search=json_decode($search,true);
$code=$search[0];
$pass=$search[1];
$keyword=$search[2];
header('Content-type: application/json; charset=utf-8');
$auth=check_pass($code,$pass);
if($auth==1){
    $pdo=get_db_connect();
    $sql="select * from qanda where code like :code and (question like :keyword or answer like :keyword)";
    $stmt=$pdo->prepare($sql);
    $stmt->bindValue(':keyword','%'.$keyword.'%',PDO::PARAM_STR);
    $stmt->bindValue(':code','%'.$code.'%',PDO::PARAM_STR);
    $stmt->execute();
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        $data[]=$row;
    }
}else{
    $data=array();
}
echo json_encode($data);
?>