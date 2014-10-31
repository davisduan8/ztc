<?php
$this->breadcrumbs=array(
	'会诊详细信息',
);

$this->menu=array(
	array('label'=>'新增会诊', 'url'=>array('addhz')),
	array('label'=>'待处理会诊', 'url'=>array('waithz')),

);
?>
<span><h3>待处理会诊详细信息</h3></span>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            'id',
            'p_name',
            'p_age',
            'p_sex',
            'p_mobile',
            'illness',
        )));

?>