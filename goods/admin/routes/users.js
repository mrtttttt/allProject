var express = require('express');
var router = express.Router();
var mysql=require("./mysql");
var md5=require("./md5");

/* GET users listing. */
//注册
router.post('/register', function(req, res, next) {
  var phone=req.body.account;
  var pass=req.body.password;
  var pass2=req.body.password2;
  if(pass != pass2){
    res.send("err")
  }else{
      pass=md5(pass);
      mysql.query("insert into user(name,pass,phone) values ('"+phone+"','"+pass+"','"+phone+"')",function (err,result) {
          if(err) throw err;
          mysql.query("select * from user where uid="+result.insertId,function (err,result1) {
              if(err) throw err;
              res.send(JSON.stringify(result1));
          })
      })
  }
});
//验证登录信息
router.post('/login', function(req, res, next) {
  var phone=req.body.account;
  var pass=md5(req.body.password);
  mysql.query("select * from user where phone='"+phone+"' and pass='"+pass+"'",function (err,result) {
      if(err) throw err;
      if(result.length){
          res.send(JSON.stringify(result));
      }else{
          res.send({message:"err"})
      }
  })
});
//获取指定用户信息
router.get('/select/:uid', function(req, res, next) {
  var uid=req.params.uid;
  mysql.query("select * from user where uid="+uid,function (err,result) {
      if(err) throw err;
      if(result.length){
        res.send(JSON.stringify(result));
      }else{
        res.send(JSON.stringify({}))
      }
  })
});
//判断手机号是否已注册
router.get('/selected/:phone', function(req, res, next) {
  var phone=req.params.phone;
  mysql.query("select * from user where phone='"+phone+"'",function (err,result) {
      if(err) throw err;
      if(result.length){
          res.send("already");
      }else{
          res.send("none")
      }
  })
});
//查询已发布商品
router.get('/published', function(req, res, next) {
  var uid=req.query.uid;
  var state=req.query.state;
  mysql.query("select * from goods where uid="+uid+" and state="+state,function (err,result) {
      if(err) throw err;
      if(result){
          for(var i in result){
              if(result[i].gphoto){
                  var arr=result[i].gphoto.split(";");
                  result[i].gphoto=arr;
              }
          }
          res.send(JSON.stringify(result));
      }else{
          res.send({err:err})
      }
  })
});
//修改姓名/电话
router.get('/update', function(req, res, next) {
    var type=req.query.type;
    var a=req.query.a;
    var uid=req.query.uid;
    if(type=="name"){
        mysql.query("update user set name='"+a+"' where uid="+uid,function (err,result) {
            if(err) throw err;
            console.log(result)
            if(result.affectedRows){
                res.send("ok");
            }else{
                res.send("err")
            }
        })
    }else if(type=="phone"){
        mysql.query("update user set phone='"+a+"' where uid="+uid,function (err,result) {
            if(err) throw err;
            if(result.affectedRows){
                res.send("ok");
            }else{
                res.send("err")
            }
        })
    }

});
//修改密码
router.get('/updatePass', function(req, res, next) {
    var oldpass=req.query.oldpass;
    var pass=req.query.pass;
    var uid=req.query.uid;
    mysql.query("select * from user where uid="+uid,function (err,result) {
        if(err) throw err;
        console.log(result)
        if(result[0].pass== md5(oldpass)){
            mysql.query("update user set pass='"+md5(pass)+"' where uid="+uid,function (err,result) {
                if(err) throw err;
                if(result.affectedRows){
                    res.send("ok");
                }else{
                    res.send("err")
                }
            })
        }
    })

});
//查询账单信息
router.get("/priceInfo/:uid",function (req,res,next) {
    var uid=req.params.uid;
    mysql.query("select money.*,goods.*,address.* from money,goods,address where money.gid=goods.gid and money.aid=address.aid and (money.uid1="+uid+" or money.uid2="+uid+")",function (err,result) {
        if(err) throw  err;
        if(result){
            res.send(JSON.stringify(result))
        }
    })
})
//充值钱
router.get("/addMoney",function (req,res,next) {
    var money=req.query.money;
    var uid=req.query.uid;
    mysql.query("update user set money=money+"+money+" where uid="+uid,function (err,result) {
        if(err) throw  err;
        if(result.affectedRows){
            res.send("ok")
        }
    })
})
//修改头像
router.get("/updatePhoto",function (req,res,next) {
    var photo=req.query.photo;
    var uid=req.query.uid;
    mysql.query("update user set photo='"+photo+"' where uid="+uid,function (err,result) {
        if(err) throw  err;
        if(result.affectedRows){
            res.send("ok")
        }
    })
})

module.exports = router;
