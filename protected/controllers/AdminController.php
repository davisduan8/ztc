<?php

class AdminController extends Controller
{
	public $layout='//layouts/columna';
	
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
				'expression'=>'yii::app()->user->isAdmin()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionIndex()
	{
		 $sqly="select a.p_name,b.ename,a.id,a.creattime,a.pre_time,a.end_time,a.status from ztc_consultation as a left join ztc_expert as b on b.userid = a.expertid where a.status='已审核' and a.siteid=".Yii::app()->user->siteid." order by a.id desc limit 5";
			$shenhe = Yii::app()->db->createCommand($sqly)->queryAll();

			$sqln="select a.p_name,b.ename,a.id,a.creattime,a.pre_time,a.end_time,a.status from ztc_consultation as a left join ztc_expert as b on b.userid = a.expertid where a.status='待审核' and a.siteid=".Yii::app()->user->siteid." order by a.id desc limit 5";
			$noshenhe = Yii::app()->db->createCommand($sqln)->queryAll();

			$this->render('index',array('shenhe' => $shenhe,'noshenhe' => $noshenhe ));
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
			{

				$getuid = Yii::app()->db->getLastInsertID();
				if($_POST['Users']['role'] == 1){
					$doctor=new ZtcDoctor;
					//$this->render('userdetail_1',array('doctor'=>$doctor,'userid'=>$getuid));
					$this->redirect(array('admin/userdetail_1','id'=>$getuid));
					//$this->redirect(array('toUrl/action', 'one'=> '1', 'two' => '2', .........));	
				}elseif($_POST['Users']['role'] == 2){
					$expert=new ZtcExpert;
					//$this->render('userdetail_2',array('expert'=>$expert,'userid'=>$getuid));
					//$this->redirect(array('admin/userdetail_2','expert'=>$expert,'userid'=>$getuid));	
					$this->redirect(array('admin/userdetail_2','id'=>$getuid));
				}else{

					$this->redirect(array('user'));	
				}
			}
			$users->password = $_POST['Users']['password'];	
		}	
		$this->render('useradd',array('users' => $users,'where'=>'add'));
	}
/*用户列表*/
	public function actionUser()
	{
		$users=new Users('searchsite');
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
		}else{
		$name = '医生组';
		}
		return $name;
	}
	
	public function selectwansan($data)
	{
		if ($data->role==1){
		$name = 'index.php?r=admin/Userdetail_1&id='.$data->id;
		}elseif($data->role==2){
		$name = 'index.php?r=admin/Userdetail_2&id='.$data->id;
		}else{
		$name = '';
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

		
/*完善用户*/	
	public function actionUserdetail_1($id)
	{
		$doctor=new ZtcDoctor;
		if (isset($_POST['ZtcDoctor'])){
			$doctors=ZtcDoctor::model()->findByPk($id);
			if($doctors===null){
				$doctor->attributes=$_POST['ZtcDoctor'];
				if($doctor->validate() && $doctor->save())
					//echo "<script>alert('ddddddddddddddddd');window.location.href='index.dsd';</script";
					$this->render('userdetail_1',array('doctor'=>$doctor,'userid'=>$id));
			}else{	
				$doctors->attributes=$_POST['ZtcDoctor'];
				if($doctors->save())
					//echo "<script>alert('ddddddddddddddddd');window.location.href='index.dsd';</script";
					$this->render('userdetail_1',array('doctor'=>$doctors,'userid'=>$id));
			}	
		}else{
			//$doctor=$this->doctorModel($id);
			$doctors=ZtcDoctor::model()->findByPk($id);
			if($doctors===null){
				$this->render('userdetail_1',array('doctor'=>$doctor,'userid'=>$id));
			}else{
				$this->render('userdetail_1',array('doctor'=>$doctors,'userid'=>$id));
			}
		}

	}
	
	public function actionUserdetail_2($id)
	{
		$expert=new ZtcExpert;
		if (isset($_POST['ZtcExpert'])){
			$experts=ZtcExpert::model()->findByPk($id);
			if($experts===null){
				$expert->attributes=$_POST['ZtcExpert'];
				if($expert->validate() && $expert->save())
					$this->render('userdetail_2',array('expert'=>$expert,'userid'=>$id));
			}else{	
				$experts->attributes=$_POST['ZtcExpert'];
				if($experts->save())
					$this->render('userdetail_2',array('expert'=>$experts,'userid'=>$id));
			}	
		}else{
			$experts=ZtcExpert::model()->findByPk($id);
			if($experts===null){
				$this->render('userdetail_2',array('expert'=>$expert,'userid'=>$id));
			}else{
				$this->render('userdetail_2',array('expert'=>$experts,'userid'=>$id));
			}
		}

	}


/*==============================处理会诊====================================*/	

         //待处理会诊
        public function actionDclhz()
		{
            $model = new Consultation('search');
         	if(isset($_GET['Consultation']))
                $model->attributes=$_GET['Consultation'];
			$this->render('dclhz',array('model'=>$model));
        }
        //审核处理
        public function actionVerify($id)
		{
			 $model = Consultation::model()->with('hospital')->findByPk($id);
			 $model = Consultation::model()->with('expert')->findByPk($id);
			 $imgModel = ZtcAttach::model();
			 //$imgSql = "select * from ztc_attach where  consulationid='".$id."' and ext_name='jpg' or ext_name='gif' or ext_name='png' or ext_name='bmp'";
			$imgSql = "select * from ztc_attach where  consulationid='".$id."'";
			 $fimg = $imgModel->findAllBySql($imgSql);
			if(isset($_POST['Consultation']))
			{       
				$model->attributes=$_POST['Consultation'];
				 $model->status = $_POST['Consultation']['status']; //编辑审核状态
				if($model->save());
				$this->redirect(array('vlist','id'=>$model->id));
			}
            $this->render('verify',array('model'=>$model,'img'=>$fimg));
        }
        
        //重新分配专家详细列表
        public function actionCxfp(){
        	 $ztcexpert  = new ZtcExpert; 

        	  $sql = "select id from ztc_user where siteid=".Yii::app()->user->siteid." and role=2";
       		  $result = yii::app()->db->createCommand($sql);
        	  $query = $result->queryAll();
        	  //print_r($query);
        	 // echo "<br>";
        	  $qeval=array();
        	  foreach ($query as $val) {
        	  	foreach($val as $v){
        	  		$qeval[]=$v;
        	  	}
        	  }
        	  //print_r($qeval);
        	  //exit();
        

        	 $this->render('cxfp',array('ztcexpert'=>$ztcexpert, 'groupsite'=>$qeval));
        
        }
        //专家分配
        public function actionZjfp(){
             $Url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			 $arr = array();
			 foreach (explode('&',$Url) as $Url){
				list($k,$v)=explode('=',$Url);
				$arr[$k]=$v;
			 }
			if($arr[$k] == $_GET['id']){
				  $this->redirect(array('admin/verify','id'=>$_GET['id']));
				
			}else{
	         	$success = Consultation::model()->updateByPk($arr['id'],array('expertid'=>$arr['selectdel']));
	            if($success > 0){
				    	$this->redirect(array('verify','id'=>$_GET['id']));
	            } else {
	           		 $this->redirect(array('verify','id'=>$_GET['id']));
	            }
			}
        }
              
        //展示审核过的表单
        public function actionVlist($id){
            $model=Consultation::model()->findByPk($id);
            $this->render('vlist',array('model'=>$model));
        }
	
		
		//已完成会诊
        public function actionYwhz(){
            $model = new Consultation('search');
            if(isset($_GET['Consultation']))
                $model->attributes=$_GET['Consultation'];
			$this->render('ywhz',array('model'=>$model,));
        }
        
        //已完成会诊详细信息
        public function actionYlist($id){
            $model=Consultation::model()->findByPk($id);
            $img = ZtcAttach::model();
           // $img_sql = "select * from ztc_attach where  consulationid='".$id."' and ext_name='jpg' or ext_name='gif' or ext_name='png' or ext_name='bmp'";
             $img_sql = "select * from ztc_attach where  consulationid='".$id."' ";
            $res_img = $img->findAllBySql($img_sql);
            $this->render('ylist',array('model'=>$model,'img'=>$res_img));
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


/*=======================医院管理=========================================*/
	public function actionHospital(){
		$hospital = new ZtcHospital;
		$this->render('hospital',array('hospital'=>$hospital));
	}
	
	public function actionHospitaladd(){
		$hospital = new ZtcHospital;
		if(isset($_POST['ZtcHospital'])){		
			$hospital->attributes=$_POST['ZtcHospital'];				
			if($hospital->validate() && $hospital->save())
				 $this->redirect(array('hospital'));
		}
		$this->render('hospitaladd',array('hospital'=>$hospital));
	}
	
	public function actionHospitaldel($id)
	{
		$this->delHospital($id)->delete();
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
	
	public function delHospital($id)
	{
		$model=ZtcHospital::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'请求删除页面不存在.');
		return $model;
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin/depart'));
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
				
				$this->redirect('./index.php?r=admin/departzl');
				
			}
	
	
	
	}

	
/*===============================排班表操作===========================================*/	
	
	public function actionPaiban()
	{
		$paiban = new ZtcPaiban;
		$this->render('paiban',array('paiban'=>$paiban));
	
	
	}
	
	public function actionPaibanadd()
	{
		$model=new ZtcPaiban;
		
		if(isset($_POST['ZtcPaiban'])){
		
			$model->attributes=$_POST['ZtcPaiban'];
			if(is_array($_POST["ZtcPaiban"]["zjdata"]))
			$model->zjdata=implode(",",$_POST["ZtcPaiban"]["zjdata"]);	
			if($model->validate() && $model->save())

				 $this->redirect(array('paiban'));
		}
		$this->render('paibanadd',array('model'=>$model));
	}
	
	//delete paiban list	
	public function actionPaibandel($id)
	{
		$this->PaibanModel($id)->delete();
		//$paiban = new ZtcPaiban;
		$this->redirect(array('paiban'));
	}
	
	
	public function PaibanModel($id)
	{
		$model=ZtcPaiban::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'请求删除页面不存在.');
		return $model;
	}
	
	
	
}