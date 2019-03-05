<template>
    <el-form :model="ruleForm2" status-icon :rules="rules2" ref="ruleForm2" label-width="100px" class="demo-ruleForm" >
        <el-form-item label="管理员名称" prop="name">
            <el-input type="text" v-model="ruleForm2.name" auto-complete="off"></el-input>
        </el-form-item>
        <el-form-item label="密码" prop="pass">
            <el-input type="password" v-model="ruleForm2.pass" auto-complete="off"></el-input>
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="submitForm('ruleForm2')">提交</el-button>
            <el-button @click="resetForm('ruleForm2')">重置</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    export default {
        name:"Login",
        data() {
            var validatePass = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入密码'));
                }else{
                    callback()
                }
            };
            var validateName = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入管理员名称'));
                }else{
                    callback()
                }
            };
            return {
                ruleForm2: {
                    pass: '',
                    name:""
                },
                rules2: {
                    name: [
                        { validator: validateName, trigger: 'blur' }
                    ],
                    pass: [
                        { validator: validatePass, trigger: 'blur' }
                    ],
                }
            };
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    var that=this;
                    if (valid) {
                        fetch("/admin/checkLogin",{
                            method:"post",
                            headers:{"content-Type":"application/x-www-form-urlencoded"},
                            body:"aname="+this.ruleForm2.name+"&apass="+this.ruleForm2.pass
                        }).then(function (e) {
                            return e.json();
                        }).then(function (e) {
                            if(e.messages=="err"){
                                that.$message.error('账号或密码错误');
                            }else{
                                that.$message.success('登陆成功');
                                sessionStorage.adminLogin=JSON.stringify(e[0]);
                                that.$router.push("/");
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
