<?php
$this->breadcrumbs=array(
	'开始会诊',
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
	<dt>开始会诊</dt>
</dl>
<div style="clear:both"></div>
<br />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'useradd-form')); ?>
<table width="90%" border="0" cellpadding="2" cellspacing="1" bgcolor="#68AD5C">
  <tr>
    <td width="90" height="35" bgcolor="#D2D2D2">申请医院：</td>
    <td width="200" bgcolor="#FFFFFF"><?php  echo $model['hospitalid']==null? "":$model->hospital->h_name; //echo $model->hospital->h_name;//echo $model['hospitalid'];?></td>
    <td width="90" bgcolor="#D2D2D2">会诊专家：</td>
    <td bgcolor="#FFFFFF"><?php echo $model['expertid']==null? "":$model->expert->ename;//$model->expert->ename;//echo $model['expertid'];?></td>
    <td width="90" bgcolor="#D2D2D2">会诊时间：</td>
    <td bgcolor="#FFFFFF"><?php echo $model['pre_time']; ?></td>
  </tr>
</table>
<br />
<table width="90%" border="0" cellpadding="2" cellspacing="1" bgcolor="#68AD5C">
  <tr>
    <td width="90" height="35" bgcolor="#D2D2D2">患者姓名：</td>
    <td bgcolor="#FFFFFF"><?php echo $model['p_name'];?></td>
    <td width="90" bgcolor="#D2D2D2">性别：</td>
    <td bgcolor="#FFFFFF"><?php echo $model['p_sex'];?></td>
    <td width="90" bgcolor="#D2D2D2">年龄：</td>
    <td bgcolor="#FFFFFF"><?php echo $model['p_age'];?></td>
    <td width="90" bgcolor="#D2D2D2">联系方式:</td>
    <td bgcolor="#FFFFFF"><?php echo $model['p_mobile'];?></td>
  </tr>
</table>
<br />
<table width="90%" border="0" cellpadding="2" cellspacing="1" bgcolor="#68AD5C">
  <tr>
    <td height="35" bgcolor="#D2D2D2">会诊目的:</td>
  </tr>
  <tr>
    <td height="35" bgcolor="#FFFFFF"><?php echo $model['illness'];?></td>
  </tr>
  <tr>
    <td height="35" bgcolor="#D2D2D2">相关附件:</td>
  </tr>
  <tr>
    <td height="35" bgcolor="#FFFFFF">
	<div class="fujian_1">
			<li><b>　类别　附件标题  <span> 附件下载</span></b></li>
    <?php
		$pickz = array("jpg","gif","JPG","PNG","png",);
		$dockz = array("doc","docx");
		$pdfkz = array("pdf","PDF");
		$rarkz = array("rar","zip","RAR","ZIP");
    	foreach($img as $v){
	 		if (in_array($v->ext_name,$pickz)){
			
			}else if(in_array($v->ext_name,$dockz)){
				echo "<li><a href='/".$v['file_path']."' target='_blank'><img src='/images/doc.jpg' style='width:26px; height:21px;'></a>　　".$v['des']."  　<span></span></li>";
			}else if(in_array($v->ext_name,$rarkz)){
				echo "<li><a href='/".$v['file_path']."' target='_blank'><img src='/images/rar.jpg' style='width:26px; height:21px;'></a>　　".$v['des']."  　<span></span></li>";
			}else if(in_array($v->ext_name,$pdfkz)){
				echo "<li><a href='/".$v['file_path']."' target='_blank'><img src='/images/pdf.jpg' style='width:26px; height:21px;'></a>　　".$v['des']."  　<span></span></li>";
			}else{
				echo "<li><a href='/".$v['file_path']."' target='_blank'><img src='/images/its.jpg' style='width:26px; height:21px;'></a>　　".$v['des']."  　<span></span></li>";
			}
    	}
       ?>
	 </div>
    </td>
  </tr>
  <tr>
    <td height="35" bgcolor="#D2D2D2">相关图片:</td>
  </tr>
  <tr>
    <td height="35" bgcolor="#FFFFFF">
    <?php
     foreach($img as $v){
	 if(in_array($v->ext_name,$pickz)){
    ?>
        <a href="<?php echo Yii::app()->request->hostInfo.$v->file_path;?>" target="_blank">
    	<img src="<?php echo $v->file_path;?>" height="80" width="80">
    	标题：<?php echo $v->des;?>
	 	</a> &nbsp;&nbsp;&nbsp;
	 	 <?php  
     }
     }
       ?>
	  
    </td>
  </tr>
  <tr>
    <td height="35" bgcolor="#D2D2D2">开始会诊:</td>
  </tr>
  <tr>
    <td height="35" bgcolor="#FFFFFF"><a href="#" target="_blank">开始会诊</a>　　　　<span>查看DICOM影像：
<?php
$dicomstr=explode("<br>", $model['dicompic']);
//var_dump($dicomstr);
foreach ($dicomstr as $key => $value) {
	echo "<a href='http://116.213.212.2:8080/ImageProxy/cweb.jsp?cweburl=http://jdge.kw120.com/ami&loginName=TmpUser&studyId=".$value."' target='_blank'>DICOM影像</a>　　";
}
?>
   </td>
  </tr>
  <tr>
    <td height="35" bgcolor="#D2D2D2"> <?php echo $form -> labelEx($model, 'ex_say') ?>:</td>
  </tr>
  <tr>
    <td height="35" bgcolor="#FFFFFF"><?php echo $form->textArea($model,'ex_say',array('rows'=>5, 'cols'=>44,'style'=>" color:#5b5a5a; border:1px solid #c3c3c3")); ?></td>
  </tr>
</table>

<div class="h_y_botton"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/images/tijao.gif',array('submit' => 'index.php?r=expert/zjupdate&id='.$_GET['id']));; ?></div>
<?php $this->endWidget(); ?>

