<template>
    <el-form :model="ruleForm2" status-icon :rules="rules2" ref="ruleForm2" label-width="100px" class="demo-ruleForm" >
        <el-form-item label="位置名称" prop="name">
            <el-input type="text" v-model="ruleForm2.name" auto-complete="off"></el-input>
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="submitForm('ruleForm2')">提交</el-button>
            <el-button @click="resetForm('ruleForm2')">重置</el-button>
            <el-button @click="back">返回</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    export default {
        name:"EditPosi",
        data() {
            var validateName = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入姓名'));
                }else{
                    callback()
                }
            };
            return {
                ruleForm2: {
                    name: "",
                    cid: "",
                },
                rules2: {
                    name: [
                        { validator: validateName, trigger: 'blur' }
                    ]
                }
            };
        },

        created(){
            this.ruleForm2.name=this.$route.query.cname;
            this.ruleForm2.cid=this.$route.query.cid;
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    var that=this;
                    if (valid) {
                        fetch("/category/update",{
                            method:"post",
                            headers:{"content-Type":"application/x-www-form-urlencoded"},
                            body:"cname="+this.ruleForm2.name+"&cid="+this.ruleForm2.cid
                        }).then(function (e) {
                            return e.text();
                        }).then(function (e) {
                            if(e=="ok"){
                                that.$message({
                                    message:"修改成功",
                                    type:"success",
                                    duration:1000
                                })
                                that.$router.go(-1)
                            }
                        })
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },
            back(){
                this.$router.go(-1);
            }
        }
    }
</script>

<style scoped>
    .demo-ruleForm{
        width: 40%;
        height: 250px;
        position: absolute;top:0;left: 0;right:0;bottom: 0;
        margin: auto;
    }
</style>
