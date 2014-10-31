<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//$this->render('index');
		$this->redirect(Yii::app()->homeUrl.'?r=site/login');
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

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout = "mainlogin";
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];

			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){

				//$this->redirect(Yii::app()->user->returnUrl)
				$user_model = Users::model()->findByAttributes(array('username' => $model->username));
				$user_model['login_num']=$user_model['login_num']+1;
				$user_model['last_login_time']=time();
				$user_model->save();
				//var_dump($user_model);
				if (isset($user_model)){
					if($user_model->role == "3"){
						$this->redirect(Yii::app()->homeUrl.'?r=admin/index');
					}elseif($user_model->role == "2"){
						$this->redirect(Yii::app()->homeUrl.'?r=expert/index');
					}elseif($user_model->role == "99"){
						$this->redirect(Yii::app()->homeUrl.'?r=manage/index');
					}else{
						$this->redirect(Yii::app()->homeUrl.'?r=doctor/index');
					}
				}else{
					$this->render('login',array('model'=>$model));
				}
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));

	}

	public function actionUrllogin()
	{
		$model=new LoginForm;
		$username = $_GET['user'];
		$password = $_GET['pass'];
		$urllogin=array('username' => $username, 'password' => $password, 'rememberMe' => '0');
		//var_dump($urllogin);
		//exit();
		if(isset($urllogin))
		{
			$model->attributes=$urllogin;

			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){

				//$this->redirect(Yii::app()->user->returnUrl)
				$user_model = Users::model()->findByAttributes(array('username' => $model->username));
				$user_model['login_num']=$user_model['login_num']+1;
				$user_model['last_login_time']=time();
				$user_model->save();
				//var_dump($user_model);
				if (isset($user_model)){
					if($user_model->role == "1"){
						$this->redirect(Yii::app()->homeUrl.'?r=doctor/addhz');
					}else{
						$this->redirect(Yii::app()->homeUrl.'?r=site/Logout');
					}
				}else{
					$this->render('login',array('model'=>$model));
				}
			}
		}
		$this->redirect(Yii::app()->homeUrl.'?r=site/login');
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}


	public function actionGepost()
		{
			
			$this->render('gepost');
		
		
		}

	public function actionDicomurl($urlstr)
		{
			$this->layout = "publicmain";
			$this->render('dicomurl',array('urlstr'=>$urlstr));
		
		
		}


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


}