<?php
require_once('../../php_helpers/config.php');
require_once('../../php_helpers/db_helper.php');
$pdo=get_db_connect();
$sql="select * from answerpass";
$stmt=$pdo->prepare($sql);
$stmt->execute();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $data[]=$row;
}//getdata
foreach($data as $arr){
    $pass=password_hash($arr['pass'],PASSWORD_DEFAULT);
    $code=$arr['code'];
    $dbc=get_db_connect();
    $update="update answerpass set pass = :pass where code = :code";
    $upstmt=$dbc->prepare($update);
    $upstmt->bindValue(':code',$code,PDO::PARAM_STR);
    $upstmt->bindValue(':pass',$pass,PDO::PARAM_STR);
    $upstmt->execute();
}

?>