<template>
    <div>
        <el-button type="primary">
            <router-link to="/addCate" tag="span">添加分类</router-link>
        </el-button>
        <el-table
                v-loading="loading"
                :data="tableData"
                height="450"
                border
                style="width: 100%"
        >
            <el-table-column
                    prop="cid"
                    align="center"
                    label="分类ID"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="cname"
                    align="center"
                    label="分类名称"
                    width="180">
            </el-table-column>
            <el-table-column label="操作"
                             align="center">
                <template slot-scope="scope">
                    <el-button
                            size="mini"
                            @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                    <el-button
                            size="mini"
                            type="danger"
                            @click="handleDelete(scope.$index, scope.row)">删除</el-button>
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
                loading:true
            }
        },
        created(){
            var that=this;
            fetch("/category/select").then(function (e) {
                return e.json()
            }).then(function (e) {
                if(e.message){
                    console.log(e)
                    that.loading=false
                }else{
                    that.tableData=e
                    that.loading=false
                }
            })
        },
        methods:{
            handleEdit(index, row) {
                this.$router.push({path:"/editCate",query:row})
            },
            handleDelete(index, row) {
              this.$confirm('此操作将永久删除该信息, 是否继续?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
              }).then(() => {
                fetch("/category/del?cid="+row.cid).then((e)=>{
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
            }
        }
    }
</script>

<style scoped>

</style>
