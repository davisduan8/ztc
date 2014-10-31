<?php

class ExpertController extends Controller
{
	public $layout='//layouts/columne';
	//首页
	
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
                'expression'=>'yii::app()->user->isExpert()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionIndex()
	{
		$sqly="select a.p_name,b.h_name,a.id,a.creattime,a.pre_time,a.status from ztc_consultation as a left join ztc_hospital as b on b.id = a.hospitalid where a.status='已审核' and a.expertid=".Yii::app()->user->id." order by a.id desc limit 5";
            $shenhe = Yii::app()->db->createCommand($sqly)->queryAll();


            $this->render('index',array('shenhe' => $shenhe));
               
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
        
        //待处理会诊
        public function actionExdcl(){
                $model = new Consultation('search');
             /*   
                $arr = Consultation::model()->with('hospital')->findAll();
                print_r($arr);die();
                */
                
                $id = Yii::app()->user->id;
                   
               if(isset($_GET['Consultation']))
                $model->attributes=$_GET['Consultation'];
                $model->expertid = $id;
				$this->render('exdcl',array(
				  'model'=>$model,
				));
           
        }
        
        //专家查看待处理会诊详细信息
        public function actionExview($id){
        	  //$model=Consultation::model()->findByPk($id);
             $model=Consultation::model()->with('hospital')->findByPk($id);
             $model = Consultation::model()->with('expert')->findByPk($id);
             $img = ZtcAttach::model();
//             $img_sql = "select * from ztc_attach where  consulationid='".$id."' and ext_name='jpg' or ext_name='gif' or ext_name='png' or ext_name='bmp'";
              $img_sql = "select * from ztc_attach where  consulationid='".$id."' ";
             $res_img = $img->findAllBySql($img_sql);
             $this->render('exview',array('model'=>$model,'img'=>$res_img));
        }
        //专家详细信息的更新会诊意见
        public function actionZjupdate(){
     	 	 $model=Consultation::model();
     	 	 $id = $_GET['id'];
     	 	 $ex_say = $_POST['Consultation']['ex_say'];
     	 	 $end_time = new CDbExpression('NOW()');
       		 if(isset($_POST['Consultation']))
			{
				$model->attributes=$_POST['Consultation'];
               
				$yj = $model ->updateByPk($id,array('ex_say'=>$ex_say,'end_time'=>$end_time));
				$status = "select status from ztc_consultation where id=".$id;
				$res= $model->findAllBySql($status);
				if($res[0]['status'] == '已审核'){
					$doit = '已完成';
					$do = $model->updateByPk($id,array('status'=>$doit));
					$model->save();
				}else{
					 $this -> redirect('./index.php?r=expert/exview&id='.$id); //待审核的还跳到原来页面
				}
				//if($model->save())
				 $this->redirect('./index.php?r=expert/exdohz&id='.$id); //已审核的跳到已完成页面
				
			}

			$this->render('exview',array('model'=>$yj));
			
        }
        //专家已完成会诊
        public function actionExdohz(){
              $model = new Consultation('search');
                $eid = Yii::app()->user->id;
               if(isset($_GET['Consultation']))
                $model->attributes=$_GET['Consultation'];
                $model->expertid = $eid;
              //  $model->status =  '已完成';
		$this->render('exdohz',array(
		  'model'=>$model,
		));
        }
        //专家查看已完成的会诊信息
        public function actionExlist($id){
            $model = Consultation::model()->findByPk($id);
             $eximg = ZtcAttach::model();
                $imgsql = "select * from ztc_attach where  consulationid='".$id."'";
          //   $imgsql = "select * from ztc_attach where  consulationid='".$id."' and ext_name='jpg' or ext_name='gif' or ext_name='png' or ext_name='bmp'";
             $resimg = $eximg->findAllBySql($imgsql);
            $this->render('exlist',array('model'=>$model,'img'=>$resimg));
            
        }
        
        //专家排班
        public function actionZjpb(){
        	 $pb_model =  ZtcPaiban::model();
        	 $loginId = Yii::app()->user->id;
        	 $sql = "select id,dateid,zjdata,item from ztc_paiban where dateid >='".date('Y-m-d')."' limit 0,7";
	       	 $infos = $pb_model ->findAllBySql($sql);
	       
			$this->render('zjpb',array('paiban'=>$infos));
        
        }
        
        
        //专家资料修改
        public function actionExdzl(){
            $expert = new ZtcExpert();
            $id = Yii::app()->user->id;
            if (isset($_POST['ZtcExpert'])){
                    $experts=ZtcExpert::model()->findByPk($id);
                    if($experts===null){
                            $expert->attributes=$_POST['ZtcExpert'];
                            if($expert->validate() && $expert->save())
                                    $this->render('exdzl',array('expert'=>$expert,'userid'=>$id));
                    }else{	
                            $experts->attributes=$_POST['ZtcExpert'];
                            if($experts->save())
                                    $this->render('exdzl',array('expert'=>$experts,'userid'=>$id));
                    }	
            }else{
                    //$doctor=$this->doctorModel($id);
                    $experts=ZtcExpert::model()->findByPk($id);
                    if($experts===null){
                            $this->render('exdzl',array('expert'=>$expert,'userid'=>$id));
                    }else{
                            $this->render('exdzl',array('expert'=>$experts,'userid'=>$id));
                    }
            }
          
        }
        
	   //专家端修改密码
        public function actionExalterps(){
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
		$this->render('exalterps',array(
				'model'=>$model,
			));
        }
	
}