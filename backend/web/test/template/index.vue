<template>
<div id="tindex">2222
<div class="jrkefutop">
   <img src="static/images/logo.png" alt="" class="jlogo">
   <div class="juinfo"><!--您好李飞，欢迎来到巨人教育！--><a href="">登录</a> / <a href="" class="regbtn">注册</a></div>
</div>
<div class="act-con" id="index">
    <img src="static/images/zindex_01.jpg" alt="">
    <img src="static/images/zindex_02.jpg" alt="" v-on:click="begain_test">
    <img src="static/images/zindex_03.jpg" alt="">
    <img src="static/images/zindex_04.jpg" alt="" v-on:click="show_test_info">
    <img src="static/images/zindex_05.jpg" alt="">	
</div>	
<div class="act-fade2" v-show="visshw==true">
    <div class="act-pop2">
        <i class="close" v-on:click="show_test_info"></i>
        <div class="act-pop-con2">

	    <img src="static/images/tipbg.png">

        </div>
    </div>
</div>
</div>
</template>
<script>
 export default{
     data(){
         return {
             sContent:"This is index components"
         }
     }
 }