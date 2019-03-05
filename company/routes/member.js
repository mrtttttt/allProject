var express = require('express');
var mysql = require('./mysql');
var md5 = require('./md5');
var multer = require('multer');
var xlsx = require('node-xlsx');
var router = express.Router();

var storage = multer.diskStorage({
    destination: function (req, file, cb) {
        cb(null, './upload')
    },
    filename: function (req, file, cb) {
        var str="application/vnd.ms-excel,application/x-xls,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
        if(str.indexOf(file.mimetype)>-1){
            cb(null, new Date().getTime()+file.originalname)
        }else{
            return false
        }
    }
})

var upload = multer({ storage: storage })

/* GET users listing. */
router.get('/', function(req, res, next) {
    res.send('respond with a resource');
});
router.get("/select",function (req,res,next) {
    mysql.query("select * from member",function (err,result) {
        if(err) throw err;
        res.send(JSON.stringify(result));
    })
})
router.post("/add",function (req,res,next) {
    var name=req.body.name;
    var phone=req.body.phone;
    var number=req.body.number;
    var pass=md5("123456");
    mysql.query(`replace into member (number,name,phone,pass) values ('${number}','${name}','${phone}','${pass}')`,function (err,result) {
        if(err) throw err;
        res.send("ok");
    })
})
router.post("/update",function (req,res,next) {
    var name=req.body.name;
    var phone=req.body.phone;
    var number=req.body.number;
    var mid=req.body.mid;
    mysql.query(`update member set name='${name}',number='${number}',phone='${phone}' where mid=${mid}`,function (err,result) {
        if(err) throw err;
        res.send("ok");
    })
})
router.get("/del",function (req,res,next) {
    var mid=req.query.mid;
    mysql.query("delete from member where mid="+mid,function (err,result) {
        if(err){
            res.end()
        }else{
            res.end("ok")
        }
    })
})
router.post("/upload",upload.single('files'), function (req,res,next) {
    var xlsxPath=req.file.path;
    var info=xlsx.parse(xlsxPath)[0].data;
    for(var i=1;i<info.length;i++){
        info[i].push(md5("123456"));
    }
    info =info.slice(1);
    mysql.query(`replace into member (number,name,phone,pass) values ?`,[info],function (err,result) {
        if(err){
            console.log(err)
            res.end()
        }else{
            res.send("ok")
        }
    })
})
router.post("/checkLogin",function (req,res,next) {
    var number=req.body.number;
    var pass=md5(req.body.pass);
    mysql.query("select mid,name,phone,number,photo from member where number='"+number+"' and pass='"+pass+"'",function (err,result) {
        var obj={};
        if(err){
            obj.message="err";
            res.send(JSON.stringify(obj))
        }
        if(result.length>0){
            res.send(JSON.stringify(result));
        }else{
            obj.message="err";
            res.send(JSON.stringify(obj))
        }
    })
})

router.post("/editpass",function (req,res,next) {
    var pass1=md5(req.body.pass1);
    var pass2=md5(req.body.pass2);
    var pass3=md5(req.body.pass3);
    var mid=req.body.mid;
    if(pass2!=pass3){
        res.send()
    }else{
        mysql.query(`update member set pass='${pass2}' where mid=${mid} and pass='${pass1}'`,function (err,result) {
            if(err){
                res.send()
            }else{
                res.send("ok")
            }
        })
    }

})
module.exports = router;
