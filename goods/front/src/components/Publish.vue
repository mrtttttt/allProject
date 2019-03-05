<template>
    <div class="publish">
      <div class="setHead">
        <span class="iconfont goBack" @click="goBack">&#xe641;</span>发布
      </div>
      <!--基本信息-->
      <group>
        <x-input placeholder="标题 品类品牌型号都是买家喜欢搜索的" v-model="goodsTitle"> </x-input>
        <x-textarea :max="200" placeholder="描述一下宝贝的细节或故事"  :height="150" :rows="8" :cols="30" v-model="goodsInfo"> </x-textarea>
        <!--img开始-->
        <div class="imgUpload" @click="chooseImg" :gid="gid">
          <div class="allImg" v-if="gid">
            <div class="imgBox" v-for="(item,index) in oldImgArr" :style="'background: url('+item+') no-repeat center/cover'" :index="index">
              <div class="delImg" @click="delImg(index,item)" :path="item">
                <div></div>
              </div>
              <div class="imgProgress">
                <div class="imgBar" style="width: 100%"></div>
              </div>
            </div>
            <div></div>
          </div>
        </div>
        <input type="hidden" v-model="gphoto" />
        <!--img结束-->
      <!--分类-->
        <x-input title="价格" placeholder="0.0" v-model="price" :min="0" type="number"> </x-input>
        <popup-picker :title="title" :data="list" v-model="value" placeholder="选择分类"> </popup-picker>
        <toast v-model="showTip" type="text" width="13em">{{tipMessage}}</toast>
      </group>
      <div class="publishBox">
        <button type="button" @click="submit" class="publishBtn">确定发布</button>
      </div>
    </div>
</template>

<script>

  import { XTextarea, Group, XInput ,XHeader, PopupPicker, Picker, TransferDom, Actionsheet, XSwitch, Toast ,XButton } from 'vux'
  import XNumber from "vux/src/components/x-number/index";
  import imgUpload from "@/assets/js/imgUpload.js"
  import removeArrValue from "@/assets/js/removeArrValue.js"

  export default {
    name:'publish',
    data:function () {
        return {
          goodsTitle:"",
          goodsInfo:"",
          price:"",
          gphoto:"",
          oldImgArr:[],
          imgArr:[],
          upPhotoArr:[],
          title: '选择分类',
          list: [[]],
          value:["衣服"],
          showTip:false,
          tipMessage:"",
          gid:""
        }
    },
    components: {
      XNumber,
      XTextarea,
      Group,
      XInput,
      XHeader,
      PopupPicker,
      Picker,
      Actionsheet,
      XSwitch,
      Toast,XButton
    },
    directives: {
      TransferDom
    },
    mounted:function () {
      this.gid=this.$route.params.gid;

      var that=this;
      //分类
      fetch("/ajax/category/select").then(function (e) {
        return e.json()
      }).then(function (e) {
        for(let i in e){
          that.list[0].push(e[i].cname);
        }
        that.value.splice(0,1,e[0].cname)
      })



      //编辑
      if(this.gid){
        fetch("/ajax/goods/query/"+this.gid).then(function (e) {
          return e.json();
        }).then(function (e) {
          that.goodsTitle=e[0].gtitle;
          that.goodsInfo=e[0].ginfo;
          that.gphoto=e[0].gphoto;
          that.price=e[0].price;
          that.value=e[0].cname.split();
          if(e[0].gphoto){
            that.oldImgArr=e[0].gphoto.split(";");
            that.imgArr=e[0].gphoto.split(";");
          }
          imgUpload.createView(document.querySelector(".imgUpload"),that.gid)
          document.querySelector(".addInput").addEventListener("change",function () {
            imgUpload.up("/ajax/goods/upload",function (e) {
              that.imgArr.push(e[0]);
            })
          })
        })
      }else{
        imgUpload.createView(document.querySelector(".imgUpload"))
        document.querySelector(".addInput").addEventListener("change",function () {
          imgUpload.up("/ajax/goods/upload",function (e) {
            that.imgArr.push(e[0]);
          })
        })
      }
    },
    beforeRouteLeave(to,from,next){
      to.meta.keepAlive = false; // 让 首页 不缓存，即刷新
      next();
    },
    methods: {
      submit(){
        var that=this;

        that.gphoto=that.imgArr.join(";");
        if(this.goodsTitle==""){
          this.showTip=true;
          this.tipMessage="标题不能为空"
          return ;
        }else if(this.price==""){
          this.showTip=true;
          this.tipMessage="价格不能为空"
          return ;
        }else{
          if(this.gid){
            fetch("/ajax/goods/update",{
              method: "POST",
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
              },
              body: "gtitle="+that.goodsTitle+"&ginfo="+that.goodsInfo+"&gid="+that.gid+"&gphoto="+that.gphoto+"&price="+that.price+"&category="+that.value[0]
            }).then(function (e) {
              return e.text();
            }).then(function (e) {
              if(e=="ok"){
                that.showTip=true;
                that.tipMessage="修改成功";
                setTimeout(function () {
                  that.$router.go(-2)
                },600)
              }
            })
          }else{
            fetch("/ajax/goods/add",{
              method: "POST",
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
              },
              body: "gtitle="+that.goodsTitle+"&ginfo="+that.goodsInfo+"&gphoto="+that.gphoto+"&price="+that.price+"&category="+that.value[0]+"&uid="+localStorage.getItem("userFront")
            }).then(function (e) {
              return e.text();
            }).then(function (e) {
              if(e=="ok"){
                that.showTip=true;
                that.tipMessage="发布成功，将返回首页";
                setTimeout(function () {
                  that.$router.push("/")
                },600)
              }
            })
          }

        }

      },
      delImg(index,item){
        var imgs=document.querySelectorAll(".imgBox");
        for(var i=0;i<imgs.length;i++){
          if(imgs[i].getAttribute("index")==index){
            document.querySelector(".allImg").removeChild(imgs[i])
            removeArrValue(this.imgArr,item);
            // this.imgArr=this.imgArr.concat(this.oldImgArr)
          }
        }
      },
      chooseImg(e){
        if(e.target.className=="delImg"||e.target.parentNode.className=="delImg"){
          var path=e.target.getAttribute("path")?e.target.getAttribute("path"):e.target.parentNode.getAttribute("path");
        }
        for(var i in this.imgArr){
          if(this.imgArr[i]==path){
            this.imgArr.splice(i,1);
          }
        }
      },
      goBack(){
        this.$router.go(-1)
      }

    }
  }
</script>
<style scoped>
  .goBack{position:absolute;top:0;left: 10px;font-size: 24px;}
  .publish{padding-top: 30px;padding-bottom: 60px;}
  .publishBox{
    width: 100%;height: 60px;position: fixed;bottom: 0;left: 0;background: #fff;
  }
 .publishBtn{width:90%;height: 40px;background: #ff8053;color: #fff;border-radius: 5px;font-size: 16px;
    position: absolute;bottom: 10px;left: 5%;
 }
  /*图片上传*/
.imgUpload{margin-bottom: 10px;}
.allImg{
  padding: 0 15px;width: 100%;overflow: hidden;
}
/*.allImg input{display:none;}*/

.imgBox{width: 30%;height: 90px;position: relative;float: left;margin: 0 0 6px; }
.imgBox:nth-child(3n+2){margin: 0 5% 6px;}

.addImg{background: #F4F5F9;float: left;}
.addImg:nth-child(3n){margin-left: 5%;}
.addInput{position: absolute;top: 0;left:0;display: block;width: 100%;height: 100%;opacity: 0;z-index: 5}
.addImg:before,.addImg:after{
  content: "";display: block;width: 40%;height: 2px;background: #ccc;position: absolute;top: 0;left: 0;bottom: 0;right: 0;margin: auto;
}
.addImg:before{transform: rotate(90deg)}
  .delImg{width: 30px;height: 30px;background: #fff;position: absolute;top: -5px;right: -5px;border-radius: 50%}
  .delImg:before,.delImg:after{content:'';display:block;width: 50%;height: 2px;background: #fff;position: absolute;top: 0;left: 0;right: 0;bottom: 0;margin: auto;z-index: 5}
  .delImg:before{transform: rotate(45deg)}
  .delImg:after{transform: rotate(-45deg)}

  .delImg div{width: 22px;height: 22px;background: #FF8053;border-radius: 50%;margin: auto;position: absolute;top: 0;left: 0;right:0;bottom: 0;}
  .imgProcess{width:100%;height:5px;position:absolute;bottom:0;left:0}
  .imgBar{width:50%;height:5px;background:#67e867}

input{
  line-height: 21px;
  height: 40px;
  margin-bottom: 15px;
  padding: 10px 15px;
  -webkit-user-select: text;
  border: 1px solid rgba(0, 0, 0, .2);
  border-radius: 3px;
  outline: none;
  background-color: #fff;
  -webkit-appearance: none;
}

</style>
