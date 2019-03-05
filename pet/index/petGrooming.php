<?php
include "../public/header.php";
?>
<link rel="stylesheet" href="<?php echo $cssurl?>blog.css">
<?php
include "../public/db.php";
$sql2="select * from shows where posid=3";
$result2=$db->query($sql2);
$result2->setFetchMode(PDO::FETCH_ASSOC);
$row2=$result2->fetch();
$img= explode(';',$row2["simg"]);
$a=count($img)-1;
$num=mt_rand(0,$a);
?>
<section class="pet" style="background-image: url('../admin/<?php echo $img[$num]?>')"></section>
		<section class="hotCare">
			<main>
				<p id="titleHead">宠物美容</p>
				<div class="hotgroom">
					<ul class="hotG">
						<li>
							<img src="img/groom.png" alt="" />
							<div class="petText">宠物美容的"重头戏"</div>
						</li>
					</ul>
					<ul class="hotCtext hotGtext">
						<li><a href="article.html">科学告诉你家制食品对宠物的健康威胁<span>2016-05-18</span></a></li>
						<li><a href="article.html">科学告诉你家制食品对宠物的健康威胁<span>2016-05-18</span></a></li>
						<li><a href="article.html">科学告诉你家制食品对宠物的健康威胁<span>2016-05-18</span></a></li>
						<li><a href="article.html">科学告诉你家制食品对宠物的健康威胁<span>2016-05-18</span></a></li>
						<li><a href="article.html">科学告诉你家制食品对宠物的健康威胁<span>2016-05-18</span></a></li>
						<li><a href="article.html">科学告诉你家制食品对宠物的健康威胁<span>2016-05-18</span></a></li>
						<li><a href="article.html">科学告诉你家制食品对宠物的健康威胁<span>2016-05-18</span></a></li>
						<li><a href="article.html">科学告诉你家制食品对宠物的健康威胁<span>2016-05-18</span></a></li>
						<li><a href="article.html">科学告诉你家制食品对宠物的健康威胁<span>2016-05-18</span></a></li>
						
					</ul>
				</div>
			</main>
		</section>
		
		<section class="example">
			<main>
				<p id="titleHead">美容实例</p>
				<div class="scroll">
					<ul>
						<li><a href=""><img src="img/example1.jpg" alt="" /></a></li>
						<li><a href=""><img src="img/example2.jpg" alt="" /></a></li>
						<li><a href=""><img src="img/example3.jpg" alt="" /></a></li>
						<li><a href=""><img src="img/example4.jpg" alt="" /></a></li>
						<li><a href=""><img src="img/example5.jpg" alt="" /></a></li>
						<li><a href=""><img src="img/example1.jpg" alt="" /></a></li>
						<li><a href=""><img src="img/example2.jpg" alt="" /></a></li>
						<li><a href=""><img src="img/example3.jpg" alt="" /></a></li>
						<li><a href=""><img src="img/example4.jpg" alt="" /></a></li>
						<li><a href=""><img src="img/example5.jpg" alt="" /></a></li>
					</ul>
				</div>
			</main>
		</section>
		
		<section class="contact" id="us" style="clear: both;" >
            <div class="contact_top">
                <h2>联系</h2>
                <p>你的一分建议，我们的百分创意</p>
            </div>
            <div class="contact_text">
                <div class="allp">
                    <p>地址:太原市小店区</p>
                    <p>手机:12345678912</p>
                    <p>邮箱:210272793@qq.com</p>
                    <p>邮编:030800</p>
                </div>
            </div>
            <div class="contact_input">
                <form action="">
                    <div class="text"><input class="inp" type="text" placeholder="姓名"></div>
                    <div class="text"><input class="inp" type="text" placeholder="电话"></div>
                    <div class="text"><input class="inp" type="text" placeholder="邮编"></div>
                    <div class="text"><textarea class="inp" style="height: 100px;width: 280px;margin-left: 20px;"placeholder="内容"></textarea></div>
                    <div class=""><input class="sub" type="submit" value="提交信息"></div>
                </form>
            </div>
            <div style="clear: both;margin-bottom: 30px;"></div>
        </section>
        <footer>
            <div>
                <p>宠物之家&nbsp;版权所有：某公司</p>
            </div>
            <div>
                designed by
                <a href="#">Teemo</a>&nbsp;
                17.5.13
            </div>
        </footer>
	</body>
</html>
<script>
	window.onload = function(){
		var exampleT=setInterval(move,50);
		var speed=0;
		function move(){
			if(speed>2000){
				speed=0;
			}
			speed+=2;
			$(".scroll ul").css("left",`${-speed}px`);
		}
		$(".scroll").hover(function(){
			clearInterval(exampleT);
		},function(){
			exampleT=setInterval(move,50);
		})
		
	}
</script>
