//ここより前にtypeとflagの定義を置く。各企画のページの場合にはflagは1，typeは各企画種にあわせたものを置く。FAQ一覧ページならflagは0、typeは空文字
var planslist=[
    {value:'',text:'選択なし'},
    {value:'屋内ステージ',text:'屋内ステージ'},
    {value:'屋外ステージ',text:'屋外ステージ'},
    {value:'ライブハウス',text:'ライブハウス'},
    {value:'展示',text:'展示'},
    {value:'交流',text:'交流'},
    {value:'ショップ',text:'ショップ'},
]
Vue.component('faq',{
    data:function(){
        return {
            items:[],
            type:type,
            keyword:'',
            state:state,
            plans:planslist,
        }
    },
    mounted:function(){
        this.search();
    },
    methods:{
        search:function(){
            var self=this;
            posting=[this.type,this.keyword]
            axios
            .post('faq.php',posting,{ headers: {'X-Requested-With': 'XMLHttpRequest'} })
            .then(function(res){
                self.items=res.data;
            })
        }
    },
    template:'<div><h2>FAQ</h2><p class="narrative">企画出展にあたってのよくあるご質問です。キーワードから検索することもできます。お探しの情報が見つからない場合はメールにてお問い合わせ下さい。</p>'+
            '<div style="padding:10px;"><h3>検索</h3><div><p>キーワードから検索</p><input type="text" v-model="keyword" class="form-text"></div><div v-if="state==0"><p>企画種別から検索</p><label v-for="item in plans" class="form-list"><input type="radio" v-model="type" :value="item.value">{{item.text}}</label></div></div>'+
            '<div class="center"><button @click="search" class="search_btn">検索</button></div>'+
            '<q-card v-for="item in items" :key="item.question" :item-content="item"></q-card>'+
            '</div>'
})
Vue.component('q-card',{
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
    template:'<div class="card-large flex-container"><button @click="showall=!showall" style="border:none;background-color:#ffcc25;color:#000;border-radius:5px;height:30px;"><i class="fas fa-chevron-down" v-show="!showall"></i><i class="fas fa-chevron-up" v-show="showall"></i></button><div><p class="cardTitle" v-show="showall==false">Q.{{capital}}...</p><p v-show="showall==true">Q.{{itemContent.question}}</p><p v-show="showall">関係企画：{{itemContent.type}}</p><p v-show="showall==true">A.{{itemContent.answer}}</p></div></div>'
})
