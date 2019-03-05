var express = require('express');
var mysql = require('./mysql');
var md5 = require('./md5');
var multer = require('multer');
var xlsx = require('node-xlsx');
var router = express.Router();

var storage = multer.diskStorage({
    destination: function (req, file, cb) {
        cb(null, './public/upload')
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
    var uname=req.body.uname;
    var upass=md5(req.body.upass);
    var photo=req.body.photo;
    mysql.query("insert into user (uname,upass,photo) values('"+uname+"','"+upass+"','"+photo+"')",function (err,result) {
        if(err){
            console.log(err)
            res.end()
        }else{
            res.send("ok")
        }
    })

});

router.post("/update",function (req,res,next) {
    var uname=req.body.uname;
    var upass=req.body.upass;
    var photo=req.body.photo;
    var uid=req.body.uid;
    var sql="";
    if(upass){
        upass=md5(upass);
        sql="update user set uname='"+uname+"',upass='"+upass+"' where uid="+uid;
    }else{
        sql="update user set uname='"+uname+"' where uid="+uid;
    }
    mysql.query(sql,function (err,result) {
        if(err) throw err;
        res.send("ok");
    })
})

router.post("/upload",upload.single('files'), function (req,res,next) {
    var path="/upload/"+req.file.filename
    res.send(path)
})
router.post("/checkLogin",function (req,res,next) {
    var uname=req.body.user;
    var upass=md5(req.body.pass);
    mysql.query("select * from user where uname='"+uname+"' or email='"+uname+"'",function (err,result) {
        var obj={};
        if(err){
            obj.message="err";
            res.send(JSON.stringify(obj))
        }
        if(result.length>0){
            if(result[0].upass==upass){
                delete result[0].upass
                res.send(JSON.stringify(result));
            }else{
                obj.message="err";
                res.send(JSON.stringify(obj))
            }
        }else{
            obj.message="err";
            res.send(JSON.stringify(obj))
        }

    })
})
router.post("/reg",function (req,res,next) {
    var uname=req.body.uname;
    var upass=req.body.upass;
    var upass1=req.body.upass1;
    var email=req.body.email;
    if(upass!=upass1){
        res.end()
    }else{
        upass=md5(upass);
        mysql.query("insert into user(uname,upass,email) values ('"+uname+"','"+upass+"','"+email+"')",function (err,result) {
            if(err){
                res.end()
            }else{
                res.send(result.insertId.toString())
            }
        })
    }
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

module.exports = router;
