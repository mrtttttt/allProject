var express = require('express');
var async = require('async');
var mysql = require('./mysql');
var router = express.Router();

/* GET home page. */
router.get("/",function (req,res,next) {
    mysql.query("select * from con",function (err,result) {
        var obj={};
        if(err){
            obj.message="err"
            res.send(JSON.stringify(obj))
        }else{
            if(result.length>0){
                async .eachSeries(result,function (item,next) {
                    mysql.query("select * from love where cid="+item.cid,function (err,result1) {
                        item.loveNum=result1.length
                        next()
                    })

                },function () {
                    res.send(JSON.stringify(result))
                })


            }else{
                obj.message="err";
                res.send(JSON.stringify(obj))
            }
        }
    })
})
router.get("/detail",function (req,res,next) {
    var cid=req.query.cid;
    mysql.query("select * from con where cid="+cid,function (err,result) {
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
router.get("/select",function (req,res,next) {
    var page=req.query.page;
    var num=10;
    var start=page*num;
    mysql.query("select con.*,position.pname from con,position where con.pid=position.pid limit "+start+","+num,function (err,result) {
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
router.get("/tuijian",function (req,res,next) {
    mysql.query("select * from con where pid=3",function (err,result) {
        var obj={};
        if(err){
            obj.message="err"
            res.send(JSON.stringify(obj))
        }else{
            if(result.length>0){
                async .eachSeries(result,function (item,next) {
                    mysql.query("select * from love where cid="+item.cid,function (err,result1) {
                        item.loveNum=result1.length
                        next()
                    })
                },function () {
                    res.send(JSON.stringify(result))
                })
            }else{
                obj.message="err";
                res.send(JSON.stringify(obj))
            }
        }
    })
})
router.get("/lunbo",function (req,res,next) {
    mysql.query("select * from con where pid=2",function (err,result) {
        var obj={};
        if(err){
            obj.message="err"
            res.send(JSON.stringify(obj))
        }else{
            if(result.length>0){
                async.eachSeries(result,function (item,next) {
                    mysql.query("select * from love where cid="+item.cid,function (err,result1) {
                        item.loveNum=result1.length
                        next()
                    })
                },function () {
                    res.send(JSON.stringify(result))
                })
            }else{
                obj.message="err";
                res.send(JSON.stringify(obj))
            }
        }
    })
})
router.post('/add', function(req, res, next) {
    var title=req.body.title;
    var con=req.body.con;
    var money=req.body.money;
    var pid=req.body.pid;
    var start=req.body.start;
    var end=req.body.end;
    var startTime=req.body.startTime;
    var endTime=req.body.endTime;
    mysql.query("insert into con (title,content,money,pid,start,end,startTime,endTime) values('"+title+"','"+con+"','"+money+"','"+pid+"','"+start+"','"+end+"','"+startTime+"','"+endTime+"')",function (err,result) {
        if(err){
            console.log(err)
            res.end()
        }else{
            if(result.affectedRows>0){
                res.send("ok")
            }else{
                res.end()
            }
        }
    })

});

router.post("/update",function (req,res,next) {
    var title=req.body.title;
    var content=req.body.con;
    var money=req.body.money;
    var pid=req.body.pid;
    var cid=req.body.cid;
    var start=req.body.start;
    var end=req.body.end;
    var startTime=req.body.startTime;
    var endTime=req.body.endTime;
    var sql="update con set title='"+title+"',content='"+content+"',money="+money+",pid="+pid+",start='"+start+"',end='"+end+"',startTime='"+startTime+"',endTime='"+endTime+"' where cid="+cid;
    mysql.query(sql,function (err,result) {
        if(err) throw err;
        res.send("ok");
    })
})
router.get("/del",function (req,res,next) {
    var cid=req.query.cid;
    mysql.query("delete from con where cid="+cid,function (err,result) {
        if(err){
            res.end()
        }else{
            res.end("ok")
        }
    })
})

module.exports = router;
