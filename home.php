<?php
	session_start();
	include 'php/mysql.php';
	$row = selectDB('select * from classify');
	if(isset($_SESSION['userinfo'])){
		$userinfo = $_SESSION['userinfo'][0];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title> 
	<link rel="stylesheet" href="sweetAlert/sweetalert.css">

	<!-- 第三方代码，用于背景虚拟化，可忽略 -->
	<script src='js/stackblur.js'></script>
	<script src='js/jquery-3.0.0/jquery-3.0.0.js'></script>
	<script src='sweetAlert/sweetalert-dev.js'></script>
	<link rel="stylesheet" href="css/common.css">
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/footer.css">
	<link rel="stylesheet" href="css/account.css">
	<style>
		
		<?php 
			if(empty($userinfo)){
		?>
			.person_info{
				display: none;
			}
			.login_btn_info{
				display: block;
			}
		<?php }else{ ?>
			.person_info{
				display: block;
			}
			.portrail{
				background-image: url(<?php echo '.'.$userinfo['H_portrait']?>);
			}
			.login_btn_info{
				display: none;
			}
		<?php } ?>
		
/****************************************************************/
		/*广告*/
		.banner{
			height: 500px;
			/*background-color: green;*/
			background-image: url('img/banner_1.jpg');
			background-repeat: no-repeat;
			background-size: 100%;
			text-align: center;
			overflow: hidden;
			transition: all 1s;
		}
		/*title内容：花瓣，陪你做生活的设计师*/
		.banner .title{
			margin-top: 130px;
			margin-bottom: 50px;
			width: 540px;
			height: 54px;
			color: white;
			margin-left: auto;
			margin-right: auto;
			background:url(img/head_title.svg);
		}
		/*动态搜索框，效果与导航中的搜索框类似*/
		.banner .search{
			/*background-color: blue;*/
			width: 558px;
			height: 36px;
			margin:0px auto;
			margin-bottom: 10px;
			position: relative;
		}
		.banner .search input{
			width: 548px;
			height: 36px;
			background-color: transparent;
			border:1px solid white;
			border-radius: 2px;
			padding-left: 5px;
			padding-right: 5px;
			outline: none;
			color: white;
		}
		/*go为放大镜*/
		.banner .search .go{
			position: absolute;
			top: 0px;
			right: 0px;
			display: inline-block;
			width: 40px;
			height: 36px;
			background-image:url(img/icon_search.svg);
			background-repeat: no-repeat;
			background-position: center;
		}
		/*浮动到input上有一个颜色加深效果*/
		.banner .search input:hover{
			background-color: rgba(0,0,0,0.3);
		}
		/*notice为：热门搜索：opps！出错了，花瓣LIVE，配色，壁纸那些事*/
		.banner .notice{
			color:white;
			font-size: 14px;
		}

/****************************************************************/
		/*content为一个大div，包含了除header和footer之外的所有的内容区域*/
		.content{
			margin:0px auto;
			width: 1248px;
			text-align: center;
			margin-bottom:20px;
		}
/*关注区域*/
		/*关注分隔条*/
		.attention{
			color: grey;
			position: relative;
		}
		/*大家正在关注的左边线*/
		.attention:before{
			left: 20px;
		}
		/*大家正在关注的右边线*/
		.attention:after{
			right: 20px;
		}
		/*左右分隔线，需要绝对定位，否则缩放会有一些问题*/
		.attention:before,.attention:after{
			content: '';
			display: inline-block;
			width: 44%;
			height: 8px;
			top: 10px;
			border-top:0.5px solid #EDEDED;
			position: absolute;
		}
		/*关注内容*/
		.attention-content{
			margin-top: 20px;
			margin-bottom: 20px;
		}
		.attention-content:after{
			content: '';
			display: block;
			clear: both;
		}
		/*li左右的间隔计算同时使用margin-left和margin-right，方便计算*/
		.attention-content li{
			width: 164px;
			height: 70px;
			float:left;
/*			background-image: url(img/attention.jpg);*/
			border-radius: 6px;
			margin-left:7.1px;
			margin-right: 7.1px;
			line-height: 70px;
			text-align: center;
		}
		/*单独设置每一个关注的背景图片，用到了css3的选择器，可以使用jquery的选择器替代或者使用css2的其他方法*/
		<?php
			foreach($row as $key=>$item){
		?>
		.attention-content li:nth-of-type(<?php echo $key+1;?>){
			background-image: url(<?php echo $item['image']?>);
		}
		<?php
			}
		?>
		/*.attention-content li:nth-of-type(1){
			background-image: url(img/1.jpg);
		}
		.attention-content li:nth-of-type(2){
			background-image: url(img/2.jpg);
		}
		.attention-content li:nth-of-type(3){
			background-image: url(img/3.jpg);
		}
		.attention-content li:nth-of-type(4){
			background-image: url(img/4.jpg);
		}
		.attention-content li:nth-of-type(5){
			background-image: url(img/5.jpg);
		}
		.attention-content li:nth-of-type(6){
			background-image: url(img/6.jpg);
		}
		.attention-content li:nth-of-type(7){
			background-image: url(img/7.jpg);
		}*/
		.attention-content li a{
			color:white;
			font-weight: 700;
			font-size: 1.2em;
		}

/*推荐区域*/
		/*推荐分隔条*/
		.recommend{
			color: grey;
			position: relative;
		}
		.recommend:before{
			left: 20px;
		}
		.recommend:after{
			right: 20px;
		}
		.recommend:before,.recommend:after{
			content: '';
			display: inline-block;
			width: 44%;
			height: 8px;
			top: 10px;
			border-top:0.5px solid #EDEDED;
			position: absolute;
		}
		/*推荐内容*/
		
		.recommend-content{
			margin-top: 20px;
			margin-bottom: 20px;
		}
		.recommend-content:after{
			content: '';
			display: block;
			clear: both;
		}
		.recommend-content li{
			width: 308px;
			height: 308px;
			/*line-height: 308px;*/
			margin:2px 2px;
			background:green;
			float:left;
		}
		.virtual-bg{
			position: relative;
			width: 308px;
			height: 308px;
		}
		/*mask为鼠标浮动时候的阴影遮罩*/
		.recommend-content .mask{
			width: 308px;
			height: 308px;
			background-color: rgba(0,0,0,0);
			/*z-index: 1;*/
			position: absolute;
			top: 0px;
			left: 0px;
		}
		.recommend-content .mask:hover{
			background-color: rgba(0,0,0,0.2);
		}
		/*头像背景，有虚化效果*/
		.recommend-content .avatar-bg{
			background-image: url('img/ym.jpg');
		}
		/*头像*/
		.recommend-content .avatar{
			width: 120px;
			height: 120px;
			position: absolute;

			left:50%;
			top:50%;
			margin-left:-60px;
			margin-top:-60px;
			display: inline-block;
			background-image: url(img/ym.jpg);
			background-repeat: no-repeat;
			background-position: center;
			background-size: cover;
			border-radius: 50%;
			border:3px solid white;
		}
		/*小箭头*/
		.recommend-content .arrow{
			position: absolute;
			top: 25%;
			right: -4px;
			width: 14px;
			height: 28px;
			background-image: url(img/info_tra.svg);
		}

		/*第二个li，分成了上下两个部分，其中的mask仍然为遮罩*/
		.recommend-content .toppart,.recommend-content .bottompart{
			width: 276px;
			height: 132px;
			padding: 10px 16px;
			background-color: #FAFAFA;
			margin-bottom: 4px;
			position: relative;
		}
		.recommend-content .toppart .mask,.recommend-content .bottompart .mask{
			width: 308px;
			height: 152px;
			position: absolute;
			top: 0px;
			left: 0px;
			background-color: rgba(0,0,0,0);
		}
		.recommend-content .toppart .mask:hover,.recommend-content .bottompart .mask:hover{
			background-color: rgba(0,0,0,0.1);
		}
		.recommend-content .toppart .people{
			width: 100px;
			height: 46px;
			padding: 0px 20px 5px 0px;
			background: url(img/box_title_sprite.svg) -140px 0 no-repeat;
			background-position: 0 -160px;
			border-bottom:1px solid #EDEDED;
			margin-bottom: 4px;
		}
		.toppart .title{
			text-align: left;
			height: 25px;
			font-size: 1.2em;
			margin-bottom: 4px;
		}
		.toppart .title a{
			color: black;
		}
		.toppart .comment{
			text-align: left;
			height: 20px;
			font-size: 12px;
			color: #999999;
		}

		/*底部*/
		.recommend-content .bottompart .palette{
			position: absolute;
			right: 10px;
			width: 100px;
			height: 46px;
			padding: 0px 20px 5px 0px;
			background: url(img/box_title_sprite.svg) -140px 0 no-repeat;
			background-position: 25px 0px;
			border-bottom:1px solid #EDEDED;
			margin-bottom: 4px;
		}
		.recommend-content .bottompart .title{
			text-align: right;
			height: 25px;
			font-size: 1.2em;
			margin-top: 55px;
			margin-bottom: 4px;
		}
		.recommend-content .bottompart .title a{
			color: black;
		}
		.recommend-content .bottompart .comment{
			text-align: right;
			height: 20px;
			font-size: 12px;
			color: #999999;
			margin-bottom:10px;
		}
		.recommend-content .bottompart .from{
			text-align: right;
			height: 20px;
			font-size: 13px;
			color: #999999;
		}
		.recommend-content .bottompart .from a{
			color: #9E7E6B;
		}
		
/*加载更多*/
		.loadMore{
			color: grey;
			position: relative;
			width: 49%;
			height: 21px;
			line-height: 21px;
			text-align: center;
			border-radius: 2px;
			padding: 10px;
			background-color: #F7F7F7;
			margin:20px auto;
			font-size: 1.5em;
			cursor: pointer;
		}
		.loadMore:before{
			right: 106%;
		}
		.loadMore:after{
			left: 106%;
		}
		.loadMore:before,.loadMore:after{
			cursor: default;
			content: '';
			display: inline-block;
			width: 40%;
			height: 8px;
			top: 50%;
			border-top:0.5px solid #EDEDED;
			position: absolute;
		}
/*以分类浏览花瓣，使用table布局*/
		.classify{
			height: 30px;
			line-height: 30px;
			border-bottom: 2px solid #EDEDED;
			margin-bottom:20px;
		}
		.classify:after{
			content: '';
			display:block;
			clear: both;
		}
		.classify span{
			float: left;
		}
		.classify a{
			float: right;
			color: #9E7E6B;
		}
		.classify_content table tr{
			height: 25px;
			line-height: 25px;
		}
		.classify_content table td{
			width: 244px;
			text-align: left;
			font-size: 14px;
		}
		.classify_content a{
			color: #222;
		}
		.classify_content a:hover{
			color: #C90000;
			text-decoration: underline;
		}


	</style>
</head>
<body>
	<div>
		<!-- header,nav,footer为html5语义化标签，可以使用div替代 -->
		<header>
			<!-- 头部导航条 -->
			<nav class="header_navbar">
				<!-- 头部导航，保证缩放居中效果 -->
				<div class="navpart">
					<!-- 左边部分 -->
					<div class="header_leftpart">
						<!-- 花瓣logo -->
						<div class="logo">
							<a href="home.php" alt="logo"></a>
						</div>
						<!-- 导航部分（发现、最新、美思...） -->
						<ul class="header_nav">
							<li><a href="">发现</a></li>
							<li><a href="">最新</a></li>
							<li><a href="">美思</a></li>
							<li>
								<a href="">
									活动
									<span class="mark">new</span>
								</a>
							</li>
							<li><a href="">教育</a></li>
						</ul>
						<!-- 导航动态搜索框 -->
						<div class="header_search">
							<form action="">
								<input class="search_input" type="text" size="27" placeholder="搜索你喜欢的">
								<!-- 放大镜 -->
								<a class="go"></a>
							</form>
						</div>
					</div>
					<!-- 导航条右边部分 -->
					<div class="header_rightpart">
						<div class="login_btn_info">
							<button class="register">注册</button>
							<button class="login">登录</button>
						</div>

						<div class="person_info">
							<div class="portrail"></div>
							<ul class="portrail_list">
								<li>
									<a onclick="person_click();">
										<img src="img/person.png" alt="" width="20px" height="20px"><span>个人信息</span>
									</a>
								</li>
								<li>
									<a onclick="love_click();">
										<img src="img/love.png" alt="" width="20px" height="20px"><span>我的收藏</span>
									</a>
								</li>
								<li>
									<a onclick="exit_click();">
										<img src="img/exit.png" alt="" width="20px" height="20px"><span>退出登录</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</nav>
			<div class="banner">
				<div class="title">
				</div>
				<div class="search">
					<form action="">
						<input class="search_input" type="text" size="27" placeholder="搜索你喜欢的">
						<a class="go"></a>
					</form>
				</div>
				<div class="notice">
					热门搜索：opps！出错了，花瓣LIVE，配色，壁纸那些事
				</div>
			</div>
		</header>
		<div class="content">
			<!-- 关注区域 -->
			<!-- 关注分隔条和分隔线 -->
			<div class="attention">
				大家正在关注
			</div>
			<!-- 关注内容 -->
			<ul class="attention-content">
				<?php
					foreach($row as $item){
				?>
				<li><a href="<?php echo "category.php?id={$item['id']}&title={$item['name']}&brief={$item['brief']}"; ?>"><?php echo $item['name']?></a></li>
				<?php
					}
				?>
				<!-- <li><a href="category.html">风景插画</a></li>
				<li><a href="category.html">音乐icon</a></li>
				<li><a href="category.html">怀旧海报</a></li>
				<li><a href="category.html">东方Project</a></li>
				<li><a href="category.html">字体设计</a></li>
				<li><a href="category.html">蕾丝</a></li>
				<li><a href="category.html">龙猫</a></li> -->
			</ul>
			<!-- 推荐区域 -->
			<!-- 推荐分隔条和分隔线 -->
			<div class="recommend">
				为您推荐
			</div>
			<!-- 推荐内容 -->
			<ul class="recommend-content">
				<li>
					<div class="virtual-bg">
						<!-- canvas实现了背景虚拟化效果 -->
						<canvas id="canvas" width="308" height="308"></canvas>
						<!-- 鼠标浮动的遮罩 -->
						<div class="mask"></div>
						<!-- 中间人物头像 -->
						<a href="" class="avatar"></a>
						<!-- 右边小箭头 -->
						<div class="arrow"></div>
					</div>
				</li>
				<li>
					<div>
						<!-- 上面部分 -->
						<div class="toppart">
						<!-- people人物 -->
							<!-- “人物”两个字svg -->
							<div class="people"></div>
							<div class="title">
								<a href="#">伊嘎绿</a>
							</div>
							<!-- 评论 -->
							<div class="comment">
								<span>2947 采集</span>
								<span>174 粉丝</span>
							</div>
							<div class="mask"></div>
						</div>
						<!-- 下面部分 -->
						<div class="bottompart">
						<!-- palette画板 -->
							<!-- “画板”两个字svg -->
							<div class="palette">
							</div>
							<div class="title">
								<a href="#">◎ 脑洞大开的创意合成</a>
							</div>
							<div class="comment">
								<span>203 采集</span>
								<span>428 粉丝</span>
							</div>
							<div class="from">
								<span>来自</span>
								<a href="">来自佐饮将进酒</a>
							</div>
							<div class="mask"></div>
						</div>
					</div>
				</li>
				<!-- 数据填充开始 -->
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<!-- 数据填充完毕 -->
			</ul>
			<div class="loadMore">
				加载更多
			</div>
			<div class="classify">
				<span>以分类浏览花瓣</span>
				<a href="#">所有采集></a>
			</div>
			<div class="classify_content">
				<table>
					<tr>
						<td><a href="#">UI/UX</a></td>
						<td><a href="#">工业设计</a></td>
						<td><a href="#">儿童</a></td>
						<td><a href="#">动漫</a></td>
						<td><a href="#">生活百科</a></td>
					</tr>
					<tr>
						<td><a href="#">平面</a></td>
						<td><a href="#">摄影</a></td>
						<td><a href="#">宠物</a></td>
						<td><a href="#">建筑设计</a></td>
						<td><a href="#">教育</a></td>
					</tr>
					<tr>
						<td><a href="#">插画/漫画</a></td>
						<td><a href="#">造型/美妆</a></td>
						<td><a href="#">美图</a></td>
						<td><a href="#">人文艺术</a></td>
						<td><a href="#">运动</a></td>
					</tr>
					<tr>
						<td><a href="#">家居/家装</a></td>
						<td><a href="#">美食</a></td>
						<td><a href="#">明星</a></td>
						<td><a href="#">数据图</a></td>
						<td><a href="#">搞笑</a></td>
					</tr>
					<tr>
						<td><a href="#">女装/搭配</a></td>
						<td><a href="#">旅行</a></td>
						<td><a href="#">美女</a></td>
						<td><a href="#">游戏</a></td>
					</tr>
					<tr>
						<td><a href="#">男士/风尚</a></td>
						<td><a href="#">手工/布艺</a></td>
						<td><a href="#">礼物</a></td>
						<td><a href="#">汽车/摩托</a></td>
					</tr>
					<tr>
						<td><a href="#">婚礼</a></td>
						<td><a href="#">健身/舞蹈</a></td>
						<td><a href="#">极客</a></td>
						<td><a href="#">电影/图书</a></td>
					</tr>
				</table>
			</div>
		</div>
		<!-- 页面底部 -->
		<footer>
			<!-- info保证缩放居中 -->
			<div class="info">
				<div class="ft homepage">
					<a href="" class="title">花瓣首页</a>
					<a href="">花瓣采集工具</a>
					<a href="">花瓣官方博客</a>
				</div>
				<div class="ft contact">
					<a href="" class="title">联系与合作</a>
					<a href="">联系我们</a>
					<a href="">用户反馈</a>
					<a href="">花瓣logo标准文档</a>
				</div>
				<div class="ft client">
					<a href="" class="title">移动客户端</a>
					<a href="">花瓣iphone版</a>
					<a href="">花瓣Android版</a>
					<a href="">花瓣HD</a>
				</div>
				<div class="ft about">
					<p class="title">关注我们</p>
					<a href="">新浪微博:@花瓣网</a>
					<a href="">官方QQ:188126952</a>
					<img class="realname" src="img/sm.png" alt="">
				</div>
			</div>
			<!-- 版权信息 -->
			<div class="copyright">
				© Huaban 杭州纬聚网络有限公司|浙公网安备 33010602001878号
			</div>
		</footer>
	<!-- 注册弹出页 -->
		<div class="registerModel">
			<div class="rm_content">
				<span class="closeBtn">X</span>
				<img src="img/logo.svg" alt="">
				<p>使用用户名注册</p>
				<form id="regForm" action="">
					<input name="username" class="username" type="text" placeholder="字母开头字母数字组成6-11位">
					<br>
					<input name="pwd" class="password" type="text" placeholder="字母数字下划线组成8-15位">
					<br>
					<div class="validCode">
						<input name="validCode" class="valid" type="text" placeholder="请输入验证码">
						<!-- <img src="img/yzm.gif" alt=""> -->
						<img id="validImg" onclick="changeValidCode();" src="php/validCode.php" alt="">
					</div>
					<br>
				</form>
				<button class="btn_register">注册</button>
			</div>
		</div>
	<!-- 登录弹出页 -->
		<div class="loginModel">
			<div class="lm_content">
				<span class="closeBtn_login">X</span>
				<img src="img/logo.svg" alt="">
				<p>使用第三方账号登录</p>
				<div class="other_login"></div>
				<form id="logForm" action="">
					<input name="username" class="username" type="text" placeholder="输入花瓣网账号">
					<br>
					<input name="pwd" class="password" type="text" placeholder="输入密码">
					<br>
				</form>
				<br>
				<button class="btn_login">登录</button>
				<p class="gotoReg">还没有账号<a href="#">点击注册</a></p>
			</div>
		</div>
	</div>
</body>

<!-- 登录注册相关JS -->
<script src='js/account.js'></script>
	
<script>

	function person_click(){
		window.location.href="info.php?c=1"; 
	}
	function love_click(){
		window.location.href="info.php?c=2"; 
	}
	function exit_click(){
		window.location.href="php/login_out.php";
	}
// 更换验证码
function changeValidCode(){
	$('#validImg').attr('src','php/validCode.php');
}
// 轮播
    var banner_index = 1;
    
	setInterval(function(){
		if(banner_index >4){
			banner_index = 1;
		}
		var pt = 'url(img/banner_' + banner_index + '.jpg)';
		$('.banner').css({'background-image':pt});
		banner_index++;
	},5000);
// 推荐第一个li标签背景虚化效果（可以忽略，用到了html5知识）
	var canvas = document.getElementById('canvas');
    var ctx = canvas.getContext('2d');
    // 创建新 image 对象，用作图案
    var img = new Image();
    img.src = 'img/ym.jpg';
    img.onload = function(){
        // 创建图案
        var ptrn = ctx.createPattern(img,'no-repeat');
        ctx.fillStyle = ptrn;
        ctx.fillRect(0,0,canvas.width,canvas.height);
        // 必须要启动本地服务器，否则存在跨域
        StackBlur.canvasRGB(canvas, 0, 0, canvas.width, canvas.height, 50);
    }

// 页面滚动头部变换
    window.onscroll = function(){ 
		var t = document.documentElement.scrollTop || document.body.scrollTop;  //获取距离页面顶部的距离
		// 导航条（滚动的时候改变导航条背景色）
		var navbar = $('.header_navbar');
		// 发现、最新、美思...滚动的时候改变字体颜色
		var navItems = $('.header_nav a');
		// 滚动的时候改变logo（红色和白色logo）
		var logo = $('.logo a');
		// 动态显示导航的搜索区域
		var header_search = $('.header_search');
		// 滚动的时候切换导航右边的登录按钮样式
		var loginBtn = $('.login');

		//当距离顶部超过25px时
		if( t >= 250 ) { 
			navbar.css("background-color",'white');
			navItems.css("color",'black');
			navItems.eq(0).css("color",'#C90000');
			logo.css("background-image","url(img/logo.svg)");
			header_search.fadeIn('fast');
			loginBtn.css({"background-color":"#F4F4F4","border":"1px solid #DDDDDD","color":'black'});

		} else {
			navbar.css("background-color",'transparent');
			navItems.css("color",'white');
			logo.css("background-image","url(img/logo_wt.svg)");
			header_search.fadeOut('fast');
			loginBtn.css({"background-color":"transparent","border":"1px solid white","color":'white'});
		} 
	} 
	$('.go').on('click', function(event) {
		var search_input = $(this).prev().val();
		window.location.href = "search.php?input="+search_input;
	});
</script>
</html>