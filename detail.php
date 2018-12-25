<?php
	session_start();
	if(isset($_SESSION['userinfo'])){
		$userinfo = $_SESSION['userinfo'][0];
	}
	include 'php/mySql.php';
	isset($_GET['id']) ? $id=$_GET['id'] : $id='';
	isset($_GET['name']) ? $username=$_GET['name'] : $username='';
	isset($_GET['portrait']) ? $portrait=$_GET['portrait'] : $portrait='';
	isset($_GET['date']) ? $uc_date=$_GET['date'] : $uc_date='';
	isset($_GET['img']) ? $img=$_GET['img'] : $img='';
	isset($_GET['page']) ? $currentPage = $_GET['page'] : $currentPage = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="sweetAlert/sweetalert.css">

	<script src='js/jquery-3.0.0/jquery-3.0.0.js'></script>
	<script src='sweetAlert/sweetalert-dev.js'></script>
	<link rel="stylesheet" href="css/common.css">
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/footer.css">
	<link rel="stylesheet" href="css/account.css">

	<style>
		/*重写头部样式*/
		.header_navbar{
			background-color:white;
		}
		.header_nav a{
			color: black;
		}
		.header_nav a:first{
			color: #C90000
		}
		.logo a{
			background-image:url(img/logo.svg);
		}
		.header_search{
			display: inline-block;
		}
		.header_rightpart .login{
			background-color:#F4F4F4;
			border:1px solid #DDDDDD;
			color:black;
		}
		/*内容部分开始*/
		body{
			background-color: #FAFAFA;
		}
		.content{
			margin-top: 114px;
			margin-bottom: 50px;
			margin-left: auto;
			margin-right: auto;
			width: 1180px;
			background-color: #FAFAFA;
		}

		.content:after{
			content: '';
			display: block;
			clear: both;
		}

		.content_L{
			width: 60%;
			float: left;
			background-color: white;
			margin-right: 20px;
			/*height: 800px;*/

			box-shadow: 0px 0px 0px 0px #B4B4B4,
			0px 7px 7px 0px #B4B4B4,
			3px 0px 3px 0px #B4B4B4,
			-3px 0px 3px 0px #B4B4B4;
		}
		.content_L .top button{
			width: 50px;
			height: 30px;
			border-radius: 5px;
			color: white;
			background-color: #D44D4E;
			border:none;
			outline: none;
		}
		.content_L .top{
			padding-top: 20px;
			padding-left: 20px;
			padding-right: 20px;
		}
		.content_L .top:after{
			content: '';
			display: block;
			clear: both;
		}
		.content_L .top .fav{
			float: left;
		}
		.content_L .top .back{
			float: right;
		}
		.mid{
			text-align: center;
		}
		.mid img{
			height: 600px;

		}
		.share{
			padding-left: 20px;
			margin-top:20px;
			margin-bottom:20px;
		}

		.content_R{
			width: 33%;
			float: right;
			/*height: 200px;*/
			background-color: white;

			box-shadow: 0px 0px 0px 0px #B4B4B4,
			0px 7px 7px 0px #B4B4B4,
			3px 0px 3px 0px #B4B4B4,
			-3px 0px 3px 0px #B4B4B4;
			padding:20px 20px 20px 20px;
		}
		.content_R .avatar{
			padding:20px 20px 20px 20px;
			font-size: 20px;
		}
		.content_R .avatar:after{
			content: '';
			display:block;
			clear: both;
		}
		.content_R .avatar img{
			float: left;
			margin-right: 20px;
		}
		.content_R .avatar .name{
			margin-top: 20px;
		}
		.content_R .avatar .date{
			color: grey;
		}
		.comment_list{
			background-color: #FAFAFA;
			padding-bottom: 20px;
		}
		.comment_list .comment_item{
			margin-bottom:10px;
		}
		.comment_list .comment_item .item_header{
			height: 50px;
			line-height: 50px;
			background-color: #FAFAFA;
		}
		.comment_list .comment_item .item_header img{
			vertical-align: middle;
			margin-left: 20px;
			margin-right: 20px;
		}
		.comment_list .comment_item .item_header .date{
			float: right;
			margin-right: 20px;
		}
		.comment_list .comment_item .item_content{
			/*height: 50px;*/
			background-color: white;
			padding:10px 10px 10px 10px;
			margin-left: 20px;
			margin-right:20px;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}
		/*分页*/
		.pager{
			width: 200px;
			margin:10px auto;
			text-align: center;
		}
		.pager .item:nth-of-type(<?php echo $currentPage?>){
			color: red;
		}
		.pager .item{
			cursor: pointer;
			margin-left: 5px;
			margin-right: 5px;
			color: black;
			text-decoration: none;
		}

		/*评论*/
		.comment textarea{
			width: 100%;
			height: 200px;
		}
		.submitComment{
			width: 50px;
			height: 30px;
			border-radius: 5px;
			color: white;
			background-color: #D44D4E;
			float: right;
			outline: none;
			border:none;
		}
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
	</style>
</head>
<body>

	<div>
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
								<input type="text" size="27" placeholder="搜索你喜欢的">
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
		</header>
		<div class="content">
			<div class="content_L">
				<div class="top">
					<button data-iid="<?php echo $id?>"" class="fav" onclick="Collection(this);">收藏</button>
					<button class="back" onclick="history.back();">返回</button>
				</div>
				<!-- 中间大图 -->
				<div class="mid">
					<img src="<?php echo $img ?>" alt="">
				</div>
				<!-- 分享 -->
				<div class="share">
					<a href="http://www.jiathis.com/share/" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank">分享到：</a>
					<a class="jiathis_button_tsina">新浪微博</a>
					<a class="jiathis_button_qzone">QQ空间</a>
					<a class="jiathis_button_weixin">微信</a>
					<a class="jiathis_button_tools_2">腾讯微博</a>
				</div>
			</div>
			<div class="content_R">
				<div class="avatar">
					<!-- 头像 -->
					<img class="userPortrait" src="<?php echo $portrait?>" alt="" width="100px" height="100px">
					<!-- username -->
					<p class="name"><?php echo $username?></p>
					<!-- 发布时间 -->
					<p class="date">
					发布于
					<span class="month">
						<?php 
							include 'php/interval.php';
							$timerSpace = diffBetweenTwoDays($uc_date,date("Y-m-d"));
							echo $timerSpace;
						 ?>
					</span>
					</p>
				</div>
				<div class="comment_list">
					<?php 
						$start = ($currentPage-1)*5;
						$sql = "select * from comment where iid = $id limit {$start},5";
						$rows = selectDB($sql);
						foreach($rows as $item){
							$uid = $item['uid'];
							$content = $item['conent'];
							$date = $item['date'];
							$sql = "select * from user where id = $uid";
							$user = selectDB($sql);

							$c_username = $user[0]['username'];
							$c_portrait = $user[0]['H_portrait'];
					?>
					<div class="comment_item">
						<div class="item_header">
							<img src="<?php echo $c_portrait?>" alt="" width="50px" height="50px">
							<span class="username"><?php echo $c_username?></span>
							<span class="date">
								<?php 
									$c_date = date('m月d日', $date);
								echo $c_date?>
							</span>
						</div>
						<div class="item_content">
							<?php echo $content?>
						</div>
					</div>
					<?php }?>
					<!-- 动态数据 -->
					
				</div>
				<!-- 分页 -->
				<div class="pager">
					<?php
						$sql = "select * from comment where iid = $id";

						$total = selectCountDB($sql);
						$total = ceil($total/5);
						if(!empty($total) && $total>1){
							echo "<span>&lt;</span>";
							for($i=1;$i<=$total;$i++){
								echo "<a href='?id=$id&name=$username&portrait=$portrait&date=$uc_date&img=$img&page=$i' class='item'>$i</a>";
							}
							echo "<span>&gt;</span>";
						}
				
					?>				
				</div>
				<div class="comment">
					<form action="">
						<textarea name="comment" id="comment" placeholder="请登录后发表评论"></textarea>
						<br>
						<input data-iid="<?php echo $id?>" data-islogin="<?php if(isset($userinfo)){echo 'true';}else{echo 'false';}?>" class="submitComment" type="button" value="评论">
					</form>
				</div>
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
	$('.go').on('click', function(event) {
		var search_input = $(this).prev().val();
		window.location.href = "search.php?input="+search_input;
	});
	function Collection(event){
		$.ajax({
			url: 'php/collection.php',
			type: 'POST',
			dataType: 'json',
			data:{'iid':$(event).data('iid')}
		})
		.done(function(data) {
			if(data.code == 0){
				showSweetAlert('收藏成功');
			}
			else{
				showSweetAlert('收藏失败');
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}
	$('.submitComment').on('click', function(event) {
		var islogin = $(this).data('islogin');
		var iid = $(this).data('iid');
		// var iid = <?php echo $id;?>;

		var content = $('#comment').val();

		if(!islogin){
			showSweetAlert('请先登录');
			return;
		}
		if(content == ''){
			showSweetAlert('请填写评论内容');
			return;
		}

		$.ajax({
			url: 'php/comment.php',
			type: 'POST',
			dataType: 'json',
			data:{'iid':iid,'content':content}
		})
		.done(function(data) {
			if(data.code == 0){
				showSweetAlert('评论成功');
				window.location.reload();
			}
			else{
				showSweetAlert('评论失败');
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	});
</script>
</html>