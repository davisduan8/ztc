<?php
$this->breadcrumbs=array(
	//$model->title=>$model->url,
	'待处理会诊',
);
?>

<h3>更新数据 <i><?php /*echo CHtml::encode($model->title); */?></i></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>