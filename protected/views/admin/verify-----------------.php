<?php
/* @var $this DjbNewbornController */
/* @var $model DjbNewborn */
$this->breadcrumbs=array(
	'会诊审核',
);

?>

<?php 
//echo $this->renderPartial('_form', array('model'=>$model)); 
?>
<style type="text/css">
dl{margin:0px; padding:0px;}
.h_flm{width:100%; height:35px; border-bottom:1px dotted #D2D2D2; padding-bottom:5px;}
.h_flm dt{width:100px; height:35px; background-color:#68AD5C; float:left; text-align:center; line-height:35px; color:#FFFFFF; border:1px solid #D2D2D2; margin-right:15px;}
table{border-collapse:separate; border-spacing:1px;}
.h_y_botton{padding-left:80px; padding-top:20px;}

.fujian_1{width:60%; margin-left:20px; margin-top:10px;}
.fujian_1 li{line-height:35px; text-indent:15px;}
.fujian_1 li img{vertical-align:middle;}
.fujian_1 li a:hover{color:#0033FF:}
.fujian_1 li span{float:right; margin-right:20px;}
.fujian_1 li:hover{background-color:#EFEFEF;}
</style>
<dl class="h_flm">
	<dt>会诊审核</dt>
</dl>
<div style="clear:both"></div>
<br />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'useradd-form')); ?>
<table width="90%" border="0" cellpadding="2" cellspacing="1" bgcolor="#68AD5C">
  <tr>
    <td width="90" height="35" bgcolor="#D2D2D2">申请医院：</td>
    <td width="200" bgcolor="#FFFFFF"><?php echo $model['hospitalid']==null? "":$model->hospital->h_name; ?></td>
    <td width="90" bgcolor="#D2D2D2">会诊专家：</td>
    <td bgcolor="#FFFFFF"><?php echo $model['expertid']==null? "":$model->expert->ename; ?>【<a href="<?php echo Yii::app()->createURL("admin/cxfp&id=".$_GET['id']);?>">重新分配</a>】</td>
    <td width="90" bgcolor="#D2D2D2">会诊时间：</td>
    <td bgcolor="#FFFFFF"><?php echo $model['pre_time'];?></td>
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
				echo "<li><a href='/".$v['file_path']."' target='_blank'><img src='/images/doc.jpg' style='width:26px; height:21px;'></a>　　".$v['des']."  　<span><a href='http://ztc2.kw120.com/".$v['file_path']."' target='_blank'>【下载】</a></span></li>";
				
			}else if(in_array($v->ext_name,$rarkz)){
				echo "<li><a href='/".$v['file_path']."' target='_blank'><img src='/images/rar.jpg' style='width:26px; height:21px;'></a>　　".$v['des']."  　<span><a href='http://ztc2.kw120.com/".$v['file_path']."' target='_blank'>【下载】</a></span></li>";
			}else if(in_array($v->ext_name,$pdfkz)){
				echo "<li><a href='/".$v['file_path']."' target='_blank'><img src='/images/pdf.jpg' style='width:26px; height:21px;'></a>　　".$v['des']."  　<span><a href='http://ztc2.kw120.com/".$v['file_path']."' target='_blank'>【下载】</a></span></li>";
			}else{
				echo "<li><a href='/".$v['file_path']."' target='_blank'><img src='/images/its.jpg' style='width:26px; height:21px;'></a>　　".$v['des']."  　<span><a href='http://ztc2.kw120.com/".$v['file_path']."' target='_blank'>【下载】</a></span></li>";
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
  	<td height="35" bgcolor="#FFFFFF">会诊审核：</td>
  </tr>  
	<tr>
		<td height="35" bgcolor="#FFFFFF"><?php echo $form->dropDownList($model,'status',array('1'=>'待审核','2'=>'已审核', '3'=>'已完成')); ?></td>
	</tr>
  
</table>
<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
<div class="h_y_botton"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/images/tijao.gif',array('submit' => 'index.php?r=admin/verify&id='.$_GET['id']));; ?></div>

<?php $this->endWidget(); ?>
