<?php
require_once('./php_helpers/config.php');
require_once('./php_helpers/db_helper.php');
$pdo=get_db_connect();
$sql='select * from cards';
$stmt=$pdo->query($sql);
$data=array();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $data[]=$row;
}
?>
<html lang="ja">
<head>
        <meta charset="utf-8">
        <title>名刺広告｜京都大学11月祭</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" href="./css/common.css">
        <link rel="stylesheet" type="text/css" href="./slick.1.9.0/slick.css">
  <link rel="stylesheet" type="text/css" href="./slick.1.9.0/slick-theme.css">
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
  <style>
  .card-box{
    display:inline-block;margin:5px;}
  .card-container{
    display:-webkit-box;
    display:-ms-flexbox;
    display:flex;
    -webkit-box-orient:horizontal;
    -webkit-box-direction:normal;
        -ms-flex-flow:row wrap;
            flex-flow:row wrap; -ms-flex-pack:distribute; justify-content:space-around;
  }
  @media screen and (min-width:600px){
    .card-container{
      -webkit-box-pack:start;
          -ms-flex-pack:start;
              justify-content:flex-start;
    }
  }
  .business{
    font-family:sans-serif;width:145px;margin:5px;padding-left:5px;padding-right:5px;height:200px;background-color:#fff;border:1px solid #000;-webkit-writing-mode: vertical-rl;writing-mode: vertical-rl;-ms-writing-mode: tb-rl;-webkit-text-orientation:upright;text-orientation:upright;
  }
  </style>
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94090208-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94090208-1');
</script>
        <!--#include virtual="/ssi/gtag.html"--><!--Google analytics tagの読み込み（本番環境のみ）-->
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
            <div id="mainVisual" class="normalvisual">

            </div>
            <div id="pnkz">
              <ul>
                <li class=pnkz_top><a href="/index.html"><i class="fas fa-home"></i>トップ</a></li>
                <li><a href="/sponsor.php">名刺広告</a></li>
              </ul>
            </div>
            <h1 class="pagetitle">御協賛いただいた皆様</h1>
            <p class="narrative">第62回11月祭の開催に際しまして、以下の方々をはじめとした多くの皆様からご賛助いただきました。この場を借りて厚くお礼申し上げます。</p>
            <div class="card-box">
            <div class="card-container">
        <?php
        foreach($data as $array){
          ?>
          <div class="business">
          <div style="margin:5px auto;width:100%;" class="flex-center;">
          <div style="width:48px;">
          <p style="font-size:12px;width=24px;"><?php echo(htmlspecialchars($array['com1']));?></p>
          <p style="font-size:12px;width=24px;"><?php echo(htmlspecialchars($array['com2']));?></p>
          </div>
          <div style="text-align:center;width:39px;"><p style="font-size:17px; text-align:center;"><?php echo(htmlspecialchars($array['name']));?></p></div>
          <div style="width:48px;text-align:right;">
          <p style="font-size:12px;text-align:right;width=24px;"><?php echo(htmlspecialchars($array['grad1']));?></p>
          <p style="font-size:12px;text-align:right;width=24px;"><?php echo(htmlspecialchars($array['grad2']));?></p>
          </div>
          </div>
          </div>
        <?php
        }
        ?>
        </div>
        </div>
        <top-kkk></top-kkk>
        <kkk-general></kkk-general>
        </div><!--wrap閉じ-->
        <gnav-side></gnav-side>
        <footer-menu></footer-menu>
       
          </div><!--all閉じ-->
          <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
          <script>window.jQuery || document.write('<script src="/js/jquery.min.js"><\/script>');</script><!--JqueryCDNのフォールバック-->
          <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
          <script>window.Vue || document.write('<script src="/js/vue.min.js"><\/script>')</script><!--VueCDNのフォールバック-->
          <script type="text/javascript" src="/script/jquery.inview.min.js"></script>
          <script type="text/javascript" src="./slick.1.9.0/slick.min.js"></script>
        <!--SSIここまで-->
        <script type="text/javascript" src="./js/common.js"></script>
       
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
               "@id": "/sponser.php",
               "name": "名刺広告"
             }
            }
           ]
          }
          </script>
    </body>
</html>


