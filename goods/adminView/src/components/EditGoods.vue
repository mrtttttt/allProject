<template>
    <el-form :model="ruleForm2" status-icon :rules="rules2" ref="ruleForm2" label-width="100px" class="demo-ruleForm" >
        <el-form-item label="标题" prop="title">
            <el-input type="text" v-model="ruleForm2.title" auto-complete="off"></el-input>
        </el-form-item>
        <el-form-item label="内容" prop="con">
            <el-input type="textarea" v-model="ruleForm2.con" auto-complete="off"></el-input>
        </el-form-item>
        <el-form-item label="价格" prop="money">
            <el-input type="text" v-model="ruleForm2.money" auto-complete="off"></el-input>
        </el-form-item>
        <el-form-item label="路线">
            <el-col :span="10">
                <el-input type="text" v-model="ruleForm2.start" auto-complete="off"></el-input>
            </el-col>
            <el-col :span="2" style="text-align: center">-</el-col>
            <el-col :span="10">
                <el-input type="text" v-model="ruleForm2.end" auto-complete="off"></el-input>
            </el-col>
        </el-form-item>
        <el-form-item label="车程时间段">
            <el-col :span="10">
                <el-input type="text" v-model="ruleForm2.startTime" auto-complete="off"></el-input>
            </el-col>
            <el-col :span="2" style="text-align: center">-</el-col>
            <el-col :span="10">
                <el-input type="text" v-model="ruleForm2.endTime" auto-complete="off"></el-input>
            </el-col>
        </el-form-item>
        <el-form-item label="所属位置" prop="pid">
            <el-input type="text" v-model="ruleForm2.pid" auto-complete="off"></el-input>
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="submitForm('ruleForm2')">修改</el-button>
            <el-button @click="resetForm('ruleForm2')">重置</el-button>
            <el-button @click="back">返回</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    export default {
        name:"AddAdmin",
        data() {
            var validateTitle = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入标题'));
                }else{
                    callback()
                }
            };
            var validateCon = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入内容'));
                }else{
                    callback()
                }
            };
            var validateMoney = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入价格'));
                }else{
                    callback()
                }
            };
            return {
                ruleForm2: {
                    title: "",
                    con: "",
                    money: "",
                    pid: "",
                    cid: "",
                    start: "",
                    end: "",
                    startTime: "",
                    endTime: "",
                },
                rules2: {
                    title: [
                        { validator: validateTitle, trigger: 'blur' }
                    ],
                    con: [
                        { validator: validateCon, trigger: 'blur' }
                    ],
                    money: [
                        { validator: validateMoney, trigger: 'blur' }
                    ]
                }
            };
        },

        created(){
            this.ruleForm2.title=this.$route.query.title;
            this.ruleForm2.con=this.$route.query.content;
            this.ruleForm2.money=this.$route.query.money;
            this.ruleForm2.pid=this.$route.query.pid;
            this.ruleForm2.start=this.$route.query.start;
            this.ruleForm2.end=this.$route.query.end;
            this.ruleForm2.startTime=this.$route.query.startTime;
            this.ruleForm2.endTime=this.$route.query.endTime;
            this.ruleForm2.cid=this.$route.query.cid;
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    var that=this;
                    if (valid) {
                        fetch("/content/update",{
                            method:"post",
                            headers:{"content-Type":"application/x-www-form-urlencoded"},
                            body:"title="+this.ruleForm2.title+"&con="+this.ruleForm2.con+"&money="+this.ruleForm2.money+"&pid="+this.ruleForm2.pid+"&cid="+this.ruleForm2.cid+"&start="+this.ruleForm2.start+"&end="+this.ruleForm2.end+"&startTime="+this.ruleForm2.startTime+"&endTime="+this.ruleForm2.endTime
                        }).then(function (e) {
                            return e.text();
                        }).then(function (e) {
                            if(e=="ok"){
                                that.$message({
                                    message:"修改成功",
                                    type:"success",
                                    duration:1000
                                })
                                that.$router.push("/content")
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
