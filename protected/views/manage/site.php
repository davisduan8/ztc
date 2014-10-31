<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 站点列表';
$this->breadcrumbs=array(
	'站点列表',
);

?>
				<div class="clearfix part1">
					<p>
						<a href="#" class="btn1 btn_cur">站点列表</a>
						<a href="index.php?r=manage/siteadd" class="btn2">增加站点</a>
					</p>
				</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$site->search(),
		//'template'=>'{summary}{items}{pager}',
		//'summaryText'=>'页数：{pages}/{page}页',
		'cssFile'=>'/css/duan.css',
		'summaryText'=>'',
		'columns'=>array(
			array('header'=>'编号','name'=>'id'),
			array('header'=>'站点名称','name'=>'sitename'),
			array(     
				'header'=>'操作',
				'class'=>'CButtonColumn',     
				'deleteConfirmation'=>'确认要删除?', 
				'template'=>'{delete}',
				'deleteButtonUrl'=>'Yii::app()->createUrl("manage/sitedel",array("id"=>$data->id))',    
				), 

		),
		/*'pager'=>array(
		'header'=>'',//去掉翻页
		)*/
));
?>