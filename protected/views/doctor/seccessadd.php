<?php
$this->breadcrumbs=array(
	'申请会诊',
);
if(empty($_GET['cid'])){
  $this->redirect('index.php?r=doctor/errors');  
    exit; 
}
?>
<div class="box2">
  <strong class="box2_tit">申请普通会诊</strong>
    <ul class="clearfix lc_step">
      <li>1. 填写资料</li>
      <li class="lc_step_jt"></li>
      <li>2. 上传资料</li>
      <li class="lc_step_jt"></li>
      <li class="cur">3. 完成申请</li>
    </ul>
    <table class="biao1">
          <tr class="baio1_tit baio1_tit2">
            <td width="">会诊编号</td>
            <td width="">患者姓名</td>
            <td width="">性别</td>
            <td width="">身份证号</td>
            <td width="">预约时间</td>
            <td width="">预约专家</td>
            <td>站点ID</td>
          </tr>
          <tr>
            <td><?php echo $model['id'];?></td>
            <td><?php echo $model['p_name'];?></td>
            <td><?php echo $model['p_sex'];?></td>
            <td><?php echo $model['p_card'];?></td>
            <td><?php echo $model['pre_time'];?></td>
            <td><?php echo $model['expertid']==null? "":$model->expert->ename; //echo $model->expert->ename;?></td>
            <td class="noborr"><?php echo $model['siteid'];?></td>
          </tr>
        </table>
</div>
