<template>
    <div>
        <!--<el-button type="primary">
            <router-link to="/addGoods" tag="span">添加商品</router-link>
        </el-button>-->
        <el-table
                v-loading="loading"
                :data="tableData"
                border
                style="width: 100%"
        >
            <el-table-column
                    prop="gtitle"
                    align="center"
                    label="标题">
            </el-table-column>
            <el-table-column
                    prop="ginfo"
                    align="center"
                    label="内容">
            </el-table-column>
            <el-table-column
                    prop="price"
                    align="center"
                    label="价格">
            </el-table-column>
            <el-table-column
                    prop="name"
                    align="center"
                    label="发布人">
            </el-table-column>


            <el-table-column
                    prop="gtime"
                    align="center"
                    label="发布时间">
            </el-table-column>
            <el-table-column
                    prop="cname"
                    align="center"
                    label="所属分类">
            </el-table-column>
            <el-table-column
                    prop="state"
                    align="center"
                    label="当前状态">
            </el-table-column>
            <el-table-column label="操作"
                             align="center">
                <template slot-scope="scope">
                    <el-button
                            size="mini"
                            @click="handleEdit(scope.$index, scope.row)">编辑状态</el-button>
                    <el-button
                            size="mini"
                            type="danger"
                            @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                </template>
            </el-table-column>
        </el-table>
        <div style="width: 100%;text-align: center;margin-top: 30px;">
          <el-button-group>
            <el-button type="primary" icon="el-icon-arrow-left" @click="pre" style="margin-right: 250px;">上一页</el-button>
            <el-button type="primary" @click="next">下一页<i class="el-icon-arrow-right el-icon--right"></i></el-button>
          </el-button-group>
        </div>

    </div>

</template>

<script>
    export default {
        data() {
            return {
                tableData: [],
                loading:true,
                counter:0,
                num:20,
                flag:true,
            }
        },
        created(){
            fetch("/adminGoods/select?counter="+this.counter+"&num="+this.num).then((e)=>{
              return e.json();
            }).then((e)=>{
              if(e.message){
                this.loading=false;
              }else{
                this.tableData=e;
                this.loading=false;
              }
            })

        },
        methods:{
            //上一页
            pre(){
                this.counter=this.counter<=0?0:this.counter-1;
                var that=this;
                fetch("/adminGoods/select?counter="+this.counter+"&num="+this.num).then(function (e) {
                    return e.json()
                }).then(function (e) {
                    if(e.message){
                        that.loading=false
                    }else{
                        that.tableData=e
                        that.loading=false
                        that.flag = true
                    }
                })
            },
            //下一页
            next(){
                if(this.flag) {
                    this.counter++;
                    var that = this;
                    fetch("/adminGoods/select?counter=" + this.counter+"&num="+this.num).then(function (e) {
                        return e.json()
                    }).then(function (e) {
                        if (e.message || !(e.length)) {
                            that.flag = false
                            that.counter--;
                            that.loading = false
                        } else {
                            that.tableData = e
                            that.loading = false
                        }
                    })
                }
            },
            handleEdit(index, row) {
              var html="";
              if(row.state=="正常发布，未卖出"){
                html=`<select class="select"><option value="0" selected>正常发布，未卖出</option><option value="1">已卖出</option><option value="2">强制下架</option></select>`
              }else if(row.state=="已卖出"){
                html=`<select class="select"><option value="0">正常发布，未卖出</option><option value="1" selected>已卖出</option><option value="2">强制下架</option></select>`
              }else if(row.state=="强制下架"){
                html=`<select class="select"><option value="0">正常发布，未卖出</option><option value="1">已卖出</option><option value="2" selected>强制下架</option></select>`
              }
                this.$alert(html, '修改状态', {
                  confirmButtonText: '确定',
                  cancelButtonText: '取消',
                  showCancelButton:true,
                  dangerouslyUseHTMLString: true
                }).then(() => {
                  var value=document.querySelector(".select").value
                  fetch("/adminGoods/updateState?state="+value+"&gid="+row.gid).then((e)=>{
                    return e.text();
                  }).then((e)=>{
                    if(e=="ok"){
                      if(value==0){
                        row.state="正常发布，未卖出"
                      }else if(value==1){
                        row.state="已卖出"
                      }else if(value==2){
                        row.state="强制下架"
                      }
                      this.$message({
                        type: 'success',
                        message: '修改成功'
                      });
                    }
                  })
                }).catch(() => {
                  this.$message({
                    type: 'info',
                    message: '取消修改'
                  });
                })
                // this.$router.push({path:"/editGoods",query:row})
            },
            handleDelete(index, row) {
              this.$confirm('此操作将永久删除该信息, 是否继续?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
              }).then(() => {
                fetch("/adminGoods/del/"+row.gid).then((e)=>{
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

        }
    }
</script>

<style scoped>

</style>
