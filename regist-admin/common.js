var plans=['屋内ステージ','屋外ステージ','ライブハウス','展示','交流','ショップ'];
Vue.component('plans-form',{
    data:function(){
        return{
            items:[],
            plans:plans,
            selected:'',
        }
    },
    methods:{
        select:function(){
            var self=this;
            posting=[this.selected];
            console.log(posting);
            axios
            .post('plans-get.php',posting,{ headers: {'X-Requested-With': 'XMLHttpRequest'} })
            .then(function(res){
                self.items=res.data;
            })
        }
    },
    computed:{
        filled:function(){
            return this.items.length==1
        }
    },
    template:'<div><h2>企画種別選択</h2><select v-model="selected"><option v-for="item in plans" :value="item">{{item}}</option></select><button class="reload" @click="select">選択</button>'+
    '<h2>内容編集</h2><div v-if="filled"><edit-form v-for="item in items" :key="item.name" :item-data="item"></edit-form></div><p v-else>まず企画種別を選択して下さい。</p></div>'
})
Vue.component('edit-form',{
    props:{
        itemData:{
            type:Object,
            required:true,
        }
    },
    data:function(){
        return{
            name:this.itemData.name,
            explanation:this.itemData.explanation,
            need:this.itemData.need,
            date:this.itemData.date,
            flag:0,
            items:[],
        }
    },
    computed:{
        datelist:function(){
            return this.date.split(',')
        },
        needlist:function(){
            return this.need.split(",")
        },
        texterror:function(){
            if(this.explanation.length==0||this.explanation.length>500){
                return true
            }
        },
        neederror:function(){
            if(this.need.length==0||this.need.lenth>300){
                return true
            }
        },
        dateerror:function(){
            if(this.date.length==0||this.date.length>300){
                return true
            }
        },
        anyerror:function(){
            if(this.dateerror==true||this.neederror==true||this.texterror==true){
                return true
            }
        }
    },
    methods:{
        submit:function(){
            var self=this;
            posting=[this.itemData.id,this.explanation,this.need,this.date];
            axios
            .post('plans-edit.php',posting,{ headers: {'X-Requested-With': 'XMLHttpRequest'} })
            .then(function(res){
                self.items=res.data;
            })
            this.flag=2;
        },
    },
    template:'<div  class="editor"><div v-show="flag==0"><h3>{{itemData.name}}企画</h3>'+
             '<label>企画説明<textarea v-model="explanation" rows=17 cols=30></textarea></label><p class="error" v-show="texterror">1~500字で記入して下さい。</p><hr>'+
             '<h3>企画申請必要情報</h3><label>入力<textarea v-model="need" rows=5 cols=30></textarea></label><p>デフォルトで「企画責任者」「企画参加者」「団体名」「出展を希望する企画種別」となっています。複数ある場合は半角コンマ区切りで入力して下さい。</p>'+
             '<div class="preview"><p>プレビュー</p><ol><li v-for="item in needlist">{{item}}</li></ol></div><hr>'+
             '<h3>企画担当者説明会日程</h3><label>入力<textarea v-model="date" rows=5 cols=30></textarea></label><p>mm/ddの書式で入力して下さい。複数ある場合は半角コンマ区切りで入力して下さい。</p>'+
             '<div class="preview"><p>プレビュー</p><ul><li v-for="(item,index) in datelist">{{item}}:第{{index+1}}回企画担当者説明会</li></ul></div><hr>'+
             '<p class="error" v-show="neederror">企画申請に必要な情報の入力欄にエラーがあります。</p><p class="error" v-show="dateerror">企画担当者説明会日程入力にエラーがあります。</p>'+
             '<button class="reload" @click="flag=1" :disabled="anyerror">内容確認</button></div>'+
             '<div v-show="flag==1" class="preview"><h3>{{itemData.name}}企画</h3><p>{{explanation}}</p>'+
             '<ol><li v-for="item in needlist">{{item}}</li></ol>'+
             '<ul><li v-for="(item,index) in datelist">{{item}}第{{index+1}}回企画担当者説明会</li></ul>'+
             '<div class="btnarea"><button class="input" @click="submit" :disabled="anyerror">確定する</button><button class="input_cancel" @click="flag==0">戻る</button></div>'+
             '</div>'+
             '<p v-show="flag==2">{{items}}個のデータが変更されました。<a href="" class="input_cancel">完了</a></p>'+
        '</div>'
})
var faqValidate={
    computed:{
        selectAll:{
            get:function(){
                if(this.selected.length==this.plans.length){
                    return true
                }
            },
            set:function(value){
                var array=[]
                if(value){
                    this.plans.forEach(function(item){
                        array.push(item);
                    });
                }
                this.selected=array;
            }
        },
        selectedList:function(){
          return this.selected.join(',');  
        },
        questionerror:function(){
            if(this.question.length==0||this.question.length>500){
                return true
            }
        },
        answererror:function(){
            if(this.answer.length==0||this.answer.length>500)
            return true
        },
        selectederror:function(){
            if(this.selected.length==0){
                return true
            }
        },
        anyerror:function(){
            if(this.questionerror==true||this.answererror==true||this.selectederror==true){
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
            plans:plans,
            items:[],
            selected:[],
            question:'',
            answer:'',
            importance:'',
            flag:0,
        }
    },
    methods:{
        submit:function(){
            var self=this;
            posting=[this.question,this.answer,this.selected.join(','),this.importance];
            axios.post('faq-insert.php',posting,{ headers: {'X-Requested-With': 'XMLHttpRequest'} })
            .then(function(res){
                self.items=res.data;
            })
            this.flag=2;
        }
    },
    mixins:[faqValidate],
    template:'<div class="editor"><div v-show="flag==0"><h2>FAQ追加</h2>'+
    '<h3>関係企画</h3><label><input type="checkbox" v-model="selectAll">全選択</label><div class="btnarea"><label v-for="item in plans" class="label">{{item}}<input type="checkbox" v-model="selected" :value="item"></label><p class="error" v-show="selectederror">関係企画を選択して下さい。</p></div>'+
    '<label><h3>質問内容（500字以内）</h3><textarea v-model="question" rows=17 cols=30></textarea></label><p class="error" v-show="questionerror">文字数は0文字以上500文字以内でお願いします。</p>'+
    '<label><h3>回答（500字以内）</h3><textarea v-model="answer" rows=17 cols=30></textarea></label><p class="error" v-show="answererror">文字数は0文字以上500文字以内でお願いします。</p>'+
    '<label><h3>重要度（大きい順に上に表示されます）</h3><input type="number" v-model="importance"></label><p class="error" v-show="importanceerror">数字で入力して下さい。入力しないと重要度0となります。</p>'+
    '<button @click="flag=1" class="reload" :disabled="anyerror">内容確認</button></div>'+
    '<div v-show="flag==1"><h2>FAQ追加内容確認</h2><h3>質問内容</h3><p>{{question}}</p><h3>関係企画</h3><p>{{selectedList}}</p><h3>回答内容</h3><p>{{answer}}</p><h3>重要度</h3><p>{{importance}}</p>'+
    '<div class="btnarea"><button class="input" @click="submit">登録する</button><button class="input_cancel" @click="flag=0">戻る</button></div></div>'+
    '<div v-show="flag==2"><h2>FAQ登録完了</h2><p>{{items}}件のデータを登録しました。<a class="input_cancel" href="">完了</a></p></div>'+
    '</div>'
})
Vue.component('faq-config',{
    data:function(){
        return{
            items:[],
            plans:plans,
            selected:'',
            keyword:'',
        }
    },
    mounted:function(){
        this.show()
    },
    methods:{
        show:function(){
            var self=this;
            posting=[this.selected,this.keyword];
            axios.post('faq-config.php',posting,{headers:{'X-Requested-With':'XMLHttpRequest'}})
            .then(function(res){
                self.items=res.data;
            })
        }
    },
    template:'<div><h2>FAQ確認</h2>'+
    '<h3>企画種別から検索</h3><div class="btnarea"><label class="label">選択なし<input type="radio" v-model="selected" value=""></label><label class="label" v-for="item in plans">{{item}}<input type="radio" :value="item" v-model="selected"></label></div>'+
    '<h3>キーワード検索</h3><label>キーワード<input type="text" v-model="keyword"></label>'+
    '<button @click="show" class="reload">検索</button>'+
    '<table class="table"><tr><td></td><td>id</td><td>質問</td><td>回答</td></tr><faq-card v-for="item in items" :key="item.id" :faq-item="item"></faq-card></table>'+
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
    '<div v-show="flag==1" class="pop"><h3>id:{{faqItem.id}}の登録内容</h3><p>Q.{{faqItem.question}}</p><p>A.{{faqItem.answer}}</p><p>対象企画：{{faqItem.type}}</p><p>重要度：{{faqItem.importance}}</p><button class="cancel_btn" @click="flag=0">×</button><div class="btnarea"><button class="input_edit" @click="flag=2">編集</button><button class="input_cancel" @click="flag=3">削除</button></div></div>'+
    '<div v-show="flag==2" class="pop"><h3>{{faqItem.id}}の内容編集</h3><faq-edit v-if="flag==2" :faq-data="faq"></faq-edit><button @click="flag=0" class="cancel_btn">×</button></div>'+
    '<div v-show="flag==3" class="pop"><p class="error">本当に削除しますか？</p><button class="input_cancel" @click="faqdelete">削除する</button><button class="cancel_btn"@click="flag=1">×</button></div>'+
    '<div v-show="flag==4" class="pop"><p>{{items}}件のデータを削除しました。</p><a href="" class="input_cancel">完了</a></div></td>'+
    '<td>{{faqItem.id}}</td><td>{{faqItem.question}}</td><td>{{faqItem.answer}}</td></tr>'
})
Vue.component('faq-edit',{
    props:{
        faqData:{
            type:Object,
            required:true,
        }
    },
    data:function(){
        return{
            items:[],
            selected:this.faqData.type.split(','),
            question:this.faqData.question,
            answer:this.faqData.answer,
            importance:this.faqData.importance,
            plans:plans,
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
            posting=[this.faqData.id,this.question,this.answer,this.selected.join(','),this.importance];
            axios.post('faq-edit.php',posting,{headers:{'X-Requested-With':'XMLHttpRequest'}})
            .then(function(res){
                self.items=res.data;
            })
            this.flag=3
        }
    },
    template:'<div class="editor"><div v-show="flag==0"><label>質問内容<textarea v-model="question" rows=25 cols=25></textarea></label><label>回答内容<textarea v-model="answer" rows=25 cols=20></textarea></label>'+
    '<p>関係企画</p><label><input type="checkbox" v-model="selectAll"></label><div class="btnarea"><label v-for="item in plans" class="label">{{item}}<input type="checkbox" :value="item" v-model="selected"></label></div>'+
    '<label>重要度<input type="number" v-model="importance"></label>'+
    '<button @click="flag=1" class="input_edit">編集内容確認</button></div>'+
    '<div v-show="flag==1"><h3>質問内容</h3><p>{{question}}</p><h3>回答内容</h3><p>{{answer}}</p><h3>関係部局</h3><p>{{selectedList}}</p><h3>重要度</h3><p>{{importance}}</p><div class="btnarea"><button class="input_edit" @click="editfaq">変更する</button><button @click="flag=0" class="input_cancel">戻る</button></div></div>'+
    '<div v-show="flag==3"><p>{{items}}件のデータを変更しました。</p><a href="" class="input_cancel">完了</a></div>'+
    '</div>'
    
})
new Vue({
    el:"#all",
})