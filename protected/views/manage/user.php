<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 用户列表';
$this->breadcrumbs=array(
	'用户列表',
);
?>
				<div class="clearfix part1">
					<p>
						<a href="#" class="btn1 btn_cur">用户列表</a>
						<a href="index.php?r=manage/useradd" class="btn2">用户增加</a>
					</p>
					<div class="search">
						<label>搜索：</label>
						<p>
							<input type="text" value="患者、预约专家" onfocus="this.value=''" onblur="if(this.value=='')this.value='患者、预约专家'" class="search_txt" />
							<input type="button" value="" class="search_btn" />
						</p>
					</div>
				</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$users->search(),
		//'filter'=>$users,
		'template'=>'{summary}{items}{pager}',
		'summaryText'=>'',
		'cssFile'=>'/css/duan.css',
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
			'cssFile'=>'/css/duan.css',
			//'pageSize'=>'10',
		),

));
?>