<template>
    <div class="personal">
      <x-header :left-options="{showBack: false}" id="x-header">
        我的
        <a class="iconfont" style="color:#fff;font-size: 28px;margin-top: -5px;" slot="right" href="javascript:;" @click="gotoSet">&#xe736;</a>
      </x-header>
      <div class="userImg" v-if="userFront" >
        <div class="maskImg" >
          <div @click="changePhoto" :style="'background-image: url('+photo+')'">
            <!--<img src="@/assets/imgs/xc-t4.jpg" alt="" />-->
          </div>
        </div>
        <p>欢迎你，{{name}}</p>
      </div>
      <div class="userImg" v-else>
        <router-link to="/login" class="loginBtn">你还没有登录，去登录</router-link>
      </div>
      <img src="@/assets/imgs/gd.png" alt="" class="gd" />
      <ul class="my-menu">
        <li class="my-menu-list">
          <router-link :to="{path:'/published',query:{title:'我的发布'}}" class="mui-navigate-right">
            <span class="iconfont">&#xe635;</span>
            我的发布
            <span class="iconfont">&#xe639;</span>
          </router-link>
        </li>
        <li class="my-menu-list">
          <router-link :to="{path:'/buyed',query:{title:'我购买的'}}" class="mui-navigate-right">
            <span class="iconfont">&#xe65e;</span>
            我购买的
            <span class="iconfont">&#xe639;</span>
          </router-link>
        </li>
        <li class="my-menu-list">
          <router-link :to="{path:'/selled',query:{title:'购买我的'}}" class="mui-navigate-right">
            <span class="iconfont">&#xe660;</span>
            购买我的
            <span class="iconfont">&#xe639;</span>
          </router-link>
        </li>
        <li class="my-menu-list">
          <router-link :to="{path:'/address',query:{title:'收货地址'}}" class="mui-navigate-right">
            <span class="iconfont">&#xe61a;</span>
            我的收货地址
            <span class="iconfont">&#xe639;</span>
          </router-link>
        </li>
        <li class="my-menu-list">
          <router-link :to="{path:'/collected',query:{title:'我的收藏'}}" class="mui-navigate-right">
            <span class="iconfont">&#xe6ca;</span>
            我的收藏
            <span class="iconfont">&#xe639;</span>
          </router-link>
        </li>
        <li class="my-menu-list">
          <router-link :to="{path:'/priceinfo',query:{title:'账单信息'}}" class="mui-navigate-right">
            <span class="iconfont">&#xe89e;</span>
            账单信息
            <span class="iconfont">&#xe639;</span>
          </router-link>
        </li>
      </ul>
      <form action="" style="display: none;">
        <input type="file">
      </form>
      <toast v-model="showTip">{{tipMsg}}</toast>
    </div>
</template>

<script>
  import { Scroller, Divider, Spinner, XButton, Group, Cell, LoadMore, ButtonTab, ButtonTabItem,XHeader,Toast } from 'vux'
  import photoUpload from "@/assets/js/photoUpload"
    export default {
        name: "personal",
      components: {
        Scroller,XHeader,Toast,
        Divider,
        Spinner,
        XButton,
        Group,
        Cell,
        LoadMore, ButtonTab, ButtonTabItem
      },
      data:function () {
        return {
          userFront:false,
          btnTab:0,
          name:"",
          photo:"",
          showTip:false,
          tipMsg:"",
          uid:localStorage.getItem("userFront")
        }
      },
      mounted:function () {
          var that=this;
        if(this.uid){
          this.userFront=true;
          fetch("/ajax/users/select/"+that.uid).then(function (e) {
            return e.json()
          }).then(function (e) {
            that.name=e[0].name;
            that.photo=e[0].photo;
          })
        }
      },
      methods:{
        gotoSet(){
          this.$router.push({path:"/setMain",query:{title:"设置"}})
        },
        changePhoto(){
          //上传头像
          var that=this;
          var parent=document.querySelector(".maskImg div");
          var inputFile=document.querySelector("input")
          photoUpload.uploadInit(parent,inputFile);
          inputFile.addEventListener("change",function () {
            photoUpload.up("/ajax/goods/upload",function (e) {
              //  头像上传成功后，修改数据库路径
              fetch("/ajax/users/updatePhoto?photo="+e+"&uid="+that.uid).then(function (e) {
                return e.text()
              }).then(function (e) {
                if(e=="ok"){
                  that.showTip=true;that.tipMsg="修改成功"
                }
              })
            })
          })
        }
      }
    }
</script>

<style scoped>
  *{margin: 0;padding: 0;list-style: none;}

  .gd{width: 100%;}
  .userImg{
    text-align: center;
    width: 100%;height: 144px;background: #FF8053;margin-top: 40px;padding-top: 8px;
  }
  .maskImg{
    margin: 0 auto;
    width: 100px;height: 100px;border-radius: 50%;background: rgba(255,255,255,.4);display: flex;justify-content: center;align-items: center;
  }
  .maskImg div{width: 90px;height:90px;border-radius: 50%;overflow: hidden;background-repeat: no-repeat ;background-position: center;background-size: cover;}
  /*.maskImg img{width: 100%;height: 100%;float: left;}*/
  .userImg p{color: #fff;font-size: 16px;margin-top: 15px;}

  .loginBtn{line-height: 144px;color: #fff;}
  .myInfo{display: none;}

  .my-menu{overflow: hidden;padding: 10px 15px;}
  .my-menu-list{line-height: 40px;border-bottom: 1px solid #e5e5e5;}
  .my-menu-list a{color: #333;display: block;}
  .my-menu-list a span:first-of-type{color: #ff8053;margin-right: 10px;font-size: 22px;}
  .my-menu-list a span:last-of-type{margin-right: 10px;float: right;color:#ccc;}
.iconfont{vertical-align: middle;}
</style>
