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
			array('role, hospitalid, login_num', 'numerical', 'integerOnly'=>true),
			array('username, last_login_time', 'length', 'max'=>30),
			array('password', 'length', 'max'=>32),
			array('last_login_ip', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userid, username, password, role, last_login_time, last_login_ip, hospitalid, login_num', 'safe', 'on'=>'search'),
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
			'username' => 'Username',
			'password' => 'Password',
			'role' => 'Role',
			'last_login_time' => 'Last Login Time',
			'last_login_ip' => 'Last Login Ip',
			'hospitalid' => 'Hospitalid',
			'login_num' => 'Login Num',
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

		$criteria->compare('userid',$this->userid,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role);
		$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('last_login_ip',$this->last_login_ip,true);
		$criteria->compare('hospitalid',$this->hospitalid);
		$criteria->compare('login_num',$this->login_num);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}