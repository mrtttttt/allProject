<template>
  <div>
    <ul>
      <li v-for="item in data" :index="item.colid">
        <router-link :to="'/goodsInfo/'+item.gid" class="info" style="display: block;padding: 10px 0;">
            <div style="margin-bottom: 10px;color:#000;float: left;">{{item.gtitle}}</div>
            <p style="color:#ff8053;font-size: 16px;float: right;"><i>￥</i>{{item.price}}</p>
            <p style="clear:both;float: right;color:#FF8053"><span v-if="item.state==0">未卖出</span><span v-else-if="item.state==1">已卖出</span></p>
        </router-link>
        <button style="float: right;margin:0 10px;" @click="delcollect(item.colid)">取消收藏</button>
      </li>
    </ul>
  </div>
</template>

<script>
  import { Confirm,Toast,TransferDomDirective as TransferDom } from 'vux'
  export default {
    directives: {
      TransferDom
    },
    name: "published",
    data:function () {
      return {
        data:[],
        uid:localStorage.getItem("userFront")
      }
    },
    components:{Confirm,Toast},
    mounted:function () {
      var that=this;
      this.$emit('title',this.$route.query.title);
      fetch("/ajax/goods/collected/"+this.uid).then(function (e) {
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
      delcollect(colid){
        var that=this;
        fetch("/ajax/goods/delCollect?colid="+colid).then(function (e) {
          return e.text()
        }).then(function (e) {
          if(e=="ok"){
            that.showTip=true;that.tipMsg="已取消收藏"
            var lis=document.querySelectorAll("li");
            for(var i=0;i<lis.length;i++){
              if(lis[i].getAttribute("index")==colid){
                document.querySelector("ul").removeChild(lis[i])
              }
            }
          }
        })
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
</style>
