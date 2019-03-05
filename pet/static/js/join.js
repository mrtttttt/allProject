//登录注册
window.addEventListener("load",function(){
	$(".itemUl li").on("click",".button",function () {
		$(this).next(".introduce").slideToggle();
		$(this).find(".apply").toggleClass("applyhover");
    })
})
