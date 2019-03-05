var express = require('express');
var request = require('request');
var async = require('async');
var path = require('path');
var multer = require('multer');
var mysql = require('./mysql');
var router = express.Router();

var storage = multer.diskStorage({
    destination: function (req, file, cb) {
        cb(null, './public/upload/')
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

/* GET home page. */
router.get('/', function(req, res, next) {
  res.render('index');
});
router.get('/admin', function(req, res, next) {
    res.render('admin');
});
router.get('/pachong', function(req, res, next) {
    require("./pachong")
});
router.get("/logNum",function (req,res,next) {
    var mid=req.query.mid;
    var arr=[]
    async.series([
            function(next) {
                mysql.query("select * from logs where mid1="+mid,function (err,result) {
                    if(err){
                        next()
                    }else{
                        arr.push(result.length)
                        next()
                    }
                })
            },
            function(next) {
                mysql.query("select * from logs where mid2="+mid,function (err,result) {
                    if(err){
                        next()
                    }else{
                        arr.push(result.length)
                        next()
                    }
                })
            }
        ],
        function(err, results) {
            res.send(JSON.stringify(arr))
        });
})
router.get("/new",function (req,res,next) {
    var page=req.query.page;
    var num=10;
    var start=page*num;
    mysql.query("select * from news limit "+start+", "+num,function (err,result) {
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
router.get("/memb",function (req,res,next) {
    mysql.query("select name,phone from member",function (err,result) {
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
router.get("/mem",function (req,res,next) {
    mysql.query("select name,mid from member",function (err,result) {
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
router.get("/send",function (req,res,next) {
    var mid1=req.query.mid1;
    mysql.query("select * from logs where mid1="+mid1,function (err,result) {
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
router.get("/accept",function (req,res,next) {
    var mid2=req.query.mid2;
    mysql.query("select * from logs where mid2="+mid2,function (err,result) {
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
router.post("/write",function (req,res,next) {
    var mid1=req.body.mid1;
    var mid2=req.body.mid2;
    var log=req.body.log;
    mysql.query(`insert into logs (mid1,mid2,log) values (${mid1},${mid2},'${log}')`,function (err,result) {
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
})

router.post("/upload",upload.single('files'), function (req,res,next) {
    var photo="/upload/"+req.file.filename;
    var mid=req.query.mid;
    mysql.query("update member set photo='"+photo+"' where mid="+mid,function (err,result) {
        if(err){
            res.end()
        }else{
            if(result.affectedRows>0){
                res.send(photo)
            }else{
                res.end()
            }
        }
    })
})

module.exports = router;
