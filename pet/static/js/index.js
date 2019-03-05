window.addEventListener("load",function(){
    //固定导航
    $(window).scroll(function(){
        var t=$("body").scrollTop();
        var tFlag=true;
        if(t>160){
            tFlag=false;
            $(".navList").css("height","60px");
        }else{
            tFlag=true;
            $(".navList").css("height","0");
        }
    })

    //导航选中
    $(".navUl>li>a").click(function () {
        console.log($(".navUl>li>a"));
        $(".navUl>li>a").removeClass("fff");
        $(this).addClass("fff");
    })
})
