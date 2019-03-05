<template>
  <div class="main">
    <router-view class="mainBody"> </router-view>
    <FooterTab/>
  </div>
</template>

<script>
  import FooterTab from "@/components/FooterTab"
export default {
  name: 'Main',
  components:{FooterTab},
  data () {
    return {

    }
  }
}
</script>
<style scoped>

</style>
