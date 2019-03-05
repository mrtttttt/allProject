<template>
    <div>
      <div style="padding: 20px 15px;font-size:20px;line-height: 33px;">
        我的余额：<span style="color:#FF8053">{{money}}</span>
        <button style="float: right;">提现</button>
        <button @click="changeMoney" style="float: right;margin-right: 10px;">充值</button>
      </div>

      <div v-transfer-dom>
        <confirm v-model="show5"
                 show-input
                 :input-attrs="{type: 'number'}"
                 ref="confirm5"
                 :title="confirmTitle"
                 @on-confirm="onConfirm5"
                 @on-show="onShow5">
        </confirm>
      </div>
      <div v-for="item in list">
        <form-preview v-if="item[5]=='buy'"  header-label="支付金额" :header-value="'- ¥'+item[4]" :body-items="item" style="margin-bottom: 10px;"></form-preview>
        <form-preview v-else-if="item[5]=='sell'"  header-label="收入金额" :header-value="'+ ¥'+item[4]" :body-items="item" style="margin-bottom: 10px;"></form-preview>
      </div>

      <toast v-model="showTip" >{{tipMsg}}</toast>
    </div>
</template>

<script>
  import {FormPreview,Confirm,TransferDomDirective as TransferDom,Toast } from "vux"
    export default {
      directives: {
        TransferDom
      },
      name: "priceinfo",
      components:{FormPreview,Confirm,Toast},
      mounted(){
          var that=this;
        this.$emit("title",this.$route.query.title);
        //查询余额
        fetch("/ajax/users/select/"+that.uid).then(function (e) {
          return e.json()
        }).then(function (e) {
          that.money=e[0].money
        })
        //查询详细账单
        fetch("/ajax/users/priceInfo/"+that.uid).then(function (e) {
          return e.json();
        }).then(function (e) {
          for(var i in e){
            var arr=[{},{},{},{}]
            arr[0].label="商品";
            arr[1].label="收货人";
            arr[2].label="收货地址";
            arr[3].label="时间";
            arr[0].value=e[i].gtitle;
            arr[1].value=e[i].aname+"+"+e[i].aphone;
            arr[2].value=e[i].address;
            arr[3].value=e[i].mtime;
            arr[4]=e[i].price;
            if(e[i].uid1==that.uid){
              arr[5]="buy"
            }else if(e[i].uid2==that.uid){
              arr[5]="sell"
            }
            that.list.push(arr)
          }
        })
      },
      data(){
          return {
            list: [],
            money:"",
            show5:false,
            confirmTitle:"",
            confirmMsg:"",
            showTip:false,
            tipMsg:"",
            uid:localStorage.getItem("userFront")
          }
      },
      methods:{
        changeMoney(){
          //标题
          this.confirmTitle="充值金额"
          //默认值
          this.confirmMsg=100.00
          //展示
          this.show5=true;
        },
        onConfirm5(value){
          var that=this;
          fetch("/ajax/users/addMoney?money="+value+"&uid="+that.uid).then(function (e) {
            return e.text()
          }).then(function (e) {
            if(e=="ok"){
              that.showTip=true;
              that.tipMsg="充值成功";
              that.money=parseFloat(that.money)+parseFloat(value);
            }
          })
        },
        onShow5(){
          //展示input默认值
          this.$refs.confirm5.setInputValue(this.confirmMsg)
        }
      }
    }
</script>

<style scoped>

</style>
