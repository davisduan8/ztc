<?php
$this->breadcrumbs=array(
	'修改会诊申请',
);

?>
<link rel="stylesheet" type="text/css" href="/css/duan.css"/>
<div class="box2">
  <strong class="box2_tit">修改会诊申请</strong>
<?php $form=$this->beginWidget('CActiveForm', array('id'=>'useradd-form')); ?>
	<ul class="box2_ul nobort">
      <li><label>申请医院：</label><em><?php echo $model['hospitalid']==null? "":$model->hospital->h_name; ?></em></li>
      <li><label>会诊专家：</label><em><?php echo $model['expertid']==null? "":$model->expert->ename;?></em></li>
      <li><label>会诊时间：</label><em><?php echo $model['pre_time'];?></em></li>
    </ul>
    <div class="clearfix form_box form_box2">
      <label>患者姓名：</label><?php echo $form->textField($model,'p_name',array('maxlength'=>40,'class'=>'form_txt1')); ?>
    </div>
    <div class="clearfix form_box form_box2">
      <label>性别：</label><?php echo $form->dropDownList($model, 'p_sex', array('男'=>'男', '女'=>'女'));?>
    </div>
    <div class="clearfix form_box form_box2">
      <label>年龄：</label><?php echo $form->textField($model,'p_age',array('maxlength'=>3,'class'=>'form_txt1'));?>
    </div>
    <div class="clearfix form_box form_box2">
      <label>联系方式：</label><?php echo $form->textField($model,'p_mobile',array('maxlength'=>11,'class'=>'form_txt1'));?>
    </div>
    <div class="clearfix form_box form_box2">
		<label>会诊目的：</label><?php echo $form->textArea($model,'illness',array('rows'=>5, 'cols'=>50,'class'=>'form_txt10301'));?>
    </div>
    <ul class="box2_ul">  
      <li class="clearfix"><label class="fl">相关附件：</label>

        <?php
		$connection=Yii::app()->db; 
		$sql="select * from ztc_attach where consulationid=".$_GET['cid'];
		$rows=$connection->createCommand ($sql)->query();
		
		$pickz = array("jpg","gif","JPG","PNG","png",);
		$dockz = array("doc","docx");
		$pdfkz = array("pdf","PDF");
		$rarkz = array("rar","zip","RAR","ZIP");
		
		foreach ($rows as $k => $v ){
			echo"<dl class='fl fj0301'>";
			if (in_array($v['ext_name'],$pickz)){
			
			}else if(in_array($v['ext_name'],$dockz)){
				echo "<dd><a href='".$v['file_path']."' target='_blank'><img src='/images/doc.jpg' style='width:26px; height:21px;'></a></dd><dd>".$v['des']."</dd><dd><a href='index.php?r=doctor/deleteattr&aid=".$v['id']."'>删除</a></dd>";
			}else if(in_array($v['ext_name'],$rarkz)){
				echo "<dd><a href='".$v['file_path']."' target='_blank'><img src='/images/rar.jpg' style='width:26px; height:21px;'></a></dd><dd>".$v['des']."</dd><dd><a href='index.php?r=doctor/deleteattr&aid=".$v['id']."'>删除</a></dd>";
			}else if(in_array($v['ext_name'],$pdfkz)){
				echo "<dd><a href='".$v['file_path']."' target='_blank'><img src='/images/pdf.jpg' style='width:26px; height:21px;'></a></dd><dd>".$v['des']."</dd><dd><a href='index.php?r=doctor/deleteattr&aid=".$v['id']."'>删除</a></dd>";
			}else{
				echo "<dd><a href='".$v['file_path']."' target='_blank'><img src='/images/its.jpg' style='width:26px; height:21px;'></a></dd><dd>".$v['des']."</dd><dd><a href='index.php?r=doctor/deleteattr&aid=".$v['id']."'>删除</a></dd>";
			}
		echo"</dl>";	
		}
		
		?>

      </li>
      <li class="clearfix">
        <label class="fl">相关图片：</label>
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
	</li>
	<li class="clearfix">
        <label class="fl">　　　　</label>
		<em><a href="index.php?r=doctor/editpic&cid=<?php echo $_GET['cid'];?>">继续增加相关图片/附件</a></em>
    </li>  
      <li><label>DICOM影像：</label><em><?php
		$dicomstr=explode("<br>", $model['dicompic']);
		//var_dump($dicomstr);
		foreach ($dicomstr as $key => $value) {
		  echo "<a href='index.php?r=site/dicomurl&urlstr=".$value."' target='_blank'>DICOM影像</a>　　<br>";
		}
		?></em>
	 </li>
	 <li class="tj_btn tj_btn2"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/img/tj_031.jpg',array('submit' => 'index.php?r=doctor/editsq&cid='.$_GET['cid']));; ?></li>
    </ul>

<?php $this->endWidget(); ?>
</div>
