<?php
/**
 *@author lsc Date 2013/10/17
 */
class DoctorController extends Controller
{
		public $layout='//layouts/columnd';
			public $hzfj;
		
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
					'expression'=>'yii::app()->user->isCenter()',
				),
				array('deny',  // deny all users
					'users'=>array('*'),
				),
				
			);
		}
		
		//医生列表页
		public function actionIndex()
		{
			$sqly="select a.p_name,b.ename,a.id,a.creattime,a.pre_time,a.status from ztc_consultation as a left join ztc_expert as b on b.userid = a.expertid where a.status='已审核' and a.do_doctorid=".Yii::app()->user->id." order by a.id desc limit 5";
			$shenhe = Yii::app()->db->createCommand($sqly)->queryAll();

			$sqln="select a.p_name,b.ename,a.id,a.creattime,a.pre_time,a.status from ztc_consultation as a left join ztc_expert as b on b.userid = a.expertid where a.status='待审核' and a.do_doctorid=".Yii::app()->user->id." order by a.id desc limit 5";
			$noshenhe = Yii::app()->db->createCommand($sqln)->queryAll();

			$this->render('index',array('shenhe' => $shenhe,'noshenhe' => $noshenhe ));
		}
	
      /*    public function rules()
        {
            return array(
            	array('nps,rps','required'),
               // array('hzfj', 'file', 'types'=>'jpg, gif, png','message'=>'文件不合法'),
            );
        }*/
        //新增会诊
        public function actionAddhz(){

        	/*
        	$sendmsgobj = new SMsg;
	    	$sendmsgobj->setPhones('13691362263')->setContent('aaaaaa 【云度】');
	    	$sendmsgobj->sendMessage();
	    	*/

           $model = new Consultation;
           if(isset($_POST['Consultation']))
	 		{
	 		   $doctorid = Yii::app()->user->id;
               $model->attributes = $_POST['Consultation'] ;
               $model->status = $_POST['Consultation']['status'];
               $model->pre_time = $_POST['Consultation']['pre_time'];
               $model->p_card = $_POST['Consultation']['p_card'];
               $model->do_doctorid = Yii::app()->user->id;
               $model->creattime = new CDbExpression('NOW()');
             
               $doc_model = ZtcDoctor::model();
	           $hospitalid = "select hospitalid from ztc_doctor where userid=".$doctorid;
	           $myhid = $doc_model->findAllBySql($hospitalid);
	          // Consultation::model()->updateAll(array ('hospitalid' => $myhid[0]['hospitalid']), "do_doctorid=".$doctorid);
	    	   $model->hospitalid = $myhid[0]['hospitalid'];
               if($model->save()){
                  // $conn=Yii::app()->db;
                   //$sql = "select id from ztc_consultation where p_card= '".$_POST['Consultation']['p_card']."'";
                   //$command=$conn->createCommand($sql);
		 		   //$id = $command->queryScalar();    //根据身份证查询出来的会诊id编号
               		$id = $model->attributes['id'];
               } 
               $this -> redirect('./index.php?r=doctor/upfj&cid='.$id); //如果是就上传
                 
	  		}

           $this->render('addhz',array('info_model'=> $model)); 
        }
        
         //跳转到第二步上传附件
        function actionUpfj(){
			$model = new ZtcAttach();
			if(isset($_POST['uploadpath']))
				{
					for($i=0;$i<count($_POST["uploadpath"]);$i++)
					{
						$model = new ZtcAttach();
						$model->consulationid = $_GET['cid'];
						$model->file_path = "/uploads/".$_POST["uploadpath"][$i];
						$model->ext_name = pathinfo($_POST["uploadpath"][$i],PATHINFO_EXTENSION);
						$model->des =$_POST["imgdes"][$i];
						//echo $i.$i.$i.$i.$i.$i;
						$model->save();
					}							 
					$this -> redirect('./index.php?r=doctor/seccessadd&cid='.$_GET['cid']); //添加成功之后跳转到首页
						
				}
			$this->render('upfj',array('model'=>$model));
           
      	}
   
/* ======================上传附件==================================  */
	   public function actionUploadify() {
			$path = "uploads/";	
			//if (isset($_REQUEST['PHPSESSID'])) {
			//	session_id($_REQUEST['PHPSESSID']);
			//	}
			if (!empty($_FILES)) {

  			//exit;
				//得到上传的临时文件流
				$tempFile = $_FILES['Filedata']['tmp_name'];
				
				//允许的文件后缀
				$fileTypes = array('jpg','jpeg','gif','png','bmp','rar','docx','zip','doc','pdf'); 
				
				//得到文件原名
				$fileName = iconv("UTF-8","GB2312",$_FILES["Filedata"]["name"]);
				//$fileName = $_FILES["Filedata"]["name"];
				$fileParts = pathinfo($_FILES['Filedata']['name']);
				
				//修改名称
				$newid = rand("111111","999999");//来个随机数字
				$ext = $fileParts['extension'];
				$fileName = date("Ymd").$newid .".".$ext;
				
				
				//接受动态传值
				//$files=$_POST['typeCode'];
				
				//最后保存服务器地址
				if(!is_dir($path))
				   mkdir($path);
				if (move_uploaded_file($tempFile, $path.$fileName)){
					echo $fileName;
				}else{
					//echo $fileName;
				}
			
			}
		}
   
   

        //跳到第三步选择专家
        function actionSelzj(){
            $ztcexpert  = new ZtcExpert;
			$this->render('selzj',array('ztcexpert'=>$ztcexpert));
             
        }
		
        //选择了的专家要更新到会诊表当中
        function actionZjgx(){
			 $MyUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			 $arr = array();
			 foreach (explode('&',$MyUrl) as $MyUrl){
				list($k,$v)=explode('=',$MyUrl);
				$arr[$k]=$v;
			 }
		
			if($arr[$k] == $_GET['cid']){
				  $this->redirect(array('doctor/seccessadd','cid'=>$_GET['cid']));
				
			}else{
				$up = Consultation::model()->updateByPk($arr['cid'],array('expertid'=>$arr['selectdel']));
	            if($up > 0){
				    $this->redirect(array('doctor/seccessadd','cid'=>$_GET['cid']));
	            } else {
	                $this->redirect(array('doctor/seccessadd','cid'=>$_GET['cid']));
	            }
			}
         	
        }
        
		//完成申请 第四步
		public function actionSeccessadd()
		{
			$cid = $_GET['cid'];
			$model = Consultation::model()->with('expert')->findByPk($cid);
			$msg = "select * from ztc_consultation where id = '".$cid."'";
			$info = $model->findAllBySql($msg);
			foreach($info as $key=>$val){
				$info[$key]=$val;
			}
			$this->render('seccessadd',array('model'=>$info[$key],'expert_name'=>$model));
		}
				
		
        //待处理会诊
        public function actionWaithz(){
                $model = new Consultation('search');
                $id = Yii::app()->user->id;
         	if(isset($_GET['Consultation']))
                $model->attributes=$_GET['Consultation'];
                $model->do_doctorid = $id;
		$this->render('waithz',array('model'=>$model));
                  
        } 
		
		
        //待处理会诊删除信息、
        public function actionDelete($id)
		{
			if(Yii::app()->request->isPostRequest)
			{
						$this->loadModel($id)->delete();
						if(!isset($_GET['ajax']))
								$this->redirect(array('index'));
			}
			else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
		
		
		/*已申请 修改*/		
		public function actionEditsq($cid)
		{
			$model = Consultation::model()->with('hospital')->findByPk($cid);
            $model = Consultation::model()->with('expert')->findByPk($cid);
			if(isset($_POST['Consultation']))
			{
				$model->attributes=$_POST['Consultation'];
				if($model->save())
				$this->redirect(array('editsq','cid'=>$model->id));
			}
			$this->render('editsq',array('model'=>$model,'cid'=>$model->id));
		
		}
		/*已申请 修改会诊的 ，删除图片*/
		public  function actionDeleteattr(){
			$aid = $_GET['aid'];
			$attach_model = ZtcAttach::model();
			$del_img = $attach_model->findByPk($aid);
			if($del_img->delete()){
				//echo "<script>alert('删除成功！')</script>";
				$this->redirect('./index.php?r=doctor/waithz');
				//$this->redirect('./index.php?r=doctor/editsq&cid='.$_GET['cid']);
			}
		}
   		//重新分配专家详细列表
        public function actionFpzj(){
        	 $ztcexpert  = new ZtcExpert;
        	 $this->render('fpzj',array('ztcexpert'=>$ztcexpert));
        
        }
		
		
	   /*已申请中的修改-》重选专家*/
		public function actionCxzj()
		{
			$Url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$arr = array();
			foreach (explode('&',$Url) as $Url){
				list($k,$v)=explode('=',$Url);
				$arr[$k]=$v;
			}
			if($arr[$k] == $_GET['cid']){
				  $this->redirect(array('doctor/editsq','cid'=>$_GET['cid']));
				
			}else{
				$success = Consultation::model()->updateByPk($arr['cid'],array('expertid'=>$arr['selectdel']));
				if($success > 0){
					$this->redirect(array('editsq','cid'=>$_GET['cid']));
				} else {
					$this->redirect(array('editsq','cid'=>$_GET['cid']));
				}
			}
		}
		
		
		/*已申请 查看*/		
		public function actionViewsq($cid)
		{
			$model = Consultation::model()->with('hospital')->findByPk($cid);
            $model = Consultation::model()->with('expert')->findByPk($cid);
          	$img = ZtcAttach::model();
            $img_sql = "select * from ztc_attach where consulationid=".$cid;
            $res_img = $img->findAllBySql($img_sql);
            
			$this->render('viewsq',array('model'=>$model,'img'=>$res_img));	
		}
		
		
		/*已申请 修改附件*/
		public function actionEditpic()
		{
			if(isset($_POST['uploadpath']))
			{
				for($i=0;$i<count($_POST["uploadpath"]);$i++)
				{
					$model = new ZtcAttach();
					$model->consulationid = $_GET['cid'];
					$model->file_path = "/uploads/".$_POST["uploadpath"][$i];
					$model->ext_name = pathinfo($_POST["uploadpath"][$i],PATHINFO_EXTENSION);
					$model->des =$_POST["imgdes"][$i];
					$model->save();
				}							 
				$this -> redirect('./index.php?r=doctor/editsq&cid='.$_GET['cid']);				
			}
			$this->render('editpic');
		}
		
		
        //已完成会诊信息列表
        public function actionEndhz()
		{
			$model = new Consultation('search');
			
			$logid = Yii::app()->user->id;
			  if(isset($_GET['Consultation']))
			   $model->attributes=$_GET['Consultation'];
			   $model->do_doctorid = $logid;
			   $this->render('endhz',array('model'=>$model));
        }
		
		
		/*已完成会诊 查看*/		
		public function actionViewfinish($cid)
		{
			$model = Consultation::model()->with('hospital')->findByPk($cid);
            $model = Consultation::model()->with('expert')->findByPk($cid);
            $imgage = ZtcAttach::model();
			 $imgsql = "select * from ztc_attach where  consulationid='".$cid."'";
            //$imgsql = "select * from ztc_attach where  consulationid='".$cid."' and ext_name='jpg' or ext_name='gif' or ext_name='png' or ext_name='bmp'";
            $rimg = $imgage->findAllBySql($imgsql);
			$this->render('viewfinish',array('model'=>$model,'img'=>$rimg));
		}
		
		
		
        //修改资料
        public function actionXginfo(){
           $doctor=new ZtcDoctor;
           $id = Yii::app()->user->id;
           if (isset($_POST['ZtcDoctor'])){
					$doctors=ZtcDoctor::model()->findByPk($id);
					if($doctors===null){
							$doctor->attributes=$_POST['ZtcDoctor'];
							if($doctor->validate() && $doctor->save())
									$this->render('xginfo',array('doctor'=>$doctor,'userid'=>$id));
					}else{	
							$doctors->attributes=$_POST['ZtcDoctor'];
							if($doctors->save())
								$this->render('xginfo',array('doctor'=>$doctors,'userid'=>$id));
					}	
                }else{
					$doctors=ZtcDoctor::model()->findByPk($id);
					if($doctors===null){
							$this->render('xginfo',array('doctor'=>$doctor,'userid'=>$id));
					}else{
							$this->render('xginfo',array('doctor'=>$doctors,'userid'=>$id));
					}
                }

        }
		

		 //修改密码
        public function actionXgps()
		{
			$model = new Users;    
			if($_POST)
			{
				$uname = trim($_POST['username']);
				$pwd=md5(trim($_POST['password']));
				$nps=md5(trim($_POST['nps']));
				$rps=md5(trim($_POST['rps']));
			
				$conn = Yii::app()->db;
				$oldps = "select * from ztc_user where username='$uname' and password = '$pwd' ";
				$info = $conn->createCommand($oldps)->queryScalar();
		
			  if($info > 0){
			  	if($nps != "" || $rps != "") {
						    if($nps==$rps) {
							    $msg = $model ->updateByPk(Yii::app()->user->id,array('password'=>$nps ,'username'=>$uname));
								if(!empty($msg)){
									echo "<script>alert('密码修改成功!')</script>";
								}
							}else{
								    echo "<script>alert('密码不一致!')</script>";
							}
			  			}else{
							    echo "<script>alert('新密码或者确认密码不能为空!')</script>";
						}
				      }else{
					      echo "<script>alert('用户名或者原密码有误！')</script>";
				}
		
		   }  
			$this->render('xgps',array('model'=>$model));
        }

        //专家列表
        public function actionZjlist()
		{

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

        	  $this->render('zjlist',array('model'=>$ztcexpert, 'groupsite'=>$qeval));

        }
        
		//*******************************科室资料*******************************************//
			public function actionDepartzl(){
				$departzl = new ZtcKszl();
				$this->render('departzl',array('departzl'=>$departzl));
			}
			public function actionDezldel($id){
					//$attach_model = ZtcKszl::model();
					$del = ZtcKszl::model()->findByPk($id);
					if($del->delete()){
						
						$this->redirect('./index.php?r=doctor/departzl');
						
					}
		
			}
		//*******************************************************************************//
			
        //删除专家
        public function actionZjdel($id)
		{
			$this->delzj($id)->delete();
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
	
		public function delzj($id)
		{
			$model=ZtcExpert::model()->findByPk($id);
			if($model===null)
				throw new CHttpException(404,'请求删除页面不存在.');
			return $model;
		}
        

		public function loadModel($id)
		{
			$model=Consultation::model()->findByPk($id);
			if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
			return $model;
				
		}


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



		//专家排班表
		public function actionZjpaiban()
		{
			$paiban = new ZtcPaiban;
			$this->render('zjpaiban',array('paiban'=>$paiban));
		
		
		}

		public function actionErrors()
		{
			
			$this->render('errors');
		
		
		}
/*
		public function actionGepost()
		{
			
			$this->render('gepost');
		}
*/
		public function actionDicomhz()
		{
			
			$this->render('dicomhz');
		}
}