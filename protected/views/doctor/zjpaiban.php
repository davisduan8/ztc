<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 排班列表';
$this->breadcrumbs=array(
	'排班列表',
);
?>
<div class="clearfix part1">
	<p>
		<span class="btn1 btn_cur">专家排班表</span>
	</p>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$paiban->search(),
		//'template'=>'{summary}{items}{pager}',
		//'summaryText'=>'页数：{pages}/{page}页',
		'summaryText'=>'',
		'cssFile'=>'/css/duan.css',
		'columns'=>array(
			array('header'=>'编号','name'=>'id'),
			array('header'=>'出诊日期','name'=>'dateid'),
			array('header'=>'上午/下午','name'=>'item','value'=>'$data->moning($data->item)'),
			array(
				'header'=>'出诊专家',
				'name'=>'zjdata',
				'value'=>'$data->zjname($data->zjdata)',
				'type'=>'raw',
				),
			/*array(
				'header'=>'操作', 
				'class'=>'CLinkColumn',
				'label'=>'删除',
				'urlExpression' => 'Yii::app()->createURL("admin/paibandel",array("id"=>$data->id))',   
				//'urlExpression' => array($this, 'selectwansan'),         
			),
			
			*/
			/*array(
				'name'=>'role',
				//'value'=>'$data->role',
				'value'=>array($this, 'selectrole'),
				'type'=>'raw',
						 
			),
			array(
				'header'=>'最后登录时间',
				//'name'=>'last_login_time', 
				'value'=>'date("Y-m-d h:m:s", $data->last_login_time)',
				'type'=>'raw',            
			),

			

			'login_num',*/
			/*array(     
				'class'=>'CButtonColumn',     
				'deleteConfirmation'=>'确认要删除?', 
				'viewButtonUrl'=>'Yii::app()->createUrl("admin/userview",array("id"=>$data->id))',
				'updateButtonUrl'=>'Yii::app()->createUrl("admin/userupdate",array("id"=>$data->id))',
				'deleteButtonUrl'=>'Yii::app()->createUrl("admin/userdelete",array("id"=>$data->id))',    
				), */

		),

		//'pager'=>array(
		//'header'=>'',//去掉翻页
		//)
));
?>