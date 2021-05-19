<?php
$plan=$_GET['plan'];
require_once('../php_helpers/config.php');
require_once('../php_helpers/db_helper.php');
$sql='select * from plans where name like :name';
$pdo=get_db_connect();
$stmt=$pdo->prepare($sql);
$stmt->bindvalue(':name',$plan);
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
	$name=$data[0]['name'];//こっちで打ち込んだ値なので特にサニタイズしていない
  $explanation=htmlspecialchars($data[0]['explanation'],ENT_QUOTES,'UTF-8');//このあたりは担当者が入力できるので念のためサニタイズ処理している。
  $dateall=htmlspecialchars($data[0]['date'],ENT_QUOTES,'UTF-8');
  $needall=htmlspecialchars($data[0]['need'],ENT_QUOTES,'UTF-8');
  $path=$data[0]['path'];
  $datelist=array();
  $needlist=array();
  $datelist=explode(",",$dateall);//コンマ区切りで打ち込んでもらっているのでそれを配列に変換
  $needlist=explode(",",$needall);
  $datenum=count($datelist);
  $video=$data[0]['video'];
}
?>
<html>
<head>
<meta charset="utf-8">
<title><?php echo($name)?>企画｜京都大学11月祭</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" href="../css/common.css">
        <link rel="stylesheet" type="text/css" href="../slick/slick.css">
  <link rel="stylesheet" type="text/css" href="../slick/slick-theme.css">
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
            <div id="mainVisual" class="normalvisual">

            </div>
            <div id="pnkz">
              <ul>
                <li class=pnkz_top><a href="/index.html"><i class="fas fa-home"></i>トップ</a></li>
				<li><a href="/registration/index.html">企画出展方法</a></li>
				<li><a href="plans.php?name=<?php echo($name)?>"><?php echo($name)?></a></li>
              </ul>
      </div>
      <h1 class="pagetitle"><?php echo($name)?>企画</h1>
      <caution-first></caution-first>
            <h2>企画概要</h2>
            <div class="flex-container card-unshown">
            <div class="imageWithCaps"><video src="../image/video/<?php echo($video);?>" type="video/mp4" width=304 controls ><p>このブラウザには対応しておりません。</p></video></div>
            <div class="explanationWithImage">
            <p class="narrative"><?php echo(nl2br($explanation));?></p>
            <p class="narrative">※対面での課外活動には活動前二週間の検温が必要です。</p>
            </div>
            </div>
            <h2>企画申請</h2>
              <p class="narrative">11月祭に<?php echo($name)?>企画を出展するには企画申請が必要です。企画申請では以下のような情報を登録していただきます。</p>
              <ol>
               
                <?php
                foreach($needlist as $needs){
                  echo('<li>'.$needs.'</li>');
                }
                ?>
                 <li>必要書類（詳細は<a href="/pdf/papers.pdf" class="text_link" target="_blank">こちら</a>）</li>
                 <li>パンフレット原稿（詳細は<a href="/pdf/genkou.pdf" class="text_link" target="_blank">こちら</a>）</li>
              </ol>
              <p class="narrative">※本年度の企画申請の日程は2月10日から15日の予定です。</p>
              <p class="narrative">また、屋内ステージ企画・屋内ステージ企画・ライブハウス企画・展示企画と交流企画・ショップ企画を同時申請する場合は、先に前者の企画申請を行うようお願いします。</p>
              <a href="request.html" class="card-small narrative">企画申請手続について</a>
              <p class="narrative">企画責任者は、11月祭期間中に有効な京大の学生証をもっている方に限ります。企画責任者を必ず１名選出してください。企画責任者にはPENGUINを用いて企画申請の諸手続きを行なっていただきます。また、11月祭事務局からの連絡はすべて企画責任者に対して行いますので、企画参加者全員と連絡を取ることができる方にしていただくよう、お願いします。企画責任者の変更は、原則として認められていません。</p>
              <br>
              <p class="narrative">※必要書類とパンフレット原稿については企画申請期間後も提出を受け付けます。なお、必要書類についてはPENGUIN上での提出ではなく、メールなどで提出していただきます。申請時にPENGUIN上で資料を配付いたしますのでそちらをご覧下さい。</p>

              <h2>企画担当者説明会</h2>
              <p class="narrative">企画担当者説明会では、今後の予定などについて説明します。企画責任者の方は必ず出席してください。今年度はZoomを用いて行います。Zoomのリンクは企画申請後にメールにて企画責任者にお伝えします。</p>
              <p class="narrative">また、企画担当者説明会と並行して様々な申請などの手続も行っていただきます。</p>
              <p class="narrative">日程は以下の通りです。<a href="/pdf/rulebook.pdf" class="text_link" target="_blank">一般企画虎の巻</a>も合わせてご覧下さい。</p>
              <ul style="padding-left:20px;">
              <?php
              for($i=0;$i<=$datenum-1;$i++){
                $num=$i+1;
                echo('<li>'.$datelist[$i].':第'.$num.'回企画担当者説明会</li>');
              }
              ?>
              </ul>
              <h2>お問い合わせ</h2>
              <p class="narrative"><?php echo($name);?>企画についてご不明な点がありましたら下記連絡先までお問い合わせ下さい。以下にFAQもまとめておりますのでそちらもご活用下さい。</p>
              <img src="/image/contact/<?php echo($path);?>" alt="メールアドレス" width=200 class="narrative">
              <faq></faq>
              <plans-related></plans-related>

            
        </div><!--wrap閉じ-->
        
        <gnav-side></gnav-side>
        <footer-menu></footer-menu>
      </div><!--all閉じ-->
      <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/js/jquery.min.js"><\/script>');</script><!--JqueryCDNのフォールバック-->
      <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
      <script>window.Vue || document.write('<script src="/js/vue.min.js"><\/script>')</script><!--VueCDNのフォールバック-->
		  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
          <script>
            var state=1;
            var type='<?php echo($name) ?>';
          </script>
          <script type="text/javascript" src="faq.js"></script>
          <script type="text/javascript" src="../js/plans.js"></script>
       	  <script type="text/javascript" src="../js/common.js"></script>
       
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
               "@id": "/registration/index.html",
               "name": "企画出展方法"
             }
            },
            {
             "@type": "ListItem",
            "position": 3,
            "item":
             {
               "@id": "/registration/plans.php?plan=<?php echo($name)?>",
               "name": "<?php echo($name)?>"
             }
            }
           ]
          }
          </script>
</body>
</html>