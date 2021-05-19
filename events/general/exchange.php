<?php
require_once('../../php_helpers/config.php');
require_once('../../php_helpers/db_helper.php');
$sql="select * from live";
$pdo=get_db_connect();
$stmt=$pdo->prepare($sql);
$stmt->execute();
$data=array();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  $data[]=$row;
}
$today=date('Y-m-d h:i:s','2021-03-26 13:30:00');
$today=strtotime($today);
$table26=array();//ここにタイムテーブルを構成する各要素を挿入していく。3/26分
$table27=array();//ここにタイムテーブルを構成する各要素を挿入していく。3/27分
$table28=array();//ここにタイムテーブルを構成する各要素を挿入していく。3/28分
foreach($data as $arr){
  for($i=1;$i<=5;$i++){   
    if(mb_strlen($arr['time_'.$i.'_url'])>10){
      $start=$arr['time_'.$i.'_start'];
      $end=$arr['time_'.$i.'_end'];
      $start=strtotime($start);
      $end=strtotime($end);
      $startdate=date('Y-m-d',$start);
      $enddate=date('Y-m-d',$end);
      $placedata=$arr['time_'.$i.'_place'];
      $tablerow=array(
        'code'=>$arr['livecode'],
        'related'=>$arr['lrelated'],
        'datetime'=>$arr['datetime_text'],
        'event_name'=>$arr['live_name'],
        'place'=>$arr['time_'.$i.'_place'],
        'start'=>$start,
        'end'=>$end,
        'url'=>$arr['time_'.$i.'_url'],
      );
      if($placedata>2){
        $else=array();
        $else[]=$tablerow;//ここでは使わない
      }elseif($startdate=='2021-03-26'){
        $table26[]=$tablerow;//3/26分のデータを挿入
      }elseif($startdate=='2021-03-27'){
        $table27[]=$tablerow;//3/27分のデータを挿入
      }elseif($startdate=='2021-03-28'){
        $table28[]=$tablerow;//3/28分のデータを挿入
      }      
    }
  }
}
function time_diff($str1,$str2){
  $diff=$str1-$str2;//時間差（秒単位）
  $diff=floor($diff/60);//60なのは10分につき10px単位にしたいから。多分端数が出ることはないけど念のためfloorしてる。
  return $diff;
}
function is_ontime($str1,$str2,$str3){//$str1=$today,$str2=$start_time,$str3=$end_time
  if($str1>$str2&&$str1<$str3){
    return true;
  }else{
    return false;
  }
}
$link26_1="https://us02web.zoom.us/j/88157512560?pwd=S0NQanZKYXM0VWVpcHAvWC9hMENFdz09";
$link27_1="https://us02web.zoom.us/j/84380111679?pwd=QXFMZ3MvRjdabjNXOGtNK2RrTE1rZz09";
$link28_1="https://us02web.zoom.us/j/86472862306?pwd=c1Vsa3hna2I3N2NacTR2cml1a09sdz09";
$link26_2="https://us02web.zoom.us/j/84214045530?pwd=VTNxWXpNR0p1SlVoOGE2dXA1RmVMZz09";
$link27_2="https://us02web.zoom.us/j/84060031110?pwd=cU9tczBtWEJEN0FQQ1hoRHVubCtIQT09";
$link28_2="https://us02web.zoom.us/j/82720310974?pwd=MHl0SkVJYjFUc0pVQndjNFN3aFhoUT09";
$link26_1_r="https://us02web.zoom.us/j/81822843419?pwd=MWtJVlk0SUhvaWNUbW9JT3B3MG9rdz09";
$link26_2_r="https://us02web.zoom.us/j/83242921683";
$link27_1_r="https://us02web.zoom.us/j/84205895976?pwd=bmpxQmMzOEI2Y25zdHVwR3ZLK2hJdz09";
$link27_2_r="https://us02web.zoom.us/j/89849398533?pwd=bE85UWJmdDd3V1U3U1p2Y3crZ0VRZz09";
$link28_1_r="https://us02web.zoom.us/j/82561370963?pwd=UlIrRTF4ZjhEUTlLWVl1VitQZmlmUT09";
$link28_2_r="https://us02web.zoom.us/j/81038222972?pwd=amxCNmJ6T3dsN25PeEtWejhTcHpiZz09";
$is_troubled_26_1=true;//26日のルーム1を予備に切り替えるときはここをtrueに
$is_troubled_27_1=false;//27日のルーム1を予備に切り替えるときはここをtrueに
$is_troubled_28_1=false;//28日のルーム1を予備に切り替えるときはここをtrueに
$is_troubled_26_2=true;//26日のルーム2を予備に切り替えるときはここをtrueに
$is_troubled_27_2=false;//27日のルーム2を予備に切り替えるときはここをtrueに
$is_troubled_28_2=false;//28日のルーム2を予備に切り替えるときはここをtrueに
$todayis=date('Y-m-d');
if($todayis=='2021-03-26'){
  if($is_troubled_26_1===false){
    $room_1_url=$link26_1;
  }else{
    $room_1_url=$link26_1_r;
  }
  if($is_troubled_26_2===false){
    $room_2_url=$link26_2;
  }else{
    $room_2_url=$link26_2_r;
  }
}elseif($todayis=='2021-03-27'){
  if($is_troubled_27_1===false){
    $room_1_url=$link27_1;
  }else{
    $room_1_url=$link27_1_r;
  }
  if($is_troubled_27_2===false){
    $room_2_url=$link27_2;
  }else{
    $room_2_url=$link27_2_r;
  }
}elseif($todayis=='2021-03-28'){
  if($is_troubled_28_1===false){
    $room_1_url=$link28_1;
  }else{
    $room_1_url=$link28_1_r;
  }
  if($is_troubled_28_2===false){
    $room_2_url=$link28_2;
  }else{
    $room_2_url=$link28_2_r;
  }
}else{
  $room_1_url="https://nf.la.";
  $room_2_url="https://nf.la/";
}


?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>交流企画｜京都大学11月祭</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" href="../../css/common.css">
        <!--<link rel="stylesheet" type="text/css" href="./slick/slick.css">
  <link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">-->
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/21edc3223b.js" crossorigin="anonymous"></script><!--FontAwesome-->
  <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
  <link rel="icon" href="/icon/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="https://nf.la/icon/apple-touch-icon.png" sizes="180x180"> <!-- iPhoneのホーム画面に追加アイコン -->
<meta name="msapplication-TileImage" content="https://nf.la/img/twitter-card.png" />
<meta name="msapplication-TileColor" content="#ffffff"/>
  <meta property="og:url" content="https://nf.la/">
  <meta property="og:title" content="第62回京都大学11月祭" />
  <meta property="og:description" content="第62回京都大学11月祭の情報を掲載。" />
  <meta property="og:image" content="https://nf.la/img/twitter-card.png" />
  <meta name="twitter:site" content="@nfoffice" />
  <meta property="og:site_name" content="第62回京都大学11月祭" />
  <meta property="og:locale" content="ja_JP" />
  <!-- 以下Twitterカード関連 -->
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:title" content="第62回京都大学11月祭" />
  <meta name="twitter:description" content="第62回京都大学11月祭の情報を掲載。" />
  <meta name="twitter:image" content="https://nf.la/img/twitter-card.png" />
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94090208-1"></script>
  <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-94090208-1');
  </script>
  <style>
    .timecol{
      background-color:#ddd;
      padding:0px;
      width:50px;    }
    .stagecol{
      background-color:#fff;
      padding:0px;
      width:100px;
    }
    .thead{
      height:46px;
      font-weight:bold;
    }
    .tab_triple{
      width:32%;
    }
    .table_back{
      width:300px;
      margin:0 auto;
      padding:0;
      height:780px;
      background-image:url(../../image/TT_back.svg);
      background-size:cover;
      position:relative;    
    }
    .table_content{
      position:absolute;
      top:50px;
      left:50px;
      width:200px;
      height:720px;
      background-color:rgba(256,256,256,0.5)
    }
    .table_card{
      display:block;
      border:1px solid #ffcc25;
      border-left:5px solid #ffcc25;
      border-radius:10px;
      box-sizing:border-box;
      background-color:#fff;
      box-shadow:2px 2px 2px rgba(0,0,0,0.5);
      font-size:10px;
      line-height:1;
    }
  </style>
    </head>
    <body>
      <div id="all">
        <header>
          <div id=header-head>
            <a href="/index.html"><h1 id=logo>第62回京都大学11月祭</h1></a>
            <button class="closed groval"><i class="fas fa-bars hnav-icon"></i></button>
            <button class="opened groval"><i class="fas fa-times hnav-icon"></i></button>
          </div>
            
        </header>
        <div id="wrap">
        <div id="mainVisual" class="eventVisual">
            <div class="eventmain">
              <img src="https://nf.la/image/plans/exchange.jpg">
            </div>
            <fab-entry></fab-entry>
          </div>
          <div id="pnkz">
              <ul>
                <li class=pnkz_top><a href="/index.html"><i class="fas fa-home"></i>トップ</a></li>
                <li><a href="/events/general/exchange.php">交流企画</a></li>
              </ul>
            </div>
            <h1 class="pagetitle">交流企画</h1>
            <p class="narrative">交流企画とは、オンライン会議ツールZOOMを用いて、企画出展者と来場者がリアルタイムで相互交流する企画です。</p>
              <p class="narrative">・ルーム1に参加する（タイムテーブルで実施中の企画を確認できます）</p>
              <a class="card-small narrative" href="<?php echo($room_1_url);?>" v-if="today>nfstart&&nfend>today" target="_blank">ルーム1に参加</a>
              <p class="narrative">・ルーム2に参加する(タイムテーブルで実施中の企画を確認できます)</p>
              <a class="card-small narrative" href="<?php echo($room_2_url);?>" v-if="today>nfstart&&nfend>today" target="_blank">ルーム2に参加</a>
              <p class="narrative">ZOOMの使い方がわからない方は<a class="text_link" href="/pdf/zoom.pdf">こちら</a></p>
            
            
            <h2>タイムテーブル</h2>
            <p class="narrative">企画をタップすると説明を見ることができます。</p>
              <button class="change_tab tab_triple" :class="{tab_show:flag==2}" @click="flag=2">3/26(Fri)</button>
              <button class="change_tab tab_triple" :class="{tab_show:flag==3}" @click="flag=3">3/27(Sat)</button>
              <button class="change_tab tab_triple" :class="{tab_show:flag==1}" @click="flag=1">3/28(Sun)</button>
            <div v-show="flag==2" class="card-unshown">
              <h3 class="circlehead">3/26(Fri)</h3>
              <div class="table_back">
                <div class="table_content">
                <?php
                $start26='2021-03-26 09:30:00';
                $start26=strtotime($start26);
                foreach($table26 as $card26){
                  $related=$card26['related'];
                  $code=$card26['code'];
                  $place=$card26['place'];
                  if($place==1){
                    $left='left:10px;';
                  }elseif($place==2){
                    $left='left:110px;';
                  }
                  $start_time=$card26['start'];
                  $end_time=$card26['end'];
                  $ontime=is_ontime($today,$start_time,$end_time);
                  if($ontime==true){
                    $color="background-color:#ddd;";
                  }else{
                    $color="background-color:#fff;";
                  }
                  $top=time_diff($start_time,$start26);
                  $top='top:'.$top.'px;';
                  $height=time_diff($end_time,$start_time);
                  $height='height:'.$height.'px;';
                  echo('<a style="position:absolute;'.$left.$top.$height.$color.'width:80px;" class="table_card" href="https://nf.la/events/search/?c='.$code.'">'.$card26['event_name'].'</a>');                  
                }
                ?>
                </div>
                <!--10::00のラインが上から50px、そこから10pxずつ下がっていく。左から50px、右から50pxが時間-->
              </div>
           </div>
           <div v-show="flag==3" class="card-unshown">
              <h3 class="circlehead">3/27(Sat)</h3>
              <div class="table_back">
              <div class="table_content">
                <?php
                $start27='2021-03-27 09:30:00';
                $start27=strtotime($start27);
                foreach($table27 as $card27){
                  $related=$card27['related'];
                    $code=$card27['code'];
                  $place=$card27['place'];
                  if($place==1){
                    $left='left:10px;';
                  }elseif($place==2){
                    $left='left:110px;';
                  }
                  $start_time=$card27['start'];
                  $end_time=$card27['end'];
                  $top=time_diff($start_time,$start27);
                  $top='top:'.$top.'px;';
                  $height=time_diff($end_time,$start_time);
                  $height='height:'.$height.'px;';
                  echo('<a style="position:absolute;'.$left.$top.$height.'width:80px;" class="table_card" href="https://nf.la/events/search/?c='.$code.'">'.$card27['event_name'].'</a>');                  
                }
                ?>
                </div>
              </div>
           </div>
           <div v-show="flag==1" class="card-unshown">
              <h3 class="circlehead">3/28(Sun)</h3>
              <div class="table_back">
              <div class="table_content">
                <?php
                $start28='2021-03-28 09:30:00';
                $start28=strtotime($start28);
                foreach($table28 as $card28){
                  $related=$card28['related'];
                    $code=$card28['code'];
                  $place=$card28['place'];
                  if($place==1){
                    $left='left:10px;';
                  }elseif($place==2){
                    $left='left:110px;';
                  }
                  $start_time=$card28['start'];
                  $end_time=$card28['end'];
                  $top=time_diff($start_time,$start28);
                  $top='top:'.$top.'px;';
                  $height=time_diff($end_time,$start_time);
                  $height='height:'.$height.'px;';
                  echo('<a style="position:absolute;'.$left.$top.$height.'width:80px;" class="table_card" href="https://nf.la/events/search/?c='.$code.'">'.$card28['event_name'].'</a>');                  
                }
                ?>
                </div>
              </div>
           </div>
           <h2>企画一覧</h2>
            <div class="flex-container">
            <?php
            foreach($data as $events){
                $linkcode=$events['livecode'];
                $link='https://nf.la/events/search/?c='.$linkcode;
                if($events['livecode']!='R-002'){
                  echo('<a class="fab-card" href='.$link.'><h5 class="fab-title">'.$events['live_name'].'</h5><div class="fab-date"><p>'.$events['datetime_text'].'</p></div></a>');
                }
              
            }
            ?>
            </div>
            <kkk-general></kkk-general>
        </div><!--wrap閉じ-->
        <fab-confirm></fab-confirm>
        <rally-join></rally-join>
        <gnav-side></gnav-side>
        <footer-menu></footer-menu>
       
          </div><!--all閉じ-->
          <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
          <script>window.jQuery || document.write('<script src="/js/jquery.min.js"><\/script>');</script><!--JqueryCDNのフォールバック-->
          <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
          <script>window.Vue || document.write('<script src="/js/vue.min.js"><\/script>')</script><!--VueCDNのフォールバック-->
          <script type="text/javascript" src="/script/jquery.inview.min.js"></script>
          <!--<script type="text/javascript" src="./slick/slick.min.js"></script>-->
          <script>
          var title="交流企画";
          var author1="11月祭本部";
          var date="全日";
          var type="live";
          var main="";
          var sub="";
          </script>
        <script type="text/javascript" src="../../js/common.js"></script>
       
         <!--ここからはパン屑用の構造化-->
         <script type="application/ld+json">
          {
           "@context": "http://schema.org",
           "@type": "BreadcrumbList",
           "itemListElement":
           [
            {
             "@type": "ListItem",
             "position": 1,
             "item":
             {
              "@id": "/",
              "name": "TOP"
              }
            },
            {
             "@type": "ListItem",
            "position": 2,
            "item":
             {
               "@id": "/template",
               "name": "template"
             }
            }
           ]
          }
          </script>
    </body>
</html>


