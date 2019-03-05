<template>
    <div class="footerTab">
      <div>
        <router-link to="/" exact>
          <svg class="icon icon-1" aria-hidden="true">
            <use xlink:href="#icon-ziyuan15"></use>
          </svg>
          <span>首页</span>
        </router-link>
      </div>
      <div>
        <router-link to="/publish">
          <p class="iconfont">&#xe635;</p>
        </router-link>
      </div>
      <div>
        <router-link to="/personal">
          <svg class="icon icon-1" aria-hidden="true">
            <use xlink:href="#icon-ziyuan11"></use>
          </svg>
          <span>我的</span>
        </router-link>
      </div>
    </div>
</template>

<script>
  import {Tabbar,TabbarItem} from "vux"
    export default {
        name: "footerTab",
       components:{Tabbar,TabbarItem}
    }
</script>

<style>
.router-link-active{color:#ff8053;}
</style>
