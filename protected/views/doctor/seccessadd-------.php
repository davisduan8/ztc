<?php
$this->breadcrumbs=array(
	'申请会诊',
);
if(empty($_GET['cid'])){
  $this->redirect('index.php?r=doctor/errors');  
    exit; 
}
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
<span style="display: block; width: 120px; border-right: 1px solid rgb(204, 204, 204); text-align: center; float: left; border-bottom: 3px solid rgb(204, 204, 204);">
  1.填写信息</span>
<span style="display: block; width: 120px; border-right: 1px solid rgb(204, 204, 204); text-align: center; float: left; border-bottom: 3px solid rgb(204, 204, 204);">
  2.上传资料</span>
<span style="display: none; width: 120px; border-right: 1px solid rgb(204, 204, 204); text-align: center; float: left; border-bottom: 3px solid rgb(204, 204, 204);">
  3.选择专家</span>
  <span style="display: block; width: 120px; text-align: center; float: left; border-bottom: 3px solid orange; color: orange;">
  3.完成申请</span>
</div>
<div style="clear:both;"></div>
<div style="text-align:center;margin-bottom:10px;margin-top:10px;"><strong>完成申请</strong></div>
<table width="90%" border="1" cellpadding="2" cellspacing="1" style="border:#669900 2px solid">

  <tr style="background-color:#99cc66;align:center;">
	<th>会诊编号</th><th>患者姓名</th><th>性别</th><th>身份证号</th><th>预约时间</th><th>预约专家</th><th>站点ID</th>
	</tr>
  <tr border="1px" bordercolor="red">
    <td id="hzid"><?php echo $model['id'];?></td>
    <td><?php echo $model['p_name'];?></td>
    <td><?php echo $model['p_sex'];?></td>
    <td><?php echo $model['p_card'];?></td>
    <td><?php echo $model['pre_time'];?></td>
    <td><?php echo $model['expertid']==null? "":$model->expert->ename; //echo $model->expert->ename;?></td>
    <td><?php echo $model['siteid'];?></td>
  </tr>
</table>


