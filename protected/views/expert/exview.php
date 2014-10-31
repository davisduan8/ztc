<?php
$this->breadcrumbs=array(
	'开始会诊',
);

?>
<link rel="stylesheet" type="text/css" href="/css/duan.css"/>
<div class="box2">
  <strong class="box2_tit">会诊页面</strong>
<?php $form=$this->beginWidget('CActiveForm', array('id'=>'useradd-form')); ?>
    <ul class="box2_ul nobort">
      <li><label>申请医院：</label><em><?php echo $model['hospitalid']==null? "":$model->hospital->h_name;//echo $model->hospital->h_name;//echo $model['hospitalid'];?></em></li>
      <li><label>会诊专家：</label><em><?php echo $model->expert->ename;//echo $model['expertid'];?></em></li>
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
            echo "<dd><a href='".$v['file_path']."' target='_blank'><img src='/images/doc.jpg' style='width:26px; height:21px;'></a>　</dd><dd>".$v['des']."</dd><dd><a href='http://ztc2.kw120.com/".$v['file_path']."' target='_blank'>【下载】</a></dd>";
            
          }else if(in_array($v->ext_name,$rarkz)){
            echo "<dd><a href='".$v['file_path']."' target='_blank'><img src='/images/rar.jpg' style='width:26px; height:21px;'></a></dd><dd>".$v['des']."</dd><dd><a href='http://ztc2.kw120.com/".$v['file_path']."' target='_blank'>【下载】</a></dd>";
          }else if(in_array($v->ext_name,$pdfkz)){
            echo "<dd><a href='".$v['file_path']."' target='_blank'><img src='/images/pdf.jpg' style='width:26px; height:21px;'></a></dd><dd>".$v['des']."</dd><dd><a href='http://ztc2.kw120.com/".$v['file_path']."' target='_blank'>【下载】</a></dd>";
          }else{
            echo "<dd><a href='".$v['file_path']."' target='_blank'><img src='/images/its.jpg' style='width:26px; height:21px;'></a></dd><dd>".$v['des']."</dd><dd><a href='http://ztc2.kw120.com/".$v['file_path']."' target='_blank'>【下载】</a></dd>";
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
      <li><label>进入会诊：</label>
        <em>
        <a href="<?php echo Consultation::model()->getUrl(Yii::app()->user->id,strtotime($model['creattime']).$model['id'],Yii::app()->user->username,Yii::app()->user->role);?>" target="_blank">开始会诊</a>
        </em>
      </li>
      <li><label>查看DICOM影像：</label>
        <em>
        <?php
        $dicomstr=explode("<br>", $model['dicompic']);
        //var_dump($dicomstr);
        foreach ($dicomstr as $key => $value) {
          echo "<a href='index.php?r=site/dicomurl&urlstr=".$value."' target='_blank'>DICOM影像</a>　<br>";
        }
        ?>
        </em>
      </li>
      <li><label>会诊意见：</label><em><?php echo $form->textArea($model,'ex_say',array('rows'=>5, 'cols'=>44,'style'=>" color:#5b5a5a; border:1px solid #c3c3c3")); ?></em></li>
    </ul>
    <div class="tj_btn tj_btn2"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/img/tj_031.jpg',array('submit' => 'index.php?r=expert/zjupdate&id='.$_GET['id']));; ?></div>
<?php $this->endWidget(); ?>
</div>

