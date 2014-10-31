<?php
$this->breadcrumbs=array(
	'主界面',
);
?>
<div class="clearfix part1">
	<p>
		<em class="txt1">已审核会诊</em>
	</p>
</div>


<table class="biao1">
	<tr class="baio1_tit baio1_tit2">
		<td>会诊编号</td>
		<td>患者姓名</td>
		<td>申请时间</td>
		<td>会诊时间</td>
		<td>申请端</td>
		<td>预约状态</td>
		<td>操作</td>
	</tr>
	<?php
		foreach ($shenhe as $key => $val) {
	?>
	<tr>
		<td><?php echo $val['id'];?></td>
		<td><?php echo $val['p_name'];?></td>
		<td><?php echo $val['creattime'];?></td>
		<td><?php echo $val['pre_time'];?></td>
		<td><?php echo $val['h_name'];?></td>
		<td><?php echo $val['status'];?></td>
		<td><a href="<?php echo Consultation::model()->getUrl(Yii::app()->user->id,strtotime($val['creattime']).$val['id'],Yii::app()->user->username,Yii::app()->user->role);?>" target="_blank"  class="c_fe8c1b">会诊</a></td>
	</tr>
	<?php } ?>
</table>