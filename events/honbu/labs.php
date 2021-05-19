<?php
require_once('../../php_helpers/config.php');
require_once('../../php_helpers/db_helper.php');
$code=$_GET['code'];
$sql='select * from lab left join live on lab.code=live.lrelated where code like :code';
$pdo=get_db_connect();
$stmt=$pdo->prepare($sql);
$stmt->bindvalue(':code',$code,PDO::PARAM_STR);
$stmt->execute();
$data=array();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  $data[]=$row;
}
if(count($data)!=1){//チェックボックスでピンポイントに検索するのでここが1以外になったらおかしい
  http_response_code( 301 ) ;//こうしとかないとSEOとかに問題があるっぽい？
// リダイレクト
header( "Location: https://nf.la/404.html" ) ;//これで存在しないページにリダイレクトされなくてすむ。
exit ;
}else{
//とりあえず代入をひたすら行う
$code=h($data[0]['code']);//原理上は変わらないはず……万一に備えて
$event_name=h($data[0]['event_name']);
$group_name=h($data[0]['group_name']);
$section_name=h($data[0]['section_name']);
$field=h($data[0]['field']);
$lab_text=h($data[0]['lab_text']);
$lab_img=h($data[0]['lab_img']);
$lab_video=$data[0]['lab_video'];
$content_title=h($data[0]['content_title']);
//ここから研究内容の第一セクション
$header_1=h($data[0]['1_header']);
$header_11=h($data[0]['1-1_header']);
$text_11=h($data[0]['1-1_text']);
$img_11=h($data[0]['1-1_img']);
$video_11=$data[0]['1-1_video'];
$header_12=h($data[0]['1-2_header']);
$text_12=h($data[0]['1-2_text']);
$img_12=h($data[0]['1-2_img']);
$video_12=$data[0]['1-2_video'];
//ここから研究内容の第２セクション
$header_2=h($data[0]['2_header']);
$header_21=h($data[0]['2-1_header']);
$text_21=h($data[0]['2-1_text']);
$img_21=h($data[0]['2-1_img']);
$imgtext_21=h($data[0]['2-1_imgtext']);
$video_21=$data[0]['2-1_video'];
$videotext_21=h($data[0]['2-1_videotext']);
$header_22=h($data[0]['2-2_header']);
$text_22=h($data[0]['2-2_text']);
$img_22=h($data[0]['2-2_img']);
$imgtext_22=h($data[0]['2-2_imgtext']);
$video_22=$data[0]['2-2_video'];
$videotext_22=h($data[0]['2-2_videotext']);
$header_23=h($data[0]['2-3_header']);
$text_23=h($data[0]['2-3_text']);
$img_23=h($data[0]['2-3_img']);
$imgtext_23=h($data[0]['2-3_imgtext']);
$video_23=$data[0]['2-3_video'];
$videotext_23=h($data[0]['2-3_videotext']);
$header_24=h($data[0]['2-4_header']);
$text_24=h($data[0]['2-4_text']);
$img_24=h($data[0]['2-4_img']);
$imgtext_24=h($data[0]['2-4_imgtext']);
$video_24=$data[0]['2-4_video'];
$videotext_24=h($data[0]['2-4_videotext']);
//ここから研究内容の第3セクション
$header_3=h($data[0]['3_header']);
$header_31=h($data[0]['3-1_header']);
$text_31=h($data[0]['3-1_text']);
$img_31=h($data[0]['3-1_img']);
$video_31=$data[0]['3-1_video'];
$header_32=h($data[0]['3-2_header']);
$text_32=h($data[0]['3-2_text']);
$img_32=h($data[0]['3-2_img']);
$video_32=$data[0]['3-2_video'];
//ここから研究内容の第4セクション
$title_41=h($data[0]['4-1_title']);
$link_41=h($data[0]['4-1_link']);
$text_41=h($data[0]['4-1_text']);
$title_42=h($data[0]['4-2_title']);
$link_42=h($data[0]['4-2_link']);
$text_42=h($data[0]['4-2_text']);
$title_43=h($data[0]['4-3_title']);
$link_43=h($data[0]['4-3_link']);
$text_43=h($data[0]['4-3_text']);
$form=$data[0]['form'];
//ライブ配信用
for($i=1;$i<=3;$i++){
  if(mb_strlen($data[0]['time_'.$i.'_url'])>10){
    $start=$data[0]['time_'.$i.'_start'];
    $end=$data[0]['time_'.$i.'_end'];
    $start=strtotime($start.'-1month');
    $end=strtotime($end.'-1month');
    $start=date('Y,m,d,H,i,s',$start);
    $end=date('Y,m,d,H,i,s',$end);
  }else{
    $start='0000,00,00,00,0,0';
    $end='0000,00,00,00,0,0';
  }
  $data[0]['time_'.$i.'_end']=$end;
  $data[0]['time_'.$i.'_start']=$start;
}
$exchange=array(
  "text"=>$data[0]['datetime_text'],
  "time_1_url"=>$data[0]["time_1_url"],
  "time_2_url"=>$data[0]["time_2_url"],
  "time_3_url"=>$data[0]["time_3_url"],
  "time_1_start"=>$data[0]["time_1_start"],
  "time_2_start"=>$data[0]["time_2_start"],
  "time_3_start"=>$data[0]["time_3_start"],
  "time_1_end"=>$data[0]["time_1_end"],
  "time_2_end"=>$data[0]["time_2_end"],
  "time_3_end"=>$data[0]["time_3_end"],
);
//live_finish
}
//代入完了

//画像・動画を一つだけ含むセクションをレンダリングする。str1が画像、str2が動画,str3がテキスト
function singlerender($str1,$str2,$str3){
  global $code;//グローバル変数を参照するにはこういう書き方をする必要があるらしい
  if(mb_strlen($str3)>0){
    echo('<div class="flex-container">');
      if(mb_strlen($str1)>4){
        $arr=explode('.',$str1);
        $num=$arr[0];
        $num=str_replace("-","1",$num);
          if($num=="lab"){
           $num=1;
          }
        $img_tag='<div class="e-img"><img src="./image/labs/'.$code.'/'.$str1.'" class="fitimg clickable" @click="clickimg='.$num.'"></div>';
        echo('<div class="e-imgarea">'.$img_tag.'</div><div v-show="clickimg=='.$num.'" class="popimgbg"><div class="popimg"><button @click="clickimg=0" class="popclose"><i class="fas fa-times"></i></button><img src="./image/labs/'.$code.'/'.$str1.'" class="fitimg"></div></div>');
      }elseif(mb_strlen($str2)>30){
        echo('<div class="e-imgarea"><div class="e-img"><div class="e-video">'.$str2.'</div></div></div>');
      }
    echo('<div class="e-textarea"><p>'.nl2br($str3).'</p></div></div>');
  }
}
function multirender($str1,$str2,$str3,$str4,$str5){//画像・動画が複数入りうるセクションをレンダリングする。$str1は画像ファイル名、$str2は画像キャプション、$str3が動画タグ、$str4が動画キャプション、$str5はテキスト
  global $code;
  $img_tag="";
  if(mb_strlen($str5)>0){
    echo('<div class="flex-container">');
    if(mb_strlen($str1)>4){
      $array1=explode("|",$str1);
      $array2=explode("|",$str2);
      for($i=0;$i<count($array1);$i++){
        $arr=explode(".",$array1[$i]);
        $num=$arr[0];
        $num=str_replace("-","1",$num);
        $img_tag.='<div class="e-img"><img src="./image/labs/'.$code.'/'.$array1[$i].'" class="fitimg clickable" @click="clickimg='.$num.'"><p>'.$array2[$i].'</p></div><div v-show="clickimg=='.$num.'" class="popimgbg"><div class="popimg"><button @click="clickimg=0" class="popclose"><i class="fas fa-times"></i></button><img src="./image/labs/'.$code.'/'.$array1[$i].'" class="fitimg"></div><p class="poptext">'.$array2[$i].'</p></div>';
      }
    }
    if(mb_strlen($str3)>30){
      $array3=explode("|",$str3);
      $array4=explode("|",$str4);
      for($i=0;$i<count($array3);$i++){
        $img_tag.='<div class="e-img"><div class="e-video">'.$array3[$i].'</div><p>'.$array4[$i].'</p></div>';
      }
    }
    if(strlen($img_tag)>10){
      echo('<div class="e-imgarea">'.$img_tag.'</div>');
    }
    echo('<div class="e-textarea"><p>'.nl2br($str5).'</p></div></div>');

  }
}
function linksection($str1,$str2,$str3){
  if(strlen($str1)>1){
    echo('<h3 class="circlehead">'.$str1.'</h3><p>'.$str3.'</p><p><a href="'.$str2.'" class="card-small" target="_blank">'.$str1.'<i class="fas fa-external-link-alt"></i></a></p>');
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>研究室企画（<?php echo($group_name);?>）|京都大学11月祭</title>
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
              <img src="./image/labs/<?php echo($code);?>/main.jpg">
            </div>
            <fab-entry></fab-entry>
          </div>
          <div id="pnkz">
              <ul>
                <li class=pnkz_top><a href="/index.html"><i class="fas fa-home"></i>トップ</a></li>
                <li><a href="/events/honbu/labs.html">研究室企画</a></li>
                <li><a href="/events/honbu/labs.php?code=<?php echo($code);?>"><?php echo($group_name);?></a></li>
              </ul>
            </div>
          <event-header></event-header>
          <div class="card-unshown">
           <h2 class="stronghead"><?php echo($group_name); ?>について</h2>
             <?php
             singlerender($lab_img,$lab_video,$lab_text);
             ?>
           <h2 class="stronghead"><?php echo($content_title);?></h2>
           <?php
           if(mb_strlen($header_1)>1){
           ?>
           <h2><?php echo($header_1);?></h2>
           <?php
           }
            if(mb_strlen($header_11)>1){
           ?>
           <h3 class="recthead"><?php echo($header_11);?></h3>
           <?php
            }
            singlerender($img_11,$video_11,$text_11);
          if(mb_strlen($header_12)>1){
           ?>
           <h3 class="recthead"><?php echo($header_12);?></h3>
           <?php
          }
           singlerender($img_12,$video_12,$text_12);
          if(mb_strlen($header_2)>1){
           ?>
           <h2><?php echo($header_2);?></h2>
           <?php
          }
           if(mb_strlen($header_21)>1){
           ?>
           <h3 class="recthead"><?php echo($header_21); ?></h3>
           <?php
           }
           multirender($img_21,$imgtext_21,$video_21,$videotext_21,$text_21);
           if(mb_strlen($header_22)>1){
           ?>
           <h3 class="recthead"><?php echo($header_22);?></h3>
           <?php
           }
           multirender($img_22,$imgtext_22,$video_22,$videotext_22,$text_22);
           if(mb_strlen($header_23)>1){
           ?>
           <h3 class="recthead"><?php echo($header_23);?></h3>
           <?php
           }
           multirender($img_23,$imgtext_23,$video_23,$videotext_23,$text_23);
           if(mb_strlen($header_24)>1){
           ?>
           <h3 class="recthead"><?php echo($header_24);?></h3>
           <?php
           }
           multirender($img_24,$imgtext_24,$video_24,$videotext_24,$text_24);
           if(mb_strlen($header_3)>1){
           ?>
           <h2><?php echo($header_3);?></h2>
           <?php
           }
           if(mb_strlen($header_31)>1){
           ?>
           <h3 class="recthead"><?php echo($header_31);?></h3>
           <?php
           singlerender($img_31,$video_31,$text_31);
           }
           if(mb_strlen($header_32)>1){
           ?>
           <h3 class="recthead"><?php echo($header_32);?></h3>
           <?php
           singlerender($img_32,$video_32,$text_32);
           }
           ?>
           <h2>関連</h2>
           <?php
           linksection($title_41,$link_41,$text_41);
          linksection($title_42,$link_42,$text_42);
          linksection($title_43,$link_43,$text_43);
          if(mb_strlen($form)>12){
            echo('<h2>ご質問・意見・感想</h2><p>本企画（'.$event_name.'）についての質問・意見・感想がある方は必要項目を記入の上、以下のフォームからお願いします。なお、回答には時間を要する場合があります。ご了承下さい。</p><div class="g-wrap"><div class="gForm">'.$form.'</div></div><q-a></q-a>');
          }elseif($code=='R-001'){
            echo('<h2>ご質問などについて</h2><p>本企画（'.$event_name.'）に関する質問は研究室Facebookから受け付けております。</p>');
          }
           ?>           
          </div><!--card-unshown end-->
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
          <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
          <script>
            var event_name="<?php echo($event_name);?>";
            var author2="<?php echo($section_name); ?>";
            var author1="<?php echo($group_name);?>";
            var code="<?php echo($code);?>";
            var title="<?php echo($event_name);?>";
            var date="全日";
            var shoplink="";
            var extext="<?php echo($exchange["text"]);?>";
            var exfirst={start:"<?php echo($exchange["time_1_start"]);?>",end:"<?php echo($exchange["time_1_end"]);?>",url:"<?php echo($exchange["time_1_url"]);?>"};
            var exsecond={start:"<?php echo($exchange["time_2_start"]);?>",end:"<?php echo($exchange["time_2_end"]);?>",url:"<?php echo($exchange["time_2_url"]);?>"};
            var exthird={start:"<?php echo($exchange["time_3_start"]);?>",end:"<?php echo($exchange["time_3_end"]);?>",url:"<?php echo($exchange["time_3_url"]);?>"};
            var main="科学";
            var sub="";
            var type="exhibition";
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
               "@id": "/events/honbu/labs.html",
               "name": "研究室企画"
             }
            },
            {
             "@type": "ListItem",
            "position": 3,
            "item":
             {
               "@id": "/events/honbu/labs.php?code=<?php echo($code);?>",
               "name": "研究室企画-<?php echo($group_name);?>"
             }
            }
           ]
          }
          </script>
    </body>
</html>


