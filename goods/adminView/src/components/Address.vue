<template>
  <div>
    <div style="margin-bottom: 30px;">
      <el-select v-model="value" filterable placeholder="请选择">
        <el-option
          v-for="item in options"
          :key="item.uid"
          :label="item.name"
          :value="item.uid">
        </el-option>
      </el-select>
      <el-button type="primary" @click="selectAddress">查询</el-button>
    </div>

    <el-table
      :data="tableData"
      height="250"
      border
      style="width: 100%">
      <el-table-column
        prop="name"
        label="用户"
        width="180">
      </el-table-column>
      <el-table-column
        prop="aname"
        label="收货人">
      </el-table-column>
      <el-table-column
        prop="aphone"
        label="收货电话"
        width="180">
      </el-table-column>
      <el-table-column
        prop="address"
        label="收货地址">
      </el-table-column>
      <el-table-column
        prop="defau"
        label="默认地址">
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
  export default {
    name: "money",
    data:function () {
      return{
        tableData:[],
        loading:true,
        value:'',
        options:[]
      }
    },
    created(){
      //用户信息
      fetch("/adminUsers/select").then((e)=>{
        return e.json();
      }).then((e)=>{
        if(e.message){
          this.loading=false
        }else{
          this.options=e
          this.loading=false
        }
      })
      //交易信息
      fetch("/adminUsers/address").then((e)=>{
        return e.json()
      }).then((e)=>{
        if(e.message){
          this.loading=false;
        }else {
          this.tableData=e;
          this.loading=false;
        }
      })
    },
    methods:{
      selectAddress(){
        fetch("/adminUsers/selectAddress?uid="+this.value).then((e)=>{
          return e.json();
        }).then((e)=>{
          if(e.message){
            this.loading=false;
          }else {
            this.tableData=e;
            this.loading=false;
          }
        })
      }
    }
  }
</script>

<style scoped>

</style>
