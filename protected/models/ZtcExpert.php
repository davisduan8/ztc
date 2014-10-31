<?php

/**
 * This is the model class for table "{{expert}}".
 *
 * The followings are the available columns in table '{{expert}}':
 * @property integer $userid
 * @property string $ename
 * @property string $age
 * @property string $birthday
 * @property string $sex
 * @property string $telphone
 * @property string $moblie
 * @property string $email
 * @property string $hospitalid
 * @property string $departid
 * @property string $skilled
 * @property string $address
 * @property string $position
 */
class ZtcExpert extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ZtcExpert the static model class
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
		return '{{expert}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid', 'required'),
			array('userid', 'numerical', 'integerOnly'=>true),
			array('ename, birthday, email', 'length', 'max'=>60),
			array('age, hospitalid', 'length', 'max'=>11),
			array('sex', 'length', 'max'=>5),
			array('telphone, moblie', 'length', 'max'=>20),
			array('departid, position', 'length', 'max'=>100),
			array('address', 'length', 'max'=>128),
			array('skilled', 'safe'),
			array('position', 'safe'),
			array('intro', 'safe'),
			array('photoimg', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userid, ename, age, birthday, sex, telphone, moblie, email, hospitalid, departid, skilled, address, position,photoimg,intro', 'safe', 'on'=>'search'),
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
			'userid' => 'Userid',
			'ename' => 'Ename',
			'age' => 'Age',
			'birthday' => 'Birthday',
			'sex' => 'Sex',
			'telphone' => 'Telphone',
			'moblie' => 'Moblie',
			'email' => 'Email',
			'hospitalid' => 'Hospitalid',
			'departid' => 'Departid',
			'skilled' => 'Skilled',
			'address' => 'Address',
			'position' => '职务',
			'intro' => '简介',
			'photoimg' => '头像',
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

		$criteria->compare('userid',$this->userid);
		$criteria->compare('ename',$this->ename,true);
		$criteria->compare('age',$this->age,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('telphone',$this->telphone,true);
		$criteria->compare('moblie',$this->moblie,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('hospitalid',$this->hospitalid,true);
		$criteria->compare('departid',$this->departid,true);
		$criteria->compare('skilled',$this->skilled,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('position',$this->position,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	//搜索专家 zjlist
  public function searchzj(){
		$criteria=new CDbCriteria;
		//$criteria->addInCondition('userid', array('44'));
		//$criteria->addInCondition('userid', array('45'));
		$criteria->compare('userid',$this->userid);
		$criteria->compare('ename',$this->ename,true);
		$criteria->compare('age',$this->age,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('telphone',$this->telphone,true);
		$criteria->compare('moblie',$this->moblie,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('hospitalid',$this->hospitalid,true);
		$criteria->compare('departid',$this->departid,true);
		$criteria->compare('skilled',$this->skilled,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('position',$this->position,true);
		//$criteria->addCondition("siteid=".Yii::app()->user->siteid);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}	
	
	
	/***
	 * 关联表方法
	 */
	
	//专家端的需要得到患者要申请哪个医院记录专家是属于哪个医院的
	public function getExname($hid){
	    $criteria=new CDbCriteria; 
		$criteria->select='h_name'; // only select the 'title' column 
		$criteria->condition='id='.$hid;
		//$criteria->params=array(":userid=>".$uid);
		$dkname=ZtcHospital::model()->find($criteria); // $params isnot needed  
		$name = $dkname['h_name'];
		return $name;
	}
	

	public function getDepartname($hid){
	    $criteria=new CDbCriteria; 
		$criteria->select='title'; // only select the 'title' column 
		$criteria->condition='id='.$hid;
		//$criteria->params=array(":userid=>".$uid);
		$dkname=ZtcDepart::model()->find($criteria); // $params isnot needed  
		$name = $dkname['title'];
		return $name;
	}


	//按站点查询专家


	public function searchsitezj($groupsite)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		//print_r($groupsite);
       // exit();

		$criteria=new CDbCriteria;

		$criteria->addInCondition('userid', $groupsite);

		$criteria->compare('userid',$this->userid);
		$criteria->compare('ename',$this->ename,true);
		$criteria->compare('age',$this->age,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('telphone',$this->telphone,true);
		$criteria->compare('moblie',$this->moblie,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('hospitalid',$this->hospitalid,true);
		$criteria->compare('departid',$this->departid,true);
		$criteria->compare('skilled',$this->skilled,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('position',$this->position,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
}