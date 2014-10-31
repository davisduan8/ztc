<!--上传 -->
<script type="text/javascript" src="./public/checksub/jmessagebox-1.0.0.js"></script>
<script type="text/javascript" src="./public/checksub/jvalidate-1.0.0.js"></script>
<script src="./public/js/jquery-ui-1.9.2.custom.js"></script>
<script src="./public/js/jquery.bigpage.js" type="text/javascript"></script>
<script src="./public/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="./public/js/jQuery-1.9.1.js"></script>
<script type="text/javascript" src="./public/js/jquery.uploadify-3.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="./public/css/uploadify.css"/>

<script type="text/javascript">
var img_id_upload=new Array();//初始化数组，存储已经上传的图片名

var i=0;//初始化数组下标
$(function() {
    $('#file_upload').uploadify({
    	'auto'     : false,//关闭自动上传
    	//'removeTimeout' : 10,//文件队列上传完成1秒后删除
		'removeCompleted' : true,
        'swf'      : './public/images/uploadify.swf',
        'uploader' : '__ROOT__/index.php/Public/uploadify',
      // 'uploader' : './public/uploadify',
        'method'   : 'post',//方法，服务端可以用$_POST数组获取数据
		'buttonImage' : './public/images/text_sr_04.jpg',
		'width' : '128',
		'height' : '49',
		'buttonText' : '选择附件',//设置按钮文本
        'multi'    : true,//允许同时上传多张图片
        'uploadLimit' : 100,//一次最多只允许上传100张图片
        'fileTypeDesc' : 'All Files',//只允许上传图像
        'fileTypeExts' : '*.gif; *.jpg; *.png; *.bmp; *.rar; *.docx; *.doc; *.zip; *.pdf',//限制允许上传的图片后缀
        'fileSizeLimit' : '1024000KB',//限制上传的图片不得超过1000M 
        'onUploadSuccess' : function(file, data, response) {//每次成功上传后执行的回调函数，从服务端返回数据到前端
               img_id_upload[i]=data;
               i++;
			   getResult(data);
        },
        'onQueueComplete' : function(queueData) {//上传队列全部完成后执行的回调函数
        }  
    });
});

</script>
<script type="text/javascript">
	 function getResult(content){
	 //通过上传的图片来动态生成text来保存路径
	 var board = document.getElementById("divTxt");
	 board.style.display="";
	 var newInput = document.createElement("input");
	 newInput.type = "hidden";
	 newInput.size = "45";
	 newInput.name="uploadpath[]";
	 var obj = board.appendChild(newInput);
	// var br= document.createElement("br");
	// board.appendChild(br);
	 obj.value=content;
 
	 var pos=obj.value.lastIndexOf(".");
	 //截取点之后的字符串
	 var su = obj.value.substring(pos+1);
	 //alert(su);
	 function IsInArray(arr,val){
		var testStr=','+arr.join(",")+",";
		return testStr.indexOf(","+val+",")!=-1;
	 }
	 var arr=['jpg','gif','JPG','PNG','png','bmp'];
	 var arr2=['rar','zip','RAR','ZIP'];
	 var arr3=['docx','doc'];
	 var arr4=['pdf','PDF'];
	 //alert(arr.Exists(su));
	 
	 var boards = document.getElementById("divTxt");
	 boards.style.display="";
	 var newInputs = document.createElement("img");
	 //newInputs.width = "50";
	 newInputs.height = "50";
	 newInputs.name="myFilePaths[]";
	 var objs = boards.appendChild(newInputs);
	 
	 if (IsInArray(arr,su)){
	 objs.src="/uploads/"+content;
	 }else if(IsInArray(arr2,su)){
	 objs.src="/Public/images/rar.jpg";
	 }else if(IsInArray(arr3,su)){
	 objs.src="/Public/images/doc.jpg";
	 }else if(IsInArray(arr4,su)){
	 objs.src="/Public/images/pdf.jpg";
	 }else{
	 objs.src="/Public/images/its.jpg";
	 }
	 //描述上传附件的文字输入框
	 var boarddes = document.getElementById("divTxt");
	 boarddes.style.display="";
	 var newInputdes = document.createElement("input");
	 newInputdes.type = "text";
	 newInputdes.size = "45";
	 newInputdes.id="imgdes";
	 newInputdes.name="imgdes[]";
	 newInputdes.placeholder="标题";
	 newInputdes.value="";
	 var objdes = boarddes.appendChild(newInputdes);
	 //objdes.value='标题：';
	 var brdes= document.createElement("br");
	 boarddes.appendChild(brdes);
 }

 </script>
 
<?php 
/**
 *定义数组使radio的样式不用换行
 */		
$tplarray=array('template'=>'{input} {label}','separator'=>'&nbsp;&nbsp;');
?>
<div class="box_ri_con">

<?php $form=$this->beginWidget('CActiveForm',array('id'=>'xform','htmlOptions'=>array('name'=>'xform','enctype'=>'multipart/form-data')));  ?>

	<?php echo CHtml::errorSummary($model); ?>
<table class="table1" width="0" border="0">
    	<tr>
	    <td align="right" valign="middle"> <?php echo $form -> labelEx($model, 'p_name') ?>:</td>
	    <td><?php echo $form->textField($model,'p_name',array('maxlength'=>40,'class'=>'inp2')); ?></td>
	    <td colspan="3">&nbsp;</td>
	</tr>
     <tr>
    <td align="right" valign="middle"><?php echo $form->labelEx($model,'p_sex'); ?>：</td>
    <td colspan="4">
  
      <?php echo $form->radioButtonList($model,'p_sex',array('男'=>'男', '女'=>'女'),$tplarray); ?>
      <label for="radio"></label>
    </tr>
       <tr>
	    <td align="right" valign="middle"> <?php echo $form -> labelEx($model, 'p_age') ?>:</td>
	    <td><?php echo $form->textField($model,'p_age',array('class'=>'inp2','maxlength'=>40)); ?></td>
	    <td colspan="3">&nbsp;</td>
	</tr>
       <tr>
	    <td align="right" valign="middle"> <?php echo $form -> labelEx($model, 'p_mobile') ?>:</td>
	    <td><?php echo $form->textField($model,'p_mobile',array('class'=>'inp2','maxlength'=>40)); ?></td>
	    <td colspan="3">&nbsp;</td>
	</tr>
      <tr>
	    <td align="right" valign="middle"> 病例资料:</td>
            <td><?php echo CHtml::activeFileField($model, 'hzfj'); ?></td>
	    <td colspan="3">&nbsp;</td>
	</tr>   
          <tr>
           <?php if(!empty($model->hzfj)):?>
            
              <td align="right" valign="middle">     <?php echo CHtml::label('图片预览','') ?></td>
              <td>   <a href="<?php echo Yii::app()->basePath.'/../upload/'. $model->hzfj?>" target="_blank"> <?php echo '<img src="http://localhost/yiiztc/./upload/'.$model->hzfj.'" style="width:230px; height:230px;" />'; ?></a></td>
     
        <?php endif;?>
        </tr>
    <tr>
    <td align="right" valign="middle"><?php echo $form->labelEx($model,'illness'); ?>：</td>
    <td colspan="4">
    <?php echo $form->textArea($model,'illness',array('rows'=>5, 'cols'=>44,'style'=>" color:#5b5a5a; border:1px solid #c3c3c3")); ?>
      
    </td>
    </tr>
     <tr>
    <td align="right" valign="middle">会诊审核：</td>
    <td colspan="4">
<?php /* echo $form->dropDownList($model, 'field_name', array(1=>'test1', 2=>'test2')) */?>
    <?php /* echo $form->dropDownList($model,'status',CHtml::listData( Consultation::model()->findAll(),$model->id, 'status')); */?>
      <?php echo $form->dropDownList($model,'status',array('1'=>'待审核','2'=>'已审核', '3'=>'已完成')); ?> 
    </td>
    </tr>
</table>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '提交' : '保存'); ?>
	</div>
<script type="text/javascript">
$(function(){
	$("#xform").validationEngine();	
});
</script>
<?php $this->endWidget(); ?>

</div><!-- form -->