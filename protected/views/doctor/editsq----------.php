<?php
$this->breadcrumbs=array(
	'修改会诊申请',
);

?>
<style type="text/css">
dl{margin:0px; padding:0px;}
.h_flm{width:100%; height:35px; border-bottom:1px dotted #D2D2D2; padding-bottom:5px;}
.h_flm dt{width:100px; height:35px; background-color:#68AD5C; float:left; text-align:center; line-height:35px; color:#FFFFFF; border:1px solid #D2D2D2; margin-right:15px;}
table{border-collapse:separate;  border-spacing:1px;}
.h_y_botton{padding-left:80px; padding-top:20px;}

.fujian_1{width:60%; margin-left:20px; margin-top:10px;}
.fujian_1 li{line-height:35px; text-indent:15px;}
.fujian_1 li img{vertical-align:middle;}
.fujian_1 li a:hover{color:#0033FF:}
.fujian_1 li span{float:right; margin-right:20px;}
.fujian_1 li:hover{background-color:#EFEFEF;}
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
    <td width="200" bgcolor="#FFFFFF"><?php  echo $model['hospitalid']==null?$model['hospitalid']:$model->hospital->h_name;//$model->hospital->h_name;//echo $model['hospitalid'];?></td>
    <td width="90" bgcolor="#D2D2D2">会诊专家：</td>
    <td bgcolor="#FFFFFF"><?php echo $model['expertid']==null? "":$model->expert->ename;?>【<a href="<?php  echo Yii::app()->createURL("doctor/fpzj&cid=".$_GET['cid']);?>">重新分配</a>】</td>
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
    <td height="35" bgcolor="#D2D2D2">相关附件:</td>
  </tr>
  <tr>
    <td height="35" bgcolor="#FFFFFF">
		<div class="fujian_1">
			<li><b>　类别　附件标题  <span> 附件下载</span></b></li>
		<?php
		$connection=Yii::app()->db; 
		$sql="select * from ztc_attach where consulationid=".$_GET['cid'];
		$rows=$connection->createCommand ($sql)->query();
		
		$pickz = array("jpg","gif","JPG","PNG","png",);
		$dockz = array("doc","docx");
		$pdfkz = array("pdf","PDF");
		$rarkz = array("rar","zip","RAR","ZIP");
		
		foreach ($rows as $k => $v ){
			if (in_array($v['ext_name'],$pickz)){
			
			}else if(in_array($v['ext_name'],$dockz)){
				echo "<li><a href='/".$v['file_path']."' target='_blank'><img src='/images/doc.jpg' style='width:26px; height:21px;'></a>　　".$v['des']."  　<span><a href='index.php?r=doctor/deleteattr&aid=".$v['id']."'>删除</a></span></li>";
			}else if(in_array($v['ext_name'],$rarkz)){
				echo "<li><a href='/".$v['file_path']."' target='_blank'><img src='/images/rar.jpg' style='width:26px; height:21px;'></a>　　".$v['des']."  　<span><a href='index.php?r=doctor/deleteattr&aid=".$v['id']."'>删除</a></span></li>";
			}else if(in_array($v['ext_name'],$pdfkz)){
				echo "<li><a href='/".$v['file_path']."' target='_blank'><img src='/images/pdf.jpg' style='width:26px; height:21px;'></a>　　".$v['des']."  　<span><a href='index.php?r=doctor/deleteattr&aid=".$v['id']."'>删除</a></span></li>";
			}else{
				echo "<li><a href='/".$v['file_path']."' target='_blank'><img src='/images/its.jpg' style='width:26px; height:21px;'></a>　　".$v['des']."  　<span><a href='index.php?r=doctor/deleteattr&aid=".$v['id']."'>删除</a></span></li>";
			}
			
		}
		
		?></div>
	</td>
  </tr>
  <tr>
    <td height="35" bgcolor="#D2D2D2">相关图片:</td>
  </tr>
  <tr>
    <td height="35" bgcolor="#FFFFFF">
	<?php
		$connection=Yii::app()->db; 
		$sql="select * from ztc_attach where consulationid=".$_GET['cid'];
		$pics=$connection->createCommand ($sql)->query();
		
		$pickz = array("jpg","gif","JPG","PNG","png","bmp");
		foreach ($pics as $k => $vo ){
		if (in_array($vo['ext_name'],$pickz)){
	?>
	<div style="text-align:center; float:left; width:110px; height:120px;"><img src="<?php echo $vo['file_path']; ?>" width="100" height="80" border="0" /><p><a href="index.php?r=doctor/deleteattr&aid=<?php echo $vo['id'];?>">删除</a></p></div>
	<?php
	}}
	?>
	<div style="clear:both;"></div>
	<a href="index.php?r=doctor/editpic&cid=<?php echo $_GET['cid'];?>">继续增加相关附件</a>
	
	</td>
  </tr>

  <tr>
    <td height="35" bgcolor="#D2D2D2">查看DICOM影像：:</td>
  </tr>
  <tr>
    <td height="35" bgcolor="#FFFFFF">
    <?php
	$dicomstr=explode("<br>", $model['dicompic']);
	//var_dump($dicomstr);
	foreach ($dicomstr as $key => $value) {
		echo "<a href='index.php?r=site/dicomurl&urlstr=".$value."' target='_blank'>DICOM影像</a>　<br>";
	}
	?>　　　
   </td>
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

<div class="h_y_botton"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/images/tijao.gif',array('submit' => 'index.php?r=doctor/editsq&cid='.$_GET['cid']));; ?></div>
<?php $this->endWidget(); ?>

