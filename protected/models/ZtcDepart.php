<?php

/**
 * This is the model class for table "{{depart}}".
 *
 * The followings are the available columns in table '{{depart}}':
 * @property integer $id
 * @property string $title
 * @property integer $pid
 */
class ZtcDepart extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ZtcDepart the static model class
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
		return '{{depart}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pid, siteid', 'numerical', 'integerOnly'=>true),
			array('title', 'required'),
			array('title', 'length', 'max'=>60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, pid, siteid', 'safe', 'on'=>'search'),
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
			'title' => '名称',
			'pid' => 'Pid',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('pid',$this->pid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function sitesearch()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('pid',$this->pid);

		$criteria->addCondition("siteid=".Yii::app()->user->siteid." or siteid is null");
		$criteria->order='id asc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function getdellink($siteid)
	{

		if(Yii::app()->user->siteid == $siteid){
			echo "<a href='index.php?r=admin/departdel&id=".$this->id."' class='delete'>删除</a>";
		}

	}
}