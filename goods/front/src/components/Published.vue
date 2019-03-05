<template>
  <div>
    <tab active-color="#FF8053">
      <tab-item selected @on-item-click="onItemClick">已卖出</tab-item>
      <tab-item @on-item-click="onItemClick">未卖出</tab-item>
      <tab-item @on-item-click="onItemClick">审核未通过</tab-item>
    </tab>
    <ul>
      <li v-for="item in data" :index="item.gid">
        <div class="info">
          <img v-if="item.gphoto" :src="item.gphoto[0]" alt="">
          <div class="right">
            <div>{{item.gtitle}}</div>
            <p><i>￥</i>{{item.price}}</p>
            <span>浏览<em>4</em></span>
          </div>
        </div>
        <div class="caozuo" v-if="item.state==0">
          <button @click="edit(item.gid)">编辑</button>
          <button @click="del(item.gid)">删除</button>
        </div>
        <div class="caozuo" v-else-if="item.state==1">
          <button>已卖出</button>
        </div>
        <div class="caozuo" v-else-if="item.state==2">
          <button @click="edit(item.gid)">重新编辑并发布</button>
          <button @click="del(item.gid)">删除</button>
        </div>
      </li>
    </ul>
    <div v-transfer-dom>
      <confirm v-model="show"
               title="确定删除？"
               @on-confirm="onConfirm"
               >
      </confirm>
    </div>
    <toast type="text" v-model="showTip">{{tipMsg}}</toast>
  </div>
</template>

<script>
  import { Confirm,Toast,TransferDomDirective as TransferDom,Tab,TabItem } from 'vux'
    export default {
      directives: {
        TransferDom
      },
      name: "published",
      data:function () {
        return {
          show:false,
          delId:"",
          showTip:false,
          tipMsg:"",
          data:[],
          uid:localStorage.getItem("userFront")
        }
      },
      components:{Confirm,Toast,Tab,TabItem},
      mounted:function () {
        var that=this;
        this.$emit('title',this.$route.query.title);
        fetch("/ajax/users/published?uid="+this.uid+"&state=1").then(function (e) {
          return e.json()
        }).then(function (e) {
          if(e.err){
            that.showTip=true;
            that.tipMsg="数据错误";
          }else{
            that.data=e;
          }
        })
      },
      methods:{
        edit(gid){
          this.$router.push("/publish/"+gid)
        },
        del(gid){
          this.delId=gid;
          this.show=true;
        },
        onConfirm () {
          var that=this;
          fetch("/ajax/goods/del/"+this.delId).then(function (e) {
            return e.text();
          }).then(function (e) {
            if(e=="ok"){
              var lis=document.querySelectorAll("li")
              for(var i=0;i<lis.length;i++){
                if(lis[i].getAttribute("index")==that.delId){
                  document.querySelector("ul").removeChild(lis[i])
                  that.showTip=true;
                  that.tipMsg="删除成功";
                }
              }
            }else{
              that.showTip=true;
              that.tipMsg="删除失败";
            }
          })
        },
        onItemClick (index) {
          if(index==0){
            this.$emit('title',this.$route.query.title);
            fetch("/ajax/users/published?uid="+this.uid+"&state=1").then((e)=> {
              return e.json()
            }).then((e)=> {
              if(e.err){
                this.showTip=true;
                this.tipMsg="数据错误";
              }else{
                this.data=e;
              }
            })
          }else if(index==1){
//            未卖出
            this.$emit('title',this.$route.query.title);
            fetch("/ajax/users/published?uid="+this.uid+"&state=0").then((e)=> {
              return e.json()
            }).then((e)=> {
              if(e.err){
                this.showTip=true;
                this.tipMsg="数据错误";
              }else{
                this.data=e;
              }
            })
          }else if(index == 2){
            this.$emit('title',this.$route.query.title);
            fetch("/ajax/users/published?uid="+this.uid+"&state=2").then((e)=> {
              return e.json()
            }).then((e)=> {
              if(e.err){
                this.showTip=true;
                this.tipMsg="数据错误";
              }else{
                this.data=e;
              }
            })
          }
        },
      }
    }
</script>

<style scoped>
  *{margin: 0;padding: 0;}
ul{width: 100%;background: #efefef;overflow: hidden;}
li{width:100%;float:left;list-style: none;background: #fff;padding: 20px;margin-bottom: 15px; }
img{float: left;width: 60px;margin-right: 15px;}
.right{float: left;}
.right div{color:#000;font-weight: bold;font-size: 14px;}
.right p{color:red;font-weight: bold;font-size: 16px;}
.right p i{font-weight: normal;font-size: 12px;}
.right span{color:#666;font-size: 12px;}
button{
  padding: 5px 10px;width: auto;height: auto;
}
.info{overflow: hidden;}
.caozuo{
  border-top: 1px solid #eee;margin-top: 10px;padding-top:10px;text-align: right;
}
.caozuo button{margin-right: 10px;}
</style>
