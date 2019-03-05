var express = require('express');
var request = require('request');
var mysql=require("./mysql")
var router = express.Router();

/* GET home page. */
router.get('/select', function(req, res, next) {
    var page=req.query.page;

    var num=10;
    var start=page*num;
    mysql.query("select * from news limit "+start+","+num,function (err,result) {

        if(err){
            var obj={};
            obj.message="err"
            res.send(JSON.stringify(obj))
        }else{
            if(result.length>0){
                res.send(JSON.stringify(result))
            }else{
                var obj={};
                obj.message="err"
                res.send(JSON.stringify(obj))
            }
        }
    })
});


module.exports = router;
