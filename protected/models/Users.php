<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property string $userid
 * @property string $username
 * @property string $password
 * @property integer $role
 * @property string $last_login_time
 * @property string $last_login_ip
 * @property integer $hospitalid
 * @property integer $login_num
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, role,siteid', 'required'),
			array('username','unique'),
			//array('username','','用户名已经存在',0,'unique',1),
			//array('username', 'unique', 'message'=>'该用户名存在'),
			//array('role, hospitalid, login_num', 'numerical', 'integerOnly'=>true),
			//array('username', 'length', 'max'=>30),
			//array('password', 'length', 'max'=>32),
			//array('last_login_ip', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('username,siteid', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'username' => '用户名',
			'password' => '密码',
			'role' => '用户组',
			'last_login_time' => '最后登录时间',
			'last_login_ip' => '最后登录IP',
			'hospitalid' => '所属医院',
			'login_num' => '登录次数',
			'siteid' => '所属站点',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role);
		$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('last_login_ip',$this->last_login_ip,true);
		$criteria->compare('hospitalid',$this->hospitalid);
		$criteria->compare('login_num',$this->login_num);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array( 
            'pageSize'=>10, 
        	),
        	'sort'=>array(
            'defaultOrder'=>'id DESC', //设置默认排序是create_time倒序
            ),
		));
	}

	public function searchsite()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role);
		$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('last_login_ip',$this->last_login_ip,true);
		$criteria->compare('hospitalid',$this->hospitalid);
		$criteria->compare('login_num',$this->login_num);
		$criteria->addInCondition('siteid',array(Yii::app()->user->siteid));

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array( 
            'pageSize'=>10, 
        	),
        	'sort'=>array(
            'defaultOrder'=>'id DESC', //设置默认排序是create_time倒序
            ),
		));
	}

//获取站点名称
	public function getSite($id){
		    $criteria=new CDbCriteria; 
			$criteria->select='sitename'; // only select the 'title' column 
			$criteria->condition='id='.$id;
			//$criteria->params=array(":userid=>".$uid);
			$ename=ZtcSite::model()->find($criteria); // $params isnot needed  
			$name = $ename['sitename'];
			return $name;
		}

	public function getzjname($id){
		    $criteria=new CDbCriteria; 
			$criteria->select='ename'; // only select the 'title' column 
			$criteria->condition='userid='.$id;
			//$criteria->params=array(":userid=>".$uid);
			$ename=ZtcExpert::model()->find($criteria); // $params isnot needed  
			$name = $ename['ename'];
			return $name;
		}

	public function getsqname($id){
		    $criteria=new CDbCriteria; 
			$criteria->select='dname'; // only select the 'title' column 
			$criteria->condition='userid='.$id;
			//$criteria->params=array(":userid=>".$uid);
			$ename=ZtcDoctor::model()->find($criteria); // $params isnot needed  
			$name = $ename['dname'];
			return $name;
		}
}