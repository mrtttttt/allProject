<template>
    <div id="setPass">
      <div class="block">
        <span>旧密码:</span>
        <input type="text" placeholder="请输入旧密码" v-model="oldpass" >
      </div>
      <div class="block">
        <span>新密码:</span>
        <input type="text" placeholder="请输入新密码" v-model="password" >
      </div>
      <div class="block">
        <span>确认密码:</span>
        <input type="text" placeholder="请确认密码" v-model="password2" >
      </div>
      <button @click="submit" class="submit">确认修改</button>
      <toast v-model="showTip" type="text">{{tipMsg}}</toast>
    </div>
</template>

<script>
  import { XInput, Group, XButton, Toast } from 'vux'
    export default {
      name: "set-pass",
      components:{XInput, XButton,Group,Toast},
      data:function () {
        return {
          oldpass: '',
          password: '',
          password2: '',
          showTip: false,
          tipMsg: "",
        }
      },
      mounted(){
        this.$emit('title',this.$route.query.title);
      },
      methods:{
        submit(){
          var that=this;
          if(this.oldpass.trim()==""){
            this.showTip=true;
            this.tipMsg="旧密码不能为空";
          }else if(this.oldpass.trim()==this.password.trim()){
            this.showTip=true;
            this.tipMsg="旧密码与新密码不能一致";
          }else if(this.password.trim()=="" ||this.password2.trim()==""){
            this.showTip=true;
            this.tipMsg="新密码不能为空";
          }else if(this.password.trim()!=this.password2.trim()){
            this.showTip=true;
            this.tipMsg="两次密码不一致";
          }else{
            fetch("/ajax/users/updatePass?oldpass="+this.oldpass+"&pass="+this.password+"&uid="+localStorage.getItem("userFront")).then(function (e) {
              return e.text();
            }).then(function (e) {
              if(e=="ok"){
                that.showTip=true;
                that.tipMsg="修改成功";
                setTimeout(function () {
                  that.$router.go(-1)
                },600)
              }else if(e=="err"){
                that.showTip=true;
                that.tipMsg="修改失败";
                setTimeout(function () {
                  that.$router.go(-1)
                },600)
              }
            })
          }

        }
      }
    }
</script>

<style scoped>
  *{margin: 0;padding: 0;}
  #setPass{padding: 60px 15px;}
  input{line-height: 35px;width: 65%;outline: none;border: none;border-bottom: 1px solid #e5e5e5;float: right;}
  .block span{display: block;width: 30%;text-align: right;float: left;line-height: 35px;}
  .block{overflow: hidden;}
.submit{
  display: block;
  width: 80%;height: 50px;margin: 30px auto;
}
</style>
