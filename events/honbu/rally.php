<?php
require_once('../../php_helpers/config.php');
require_once('../../php_helpers/db_helper.php');
$sql="select * from messages order by id";
$pdo=get_db_connect();
$stmt=$pdo->prepare($sql);
$stmt->execute();
$data=array();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  $data[]=$row;//本来ならこの後XSS対策をしないといけないが、今回はVueにデータを渡すのでそっちでXSS対策はできる。
}
$data=json_encode($data);
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>NFクイズラリー｜京都大学11月祭</title>
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
          .msg_show{
            position:absolute;
            bottom:5px;
            left:5px;
            z-index:10;
            background-color:#e6a;
            color:#fff;
            font-size:16px;
            border:none;
            border-radius:5px;
            box-shadow:1px 1px 1px #000;
          }
          .rally-partial{
            background:url("../../image/rally_back.png");
            background-repeat:repeat;
            background-size:75px 75px;
          }
          .msgarea{
            width:100%;
            display:flex;
            flex-flow:row wrap;
            justify-content:space-around;
          }
          .msg-card{
            
            background-color:rgba(256,256,256,0.7);
            border-radius:10px;
            margin:5px;
            
            
          }
          .msg-back{
            flex:0 0 250px;
            position:relative;
            margin-top:60px;
            background-color:#DEB887;
            padding:5px;
            box-sizing:border-box;
            box-shadow:2px 2px 5px #aaa;
            min-height:100px;
            line-height:1;
            font-family:serif;

            /*border-width:50px 18px 0;
            border-style:solid;
            border-color:#ffa transparent;*/
          }
          .msg-back:before{
            position:absolute;
            content:"";
            border-width:0 125px 50px;
            border-style:solid;
            border-color:#DEB887 transparent;
            height:0;
            width:0;
            top:-50px;
            left:0;
          }
          .msg-back p{
            /*position:relative;
            top:5px;
            left:5px;*/
            font-size:14px;
            font-family:sans-serif;
          }
          .rally-spacer{
            flex:3 0 300px;
            background:url('../../image/rally-space.png');
            background-size:cover;
            background-repeat:no-repeat;
            background-position:center center;
          }
          .rally-content{
            flex: 1 0 300px;
            margin: 0 auto;
            display: flex;
            flex-flow: row wrap;
            justify-content: space-around;
            align-content: space-around;
            position:relative;
          }
          .msg-all{
            flex:1 0 300px;
            background-color:rgba(256,256,256,0.5);
            border:1px solid #ddd;
            box-sizing:border-box;
            padding:5px;
          }
        </style>
        <style>
          
          
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
          <div id="mainVisual" class="eventVisual"><!--ここあとで変更する。class="eventVisual"-->
            <div class="eventmain">
              <img src="https://nf.la/image/plans/stamp.jpg">
            </div>
            <fab-entry></fab-entry>  
          </div>
          <div id="pnkz">
            <ul>
              <li class=pnkz_top><a href="/index.html"><i class="fas fa-home"></i>トップ</a></li>
              <li><a href="/events/honbu/rally.php">NFクイズラリー</a></li>
            </ul>
          </div>
           <h1 class="pagetitle">NFクイズラリー</h1>
           <p class="narrative">今年のNFは前代未聞の春開催。新しい一歩を踏み出す季節にちなんで、みなさんの「春から頑張ること」を募集します。公式Webサイトに隠された謎解きを解くと参加できます。どしどしご応募ください。素敵なプレゼントがもらえるかも…?!</p>
           <button class="change_tab tab_double" :class="{tab_show:flag==1}" @click="flag=1">メッセージ</button>
           <button class="change_tab tab_double" :class="{tab_show:flag==2}" @click="flag=2">企画紹介</button> 
          <div v-show="flag==1">
            <h2>メッセージ</h2>
            <p class="narrative" v-if="nfstart>today">まだメッセージはありません。</p> 
         <msg-component v-if="today>nfstart"></msg-component>
         <a class="card-small narrative" href="./rally/index.html" v-if="today>nfstart&&nfend>today">メッセージ投稿はこちらから</a>
            <p class="narrative" v-if="today>nfstart&&nfend>today">※ユーザー名にnfonline,パスワードにクイズを解いて得られた合言葉を入力して下さい。すべて半角英数字です。</p>
        </div>
           <div v-show="flag==2">
           <h2>クイズラリーの歩き方</h2>
           <ol>
             <li>各企画ページ上にランダムに表示されるクイズに答えよう！クイズは全部で6問あります。もしかしたらガイドマップにヒントが隠れているかも……(クイズラリーのアイコンは5秒で消えるのでご注意下さい)。</li>
             <li>クイズに正解するとキーワードが得られます！第一問から順番に並べるとある合言葉が浮かび上がってきます！</li>
             <li>合言葉を入力して「春から頑張ること」の投稿ページでみんなの思いを共有しよう！さらに抽選で素敵な景品が当たります！！</li>
           </ol>
           <h2>メッセージ投稿について</h2>
           <p class="narrative">「春から頑張ること」を募集します。メッセージ投稿は下のボタンから！</p>
           <a class="card-small narrative" href="./rally/index.html" v-if="today>nfstart&&nfend>today">合言葉を見つけた方はこちら</a>
           <p class="narrative" v-if="today>nfstart&&nfend>today">※ユーザー名にnfonline,パスワードにクイズを解いて得られた合言葉を入力して下さい。すべて半角英数字です。</p>
           <h2>景品について</h2>
           <a class="card-small narrative" href="./rally/index.html" v-if="today>nfstart&&nfend>today">景品応募ページへ</a>
           <p class="narrative" v-if="today>nfstart&&nfend>today">※ユーザー名にnfonline,パスワードにクイズを解いて得られた合言葉を入力して下さい。すべて半角英数字です。</p>
           <div class="flex-container card-unshown">
           <div class="e-imgarea">
              <div class="e-img"><img class="fitimg" src="https://nf.la/image/plans/goods.jpg"></div>
            </div>
            <div class="e-textarea">
              <p class="narrative">【抽選5名様】QUOカードPay 1000円分をプレゼント</p>
              <p class="narrative">【抽選10名様】11月祭オリジナルグッズのトートバッグ・クリアファイルをプレゼント</p>
              <p class="narrative">【抽選10名様】11月祭オリジナルグッズのマスクケース・クリアファイルをプレゼント</p>
              <p class="narrative">オリジナルグッズの詳細は、<a href="/events/general/shop.html#goods" class="text_link" target="_blank">このページ</a>をCHECK！※クリアファイルの絵柄を選ぶことはできません。</p>
            </div>
            </div>
           </div>

           

           <kkk-general></kkk-general>
          </div><!--wrap閉じ-->
       <fab-confirm></fab-confirm>
       
        <gnav-side></gnav-side>
        <footer-menu></footer-menu>
       
          </div><!--all閉じ-->
          <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
          <script>window.jQuery || document.write('<script src="/js/jquery.min.js"><\/script>');</script><!--JqueryCDNのフォールバック-->
          <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/"></script>
          <script>window.Vue || document.write('<script src="/js/vue.min.js"><\/script>')</script><!--VueCDNのフォールバック-->
          <script type="text/javascript" src="https://nf.la/script/jquery.inview.min.js"></script>
          <!--<script type="text/javascript" src="./slick/slick.min.js"></script>-->
          <script>
             var title="NFクイズラリー";
            var date="全日";
            var author1="11月祭本部";
            var type="exhibition";
            var main="生活・サブカルチャー";
            var sub="パズル・クイズ・ゲーム";
            var data=<?php echo($data);?>;

            Vue.component('msg-component',{
              data:function(){
                return{
                  items:data,
                  all:false,
                  sort:0,
                }
              },
              computed:{
                reverse:function(){
                  return this.items.slice().reverse();
                },
                shuffle:function(){
                  array = this.items.slice();
                  for (i = array.length; 1 < i; i--) {
                  k = Math.floor(Math.random() * i);
                 [array[k], array[i - 1]] = [array[i - 1], array[k]];
                  }
                return array;
                },
                short:function(){
                  if(this.items.length<3){
                    return this.shuffle;
                  }else{
                    return this.shuffle.slice(0,3);
                  }
                }
              },
              template:'<div>'+
              '<label v-show="all">メッセージ表示順<select v-model="sort" name="sort"><option value=0>ランダム</option><option value=1>古い順</option><option value=2>新しい順</option></select></label>'+
                '<div class="rally-partial flex-container">'+
                  '<div class="rally-spacer" v-show="!all"></div>'+
                  '<div class="rally-content">'+
                      '<button class="msg_show" @click="all=!all"><i class="fas fa-expand-alt" v-show="!all"></i><i class="fas fa-compress-alt" v-show="all"></i></button>'+
                      '<div v-show="!all" class="msgarea"><div class="msg-back" v-for="item in short"><p>{{item.msg}}</p><p class="right">{{item.account}}</p></div></div>'+
                      //'<div v-show="all" class="msgarea"><div class="msg-card" v-for="item in shuffle"><div class="msg-back"><p>{{item.msg}}</p><p class="right">{{item.account}}</p></div></div></div>'+
                      '<div v-show="all" class="msgarea">'+
                        '<div v-for="item in shuffle" class="msg-all" v-show="sort==0"><p>{{item.msg}}</p><p class="right">{{item.account}}</p></div>'+
                        '<div v-for="item in items" class="msg-all" v-show="sort==1"><p>{{item.msg}}</p><p class="right">{{item.account}}</p></div>'+
                        '<div v-for="item in reverse" class="msg-all" v-show="sort==2"><p>{{item.msg}}</p><p class="right">{{item.account}}</p></div>'+
                      '</div>'+
                  '</div>'+
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
                "@id": "/events/honbu/rally.html",
                "name": "NFクイズラリー"
              }
             }
           ]
          }
          </script>
    </body>
</html>


