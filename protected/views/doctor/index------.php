<?php
$this->breadcrumbs=array(
	'主界面',
);
?>
<style type="text/css">
	table{border-spacing:1px;}
	.trlm td{background-color: #68AD5C; color: #FFF; text-align: center; height: 30px; font-weight: 700; font-size:14px;}
	.trli td{background-color: #FFFFFF; height: 25px; text-align: center;}
	.trli td a{color: #09f;}
	.plm{font-size: 16px; font-weight: bold;}
	.trli{cursor: pointer;}
</style>
<p class="plm">待审核会诊</p>
<table cellspacing="1" cellpadding="2" border="0" bgcolor="#CCC">
	<tr class="trlm">
		<td>会诊编号</td>
		<td>患者姓名</td>
		<td>申请时间</td>
		<td>预约时间</td>
		<td>预约专家</td>
		<td>预约状态</td>
		<td>操作</td>
	</tr>
	<?php
		foreach ($noshenhe as $k => $v) {
	?>
	<tr class="trli">
		<td><?php echo $v['id'];?></td>
		<td><?php echo $v['p_name'];?></td>
		<td><?php echo $v['creattime'];?></td>
		<td><?php echo $v['pre_time'];?></td>
		<td><?php echo $v['ename'];?></td>
		<td><?php echo $v['status'];?></td>
		<td><a href="index.php?r=doctor/viewsq&cid=<?php echo $v['id'];?>">查看</a> <a href="index.php?r=doctor/editsq&cid=<?php echo $v['id'];?>">修改</a></td>
	</tr>
	<?php } ?>
</table>
<p class="plm">已审核会诊</p>
<table cellspacing="1" cellpadding="2" border="0" bgcolor="#CCC">
	<tr class="trlm">
		<td>会诊编号</td>
		<td>患者姓名</td>
		<td>申请时间</td>
		<td>预约时间</td>
		<td>预约专家</td>
		<td>预约状态</td>
		<td>操作</td>
	</tr>
	<?php
		foreach ($shenhe as $key => $val) {
	?>
	<tr class="trli">
		<td><?php echo $val['id'];?></td>
		<td><?php echo $val['p_name'];?></td>
		<td><?php echo $val['creattime'];?></td>
		<td><?php echo $val['pre_time'];?></td>
		<td><?php echo $val['ename'];?></td>
		<td><?php echo $val['status'];?></td>
		<td><a href="<?php echo Consultation::model()->getUrl(Yii::app()->user->id,strtotime($v['creattime']).$v['id'],Yii::app()->user->username,Yii::app()->user->role);?>" target="_blank">会诊</a></td>
	</tr>
	<?php } ?>
</table>

  