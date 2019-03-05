var express = require('express');
var mysql = require('./mysql');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
    var cid=req.query.cid;
    var uid=req.query.uid;
    mysql.query("select * from love where cid="+cid+" and uid="+uid,function (err,result) {
        if(err){
            res.end();
        }else{
            if(result.length>0){
                res.send("done")
            }else{
                mysql.query("insert into love(cid,uid) values("+cid+","+uid+")",function (err,result) {
                    if(err){
                        res.end()
                    }else{
                        if(result.affectedRows>0){
                            res.send("ok")
                        }else{
                            res.end()
                        }
                    }
                })
            }
        }
    })
});

module.exports = router;
