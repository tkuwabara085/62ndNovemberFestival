//Vue.config.devtools = true;
var guidespot=[
  {title:"付属図書館",src1:"../../image/test/main-lib1.jpg",text:"京都大学附属図書館は京大にある大小約50の図書館・図書室の中心となる館で、約100万冊の蔵書を有しています(なお、学内で最大の蔵書数を誇るのは文学研究科図書館です。さすが文学部ですね)。"},
  {title:"おまつり広場",src1:"../../image/test/oma1.jpg",text:"ここは吉田南グラウンドです。普段はスポ実や部活動などに利用されていますが、11月祭期間中は「おまつり広場」となります。おまつり広場には大きく分けて二つの企画が出展されます。"},
  {title:"吉田南図書館",src1:"../../image/test/south-lib1.jpg",text:"こちらの建物は京大内に数多くある図書館のうちの一つ、吉田南図書館です。この図書館には全学共通科目、いわゆる一般教養科目に対応した書籍を数多く取り揃えています。実際に建物を見てみますと、あまり歴史が感じられないかもしれませんが、実はこの図書館は1897年に京大の前身の一つである第三高等学校の図書館として設置された時からの歴史を持っていまして、そのころからの貴重な資料を収蔵しています。"},
  {title:"4共",src1:"../../image/test/4kyo1.jpg",text:"こちらは吉田南4号館、通称4共と呼ばれている建物です。なぜ、吉田南4号館が4共と呼ばれるのか、おそらく、この4号館で共通科目が数多く開講されているからだと思います。学生の間だけでなく、時間割にも4共と表示されることから教授や京大の職員もこの名称を愛用しているようです。"},
  {title:"吉田南総合館",src1:"../../image/test/sogo1.jpg",text:"吉田南総合館には北棟・西棟・南棟・東棟の4つがあり、それぞれ共北・共西・共南・共東と呼ばれています。大学のシラバスなどにもこの名称が使われているため、この建物を「吉田南総合館」と呼ぶ人は実際にはほとんどいません（！）。"},
  {title:"総合人間学部棟",src1:"../../image/test/sojin1.jpg",text:"こちらが総合人間学部棟です。この「総合人間学部」という学部名だけを聞いて、どういった領域を扱う学部なのか、どのような研究をしているのか、イメージできるでしょうか？少し想像しづらいですよね。総合人間学部は、専門にとらわれない広い視野を持って活躍する人材を育成するために、1992年に教養学部を母体に設立された一番新しい学部です。"},
  {title:"クスノキ",src1:"../../image/test/camphora1.jpg",text:"京都大学本部構内正門を入ってすぐ正面にどっしりと構えているクスノキは、学校のエンブレムにもデザインされている京都大学のシンボルです。周りはベンチになっているので、お弁当を食べたり、読書やお昼寝をするにもぴったり！の憩いの場となっています。サークルの活動場所や待ち合わせ場所としてもよく使われており、毎年たくさんのサークルが新歓の待ち合わせ場所として使用します。その賑わいは京大の春の風物詩となっています（今年は対面での新歓が始まれば見られるかもしれませんね！）。"},
  {title:"法経本館",src1:"../../image/test/hokei1.jpg",text:"法経本館とは、主に法学部と経済学部の専門科目の講義が行われる施設となっており、それぞれの学部の頭文字をとって「法」「経」本館となっています。ここは京大の中でもトップクラスの広さを誇る講義室があるため、多くの生徒をいっせいに集めることができます。ただし、少々古い建物なので椅子が固く、講義の途中でおしりが痛くなってしまいます。"},
  {title:"総合研究8号館",src1:"../../image/test/lab1.jpg",text:"この建物は総合研究8号館といいます。こちらでは普段は工学部の専門科目が開講されています。工学部はさらに、化学系、機械系、建築系、電気系、土木系、情報系の6つに分かれており、京大の中でもっと人数の多い学部となっています。1学年の人数はなんと1000人にもなり、京大の1学年の人数が3000人であることを考えると、京大の学生のおよそ1/3が工学部生であるといえます。さらには工学部の男子率は9割を超えことから「おとこうがくぶ」と呼ばれることもあります。"},
  {title:"時計台",src1:"../../image/test/clock1.jpg",text:"京大の時計台は、クスノキと並ぶ京大のシンボルとなっています。時計台、というのは略称であり、正式名称を「百周年時計台記念館」といいます。この建物は1925年（大正14年）に工学部建築学科の初代教授である武田五一氏が設計し、完成させました。その後、2003年(平成15年)に改修工事を終えて現在に至っています。なお、時計台の時計は1925年の完成以降、修理や点検をしながらもずっと現役であり続け、90年以上の年月を経てなお京大の時を刻み続けているのです。"},

]
Vue.component('guide-content',{
  data:function(){
    return{
      guidespot:guidespot,
      place:0,
    }
  },
  template:'<div id="content">'+
  '<img src="../../image/test/map.jpg" usemap="#image-map">'+
  '<map name="image-map">'+
  '<area target="" alt="main-library" title="main-library" href="" coords="1156,2167,1460,2449" shape="rect" @click.prevent="place=1"><!--@click.preventにすることでクリックされてもリロードされない-->'+
  '<area target="" alt="oma" title="oma" href="" coords="2735,2723,2124,2136" shape="rect" @click.prevent="place=2">'+
  '<area target="" alt="south-library" title="south-library" href="" coords="2993,1718,3135,2068" shape="rect" @click.prevent="place=3">'+
  '<area target="" alt="4kyo" title="4kyo" href="" coords="3491,1656,3693,1876" shape="rect"@click.prevent="place=4">'+
  '<area target="" alt="south-sogo" title="south-sogo" href="" coords="2428,1563,2912,2076" shape="rect" @click.prevent="place=5">'+
  '<area target="" alt="sojin" title="sojin" href="" coords="2174,1605,2382,1795" shape="rect" @click.prevent="place=6">'+
  '<area target="" alt="camphora" title="camphora" href="" coords="1715,1462,1881,1890" shape="rect" @click.prevent="place=7">'+
  '<area target="" alt="hokei" title="hokei" href="" coords="1107,1418,1375,1995" shape="rect" @click.prevent="place=8">'+
  '<area target="" alt="lab" title="lab" href="" coords="1103,1085,1326,1308" shape="rect" @click.prevent="place=9">'+
  '<area target="" alt="clock" title="clock" href="" coords="1443,1437,1658,1967" shape="rect" @click.prevent="place=10"></map>'+
  '<div class="pop-bg" v-show="place!=0" @click="place=0">'+
  '<guide-pop v-for="(item,index) in guidespot" v-show="index+1==place" :key="item.title" :guide-content="item"></guide-pop>'+
  '</div>'+
 // '<div v-for="(item,index) in guidespot" v-show="index+1==place" :key="item.title" class="pop">'+
  //'<div class="pop-card"><h2 class="cardTitle">{{item.title}}</h2><div class="pop-image"><img :src="item.src1"></div>'+
  //'<div class="pop-text"><p>{{item.text}}</p></div><button class="card-small" @click="place=0">閉じる</button></div></div></div>'
  '</div>'
})
Vue.component('guide-pop',{
  props:{
    guideContent:{
      type:Object,
      required:true,
    }
  },
  template:'<div class="pop">'+
  '<div class="pop-card"><h2 class="cardTitle">{{guideContent.title}}</h2>'+
  '<ul>'+
  '<li><div class="pop-image"><img :src="guideContent.src1"></div></li>'+
  '<li><div class="pop-image"><img :src="guideContent.src2"></div></li>'+
  '</ul>'+
  '<div class="pop-text"><p>{{guideContent.text}}</p></div></div></div>'
})