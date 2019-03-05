<template>
    <div class="setMain">
      <ul>
        <li @click="changeAccount">
          用户名
          <span class="iconfont">&#xe639;</span>
          <span>{{userInfo.name}}</span>
        </li>
        <li @click="changePhone">
          绑定手机
          <span class="iconfont">&#xe639;</span>
          <span>{{userInfo.phone}}</span>
        </li>
        <li @click="gotoSetPass">
          修改密码
          <span class="iconfont">&#xe639;</span>
        </li>
        <li>
          修改头像
          <span>点击个人头像即可修改</span>
        </li>
      </ul>
      <div @click="out">
        <x-button :gradients="['#FF5E3A', '#FF9500']" class="out">退出</x-button>
      </div>
      <toast v-model="show" type="text">{{showTip}}</toast>
      <div style="padding:15px;">
        <!--<x-button type="primary"> yonghu </x-button>-->
      </div>
      <div v-transfer-dom>
        <confirm v-model="show5"
                 show-input
                 :input-attrs="{type: 'text'}"
                 ref="confirm5"
                 :title="confirmTitle"
                 @on-confirm="onConfirm5"
                 @on-show="onShow5">
        </confirm>
      </div>
    </div>
</template>

<script>
  import { XButton, Group,Cell,XHeader,Toast,XInput,Confirm,TransferDomDirective as TransferDom  } from 'vux'
  export default {
    name: "set-main",
    directives: {
      TransferDom
    },
    data:function () {
      return {
        show:false,
        showTip:"",
        //show5修改用户名
        show5:false,
        userInfo:[],
        confirmTitle:"",
        confirmMsg:"",
        confirmType:"",
        may:false,
        uid:localStorage.getItem("userFront")
      }
    },
    components:{
      XButton,Group,Cell,XHeader,Toast,XInput,Confirm
    },
    mounted:function () {
      this.$emit('title',this.$route.query.title);
      var that=this;
      fetch("/ajax/users/select/"+that.uid).then(function (e) {
        return e.json()
      }).then(function (e) {
        that.userInfo=e[0]
      })
    },
    methods:{
      out(){
        var that=this;
        localStorage.removeItem("userFront");
        localStorage.removeItem("userName")
        localStorage.removeItem("userPhone")
        this.show=true;
        this.showTip="退出成功！";
        setTimeout(function () {
          that.$router.push("/")
        },500)
      },
      onShow5 () {
        this.$refs.confirm5.setInputValue(this.confirmMsg)
      },
      onConfirm5 (value) {
        var that=this;
        if(this.confirmType=="name"){
          if(value.trim()==""){
            this.show=true;
            this.showTip="用户名不能为空";
          }else{
            this.may=true;
          }
        }else if(this.confirmType=="phone"){
          if(value.trim()==""){
            this.show=true;
            this.showTip="手机号不能为空";
          }else if(!(/^((13[0-9])|(14[5|7])|(15([0-3]|[5-9]))|(18[0,5-9]))\\d{8}$/.test(value))){
            this.show=true;
            this.showTip="手机号格式错误";
          }else{
            this.may=true;
          }
        }
        if(this.may){
          fetch("/ajax/users/update?type="+that.confirmType+"&a="+value+"&uid="+that.userInfo.uid).then(function (e) {
            return e.text()
          }).then(function (e) {
            if(e=="ok"){
              if(that.confirmType=="name"){
                that.userInfo.name=value;
                that.may=false;
              }else if(that.confirmType=="phone"){
                that.userInfo.phone=value;
                that.may=false;
              }
            }
          })
        }

      },
      changeAccount(){
        this.confirmType="name"
        this.confirmTitle="修改用户名"
        this.confirmMsg=this.userInfo.name
        this.show5=true;
      },
      changePhone(){
        this.confirmType="phone"
        this.confirmTitle="修改手机号"
        this.confirmMsg=this.userInfo.phone
        this.show5=true;
      },
    //  修改密码
      gotoSetPass(){
        this.$router.push({path:'/setPass',query:{title:'修改密码'}})
      }
    }
  }
</script>

<style scoped>
  *{margin: 0;padding: 0;}
  ul{padding: 10px 15px;}
  li{list-style: none;line-height: 40px;color:#666;border-bottom: 1px solid #e5e5e5;}
  li span{float: right}
  li span:first-of-type{color:#ccc;}
  li span:last-of-type{margin-right: 10px;}
  li:last-of-type span:last-of-type{margin-right: 0;}
  .out{width: 80%;margin: 50px auto 0;}
</style>
