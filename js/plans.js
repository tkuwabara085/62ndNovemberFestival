var plansgeneral=[
  {title:'屋内ステージ企画',type:'オンライン企画',explanation:'仮設の劇場で撮影した演劇・コントなどの動画を配信します。参加するのが京大生のみの場合、11月祭事務局が場所や機材を提供することが可能です。',link:'/registration/plans.php?plan=屋内ステージ',contact:'indoor'},
  {title:'屋外ステージ企画',type:'オンライン企画',explanation:'屋外で撮影した動画を配信します。参加するのが京大生のみの場合、11月祭事務局が場所や機材を提供することが可能です。',link:'/registration/plans.php?plan=屋外ステージ',contact:'outdoor'},
  {title:'ライブハウス企画',type:'オンライン企画',explanation:'屋内の仮設ステージで撮影したバンドなどの動画を配信します。参加するのが京大生のみの場合、11月祭事務局が場所や機材を提供することが可能です。',link:'/registration/plans.php?plan=ライブハウス',contact:'livehouse'},
  {title:'展示企画',type:'オンライン企画',explanation:'ウェブサイト上に企画出展者が自作した動画・画像や説明文などを掲載します。',link:'/registration/plans.php?plan=展示',contact:'exhibition'},
  {title:'交流企画',type:'オンライン企画',explanation:'企画出展者と来場者の皆様がオンライン上で交流する企画形態です。リアルタイムでのやりとりをしたい場合にはこちらの企画形態となります。',link:'/registration/plans.php?plan=交流',contact:'exchange'},
  {title:'ショップ企画',type:'オンライン企画',explanation:'グッズなどの通信販売を行える企画です。',link:'/registration/plans.php?plan=ショップ',contact:'shop'}
]
Vue.component('plans-general',{
  data:function(){
    return{
      plansgeneral:plansgeneral,
    }
  },
  template:'<div><div class="card-large" v-for="item in plansgeneral"><h2 class="cardTitle">{{item.title}}</h2><h5 class="right">{{item.type}}</h5><p>{{item.explanation}}</p><a class="card-small" :href="item.link">詳細</a></div></div>'
})
Vue.component('plans-list',{
  data:function(){
    return{
      planslist:plansgeneral,
    }
  },
  template:'<div class="narrative"><a class="card-small" :href="item.link" v-for="item in planslist" style="margin:5px;">{{item.title}}</a></div>'
})

Vue.component('plans-related',{
  template:'<div><h2>関連</h2><h3 class="circlehead">一般企画一覧</h3><plans-list></plans-list>'+
  '<h3 class="circlehead">その他企画出展について</h3><div class="narrative">'+
  '<a href="index.html" class="card-small">企画出展トップ</a>'+
  '<a href="request.html" class="card-small">企画申請について</a>'+
  '<a href="select.html" class="card-small">企画選択基準</a>'+
  '<a href="change.html" class="card-small">緊急事態宣言の延長に関する対応</a>'+
  '<a href="https://penguin.nf.la" class="card-small" target="_blank">PENGUIN <i class="fas fa-external-link-alt"></i></a>'+
  '<a href="/pdf/rulebook.pdf" class="card-small" target="_blank">一般企画虎の巻（PDF）</a>'+
  '<a href="/pdf/papers.pdf" class="card-small" target="_blank">提出していただく書類一覧（PDF）</a>'+
  '<a href="/pdf/genkou.pdf" class="card-small" target="_blank">パンフレット原稿について（PDF）</a>'+
  '<a href="/pdf/create.pdf" class="card-small" target="_blank">PENGUINアカウントの作成について（PDF）</a>'+
  '<a href="/pdf/penguin.pdf" class="card-small" target="_blank">PENGUINの操作方法（PDF）</a>'+
  '</div></div>'
})
Vue.component('contact-list',{
  template:'<div id="contact" class="card-unshown">'+
  '<h2>各企画担当者連絡先</h2><ul>'+
  '<li><h3 class="circlehead">バラエティ企画</h3><img src="../image/contact/variety.svg" width=200></li>'+
    '<li><h3 class="circlehead">ショップ企画</h3><img src="../image/contact/shop.svg" width=200></li>'+
    '<li><h3 class="circlehead">展示企画</h3><img src="../image/contact/exhibition.svg" width=200></li>'+
    '<li><h3 class="circlehead">交流企画</h3><img src="../image/contact/exchange.svg" width=200></li>'+
    '<li><h3 class="circlehead">屋内ステージ企画</h3><img src="../image/contact/indoor.svg" width=200></li>'+
    '<li><h3 class="circlehead">屋外ステージ企画</h3><img src="../image/contact/outdoor.svg" width=200></li>'+
    '<li><h3 class="circlehead">ライブハウス企画</h3><img src="../image/contact/livehouse.svg" width=200></li>'+
    '<li><h3 class="circlehead">その他企画申請一般</h3><img src="../image/contact/nfc.svg" width=200></li>'+
  '</ul></div>'
})
Vue.component('caution-first',{
  data:function(){
    return{
      show:false,
    }
  },
  template:'<div><h5 class="right red">最終更新：2021/2/8</h5>'+
  '<p class="narrative">※以下の内容はすべて新型コロナウイルス感染症や緊急事態宣言の影響などによって今後変更される可能性があります。本サイトやPENGUIN（<a href="https://penguin.nf.la/" class="text_link">https://penguin.nf.la/</a>'+
  '）で公開される最新の情報にご注意下さい。なお、情報を更新した場合は11月祭事務局公式Twitter（<a class="text_link" href="https://twitter.com/nfoffice/" target="_blank">@nfoffice</a>'+
  '）でもお知らせいたしますのでそちらもご確認下さい。</p>'+
  '<div class="card-large" @click="show=!show"><p>更新情報一覧<span style="background-color:rgb(255, 248, 226); border:none;box-shadow:2px 2px #eee;"><i class="fas fa-chevron-down" v-show="!show"></i><i class="fas fa-chevron-up" v-show="show"></i></span></p>'+
  '<div v-show="show"><p>1/23 パンフレット原稿についての情報を更新しました。</p><p>1/23　企画選択についてのページを更新しました。</p><p>1/26　企画申請についてのページを更新しました。</p><p>2/6　緊急事態宣言延長に関する対応を掲載</p><p>2/8　<a class="text_link" href="https://nf.la/pdf/rulebook.pdf" target="_blank">一般企画虎の巻</a>を更新しました。</p></div></div>'+
  '</div>'
})