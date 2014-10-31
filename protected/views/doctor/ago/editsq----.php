<?php
$this->breadcrumbs=array(
	'修改会诊申请',
);

?>
<style type="text/css">
dl{margin:0px; padding:0px;}
.h_flm{width:100%; height:35px; border-bottom:1px dotted #D2D2D2; padding-bottom:5px;}
.h_flm dt{width:100px; height:35px; background-color:#68AD5C; float:left; text-align:center; line-height:35px; color:#FFFFFF; border:1px solid #D2D2D2; margin-right:15px;}
table{border-collapse:separate;
  border-spacing:1px;}
  .h_y_botton{padding-left:80px; padding-top:20px;}
</style>
<dl class="h_flm">
	<dt>修改会诊申请</dt>
</dl>
<div style="clear:both"></div>
<br />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'useradd-form')); ?>
<table width="90%" border="0" cellpadding="2" cellspacing="1" bgcolor="#68AD5C">
  <tr>
    <td width="90" height="35" bgcolor="#D2D2D2">申请医院：</td>
    <td width="200" bgcolor="#FFFFFF"><?php  echo $model->hospital->h_name;//echo $model['hospitalid'];?></td>
    <td width="90" bgcolor="#D2D2D2">会诊专家：</td>
    <td bgcolor="#FFFFFF"><?php echo $model->expert->ename;?>【<a href="<?php  echo Yii::app()->createURL("doctor/fpzj&id=".$_GET['id']);?>">重新分配</a>】</td>
    <td width="90" bgcolor="#D2D2D2">会诊时间：</td>
    <td bgcolor="#FFFFFF"><?php echo $model['pre_time']; ?></td>
  </tr>
</table>
<br />
<table width="90%" border="0" cellpadding="2" cellspacing="1" bgcolor="#68AD5C">
  <tr>
    <td width="90" height="35" bgcolor="#D2D2D2">患者姓名：</td>
    <td bgcolor="#FFFFFF"><?php echo $form->textField($model,'p_name',array('maxlength'=>40,'class'=>'inys')); ?></td>
    <td width="90" bgcolor="#D2D2D2">性别：</td>
    <td bgcolor="#FFFFFF"><?php echo $form->dropDownList($model, 'p_sex', array('男'=>'男', '女'=>'女'));//$form->textField($model,'p_sex',array('maxlength'=>3,'class'=>'inysd'));?></td>
    <td width="90" bgcolor="#D2D2D2">年龄：</td>
    <td bgcolor="#FFFFFF"><?php echo $form->textField($model,'p_age',array('maxlength'=>3,'class'=>'inysd'));//echo $model['p_age'];?></td>
    <td width="90" bgcolor="#D2D2D2">联系方式:</td>
    <td bgcolor="#FFFFFF"><?php echo $form->textField($model,'p_mobile',array('maxlength'=>11,'class'=>'inys')); // echo $model['p_mobile'];?></td>
  </tr>
</table>
<br />
<table width="90%" border="0" cellpadding="2" cellspacing="1" bgcolor="#68AD5C">
  <tr>
    <td height="35" bgcolor="#D2D2D2">会诊目的:</td>
  </tr>
  <tr>
    <td height="35" bgcolor="#FFFFFF"><?php echo $form->textArea($model,'illness',array('rows'=>5, 'cols'=>95,'style'=>" color:#5b5a5a; border:1px solid #c3c3c3")); //echo $model['illness'];?></td>
  </tr>
  <tr>
    <td height="35" bgcolor="#D2D2D2">相关图片:</td>
  </tr>
  <tr>
    <td height="35" bgcolor="#FFFFFF"><a href="index.php?r=doctor/editpic&id=246">修改相关图片</a></td>
  </tr>
  <!-- 
  <tr>
    <td height="35" bgcolor="#D2D2D2"> <?php // echo $form -> labelEx($model, 'ex_say') ?>:</td>
  </tr>
  <tr>
    <td height="35" bgcolor="#FFFFFF"><?php // echo $form->textArea($model,'ex_say',array('rows'=>5, 'cols'=>44,'style'=>" color:#5b5a5a; border:1px solid #c3c3c3")); ?></td>
  </tr>
   -->
</table>

<div class="h_y_botton"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/images/tijao.gif',array('submit' => 'index.php?r=doctor/editsq&id='.$_GET['id']));; ?></div>
<?php $this->endWidget(); ?>

