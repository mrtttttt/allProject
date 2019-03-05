var express = require('express');
var fs = require('fs');
var async = require('async');
var path = require('path');
var multer = require('multer');
var router = express.Router();
var mysql =require("./mysql")


//所有商品
router.get("/select",function (req,res,next) {
    var num=req.query.num;
    var counter=req.query.counter*num;
    mysql.query("select goods.*,user.*,category.* from goods,user,category where goods.uid=user.uid and goods.cid=category.cid LIMIT "+counter+","+num, function (err, result) {
        if (err) throw err;
        for(var i in result){
            if(result[i].gphoto){
                var arr=result[i].gphoto.split(";");
                result[i].gphoto=arr;
            }
            var date=new Date(result[i].gtime)
            result[i].gtime=date.toLocaleString();
            if(result[i].state==0){
                result[i].state="正常发布，未卖出"
            }else if(result[i].state==1){
                result[i].state="已卖出"
            }else if(result[i].state==2){
                result[i].state="强制下架"
            }
        }
        res.send(JSON.stringify(result))
    })
})
//更新商品状态
router.get("/updateState",function (req,res,next) {
    var gid=req.query.gid;
    var state=req.query.state;
    mysql.query("update goods set state="+state+" where gid="+gid,function (err,result) {
        if(err) throw err;
        if(result.affectedRows){
            res.send("ok")
        }
    })
})
//删除
router.get("/del/:gid",function (req,res,next) {
    var gid=req.params.gid;
    mysql.query("delete from goods where gid="+gid, function (err, result) {
        if (err) throw err;
        if(result.affectedRows){
            //缺少删除上传的图片的步骤
            res.send("ok")
        }else{
            res.send("err")
        }
    })
})
// 查询交易信息
router.get("/money",function(req,res,next){
    mysql.query("select money.*,goods.*,address.* from money,goods,address where money.gid=goods.gid and money.aid=address.aid",function(err,result){
        if(err)  throw err;
        async.eachSeries(result,function (item,next) {
            mysql.query("select name from user where uid="+item.uid1,function(err,result1){
                item.name1=result1[0].name;
                mysql.query("select name from user where uid="+item.uid2,function(err,result2){
                    item.name2=result2[0].name;
                    next();
                })
            })
        },function () {
            for(var i in result){
                result[i].mtime=new Date(result[i].mtime).toLocaleString();
                result[i].address=result[i].aname+"--"+result[i].aphone+"--"+result[i].address;
            }
            res.send(JSON.stringify(result))
        })
    }) 
})

// 查询指定人的账单
router.get("/money/:uid",function(req,res,next){
    var uid=req.params.uid;
    mysql.query("select money.*,goods.*,address.* from money,goods,address where money.gid=goods.gid and money.aid=address.aid and (money.uid1="+uid+" or money.uid2="+uid+")",function(err,result){
        if(err)  throw err;
        async.eachSeries(result,function (item,next) {
            mysql.query("select name from user where uid="+item.uid1,function(err,result1){
                item.name1=result1[0].name;
                mysql.query("select name from user where uid="+item.uid2,function(err,result2){
                    item.name2=result2[0].name;
                    next();
                })
            })
        },function () {
            for(var i in result){
                result[i].mtime=new Date(result[i].mtime).toLocaleString();
                result[i].address=result[i].aname+"--"+result[i].aphone+"--"+result[i].address;
            }
            res.send(JSON.stringify(result))
        })
    }) 
})

















/*


var storage = multer.diskStorage({
    destination: function (req, file, cb) {
        var date=new Date();
        var year=date.getFullYear();
        var month=date.getMonth();
        var day=date.getDate();
        if(month<10){
            month="0"+month
        }
        if(day<10){
            day="0"+day;
        }
        var time=""+year+month+day;
        var dir=path.join(__dirname,"../public/upload/"+time)
        fs.exists(dir,function (a) {
            if(!a){
                fs.mkdir(dir)
            }
            cb(null, './public/upload/'+time)
        })
    },
    filename: function (req, file, cb) {
        var str="image/jpeg,application/x-jpg,image/png,image/gif";
        if(str.indexOf(file.mimetype)>-1){
            cb(null, new Date().getTime()+file.originalname)
        }else{
            return false;
        }
    }
})

var upload = multer({ storage: storage })

//添加商品
router.post("/add",function (req,res,next) {
    var gtitle=req.body.gtitle;
    var ginfo=req.body.ginfo;
    var price=req.body.price;
    var category=req.body.category;
    var gphoto=req.body.gphoto;
    var uid=req.body.uid;
    var cid;
    mysql.query("select * from category where cname='"+category+"'",function (err,result) {
        if(err) throw err;
        cid=result[0].cid;
        mysql.query("insert into goods(gtitle,ginfo,price,cid,uid,gphoto,state) values('"+gtitle+"','"+ginfo+"',"+price+","+cid+","+uid+",'"+gphoto+"',0)",function (err,result) {
            if(err) throw err;
            res.send("ok")
        })
    })
})
//更新商品信息
router.post("/update",function (req,res,next) {
    var gtitle=req.body.gtitle;
    var ginfo=req.body.ginfo;
    var price=req.body.price;
    var category=req.body.category;
    var gphoto=req.body.gphoto;
    var gid=req.body.gid;
    var cid;
    mysql.query("select * from category where cname='"+category+"'",function (err,result) {
        if(err) throw err;
        cid=result[0].cid;
        mysql.query("update goods set gtitle='"+gtitle+"',ginfo='"+ginfo+"',price="+price+",cid="+cid+",gphoto='"+gphoto+"' where gid="+gid,function (err,result1) {
            if(err) throw err;
            if(result1.affectedRows){
                res.send("ok")
            }
        })
    })
})

//上传图片
router.post("/upload",upload.single("file"),function (req,res,next) {
    var date=new Date();
    var year=date.getFullYear();
    var month=date.getMonth();
    var day=date.getDate();
    if(month<10){
        month="0"+month
    }
    if(day<10){
        day="0"+day;
    }
    var time=""+year+month+day;
    var path="/upload/"+time+"/"+req.file.filename
    res.send(path)
})

//商品详情
router.get("/query",function (req,res,next) {
    var gid=req.query.gid;
    var uid=req.query.uid;
    mysql.query("select goods.*,user.*,category.* from goods,user,category where goods.uid=user.uid and goods.cid=category.cid and goods.gid="+gid, function (err, result) {
        if (err) throw err;
        result[0].collect=false;
        mysql.query("select * from collect where gid="+gid,function (err,result1) {
            if(err) throw  err;
            for(var i in result1){
                if(result1[i].uid==uid){
                    result[0].collect=result1[i].colid;
                }
            }
            res.send(JSON.stringify(result))
        })
    })
})
router.get("/query/:gid",function (req,res,next) {
    var gid=req.params.gid;
    mysql.query("select goods.*,user.*,category.* from goods,user,category where goods.uid=user.uid and goods.cid=category.cid and goods.gid="+gid, function (err, result) {
        if (err) throw err;
        res.send(JSON.stringify(result))
    })
})





//查询我的购买
router.get("/buyed/:uid",function (req,res,next) {
    var uid=req.params.uid;
    mysql.query("select money.*,goods.* from money,goods where money.gid=goods.gid and money.uid1="+uid,function (err,result) {
        if(err) throw  err;
        res.send(JSON.stringify(result));
    })
})
//查询购买我的
router.get("/selled/:uid",function (req,res,next) {
    var uid=req.params.uid;
    mysql.query("select money.*,goods.* from money,goods where money.gid=goods.gid and money.uid2="+uid,function (err,result) {
        if(err) throw  err;
        res.send(JSON.stringify(result));
    })
})
//查询默认地址
router.get("/queryAddr/:uid",function (req,res,next) {
    var uid=req.params.uid;
    mysql.query("select * from address where defau='0' and uid="+uid,function (err,result) {
        if(err) throw  err;
        res.send(JSON.stringify(result[0]));
    })
})
//查询所有地址
router.get("/selectAddr/:uid",function (req,res,next) {
    var uid=req.params.uid;
    mysql.query("select * from address where uid="+uid,function (err,result) {
        if(err) throw  err;
        res.send(JSON.stringify(result));
    })
})
//查询指定地址
router.get("/selectEditAddr/:aid",function (req,res,next) {
    var aid=req.params.aid;
    mysql.query("select * from address where aid="+aid,function (err,result) {
        if(err) throw  err;
        res.send(JSON.stringify(result));
    })
})
//添加收货地址
router.post("/addAddr",function (req,res,next) {
    var uid=req.body.uid;
    var aname=req.body.aname;
    var aphone=req.body.aphone;
    var address=req.body.address;
    var obj={},sql=""
    mysql.query("select * from address where uid="+uid,function(err,result){
        if(err) throw err;
        if(result.length){
            sql="insert into address(aname,aphone,address,defau,uid) values('"+aname+"','"+aphone+"','"+address+"','1',"+uid+")";
        }else {
            sql="insert into address(aname,aphone,address,defau,uid) values('"+aname+"','"+aphone+"','"+address+"','0',"+uid+")"
        }
        mysql.query(sql,function (err,result) {
        if(err) throw  err;
        if(result.affectedRows){
            obj.message=true;
        }else{
            obj.message=false;
        }
        res.send(JSON.stringify(obj));
    })
    })
    
})
//编辑收货地址
router.post("/editAddr",function (req,res,next) {
    var aid=req.body.aid;
    var aname=req.body.aname;
    var aphone=req.body.aphone;
    var address=req.body.address;
    var obj={}
    mysql.query("update address set aname='"+aname+"',aphone='"+aphone+"',address='"+address+"' where aid="+aid,function (err,result) {
        if(err) throw  err;
        if(result.affectedRows){
            obj.message=true;
        }else{
            obj.message=false;
        }
        res.send(JSON.stringify(obj));
    })
})
//删除指定地址
router.get("/delAddr/:aid",function (req,res,n) {
    var aid=req.params.aid;
    mysql.query("delete from address where aid="+aid,function (err,result) {
        if(err) throw  err;
        var obj={}
        if(result.affectedRows){
            obj.message=true
        }else{
            obj.message=false;
        }
        res.send(JSON.stringify(obj));
    })
})
//设置默认地址
router.get("/setDefault",function (req,res,next) {
    var aid=req.query.aid;
    var uid=req.query.uid; var obj={}
    mysql.query("update address set defau='1' where uid="+uid,function (err,result) {
        if(err) throw  err;

        if(result.affectedRows){
            mysql.query("update address set defau='0' where aid="+aid,function (err,result1) {
                if(err) throw err;
                if(result1.affectedRows){
                    obj.message=true;
                    res.send(JSON.stringify(obj));
                }
            })
        }else{
            obj.message=false;
            res.send(JSON.stringify(obj));
        }
    })
})
//查询我的收藏
router.get("/collected/:uid",function (req,res,next) {
    var uid=req.params.uid;
    mysql.query("select collect.*,goods.* from collect,goods where collect.gid=goods.gid and collect.uid="+uid,function (err,result){
        if(err) throw err;
        if(result){
            res.send(JSON.stringify(result))
        }else{
            res.send(JSON.stringify({}))
        }
    })
})
//添加收藏
router.get("/addCollect",function (req,res,next) {
    var uid=req.query.uid;
    var gid=req.query.gid;
    var obj={}
    mysql.query("insert into collect(uid,gid) values("+uid+","+gid+")",function (err,result) {
        if(err) throw err;
        if(result.affectedRows){
            obj.msg="ok";obj.colid=result.insertId;
        }else{
            obj.msg="err"
        }
        res.send(JSON.stringify(obj))
    })
})
//删除收藏
router.get("/delCollect",function (req,res,next) {
    var colid=req.query.colid;
    mysql.query("delete from collect where colid="+colid,function (err,result) {
        if(err) throw err;
        if(result.affectedRows){
            res.send("ok")
        }
    })
})
*/

module.exports = router;