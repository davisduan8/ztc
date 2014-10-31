<?php
$this->breadcrumbs=array(
	'会诊详细信息',
);

$this->menu=array(
	array('label'=>'新增会诊', 'url'=>array('addhz')),
	array('label'=>'待处理会诊', 'url'=>array('waithz')),

);
?>

<div class="clearfix part1">
    <p>
        <label class="btn1 btn_cur">处理会诊信息</label>
    </p>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
    'cssFile'=>'/css/duan.css',
	'attributes'=>array(
            'id',
            'p_name',
            'p_age',
            'p_sex',
            'p_mobile',
            'illness',
            'status'
        )));

?>