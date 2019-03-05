class upload{
    /*
    * 1.添加file
    * 2.添加提交按钮
    * 3.预览
    * 4.上传
    *
    * */
    constructor(){
        this.size = 1024*1024*10;
        this.data=[];
        this.list=[];
        this.type=";image/png;image/jpg;application/x-png;image/jpeg;image/gif";
        //input type为file的样式
        this.name="file";
        this.selectFileStyle="width:150px;height:50px;border-radius:5px;background:orange;";
        this.selectFileCon="请选择上传文件";
        //预览框
        this.selectPStyle="width:500px;border-radius:5px;";
        //上传按钮
        this.selectBtnStyle="width:100px;height:50px;border-radius:5px;background:#ccc;";
        this.selectBtnCon="上传";
        //列表
        this.listStyle="width:150px;height:150px;float:left;border:1px solid #ccc;overflow:hidden;";
        //删除
        this.delStyle="width:20px;height:20px;position:absolute;border:1px solid #777;overflow:hidden;right:5px;top:5px;text-align:center;line-height:20px;cursor:pointer;color:red;display:none";
        //进度条
        this.progressStyle="width:100%;height:5px;position:absolute;bottom:0;left:0";
        this.barStyle="width:0;height:5px;background:green";
        //错误信息
        this.errorStyle="width:100%;height:100%;text-align:center;line-height:150px;background:rgba(0,0,0,0.8);display:none;color:#fff"
    }
    createView(params){
        //添加file控件
        if(typeof params !="object"){
            console.error("参数必须是一个对象");
            return ;
        }
        this.createSelect(params.parent,params.selectFile,()=>{
            //创建预览模块
            this.createPview();
            //创建点击上传按钮
            this.createBtn();

            this.change();
        });
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
            !function (obj) {
                obj.list.onmouseover = function () {
                    obj.del.style.display="block"
                }
                obj.list.onmouseout = function () {
                    obj.del.style.display="none"
                }
            }(obj)
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
    //上传
    up(url,callback){
        var that=this;
        this.selectBtn.onclick=function () {
            for(var i=0;i<that.data.length;i++){
                var form = new FormData();
                form.append(that.name,that.data[i]);
                var ajax = new XMLHttpRequest();
                var arr=[];
                (function (i,ajax) {
                    ajax.onload=function () {
                        arr.push(ajax.response)
                        callback(arr);
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
    }
    createList(data){
        //创建显示图片
        var list = document.createElement("div");
        list.style.cssText=this.listStyle;
        list.style.position="relative";
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
        del.innerHTML="X";
        del.style.cssText=this.delStyle;
        //添加进度条
        var progress = document.createElement("div");
        var bar = document.createElement("div");
        progress.style.cssText=this.progressStyle;
        bar.style.cssText=this.barStyle;
        //添加错误信息
        var error = document.createElement("div");
        error.style.cssText=this.errorStyle;

        progress.appendChild(bar);
        list.appendChild(del);
        list.appendChild(error);
        list.appendChild(progress);
        this.p.appendChild(list);
        return {
            list:list,
            del:del,
            error:error,
            bar:bar
        }
    }
    //创建预览框
    createPview(){
        /*if(selectP){
            this.selectP = selectP;
            return ;
        }*/
        var div = document.createElement("div");
        div.style.cssText=this.selectPStyle;
        div.style.overflow="hidden";
        this.parent.appendChild(div);
        this.p=div;
    }
    //创建点击上传按钮
    createBtn(){
        /*if(selectBtn){
            this.selectBtn = selectBtn;
            return ;
        }*/
        var btn = document.createElement("input");
        this.selectBtn = btn;
        btn.type="button";
        btn.name="btn";
        btn.style.cssText=this.selectBtnStyle;
        btn.style.cssText+="textAlign:center;border:none;cursor:pointer"
        btn.value=this.selectBtnCon;
        this.parent.appendChild(btn);
        btn.style.lineHeight=btn.offsetHeight+"px";
    }
    //创建上传文件input
    createSelect(parent,selectFile,callback){
        if(!parent){
            console.error("必须指定父元素");
            return ;
        }
        if(selectFile){
            this.selectFile = selectFile;
            callback();
            return ;
        }
        this.parent = parent;
        var file = document.createElement("input");
        this.selectFile = file;
        file.type="file";
        file.multiple="multiple";
        file.name=this.name;
        var div = document.createElement("div");
        div.style.cssText=this.selectFileStyle;
        div.style.textAlign="center";
        div.style.position="relative";
        div.innerHTML=this.selectFileCon;
        file.style.cssText="width:100%;height:100%;position:absolute;top:0;left:0;opacity:0";
        parent.appendChild(div);
        div.appendChild(file);
        // div.style.lineHeight=div.offsetHeight+"px";
        callback();
    }

}