<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 用户列表';
$this->breadcrumbs=array(
	'用户列表',
);
?>
<style type="text/css">
dl{margin:0px; padding:0px;}
.h_flm{width:100%; height:35px; border-bottom:1px dotted #D2D2D2; padding-bottom:5px;}
.h_flm dt{width:100px; height:35px; background-color:#68AD5C; float:left; text-align:center; line-height:35px; color:#FFFFFF; border:1px solid #D2D2D2; margin-right:15px;}
.grid-view table.items{border-collapse:inherit;}
.grid-view table.items th{ background-image:none; background-color:#68AD5C;}
.grid-view table.items th, .grid-view table.items td{height:25px; text-align:center;}
.grid-view table.items #yw0_c0{width:60px;}
.grid-view table.items #yw0_c1{width:100px;}
.grid-view table.items #yw0_c2{width:80px;}
.grid-view table.items #yw0_c3{width:80px;}
.grid-view table.items #yw0_c5{width:80px;}
</style>
<dl class="h_flm">
	<dt>用户列表</dt>
	<dt><a href="index.php?r=manage/useradd">用户增加</a></dt>
</dl>
<div style="clear:both"></div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$users->search(),
		'filter'=>$users,
		'template'=>'{summary}{items}{pager}',
		'summaryText'=>'页数：{pages}/{page}页',
		'columns'=>array(
			array('header'=>'编号','name'=>'id','filter'=>false, ),
			array('header'=>'所属站点','name'=>'siteid','value'=>'$data->getSite($data->siteid)',),
			'username',
			array(
				'name'=>'role',
				//'value'=>'$data->role',
				'value'=>array($this, 'selectrole'),
				'type'=>'raw',
				'filter'=>false,
						 
			),
			array(
				'header'=>'最后登录时间',
				//'name'=>'last_login_time', 
				'value'=>'date("Y-m-d h:m:s", $data->last_login_time)',
				'type'=>'raw',         
			),


			array('header'=>'登录次数','name'=>'login_num','filter'=>false, ),
			array(    
				'header'=>'操作',  
				'class'=>'CButtonColumn',     
				'deleteConfirmation'=>'确认要删除?', 
				'template'=>'{update}&nbsp;&nbsp;&nbsp;{delete}', 
				//'viewButtonUrl'=>'Yii::app()->createUrl("admin/userview",array("id"=>$data->id))',
				'updateButtonUrl'=>'Yii::app()->createUrl("manage/userupdate",array("id"=>$data->id))',
				'deleteButtonUrl'=>'Yii::app()->createUrl("manage/userdelete",array("id"=>$data->id,"role"=>$data->role))',    
				), 
			array(
				'header'=>'重置', 
				'class'=>'CLinkColumn',
				'label'=>'重置',
				'urlExpression' => 'Yii::app()->createURL("manage/resetpass",array("id"=>$data->id))', 
				 'htmlOptions'=>array('onclick'=>'js:return confirm("确认重置密码?")'),   
			),

		),
		'pager'=>array(
			//'class'=>'CLinkPager',
			'header'=>'',//去掉翻页
			//'pageSize'=>'10',
		),

));
?>