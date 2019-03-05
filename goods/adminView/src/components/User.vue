<template>
    <div>
        <el-button type="primary">
            <router-link to="/addUser" tag="span">添加用户</router-link>
        </el-button>
        <div style="margin-bottom: 30px;">
          <el-select v-model="value" filterable placeholder="请选择">
            <el-option
              v-for="item in options"
              :key="item.uid"
              :label="item.name"
              :value="item.uid">
            </el-option>
          </el-select>
          <el-button type="primary" @click="selectUser">查询</el-button>
        </div>

        <el-table
                :data="tableData"
                style="width: 100%">
            <el-table-column
                    label="头像"
                    width="150"
                    height="150">
                <template slot-scope="scope">
                    <img :src="scope.row.photo" alt="" style="width:75px;height:75px;">
                </template>
            </el-table-column>
            <el-table-column
                    label="昵称"
                    width="180">
                <template slot-scope="scope">
                    {{ scope.row.name }}
                </template>
            </el-table-column>
            <el-table-column
                    label="电话"
                    width="180">
                <template slot-scope="scope">
                    {{ scope.row.phone }}
                </template>
            </el-table-column>
            <el-table-column
                    label="个人信息"
                    width="180">
                <template slot-scope="scope">
                    {{ scope.row.info }}
                </template>
            </el-table-column>
            <el-table-column
                    label="余额"
                    width="180">
                <template slot-scope="scope">
                    {{ scope.row.money }}
                </template>
            </el-table-column>
            <el-table-column label="操作">
                <template slot-scope="scope">
                    <el-button
                            size="mini"
                            @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                    <el-button
                            size="mini"
                            type="danger"
                            @click="openDel(scope.$index, scope.row)">删除</el-button>
                </template>
            </el-table-column>
        </el-table>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                tableData: [],
                loading:true,
                value:'',
                options:[]
            }
        },
        created(){
            var that=this;
            fetch("/adminUsers/select").then(function (e) {
                return e.json()
            }).then(function (e) {
                if(e.message){
                    that.loading=false
                }else{
                    that.tableData=e
                    that.options=e
                    that.loading=false
                }
            })
        },
        methods:{
            handleEdit(index, row) {
                delete row.upass;
                this.$router.push({path:"/editUser",query:row})
            },
          openDel(index, row) {
            this.$confirm('此操作将永久删除该信息, 是否继续?', '提示', {
              confirmButtonText: '确定',
              cancelButtonText: '取消',
              type: 'warning'
            }).then(() => {
              fetch("/adminUsers/del?uid="+row.uid).then((e)=>{
                return e.text()
              }).then((e)=>{
                if(e=="ok"){
                  this.$message({
                    type: 'success',
                    message: '删除成功!'
                  });
                  this.tableData.splice(index,1);
                }
              })
            }).catch(() => {
              this.$message({
                type: 'info',
                message: '已取消删除'
              });
            });
          },
          selectUser(){
            fetch("/adminUsers/selectUser?uid="+this.value).then((e)=>{
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
