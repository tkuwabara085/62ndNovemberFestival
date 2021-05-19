<?php
require_once('../../php_helpers/config.php');
require_once('../../php_helpers/db_helper.php');
$code=$_GET['code'];
$sql='select * from exhibition left join live on exhibition.code=live.lrelated left join shop on exhibition.code=shop.srelated left join search on exhibition.code=search.ecode where exhibition.code = :code';
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
$event_text=h($data[0]['event_text']);
//ここから内容の第一セクション
$header_1=h($data[0]['1_header']);
$text_1=h($data[0]['1_text']);
$img_1=h($data[0]['1_image']);
$imgtext_1=h($data[0]['1_imgtext']);
$video_1=$data[0]['1_video'];
$videotext_1=h($data[0]['1_videotext']);
//ここから内容の第２セクション
$header_2=h($data[0]['2_header']);
$text_2=h($data[0]['2_text']);
$img_2=h($data[0]['2_image']);
$imgtext_2=h($data[0]['2_imgtext']);
$video_2=$data[0]['2_video'];
$videotext_2=h($data[0]['2_videotext']);
//ここから内容の第3セクション
$header_3=h($data[0]['3_header']);
$text_3=h($data[0]['3_text']);
$img_3=h($data[0]['3_image']);
$imgtext_3=h($data[0]['3_imgtext']);
$video_3=$data[0]['3_video'];
$videotext_3=h($data[0]['3_videotext']);
//ここから内容の第4セクション
$header_4=h($data[0]['4_header']);
$text_4=h($data[0]['4_text']);
$img_4=h($data[0]['4_image']);
$imgtext_4=h($data[0]['4_imgtext']);
$video_4=$data[0]['4_video'];
$videotext_4=h($data[0]['4_videotext']);
//ここから内容の第5セクション
$header_5=h($data[0]['5_header']);
$text_5=h($data[0]['5_text']);
$img_5=h($data[0]['5_image']);
$imgtext_5=h($data[0]['5_imgtext']);
$video_5=$data[0]['5_video'];
$videotext_5=h($data[0]['5_videotext']);
//ここから内容の第6セクション
$header_6=h($data[0]['6_header']);
$text_6=h($data[0]['6_text']);
$img_6=h($data[0]['6_image']);
$imgtext_6=h($data[0]['6_imgtext']);
$video_6=$data[0]['6_video'];
$videotext_6=h($data[0]['6_videotext']);

//ここからリンク
$linktitle_1=h($data[0]['link_title1']);
$linktext_1=h($data[0]['link_text1']);
$linkurl_1=h($data[0]['link_url1']);
$linktitle_2=h($data[0]['link_title2']);
$linktext_2=h($data[0]['link_text2']);
$linkurl_2=h($data[0]['link_url2']);
$linktitle_3=h($data[0]['link_title3']);
$linktext_3=h($data[0]['link_text3']);
$linkurl_3=h($data[0]['link_url3']);
$form=$data[0]['form'];
}
$shoplink=h($data[0]['surl']);
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
//代入完了
function multirender($str1,$str2,$str3,$str4,$str5,$str6){//画像・動画が複数入りうるセクションをレンダリングする。$str1は画像ファイル名、$str2は画像キャプション、$str3が動画タグ、$str4が動画キャプション、$str5はテキスト,$str6が見出し
  global $code;
  $img_tag="";
  if(mb_strlen($str1.$str3.$str5.$str6)>1){
  if(mb_strlen($str6)>1){
    echo('<h2>'.$str6.'</h2>');
  }
    echo('<div class="flex-container">');
    if(strlen($str1)>4){
      $array1=explode("|",$str1);
      $array2=explode("|",$str2);
      for($i=0;$i<count($array1);$i++){
        $arr=explode(".",$array1[$i]);
        $num=$arr[0];
        $num=str_replace("-","1",$num);
        $img_tag.='<div class="e-img"><img src="./image/exhibition/'.$code.'/'.$array1[$i].'" class="fitimg clickable" @click="clickimg='.$num.'"><p>'.$array2[$i].'</p></div><div v-show="clickimg=='.$num.'" class="popimgbg" @click="clickimg=0"><div class="popimg"><button @click="clickimg=0" class="popclose"><i class="fas fa-times"></i></button><img src="./image/exhibition/'.$code.'/'.$array1[$i].'" class="fitimg"></div><p class="poptext">'.$array2[$i].'</p></div>';
      }
    }
    if(mb_strlen($str3)>30){
      $array3=explode("|",$str3);
      $array4=explode("|",$str4);
      for($i=0;$i<count($array3);$i++){
        $img_tag.='<div class="e-img"><div class="e-video">'.$array3[$i].'</div><p>'.$array4[$i].'</p></div>';
      }
    }
    if(mb_strlen($img_tag)>10){
      echo('<div class="e-imgarea">'.$img_tag.'</div>');
    }
    echo('<div class="e-textarea"><p>'.nl2br($str5).'</p></div></div>');
  }
}
function linksection($str1,$str2,$str3){
  if(mb_strlen($str1)>1){
    echo('<h3 class="circlehead">'.$str1.'</h3><p>'.$str3.'</p><p><a href="'.$str2.'" class="card-small" target="_blank">'.$str1.'<i class="fas fa-external-link-alt"></i></a></p>');
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title><?php echo($event_name);?>|京都大学11月祭</title>
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
              <img src="./image/exhibition/<?php echo($code);?>/main.jpg">
            </div>
            <fab-entry></fab-entry>
          </div>
          <div id="pnkz">
              <ul>
                <li class=pnkz_top><a href="/index.html"><i class="fas fa-home"></i>トップ</a></li>
                <li><a href="/events/general/exhibition.php?code=<?php echo($code);?>"><?php echo($event_name);?></a></li>
              </ul>
            </div>
          <event-header></event-header>
          <div class="card-unshown">
           <h2><?php echo($event_name); ?>について</h2>
           <p><?php echo(nl2br($event_text));?></p>
          <?php
          multirender($img_1,$imgtext_1,$video_1,$videotext_1,$text_1,$header_1);
          multirender($img_2,$imgtext_2,$video_2,$videotext_2,$text_2,$header_2);
          multirender($img_3,$imgtext_3,$video_3,$videotext_3,$text_3,$header_3);
          multirender($img_4,$imgtext_4,$video_4,$videotext_4,$text_4,$header_4);
          multirender($img_5,$imgtext_5,$video_5,$videotext_5,$text_5,$header_5);
          multirender($img_6,$imgtext_6,$video_6,$videotext_6,$text_6,$header_6);
          if(mb_strlen($linktitle_1)>0){
          ?>
           <h2>関連</h2>
           <?php
          }
           linksection($linktitle_1,$linkurl_1,$linktext_1);
          linksection($linktitle_2,$linkurl_2,$linktext_2);
          linksection($linktitle_3,$linkurl_3,$linktext_3);
          if(mb_strlen($form)>12){
            echo('<h2>ご質問・意見・感想</h2><p>本企画（'.$event_name.'）についての質問・意見・感想がある方は必要項目を記入の上、以下のフォームからお願いします。なお、回答には時間を要する場合があります。ご了承下さい。</p><div class="g-wrap"><div class="gForm">'.$form.'</div></div><q-a></q-a>');
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
          <!--<script type="text/javascript" src="./slick/slick.min.js"></script>-->
          <script type="text/javascript" src="/script/jquery.inview.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
          <script>
            var event_name="<?php echo($data[0]['event_name']);?>";//イベントヘッダーの企画名
            var author1="<?php echo($data[0]['group_name']); ?>";//企画名
            var author2="";
            var code="<?php echo($code);?>";//
            var title="<?php echo($data[0]['event_name']);?>";
            var date="全日";
            var shoplink="<?php echo($shoplink);?>";
            var extext="<?php echo($exchange["text"]);?>";
            var exfirst={start:"<?php echo($exchange["time_1_start"]);?>",end:"<?php echo($exchange["time_1_end"]);?>",url:"<?php echo($exchange["time_1_url"]);?>"};
            var exsecond={start:"<?php echo($exchange["time_2_start"]);?>",end:"<?php echo($exchange["time_2_end"]);?>",url:"<?php echo($exchange["time_2_url"]);?>"};
            var exthird={start:"<?php echo($exchange["time_3_start"]);?>",end:"<?php echo($exchange["time_3_end"]);?>",url:"<?php echo($exchange["time_3_url"]);?>"};
            var main="<?php echo($data[0]['main']);?>";
            var sub="<?php echo($data[0]['sub']);?>";
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
               "@id": "/events/general/exhibiton.php?code=<?php echo($code);?>",
               "name": "<?php echo($event_name);?>"
             }
            }
           ]
          }
          </script>
    </body>
</html>


