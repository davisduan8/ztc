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
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
    //医生列表页
	public function actionIndex()
	{
          
		$this->render('index');
	}
          public function rules()
        {
            return array(
                array('hzfj', 'file', 'types'=>'jpg, gif, png','message'=>'文件不合法'),
            );
        }
        //新增会诊
        public function actionAddhz(){

           $model = new Consultation;
           if(isset($_POST['Consultation']))
	 		{
               $model->attributes = $_POST['Consultation'] ;
               $model->status = $_POST['Consultation']['status'];
               $model->pre_time = $_POST['Consultation']['pre_time'];
               $model->p_card = $_POST['Consultation']['p_card'];
               $model->do_doctorid = Yii::app()->user->id;
               if($model->save()){
                   $conn=Yii::app()->db;
                   $sql = "select id from ztc_consultation where p_card= '".$_POST['Consultation']['p_card']."'";
                   $command=$conn->createCommand($sql);
		 		   $id = $command->queryScalar();    //根据身份证查询出来的会诊id编号
                    //$p_card = $model ->findAllBySql($sql);
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
 
								$this -> redirect('./index.php?r=doctor/selzj&cid='.$_GET['cid']); //添加成功之后跳转到首页
							
				  }
			  $this->render('upfj',array('model'=>$model));
           
      	}
   
/* ======================上传附件==================================  */
   public function actionUploadify() {
    	$path = "uploads/";	
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
			$this->render('selzj',array('ztcexpert'=>$ztcexpert,'cid'=>$_GET['cid']));
             
        }
		
        //选择了的专家要更新到会诊表当中
        function actionZjgx(){
			 $MyUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			 $arr = array();
			 foreach (explode('&',$MyUrl) as $MyUrl){
				list($k,$v)=explode('=',$MyUrl);
				$arr[$k]=$v;
			 }
         	$up = Consultation::model()->updateByPk($arr['cid'],array('expertid'=>$arr['selectdel']));
            if($up > 0){
			    $this->redirect(array('doctor/seccessadd','cid'=>$_GET['cid']));
            } else {
                $this->redirect(array('doctor/seccessadd','cid'=>$_GET['cid']));
            }
        }
        
		//完成申请 第四步
		public function actionSeccessadd()
		{
			$ztcexpert  = new ZtcExpert;
			$this->render('seccessadd',array('ztcexpert'=>$ztcexpert,'cid'=>$_GET['cid']));
		}
		
		
		
        //待处理会诊
        public function actionWaithz(){
                $model = new Consultation('search');
                 $id = Yii::app()->user->id;
         	if(isset($_GET['Consultation']))
                $model->attributes=$_GET['Consultation'];
                $model->do_doctorid = $id;
                //$conn=Yii::app()->db;
                //$sql = "select status from ztc_consultation where do_doctorid ='".$id."' and status='待审核' or status='已审核'";
                //$command=$conn->createCommand($sql);
                //$info1 = $command->queryScalar();    
                //$model->status = $info1;
		$this->render('waithz',array('model'=>$model));
                  
        } 
		
/*		
        //待处理会诊的显示详细信息
        public function actionView($id){
	          $model=$this->loadModel($id);
		 	  $this->render('view',array('model'=>$model));
        }
		
		
        //待处理会诊修改信息
        public function actionUpdate($id)
		{
			$model=$this->loadModel($id);
			if(isset($_POST['Consultation']))
			{
				$model->attributes=$_POST['Consultation'];
				if($model->save())
				$this->redirect(array('editsq','id'=>$model->id));
				//$this->redirect(array('view','id'=>$model->id));
			}
	
			$this->render('editsq',array(
				'model'=>$model,
				'id'=>$model->id
			));
		}
		*/
		
        //待处理会诊删除信息、
        public function actionDelete($id)
		{
			if(Yii::app()->request->isPostRequest)
			{
						// we only allow deletion via POST request
						$this->loadModel($id)->delete();
						// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
						if(!isset($_GET['ajax']))
								$this->redirect(array('index'));
			}
			else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
		
		
		/*已申请 修改*/		
		public function actionEditsq($id)
		{
			//$model = new Consultation;
			$model = Consultation::model()->with('hospital')->findByPk($id);
            $model = Consultation::model()->with('expert')->findByPk($id);
			if(isset($_POST['Consultation']))
			{
				$model->attributes=$_POST['Consultation'];
				if($model->save())
				$this->redirect(array('editsq','id'=>$model->id));
				//$this->redirect(array('view','id'=>$model->id));
			}
			$this->render('editsq',array('model'=>$model,'id'=>$model->id));
		
		}
		
		
   		//重新分配专家详细列表
   		
        public function actionFpzj(){
        	 $ztcexpert  = new ZtcExpert;
        	 $this->render('fpzj',array('ztcexpert'=>$ztcexpert));
        
        }
		
	   /*已申请中的修改-》重选专家*/
	
		public function actionCxzj(){
		   $Url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			 $arr = array();
			 foreach (explode('&',$Url) as $Url){
				list($k,$v)=explode('=',$Url);
				$arr[$k]=$v;
			 }
		 
         	$success = Consultation::model()->updateByPk($arr['id'],array('expertid'=>$arr['selectdel']));
            if($success > 0){
			    	$this->redirect(array('editsq','id'=>$_GET['id']));
            } else {
           		 $this->redirect(array('editsq','id'=>$_GET['id']));
               
            }
		}
		
		
		/*已申请 查看*/		
		public function actionViewsq($id)
		{
			//$model = new Consultation;
			$model = Consultation::model()->with('hospital')->findByPk($id);
            $model = Consultation::model()->with('expert')->findByPk($id);
          	$img = ZtcAttach::model();
            $img_sql = "select * from ztc_attach where  consulationid='".$id."' and ext_name='jpg' or ext_name='gif' or ext_name='png' or ext_name='bmp'";
            $res_img = $img->findAllBySql($img_sql);
            
			$this->render('viewsq',array('model'=>$model,'img'=>$res_img));
		
		}
		
		
		/*已申请 修改附件*/
		public function actionEditpic()
		{
			//$model = new ZtcAttach;
			
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
 
								$this -> redirect('./index.php?r=doctor/editsq&cid='.$_GET['cid']); //添加成功之后跳转到首页
							
				  }
			
			$this->render('editpic');
		}
		
		
        //已完成会诊信息列表
        public function actionEndhz(){
                $model = new Consultation('search');
                $id = Yii::app()->user->id;
         	if(isset($_GET['Consultation']))
                $model->attributes=$_GET['Consultation'];
               // $model->status =  '已完成';
                $model->do_doctorid = $id;
				$this->render('endhz',array(
					'model'=>$model,
				));
        }
		
		
		
		/*已完成会诊 查看*/		
		public function actionViewfinish($id)
		{
			//$model = new Consultation;
			$model = Consultation::model()->with('hospital')->findByPk($id);
            $model = Consultation::model()->with('expert')->findByPk($id);
            $imgage = ZtcAttach::model();
            $imgsql = "select * from ztc_attach where  consulationid='".$id."' and ext_name='jpg' or ext_name='gif' or ext_name='png' or ext_name='bmp'";
            $rimg = $imgage->findAllBySql($imgsql);
			$this->render('viewfinish',array('model'=>$model,'img'=>$rimg));
		
		}
		
		
		
		
        //修改资料 测试文件上传
        public function actionXgzl(){
            //$model = new Consultation;
            $index  = Yii::app()->request->getParam("selectedIndex");
            $pre_id = Yii::app()->request->getParam("upload_save_to_db_id");  
           // $pre_id = $this->request->getParam("upload_save_to_db_id");  
            $inputFileName = "hzfj".$index; 
            $attach = CUploadedFile::getInstanceByName($inputFileName);  
     
            $retValue = "";  
            if($attach == null){  
                $retValue = "提示：不能上传空文件。";  
            }else if($attach->size > 2000000){  
                $retValue = "提示：文件大小不能超过2M。";  
            }else {  
                $retValue = '恭喜，上传成功！';  
                if($pre_id == 0){  
                    $f = file_get_contents($attach->tempName);  
                    $a = new Attachment();  
                   // var_dump($a);die();
                    $a->ref_type = "failParts";  
                    $a->data = $f;  
                    $a->file_path = $attach->name;  
                    $a->save();  
                    $cur_id = $a->id;  
                }else{  
                    $trans = Yii::app()->db->beginTransaction();  
                    try{  
                        $f = file_get_contents($attach->tempName);  
                        $a = new Attachment();  
                        $a->ref_type = "failParts";  
                        $a->data = $f;  
                        $a->file_path = $attach->name;  
                        $a->save();  
                        $cur_id = $a->id;  

                        $pre = Attachment::model()->findByPk($pre_id);  
                        $pre->delete();  
                        $trans->commit();  
                    }catch(Exception $e){  
                        $retValue = $e->getMessage();  
                        $cur_id = 0;  
                        $trans->rollback();  
                    }  
                }  
                echo "<script type='text/javascript'>window.top.window.successUpload('{$retValue}',$cur_id,$index)</script>";exit();  
            }  
            echo "<script type='text/javascript'>window.top.window.stopUpload('{$retValue}',$index)</script>";  
            $this->render(xgzl);
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
                        //$doctor=$this->doctorModel($id);
                        $doctors=ZtcDoctor::model()->findByPk($id);
                        if($doctors===null){
                                $this->render('xginfo',array('doctor'=>$doctor,'userid'=>$id));
                        }else{
                                $this->render('xginfo',array('doctor'=>$doctors,'userid'=>$id));
                        }
                }

        }

		 //修改密码
        public function actionXgps(){
                $model = new Users;
                
             if($_POST) {
			    $uname = trim($_POST['username']);
                $pwd=md5(trim($_POST['password']));
                $nps=md5(trim($_POST['nps']));
                $rps=md5(trim($_POST['rps']));
				
			
              //  $info = $model -> findByPk(Yii::app()->user->id);
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
			$this->render('xgps',array(
				'model'=>$model,
				//'chkpmodel'=>$chkpmodel,
			));
         
         
        }

        //专家列表
        public function actionZjlist(){
           $model = new ZtcExpert();
            //$list =ZtcExpert::model()->with('ztc_hospital')->findAll();
           // print_r($list);die();
		$this->render('zjlist',array( 
				'expert'=>$model,));
            
           // $this->render('zjlist',array('expert'=>$model));
        }

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
        
       /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel($id)
	{
            	$model=Consultation::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
            
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

	
}