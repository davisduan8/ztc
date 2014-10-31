<?php

/**
 * This is the model class for table "{{hospital}}".
 *
 * The followings are the available columns in table '{{hospital}}':
 * @property integer $id
 * @property string $h_name
 * @property string $h_level
 */
class ZtcHospital extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ZtcHospital the static model class
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
		return '{{hospital}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('h_name', 'required'),
			array('h_name', 'length', 'max'=>30),
			array('h_level', 'length', 'max'=>20),
			array('siteid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, h_name, h_level, siteid', 'safe', 'on'=>'search'),
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
			 'ZtcExpert'=>array(self::BELONGS_TO, 'ZtcExpert', 'userid','select'=>'ename'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'h_name' => '医院名称',
			'h_level' => 'H Level',
			'siteid' => 'Siteid',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('h_name',$this->h_name,true);
		$criteria->compare('h_level',$this->h_level,true);
		$criteria->compare('siteid',$this->siteid,true);
		$criteria->addInCondition('siteid',array(Yii::app()->user->siteid));

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}