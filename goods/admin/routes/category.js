var express = require('express');
var router = express.Router();
var mysql =require("./mysql")
router.get("/select",function (req,res,next) {
    mysql.query("select * from category",function (err,result) {
        if(err) throw err;
        res.send(JSON.stringify(result))
    })
})

router.post('/add', function(req, res, next) {
    var cname=req.body.cname;
    var sql="insert into category(cname) values ('"+cname+"')";
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
    var cname=req.body.cname;
    var cid=req.body.cid;
    var sql=`update category set cname='${cname}' where cid=${cid}`;
    mysql.query(sql,function (err,result) {
        if(err) throw err;
        res.send("ok");
    })
})

router.get("/del",function (req,res,next) {
    var cid=req.query.cid;
    mysql.query("delete from category where cid="+cid,function (err,result) {
        if(err){
            res.end()
        }else{
            res.end("ok")
        }
    })
})



module.exports = router;