<?php

/**
 * This is the model class for table "{{paiban}}".
 *
 * The followings are the available columns in table '{{paiban}}':
 * @property integer $id
 * @property string $dateid
 * @property string $zjdata
 * @property string $item
 */
class ZtcPaiban extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ZtcPaiban the static model class
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
		return '{{paiban}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('siteid', 'numerical', 'integerOnly'=>true),
			array('dateid','required','message'=>'日期必须'),
			array('zjdata','check_zjdata'),
			array('item', 'length', 'max'=>255),
			//array('zjdata', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, dateid, zjdata, item, siteid', 'safe', 'on'=>'search'),
		);
	}
	//验证checkbox是否选择了的长度
	public function check_zjdata(){
		//$this->属性名; //调用模型对象相关属性的信息echo $this->zjdata;
		$length = strlen($this->zjdata);
		if($length < 1)
			 $this->addError('zjdata','至少选择一位专家进行值班');	
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
			'dateid' => 'Dateid',
			'zjdata' => 'Zjdata',
			'item' => 'Item',
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
		$criteria->compare('dateid',$this->dateid,true);
		$criteria->compare('zjdata',$this->zjdata,true);
		$criteria->compare('item',$this->item,true);
		$criteria->compare('siteid',$this->siteid,true);
		$criteria->addInCondition('siteid',array(Yii::app()->user->siteid));

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
            'pageSize'=>20,//设置每页显示20条
			),
        	'sort'=>array(
            'defaultOrder'=>'dateid asc', //设置默认排序是create_time倒序
      		),

		));
	}
	
	public function zjname($data)
	{
		//$zj=new ZtcExpert;
		//data=array('1'=>'ff','2'=>'dd');
		//$name=explode(',',$data); 
		$name='';
		$r=explode(",",$data);
		$num=count($r);   
		for($i=0;$i<$num;$i++){   
			
			
			$criteria=new CDbCriteria; 
			$criteria->select='ename,departid,hospitalid,position'; // only select the 'title' column 
			$criteria->condition='userid='.$r[$i];
			//$criteria->params=array(":userid=>".$r[$i]);
			$zjm=ZtcExpert::model()->find($criteria); // $params isnot needed  
			if($zjm){
			//$name.=$zjm['ename']."----".$this->ksname($zjm['departid'])."----".$this->yyname($zjm['hospitalid'])."----".$zjm['position'].' <br> ';  

			$name.='<div class=pbxs03 clearfix><li class=pbxs03_1>'.$this->yyname($zjm['hospitalid'])."</li><li class=pbxs03_2>".$this->ksname($zjm['departid'])."</li><li class=pbxs03_3>".$zjm['ename']."</li><li class=pbxs03_4>".$zjm['position'].' </li></div> '; 
			}
		}
		return $name;
		
	}
	
	public function chaname($uid)
	{
		$criteria=new CDbCriteria; 
		$criteria->select='ename'; // only select the 'title' column 
		$criteria->condition='userid='.$uid;
		//$criteria->params=array(":userid=>".$uid);
		$zjm=ZtcExpert::model()->find($criteria); // $params isnot needed  
		$zjn=$zjm['ename'];
		return $zjn;
	}

	public function moning($item)
	{
		if($item == 1){
			$montitle="上午";
		}else{
			$montitle="下午";
		}
		return $montitle;
	}

	public function ksname($ksid)
	{
		$criteria=new CDbCriteria; 
		$criteria->select='title'; // only select the 'title' column 
		$criteria->condition='id='.$ksid;
		//$criteria->params=array(":userid=>".$uid);
		$zjm=ZtcDepart::model()->find($criteria); // $params isnot needed  
		$zjn=$zjm['title'];
		return $zjn;
	}

	public function yyname($yyid)
	{
		$criteria=new CDbCriteria; 
		$criteria->select='h_name'; // only select the 'title' column 
		$criteria->condition='id='.$yyid;
		//$criteria->params=array(":userid=>".$uid);
		$zjm=ZtcHospital::model()->find($criteria); // $params isnot needed  
		$zjn=$zjm['h_name'];
		return $zjn;
	}
	
}