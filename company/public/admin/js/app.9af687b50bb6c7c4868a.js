webpackJsonp([1],{"+hpA":function(e,t){},"5+O1":function(e,t){},CKyX:function(e,t){},"G+Rs":function(e,t){},GGSC:function(e,t){},NHnr:function(e,t,n){"use strict";function r(e){n("GGSC")}function o(e){n("SxQ8")}function a(e){n("G+Rs")}function l(e){n("CKyX")}function i(e){n("P1Q4")}function s(e){n("+hpA")}function u(e){n("ohQp")}function c(e){n("bvmy")}Object.defineProperty(t,"__esModule",{value:!0});var m=n("7+uW"),p={name:"app"},f=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{attrs:{id:"app"}},[n("router-view")],1)},d=[],h={render:f,staticRenderFns:d},v=h,b=n("VU/8"),g=r,F=b(p,v,!1,g,null,null),_=F.exports,y=n("/ocq"),x=n("zL8q"),w=n.n(x),$=(n("tvR6"),n("5+O1"),{name:"MyMenu",methods:{handleOpen:function(e,t){},handleClose:function(e,t){}}}),k=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("el-row",{staticClass:"tac"},[n("el-col",{attrs:{span:24}},[n("el-menu",{staticClass:"el-menu-vertical-demo",attrs:{"background-color":"#545c64","text-color":"#fff","active-text-color":"#ffd04b"},on:{open:e.handleOpen,close:e.handleClose}},[n("el-submenu",{attrs:{index:"1"}},[n("template",{slot:"title"},[n("i",{staticClass:"el-icon-location"}),e._v(" "),n("span",[e._v("员工信息管理")])]),e._v(" "),n("el-menu-item-group",[n("el-menu-item",{attrs:{index:"1-1"}},[n("router-link",{attrs:{to:"/member"}},[e._v("用户信息")])],1)],1)],2),e._v(" "),n("el-submenu",{attrs:{index:"2"}},[n("template",{slot:"title"},[n("i",{staticClass:"el-icon-location"}),e._v(" "),n("span",[e._v("新闻")])]),e._v(" "),n("el-menu-item-group",[n("el-menu-item",{attrs:{index:"2-1"}},[n("router-link",{attrs:{to:"/news"}},[e._v("新闻信息")])],1)],1)],2)],1)],1)],1)},E=[],C={render:k,staticRenderFns:E},R=C,D=n("VU/8"),S=o,U=D($,R,!1,S,"data-v-4c479c9e",null),M=U.exports,j={name:"Main",components:{MyMenu:M}},q=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("el-container",{staticStyle:{height:"100vh"}},[n("el-header",[e._v("Header")]),e._v(" "),n("el-container",[n("el-aside",{attrs:{width:"200px"}},[n("MyMenu")],1),e._v(" "),n("el-main",[n("router-view",{staticStyle:{position:"relative"}})],1)],1)],1)},V=[],L={render:q,staticRenderFns:V},P=L,Q=n("VU/8"),G=a,N=Q(j,P,!1,G,"data-v-356cd9ad",null),z=N.exports,A={name:"Info",data:function(){return{tableData:[],fileList:[],loading:!0}},created:function(){var e=this;fetch("/member/select").then(function(e){return e.json()}).then(function(t){e.tableData=t,e.loading=!1})},methods:{success:function(e){if("ok"==e){var t=this;fetch("/member/select").then(function(e){return e.json()}).then(function(e){t.tableData=e,t.loading=!1})}},submitUpload:function(){this.$refs.upload.submit()},handleRemove:function(e,t){console.log(e,t)},handlePreview:function(e){console.log(e)},handleEdit:function(e,t){this.$router.push({path:"/edit",query:t})},handleDelete:function(e,t){var n=this;fetch("/member/del?mid="+t.mid).then(function(e){return e.text()}).then(function(t){"ok"==t&&n.tableData.splice(e,1)})}}},O=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("el-button",{staticClass:"add",attrs:{type:"primary"}},[n("router-link",{attrs:{to:"/Add",tag:"span"}},[e._v("添加")])],1),e._v(" "),n("el-upload",{ref:"upload",staticClass:"upload-demo",attrs:{name:"files",accept:"application/vnd.ms-excel,application/x-xls,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",action:"/member/upload","on-success":e.success,"on-preview":e.handlePreview,"on-remove":e.handleRemove,"file-list":e.fileList,"auto-upload":!1}},[n("el-button",{attrs:{slot:"trigger",size:"small",type:"primary"},slot:"trigger"},[e._v("选取文件")]),e._v(" "),n("el-button",{staticStyle:{"margin-left":"10px"},attrs:{size:"small",type:"success"},on:{click:e.submitUpload}},[e._v("上传到服务器")]),e._v(" "),n("div",{staticClass:"el-upload__tip",attrs:{slot:"tip"},slot:"tip"},[e._v("只能上传jpg/png文件，且不超过500kb")])],1),e._v(" "),n("el-table",{directives:[{name:"loading",rawName:"v-loading",value:e.loading,expression:"loading"}],staticStyle:{width:"100%"},attrs:{data:e.tableData,stripe:""}},[n("el-table-column",{attrs:{prop:"number",label:"工号",width:"180"}}),e._v(" "),n("el-table-column",{attrs:{prop:"name",label:"姓名",width:"180"}}),e._v(" "),n("el-table-column",{attrs:{prop:"phone",label:"联系方式"}}),e._v(" "),n("el-table-column",{attrs:{label:"操作"},scopedSlots:e._u([{key:"default",fn:function(t){return[n("el-button",{attrs:{size:"mini"},on:{click:function(n){e.handleEdit(t.$index,t.row)}}},[e._v("编辑")]),e._v(" "),n("el-button",{attrs:{size:"mini",type:"danger"},on:{click:function(n){e.handleDelete(t.$index,t.row)}}},[e._v("删除")])]}}])})],1)],1)},H=[],T={render:O,staticRenderFns:H},I=T,K=n("VU/8"),X=l,J=K(A,I,!1,X,"data-v-09eeb712",null),W=J.exports,B=n("mvHQ"),Y=n.n(B),Z={name:"Login",data:function(){var e=function(e,t,n){""===t?n(new Error("请输入密码")):n()};return{ruleForm2:{pass:"",name:""},rules2:{name:[{validator:function(e,t,n){""===t?n(new Error("请输入用户名")):n()},trigger:"blur"}],pass:[{validator:e,trigger:"blur"}]}}},methods:{submitForm:function(e){var t=this;this.$refs[e].validate(function(e){var n=t;if(!e)return console.log("error submit!!"),!1;fetch("/users/checkLogin",{method:"post",headers:{"content-Type":"application/x-www-form-urlencoded"},body:"uname="+t.ruleForm2.name+"&upass="+t.ruleForm2.pass}).then(function(e){return e.json()}).then(function(e){"err"==e.messages?n.$message.error("账号或密码错误"):(n.$message.success("登陆成功"),sessionStorage.logininfo=Y()(e[0]),n.$router.push("/"))})})},resetForm:function(e){this.$refs[e].resetFields()}}},ee=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("el-form",{ref:"ruleForm2",staticClass:"demo-ruleForm",attrs:{model:e.ruleForm2,"status-icon":"",rules:e.rules2,"label-width":"100px"}},[n("el-form-item",{attrs:{label:"用户名",prop:"name"}},[n("el-input",{attrs:{type:"text","auto-complete":"off"},model:{value:e.ruleForm2.name,callback:function(t){e.$set(e.ruleForm2,"name",t)},expression:"ruleForm2.name"}})],1),e._v(" "),n("el-form-item",{attrs:{label:"密码",prop:"pass"}},[n("el-input",{attrs:{type:"password","auto-complete":"off"},model:{value:e.ruleForm2.pass,callback:function(t){e.$set(e.ruleForm2,"pass",t)},expression:"ruleForm2.pass"}})],1),e._v(" "),n("el-form-item",[n("el-button",{attrs:{type:"primary"},on:{click:function(t){e.submitForm("ruleForm2")}}},[e._v("提交")]),e._v(" "),n("el-button",{on:{click:function(t){e.resetForm("ruleForm2")}}},[e._v("重置")])],1)],1)},te=[],ne={render:ee,staticRenderFns:te},re=ne,oe=n("VU/8"),ae=i,le=oe(Z,re,!1,ae,"data-v-d9861392",null),ie=le.exports,se={name:"Login",data:function(){var e=function(e,t,n){""===t?n(new Error("请输入工号")):n()};return{ruleForm2:{number:"",name:"",phone:""},rules2:{name:[{validator:function(e,t,n){""===t?n(new Error("请输入用户名")):n()},trigger:"blur"}],Number:[{validator:e,trigger:"blur"}],Phone:[{validator:function(e,t,n){""===t?n(new Error("请输入联系方式")):n()},trigger:"blur"}]}}},methods:{submitForm:function(e){var t=this;this.$refs[e].validate(function(e){var n=t;if(!e)return console.log("error submit!!"),!1;fetch("/member/add",{method:"post",headers:{"content-Type":"application/x-www-form-urlencoded"},body:"name="+t.ruleForm2.name+"&number="+t.ruleForm2.number+"&phone="+t.ruleForm2.phone}).then(function(e){return e.text()}).then(function(e){"ok"==e&&(n.$message({message:"添加成功",type:"success",duration:1e3}),n.resetForm("ruleForm2"))})})},resetForm:function(e){this.$refs[e].resetFields()},back:function(){this.$router.go(-1)}}},ue=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("el-form",{ref:"ruleForm2",staticClass:"demo-ruleForm",attrs:{model:e.ruleForm2,"status-icon":"",rules:e.rules2,"label-width":"100px"}},[n("el-form-item",{attrs:{label:"工号",prop:"number"}},[n("el-input",{attrs:{type:"text","auto-complete":"off"},model:{value:e.ruleForm2.number,callback:function(t){e.$set(e.ruleForm2,"number",t)},expression:"ruleForm2.number"}})],1),e._v(" "),n("el-form-item",{attrs:{label:"姓名",prop:"name"}},[n("el-input",{attrs:{type:"text","auto-complete":"off"},model:{value:e.ruleForm2.name,callback:function(t){e.$set(e.ruleForm2,"name",t)},expression:"ruleForm2.name"}})],1),e._v(" "),n("el-form-item",{attrs:{label:"联系方式",prop:"phone"}},[n("el-input",{attrs:{type:"text","auto-complete":"off"},model:{value:e.ruleForm2.phone,callback:function(t){e.$set(e.ruleForm2,"phone",t)},expression:"ruleForm2.phone"}})],1),e._v(" "),n("el-form-item",[n("el-button",{attrs:{type:"primary"},on:{click:function(t){e.submitForm("ruleForm2")}}},[e._v("提交")]),e._v(" "),n("el-button",{on:{click:function(t){e.resetForm("ruleForm2")}}},[e._v("重置")]),e._v(" "),n("el-button",{on:{click:e.back}},[e._v("返回")])],1)],1)},ce=[],me={render:ue,staticRenderFns:ce},pe=me,fe=n("VU/8"),de=s,he=fe(se,pe,!1,de,"data-v-19c30315",null),ve=he.exports,be={name:"Login",data:function(){var e=function(e,t,n){""===t?n(new Error("请输入工号")):n()};return{ruleForm2:{number:"",name:"",phone:"",mid:""},rules2:{name:[{validator:function(e,t,n){""===t?n(new Error("请输入用户名")):n()},trigger:"blur"}],Number:[{validator:e,trigger:"blur"}],Phone:[{validator:function(e,t,n){""===t?n(new Error("请输入联系方式")):n()},trigger:"blur"}]}}},methods:{submitForm:function(e){var t=this;this.$refs[e].validate(function(e){var n=t;if(!e)return console.log("error submit!!"),!1;fetch("/member/update",{method:"post",headers:{"content-Type":"application/x-www-form-urlencoded"},body:"name="+t.ruleForm2.name+"&number="+t.ruleForm2.number+"&phone="+t.ruleForm2.phone+"&mid="+t.ruleForm2.mid}).then(function(e){return e.text()}).then(function(e){"ok"==e?(n.$message({message:"修改成功",type:"success",duration:1e3}),n.$router.push("/member")):n.$message({message:"修改失败",type:"error",duration:1e3})})})},resetForm:function(e){this.$refs[e].resetFields()},back:function(){this.$router.go(-1)}},created:function(){this.ruleForm2.name=this.$route.query.name,this.ruleForm2.phone=this.$route.query.phone,this.ruleForm2.number=this.$route.query.number,this.ruleForm2.mid=this.$route.query.mid}},ge=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("el-form",{ref:"ruleForm2",staticClass:"demo-ruleForm",attrs:{model:e.ruleForm2,"status-icon":"",rules:e.rules2,"label-width":"100px"}},[n("el-form-item",{attrs:{label:"工号",prop:"number"}},[n("el-input",{attrs:{type:"text","auto-complete":"off"},model:{value:e.ruleForm2.number,callback:function(t){e.$set(e.ruleForm2,"number",t)},expression:"ruleForm2.number"}})],1),e._v(" "),n("el-form-item",{attrs:{label:"姓名",prop:"name"}},[n("el-input",{attrs:{type:"text","auto-complete":"off"},model:{value:e.ruleForm2.name,callback:function(t){e.$set(e.ruleForm2,"name",t)},expression:"ruleForm2.name"}})],1),e._v(" "),n("el-form-item",{attrs:{label:"联系方式",prop:"phone"}},[n("el-input",{attrs:{type:"text","auto-complete":"off"},model:{value:e.ruleForm2.phone,callback:function(t){e.$set(e.ruleForm2,"phone",t)},expression:"ruleForm2.phone"}})],1),e._v(" "),n("el-form-item",[n("el-button",{attrs:{type:"primary"},on:{click:function(t){e.submitForm("ruleForm2")}}},[e._v("提交")]),e._v(" "),n("el-button",{on:{click:function(t){e.resetForm("ruleForm2")}}},[e._v("重置")]),e._v(" "),n("el-button",{on:{click:e.back}},[e._v("返回")])],1)],1)},Fe=[],_e={render:ge,staticRenderFns:Fe},ye=_e,xe=n("VU/8"),we=u,$e=xe(be,ye,!1,we,"data-v-74024eee",null),ke=$e.exports,Ee={name:"News",data:function(){return{tableData:[],page:0,flag:!0}},created:function(){var e=this;fetch("/news/select?page="+this.page).then(function(e){return e.json()}).then(function(t){t.message||(e.tableData=t)})},methods:{pre:function(){console.log(this.page),this.page=this.page<=0?0:this.page-1;var e=this;fetch("/news/select?page="+this.page).then(function(e){return e.json()}).then(function(t){t.message||(e.tableData=t,e.flag=!0)})},next:function(){if(this.flag){this.page++;var e=this;fetch("/news/select?page="+this.page).then(function(e){return e.json()}).then(function(t){t.message?(e.flag=!1,e.page--):e.tableData=t})}}}},Ce=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("el-table",{staticStyle:{width:"100%"},attrs:{data:e.tableData,border:""}},[n("el-table-column",{attrs:{prop:"title",label:"标题",width:"180"}}),e._v(" "),n("el-table-column",{attrs:{prop:"conq",label:"内容"}})],1),e._v(" "),n("el-button-group",[n("el-button",{attrs:{type:"primary",icon:"el-icon-arrow-left"},on:{click:e.pre}},[e._v("上一页")]),e._v(" "),n("el-button",{attrs:{type:"primary"},on:{click:e.next}},[e._v("下一页"),n("i",{staticClass:"el-icon-arrow-right el-icon--right"})])],1)],1)},Re=[],De={render:Ce,staticRenderFns:Re},Se=De,Ue=n("VU/8"),Me=c,je=Ue(Ee,Se,!1,Me,"data-v-30c25b1d",null),qe=je.exports;m.default.use(y.a),m.default.use(w.a);var Ve=new y.a({routes:[{path:"/",name:"Main",component:z,children:[{path:"/member",component:W},{path:"/add",component:ve},{path:"/edit",component:ke},{path:"/news",component:qe}]},{path:"/login",component:ie}]});Ve.beforeEach(function(e,t,n){"/login"==e.path?n():sessionStorage.getItem("logininfo")?n():n("/login")});var Le=Ve;m.default.config.productionTip=!1,new m.default({el:"#app",router:Le,template:"<App/>",components:{App:_}})},P1Q4:function(e,t){},SxQ8:function(e,t){},bvmy:function(e,t){},ohQp:function(e,t){},tvR6:function(e,t){}},["NHnr"]);
//# sourceMappingURL=app.9af687b50bb6c7c4868a.js.map