$(function(){

	//轮播
	let lis = $(".banner-box li");
	let next=0;
	let t = setInterval(move,4000);
	function move(){
		next++;
		if(next==6){
			next=0;
		}
		lis.css({"opacity":"0","z-index":"0"}).eq(next).css({"opacity":"1","z-index":"1"});
		// btns.removeClass("hot").eq(next).addClass("hot");
	}
	$(".banner").hover(function(){
		clearInterval(t);
	},function(){
		t = setInterval(move,4000);
	})
})
