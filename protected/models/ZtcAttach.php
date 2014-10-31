<?php

/**
 * This is the model class for table "{{attach}}".
 *
 * The followings are the available columns in table '{{attach}}':
 * @property integer $id
 * @property integer $consulationid
 * @property string $file_path
 * @property string $file_info
 * @property string $ext_name
 */
class ZtcAttach extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ZtcAttach the static model class
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
		return '{{attach}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('consulationid', 'numerical', 'integerOnly'=>true),
			array('file_path, file_info, ext_name', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, consulationid, file_path, file_info, ext_name', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'consulationid' => 'Consulationid',
			'file_path' => 'File Path',
			'file_info' => 'File Info',
			'ext_name' => 'Ext Name',
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
		$criteria->compare('consulationid',$this->consulationid);
		$criteria->compare('file_path',$this->file_path,true);
		$criteria->compare('file_info',$this->file_info,true);
		$criteria->compare('ext_name',$this->ext_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}