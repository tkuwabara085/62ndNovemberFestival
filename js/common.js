var today=new Date();//なんだかんだとつかいそうなので
//メニューなど汎用パーツの中身を定義する配列
var news = [//「お知らせ」に表示するもの
    {id:'radio',title:'ラジオ企画メッセージ募集',date:'1/15',url:'/news.html#radio',content:'オンラインで行う本部ラジオ企画へのメッセージを募集します。',link:'https://nf.la/events/honbu/radio.html'},

]
var topics = [//TOPのメインビジュアルの中身
    {content:'オンライン11月祭の歩き方',url:'/guide.html',image:'/image/article/walking.jpg'},
    {content:'統一テーマ',url:'/themes.html',image:'/image/main/00.jpg'},
    {content:'公式パンフレット',url:'/pamphlet62/index.html',image:'/image/main/06.jpg'},
    {content:'今年度延期開催', url:'/events/index.html',image:'/image/main/03.jpg'},
    {content:'本部講演', url:'/events/honbu/lecture.html',image:'/image/plans/koen.jpg'},
]
var others = [//正直どっちでも良いメニュー
    {name:'お知らせ',url:'/news.html'},
    {name:'ご協賛いただいた皆様',url:'/sponsor.php'},
    {name:'お問い合わせ',url:'https://nf.la/office/index.html#contact'},
    {name:'プライバシーポリシー',url:'https://nf.la/office/index.html#privacy'},
]
var honbu=[
  {title:'研究室企画',content:'京都大学で行われている研究の内容やその成果を発表する企画です。',url:'/events/honbu/labs.html'},
  {title:'本部講演',content:'京大の研究者などによる講演です。',url:'/events/honbu/lecture.html'},
  {title:'本部ラジオ企画',content:'11月祭本部からVTuberを利用した配信を行います。',url:'/events/honbu/radio.html'},
  {title:'京大ガイドマップ',content:'京大の建物や例年の11月祭の様子を紹介する企画です。',url:'/events/honbu/map.html'},
  {title:'NFクイズラリー',content:'ウェブサイトを回って謎を解くと、「春から頑張ること」を投稿できます。',url:'/events/honbu/rally.php'},
  {title:'オリジナルグッズ',content:'11月祭オリジナルグッズを販売します。',url:'/events/general/shop.html#goods'},
]
var general=[
  {title:'オンラインショップ',content:'物販を行う11月祭オンラインショップへはこちらから',url:'/events/general/shop.html'},
  {title:'タイムテーブル',content:'ライブ配信形式の交流企画タイムテーブルはこちらから',url:'/events/general/exchange.php'},
  {title:'企画検索',content:'企画検索機能をご利用いただけます。',url:'/index.html#topsearch'},
]
var booth=[
    {title:'模擬店企画',id:'mogi',content:'模擬店企画とは、11月祭において、飲食物を提供する模擬店を出店する企画のことです。本部構内と吉田南構内では、11月祭期間中にテントがずらりと並び、一般模擬店企画と１回生模擬店企画、環境に配慮した模擬店企画の合計で約110企画もの模擬店企画が出展されます。定番メニューはもちろん、11月祭以外ではなかなか食べられない貴重な料理も味わうことができます。',image:'/image/booth/mogi.jpg'},
    {title:'グラウンド企画',id:'ground',content:'グラウンド企画とは吉田南グラウンドだけでなく、本部構内や吉田南構内の様々なところで行われる屋外企画のことを指します。イベント企画ではライブやダンスなど、モニュメント企画では枠にとらわれない様々な展示が行われます。',image:'/image/booth/ground.jpg'},
    {title:'ステージ企画',id:'stage',content:'ステージ企画では朝から晩まで出演者がステージでパフォーマンスを行います。充実した音響機材を利用して、ダンスやバンドなど様々なパフォーマンスが行われ、出演者が楽しめるのは勿論、見ている人も一緒に盛り上がることができます。',image:'/image/booth/stage.jpg?=200908'},
    {title:'屋内企画',id:'okunai',content:'例年11月祭期間中には、普段講義が行われている教室でもおまつりが開催されます！LIVE、講演会、カフェや展示など、屋内企画ならではの京大生が趣向を凝らしたユニークな企画が盛りだくさん！あなたの興味のあるものが必ず見つかるはずです！',image:'/image/booth/okunai.jpg'},
    {title:'自主制作演劇企画',id:'jise',content:'11月祭では音響や照明といった設備が整っている舞台を11月際事務局や他サークルの協力によって4共11の教室に設置し、有志の演劇、コントや狂言、サークルの公演が行われます。一公演15分から1時間半程度と自由に公演を行い、内容も自由としています。どの企画も独創的で魅力的な公演を行ってくれます。是非一度足を運んで下さい。',image:'/image/booth/jise.jpg'},
    {title:'映画祭典',id:'eisai',content:'11月祭期間中、本部構内の一室を使用して映画を上映しています！広い教室でゆっくり映画を楽しんでいただける企画です。上映作品は毎年テーマに沿って選んでおり、昨年は「アメリカ映画総復習」というテーマで「フォレスト・ガンプ」など有名アメリカ映画を4作品上映しました。',image:'/image/booth/eisai.jpg'},
    {title:'オリジナルグッズ',id:'goods',content:'京都大学11月祭では毎年、会場限定のオリジナルグッズを製作・販売しています。事務局員が心を込めて一つひとつデザインしたグッズの数々は、11月祭の来場記念品として毎年たくさんの方にお買い求めいただいています。その他にも、京都女子大学さんと合同で作製したコラボレーショングッズの販売も行っています。',image:'/image/booth/goods.jpg'},
    {title:'ガイドツアー',id:'guidetour',content:'11月祭本部が開催する京大ガイドツアーは、11月祭の恒例企画のひとつです！（当然ながら）現役京大生である事務局員の解説とともに構内をめぐり、ためになる情報からくすっと笑える小ネタまで、京都大学についての様々な情報を知ることができます。事務局員と直接話すこともでき、京大を身近に感じられる企画です！',image:'/image/booth/guidetour.jpg'},
    {title:'研究室企画',id:'kenki',content:'例年、11月祭では研究室企画と題して、京都大学で行われている研究の内容やその成果を発表する場を設けています。中には、実際に触れたり、体験したりといった形態の発表もあり、研究について肌で感じることができます。大学院の研究室やゼミなどで日頃どのような研究が行われているのかを知ることのできる貴重な機会となっており、多くの方に来場していただいています。',image:'/image/booth/kenki.jpg'},
    {title:'スタンプラリー',id:'stamp',content:'11月祭では例年スタンプラリーを実施しています。京都大学の様々なところにあるスタンプを集めましょう。スタンプ台にはその場所にちなんだ情報が載っているので、京都大学のことをより深く知ることができます。また、スタンプを全て集めると素敵な景品と交換できます。',image:'/image/booth/stamp.jpg'},
    {title:'Special Live',id:'sl',content:'11月祭では毎年、Special Liveと称してゲストをお招きし、ライブを行って頂きます。昨年度はシンガーソングライターの井上苑子さんにお越し頂きました。毎年大盛況の人気企画です。',image:'/image/booth/sl.jpg'},
    {title:'タイムレター',id:'timeletter',content:'１年後の自分に手紙を書いてみませんか。11月祭期間中おまつり広場中央テントで自分や大切な人に手紙を書くと、１年後、11月祭が近づいた時にお届けさせていただきます。11月祭に来た思い出にぜひご参加ください。',image:'/image/booth/timeletter.jpg'},
    {title:'フリーマーケット',id:'fleamarket',content:'おまつり広場西の通路にて開催されるフリーマーケットは京大生のみならず全ての人が参加できる本部企画です。あなたのお気に入りの逸品を思わぬところで見つけることができます。',image:'/image/booth/fleamarket.jpg'},
    {title:'古本・古レコード市',id:'furufuru',content:'11月祭では京大生や近隣の方々から提供していただいた古本や古レコードなどを販売しています。毎年多くの方がお気に入りの本やレコードを探しに来られます。懐かしのレコードから専門書や最新の漫画なども揃っているのが魅力です。立ち寄るだけでも楽しめる場所となっています。',image:'/image/booth/furufuru.jpg'},
    {title:'本部講演',id:'koen',content:'本部講演では、例年主に学術界でご活躍なさっている有名・著名な方を講師としてお呼びし、貴重な講演をいただいています。昨年度は京都大学教授阿部竜先生と大阪大学栄誉教授石黒浩先生にお越しいただきました。',image:'./image/booth/koen.jpg'},
    {title:'Finale&FIRE',id:'finale',content:'11月祭の最後を締めくくるのがFinaleです。ステージでは様々な団体による熱気のこもったパフォーマンスだけでなく、観客も参加できるビンゴ大会（NF de BINGO）も行われます！また、Finaleの最後にはグラウンド中央で大きなキャンプファイヤーも行います。その迫力は必見です！',image:'/image/booth/finale.jpg'},
]
var plans=[
  {title:'オンライン屋内ステージ企画',id:'indoor',content:'仮設の劇場で撮影した演劇・コントなどの動画を配信します。',image:'/image/plans/okunai.jpg'},
  {title:'オンライン屋外ステージ企画',id:'okugai',content:'屋外で撮影した動画を配信します。',image:'/image/plans/okugai.jpg'},
  {title:'オンラインライブハウス企画',id:'livehouse',content:'屋内の仮設ステージで撮影したバンドなどの動画を配信します。',image:'/image/plans/livehouse.jpg'},
  {title:'オンライン展示企画',id:'exibition',content:'ウェブサイト上に企画出展者が自作した動画・画像や説明文などを掲載します。',image:'/image/plans/exibition.jpg'},
  {title:'オンライン交流企画',id:'exchange',content:'皆様がオンライン上で交流する企画形態です。',image:'/image/plans/exchange.jpg'},
  {title:'11月祭オンラインショップ',id:'shop',content:'企画出展者によるグッズなどの販売をオンラインで行います。11月祭本部によるオリジナルグッズ販売も検討されています。',image:'/image/plans/shop.jpg'},
  {title:'研究室企画',id:'lab',content:'京都大学で行われている研究の内容やその成果を発表する場を設けます。ウェブサイト上に動画や画像・説明文を掲載する形で行うことを予定しています。',image:'/image/plans/lab.jpg'},
  {title:'本部講演',id:'koen',content:'京大の研究者による講演や京大生参加型バラエティ企画などを通して、京大で進められている様々な研究を色々な形で紹介する予定です。動画を配信する形で行います。',image:'/image/plans/koen.jpg'},
  {title:'本部ラジオ企画',id:'radio',content:'11月祭本部からVTuberを利用した配信を行うことを検討中です。',image:'/image/plans/radio.jpg'},
  {title:'京大ガイドツアー',id:'guide',content:'毎年人気の京大ガイドツアー。本年度はWeb上で代替企画を行います。',image:'/image/plans/guide.jpg'},
  {title:'スタンプラリー',id:'stamp',content:'毎年恒例のスタンプラリー。オンライン開催時にも通常とは異なる形式とはなりますが開催を検討しています。',image:'/image/plans/stamp.jpg'}, 
]
var articles=[
  {title:'11月祭の「歩き方」',text:'オンライン11月祭の楽しみ方をご紹介します。',url:'/guide.html',img:'./image/article/walking.jpg'},
  {title:'オンライン延期開催',text:'本年度11月祭は3月26日～28日にオンラインで開催します。',url:'/events/index.html',img:'./image/article/online.jpg'},
  {title:'統一テーマ',text:'本年度11月祭統一テーマは「NFのミーティングIDとパスワード教えてください」です。',url:'/themes.html',img:'./image/article/theme.jpg'},
  {title:'11月祭とは',text:'例年の11月祭の様子を紹介しています。',url:'/about.html',img:'./image/article/about.jpg'},
  {title:'11月祭に関する宣言',text:'11月祭全学実行委員会においてなされた宣言・決議を掲載しています。',url:'/declaration.html',img:'./image/article/declaration.jpg'},
  {title:'事務局長のページ',text:'11月祭事務局長挨拶を掲載しています。',url:'/headofficer.html',img:'./image/article/head.jpg'},
]
var url=window.location.href;//当該ページのURLを取得。fab-entryコンポーネント中で利用する。
Vue.component('fab-entry',{//お気に入り登録ボタン
  data:function(){
    return{
      storagelen:localStorage.length,//ストレージのデータの個数を取得
      is_set:localStorage.getItem(url)//url(当該ページのURLが代入される)をキーとするストレージデータを取得。なければnullが返ってくる。
    }
  },
  computed:{//状態判定。何かしら登録されてるか否かで表示が変わるため
    is_entry:function(){
      if(this.storagelen >= 1){
        if(this.is_set != null){
          return true
        }else{
          return false
        }
      }else{
        return false
      }
    }
  },
  methods:{
    entry:function(){
      if(this.is_entry!=true){
        var array = [];
        var obj = {//データをオブジェクトにして
          'url': url,
          'title': title,//企画名。このファイル内では定義していない。
          'group':author1,//団体名
          'date':date,//開催日のテキストデータ
          'type':type,//企画形態
          'main':main,//メインタグ
          'sub':sub,//サブタグ
        };
       array.push(obj);
        var setjson = JSON.stringify(obj);//JSONに変換
        localStorage.setItem(url,setjson);//登録。キーはURL
      }else{
        delete localStorage[url];//削除
      }
      this.storagelen=localStorage.length;//dataを更新
      this.is_set=localStorage.getItem(url);
    }
  },
  template:'<div class="fab-btn" @click="entry"><i class="far fa-heart" v-show="is_entry!=true"></i><i class="fas fa-heart" v-show="is_entry==true"></i>お気に入り</div>'
})
Vue.component('fab-confirm',{
  data:function(){
    return{
      flag:false,//fab-confirmコンポーネントのアイコン以外の部分の表示切り替え用
      is_set:localStorage.length,
      arr:[],//お気に入りのカードのデータ。ここにlocalStorageのデータをオブジェクト化して入れる
      type:"",//検索用。何か選択したら展示・ライブ・ショップのどれかが入る
      label:"",//検索時の並べ替え。何か選択したらそのラベル名が入る
      labels:['科学','社会','文学・アート','演芸・パフォーマンス','音楽','スポーツ','生活・サブカルチャー','パズル・クイズ・ゲーム'],//ラベルのリスト。一々HTML書くのがめんどくさいので
      main:'main',//このあたりはsearch-resultコンポーネントに渡すためのもの。mainという文字列を渡す。
      sub:'sub',//このあたりはsearch-resultコンポーネントに渡すためのもの。subという文字列を渡す。
    }
  },
  computed:{
    is_exist:function(){
      if(this.is_set==0){
        return false;
      }else{
        return true;
      }
    },
  },
  mounted:function(){
    this.strToArray();
  },
  methods:{
    strToArray:function(){
      for(var i=0; i < localStorage.length; i++){
        var key = localStorage.key(i);
        var getjson = localStorage.getItem(key);
        var data = JSON.parse(getjson);
        this.arr.push(data);
      }
    },
    change:function(){
      if(this.flag==false){//表示するときは最新の状態にデータを更新したいので
        this.arr=[];//いったん初期化
        this.strToArray();//データを入れ直す
        this.flag=true;
        this.is_set=localStorage.length;//is_existを再計算させる。computedはdataが変更されると再計算。
      }else{
        this.flag=false;//表示を隠すときはこれだけでいい。
      }       
    },
  },
  template:'<div><button @click="change" class="fab-con-btn"><i class="fas fa-heart"></i></button>'+
  '<div class="fab-area" v-show="flag==true">'+
  '<h3 class="fab-con">お気に入り一覧</h3>'+
  '<label>形態別<select v-model="type" name="type"><option value="">指定なし</option><option value="exhibition">展示</option><option value="live">ライブ</option><option value="shop">物販</option></select></label><br>'+
  '<label>分野別<select v-model="label" name="label"><option value="">指定なし</option><option v-for="item in labels" :value="item">{{item}}</option></select></label>'+
  '<p v-show="!is_exist">企画のページでお気に入りボタンを押すと、ここにまとめることができます。</p><p v-show="!is_exist">閲覧履歴が残らない設定の場合、この機能はご利用いただけません。JavaScriptの設定を許可してください。</p>'+
  '<div class="flex-container">'+
  '<search-result v-for="item in arr" :key="item.url+main" :result-item="item" :search-type="type" :search-label="label" :sub-main="main"></search-result>'+//こちらはメインタグに基づく表示item.url+mainをkeyにしてるのはkeyが重複しないようにするため。
  '<search-result v-for="item in arr" :key="item.url+sub" :result-item="item" :search-type="type" :search-label="label" :sub-main="sub"></search-result>'+//こちらはサブタグに基づく表示
  //'<fab-card v-for="item in arr" :key="item.url" :fab-item="item" :fab-type="type" :fab-label="label"></fab-card>'+
  //'<a class="fab-card" v-for="item in arr" :href="item.url" :key="item.url" v-show="type==">'+
  //'<h5 class="fab-title">{{item.title}}</h5><div class="flex-container"><p class="fab-date"><i class="fas fa-clock"></i>{{item.date}}</p><p class="fab-group">{{item.author1}}</p></div></a>'+
  '</div>'+
  '</div></div>'
})
Vue.component('search-result',{
  props:{
    resultItem:{
      type:Object,
      required:true,
    },
    searchType:{
      type:String,
      required:true,
    },
    searchLabel:{
      type:String,
      required:true,
    },
    subMain:{//subという文字列が渡されるかmainという文字列が渡されるかによって表示が切り替わる。
      type:String,
      required:true,
    }
  },
  computed:{
    isType:function(){
      if(this.searchType==""||this.searchType==this.resultItem.type){
        return true
      }else{
        return false
      }
    },
    isLabel:function(){
      if(this.subMain=="main"){
        if(this.searchLabel==""||this.searchLabel==this.resultItem.main){
          return true
        }else{
          return false
        }
      }if(this.subMain=="sub"){
        if(this.searchLabel!=""&& this.searchLabel==this.resultItem.sub){
          return true
        }else{
          return false
        }
      }
    },
    showIcon:function(){//企画形態によってアイコンを切り替える。
      if(this.resultItem.type=="exhibition"){
        return 1;
      }else if(this.resultItem.type=="shop"){
        return 2;
      }else if(this.resultItem.type="live"){
        return 3;
      }else{
        return 0;
      }
    },
    itemdate:function(){
      return this.resultItem.date.split(',');//これによってテキスト形式の開催日時データを配列に変更、回毎に改行することができる。
    }
  },
  template:'<a class="fab-card" v-show="isType&&isLabel" :href="resultItem.url">'+ 
    '<h5 class="fab-title"><i class="fas fa-desktop" v-if="showIcon==1"></i><i class="fas fa-shopping-cart" v-if="showIcon==2"></i><i class="fas fa-podcast" v-if="showIcon==3"></i>{{resultItem.title}}</h5><div class="flex-container"><div class="fab-date"><p v-for="item in itemdate">{{item}}</p></div><p class="fab-group">{{resultItem.group}}</p></div>'+
    '</a>'
})
Vue.component('gnav-side',{//サイドに表示されるメニュー
  data:function(){
    return{
      honbu:honbu,
      general:general,
      articles:articles,
      menu_others:others,
    }
  },
  template:'<nav id="gnav"><a href="/index.html"><h1 id=nav_title>京都大学<br>11月祭</h1></a>'+
    '<div style="background-color:#fff;margin:5px;border-radius:10px;" class="flex-center">'+
    '<a href="/index.html#topsearch" class="shortcut"><img class="shortcut-img" src="https://nf.la/image/icon/search.png"></a>'+
    '<a href="https://twitter.com/nfoffice/" class="shortcut" target="_blank"><img class="shortcut-img" src="https://nf.la/icon/twitter.png"></a>'+
    '<a href="https://www.youtube.com/channel/UCCjx8_y8kk7aWUx5J1XB39Q" class="shortcut" target="_blank"><img class="shortcut-img" src="https://nf.la/icon/youtube.png"></a>'+
    '</div>'+
    '<ul id="navi">'+
    '<li><a href="/index.html">TOP</a></li>'+
    '<li><button class="menu_btn">本部企画</button>'+
      '<ul class="menu_content">'+
      '<li v-for="item in honbu" v-bind:key="item.title"><a v-bind:href="item.url">{{item.title}}</a></li>'+
      '</ul></li>'+
    '<li><button class="menu_btn">一般企画</button>'+
    '<ul class="menu_content">'+
    '<li v-for="item in general" :key="item.title"><a :href="item.url">{{item.title}}</a></li>'+
    '</ul>'+
    '</li>'+
    '<li><button class="menu_btn">記事</button>'+
        '<ul class="menu_content" id="forAll">'+
          '<li v-for="item in articles" v-bind:key="item.title"><a v-bind:href="item.url">{{item.title}}</a></li>'+
        '</ul></li>'+
    '<li><button class="menu_btn">その他</button>'+
       '<ul class="menu_content">'+
        '<li v-for="item in menu_others" v-bind:key="item.name"><a v-bind:href="item.url">{{item.name}}</a></li>'+
        '<li><a href="https://penguin.nf.la/" target="_blank">PENGUIN</a></li>'+
        '</ul></li>'+
    '</ul></nav>'
})
Vue.component('footer-menu',{//この部分がフッター
  data:function(){
    return{
      honbu:honbu,
      general:general,
      menu_others:others,
      articles:articles,
    }
  },
  template:'<footer>'+
  '<ul id="f_menu_sns"><li><a href="https://twitter.com/nfoffice" target="_blank"><i class="fab fa-twitter"></i></a></li><li><a href="https://www.youtube.com/channel/UCCjx8_y8kk7aWUx5J1XB39Q" target="_blank"><i class="fab fa-youtube"></i></a></li></ul>'+
  '<ul id="menu_footer"><li>'+
      '<ul class="f_menu_normal"><li><a href="/index.html">TOP</a></li><li v-for="item in articles" :key="item.title"><a :href="item.url">{{item.title}}</a></li>'+
   '</ul></li>'+
    '<li class="footer_card"><h5 class="footer_heading">本部企画</h5>'+
      '<ul><li v-for="item in honbu" v-bind:key="item.title"><a v-bind:href="item.url">{{item.title}}</a></li></ul></li>'+
    '<li class="footer_card"><h5 class="footer_heading">一般企画</h5>'+
        '<ul><li v-for="item in general" v-bind:key="item.title"><a v-bind:href="item.url">{{item.title}}</a></li></ul></li>'+ 
    '<li class="footer_card"><h5 class="footer_heading">その他</h5>'+
      '<ul><li v-for="item in menu_others" v-bind:key="item.name"><a v-bind:href="item.url">{{item.name}}</a></li><li><a href="https://penguin.nf.la/" target="_blank">PENGUIN</a></li></ul></li>'+
  '</ul><small>&copy 2020-2021 京都大学11月祭事務局</small></footer>'
})
Vue.component('event-header',{//研企・展示のページのフローティングヘッダー
  data:function(){
    return{
      title:event_name,
      author1:author1,
      author2:author2,
    }
  },
  template:'<div class="eventheader">'+
           '<div class="e-head-content"><h1 class="pagetitle">{{title}}</h1><h5 class="right">{{author1}}</h5><h5 class="right">{{author2}}</h5>'+
           '<exchange-shop></exchange-shop></div>'+
           '<div class="e-head-spacer"></div>'+
           '</div>'
})
Vue.component('exchange-shop',{
  data:function(){
    return{
      text:extext.split(","),
      ttshow:false,
      shoplink:shoplink,
      exchange:[exfirst,exsecond,exthird],
      today:today,
      nfstart:new Date(2021,02,26,0,0,0),
      nfend:new Date(2021,2,29,0,0,0),
      exlink:'',
    }
  },
  computed:{
    isActive:function(){
      var array=[];
      for(var i=0;i<=2;i++){
        var obj=this.exchange[i];
        var start=obj.start.split(',');
        var end=obj.end.split(',');
        var url=obj.url;
        var sdate=new Date(start[0],start[1],start[2],start[3],start[4],start[5]);
        sdate.setMinutes(sdate.getMinutes()-5);
        var edate=new Date(end[0],end[1],end[2],end[3],end[4],end[5]);
        if(today>sdate&&today<edate){
          array[i]={url:url,state:true};
        }else{
          array[i]={url:url,state:false};
        }
      }
      first=array[0];
      second=array[1];
      third=array[2];
      if(first.state==true){
        this.exlink=first.url;
        return true;
      }else if(second.state==true){
        this.exlink=second.url;
        return true;
      }else if(third.state==true){
        this.exlink=third.url;
        return true;
      }else{
        this.exlink='';
        return false;
      }
    }
  },
  template:'<div class="flex-container">'+
  '<div class="e-head-btn"><a class="exchange-btn" target="_blank" v-if="text[0].length>0" :class={inactive:!isActive} :href="exlink"><i class="fas fa-podcast"></i>ライブ配信</a></div>'+
  '<div class="e-head-btn"><a class="shop-btn" :href="shoplink" target="_blank" v-if="shoplink.length>0&&today>nfstart&&nfend>today"><i class="fas fa-shopping-cart"></i>ショップ</a></div>'+
  '<div v-if="text[0].length>0" style="width:100%;"><button @click="ttshow=!ttshow" class="ts_btn"><i class="fas fa-clock"></i>スケジュール</button><div class="ts_area" v-show="ttshow==true"><h3>ライブ配信スケジュール</h3><p v-for="item in text"><i class="fas fa-clock"></i>{{item}}</p></div></div>'+
  '</div>'
})
Vue.component('news-table',{
    props:{
        newsItem:{
            type:Object,
            required:true
        }
    },
    template:'<li><h5>{{newsItem.date}}</h5><p><a class="text_link" v-bind:href="newsItem.url">{{newsItem.title}}</a></p></li>'
})
Vue.component('topic-list',{
    props:{
        topicItem:{
            type:Object,
            required:true
        }
    },
    template:'<li><a v-bind:href="topicItem.url"><img class="topics" v-bind:src="topicItem.image" v-bind:alt="topicItem.content"></a></li>'
})
Vue.component('main-menu',{
    data:function(){
      return{
        events:honbu,
      }
    },
    template:'<div class="flex-container"><a class="fab-card" v-for="item in events" :href="item.url"><h2 class="cardTitle">{{item.title}}</h2><p>{{item.content}}</p></a></div>'
})
Vue.component('top-articles',{
  data:function(){
    return{
      items:articles,
      show:0,
    }
  },
  template:'<div class="flex-container"><a v-for="(item,index) in items" @mouseover="show=index+1" @mouseleave="show=0" class="art-box" :href="item.url"><img class="art-img" :src="item.img"><div class="art-text" v-show="show==index+1"><div style="margin:30px 5px;"><h3>{{item.title}}</h3><p>{{item.text}}</p></div></div></a></div>'
})

Vue.component('kkk-general',{//top以外広告
    template:'<div class="KKK_outer"><div class="KKK_title">広告</div><div class="KKK"><a class="KKK_child" target="_blank"><img src="/img/KKK/gray.jpg" width="100%"></a><a class="KKK_child" target="_blank"><img src="/img/KKK/gray.jpg" width="100%"></a></div></div>'
})
Vue.component('top-kkk',{//top広告
  template:'<div class="topKKK-wrap"><div class="title">広告</div>'+
  '<div class="top-KKK slick_KKK">'+
  '<a class="item _resetA" id="T01" href="https://www.aaconst.co.jp/" target="_blank"><div class="image"><img src="/img/KKK/T01.jpg" width="100%" alt="青木あすなろ建設株式会社"></div><h3>青木あすなろ建設株式会社</h3></a>'+
  '<a class="item _resetA" id="T02" href="https://www.nipponsteel.com/" target="_blank"><div class="image"><img src="/img/KKK/T02.jpg" width="100%" alt="日本製鉄株式会社"></div><h3>日本製鉄株式会社</h3></a>'+
  '<a class="item _resetA" id="T03" href="https://saiyo.24028.jp/" target="_blank"><div class="image"><img src="/img/KKK/T03.jpg" width="100%" alt="株式会社西松屋チェーン"></div><h3>株式会社西松屋チェーン</h3></a>'+
  '<a class="item _resetA" id="T04" href="http://contact.kyo-con.or.jp/" target="_blank"><div class="image"><img src="/img/KKK/T04.jpg" width="100%" alt="株式会社京都コンタクトレンズ"></div><h3>株式会社京都コンタクトレンズ</h3></a>'+
  '</div>'+
 '</div>'
})
Vue.component('article-headline',{
    props:{
        articleItem:{
            type:Object,
            required:true,
        }
    },
    template:'<li><article class="card-large" :id="articleItem.id"><h2 class="cardTitle">{{articleItem.title}}</h2><h5 class="right">{{articleItem.date}}</h5><p>{{articleItem.content}}</p><a :href="articleItem.link" class="card-small">詳しく</a></article></li>'
})
Vue.component('booth-menu',{
    props:{
        boothMenu:{
            type:Object,
            required:true,
        }
    },
    template:'<li><a :href="`#${boothMenu.id} `" class="card-small" style="margin:5px;">{{boothMenu.title}}</a></li>'
})
Vue.component('booth-list',{
    props:{
        boothItem:{
            type:Object,
            required:true,
        }
    },
    template:'<li><article class="card-large" :id="boothItem.id"><h2 class="cardTitle">{{boothItem.title}}</h2><div class="flex-container"><img class="imageWithCaps" :src="boothItem.image"><div class="explanationWithImage"><p>{{boothItem.content}}</p></div></div></article></li>'
})
Vue.component('q-a',{
  data:function(){
      return {
          items:[],
          keyword:'',
          code:code,
          title:title,
      }
  },
  mounted:function(){
      this.search();
  },
  methods:{
      search:function(){
          var self=this;
          posting=[this.code,this.keyword]
          axios
          .post('../qanda.php',posting,{ headers: {'X-Requested-With': 'XMLHttpRequest'} })
          .then(function(res){
              self.items=res.data;
          })
      }
  },
  template:'<div><h2>ご質問への回答</h2><p>いただいたご質問への回答です。</p><p>※すべての質問に対してここで回答している訳ではございません。</p>'+
          '<div style="padding:10px;"><h3>検索</h3><div><p>キーワードから検索</p><input type="text" v-model="keyword" class="form-text"></div></div>'+
          '<div class="center"><button @click="search" class="search_btn">検索</button></div>'+
          '<q-a-card v-for="item in items" :key="item.question" :item-content="item"></q-a-card>'+
          '</div>'
})
Vue.component('q-a-card',{
  props:{
      itemContent:{
          type:Object,
          required:true,
      }
  },
  data:function(){
      return{
          showall:false,
      }
  },
  computed:{
      capital:function(){
          var title=this.itemContent.question;
          if(title.length>30){
              return title.substr(0,30);
          }else{
              return title;
          }
      }
  },
  template:'<div class="card-large flex-container"><button @click="showall=!showall" style="border:none;background-color:#ffcc25;color:#000;border-radius:5px;height:30px;"><i class="fas fa-chevron-down" v-show="!showall"></i><i class="fas fa-chevron-up" v-show="showall"></i></button><div><p class="cardTitle" v-show="showall==false">Q.{{capital}}...</p><p v-show="showall==true">Q.{{itemContent.question}}</p><p v-show="showall==true">A.{{itemContent.answer}}</p></div></div>'
})
Vue.component('rally-join',{
  data:function(){
    return{
      today:today,
      start:new Date(2021,2,26,0,0,0),
      end:new Date(2021,2,29,0,0,0),
      rand:Math.floor(3*Math.random()),
      join:false,
      time:0,

    }
  },
  computed:{
    show:function(){
      if(this.today>this.start&&this.today<this.end&&this.rand==2){
        return true
      }
    }
  },
  methods:{
    timer:function(){
      if(this.join==false){
        setTimeout(this.rallystop,5000);
      }
    },
    rallystop:function(){
      if(this.join!=true){
        this.rand=0;
      }
    }
  },
  mounted:function(){
    this.timer();
  },
  template:'<div><div class="rallyjoin" v-if="show" @click="join=true"><img width=100% src="https://nf.la/image/rally.png"></div>'+
  '<rally-card v-if="join==true&&show" @stop="rand=0"></rally-card>'+
  '</div>'
})
Vue.component('rally-card',{
  data:function(){
    return{
      selected:0,
      questions:[
        {question:'京都大学霊長類研究所の所在地はどこでしょうか。',answer:'愛知県',word:'h',option:['愛知県','京都府','北海道','大分県']},
        {question:'「イカ京」とはどのような人物を指しているでしょうか。',answer:'いかにも京大生',word:'a',option:['いかにも京大生','いかした京大生','いかれた京大生','いかんせん京大生']},
        {question:'西部講堂の屋根に描かれているものは何でしょうか。',answer:'星',word:'n',option:['星','ハート','楠','「京都大学」の文字']},
        {question:'第24代京都大学総長の尾池氏がプロデュースしたカンフォーラの名物メニューは何でしょうか。',answer:'総長カレー',word:'a',option:['総長カレー','総長ピザ','学長カレー','学長ピザ']},
        {question:'総合研究8号館地下にある食堂はどれでしょうか。',answer:'中央食堂',word:'m',option:['吉田食堂','中央食堂','北部食堂','カフェテリアルネ']},
        {question:'ドラマ「ガリレオ」の収録が行われたのはどこでしょうか。',answer:'法経本館',word:'i',option:['法経本館','附属図書館','百周年時計台記念館','吉田南総合館']},
      ]
    }
  },
  methods:{
    stop:function(){
      this.$emit('stop');
    }
  },
  template:'<div class="rally-back"><div class="rally-card"><div v-show="selected==0"><h2 class="cardTitle">NFクイズラリー</h2><p>どのクイズに挑戦しますか？</p>'+
    '<a href="/pdf/rally.pdf" target="_blank" class="card-small">ルール説明を見る</a>'+
    '<div class="flex-container">'+
    '<label class="rally-select"><input type="radio" v-model="selected" value=1 name="selected">第一問</label>'+
    '<label class="rally-select"><input type="radio" v-model="selected" value=2 name="selected">第二問</label>'+
    '<label class="rally-select"><input type="radio" v-model="selected" value=3 name="selected">第三問</label>'+
    '<label class="rally-select"><input type="radio" v-model="selected" value=4 name="selected">第四問</label>'+
    '<label class="rally-select"><input type="radio" v-model="selected" value=5 name="selected">第五問</label>'+
    '<label class="rally-select"><input type="radio" v-model="selected" value=6 name="selected">第六問</label></div>'+
    '</div>'+
    '<rally-quiz v-for="(item,index) in questions" v-show="index+1==selected" :quiz-item="item" :quiz-index="index" :key="item.question"></rally-quiz>'+
    '<button @click="stop" class="rally-close"><i class="fas fa-times-circle"></i></button>'+
    '</div></div>'
})
Vue.component('rally-quiz',{
  props:{
    quizItem:{
      type:Object,
      required:true,
    },
    quizIndex:{
      type:Number,
      required:true,
    }
  },
  data:function(){
    return{
      choise:'',
      option:this.quizItem.option
    }
  },
  computed:{
    before:function(){
      if(this.choise==""){
        return true;
      }else{return false;}
    },
    isright:function(){
      if(this.choise==this.quizItem.answer){
        return true;
      }else{return false;}
    },
    shuffleoption:function(){
      array = this.option;

      for (i = array.length; 1 < i; i--) {
      k = Math.floor(Math.random() * i);
     [array[k], array[i - 1]] = [array[i - 1], array[k]];
      }
    return array;
    }
  },
  template:'<div><h2 class="cardTitle">NFクイズラリー第{{quizIndex+1}}問</h2><p>正解するとパスワードの一部が表示されます。すべての問題を解いてパスワードを集めよう！</p><p>問題：{{quizItem.question}}</p>'+
    '<div class="flex-container" v-show="before">'+
    '<label class="rally-select" v-for="item in shuffleoption"><input type="radio" v-model="choise" :value="item" name="choise">{{item}}</label></div>'+
    '<div v-show="!before"><div v-show="isright"><h3>正解！<i class="fas fa-thumbs-up"></i></h3><p>答え：{{quizItem.answer}}</p><p>キーワードのヒントは「<span class="red">{{quizItem.word}}</span>」です。</p></div><div v-show="!isright"><h3>不正解！</h3><p>残念でした！<i class="far fa-comment-dots"></i></p></div></div>'+
    '</div>'
})

var vm=new Vue({
    el:"#all",
    data:{
        today:today,
        nfstart:new Date(2021,02,26,00,00,00),
        nfend:new Date(2021,02,29,00,00,00),
        topicItems:topics,
        newsItems:news,
        menu_others:others,
        booth:booth,
        flag:1,//tabなどの表示切り替え用
        plans:plans,
        clickimg:0,//クリックしたら画像を拡大表示するためのもの。一部のページしか使わないので本来グローバルに定義したくはないがコンポーネント化するのが難しかったため
      
    }
});


//以下カウントダウン
var today = new Date();
var targetDay = new Date(2021,2,26);// 月は0～11までで指定
remainDay = Math.floor((targetDay - today) / (24*60*60*1000));
remainDay++;  //開催前日の場合は残り0日になってしまうのを防止
if (remainDay > 0) {
  $('#counter').prepend("<p class='cd'>11月祭まであと<span>"+remainDay+"</span>日です。</p>");
} else if (remainDay < -2) {
  $('#counter').prepend("<p class='cd'>第62回11月祭は終了しました。たくさんのご来場ありがとうございました！</p>");
} else if (remainDay == -2){
  $('#counter').prepend("<p class='cd'>本日は第62回11月祭<span> 最終日 </span>です。</p>");
} else if (remainDay == -1){
  $('#counter').prepend("<p class='cd'>本日は第62回11月祭<span> 2日目 </span>です。</p>");
} else if (remainDay == 0){
  $('#counter').prepend("<p class='cd'>本日は第62回11月祭<span> 1日目 </span>です。</p>");
}

//smooth scroll//
$(function(){
    // ページ内リンクのスムーススクロール
    $('a[href^="#"]').click(function() {
      var href= $(this).attr("href");
      smoothscrl (href);
      return false; // これを追加すると実行時にちらつかないみたい
    });
  });
  
  function smoothscrl (href){ // リンクへスムーススクロールする関数
    // 固定ヘッダー高さ、固定ヘッダーがないので0
    var scrloffset = 0;
    // スクロール速度、単位はミリ秒
    var speed = 300;
    // 移動先を取得
    var target = $(href == "#" || href == "" ? 'html' : href);
    // 移動先を数値で取得、ずれを直す
    var position = target.offset().top - scrloffset;
    // スクロール
    $('body,html').animate({scrollTop:position}, speed, 'swing');
  }
  

//ここからはハンバーガーメニューとかの関係。nav要素の開閉に関するもの
  //nav内のメニュー開閉
$(function(){
    $("#navi").children("li").click(function(){
        $(this).children("ul").stop().slideToggle(100);
    });
});
//nav自体の開閉
$(function(){
    $(".closed").click(function(){
        $(".opened").stop().fadeIn(200);
        $(".closed").stop().fadeOut(200);
        $("#gnav").stop().animate({"width":"show"},200);
    })
});
$(function(){
    $(".opened").click(function(){
        $(".closed").stop().fadeIn(200);
        $(".opened").stop().fadeOut(200);
        $("#gnav").stop().animate({"width":"hide"},200);
    })
});
//このままだとブラウザがリサイズされたときにnavが表示されないことがあるので修正
function resizeWindow(){
    if(window.innerWidth>1000){
        $('#gnav').show();
        $('.groval').hide();
    }
    else{
      $('#gnav').hide();
      $('.closed').show();
      $('.opened').hide();
    }
}

$(window).resize(resizeWindow);
//ここまでnav要素の開閉に関するもの
//イベントページのヘッダー固定について
$(function(){
  if($(".eventheader").length){
    $(window).scroll(function(){
      var contenttop=$(".eventheader").offset().top;
      var scrolltop=$(window).scrollTop();
      var elwidth=$("#wrap").width();
      var cheight=$(".e-head-content").height();
      if(contenttop<=scrolltop){
        $(".e-head-content").css({"position":"fixed","top":"0","right":"0","width":elwidth}).addClass("shadow");
        $(".e-head-spacer").css({"display":"block","height":cheight});
      }else{
        $(".e-head-content").css({"position":"static","width":"100%"}).removeClass("shadow");
        $(".e-head-spacer").css("display","none")
      }
    })
  }
});
//ここまで

//ここからはトップページのSlick
var imageNum = $(".slider li").length;
if(imageNum){//要素が存在しなければ以下の処理をしない
  var initialImage=Math.floor(Math.random()*imageNum);
$('.slider').slick({
        centerMode:true,
        centerPadding:'100px',
        autoplay:true,
        autoplaySpeed:3000,
        dots:true,
        initialSlide:initialImage,
        arrows:false,
        centerMode:true,
        centerPadding:'20%',
        responsive:[
            {
                breakpoint: 1024,
                settings:{
                    centerPadding:'15%',
                }
            },
            {
                breakpoint: 768,
                settings:{
                    centerMode:false,
                }
            },
        ]             
    });
}



//TOPページ広告
// ========== 広告関連の処理 ==========
var KKKdataTop = {
    T01: {href: 'https://www.aaconst.co.jp/', src: '/img/KKK/T01.jpg', alt: '青木あすなろ建設株式会社'},
    T02: {href: 'https://www.nipponsteel.com/', src: '/img/KKK/T02.jpg', alt: '日本製鉄株式会社'},
    T03: {href: 'https://saiyo.24028.jp/', src: '/img/KKK/T03.jpg', alt: '株式会社西松屋チェーン'},
    T04: {href: 'http://contact.kyo-con.or.jp/', src: '/img/KKK/T04.jpg', alt: '株式会社京都コンタクトレンズ'},
  }
  // トップ広告の総数
  var KKKNumTotal = 4;
  // 表示されたことを記録する配列
  var recordArray = Array(KKKNumTotal);
  // ホントはfillメソッドを使いたかったが、これのせいでIEでslick発動しなかった
  // recordArray.fill(0);
  recordArray = [0, 0, 0, 0];
  
  // 最初に表示する広告のindexをランダムに選ぶ
  var initialKKK = getRandomInt(KKKNumTotal);
  // 現在の広告indexを格納する変数
  var currentSlideNum = initialKKK;
  // 現在広告が画面の範囲内かどうかを格納する変数
  var isKKKView = 0; // 0は範囲外、1は範囲内
  
  // 広告が画面内に入ったら広告表示を記録
  if($('.slick_KKK').length){
    $('.slick_KKK').on('inview', function(event, isInView) {
      if (isInView) {
        isKKKView = 1;
        if ( checkView(recordArray, isKKKView, currentSlideNum) ) {
          // POST送信？
          //console.log('inview');
          //console.log(getKKKid(currentSlideNum, true));
          sendKKK(getKKKid(currentSlideNum, true), 'inview', KKKdataTop);
        }
      } else {
        isKKKView = 0;
      }
    });
    // 広告がスライドされたら広告表示を記録
    $('.slick_KKK').on('afterChange', function(slick, currentSlideEle) {
      currentSlideNum = currentSlideEle.currentSlide;
      if ( checkView(recordArray, isKKKView, currentSlideNum) ) {
      // POST送信
      //console.log('inview');
      //console.log(getKKKid(currentSlideNum, true));
      sendKKK(getKKKid(currentSlideNum, true), 'inview', KKKdataTop);
      }
    });
  
    // 広告がクリックされたら記録
    $('.top-KKK > .item').on('click', function() {
      var KKKid = $(this).attr('id');
      // POST送信
      //console.log('click');
      //console.log(KKKid);
      sendKKK(KKKid, 'click', KKKdataTop);
    });
  
  // スライドショー発動 イベントの後に書いたほうがいいみたい
    $('.slick_KKK').slick({
      arrows: false,
      autoplay: true,
      autoplaySpeed: 3000,
      dots: true,
      infinite: true,
      pauseOnFocus: false,
      pauseOnHover: false,
      initialSlide: initialKKK,
    });

  }
  
  
  
  // =========== 広告関連ここまで ==========
  
  // 広告が表示されたかを記録する配列を書き換え。書き換えがあったらtrueを返す
  function checkView(recordArray, isSlideView, currentSlideNum) {
    if ( isSlideView == 1 && recordArray[currentSlideNum] == 0) {
      recordArray[currentSlideNum] = 1;
      return true;
    } else {
      return false;
    }
  }
  // 画像が同時に変わるのが気持ち悪いのでずらす
  /*var autoPlaySpeed = 3000;
  $('.slider').each(function(){
    autoPlaySpeed += 100;
    $(this).slick({
      arrows: false,
      infinite: true,
      autoplay: true,
      autoplaySpeed: autoPlaySpeed,
      fade: true,
      speed: 1000,
      swipe: false,
    });
  });*/
  
  //関数
  function getRandomInt(max) {
    return Math.floor(Math.random() * Math.floor(max));
   }
//ここまでがTOP広告

//ここからはトップ以外の広告
// ========== 広告関連 ===========
var KKKdata = {
    G01: {href: 'http://www.hakuryo.ed.jp', src: '/img/KKK/G01.jpg', alt: '白陵中学校・高等学校'},
    G02: {href: 'https://school.uchida.co.jp/', src: '/img/KKK/G02.gif', alt: '株式会社内田洋行'},
    G03: {href: 'http://www.shogoin.co.jp/', src: '/img/KKK/G03.jpg', alt: '株式会社聖護院八ツ橋総本店'},
    G04: {href: 'https://www.kyoto-min-iren.org/students/', src: '/img/KKK/G04.jpg', alt: '京都民主医療機関連合会'},
  };
  // 出稿広告の数
  var totalKKKnum = Object.keys(KKKdata).length;
  // 広告枠
  var KKKelement = $('.KKK_child');
  // 枠の数
  var KKKnum = KKKelement.length;

  if(KKKnum){
    // 貼る広告の番号を選ぶ
    var idsToPut = getSomeNums(totalKKKnum, KKKnum);
    // 確認用にクエリで指定することも可能
    var param = GetQueryString();
    if ( param && KKKnum ) {
      var forcePut = Number(param['k']);
      if ( Number.isInteger(forcePut) && between(forcePut, 1, totalKKKnum) ) {
        idsToPut[0] = forcePut - 1;
      }
    }
    idsToPut.forEach(function(value, index) {
      idsToPut[index] = getKKKid(value, false);
    });
    // console.log('idsToPut:')
    // console.log(idsToPut);
    // 貼る
    KKKelement.each(function(i) {
      var id = idsToPut[i];
      $(this).attr({
        id: id,
        href: KKKdata[id].href,
      });
      if ( KKKdata[id].href === '' ) {
        // リンク先のないWeb広告ではクリックしても（クリック回数カウント以外）反応しないようにする
        $(this).removeAttr('target');
        $(this).attr('onclick', 'return false;');
      }
      $(this).children('img').attr({
        src: KKKdata[id].src,
        alt: KKKdata[id].alt,
      });
    });
    // インプレッション(画面外も含む)を記録
    idsToPut.forEach(function(value) {
      sendKKK(value, 'impression', KKKdata);
      // console.log('impression:')
      // console.log(value);
    });
  
    // jquery inviewでビューインプレッションを測定
    // oneで1回のみになる
    // https://github.com/protonet/jquery.inview
    KKKelement.one('inview', function(event, isInView) {
      if (isInView) {
        KKKid = $(this).attr('id');
        sendKKK(KKKid, 'inview', KKKdata);
        // console.log('inview:')
        // console.log(KKKid);
      }
    });
  
    // クリックを記録、同一PVでは1度のみ
    KKKelement.one('click', function() {
      var KKKid = $(this).attr('id');
      sendKKK(KKKid, 'click', KKKdata);
      // console.log('click:');
      // console.log(KKKid);
    });
  }
  
  
  // ポスト送信+GoogleAnalyticsイベント
  function sendKKK(KKKid, action, KKKdata) {
    // https://developers.google.com/analytics/devguides/collection/gtagjs/events
    // https://support.google.com/analytics/answer/1033068
    // G01-関西すき家 みたいな文字列をラベルに
    var company = KKKid + '-' + KKKdata[KKKid].alt;
    gtag('event', action, {
      'event_label': company,
    });
  }
  
  // top広告は0から始まる整数としてのidをT00の形式にする
  // その他広告はG00
  // G01、T01から始まるため、idに1を足す
  function getKKKid(id, isTop) {
    if ( isTop ) {
      return 'T' + addZero(id+1, 2);
    } else {
      return 'G' + addZero(id+1, 2);
    }
  }
  
  // ========== 広告関連の関数ここまで ==========
  
  // 0からmax-1までの整数をランダムに返す
  function getRandomInt(max) {
    return Math.floor(Math.random() * Math.floor(max));
  }
  
  // 数字に0をつけて桁数を合わせる
  function addZero(num, digit) {
    var numString = String(num);
    while(numString.length < digit ) {
      numString = '0' + numString;
    }
    return numString;
  }
  
  // 配列づくり([0, 1, 2, ... , n]となる配列)
  function makeIncrementArray(n) {
    var array = Array(n);
    for (var i=0; i<n; i++) {
      array[i] = i;
    }
    return array;
  }
  
  // 配列シャッフル
  // 配列はポインタとして渡されるのでそのものがシャッフルされる
  function shuffle(array) {
    var index = array.length;
    // シャッフルアルゴリズム
    while (index) {
      var j = getRandomInt(index);
      var t = array[--index];
      array[index] = array[j];
      array[j] = t;
    }
  }
  
  // 0からmax-1までの整数を重複なくランダムにnum個配列として返す
  function getSomeNums(max, num) {
    var array = makeIncrementArray(max);
    shuffle(array);
    var result = Array(num);
    for (var i=0; i<num; i++) {
      result[i] = array[i];
    }
    return result;
  }
  // URLのクエリパラメータを取得
  function GetQueryString() {
    if (1 < document.location.search.length) {
      // 最初の1文字 (?記号) を除いた文字列を取得する
      var query = document.location.search.substring(1);
  
      // クエリの区切り記号 (&) で文字列を配列に分割する
      var parameters = query.split('&');
  
      var result = new Object();
      for (var i = 0; i < parameters.length; i++) {
        // パラメータ名とパラメータ値に分割する
        var element = parameters[i].split('=');
  
        var paramName = decodeURIComponent(element[0]);
        var paramValue = decodeURIComponent(element[1]);
  
        // パラメータ名をキーとして連想配列に追加する
        result[paramName] = decodeURIComponent(paramValue);
      }
      return result;
    }
    return null;
  }
  // 数値が範囲内にあるかどうか判定
  function between(number, min, max) {
    return (number >= min && number <= max) ? true : false;
  }
//多分ここまでで広告は完了