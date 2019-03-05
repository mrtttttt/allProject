var express = require('express');
var mysql = require('./mysql');
var router = express.Router();
var md5=require("./md5")

/* GET users listing. */
router.get('/', function(req, res, next) {
  res.send('respond with a resource');
});
router.post("/checkLogin",function (req,res,next) {
    var uname=req.body.uname;
    var upass=md5(req.body.upass);
    mysql.query("select uid,uname from user where uname='"+uname+"' and upass='"+upass+"'",function (err,result) {
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

module.exports = router;
