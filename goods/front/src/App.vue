<template>
  <div id="app">
    <keep-alive>
      <router-view v-if="$route.meta.keepAlive" @chooseaddr="chooseAddr" :addr-data="addrData" />
    </keep-alive>
    <router-view v-if="!$route.meta.keepAlive" @chooseaddr="chooseAddr" :addr-data="addrData" />
  </div>
</template>

<script>
export default {
  name: 'App',
  data:function () {
    return {
      addrData:[]
    }
  },
  mounted(){
    if(localStorage.getItem("userFront")){
      fetch("/ajax/users/select/"+localStorage.getItem("userFront")).then((e)=>{
        return e.json();
      }).then((e)=>{
        if(e.length){

        }else{
          localStorage.removeItem("userFront")
          localStorage.removeItem("userName")
          localStorage.removeItem("userPhone")
        }
      })
    }
  },
  methods:{
    chooseAddr(e){
      this.addrData=e
    }
  }
}
</script>

<style>
#app{
  width: 100%;
  /*height: 100vh;*/
}
</style>
