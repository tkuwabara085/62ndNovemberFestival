<?php
require_once('../php_helpers/config.php');
require_once('../php_helpers/db_helper.php');
$request = isset($_SERVER['HTTP_X_REQUESTED_WITH'])? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
if($request !== 'xmlhttprequest') exit;
$search=file_get_contents("php://input");
$search=json_decode($search,true);
$type=$search[0];
$sql="select * from plans where name like :type";
header('Content-type: application/json; charset=utf-8');
$pdo=get_db_connect();
$stmt=$pdo->prepare($sql);
$stmt->bindvalue(':type',$type,PDO::PARAM_STR);
$stmt->execute();
$data=array();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $data[]=$row;
}
/*if(count($data)!==1){
    exit;
}else{*/
    echo json_encode($data);
//}

?>