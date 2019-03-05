var express = require('express');
var mysql = require('./mysql');
var router = express.Router();

/* GET home page. */
router.get("/select",function (req,res,next) {
    mysql.query("select * from position",function (err,result) {
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
router.get("/choose",function (req,res,next) {
    mysql.query("select * from position",function (err, result) {
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
    var pname=req.body.pname;
    var sql="insert into position values (null,'"+pname+"')";
    mysql.query(sql,function (err,result) {
        if(err){
            console.log(err)
            res.end()
        }else{
            res.send("ok")
        }
    })

});

router.post("/update",function (req,res,next) {
    var pname=req.body.pname;
    var pid=req.body.pid;
    var sql="update position set pname='"+pname+"' where pid="+pid;
    mysql.query(sql,function (err,result) {
        if(err) throw err;
        res.send("ok");
    })
})

router.get("/del",function (req,res,next) {
    var pid=req.query.pid;
    mysql.query("delete from position where pid="+pid,function (err,result) {
        if(err){
            res.end()
        }else{
            res.end("ok")
        }
    })
})



module.exports = router;
