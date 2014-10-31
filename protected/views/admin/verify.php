<?php
/* @var $this DjbNewbornController */
/* @var $model DjbNewborn */
$this->breadcrumbs=array(
	'会诊审核',
);

?>
<link rel="stylesheet" type="text/css" href="/css/duan.css"/>
<?php 
//echo $this->renderPartial('_form', array('model'=>$model)); 
?>
<div class="box2">
	<strong class="box2_tit">会诊审核</strong>
	<?php $form=$this->beginWidget('CActiveForm', array('id'=>'useradd-form')); ?>
		<ul class="box2_ul nobort">
			<li><label>申请医院：</label><em><?php echo $model['hospitalid']==null? "":$model->hospital->h_name; ?></em></li>
			<li><label>会诊专家：</label><em><?php echo $model['expertid']==null? "":$model->expert->ename; ?> <a href="<?php echo Yii::app()->createURL("admin/cxfp&id=".$_GET['id']);?>" class="c_fe8c1b">【重新分配】</a></em></li>
			<li><label>会诊时间：</label><em><?php echo $model['pre_time'];?></em></li>
		</ul>
		<ul class="box2_ul">
			<li><label>患者姓名：</label><em><?php echo $model['p_name'];?></em></li>
			<li><label>性别：</label><em><?php echo $model['p_sex'];?></em></li>
			<li><label>年龄：</label><em><?php echo $model['p_age'];?></em></li>
			<li><label>联系方式：</label><em><?php echo $model['p_mobile'];?></em></li>
		</ul>
		<ul class="box2_ul">
			<li><label>会诊目的：</label><em><?php echo $model['illness'];?></em></li>
			<li class="clearfix"><label class="fl">相关附件：</label>

				<?php
				$pickz = array("jpg","gif","JPG","PNG","png",);
				$dockz = array("doc","docx");
				$pdfkz = array("pdf","PDF");
				$rarkz = array("rar","zip","RAR","ZIP");
		    	foreach($img as $v){
			 		echo"<dl class='fl fj0301'>";
			 		if (in_array($v->ext_name,$pickz)){
					
					}else if(in_array($v->ext_name,$dockz)){
						echo "<dd><a href='".$v['file_path']."' target='_blank'><img src='/images/doc.jpg' style='width:26px; height:21px;'></a>　</dd><dd>".$v['des']."</dd><dd><a href='".$v['file_path']."' target='_blank'>【下载】</a></dd>";
						
					}else if(in_array($v->ext_name,$rarkz)){
						echo "<dd><a href='".$v['file_path']."' target='_blank'><img src='/images/rar.jpg' style='width:26px; height:21px;'></a></dd><dd>".$v['des']."</dd><dd><a href='".$v['file_path']."' target='_blank'>【下载】</a></dd>";
					}else if(in_array($v->ext_name,$pdfkz)){
						echo "<dd><a href='".$v['file_path']."' target='_blank'><img src='/images/pdf.jpg' style='width:26px; height:21px;'></a></dd><dd>".$v['des']."</dd><dd><a href='".$v['file_path']."' target='_blank'>【下载】</a></dd>";
					}else{
						echo "<dd><a href='".$v['file_path']."' target='_blank'><img src='/images/its.jpg' style='width:26px; height:21px;'></a></dd><dd>".$v['des']."</dd><dd><a href='".$v['file_path']."' target='_blank'>【下载】</a></dd>";
					}
					echo"</dl>";
		    	}
		       ?>

			</li>
			<li class="clearfix">
				<label class="fl">相关图片：</label>
				<?php
			     foreach($img as $v){
				 if(in_array($v->ext_name,$pickz)){
			    ?>
			    <em class="fl mt10">
			        <dl class='fl fj0301'>
			        <dd><a href="<?php echo Yii::app()->request->hostInfo.$v->file_path;?>" target="_blank"><img src="<?php echo $v->file_path;?>" height="80" width="80"></a></dd>
			    	<dd><?php echo $v->des;?></dd>
			    	</dl>
				</em>
				<?php  
			     }
			     }
			    ?>
			</li>
			<li class="clearfix">
				<div class="clearfix form_box">
					<label class="">会诊审核：</label>
					<div class="select_box">
						<?php echo $form->dropDownList($model,'status',array('1'=>'待审核','2'=>'已审核', '3'=>'已完成')); ?>
					</div>
				</div>
			</li>
			<li><input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/></li>
			<li class="tj_btn tj_btn3"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/img/tj_031.jpg',array('submit' => 'index.php?r=admin/verify&id='.$_GET['id'])); ?></li>
		</ul>
		
	</form>
</div>

<?php $this->endWidget(); ?>
