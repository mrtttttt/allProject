<template>
    <div class="goods">
      <div class="goodsHead">
        <x-header :left-options="{backText: ''}" :right-options="{showMore: true}" @on-click-more="showMenus = true" id="x-header">{{gData.gtitle}}</x-header>
        <div v-transfer-dom>
          <actionsheet :menus="menus" v-model="showMenus" show-cancel @on-click-menu="chooseMenus"> </actionsheet>
        </div>
      </div>
      <div class="goodsUser">
        <img v-if="gData.photo" :src="gData.photo" alt="">
        <img v-else src="@/assets/imgs/default.jpeg" alt="">
        <p>{{gData.name}}</p>
      </div>
      <div class="goodsInfo">
        <p>{{gData.ginfo}}</p>
        <img class="previewer-demo-img" v-for="(item, index) in imgArr" :src="item">
      </div>
      <div v-if="gData.isMy" class="goodsFoot">
        <button class="buy"  @click="edit(gData.gid)">去编辑</button>
      </div>
      <div v-else class="goodsFoot">
        <!--<div class="box">-->
          <!--<x-icon class="zan" type="ios-heart-outline" size="20"></x-icon>赞-->
        <!--</div>-->
        <div v-if="isCollect" class="box" style="color: #ff8053" @click="delcollect(gData.collect)">
          <span class="iconfont" style="font-size: 28px;vertical-align: bottom">&#xe6ca;</span>已收藏
        </div>
        <div v-else class="box" @click="collect(gData.gid)">
          <span class="iconfont" style="font-size: 28px;vertical-align: bottom">&#xe6ca;</span>收藏
        </div>
        <button v-if="gData.state==0" class="buy"  @click="showBuyMenus = true" >我想买</button>
        <button v-else-if="gData.state==1" class="buy" >已购买</button>
      </div>
      <div v-transfer-dom>
        <actionsheet :menus="buyMenus" v-model="showBuyMenus" show-cancel @on-click-menu="chooseBuyMenus"> </actionsheet>
      </div>
      <a :href="'tel:'+gData.phone" style="display: none;" class="call" ref="callPhone"></a>
      <toast v-model="showTip" type="text">{{tipMsg}}</toast>
    </div>
</template>

<script>
  import { XHeader, Actionsheet, TransferDom,XButton ,Previewer,Toast } from 'vux'

  export default {
    props:["gid"],
    name:'goods-info',
    directives: {
      TransferDom
    },
    components: {
      XHeader,Toast,
      Actionsheet,
      XButton,
      Previewer
    },
    data () {
      return {
        menus: {
          menu1: '分享',
          menu2: '复制链接'
        },
        buyMenus: {
          menu1: '直接电话联系',
          menu2: '直接购买'
        },
        showMenus: false,
        showBuyMenus: false,
        gData:[],
        imgArr: [],
        showTip:false,
        tipMsg:"",
        isCollect:false,
        uid:localStorage.getItem("userFront"),
      }
    },
    beforeRouteLeave(to,from,next){
      if(this.gData.state==1){
        to.meta.keepAlive = false; // 让 首页 不缓存，即刷新
      }
      next();
    },
    mounted:function () {
      var that=this;
      fetch("/ajax/goods/query?gid="+this.$route.params.gid+"&uid="+this.uid).then(function (e) {
        return e.json()
      }).then(function (e) {
        if(e[0].gphoto){
          that.imgArr=e[0].gphoto.split(";")
        }
        if(e[0].collect){
          that.isCollect=true;
        }else{
          that.isCollect=false;
        }
        if(e[0].uid==that.uid){
          e[0].isMy=true;
        }else{
          e[0].isMy=false;
        }
        that.gData=e[0];
      })
    },
    methods:{
      chooseMenus(key){
        console.log(key)
      },
      chooseBuyMenus(key){
        if(this.uid) {
          if (key == "menu1") {
            this.$refs.callPhone.click();
          } else if (key == "menu2") {
            this.$router.push("/buy/" + this.$route.params.gid)
          }
        }else{
            this.$router.push("/login")
        }
      },
      edit(gid){
        this.$router.push("/publish/"+gid)
      },
      collect(gid){
        var that=this;
        if(this.uid){
          fetch("/ajax/goods/addCollect?gid="+gid+"&uid="+this.uid).then(function (e) {
            return e.json()
          }).then(function (e) {
            if(e.msg=="ok"){
              that.showTip=true;that.tipMsg="收藏成功";
              that.isCollect=true;
              that.gData.collect=e.colid;
            }
          })
        }else{
          this.$router.push("/login")
        }

      },
      delcollect(colid){
        var that=this;
        fetch("/ajax/goods/delCollect?colid="+colid).then(function (e) {
          return e.text()
        }).then(function (e) {
          if(e=="ok"){
            that.showTip=true;that.tipMsg="已取消收藏"
            that.isCollect=false;
          }
        })
      }
    }
  }
</script>

<style>
  .goodsHead{position: fixed;top: 0;left:0;width: 100%;}
.goodsUser{
  width: 100%;padding: 60px 15px 15px;
}
.goodsUser:after{content: "";display: block;clear: both;}
.goodsUser img{width: 50px;height: 50px;float: left;}
.goodsUser p{float: left;line-height: 50px;margin-left: 10px;font-size: 20px;color: #333;}
  .goodsInfo{width: 100%;padding: 0 15px 60px;}
  .goodsInfo p{line-height: 30px;color:#000;font-size: 16px;}
  .goodsInfo img{width: 100%}
  .goodsFoot{width: 100%;height: 50px;line-height: 50px;padding: 0 15px;position: fixed;bottom: 0;left: 0;background: #fff;}
  .zan,.shoucang{vertical-align: middle;margin-right: 5px;}
  .shoucang{margin-left: 15px;}
  .box{float: left;font-size: 14px;color: #333; }
  .buy{float: right;width: auto;height: 36px;font-size: 16px;padding: 0 15px;margin: 7px;}
</style>
