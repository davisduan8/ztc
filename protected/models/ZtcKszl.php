<?php

/**
 * This is the model class for table "{{kszl}}".
 *
 * The followings are the available columns in table '{{kszl}}':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $orderlist
 * @property integer $siteid
 */
class ZtcKszl extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ZtcKszl the static model class
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
		return '{{kszl}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orderlist, siteid', 'numerical', 'integerOnly'=>true),
			array('title', 'required'),
			array('title', 'length', 'max'=>100),
			array('content', 'required'),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, content, orderlist, siteid', 'safe', 'on'=>'search'),
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
			'title' => '问诊科室',
			'content' => '所需资料',
			'orderlist' => 'Orderlist',
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
		$criteria->compare('content',$this->content,true);
		$criteria->compare('orderlist',$this->orderlist);
		$criteria->compare('siteid',$this->siteid);

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
		$criteria->compare('content',$this->content,true);
		$criteria->compare('orderlist',$this->orderlist);
		$criteria->compare('siteid',$this->siteid);

		//$criteria->addInCondition('siteid',array(Yii::app()->user->siteid,NULL));
		$criteria->addCondition("siteid=".Yii::app()->user->siteid." or siteid is null");
		$criteria->order='id asc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getdellink($siteid)
	{

		if(Yii::app()->user->siteid == $siteid){
			echo "<a href='index.php?r=admin/departzldel&id=".$this->id."' class='delete'>删除</a>";
		}

	}
	

}