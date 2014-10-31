<?php
$this->breadcrumbs=array(
	'修改附件',
);

?>
<script src="/js/jQuery-1.9.1.js" type="text/javascript"></script>
<script type="text/javascript" src="/js/jquery.uploadify-3.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="/css/uploadify.css"/>
<script type="text/javascript">
var img_id_upload=new Array();//初始化数组，存储已经上传的图片名
var i=0;//初始化数组下标
$(function() {
    $('#file_upload').uploadify({
    	'auto'     : false,//关闭自动上传
    	//'removeTimeout' : 10,//文件队列上传完成1秒后删除
		'removeCompleted' : true,
        'swf'      : 'images/uploadify.swf',
        'uploader' : 'http://ztc2.kw120.com/index.php?r=doctor/uploadify',
        'method'   : 'post',//方法，服务端可以用$_POST数组获取数据
		'buttonImage' : '/images/text_sr_04.jpg',
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
	 objs.src="/images/rar.jpg";
	 }else if(IsInArray(arr3,su)){
	 objs.src="/images/doc.jpg";
	 }else if(IsInArray(arr4,su)){
	 objs.src="/images/pdf.jpg";
	 }else{
	 objs.src="/images/its.jpg";
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
<style type="text/css">
dl{margin:0px; padding:0px;}
.h_flm{width:100%; height:35px; border-bottom:1px dotted #D2D2D2; padding-bottom:5px;}
.h_flm dt{width:100px; height:35px; background-color:#68AD5C; float:left; text-align:center; line-height:35px; color:#FFFFFF; border:1px solid #D2D2D2; margin-right:15px;}
table{border-collapse:separate; border-spacing:1px;}
.h_y_botton{padding-left:80px; padding-top:20px;}
</style>
<dl class="h_flm">
	<dt>修改附件</dt>
</dl>
<div style="clear:both"></div>
<br />

 <?php $form=$this->beginWidget('CActiveForm', array(  
    'id'=>'user-form',  
    'enableAjaxValidation'=>false,  
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),  
)); ?>  


<div id="divTxt" style="display:none;"><br>  
       </div><br><!-- 这是上传的文件 -->
       
	   <input type="file" name="file_upload" id="file_upload" /> 
	   <div class="ui-widget" style="width:80%; margin-bottom:10px;"><!--添加附件 -->
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; padding: 0 .7em; height:20px; padding-top:5px;color:red;">
				<strong>注:</strong>&nbsp;&nbsp;请上传小写的后缀名文件,格式为 " gif jpg png bmp rar zip doc docx pdf " .</p>
			</div>
		</div>
		<ul class="up-bg">
		<li><a href="javascript:$('#file_upload').uploadify('upload','*')">上 传</a></li>
		<li><a href="javascript:$('#file_upload').uploadify('cancel','*')">取 消</a></li>
		</ul>
		
		<div class="clear"></div>

<div class="h_y_botton"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/images/tijao.gif',array('submit' => 'index.php?r=doctor/addhz&cid='.$_GET['cid'])); ?></div>

 <?php $this->endWidget(); ?>  