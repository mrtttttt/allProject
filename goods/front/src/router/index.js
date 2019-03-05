import Vue from 'vue'
import Router from 'vue-router'

//模块
import Main from '@/components/Main'
import Personal from '@/components/Personal'
import My from '@/components/My'
import Home from '@/components/Home'
import Publish from '@/components/Publish'
import GoodsInfo from '@/components/GoodsInfo'
import Login from '@/components/Login'
import Register from '@/components/Register'
import Published from '@/components/Published'
import Buyed from '@/components/Buyed'
import Selled from '@/components/Selled'
import Collected from '@/components/Collected'
import MyAddress from '@/components/MyAddress'
import Priceinfo from '@/components/Priceinfo'
import EditAddress from '@/components/EditAddress'
import SetMain from '@/components/SetMain'
import SetPass from '@/components/SetPass'
import Buy from '@/components/Buy'

Vue.use(Router)

var router=new Router({
  routes: [
    {
      path: '/',
      name: 'Main',
      component: Main,
      children:[
        {
          path:"",component:Home,meta:{keepAlive:true}
        },
        {
          path:"/personal",component:Personal
        }
      ]
    },
    {
      path:'/goodsInfo/:gid',
      name:'GoodsInfo',
      component:GoodsInfo
    },
    {
      path:"/login",
      name:"Login",component:Login
    },
    {
      path:"/register",
      name:"Register",component:Register
    },
    {
      path:"/publish/:gid?",component:Publish,
      beforeEnter(to,from,next){
        if(localStorage.getItem("userFront")){
          next()
        }else{
          next("/login")
        }
      }
    },
    {
      path:"/my",component:My,
      children:[
        {path:"/published",component:Published},
        {path:"/buyed",component:Buyed},
        {path:"/selled",component:Selled},
        {path:"/collected",component:Collected},
        {path:"/priceinfo",component:Priceinfo},
        {path:"/address",component:MyAddress},
        {path:"/editAddress",component:EditAddress},
        {path:"/setMain",component:SetMain},
        {path:"/setPass",component:SetPass},
      ],
      beforeEnter(to,from,next){
        if(localStorage.getItem("userFront")){
          next()
        }else{
          next("/login")
        }
      }
    },
    {
      path:"/buy/:gid",component:Buy
    }
  ]
})

export default router;
