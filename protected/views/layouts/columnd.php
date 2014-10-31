<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<!-- 栏目导航 -->
		<div class="side_menu rel">
			<dl>
				<dt>栏目导航</dt>
				<dd class="line"></dd>
				<dd class="cur">
					<a href="./index.php?r=doctor/addhz" class="ico5">普通会诊</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=doctor/dicomhz" class="ico5">影像会诊</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=doctor/waithz" class="ico7">待处理会诊</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=doctor/endhz" class="ico8">已完成会诊</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=doctor/xginfo" class="ico6">修改资料</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=doctor/xgps" class="ico6">修改密码</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=doctor/zjlist" class="ico2">专家列表</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=doctor/zjpaiban" class="ico9">排班表管理</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=doctor/departzl" class="ico4">问诊准备</a>
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
						'homeLink'=>CHtml::link('首页',Yii::app()->homeUrl.'?r=doctor/index',array('class'=>'c_f5780a')), 
					)); ?><!-- breadcrumbs -->
				<?php endif?>
			</div>
			<div class="main_box">
			<?php echo $content; ?>
			</div>
		</div>
<?php $this->endContent(); ?>