<?php
$this->breadcrumbs=array(
	'申请会诊',
);
?>
<div class="box2">
	<strong class="box2_tit">申请普通会诊</strong>
		<ul class="clearfix lc_step">
			<li class="cur">1. 填写资料</li>
			<li class="lc_step_jt"></li>
			<li>2. 上传资料</li>
			<li class="lc_step_jt"></li>
			<li>3. 完成申请</li>
		</ul>


<?php echo $this->renderPartial('_form', array('model'=>$info_model));?>
