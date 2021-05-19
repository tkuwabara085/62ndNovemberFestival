<?php
require_once('../php_helpers/config.php');
require_once('../php_helpers/db_helper.php');
$request = isset($_SERVER['HTTP_X_REQUESTED_WITH'])? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
if($request !== 'xmlhttprequest') exit;
$search=file_get_contents("php://input");
$search=json_decode($search,true);
$text=$search[0];
$text_a = mb_convert_kana($text, "a", "utf-8");
$text_A = mb_convert_kana($text, "A", "utf-8");
$sql="select * from search left join shop on search.shop=shop.shopcode left join live on search.live=live.livecode";
header('Content-type: application/json; charset=utf-8');
$pdo=get_db_connect();
$stmt=$pdo->prepare($sql);
$stmt->execute();
$data=array();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $data[]=$row;
}
$result=array();
foreach($data as $arr){
    $code=$arr['ecode'];
    if(stripos($code,'H')!==false){//本部企画は処理を分離
        $honbulist=array(
            'H-001'=>'lecture.html',
            'H-002'=>'labs.html',
            'H-003'=>'map.html',
            'H-004'=>'rally.php',
            'H-005'=>'radio.html',
            'H-006'=>'shop.html#goods',
        );
        $url="/events/honbu/".$honbulist[$code];
    }else{
        $url="/events/search/index.php?c=".$code;
    }
    if($code==$arr['exhibition']){
        $type="exhibition";
        $date="全日";
    }elseif($code==$arr['shop']){
        $type="shop";
        $date="全日";
    }elseif($code==$arr['live']){
        $type="live";
        $date=$arr['datetime_text'];
    }else{$type="";}
    $array=array(
        'code'=>$code,
        'type'=>$type,
        'main'=>$arr['main'],
        'sub'=>$arr['sub'],
        'date'=>$date,
        'title'=>$arr['event_name'],
        'group'=>$arr['group_name'],
        'title_kana'=>$arr['event_name_kana'],
        'group_kana'=>$arr['group_name_kana'],
        'message'=>$arr['message'],
        'url'=>$url,
    );
    $result[]=$array;
}
$wordresult=array();
if($text==""){
    $wordresult=$result;
}else{
    $first=array();
    $second=array();
    $third=array();
    foreach($result as $line){
        $target=$line['title'];
        if(stripos($target,$text)!==false||stripos($target,$text_a)!==false||stripos($target,$text_A)!==false){
           $first[]=$line;
        }else{
            $target=$line['title_kana'].','.$line['group'].','.$line['group_kana'];
            if(stripos($target,$text)!==false||stripos($target,$text_a)!==false||stripos($target,$text_A)!==false){
                $second[]=$line;
            }else{
                $target=$line['code'].','.$line['date'].','.$line['message'];
                if(stripos($target,$text)!==false||stripos($target,$text_a)!==false||stripos($target,$text_A)!==false){
                    $third[]=$line;
                }
            }
        }
    }
    $wordresult=array_merge($first,$second,$third);
}

echo json_encode($wordresult);

?>