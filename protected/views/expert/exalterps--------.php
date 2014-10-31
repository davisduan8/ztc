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
<table class="table6" width="0" border="0">

  <tr>
    <td width="245" align="right" valign="middle">用户名：</td>
    <td>
        <input type='text' name='username' class='inp2' value="<?php echo Yii::app()->user->name;?>" readonly="readonly"/>
    </td>
    <td><font color="#FF0000"><strong></strong></font></td>
    </tr>
  <tr>
    <td width="245" align="right" valign="middle">旧密码：</td>
    <td>
    <input type='password' name='password' class='inp2'/>
    </td>
    <td><font color="#FF0000"><strong></strong></font></td>
    </tr>
  <tr>
    <td align="right" valign="middle">新密码：</td>
    <td width="292">
       <input type='password' name='nps' id='newps' class='inp2'/>
    </td>
    <td width="196"><font color="#FF0000"><strong></strong></font></td>
    </tr>
  <tr>
    <td align="right" valign="middle">确认密码：</td>
        <td>
            <input type='password' name='rps' id='rps' class='inp2'/>
        </td>
     
        <td width="196"><font color="#FF0000"><strong></strong></font></td>

    <td>&nbsp;</td>
  </tr>
  
    <tr>
        
      <td align="right" valign="middle">&nbsp;</td>
      <td colspan="2">
         <?php echo CHtml::submitButton($model->isNewRecord ? '提交' : '保存',array('class'=>'icon1','style'=>'margin-left:0px;')); ?>
        </td>
    </tr>

</table>
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
