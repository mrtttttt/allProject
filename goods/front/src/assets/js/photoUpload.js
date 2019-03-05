class photoUpload{
  constructor(){
    this.size = 1024*1024*10;
    this.data=[];
    this.list=[];
    this.name="file";
    this.type=";image/png;image/jpg;image/jpeg;image/gif";
  }

  /**
   *
   * @param params  父元素，显示的容器
   * @param type    有type，说明是编辑，有图片，
   */
  uploadInit(params,inputFile){
    if(!parent){
      console.error("必须指定父元素");
      return ;
    }
    this.parent=params;
    this.inputFile=inputFile;
    var that=this;
    this.inputFile.click()
    this.inputFile.onchange=function () {
      that.data=this.files[0];
      //判断数据类型
      console.log(that.data)

      if(that.type.indexOf(that.data.type)<0){
        return "未知类型"
      }
      //判断大小
      if(that.data.size>that.size){
        return "文件过大"
      }
      //显示图片
      var obj =new FileReader();
      obj.onload = function (e) {
        that.parent.style.backgroundImage="url("+e.target.result+")";
      }
      obj.readAsDataURL(that.data);
    }
  }
  up(url,callback){
    var that=this;
    var form = new FormData();
    form.append(that.name,that.data);
    var ajax = new XMLHttpRequest();
    ajax.onload=function () {
      callback(ajax.response);
    }
    ajax.open("post",url);
    ajax.send(form);
  }
}

export default new photoUpload();
