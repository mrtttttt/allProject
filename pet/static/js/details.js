window.addEventListener("load",function () {
    var next=0;
    $(".btnr").click(function () {
        next++;
        if(next==$(this).parent().children("img").length){
            next=0;
        }
        $(this).parent().children("img").css({"opacity":"0","z-index":"0"}).eq(next).css({"opacity":"1","z-index":"1"});
        if($(this).parent().next().length){
            $(this).parent().next().children("div").css("border-color","#ccc").eq(next).css("border-color","#00b3ff");
        }
    })
    $(".btnl").click(function () {
        next--;
        if(next==-1){
            next=$(this).parent().children("img").length-1;
        }
        $(this).parent().children("img").css({"opacity":"0","z-index":"0"}).eq(next).css({"opacity":"1","z-index":"1"});
        if($(this).parent().next().length){
            $(this).parent().next().children("div").css("border-color","#ccc").eq(next).css("border-color","#00b3ff");
        }
    })
    $(".smallShop div").click(function () {
        next=$(this).index(".smallShop div");
        $(".smallShop div").css("border-color","#ccc").eq(next).css("border-color","#00b3ff");
        $(".bigShop img").css({"opacity":"0","z-index":"0"}).eq(next).css({"opacity":"1","z-index":"1"});
    })

    $(".num button").click(function () {
        var price=parseFloat($(".price span").html());
        var num=$(".num input").val();
        var maxNum=$(".hadShop span").html();
        if($(this).index(".num button")==0){
            num--;
            if(num<=1){
                num=1;
                $(this).attr("disabled","disabled");
            }
            $(".num input").val(num);
        }else if($(this).index(".num button")==1){
            num++;
            if(num>=maxNum){
                num=maxNum;
            }
            $(".num input").val(num);
            $(this).prevAll(".num button").removeAttr("disabled");
        }
        var newPrice=price*num;
        $(".priceAll span").html(`${newPrice.toFixed(2)}元`);
    })
    
    $(".buy").on("click",function () {
        var user = $(".checklogin").attr("login");
        if(user == "no"){
            if(confirm("你还处于未登录状态，是否现在去登陆")){
                location.href="login.php";
            }
        }else{
            alert(1);
        }
    })
    $(".willBuy").on("click",function () {
        var user = $(".checklogin").attr("login");
        if(user == "no"){
            if(confirm("你还处于未登录状态，是否现在去登陆")){
                location.href="login.php";
            }
        }else{
            let num=$(".num input").val();

        }
    })

})