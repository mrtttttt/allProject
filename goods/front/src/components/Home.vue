<template>
  <div class="home">
    <div class="main">
      <search
        @result-click="resultClick"
        @on-change="getResult"
        :results="results"
        v-model="value"
        @on-submit="onSubmit"
        ref="search"> </search>
    </div>
    <div class="goodsBox">
      <scroller class="goods"
                :lock-x=true
                :use-pulldown=true
                @on-pulldown-loading="onPulldown"
                @on-scroll-bottom="onScrollBottom"
                ref="scrollerBottom"
                :scroll-bottom-offset="0"
                :pulldown-config="{loadingContent: '加载中...',upContent:'释放后加载', downContent:'下拉加载'}"
      >
        <ul class="gUl">
          <div class="noDataTip">暂时没有最新数据</div>
          <li class="gLi" v-for="(item,index) in goodsData" >
            <div class="uInfo" >
              <img :src="item.photo" alt="" />
              <p>{{item.name}}</p>
              <span><em>￥&nbsp;</em>{{item.price}}</span>
            </div>
            <div @click="gotoInfo(item.gid)">
              <scroller :lock-y="true" :scrollbar-x=false class="imgBox" ref="scroller">
                <div class="box1" ref="imgView">
                  <img class="box1-item" v-for="iitem in item.gphoto" :src="iitem" alt="" />
                </div>
                <div class="imgMask" @touchstart="touchStart" :index="index" ></div>
              </scroller>
            </div>
            <div class="gInfo" @click="gotoInfo(item.gid)">
              <h4>{{item.gtitle}}</h4>
              <p>{{item.ginfo}}...</p>
            </div>
            <div class="gAddr">
              <p>{{item.gtime}}</p>
            </div>
          </li>
          <load-more v-if="haveData" tip="加载中..." class="loadMore"> </load-more>
          <load-more v-else  :show-loading="false" tip="暂无数据" background-color="#fbf9fe"></load-more>
        </ul>
      </scroller>
    </div>
  </div>
</template>

<script>
  import { Scroller,Search,LoadMore } from 'vux'
    export default {
      name: "home",
      components: {
        Scroller,Search,LoadMore
      },
      /***
       * goods
       *   gid   name  time  title  info   img  price  category
       * @returns {{goodsData: *[]}}
       */
      data() {
        return {
          results: [],
          value: '',
          counter: 0, //当前页
          num: 10, // 一页显示多少条
          goodsData: [], // 下拉更新数据存放数组
          //scroll
          onFetching: false,
          bottomCount: 20,
          haveData:true

        }
      },
      mounted:function () {
        var that=this;
        fetch("/ajax/goods/select?counter="+this.counter+"&num="+that.num).then(function (e) {
          return e.json()
        }).then(function (e) {
          if(e.length){
            that.goodsData=e;
            that.$refs.scrollerBottom.reset()
          }else {
            that.haveData=false;
            that.$refs.scrollerBottom.reset()
          }
        })
      },
      methods: {
        onPulldown(){
          this.haveData=true
          if(this.onFetching){

          }else{
            this.onFetching = true
            this.counter++;
            fetch("/ajax/goods/select?num="+this.num+"&counter="+this.counter).then((e)=>{
              return e.json();
            }).then((e)=>{
              if(e.length){
                this.goodsData=e.concat(this.goodsData)
                this.$nextTick(() => {
                  this.$refs.scrollerBottom.donePulldown()
                })
              }else {
                this.counter--;
                this.haveData=false;
                this.$nextTick(() => {
                  this.$refs.scrollerBottom.donePulldown()
                })
                document.querySelector(".noDataTip").style.display="block"
                setTimeout(()=>{
                  document.querySelector(".noDataTip").style.display="none"
                },2000)
              }
              this.onFetching = false;
            })
          }
        },
        onScrollBottom () {
          this.haveData=true;
          if (this.onFetching) {
            // do nothing
          } else {
            this.onFetching = true
            this.counter++;
            fetch("/ajax/goods/select?num="+this.num+"&counter="+this.counter).then((e)=>{
              return e.json();
            }).then((e)=>{
              if(e.length){
                this.goodsData=this.goodsData.concat(e)
                this.$nextTick(() => {
                  this.$refs.scrollerBottom.reset()
                })
              }else {
                this.counter--;
                this.haveData=false;
                this.$refs.scrollerBottom.reset()
                // this.$refs.scrollerBottom.donePullup()
              }
              this.onFetching = false
            })
          }
        },
        touchStart: function (ev) {
          this.startX = ev.touches[0].clientX;
          //动态设置imgView的宽度
          var imgs = ev.target.parentNode.getElementsByTagName("img");
          var width = 0;
          for (var i = 0; i < imgs.length; i++) {
            width += imgs[i].width;
            width += 15;
          }
          let imgView = ev.target.previousElementSibling;
          imgView.style.width = width + 'px';
          let a=ev.target.parentNode.parentNode.parentNode;
          let index=ev.target.getAttribute("index")
          this.$refs.scroller[index].reset();
        },
        //去往详情页
        gotoInfo:function (gid) {
          this.$router.push("/goodsInfo/"+gid)
        },
        //搜索
        resultClick (item) {
          window.alert('you click the result item: ' + JSON.stringify(item))
        },
        getResult (val) {
          console.log('on-change', val)
          this.results = val ? getResult(this.value) : []
        },
        onSubmit () {
          this.$refs.search.setBlur()
          this.$vux.toast.show({
            type: 'text',
            position: 'top',
            text: 'on submit'
          })
        },
      //  搜索结束
      }
    }
  //  搜索条
  function getResult (val) {
    let rs = []
    for (let i = 0; i < 20; i++) {
      rs.push({
        title: `${val} result: ${i + 1} `,
        other: i
      })
    }
    return rs
  }
</script>

<style scoped>
  *{margin: 0;padding: 0;text-decoration: none;}
  .main{
    width: 100%;position: fixed;top: 0;left: 0;z-index: 99;
  }
  .goods{padding-top: 94px;height: calc(100vh - 60px);margin-top: -50px;}
  .gUl{
    padding:0 0 10px;width: 100%;overflow: hidden;margin: 0;
  }
  .gLi{
    padding: 10px 5%;box-sizing: border-box;list-style: none;
    width: 100%;float: left;background: #fff;
    border-bottom: 13px solid #f8f8f8;
  }
  .gLi:last-of-type{border-bottom: none;margin-bottom: 20px;}
  .loadMore{width: 100%;margin: -10px auto 0;padding-top: 1.5em;}
  .uInfo{
    width: 100%;overflow: hidden;margin-bottom: 5px;
  }
  .uInfo img{
    width: 35px;height: 35px;float: left;border-radius: 3px;
  }
  .uInfo p{float: left;margin-left: 10px;line-height: 35px;color: #333;font-size: 16px;}
  .uInfo span{float: right;color: #F74949;font-size: 18px;line-height: 35px;}
  .uInfo span em{font-size: 14px;}
  .imgBox{height: 100px;overflow: hidden;position: relative;width: 100%;display: block;}
  .imgMask{width: 100%;height: 100%;position: absolute;top: 0;left:0;z-index: 5;opacity: 0;}
  .gInfo h4{line-height: 30px;font-size: 16px;margin: 0;}
  .gInfo p{line-height: 20px;font-size: 14px;margin: 0;color:#333;}
  .gAddr p{color: #35ADFF;margin-bottom: 0;font-size: 12px;}
  .box1 {
    height: 100px;
    position: relative;
  }
  .box1-item {
    height: 100px;
    background-color: #ccc;
    display:inline-block;
    margin-left: 15px;
    float: left;
    text-align: center;
    line-height: 100px;
  }
  .box1-item:first-child {
    margin-left: 0;
  }
  .box2-wrap {
    height: 300px;
    overflow: hidden;
  }
  .noDataTip{
    text-align: center;color:#999;line-height: 40px;display: none;border-bottom: 1px solid #efefef;font-size: 14px;
  }
</style>
