<template>
    <el-row class="tac">
        <el-col :span="24">
            <el-menu
                    default-active="2"
                    class="el-menu-vertical-demo"
                    @open="handleOpen"
                    @close="handleClose">
                <el-submenu index="2">
                    <template slot="title">
                        <i class="el-icon-tickets"></i>
                        <span>管理员</span>
                    </template>
                    <el-menu-item-group>
                        <el-menu-item index="2-1">
                            <router-link to="/admin" >管理员信息</router-link>
                        </el-menu-item>
                    </el-menu-item-group>
                </el-submenu>
                <el-submenu index="1">
                    <template slot="title">
                        <i class="el-icon-tickets"></i>
                        <span>用户</span>
                    </template>
                    <el-menu-item-group>
                        <el-menu-item index="1-1">
                            <router-link to="/user" >用户信息</router-link>
                        </el-menu-item>
                        <el-menu-item index="1-2">
                            <router-link to="/address" >地址信息</router-link>
                        </el-menu-item>
                    </el-menu-item-group>
                </el-submenu>
                <el-submenu index="3">
                    <template slot="title">
                        <i class="el-icon-tickets"></i>
                        <span>商品</span>
                    </template>
                    <el-menu-item-group>
                        <el-menu-item index="3-1">
                            <router-link to="/adminGoods" >商品信息</router-link>
                        </el-menu-item>
                        <el-menu-item index="3-2">
                            <router-link to="/money" >交易信息</router-link>
                        </el-menu-item>
                    </el-menu-item-group>
                </el-submenu>
                <el-submenu index="4">
                    <template slot="title">
                        <i class="el-icon-tickets"></i>
                        <span>分类</span>
                    </template>
                    <el-menu-item-group>
                        <el-menu-item index="4-1">
                            <router-link to="/category" >分类信息</router-link>
                        </el-menu-item>
                    </el-menu-item-group>
                </el-submenu>
            </el-menu>
        </el-col>
    </el-row>
</template>

<script >
    export default {
        name:"MyMenu",
        methods: {
            handleOpen(key, keyPath) {
//                console.log(key, keyPath);
            },
            handleClose(key, keyPath) {
//                console.log(key, keyPath);
            }
        }
    }
</script>

<style scoped>

</style>
