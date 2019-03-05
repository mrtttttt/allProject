var express = require('express');
var mysql = require('./mysql');
var md5 = require('./md5');
var router = express.Router();

/* GET home page. */
router.get("/",function (req,res,next) {
    res.render("admin")
})
router.get("/select",function (req,res,next) {
    mysql.query("select * from admin",function (err,result) {
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
    var aname=req.body.aname;
    var apass=md5(req.body.apass);
    mysql.query("insert into admin (aname,apass) values('"+aname+"','"+apass+"')",function (err,result) {
        if(err){
            console.log(err)
            res.end()
        }else{
            res.send("ok")
        }
    })

});

router.post("/update",function (req,res,next) {
    var aname=req.body.aname;
    var apass=req.body.apass;
    var aid=req.body.aid;
    var sql="";
    if(apass){
        apass=md5(apass);
        sql="update admin set aname='"+aname+"',apass='"+apass+"' where aid="+aid;
    }else{
        sql="update admin set aname='"+aname+"' where aid="+aid;
    }
    mysql.query(sql,function (err,result) {
        if(err) throw err;
        res.send("ok");
    })
})

router.post("/checkLogin",function (req,res,next) {
    var aname=req.body.aname;
    var apass=md5(req.body.apass);
    mysql.query("select aid,aname from admin where aname='"+aname+"' and apass='"+apass+"'",function (err,result) {
        var obj={};
        if(err){
            obj.messages="err";
            res.send(JSON.stringify(obj))
        }
        if(result.length>0){
            res.send(JSON.stringify(result));
        }else{
            obj.messages="err";
            res.send(JSON.stringify(obj))
        }
    })
})


router.get("/del",function (req,res,next) {
    var aid=req.query.aid;
    mysql.query("delete from admin where aid="+aid,function (err,result) {
        if(err){
            res.end()
        }else{
            res.end("ok")
        }
    })
})



module.exports = router;
