window.addEventListener("load",function () {
    $(".hotUl").on("click","li",function () {
        $(".hotUl li").removeClass("lineLi");
        $(this).addClass("lineLi");
        var cid=$(this).attr("cid");
        $.ajax({
            url:"../index/showPet.php",data:{cid},
            dataType:"json",
            type:"get",
            success:function (data) {
                $(".pz-body").html("");
                var str="";
                data.forEach(function (obj,index) {
                    var imgarr=obj.simg.split(";");
                    var imgurl="../admin/"+imgarr[0];
                    str+=`
                        <li>
                            <img src="${imgurl}" width="200" alt="">
                            <div class="showA">
                                <a href="article.php?sid=${obj.sid}">基本介绍</a>
                                <a href="details.php?sid=${obj.sid}">交易页</a>
                            </div>
                        </li>
                    
                    `;

                })
                    $(".pz-body").append(str);
                    let handler = $('#tiles>li');
                    handler.wookmark({
                        // Prepare layout options.
                        autoResize: true, // This will auto-update the layout when the browser window is resized.
                        container: $('#main'), // Optional, used for some extra CSS styling
                        offset: 10, // Optional, the distance between grid items
                        outerOffset: 10, // Optional, the distance to the containers border
                        itemWidth: 210 // Optional, the width of a grid item
                    });
            }
        })

    })
    // (function ($){
        var handler = $('#tiles>li');

        handler.wookmark({
            // Prepare layout options.
            autoResize: true, // This will auto-update the layout when the browser window is resized.
            container: $('#main'), // Optional, used for some extra CSS styling
            offset: 10, // Optional, the distance between grid items
            outerOffset: 10, // Optional, the distance to the containers border
            itemWidth: 210 // Optional, the width of a grid item
        });


    $(".a-box").on("click","p",showArticle);
    $(".nav li").eq(0).on("click",showArticle);
    function showArticle() {
            var cid=$(this).attr("cid");
            $(".blogList1").html("");
            $.ajax({
                url:"../index/showArticle.php",data:{cid},
                dataType:"json",
                type:"get",
                success:function (data) {
                    data.forEach(function (obj,index) {
                        var str="<li>";
                        if(obj.uid==0){
                            str+=`
                            <a class="blog-img" href="article.php?sid=${obj.sid}">
                                <img src="../admin/${obj.simg}" alt="" />
                                </a>
                                <a href="article.php?sid=${obj.sid}">${obj.stitle}</a>
                            <span>
                            ${obj.sintro}
                        </span><br />
                            <p>
                            2017-9-20 admin    <span>999+人已浏览</span>
                            </p>
                        `;
                        }else{
                            str+=`
                            <a class="blog-img" href="article.php?sid=${obj.sid}">
                                <img src="${obj.simg}" alt="" />
                                </a>
                                <a href="article.php?sid=${obj.sid}">${obj.stitle}</a>
                            <span>
                            ${obj.sintro}
                        </span><br />
                            <p>
                            2017-9-20 admin    <span>999+人已浏览</span>
                            </p>
                        `;
                        }

                        str+="</li>";
                        $(".blogList1").append(str);
                    })
                }
            })
    }

})



