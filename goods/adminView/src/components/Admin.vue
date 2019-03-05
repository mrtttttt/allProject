<template>
  <el-container>
    <el-header>
        互惠APP后台
    </el-header>
    <el-container>
      <el-aside width="200px;">
          <MyMenu style="width: 100%"></MyMenu>
      </el-aside>
      <el-main>
        <router-view></router-view>
      </el-main>
    </el-container>
  </el-container>
</template>

<script>
  import MyMenu from "@/components/MyMenu"
export default {
  name: 'Admin',
  components:{MyMenu},
  data () {
    return {

    }
  }
}
</script>

<style scoped>
  .el-header, .el-footer {
    background-color: #B3C0D1;
    color: #333;
    text-align: center;
    line-height: 60px;font-size: 28px;
  }

  .el-aside {
    background-color: #fff;
    color: #333;
    /*text-align: center;*/
    line-height: 200px;
  }

  .el-main {
    background-color: #E9EEF3;
    color: #333;
    /*text-align: center;*/
    line-height: 30px;
  }
  .el-container{
    height: 100vh;
  }

  body > .el-container {
    margin-bottom: 40px;
  }
  aside{
    width: 200px;
  }

  .el-container:nth-child(5) .el-aside,
  .el-container:nth-child(6) .el-aside {
    line-height: 260px;
  }

  .el-container:nth-child(7) .el-aside {
    line-height: 320px;
  }
</style>
