var express = require('express');
var mysql = require('./mysql');
var md5 = require('./md5');
var multer = require('multer');
var xlsx = require('node-xlsx');
var router = express.Router();

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
            return false
        }
    }
})

var upload = multer({ storage: storage })

/* GET users listing. */
router.get("/select",function (req,res,next) {
    mysql.query("select * from user",function (err,result) {
        var obj={};
        if(err){
            obj.message="err"
            res.send(JSON.stringify(obj))
        }else{
            if(result.length>0){
                res.send(JSON.stringify(result))
            }else{
                obj.message="err";
                res.send(JSON.stringify(obj))
            }
        }
    })
})


router.post('/add', function(req, res, next) {
    var name=req.body.name;
    var pass=md5(req.body.pass);
    var photo=req.body.photo;
    var phone=req.body.phone;
    var money=req.body.money;
    var info=req.body.info;
    mysql.query("insert into user (name,pass,photo,phone,money,info) values('"+name+"','"+pass+"','"+photo+"',"+phone+","+money+",'"+info+"')",function (err,result) {
        if(err){
            console.log(err)
            res.end()
        }else{
            res.send("ok")
        }
    })

});

router.post("/update",function (req,res,next) {
    var name=req.body.name;
    var pass=req.body.pass;
    var photo=req.body.photo;
    var phone=req.body.phone;
    var money=req.body.money;
    var info=req.body.info;
    var uid=req.body.uid;
    var sql="";
    if(pass){
        upass=md5(upass);
        sql=`update user set name='${name}',pass='${pass}',photo='${photo}',phone=${phone},money=${money},info='${info}' where uid=${uid}`;
    }else{
        sql=`update user set name='${name}',photo='${photo}',phone='${phone}',money=${money},info='${info}' where uid=${uid}`;
    }
    mysql.query(sql,function (err,result) {
        if(err) throw err;
        res.send("ok");
    })
})

router.post("/upload",upload.single('files'), function (req,res,next) {
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

router.get("/del",function (req,res,next) {
    var uid=req.query.uid;
    mysql.query("delete from user where uid="+uid,function (err,result) {
        if(err){
            res.end()
        }else{
            res.end("ok")
        }
    })
})
// 查询地址
router.get("/address",function (req,res,next) {
    mysql.query("select address.*,user.* from address,user where address.uid=user.uid",function (err,result) {
        if(err) throw err;
        res.send(JSON.stringify(result))
    })
})
// 选择指定的地址
router.get("/selectAddress",function (req,res,next) {
    var uid=req.query.uid;
    mysql.query("select address.*,user.* from address,user where address.uid=user.uid and address.uid="+uid,function (err,result) {
        if(err) throw err;
        res.send(JSON.stringify(result))
    })
})

// 选择指定的用户
router.get("/selectUser",function (req,res,next) {
    var uid=req.query.uid;
    mysql.query("select * from user where uid="+uid,function (err,result) {
        if(err) throw err;
        res.send(JSON.stringify(result))
    })
})
module.exports = router;
