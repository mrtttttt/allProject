<template>
  <div class="mui-content login">
    <div class="logo">
      <img src="@/assets/imgs/logo.png" alt="" />
    </div>
    <div class="content">
      <input type="text" id="account" v-model="account" placeholder="手机号" @blur="accountBlur"  >
      <input id='password' v-model="password" type="password"  placeholder="设置新密码"  >
      <input v-model="password2" type="password" placeholder="确认密码" >
    </div>

    <div class="content">
      <button id='login' @click="register">注册</button>
      <div class="link-area"><a id='reg' @click="login">去登录</a>
      </div>
    </div>
    <toast v-model="showTip" :text="tipMessage"> </toast>
    <toast v-model="showWarn" type="cancel" :text="warnMessage" class="warn" width="8.5em">  </toast>
  </div>
</template>

<script>
  import { Toast } from 'vux'
  export default {
    name: "login",
    components:{
      Toast
    },
    data:function () {
      return {
        account:"",
        password:"",
        password2:"",
        showTip:false,
        tipMessage:"",
        showWarn:false,
        warnMessage:"",
        may:false
      }
    },
    methods:{
      register(){
        var that=this;
        if(this.may){
          if(this.password!=this.password2){
            that.showWarn=true;
            that.warnMessage="两次密码不一致";
            return ;
          }
          fetch("/ajax/users/register",{
            method: "POST",
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: "account="+that.account+"&password="+that.password+"&password2="+that.password2
          }).then(function (e) {
            return e.json();
          }).then(function (e) {
            localStorage.userFront=e[0].uid;
            localStorage.userName=e[0].name;
            localStorage.userPhone=e[0].phone;
            that.showTip=true;
            that.tipMessage="注册成功";
            setTimeout(function () {
              that.$router.go(-2)
            },600)
          })
        }else{
          that.showWarn=true;
          that.warnMessage="请正确填写信息";
        }

      },
      accountBlur(){
        var that=this;
        var reg=11 && /^((13|14|15|17|18)[0-9]{1}\d{8})$/;
        if(this.account==''){
          that.showWarn=true;
          that.warnMessage="请输入手机号";
        }else if(!reg.test(this.account)){
          that.showWarn=true;
          that.warnMessage="手机格式不正确";
        }else{
          fetch("/ajax/users/selected/"+this.account).then(function (e) {
            return e.text()
          }).then(function (e) {
            if(e=="already"){
              that.showWarn=true;
              that.warnMessage="该手机号已注册过";
              that.may=false;
            }else if(e=="none"){
              that.may=true;
            }
          })
        }
      },
      login(){
        this.$router.go(-1)
      }
    }
  }
</script>

<style scoped>
  .logo{
    width: 200px;height: 200px;margin: 30px auto 0;
  }
  .logo img{
    width: 100%;height: 100%;float: left;
  }
  input{
    width: 100%;height:40px;outline: none;
    border-radius: 40px;transition: .3s;
    margin: 0 auto 25px;border: 1px solid #C6C5C4;
    padding-left: 25px;box-sizing: border-box;
  }
  .content {
    margin:0 auto;width: 80%;
  }

  button {
    width: 100%;
    background: #FFB398;color: #fff;border: none;outline: none;
    padding: 10px;border-radius: 7px;
  }

  .link-area {
    display: block;
    margin-top: 25px;
    text-align: center;
  }
  .link-area a{
    color: #FFB398;
  }

  .spliter {
    color: #bbb;
    padding: 0px 8px;
  }

</style>
