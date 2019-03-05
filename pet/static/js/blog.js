window.addEventListener("load",function () {
    $(".nav li").click(function () {
        $(".nav li").removeClass("active");
        $(this).addClass("active");
        if($(this).index(".nav li")==0){
            $(".blogList1").fadeIn();
            $(".newBlog").fadeOut();
            $(".myBlogList").fadeOut();
        }else if($(this).index(".nav li")==1){
            var login=$(".checklogin").attr("login");
            if(login=="no"){
                if(confirm("你还处于未登录状态，只有登录后才可发表博客，是否现在去登陆")){
                    location.href="login.php";
                }else{
                    $(".nav li").eq(0).addClass("active");
                    $(this).removeClass("active");
                    $(".blogList1").fadeIn();
                    $(".newBlog").fadeOut();
                }
            }else{
                $(".blogList1").fadeOut();
                $(".newBlog").fadeIn();
                $(".myBlogList").fadeOut();
            }
        }else if($(this).index(".nav li")==2){
            var login=$(".checklogin").attr("login");
            if(login=="no"){
                if(confirm("你还处于未登录状态，只有登录后才可发表博客，是否现在去登陆")){
                    location.href="login.php";
                }else{
                    $(".nav li").eq(0).addClass("active");
                    $(this).removeClass("active");
                    $(".blogList1").fadeIn();
                    $(".myBlogList").fadeOut();
                }
            }else{
                $(".blogList1").fadeOut();
                $(".newBlog").fadeOut();
                $(".myBlogList").fadeIn();
            }

        }
    })
})