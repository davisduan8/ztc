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
<div style="float: right; width: auto; margin-top:10px;">
<span style="display: block; width: 120px; border-right: 1px solid rgb(204, 204, 204); text-align: center; float: left; border-bottom: 3px solid orange; color: orange;">
  1.填写信息</span>
<span style="display: block; width: 120px; border-right: 1px solid rgb(204, 204, 204); text-align: center; float: left; border-bottom: 3px solid rgb(204, 204, 204);">
  2.上传资料</span>
<span style="display: none; width: 120px; border-right: 1px solid rgb(204, 204, 204); text-align: center; float: left; border-bottom: 3px solid rgb(204, 204, 204);">
  3.选择专家</span>
  <span style="display: block; width: 120px; text-align: center; float: left; border-bottom: 3px solid rgb(204, 204, 204);">
  3.完成申请</span>
</div>
<div style="clear:both;"></div>


<?php echo $this->renderPartial('_form', array('model'=>$info_model));?>
