<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 查看用户';
$this->breadcrumbs=array(
	'查看用户',
);

?>
<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
		'username',
		array(
			'label'=>'role',
			'name'=>array($this, 'selectrole'),
		),
		//'last_login_time',
		array(
			'label'=>'最后登录时间',
			'type'=>'raw',
			'value'=>date("Y-m-d h:m:s", $model->last_login_time),
		),
		'last_login_ip',
		'login_num',
		)
		
));
?>