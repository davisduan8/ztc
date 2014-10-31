<?php

class ManageController extends Controller
{
	public $layout='//layouts/columnm';
	
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
//			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	
	public function accessRules()
	{
		return array(
			
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				//'actions'=>array('index'),
				//'users'=>array('@'),
				'expression'=>'yii::app()->user->isManage()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionIndex()
	{

			$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
/*========================用户管理========================================*/
/*增加用户*/
	public function actionUseradd()
	{
		$users=new Users;			
		if(isset($_POST['Users'])){
			$users->attributes=$_POST['Users'];
			$users->last_login_time = time();
			$users->password = md5($users->password);
			
			if($users->validate() && $users->save())

					$this->redirect(array('user'));	
			
		}	
		$this->render('useradd',array('users' => $users,'where'=>'add'));
	}
/*用户列表*/
	public function actionUser()
	{
		$users=new Users;
		if(isset($_GET['Users']))
			 $users->attributes=$_GET['Users'];		
		$this->render('user',array('users' => $users));
	}
	
	public function selectrole($data)
	{
		//$name = $data->role==1?'医生':'其他';
		if ($data->role==3){
		$name = '管理组';
		}elseif($data->role==2){
		$name = '专家组';
		}elseif($data->role==99){
		$name = '超管组';
		}else{
		$name = '医生组';
		}
		return $name;
	}
	
	
/*查看用户信息*/
	public function actionUserview($id)
	{
		$model=$this->loadModel($id);
		
		$this->render('userview',array('model'=>$model));
	}
	
/*删除用户*/
	public function actionUserdelete($id,$role)
	{
		$this->loadModel($id)->delete();
		if($role == 1 || $role == 2){
			$this->userinfoModel($id)->delete();
		}
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
	
	
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'请求删除页面不存在.');
		return $model;
	}

	public function userinfoModel($id)
	{
		$model=ZtcExpert::model()->findByPk($id);
		if($model===null){
			$model=ZtcDoctor::model()->findByPk($id);
		}
		return $model;
	}

/*修改*/
	public function actionUserupdate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['Users'])){
			//$users=Users::model()->findByPk($id);
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('user'));	
		}	
		$this->render('useradd',array('users'=>$model,'where'=>'edit'));
	}
	
	/*重置密码*/
	public function actionResetpass($id)
	{
		$model=$this->loadModel($id);
		if($model){
			$model->password = "c4ca4238a0b923820dcc509a6f75849b";
			if($model->save())
				$this->redirect(array('user'));	
		}	
		//$this->render('useradd',array('users'=>$model,'where'=>'edit'));
	}



//====================================管理员会诊表单中修改密码=============================================
        public function actionEditps(){
              $model = new Users;
             if($_POST) {
                $uname = trim($_POST['username']);
                $pwd=md5(trim($_POST['password']));
                $nps=md5(trim($_POST['nps']));
                $rps=md5(trim($_POST['rps']));
                $conn = Yii::app()->db;
                $oldps = "select * from ztc_user where username='$uname' and password = '$pwd' ";
                $info = $conn->createCommand($oldps)->queryScalar();

                if($info > 0){
                          if($nps==$rps) {
                                $msg = $model ->updateByPk(Yii::app()->user->id,array('password'=>$nps ,'username'=>$uname));
                               if(!empty($msg)){
                                   echo "<script>alert('密码修改成功！')</script>";
                               }
                            }else {
                                   echo "<script>alert('密码不一致！')</script>";
                            }
                 } else {
                               echo "<script>alert('用户名或者原密码有误！')</script>";
                 }
  
                }  
			$this->render('editps',array('model'=>$model));
         
           
        }


	
/*==============================科室管理======================================*/	
	public function actionDepart(){
		$depart = new ZtcDepart;
		$this->render('depart',array('depart'=>$depart));
	}
	
	public function actionDepartadd(){
		$depart = new ZtcDepart;
		
		if(isset($_POST['ZtcDepart'])){
		
			$depart->attributes=$_POST['ZtcDepart'];
				
			if($depart->validate() && $depart->save())

				 $this->redirect(array('depart'));
		}
		
		$this->render('departadd',array('depart'=>$depart));
	}
	
	public function actionDepartdel($id)
	{
		$this->delDepart($id)->delete();
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('manage/depart'));
	}
	
	public function delDepart($id)
	{
		$model=ZtcDepart::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'请求删除页面不存在.');
		return $model;
	}
		
//*******************************科室资料*******************************************//
	public function actionDepartzl(){
		$departzl = new ZtcKszl();
		$this->render('departzl',array('departzl'=>$departzl));
	}

	public function actionDepartzladd(){
		$departzl = new ZtcKszl;
		
		if(isset($_POST['ZtcKszl'])){
		
			$departzl->attributes=$_POST['ZtcKszl'];
				
			if($departzl->validate() && $departzl->save())

				 $this->redirect(array('departzl'));
		}
		
		$this->render('departzladd',array('departzl'=>$departzl));
	}
	
	public function actionDepartzldel($id){
			
			//$attach_model = ZtcKszl::model();
			$del = ZtcKszl::model()->findByPk($id);
			if($del->delete()){
				
				$this->redirect('./index.php?r=manage/departzl');
				
			}
	
	
	
	}

	
	//====================站点================
	public function actionSite(){
		$site = new ZtcSite;
		$this->render('site',array('site'=>$site));
	}
	
	public function actionSiteadd(){
		$site = new ZtcSite;
		
		if(isset($_POST['ZtcSite'])){
		
			$site->attributes=$_POST['ZtcSite'];
				
			if($site->validate() && $site->save())

				 $this->redirect(array('site'));
		}
		
		$this->render('siteadd',array('site'=>$site));
	}
	
	public function actionSitedel($id)
	{
		$this->delSite($id)->delete();
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
	
	public function delSite($id)
	{
		$model=ZtcSite::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'请求删除页面不存在.');
		return $model;
	}
}