<template>
  <div class="login">
    <div class="logo">
      <img src="@/assets/imgs/logo.png" alt="" />
    </div>
    <div class="content">
      <input type="text" id="account" v-model="account" placeholder="手机号" >
      <input id='password' v-model="password" type="password"  placeholder="密码" >
    </div>

    <div class="content">
      <button id='login' @click="submit()">登录</button>
      <div class="link-area"><a id='reg' @click="register">注册账号</a> <span class="spliter">|</span> <a id='forgetPassword'>忘记密码</a>
      </div>
    </div>
    <toast v-model="showTip" :text="tipMessage"> </toast>
    <toast v-model="showWarn" type="cancel" :text="warnMessage"> </toast>
  </div>
</template>

<script>
  import { Toast,XInput } from 'vux'
    export default {
        name: "login",
      components:{
          Toast,XInput
      },
      data:function () {
        return {
          account:"",
          password:"",
          showTip:false,
          tipMessage:"",
          showWarn:false,
          warnMessage:""
        }
      },
        methods:{
          submit(){
            var that=this;
            fetch("/ajax/users/login",{
              method: "POST",
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
              },
              body: "account="+that.account+"&password="+that.password
            }).then(function (e) {
              return e.json();
            }).then(function (e) {
                if(e.message){
                  that.showWarn=true;
                  that.warnMessage="账号或密码错误";
                }else{
                  localStorage.userFront=e[0].uid;
                  localStorage.userName=e[0].name;
                  localStorage.userPhone=e[0].phone;
                  that.showTip=true;
                  that.tipMessage="登录成功";
                  setTimeout(function () {
                    that.$router.go(-1)
                  },600)
                }

            })
          },
          register(){
            this.$router.push("/register")
          }
        }
    }
</script>

<style scoped>
  .logo{
    width: 200px;height: 200px;margin: 30px auto 0px;
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
