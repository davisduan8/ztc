<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 管理员界面';
$this->breadcrumbs=array(
	'主界面',
);
?>
<div class="clearfix part1">
	<p>
		<em class="txt1">待审核会诊</em>
	</p>
</div>

<table class="biao1">
	<tr class="baio1_tit baio1_tit2">
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
	<tr>
		<td><?php echo $v['id'];?></td>
		<td><?php echo $v['p_name'];?></td>
		<td><?php echo $v['creattime'];?></td>
		<td><?php echo $v['pre_time'];?></td>
		<td><?php echo $v['ename'];?></td>
		<td><?php echo $v['status'];?></td>
		<td class="noborr"><a href="index.php?r=admin/verify&id=<?php echo $v['id'];?>" class="c_fe8c1b">资料审核</a></td>
	</tr>
	<?php } ?>
</table>


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
		<td>预约专家</td>
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
		<td><?php echo $val['end_time'];?></td>
		<td><?php echo $val['ename'];?></td>
		<td><?php echo $val['status'];?></td>
		<td></td>
	</tr>
	<?php } ?>
</table>