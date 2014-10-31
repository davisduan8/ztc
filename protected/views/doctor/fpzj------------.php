<?php
$this->breadcrumbs=array(
	'申请会诊',
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
	<dt>申请常规会诊</dt>
</dl>

<div style="clear:both"></div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$ztcexpert->search(),
		'summaryText'=>'',
		'columns'=>array(
		       array('header'=>'编号','name'=>'userid'),
                       array(
                          'selectableRows' => 1,  //可以配置CGridView::selectableRows 如果是0，则不能选，如果 1,只选一个如果是2或其它值，则可以选多个
                            'header'=>'选择',
                          //  'footer' => '<button type="button" onclick="GetCheckbox();" style="width:76px">批量删除</button>',
                            'class' => 'CCheckBoxColumn',
                            'headerHtmlOptions' => array('width'=>'33px'),
                            'checkBoxHtmlOptions' => array('name' => 'selectdel'),
                         ),
			array('header'=>'点名专家','name'=>'ename'),
                        array('header'=>'性别','name'=>'sex'),
                       /* array('header'=>'科室','name'=>'departid'),
                        array('header'=>'所在医院','name'=>'hospitalid'),*/
                        array(
                          'header'=>'科室',
                          'name'=>'departid',
                          'value'=>'$data->departid ==null? $data->departid :$data->getDepartname($data->departid)',
                          ),
                        array(
                          'header'=>'所在医院',
                          'name'=>'hospitalid',
                          'value'=>'$data->hospitalid == null? $data->hospitalid :$data->getExname($data->hospitalid)',
                          ),
                        array('header'=>'专长','name'=>'skilled'),
//                      array('header'=>'出诊类型','点名专家'),
//			array(     
//				'header'=>'操作',
//				'class'=>'CButtonColumn',     
//				'deleteConfirmation'=>'确认要删除?', 
//				'template'=>'{delete}',
//				'deleteButtonUrl'=>'Yii::app()->createUrl("doctor/zjdel",array("userid"=>$data->userid))',    
//				), 

		),
		/*'pager'=>array(
		'header'=>'',//去掉翻页
		)*/
    
));

?>
<input type="hidden" name="cid">
<div class="h_y_botton">
    <?php /* echo CHtml::imageButton(Yii::app()->baseUrl.'/images/tijao.gif',array('submit' => 'index.php?r=doctor/zjgx/')); */?>
    <button type="button" onclick="GetBox();" style="width:76px">提交</button>
    
</div>
<script>
function GetBox(){
    var opt = document.getElementsByName('selectdel');
    var  linkStr = "<?php echo Yii::app()->request->hostInfo.Yii::app()->urlManager->createUrl('doctor/cxzj&cid='.$_GET['cid']);?>"; //提交URL,自己改造
    for(i=0;i<opt.length;i++){
          if(opt[i].checked==true){
           linkStr+="&selectdel="+opt[i].value;
        }
    }
   // alert(linkStr);//调试后删除
    javascript:window.location=linkStr;
}


</script>