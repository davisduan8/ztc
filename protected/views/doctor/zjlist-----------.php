<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 专家列表';
$this->breadcrumbs=array(
	'专家列表',
);
?>
<style type="text/css">
dl{margin:0px; padding:0px;}
.h_flm{width:100%; height:35px; border-bottom:1px dotted #D2D2D2; padding-bottom:5px;}
.h_flm dt{width:100px; height:35px; background-color:#68AD5C; float:left; text-align:center; line-height:35px; color:#FFFFFF; border:1px solid #D2D2D2; margin-right:15px;}
.grid-view table.items{border-collapse:inherit;}
.grid-view table.items th{ background-image:none; background-color:#68AD5C;}
.grid-view table.items th, .grid-view table.items td{height:25px; text-align:center;}
.grid-view table.items #yw0_c0{width:70px;}
</style>
<dl class="h_flm">
	<dt>专家列表</dt>
	<!-- <dt><a href="index.php?r=admin/hospitaladd">增加医院</a></dt>  -->
</dl>
<div style="clear:both"></div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$model->searchzj(),
		//'filter'=>$model,
		'summaryText'=>'',
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