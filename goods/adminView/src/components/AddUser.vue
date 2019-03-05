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
        name:"AddUser",
        data() {
            var validateName = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入用户名'));
                }else{
                    callback()
                }
            };
            var validatePass = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入密码'));
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
                    phone:"",
                    info:"",
                    money:"",
                },
                rules2: {
                    name: [
                        { validator: validateName, trigger: 'blur' }
                    ],
                    pass: [
                        { validator: validatePass, trigger: 'blur' }
                    ]
                }
            };
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    var that=this;
                    if (valid) {
                        fetch("/adminUsers/add",{
                            method:"post",
                            headers:{"content-Type":"application/x-www-form-urlencoded"},
                            body:"name="+this.ruleForm2.name+"&pass="+this.ruleForm2.pass+"&phone="+this.ruleForm2.phone+"&info="+this.ruleForm2.info+"&money="+this.ruleForm2.money+"&photo="+this.image
                        }).then(function (e) {
                            return e.text();
                        }).then(function (e) {
                            if(e=="ok"){
                                that.$message({
                                    message:"添加成功",
                                    type:"success",
                                    duration:1000
                                })
                                that.resetForm('ruleForm2')
                            }
                        })
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            //上传成功
            handleAvatarSuccess(res, file) {
                this.imageUrl = URL.createObjectURL(file.raw);
                this.image = res;
            },
            //上传之前判断格式大小
            beforeAvatarUpload(file) {
                const isJPG = file.type === 'image/jpeg'||file.type === 'application/x-jpg'||file.type === 'image/png'||file.type === 'image/gif';
                const isLt2M = file.size / 1024 / 1024 < 2;

                if (!isJPG) {
                    this.$message.error('上传头像图片只能是 JPG,png,gif,jpeg 格式!');
                }
                if (!isLt2M) {
                    this.$message.error('上传头像图片大小不能超过 2MB!');
                }
                return isJPG && isLt2M;
            },
            //重置
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
        width: 60%;
    }
    .avatar-uploader{width: 178px;border: 1px dashed #d9d9d9;}
    .avatar-uploader:hover{border-color: #409EFF;}
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
