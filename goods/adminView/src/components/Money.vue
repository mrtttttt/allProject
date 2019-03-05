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
        <el-button type="primary" @click="selectMoney">查询</el-button>
      </div>

      <el-table
        :data="tableData"
        height="250"
        border
        style="width: 100%">
        <el-table-column
          prop="gtitle"
          label="商品标题"
          width="180">
        </el-table-column>
        <el-table-column
          prop="name2"
          label="商品所有者">
        </el-table-column>
        <el-table-column
          prop="name1"
          label="购买者"
          width="180">
        </el-table-column>
        <el-table-column
          prop="price"
          label="价钱">
        </el-table-column>
        <el-table-column
          prop="address"
          label="收货地址信息">
        </el-table-column>
        <el-table-column
          prop="mtime"
          label="时间">
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
              console.log(e)
              this.loading=false
            }else{
              this.options=e
              this.loading=false
            }
          })
          //交易信息
          fetch("/adminGoods/money").then((e)=>{
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
        selectMoney(){
          fetch("/adminGoods/money/"+this.value).then((e)=>{
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
