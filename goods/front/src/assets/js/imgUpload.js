class imgUpload{
  constructor(){
    this.size = 1024*1024*10;
    this.data=[];
    this.list=[];
    this.name="file";
    this.type=";image/png;image/jpg;image/jpeg;image/gif";
    this.errorStyle="width:100%;height:100%;text-align:center;line-height:150px;background:rgba(0,0,0,0.8);display:none;color:#fff";
  }

  /**
   *
   * @param params  父元素，显示的容器
   * @param type    有type，说明是编辑，有图片，
   */
  createView(params,type){
    var css=".allImg{\n" +
      "  padding: 0 15px;width: 100%;overflow: hidden;\n" +
      "}\n" +
      "\n" +
      ".imgBox{width: 30%;height: 90px;position: relative;float: left;margin: 0 0 6px;}\n" +
      ".imgBox:nth-child(3n+2){margin: 0 5% 6px;}\n" +
      "\n" +
      ".addImg{background: #F4F5F9;width: 90px;height: 90px;position: relative;float:left;}\n" +
      ".addImg:nth-child(3n){margin-left: 5%;}\n" +
      ".addInput{position: absolute;top: 0;left:0;display: block;width: 100%;height: 100%;opacity: 0;z-index: 5}\n" +
      ".addImg:before,.addImg:after{\n" +
      "  content: \"\";display: block;width: 40%;height: 2px;background: #ccc;position: absolute;top: 0;left: 0;bottom: 0;right: 0;margin: auto;\n" +
      "}\n" +
      ".addImg:before{transform: rotate(90deg)}\n" +
      "\n" +
      "  .delImg{transition:.5s;cursor:pointer; width: 30px;height: 30px;background: #fff;position: absolute;top: -5px;right: -5px;border-radius: 50%}\n" +
      "  .delImg:before,.delImg:after{content:'';display:block;width: 50%;height: 2px;background: #fff;position: absolute;top: 0;left: 0;right: 0;bottom: 0;margin: auto;z-index: 5}\n" +
      "  .delImg:before{transform: rotate(45deg)}\n" +
      "  .delImg:after{transform: rotate(-45deg)}\n" +
      "\n" +
      "  .delImg div{width: 22px;height: 22px;background: #FF8053;border-radius: 50%;margin: auto;position: absolute;top: 0;left: 0;right:0;bottom: 0;}\n" +
      "  .imgProgress{width:100%;height:5px;position:absolute;bottom:0;left:0}\n" +
      "  .imgBar{width:0;height:5px;background:#67e867}";
    this.loadStyleString(css);
    if(!parent){
      console.error("必须指定父元素");
      return ;
    }
    this.parent=params;
    this.createPview(type);
    //创建点击上传按钮
    this.change();
  }
  createPview(type){
    if(type){
      this.allImg=this.parent.childNodes[0]
    }else{
      var div = document.createElement("div");
      div.classList.add("allImg")
      this.parent.appendChild(div);
      this.allImg=div;
      var bzdiv=document.createElement("div");
      this.allImg.appendChild(bzdiv)
    }

    var addImg=document.createElement("div");

    addImg.classList.add("addImg");
    addImg.innerHTML="<input type='file' class='addInput' name='files'>"
    this.selectFile = addImg.getElementsByClassName("addInput")[0];
    this.allImg.appendChild(addImg)
  }
  change(){
    var that=this;
    this.selectFile.onchange=function () {
      /*把具有length属性的对象转化为数组*/
      that.data = Array.prototype.slice.call(this.files);
      that.check();
    }
  }
  check(){
    var that =this;
    var temp=[];
    for(var i=0;i<this.data.length;i++){
      temp[i]=this.data[i];
      var obj=this.createList(this.data[i]);
      obj.del.index=i;
      that.list[i]=obj;
      //删除
      obj.del.onclick= function () {
        this.parentNode.parentNode.removeChild(this.parentNode);
        var tempval = temp[this.index];
        for(var j=0;j<that.data.length;j++){
          if(tempval==that.data[j]){
            that.data.splice(j,1);
            that.list.splice(j,1);
          }
        }
      }
      //判断数据类型
      if(this.type.indexOf(that.data[i].type)<0){
        var tempval = temp[i];
        for(var j=0;j<that.data.length;j++){
          if(tempval==that.data[j]){
            that.data.splice(j,1);
            that.list.splice(j,1);
          }
        }
        obj.error.style.display="block";
        obj.error.innerHTML="未知类型";
      }
      //判断大小
      if(this.data[i]){
        if(this.data[i].size>this.size){
          var tempval = temp[i];
          for(var j=0;j<that.data.length;j++){
            if(tempval==that.data[j]){
              that.data.splice(j,1);
              that.list.splice(j,1);
            }
          }
          obj.error.style.display="block";
          obj.error.innerHTML="文件过大";
        }
      }
    }
  }
  createList(data){
    //创建显示图片
    var list = document.createElement("div");
    list.classList.add("imgBox")
    if(this.type.indexOf(data.type)>-1 && data.size<this.size){
      var obj =new FileReader();
      obj.onload = function (e) {
        list.style.background="url("+e.target.result+")";
        list.style.backgroundSize="cover";
      }
      obj.readAsDataURL(data);
    }else{
      var notice = document.createElement("div");
      notice.style.cssText=this.errorStyle;
      notice.innerHTML="错误";
      list.appendChild(notice);
    }


    //添加删除
    var del = document.createElement("div");
    del.classList.add("delImg")
    del.innerHTML="<div></div>"
    //添加进度条
    var progress = document.createElement("div");
    var bar = document.createElement("div");
    progress.classList.add("imgProgress")
    bar.classList.add("imgBar");
    //添加错误信息
    var error = document.createElement("div");
    error.style.cssText=this.errorStyle;

    progress.appendChild(bar);
    list.appendChild(del);
    list.appendChild(error);
    list.appendChild(progress);
    this.allImg.insertBefore(list,this.allImg.childNodes[0])
    return {
      list:list,
      del:del,
      error:error,
      bar:bar
    }
  }
  up(url,callback){
    var that=this;
      for(var i=0;i<that.data.length;i++){
        var form = new FormData();
        form.append(that.name,that.data[i]);
        var ajax = new XMLHttpRequest();
        var arr=[];
        (function (i,ajax) {
          ajax.onload=function () {
            arr.push(ajax.response);
            callback(arr);
            that.list[i].del.setAttribute("path",ajax.response)
          }
          ajax.upload.onprogress=function (e) {
            var bl=e.loaded/e.total*100+"%";
            that.list[i].bar.style.width=bl;
          }
        })(i,ajax)
        ajax.open("post",url);
        ajax.send(form);
      }
  }
  //添加样式
  loadStyleString(css){
    var style = document.createElement("style");
    style.type = "text/css";
    try{
      style.appendChild(document.createTextNode(css));
    }catch(ex){
      style.styleSheet.cssText = css;
    }
    var head = document.getElementsByTagName('head')[0];
    head.appendChild(style);
  }
}

export default new imgUpload();
