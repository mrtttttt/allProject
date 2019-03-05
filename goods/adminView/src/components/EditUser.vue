<template>
    <el-form :model="ruleForm2" status-icon :rules="rules2" ref="ruleForm2" label-width="100px" class="demo-ruleForm" >
      <el-form-item label="用户名" prop="name">
        <el-input type="text" v-model="ruleForm2.name" auto-complete="off"></el-input>
      </el-form-item>
      <el-form-item label="密码" prop="pass">
        <el-input type="password" v-model="ruleForm2.pass" auto-complete="off"></el-input>
      </el-form-item>
      <el-form-item label="电话" prop="phone">
        <el-input type="tel" v-model="ruleForm2.phone" auto-complete="off"></el-input>
      </el-form-item>
      <el-form-item label="余额" prop="money">
        <el-input type="number" v-model="ruleForm2.money" auto-complete="off"></el-input>
      </el-form-item>
      <el-form-item label="头像">
        <el-upload
          class="avatar-uploader"
          action="/adminUsers/upload"
          name="files"
          :show-file-list="false"
          :on-success="handleAvatarSuccess"
          :before-upload="beforeAvatarUpload">
          <img v-if="imageUrl" :src="imageUrl" class="avatar">
          <i v-else class="el-icon-plus avatar-uploader-icon"></i>
        </el-upload>
      </el-form-item>
      <el-form-item label="个人信息" prop="info">
        <el-input type="textarea" v-model="ruleForm2.info" auto-complete="off"></el-input>
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
        name:"AddAdmin",
        data() {
            var validateName = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入用户名'));
                }else{
                    callback()
                }
            };
            return {
                imageUrl: '',
                image: '',
                ruleForm2: {
                    name: "",
                    pass:"",
                    uid:"",
                    phone:"",
                    info:"",
                    money:"",
                },
                rules2: {
                    name: [
                        { validator: validateName, trigger: 'blur' }
                    ]
                }
            };
        },

        created(){
            this.ruleForm2.name=this.$route.query.name;
            this.ruleForm2.uid=this.$route.query.uid;
            this.ruleForm2.money=this.$route.query.money;
            this.ruleForm2.info=this.$route.query.info;
            this.ruleForm2.phone=this.$route.query.phone;
            this.imageUrl=this.$route.query.photo;
            this.image=this.$route.query.photo;
            this.ruleForm2.uid=this.$route.query.uid;
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    var that=this;
                    if (valid) {
                        fetch("/adminUsers/update",{
                            method:"post",
                            headers:{"content-Type":"application/x-www-form-urlencoded"},
                            body:"name="+this.ruleForm2.name+"&pass="+this.ruleForm2.pass+"&phone="+this.ruleForm2.phone+"&info="+this.ruleForm2.info+"&money="+this.ruleForm2.money+"&photo="+this.image+"&uid="+this.ruleForm2.uid
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
            handleAvatarSuccess(res, file) {
                this.imageUrl = URL.createObjectURL(file.raw);
                this.image=res;
            },
            beforeAvatarUpload(file) {
                const isJPG = file.type === 'image/jpeg';
                const isLt2M = file.size / 1024 / 1024 < 2;

                if (!isJPG) {
                    this.$message.error('上传头像图片只能是 JPG 格式!');
                }
                if (!isLt2M) {
                    this.$message.error('上传头像图片大小不能超过 2MB!');
                }
                return isJPG && isLt2M;
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
    .avatar-uploader .el-upload {
        border: 1px dashed #d9d9d9;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .avatar-uploader .el-upload:hover {
        border-color: #409EFF;
    }
    .avatar-uploader-icon {
        font-size: 28px;
        color: #8c939d;
        width: 178px;
        height: 178px;
        line-height: 178px;
        text-align: center;
    }
    .avatar {
        width: 178px;
        height: 178px;
        display: block;
    }
</style>
