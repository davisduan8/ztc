
<h1>GE服务器返回信息</h1>

<div>
	<li>错误编号：<?php echo isset($_POST['Id'])?$_POST['Id']:'';?></li>
	<li>患者姓名：<?php echo isset($_POST['PatientName'])?$_POST['PatientName']:'';?></li>
	<li>患者性别：<?php echo isset($_POST['PatientGender'])?$_POST['PatientGender']:'';?></li>
	<li>患者年龄：<?php echo isset($_POST['PatientAge'])?$_POST['PatientAge']:'';?></li>
	<li>DICOM IDs：<?php echo isset($_POST['StudyInstanceUIDs'])?$_POST['StudyInstanceUIDs']:'';?></li>
	<li>错误信息：<?php echo isset($_POST['ErrorMessage'])?$_POST['ErrorMessage']:'';?></li>
	<li>发生时间：<?php echo isset($_POST['TimeStamp'])?$_POST['TimeStamp']:'';?></li>
	<li>申请用户名：<?php echo isset($_POST['Applicant'])?$_POST['Applicant']:'';?></li>
	<li>记录状态：<?php echo isset($_POST['StatusCode'])?$_POST['StatusCode']:'';?></li>
</div>


