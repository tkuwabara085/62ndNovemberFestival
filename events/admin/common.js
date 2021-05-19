var faqValidate={
    computed:{
        questionerror:function(){
            if(this.question.length==0||this.question.length>500){
                return true
            }
        },
        answererror:function(){
            if(this.answer.length==0||this.answer.length>500)
            return true
        },
        anyerror:function(){
            if(this.questionerror==true||this.answererror==true){
                return true
            }
        },
        importanceerror:function(){
            if(this.importance.length==0){
                return true
            }else if(this.importance.match(/^\d*$/)){
                return false
            }else{
                return true
            }
        }
    }
}
Vue.component('faq-insert',{
    data:function(){
        return{
            code:'',
            pass:'',
            items:[],
            question:'',
            answer:'',
            importance:'',
            flag:0,
        }
    },
    methods:{
        submit:function(){
            var self=this;
            posting=[this.code,this.pass,this.question,this.answer,this.importance];
            axios.post('faq-insert.php',posting,{ headers: {'X-Requested-With': 'XMLHttpRequest'} })
            .then(function(res){
                self.items=res.data;
            })
            this.flag=2;
        }
    },
    mixins:[faqValidate],
    template:'<div class="editor"><div v-show="flag==0"><h2>Q&A追加</h2>'+
    '<label><h3>企画コード</h3><input type="text" v-model="code"></label>'+
    '<label><h3>パスワード</h3><input type="password" v-model="pass"></label>'+
    '<label><h3>質問内容（500字以内）</h3><textarea v-model="question" rows=17 cols=30></textarea></label><p class="error" v-show="questionerror">文字数は0文字以上500文字以内でお願いします。</p>'+
    '<label><h3>回答（500字以内）</h3><textarea v-model="answer" rows=17 cols=30></textarea></label><p class="error" v-show="answererror">文字数は0文字以上500文字以内でお願いします。</p>'+
    '<label><h3>重要度（大きい順に上に表示されます）</h3><input type="number" v-model="importance"></label><p class="error" v-show="importanceerror">数字で入力して下さい。入力しないと重要度0となります。</p>'+
    '<button @click="flag=1" class="reload" :disabled="anyerror">内容確認</button></div>'+
    '<div v-show="flag==1"><h2>FAQ追加内容確認</h2><h3>企画コード</h3><p>{{code}}</p><h3>質問内容</h3><p>{{question}}</p><h3>回答内容</h3><p>{{answer}}</p><h3>重要度</h3><p>{{importance}}</p>'+
    '<div class="btnarea"><button class="input" @click="submit">登録する</button><button class="input_cancel" @click="flag=0">戻る</button></div></div>'+
    '<div v-show="flag==2"><h2>FAQ登録完了</h2><p v-show="items==1">データを登録しました。</p><p v-show="items!=1">エラーが発生しました。</p><a class="input_cancel" href="">完了</a></div>'+
    '</div>'
})
Vue.component('faq-config',{
    data:function(){
        return{
            code:'',
            pass:'',
            items:[],
            keyword:'',
        }
    },
    methods:{
        show:function(){
            var self=this;
            posting=[this.code,this.pass,this.keyword];
            axios.post('faq-config.php',posting,{headers:{'X-Requested-With':'XMLHttpRequest'}})
            .then(function(res){
                self.items=res.data;
            })
        }
    },
    template:'<div><h2>Q&A確認</h2>'+
    '<label><h3>企画コード</h3><input type="text" v-model="code"></label>'+
    '<label><h3>パスワード</h3><input type="password" v-model="pass"></label>'+
    '<h3>キーワード検索</h3><label>キーワード<input type="text" v-model="keyword"></label>'+
    '<button @click="show" class="reload">検索</button>'+
    '<table class="table"><tr><td></td><td>id</td><td>質問</td><td>回答</td></tr><faq-card v-for="item in items" :key="item.id" :faq-item="item" :event-code="code" :event-pass="pass"></faq-card></table>'+
    '</div>',
})
Vue.component('faq-card',{
    props:{
        faqItem:{
            type:Object,
            required:true,
        },
        eventCode:{
            type:String,
            required:true,
        },
        eventPass:{
            type:String,
            required:true,
        }
    },
    data:function(){
        return{
            flag:0,
            faq:this.faqItem,
            code:this.eventCode,
            pass:this.eventPass,
            items:[],
        }
    },
    methods:{
        faqdelete:function(){
            var self=this;
            posting=[this.eventCode,this.eventPass,this.faqItem.id];
            axios.post('faq-delete.php',posting,{headers:{'X-Requested-With':'XMLHttpRequest'}})
            .then(function(res){
                self.items=res.data;
            })
            this.flag=4
        }
    },
    template:'<tr><td><button class="btn_show" @click="flag=1">詳細</button>'+
    '<div v-show="flag==1" class="pop"><h3>id:{{faqItem.id}}の登録内容</h3><p>Q.{{faqItem.question}}</p><p>A.{{faqItem.answer}}</p><p>重要度：{{faqItem.importance}}</p><button class="cancel_btn" @click="flag=0">×</button><div class="btnarea"><button class="input_edit" @click="flag=2">編集</button><button class="input_cancel" @click="flag=3">削除</button></div></div>'+
    '<div v-show="flag==2" class="pop"><h3>{{faqItem.id}}の内容編集</h3><faq-edit v-if="flag==2" :faq-data="faq" :faq-code="code" :faq-pass="pass"></faq-edit><button @click="flag=0" class="cancel_btn">×</button></div>'+
    '<div v-show="flag==3" class="pop"><p class="error">本当に削除しますか？</p><button class="input_cancel" @click="faqdelete">削除する</button><button class="cancel_btn"@click="flag=1">×</button></div>'+
    '<div v-show="flag==4" class="pop"><p v-show="items==1">データを削除しました。</p><p v-show="items!=1">削除に失敗しました。</p><a href="" class="input_cancel">完了</a></div></td>'+
    '<td>{{faqItem.id}}</td><td>{{faqItem.question}}</td><td>{{faqItem.answer}}</td></tr>'
})
Vue.component('faq-edit',{
    props:{
        faqData:{
            type:Object,
            required:true,
        },
        faqCode:{
            type:String,
            required:true,
        },
        faqPass:{
            type:String,
            required:true,
        }
    },
    data:function(){
        return{
            items:[],
            question:this.faqData.question,
            answer:this.faqData.answer,
            importance:this.faqData.importance,
            flag:0,
        }
    },
    mixins:[faqValidate],
    computed:{
        selectedList:function(){
            return this.selected.join(',')
        }
    },
    methods:{
        editfaq:function(){
            var self=this;
            posting=[this.faqCode,this.faqPass,this.faqData.id,this.question,this.answer,this.importance];
            axios.post('faq-edit.php',posting,{headers:{'X-Requested-With':'XMLHttpRequest'}})
            .then(function(res){
                self.items=res.data;
            })
            this.flag=3
        }
    },
    template:'<div class="editor"><div v-show="flag==0"><p>企画コード：{{faqCode}}</p><label>質問内容<textarea v-model="question" rows=25 cols=25></textarea></label><label>回答内容<textarea v-model="answer" rows=25 cols=20></textarea></label>'+
    '<label>重要度<input type="number" v-model="importance"></label>'+
    '<button @click="flag=1" class="input_edit">編集内容確認</button></div>'+
    '<div v-show="flag==1"><p>企画コード：{{faqCode}}</p><h3>質問内容</h3><p>{{question}}</p><h3>回答内容</h3><p>{{answer}}</p><h3>重要度</h3><p>{{importance}}</p><div class="btnarea"><button class="input_edit" @click="editfaq">変更する</button><button @click="flag=0" class="input_cancel">戻る</button></div></div>'+
    '<div v-show="flag==3"><p>{{items}}件のデータを変更しました。</p><a href="" class="input_cancel">完了</a></div>'+
    '</div>'
    
})
new Vue({
    el:"#all",
})