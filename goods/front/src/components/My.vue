<template>
  <div>
    <div class="setHead">
      <span class="iconfont goBack" @click="goBack">&#xe641;</span>{{title}}
    </div>
    <router-view @title="listenTitle" @chooseaddr="chooseAddr" class="myMain"/>
  </div>
</template>

<script>
  import { Scroller, Divider, Spinner, XButton, Group, Cell, LoadMore, ButtonTab, ButtonTabItem,XHeader } from 'vux'
  export default {
    name: "my",
    components: {
      Scroller,XHeader,
      Divider,
      Spinner,
      XButton,
      Group,
      Cell,
      LoadMore, ButtonTab, ButtonTabItem
    },
    data:function () {
      return {
        title:""
      }
    },

    methods:{
      goBack(){
        this.$router.go(-1)
      },
      listenTitle(title){
        this.title=title;
      },
      chooseAddr(e){
        this.$emit("chooseaddr",e)
      }
    }
  }
</script>


<style scoped>
.myMain{padding-top: 50px;}
  .goBack{position:absolute;top:0;left: 10px;font-size: 24px;}
</style>

