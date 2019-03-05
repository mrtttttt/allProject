var express = require('express');
var path = require('path');
var favicon = require('serve-favicon');
var logger = require('morgan');
var ejs = require('ejs');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');

// 前台routes
var index = require('./routes/index');
var users = require('./routes/users');
var goods = require('./routes/goods');
var category = require('./routes/category');
/*
后台routes
    admin           后台管理员
    adminUsers      后台用户
    adminGoods      后台商品管理
*/
var admin = require('./routes/admin');
var adminUsers = require('./routes/adminUsers');
var adminGoods = require('./routes/adminGoods');

var app = express();
app.listen(8888,function () {
    console.log("8888端口已启动")
})
// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'html');
app.engine('html',ejs.renderFile);

// uncomment after placing your favicon in /public
//app.use(favicon(path.join(__dirname, 'public', 'favicon.ico')));
app.use(logger('dev'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

app.use('/', index);
app.use('/users', users);
app.use('/goods', goods);
app.use('/category', category);
app.use('/admin', admin);
app.use('/adminUsers', adminUsers);
app.use('/adminGoods', adminGoods);


// 下载android安装包
app.get("/download/apk",function (req,res) {
    var url=path.resolve(__dirname,"互惠.apk");
    res.download(url,"互惠.apk")
})
// 下载苹果安装包
app.get("/download/ipa",function (req,res) {
    var url=path.resolve(__dirname,"互惠.ipa");
    res.download(url,"互惠.ipa")
})

// catch 404 and forward to error handler
app.use(function(req, res, next) {
  var err = new Error('Not Found');
  err.status = 404;
  next(err);
});

// error handler
app.use(function(err, req, res, next) {
  // set locals, only providing error in development
  res.locals.message = err.message;
  res.locals.error = req.app.get('env') === 'development' ? err : {};

  // render the error page
  res.status(err.status || 500);
  res.send('error');
});

