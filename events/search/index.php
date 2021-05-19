<?php
require_once('../../php_helpers/config.php');
require_once('../../php_helpers/db_helper.php');
$code=$_GET['c'];
$sql='select * from search left join shop on search.shop=shop.shopcode left join live on search.live=live.livecode where search.ecode= :code';
$pdo=get_db_connect();
$stmt=$pdo->prepare($sql);
$stmt->bindValue(':code',$code,PDO::PARAM_STR);
$stmt->execute();
$data=array();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $data[]=$row;
}
if(count($data)!==1){
        http_response_code( 301 ) ;//こうしとかないとSEOとかに問題があるっぽい？
        // リダイレクト
        header( "Location: https://nf.la/404.html" ) ;//これで存在しないページにリダイレクトされなくてすむ。
        exit ;
}
$arr=$data[0];
$code=$arr['ecode'];
if(stripos($code,'H')!==false){//本部企画は別の処理する
    $honbulist=array(
        'H-001'=>'lecture.html',
        'H-002'=>'labs.html',
        'H-003'=>'map.html',
        'H-004'=>'rally.php',
        'H-005'=>'radio.html',
        'H-006'=>'shop.html#goods',
    );
    $url="/events/honbu/".$honbulist[$code];
    http_response_code( 301 ) ;//こうしとかないとSEOとかに問題があるっぽい？
        // リダイレクト
        header( "Location: ".$url ) ;//これで存在しないページにリダイレクトされなくてすむ。
        exit ;
}
$today=date("Y-m-d H:i:s");
$fstart=strtotime('2021-03-26 00:00:00');
$fend=strtotime('2021-03-26 00:00:00');
$nowstamp=strtotime($today);//交流とかで使う

    if($code==$arr['exhibition']){
        $type="exhibition";
        $date="全日";
        if(stripos($code,'R')!==false){
            $url="/events/honbu/labs.php?code=".$code;
        }else{
            $url="/events/general/exhibition.php?code=".$code;
        }
        $exhibit="";
        $shop=$arr['shop'];
        $live=$arr['live'];
    }elseif($code==$arr['shop']){
        $type="shop";
        $date="全日";
        $url=$arr['surl'];//本祭後は次のように変更
        //$url="#";
        $exhibit=$arr['exhibition'];
        $shop="";
        $live=$arr['live'];
    }elseif($code==$arr['live']){
        $type="live";
        $date=$arr['datetime_text'];
        $exhibit=$arr['exhibition'];
        $shop=$arr['shop'];
        $live="";
        $urls=array('','','');//第1回から第3回に対応。アクセス時間に公演中ならここに入る。
        for($i=1;$i<4;$i++){
            $start=$arr['time_'.$i.'_start'];
            $end=$arr['time_'.$i.'_end'];
            $start=strtotime($start ."- 5 minutes");
            $end=strtotime($end);
            $today=strtotime($today);
            if($today>$start && $today<$end){
                $urls[$i-1] = $arr['time_'.$i.'_url'];
            }
        }
        if(mb_strlen($urls[0])>0){
            $url=$urls[0];
        }elseif(mb_strlen($urls[1])>0){
            $url=$urls[1];
        }elseif(mb_strlen($urls[2])>0){
            $url=$urls[2];
        }else{$url="/events/general/exchange.php";}
        
    }else{$type="";}
    $array=array(
        'code'=>$code,
        'type'=>$type,
        'main'=>h($arr['main']),
        'sub'=>h($arr['sub']),
        'date'=>h($date),
        'title'=>h($arr['event_name']),
        'group'=>h($arr['group_name']),
        'message'=>h($arr['message']),
        'url'=>$url,
        'exhibition'=>$exhibit,
        'shop'=>$shop,
        'live'=>$live,
    );
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>企画紹介（<?php echo($array['title']);?>）｜京都大学11月祭</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" href="../../css/common.css">
        <link rel="stylesheet" type="text/css" href="../../slick/slick.css">
        <link rel="stylesheet" type="text/css" href="../../slick/slick-theme.css">
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
              <img src="https://nf.la/image/general.jpg">
            </div> 
            <fab-entry></fab-entry>
            </div>
            <div id="pnkz">
              <ul>
                <li class=pnkz_top><a href="/index.html"><i class="fas fa-home"></i>トップ</a></li>
                <li><a href="/events/index.html">本年度11月祭</a></li>
              </ul>
            </div>
            <h1 class="pagetitle"><?php echo($array['title']);?></h1>
            <h5 class="right"><?php echo($array['group']);?></h5>
           
            <div class="card-unshown">
            <h3 class="circlehead">企画紹介文</h3>
            <p class="narrative"><?php echo($array['message']);?></p>
                <h3 class="circlehead">企画種別</h3>
               <p class="narrative"><?php
                if($array['type']=="exhibition"){
                    echo('展示');
                }elseif($array['type']=="shop"){
                    echo('物販');
                }elseif($array['type']=="live"){
                    echo('ライブ');
                }
                ?>形式</p>
                <h3 class="circlehead">企画日時</h3>
                <?php
                $datearray=[];
                $datearray=explode(',',$array['date']);
                foreach($datearray as $datetime){
                    echo '<p class="narrative">'.$datetime.'</p>';
                }
                 echo '<a class="card-small" href='.$url.' v-if="today>nfstart" target="_blank">企画に参加する</a>';
                ?>
            </div>
                <h2>関連の企画</h2>
                <p class="narrative">同一の団体が出展している企画です。なお、本企画も含めて表示されます。</p>
                <related-plans></related-plans>
                <kkk-general></kkk-general>
        </div><!--wrap閉じ-->
        <fab-confirm></fab-confirm>
        <gnav-side></gnav-side>
        <footer-menu></footer-menu>
      </div><!--all閉じ-->
      <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/js/jquery.min.js"><\/script>');</script><!--JqueryCDNのフォールバック-->
      <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
      <script>window.Vue || document.write('<script src="/js/vue.min.js"><\/script>')</script><!--VueCDNのフォールバック-->
      <!--<script type="text/javascript" src="../slick/slick.min.js"></script>-->
      <script type="text/javascript" src="/script/jquery.inview.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
      <script>
            var title="<?php echo($array['title']);?>";
            var author1="（企画紹介）<?php echo($array['group']);?>";
            var type="<?php echo($array['type']);?>";
            var date="<?php echo($array['date']);?>";
            var main="<?php echo($array['main']);?>";
            var sub="<?php echo($array['sub']);?>";
            Vue.component('related-plans',{
                data:function(){
                    return{
                        keyword:'<?php echo($array['group']);?>',
                        type:'',
                        label:'',
                        items:[],
                        main:'main'
                    }
                },
                mounted:function(){
                    this.search();
                },
          methods:{
            search:function(){
            var self=this;
            posting=[this.keyword];
            axios
              .post('../search.php',posting,{ headers: {'X-Requested-With': 'XMLHttpRequest'} })
              .then(function(res){
                self.items=res.data;
              })
            }
          },
          template:'<div class="card-unshown">'+
            '<div class="flex-container">'+
            '<search-result v-for="item in items" :key="item.url+main" :result-item="item" :search-type="type" :search-label="label" :sub-main="main"></search-result>'+//こちらはメインタグに基づく表示
            '</div>'+
            '</div>'
            })
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
               "@id": "/events/search/index.php?c=<?php echo($array['title']);?>",
               "name": "本年度11月祭"
             }
            }
           ]
          }
          </script>
    </body>
</html>


