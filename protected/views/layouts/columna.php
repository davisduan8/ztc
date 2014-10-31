<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<!-- 栏目导航 -->
		<div class="side_menu rel">
			<dl>
				<dt>栏目导航</dt>
				<dd class="line"></dd>
				<dd class="cur">
					<a href="./index.php?r=admin/dclhz" class="ico7">待处理会诊</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=admin/ywhz" class="ico8">已完成会诊</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=admin/paiban" class="ico9">排班表管理</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=admin/editps" class="ico6">修改密码</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=admin/user" class="ico2">用户管理</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=admin/useradd" class="ico3">新建用户</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=admin/hospital" class="ico10">医院管理</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=admin/depart" class="ico11">科室管理</a>
				</dd>
				<dd class="line"></dd>
				<dd>
					<a href="./index.php?r=admin/departzl" class="ico4">问诊资料</a>
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
						'homeLink'=>CHtml::link('首页',Yii::app()->homeUrl.'?r=admin/index',array('class'=>'c_f5780a')), 
					)); ?><!-- breadcrumbs -->
				<?php endif?>
			</div>
			<div class="main_box">
			<?php echo $content; ?>
			</div>
		</div>
<?php $this->endContent(); ?>
