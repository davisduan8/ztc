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
		<label class="btn1">专家排班表</label>
	</p>
</div>

<table class="biao1">
	<tr class="baio1_tit">
	<td>日期</td>
	<td>星期</td>
	<td>上午/下午</td>
	<td>是否坐班</td>
</tr>
<?php
$loginId = Yii::app()->user->id;
foreach($paiban as $val){
	echo "<tr>";
	echo "<td>".$val->dateid."</td>";
	echo "<td>".transition($val->dateid)."</td>";
	if($val->item ==1){
		echo "<td>上午</td>";
	}elseif($val->item == 2){
		echo "<td>下午</td>";
	}

	$r=explode(",",$val->zjdata);
	echo "<td>";
		foreach ($r as $vo){
			echo $vo == $loginId?'√':'';	
		}
	echo "</td>";
	
	echo "</tr>";
}

?>
</table>
<?php 
function transition ($date) {
	$weekarray=array("日","一","二","三","四","五","六");
	$datearr = explode("-", $date); //将传来的时间使用“-”分割成数组
	$year = $datearr[0];    //获取年份
	$month = sprintf('%02d', $datearr[1]);  //获取月份 
	$day = sprintf('%02d', $datearr[2]);    //获取日期
	$hour = $minute = $second = 0;  //默认时分秒均为0
	$dayofweek = mktime($hour, $minute, $second, $month, $day, $year);  //将时间转换成时间戳
	$week = date("w", $dayofweek);   //获取星期值
	return "星期".$weekarray[$week];
}
?>