//まずは時限公開に関する設定
var today=new Date();//アクセスした日時
var resume=new Date(2021,1,12,16,0,0);//こっちは公開日時。月だけは0~11の表示
//ここから全学実関係
var resumeItems=[
    {title:'全学実行委員会への提案',author:'11月祭事務局',link:'/resume/resume.pdf'},
  ]
  var gijiroku=[
    {title:'第1回議事録',author:'11月祭事務局',link:'/resume/gijiroku1.pdf'},
    {title:'第2回議事録',author:'11月祭事務局',link:'/resume/gijiroku2.pdf'},
    {title:'第3回議事録',author:'11月祭事務局',link:'/resume/gijiroku3.pdf'},
    {title:'第4回議事録',author:'11月祭事務局',link:'/resume/gijiroku4.pdf'},
    {title:'第5回議事録',author:'11月祭事務局',link:'/resume/gijiroku5.pdf'},
    {title:'第6回議事録',author:'11月祭事務局',link:'/resume/gijiroku6.pdf'},
  ]
  //ここまで
  Vue.component('resume-item',{
    data:function(){
        return{
            resumeItems:resumeItems,
        }
    },
    computed:{
        publish:function(){
            return today>resume
        }
    },
    template:'<div v-if="publish"><div class="card-large" v-for="item in resumeItems"><h2 class="cardTitle">{{item.title}}</h2><h5 class="right">{{item.author}}</h5><a :href="item.link" class="card-small" target="_blank">ファイル</a></div></div>'
  })
  Vue.component('gijiroku-item',{
    data:function(){
        return{
            gijiroku:gijiroku
        }
    },
    template:'<div><div class="card-large" v-for="item in gijiroku"><h2 class="cardTitle">{{item.title}}</h2><h5 class="right">{{item.author}}</h5><a :href="item.link" class="card-small" target="_blank">ファイル</a></div></div>'
  })