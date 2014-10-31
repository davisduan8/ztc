<?php

/**
 * This is the model class for table "{{doctor}}".
 *
 * The followings are the available columns in table '{{doctor}}':
 * @property integer $userid
 * @property string $dname
 * @property string $sex
 * @property string $age
 * @property string $telphone
 * @property string $email
 * @property string $moblie
 * @property string $hospitalid
 * @property string $hospital
 * @property string $departid
 */
class ZtcDoctor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ZtcDoctor the static model class
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
		return '{{doctor}}';
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
			array('dname, hospital', 'length', 'max'=>100),
			array('sex, age', 'length', 'max'=>10),
			array('telphone, moblie', 'length', 'max'=>20),
			array('email', 'length', 'max'=>60),
			array('hospitalid, departid', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userid, dname, sex, age, telphone, email, moblie, hospitalid, hospital, departid', 'safe', 'on'=>'search'),
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
			'dname' => 'Dname',
			'sex' => 'Sex',
			'age' => 'Age',
			'telphone' => 'Telphone',
			'email' => 'Email',
			'moblie' => 'Moblie',
			'hospitalid' => 'Hospitalid',
			'hospital' => 'Hospital',
			'departid' => 'Departid',
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
		$criteria->compare('dname',$this->dname,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('age',$this->age,true);
		$criteria->compare('telphone',$this->telphone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('moblie',$this->moblie,true);
		$criteria->compare('hospitalid',$this->hospitalid,true);
		$criteria->compare('hospital',$this->hospital,true);
		$criteria->compare('departid',$this->departid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}