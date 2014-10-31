<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<!-- 栏目导航 -->
		<div class="side_menu rel">
			<dl>
				<dt>栏目导航</dt>
				<dd class="line"></dd>
				<dd class="cur">
					<a href="./index.php?r=manage/site" class="ico1">站点管理</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=manage/user" class="ico2">用户管理</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=manage/useradd" class="ico3">新建用户</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=manage/departzl" class="ico4">问诊准备</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=manage/depart" class="ico5">科室管理</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=manage/editps" class="ico6">修改密码</a>
				</dd>
				<dd class="line"></dd>
			</dl>
		</div>
		<!-- 栏目导航 -->
		<!-- 右侧内容 -->
		<div class="main_con">
			<div class="here">
				<?php if(isset($this->breadcrumbs)):?>
					<?php $this->widget('zii.widgets.CBreadcrumbs', array(
						'links'=>$this->breadcrumbs,
						'homeLink'=>CHtml::link('首页',Yii::app()->homeUrl.'?r=manage/index',array('class'=>'c_f5780a')), 
					)); ?><!-- breadcrumbs -->
				<?php endif?>
			</div>
			<div class="main_box">
			<?php echo $content; ?>
			</div>
		</div>
<?php $this->endContent(); ?>
