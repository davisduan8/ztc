<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 专家列表';
$this->breadcrumbs=array(
	'专家列表',
);
?>
<div class="clearfix part1">
	<p>
		<span class="btn1 btn_cur">专家列表</span>
	</p>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$model->searchsitezj($groupsite),
		//'filter'=>$model,
		'summaryText'=>'',
		'cssFile'=>'/css/duan.css',
		'columns'=>array(
	        	array('header'=>'编号','name'=>'userid','type'=>'raw',),
				array('header'=>'专家姓名','name'=>'ename','type'=>'raw',),
                array('header'=>'性别','name'=>'sex'),
				//array('header'=>'所在科室','name'=>'departid'),
				array(
					'header'=>'所在科室',
					'name'=>'departid',
					'filter'=>false,
					'value'=>'$data->departid == null? $data->departid :$data->getDepartname($data->departid)',
					),
				
				array('header'=>'职称','name'=>'position'),
				array(
					'header'=>'所在医院',
					'name'=>'hospitalid',
					'filter'=>false,
					'value'=>'$data->hospitalid == null? $data->hospitalid :$data->getExname($data->hospitalid)',
					),

		),
		/*'pager'=>array(
		'header'=>'',//去掉翻页
		)*/
));
?>