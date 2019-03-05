<template>
    <div class="myaddress">
      <ul>
        <li @click="choose(item)" v-for="(item,index) in data">
          <div>
            <p>收货人：{{item.aname}}</p>
            <p>{{item.aphone}}</p>
          </div>
          <div style="color:#999;font-size: 14px;margin-bottom: 10px;">
            收货地址：{{item.address}}
          </div>
          <p v-if="item.defau=='0'" style="float: right;color:#FF8053;width: 100px;text-align: center;margin: 0;line-height: 30px;" >默认地址</p>
          <button v-else style="float: right;" @click="setDefault(item.aid)">设为默认地址</button>
          <button style="float: right;margin-right: 10px;" @click="editAddr(item.aid)">编辑</button>
        </li>
      </ul>
      <button @click="$router.push({path:'/editAddress',query:{title:'管理收货地址'}})" class="newAddr">新增收货地址</button>
      <toast v-model="show" :text="tipMsg" type="text"></toast>
    </div>
</template>

<script>
  import {Toast} from "vux"
    export default {
        name: "my-address",
      components:{Toast},
      data:function () {
        return{
          data:[],
          show:false,
          tipMsg:"",
          uid:localStorage.getItem("userFront")
        }
      },
      mounted(){
          var that=this;
        this.$emit('title',this.$route.query.title);
        fetch("/ajax/goods/selectAddr/"+this.uid).then(function (e) {
          return e.json()
        }).then(function (e) {
          that.data=e;
        })
      },
      methods:{
        choose(item){
          this.$emit('chooseaddr',item);
          // return ;
          this.$router.go(-1)
        },
        editAddr(aid){
          this.stop();
          this.$router.push({path:'/editAddress',query:{title:'管理收货地址',aid:aid}})
        },
        setDefault(aid){
          this.stop();
          var that=this;
          fetch("/ajax/goods/setDefault?aid="+aid+"&uid="+that.uid).then(function (e) {
            return e.json();
          }).then(function (e) {
            if(e.message){
              that.show=true;
              that.tipMsg="设置成功"
              for(var i in that.data){
                that.data[i].defau="1"
                if(that.data[i].aid==aid){
                  that.data[i].defau="0"
                }
              }
            }else{
              that.show=true;
              that.tipMsg="设置失败"
            }
          })
        },
        stop(e){
          var evt = e ? e : window.event;
          if (evt.stopPropagation) {        //W3C
            evt.stopPropagation();
          }else {       //IE
            evt.stop = true;
          }
        }
      }
    }
</script>

<style scoped>
  .myaddress{width: 100%;padding-bottom: 50px;}
  ul{padding: 10px 15px;}
  li{border-bottom: 1px solid #d5d5d5;padding: 10px 0;overflow: hidden}
  li div:first-of-type{overflow: hidden;font-size: 16px;}
  li p{font-size: 16px;color:#000;}
  li p:first-of-type{float: left;}
  li p:last-of-type{float: right;}
  .newAddr{font-size:16px;position: fixed;width: 90%;left: 5%;bottom: 10px;background: #FF8053;height: 50px;outline: none;border: none;border-radius: 5px;color:#fff;}
</style>
