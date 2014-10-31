<?php
$this->breadcrumbs=array(
	'修改密码',
);
?>
<script src="/js/jQuery-1.9.1.js" type="text/javascript"></script>
<div class="box_ri_con">
<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'myform',
	'enableAjaxValidation'=>false,
));?>

<div class="form1 mt20">
  <strong class="form_tit">修改密码</strong>
  <div class="clearfix form_box">
    <label>用户名：</label>
    <input type='text' name='username' class='form_txt1' value="<?php echo Yii::app()->user->name;?>" readonly="readonly"/>
  </div>

  <div class="clearfix form_box">
    <label>旧密码：</label>
    <input type='password' name='password' class='form_txt1'/>
  </div>

  <div class="clearfix form_box">
    <label>新密码：</label>
    <input type='password' name='nps' id='newps' class='form_txt1'/>
  </div>

  <div class="clearfix form_box">
    <label>确认密码：</label>
    <input type='password' name='rps' id='rps' class='form_txt1'/>
  </div>

  <div class="tj_btn tj_btn2"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/img/tj_031.jpg',array('submit' => 'index.php?r=admin/editps'));; ?></div>
</div>



<?php  $this->endwidget();?>
</div>
<script>
$(function() { 
	$(".icon1").click(function() { 
    	//处理表单验证和交给后台处理的逻辑 
    	if($('#newps').val() == ""){
				alert("新密码不为空！");
				return false;
        }else if($('#rps').val() == ""){
        		alert("确认密码不为空！");
				return false;
        }else {
			return true;
        }
    	
		
	}); 

}); 
</script>
