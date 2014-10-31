<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 排班列表';
$this->breadcrumbs=array(
	'排班列表',
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
table{border-spacing:1px; width:80%;}
</style>
<dl class="h_flm">
	<dt>专家排班表</dt>
</dl>
<div style="clear:both"></div>
<br />

<table cellpadding="2" cellspacing="1" border="0" bgcolor="#D0E3EF">
<tr>
	<td bgcolor="#68AD5C" height="30">日期</td>
	<td bgcolor="#68AD5C">星期</td>
	
	<td bgcolor="#68AD5C">上午/下午</td>
	<td bgcolor="#68AD5C">是否坐班</td>
</tr>
<?php
$loginId = Yii::app()->user->id;
foreach($paiban as $val){
	echo "<tr>";
	echo "<td bgcolor='#FFFFFF'>".$val->dateid."</td>";
	echo "<td bgcolor='#FFFFFF'>".transition($val->dateid)."</td>";
	if($val->item ==1){
		echo "<td bgcolor='#FFFFFF'>上午</td>";
	}elseif($val->item == 2){
		echo "<td bgcolor='#FFFFFF'>下午</td>";
	}

	$r=explode(",",$val->zjdata);
	echo "<td bgcolor='#FFFFFF'>";
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