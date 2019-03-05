<template>
    <div class="editAddress">
      <group label-width="4.5em" label-margin-right="1em" label-align="right">
        <x-input title="姓名" v-model="name" :required="true"> </x-input>
        <x-input title="联系方式" v-model="phone" is-type="china-mobile" ref="phone"> </x-input>
        <x-textarea :required="true" title="详细地址" placeholder="请填写详细地址" :show-counter="false" :rows="3" v-model="addr"> </x-textarea>
        <a v-if="aid" href="javascript:;" class="delAddr" @click="del(aid)">删除地址?</a>
      </group>
      <button class="newAddr" @click="add">保存地址</button>
      <toast v-model="showTip" :text="tipMessage"> </toast>
      <toast v-model="showWarn" type="cancel" :text="warnMessage"> </toast>
    </div>
</template>

<script>
  import { Group,XAddress,XTextarea,XInput,ChinaAddressData,Toast } from 'vux'
    export default {
        name: "edit-address",
        components:{Group,XTextarea,XAddress,XInput,Toast},
        data:function () {
          return {
            name:"",
            phone:"",
            addr:"",
            showTip:false,
            tipMessage:"",
            showWarn:false,
            warnMessage:"",
            aid:"",
            uid:localStorage.getItem("userFront")
          }
        },
        mounted(){
          this.$emit('title',this.$route.query.title);
          this.aid=this.$route.query.aid;
          var that=this;
          if(this.aid){
            fetch("/ajax/goods/selectEditAddr/"+this.aid).then(function (e) {
              return e.json()
            }).then(function (e) {
              that.name=e[0].aname;
              that.phone=e[0].aphone;
              that.addr=e[0].address;
            })
          }
        },
        methods:{
          add(){
            var that=this;

            if (!this.$refs.phone.valid ||this.phone.trim()==""){
              this.showWarn=true;
              this.warnMessage="联系方式不能为空";
              return ;
            }else if(this.name.trim()==""){
              this.showWarn=true;
              this.warnMessage="姓名不能为空";
              return ;
            }else if(this.addr.trim()==""){
              this.showWarn=true;
              this.warnMessage="详细地址不能为空";
              return ;
            }else{
              if(this.aid){
                fetch("/ajax/goods/editAddr",{
                  method: "POST",
                  headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                  },
                  body: "aname="+that.name+"&aphone="+that.phone+"&address="+that.addr+"&aid="+this.aid
                }).then(function (e) {
                  return e.json();
                }).then(function (e) {
                  if(!e.message){
                    that.showWarn=true;
                    that.warnMessage="修改出现错误";
                  }else{
                    that.showTip=true;
                    that.tipMessage="修改成功";
                    setTimeout(function () {
                      that.$router.go(-1)
                    },600)
                  }
                })
              }else{
                fetch("/ajax/goods/addAddr",{
                  method: "POST",
                  headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                  },
                  body: "aname="+that.name+"&aphone="+that.phone+"&address="+that.addr+"&uid="+that.uid
                }).then(function (e) {
                  return e.json();
                }).then(function (e) {
                  if(!e.message){
                    that.showWarn=true;
                    that.warnMessage="添加出现错误";
                  }else{
                    that.showTip=true;
                    that.tipMessage="添加成功";
                    setTimeout(function () {
                      that.$router.go(-1)
                    },600)
                  }
                })
              }
            }

          },
          del(aid){
            var that=this;
            fetch("/ajax/goods/delAddr/"+aid).then(function (e) {
              return e.json();
            }).then(function (e) {
              if(!e.message){
                that.showWarn=true;
                that.warnMessage="删除出现错误";
              }else{
                that.showTip=true;
                that.tipMessage="删除成功";
                setTimeout(function () {
                  that.$router.go(-1)
                },600)
              }
            })
          }
        }
    }
</script>

<style scoped>
  .editAddress input{margin: 0;}
  .newAddr{clear:both;font-size:16px;width: 90%;background: #FF8053;height: 50px;outline: none;border: none;border-radius: 5px;color:#fff;margin: 0 5%;}
  .delAddr{padding:10px 15px;color:#FF8053;float: right;}
</style>
