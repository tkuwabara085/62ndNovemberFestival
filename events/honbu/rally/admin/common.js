Vue.component('faq-config',{
    data:function(){
        return{
            items:[],
            keyword:'',
        }
    },
    mounted:function(){
        this.show()
    },
    methods:{
        show:function(){
            var self=this;
            posting=[this.keyword];
            axios.post('faq-config.php',posting,{headers:{'X-Requested-With':'XMLHttpRequest'}})
            .then(function(res){
                self.items=res.data;
            })
        }
    },
    template:'<div><h2>投稿確認</h2>'+
    '<h3>キーワード検索</h3><label>キーワード<input type="text" v-model="keyword"></label>'+
    '<button @click="show" class="reload">検索</button>'+
    '<table class="table"><tr><td></td><td>id</td><td>ペンネーム</td><td>メッセージ</td></tr><faq-card v-for="item in items" :key="item.id" :faq-item="item"></faq-card></table>'+
    '</div>',
})
Vue.component('faq-card',{
    props:{
        faqItem:{
            type:Object,
            required:true,
        }
    },
    data:function(){
        return{
            flag:0,
            faq:this.faqItem,
            items:[],
        }
    },
    methods:{
        faqdelete:function(){
            var self=this;
            posting=[this.faqItem.id];
            axios.post('faq-delete.php',posting,{headers:{'X-Requested-With':'XMLHttpRequest'}})
            .then(function(res){
                self.items=res.data;
            })
            this.flag=4
        }
    },
    template:'<tr><td><button class="btn_show" @click="flag=1">詳細</button>'+
    '<div v-show="flag==1" class="pop"><h3>id:{{faqItem.id}}の登録内容</h3><p>Q.{{faqItem.account}}</p><p>A.{{faqItem.msg}}</p><p>対象企画：{{faqItem.type}}</p><p>重要度：{{faqItem.importance}}</p><button class="cancel_btn" @click="flag=0">×</button><div class="btnarea"><button class="input_cancel" @click="flag=3">削除</button></div></div>'+
    '<div v-show="flag==3" class="pop"><p class="error">本当に削除しますか？</p><button class="input_cancel" @click="faqdelete">削除する</button><button class="cancel_btn"@click="flag=1">×</button></div>'+
    '<div v-show="flag==4" class="pop"><p>{{items}}件のデータを削除しました。</p><a href="" class="input_cancel">完了</a></div></td>'+
    '<td>{{faqItem.id}}</td><td>{{faqItem.account}}</td><td>{{faqItem.msg}}</td></tr>'
})
new Vue({
    el:"#all",
})