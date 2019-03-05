<template>
  <div>
    <ul>
      <li v-for="item in data" :index="item.gid">
        <router-link :to="'/goodsInfo/'+item.gid" class="info" style="display: block">
            <div style="margin-bottom: 10px;color:#000;float: left;">{{item.gtitle}}</div>
            <p style="color:#ff8053;font-size: 16px;float: right;"><i>￥</i>{{item.price}}</p>
            <p style="color:#999;margin-top: 10px;clear: both;float: right;">{{item.mtime}}</p>
            <!--<p style="float: right;color:#FF8053"><span  v-if="data.state=0">未发货</span><span v-else-if="data.state=1">已发货</span><span  v-else-if="data.state=2">已收货</span></p>-->
        </router-link>
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
      fetch("/ajax/goods/buyed/"+this.uid).then(function (e) {
        return e.json()
      }).then(function (e) {
        if(e.err){
          that.showTip=true;
          that.tipMsg="数据错误";
        }else{
          that.data=e;
          for(var i in e){
            var date=new Date(e[i].mtime)
            e[i].mtime=date.toLocaleString();
          }
        }
      })
    },
    methods:{

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
