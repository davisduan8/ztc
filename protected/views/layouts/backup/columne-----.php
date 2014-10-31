<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<style type="text/css">
html{height:110%;}
.con{width:1160px; margin:0 auto; min-height:100%;}
.con .con_left{float:left; width:150px;}
.con .con_left p{font-size:18px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; padding:15px 20px; margin:0px; text-align:center;}
.con .con_left ul{}
.con .con_left ul li{height:30px; list-style-type:none; width:120px; text-align:center; background-color:#EFEFEF; border:1px solid #E8E8E8; margin-bottom:15px; line-height:30px;}
.con .con_left ul li a{text-decoration:none;}
.con .con_left ul li a:hover{color:#FF6600;}
.con .con_right{float:right; width:980px;}
</style>
<div class="con">
	<div class="con_left">
		<p>栏目导航</p>
		<ul>
		        <li><a href="./index.php?r=expert/exdcl">待处理会诊</a></li>
			<li><a href="./index.php?r=expert/exdohz">已完成会诊</a></li>
			<li><a href="#">排班表管理</a></li>
			<li><a href="#">修改资料</a></li>
			<li><a href="./index.php?r=expert/exalterps">修改密码</a></li>
		</ul>
	</div>
	<div class="con_right">
		<div id="content">
			<?php echo $content; ?>
		</div>
	</div>
</div>
<?php $this->endContent(); ?>