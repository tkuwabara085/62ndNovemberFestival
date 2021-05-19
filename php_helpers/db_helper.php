<?php

function get_db_connect() {
try{
    $dsn = DSN;
    $user = DB_USER;
    $password = DB_PASSWORD;

    $dbh = new PDO($dsn, $user, $password);
    }catch (PDOException $e){
       echo($e->getMessage());
       die();
    }
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

//面倒くさいのでescapeする関数をここに定義
function h($str){
    return htmlspecialchars($str,ENT_QUOTES,"UTF-8");
}
function check_pass($code,$pass){//Q&Aのコードとパスワードの認証
    $pdo=get_db_connect();
    $sql='select * from answerpass where code = :code limit 1';
    $stmt=$pdo->prepare($sql);
    $stmt->bindValue(':code',$code,PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $password=$row['pass'];
    if(password_verify($pass,$password)){
        $count=1;
    }else{
        $count=0;
    }
    return $count;
}