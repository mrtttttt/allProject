import Vue from 'vue'
import Router from 'vue-router'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import '@/assets/base.css'
import Admin from '@/components/Admin'
import Login from '@/components/Login'

import User from '@/components/User'
import AddUser from '@/components/AddUser'
import EditUser from '@/components/EditUser'

import Administ from '@/components/Administ'
import AddAdmin from '@/components/AddAdmin'
import EditAdmin from '@/components/EditAdmin'

import AdminGoods from '@/components/AdminGoods'
import AddGoods from '@/components/AddGoods'
import EditGoods from '@/components/EditGoods'

import Category from '@/components/Category'
import AddCate from '@/components/AddCate'
import EditCate from '@/components/EditCate'

import Money from '@/components/Money'
import Address from '@/components/Address'

Vue.use(Router)
Vue.use(ElementUI)

var router= new Router({
  routes: [
    {
      path: '/',
      name: 'Admin',
      component: Admin,
        children:[
            //用户
            {path:"/user",component:User},
            {path:"/addUser",component:AddUser},
            {path:"/editUser",component:EditUser},
            {path:"/address",component:Address},
          //管理员
            {path:"/admin",component:Administ},
            {path:"/addAdmin",component:AddAdmin},
            {path:"/editAdmin",component:EditAdmin},
            //商品
            {path:"/adminGoods",component:AdminGoods},
            //交易
            {path:"/money",component:Money},
            //没有增加及编辑商品功能
            {path:"/addGoods",component:AddGoods},
            {path:"/editGoods",component:EditGoods},
            //分类
            {path:"/category",component:Category},
            {path:"/addCate",component:AddCate},
            {path:"/editCate",component:EditCate},
        ]
    },
      {path:"/login",component:Login}
  ]
})
router.beforeEach(function (to,from,next) {
    if(to.path=="/login"){
        next()
    }else{
        if(sessionStorage.getItem("adminLogin")){
            next();
        }else{
            next("/login")
        }
    }
})

export default router
