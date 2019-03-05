<template>
    <div>
      <div class="goodsHead">
        <x-header :left-options="{backText: ''}" id="x-header">购买宝贝</x-header>
      </div>
      <div class="buyInfo">
        <img v-if="gData.gphoto" :src="imgArr[0]" alt="">
        <img v-else src="@/assets/imgs/defaultGoods.gif" alt="">
        <p>{{gData.gtitle}}</p>
        <p>￥{{gData.price}}</p>
      </div>
      <group  label-width="5em">
        <cell  primary="content"   title="收货地址" :link="{path:'/address',query:{title:'我的地址'}}" :value="address" > </cell>
        <cell title="运费" value="0.00"> </cell>
      </group>

      <div v-transfer-dom>
        <popup v-model="showBuy"  is-transparent>
          <div style="width: 100%;background-color:#fff;margin:0 auto;border-radius:0px;" class="buyTab">
            <p style="text-align: center;font-size: 20px;border-bottom: 1px solid #e5e5e5;line-height: 50px;">付款详情</p>
            <div class="buy-item"><span>账户</span><span>{{payAccount}}</span></div>
            <div class="buy-item"><span>付款方式</span><span class="iconfont">账户余额&nbsp;&nbsp;&#xe639;</span></div>
            <div class="needMoney">
              <p>需付款</p>
              <p>{{gData.price}}元</p>
            </div>
            <div style="padding:20px 15px;">
              <button @click="buy" class="newAddr">确认支付</button>
            </div>
          </div>
        </popup>
      </div>

      <div class="goodsFoot">
        <div class="box">
          实付款：<span>￥{{gData.price}}</span>
        </div>
        <button v-if="gData.state==0" class="buy"  @click="showBuyDiv" >确定</button>
        <button v-else-if="gData.state==1" class="buy" >已购买</button>
        <toast v-model="showTip" :text="tipMessage" type="text"> </toast>
      </div>
    </div>
</template>

<script>
  import { XHeader, Group,Cell, TransferDom, Popup,XSwitch,XButton,Toast } from 'vux'
  export default {
      directives: {
        TransferDom
      },
      props:["addrData"],
      name: "buy",
      components: {
        XHeader,
        Group,
        Cell,
        Popup,XSwitch,XButton,Toast
      },
      data:function () {
        return {
          showBuy:false,
          gid:"",
          gData:[],
          imgArr:[],
          showTip:false,
          tipMessage:"",
          address:"",
          aid:"",
          payAccount:"",
          uid:localStorage.getItem("userFront")
        }
      },
      mounted(){
        this.gid=this.$route.params.gid;

        var that=this;
        //查询个人账户（没有账户，用name代替）
        this.payAccount=localStorage.getItem("userName")
        //查询商品信息
        fetch("/ajax/goods/query?gid="+this.gid+"&uid="+this.uid).then(function (e) {
          return e.json()
        }).then(function (e) {
          that.gData=e[0];
          if(e[0].gphoto){
            that.imgArr=e[0].gphoto.split(";")
          }
        })
        if(this.addrData.address){
          this.address=this.addrData.aname+" "+this.addrData.aphone+" "+this.addrData.address;
          this.aid=this.addrData.aid;
        }else{
          //查询地址
          fetch("/ajax/goods/queryAddr/"+that.uid).then(function (e) {
            return e.json();
          }).then(function (e) {
            that.address=e.aname+" "+e.aphone+" "+e.address;
            that.aid=e.aid;
          })
        }
      },
      methods:{
        showBuyDiv(){
          if(this.aid){
            this.showBuy =true;
          }else{
            this.showTip=true;this.tipMessage="地址不能为空"
          }
        },
        buy(){
            var that=this;
            fetch("/ajax/goods/buy?gid="+this.gid+"&uid="+that.uid+"&price="+this.gData.price+"&aid="+this.aid).then(function (e) {
              return e.json()
            }).then(function (e) {
              that.showBuy=false;
              if(e.ok){
                setTimeout(function () {
                  that.$router.push({path:"/buyed",query:{title:"我购买的"}})
                },600)
              }
              that.showTip=true;that.tipMessage=e.msg
            })
          },
      }
    }
</script>

<style scoped>
  *:before{display: none;}
  *:after{display: none;}
  .goodsHead{position: fixed;top: 0;left:0;width: 100%;}
  .buyInfo{
    width: 100%;padding: 56px 15px 10px;overflow: hidden;
  }
  .buyInfo img{width:30%;float: left;height: 85px; }
  .buyInfo p{float: left;font-size: 16px; line-height: 35px;margin: 5px 0 0 10px;width: 60%;}
  .buyInfo p:last-of-type{color:red;font-size: 18px;font-weight: bold;}
  .goodsFoot{width: 100%;height: 50px;line-height: 50px;padding: 0 15px;position: fixed;bottom: 0;left: 0;background: #fff;border-top: 1px solid #e5e5e5;}
  .goodsFoot span{color:red;font-size: 16px;}
  .box{float: left;font-size: 14px;color: #333;}
  .buy{float: right;width: auto;height: 36px;font-size: 16px;padding: 0 15px;margin: 7px;}

  .buyTab div{margin: 0;}
  .needMoney{font-size: 16px;color:#000;padding: 10px 15px;overflow: hidden;}
  .needMoney p{font-size: 20px;}
  .needMoney p:first-child{float: left;}
  .needMoney p:last-child{float: right;}
  .buy-item{overflow: hidden;line-height: 30px;padding: 10px 15px;color: #666;}
  .buy-item span:first-of-type{float: left;}
  .buy-item span:last-of-type{float: right;}
  .newAddr{clear:both;font-size:16px;width: 90%;background: #FF8053;height: 50px;outline: none;border: none;border-radius: 5px;color:#fff;margin: 0 5%;}

</style>

