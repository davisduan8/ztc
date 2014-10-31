<?php

/**
 * This is the model class for table "ztc_consultation".
 *
 * The followings are the available columns in table 'ztc_consultation':
 * @property integer $id
 * @property integer $expertid
 * @property integer $do_doctorid
 * @property string $pre_time
 * @property string $illness
 * @property integer $status
 * @property string $end_time
 * @property integer $hospitalid
 * @property string $do_info
 * @property string $ispay
 * @property integer $depart_id
 * @property string $sub_doctorid
 * @property string $p_name
 * @property integer $p_sex
 * @property integer $p_age
 * @property integer $p_birthday
 * @property string $p_mobile
 * @property integer $p_creattime
 * @property integer $p_updatetime
 * @property integer $p_cardnum
 * @property string $ex_say
 */
class Consultation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Consultation the static model class
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
		return 'ztc_consultation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
        
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		 			//array('p_name','safe'),
                    array('p_name','required','message'=>'姓名必填'),
                    array('illness', 'safe'),
                    array('p_mobile','length','max'=>30),
                    array('p_sex','safe'),
                    array('p_age','length','max'=>3),
                    array('h_name','safe'),
                    array('ex_say,siteid,dicompic,hzmd','safe'),
                    /*
			array('expertid, do_doctorid, status, hospitalid, depart_id, p_sex, p_age, p_birthday, p_creattime, p_updatetime, p_cardnum', 'numerical', 'integerOnly'=>true),
			array('pre_time, ispay, p_mobile', 'length', 'max'=>20),
			array('end_time', 'length', 'max'=>15),
			array('do_info', 'length', 'max'=>128),
			array('sub_doctorid', 'length', 'max'=>60),
			array('p_name', 'length', 'max'=>30),
			array('illness, ex_say', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, expertid, do_doctorid, pre_time, illness, status, end_time, hospitalid, do_info, ispay, depart_id, sub_doctorid, p_name, p_sex, p_age, p_birthday, p_mobile, p_creattime, p_updatetime, p_cardnum, ex_say', 'safe', 'on'=>'search'),
		*/);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		 'hospital'=>array(self::BELONGS_TO, 'ZtcHospital', 'hospitalid','select'=>'h_name'),
		 'expert'=>array(self::BELONGS_TO, 'ZtcExpert', 'expertid','select'=>'ename'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'expertid' => 'Expertid',
			'do_doctorid' => 'Do Doctorid',
			'pre_time' => '问诊时间',
			'illness' => '病情描述',
			'status' => '会诊状态',
			'end_time' => 'End Time',
			'hospitalid' => 'Hospitalid',
			'do_info' => 'Do Info',
			'ispay' => 'Ispay',
			'depart_id' => '预约科室',
			'sub_doctorid' => 'Sub Doctorid',
			'p_name' => '患者姓名',
			'p_ename' => '英文姓名',
            'p_card'=>'身份证号',
			'p_sex' => '患者性别',
			'p_age' => '患者年龄',
			'p_birthday' => 'P Birthday',
			'p_mobile' => '手机号码',
			'p_creattime' => 'P Creattime',
			'p_updatetime' => 'P Updatetime',
			'p_cardnum' => 'P Cardnum',
			'ex_say' => '会诊意见',
			'is_upload' => '是否上传资料',
			'siteid' => '区域站点ID',
			'dicompic' => '医学影像',
			'hzmd' => '会诊目的',
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
		$criteria->compare('expertid',$this->expertid);
		$criteria->compare('do_doctorid',$this->do_doctorid);
		$criteria->compare('pre_time',$this->pre_time,true);
		$criteria->compare('illness',$this->illness,true);
		$criteria->addInCondition('siteid',array(Yii::app()->user->siteid));
		//$criteria->compare('status',$this->status);
                $criteria->addInCondition('status',array('已完成'));
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('hospitalid',$this->hospitalid);
		$criteria->compare('do_info',$this->do_info,true);
		$criteria->compare('ispay',$this->ispay,true);
		$criteria->compare('depart_id',$this->depart_id);
		$criteria->compare('sub_doctorid',$this->sub_doctorid,true);
		$criteria->compare('p_name',$this->p_name,true);
		$criteria->compare('p_ename',$this->p_ename,true);
		$criteria->compare('p_sex',$this->p_sex);
		$criteria->compare('p_age',$this->p_age);
		$criteria->compare('p_birthday',$this->p_birthday);
		$criteria->compare('p_mobile',$this->p_mobile,true);
		$criteria->compare('p_creattime',$this->p_creattime);
		$criteria->compare('p_updatetime',$this->p_updatetime);
		$criteria->compare('p_cardnum',$this->p_cardnum);
		$criteria->compare('ex_say',$this->ex_say,true);
                $criteria->order='id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
	public function search2()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('expertid',$this->expertid);
		$criteria->compare('do_doctorid',$this->do_doctorid);
		$criteria->compare('pre_time',$this->pre_time,true);
		$criteria->compare('illness',$this->illness,true);
		$criteria->compare('status',$this->status);
               
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('hospitalid',$this->hospitalid);
		$criteria->compare('do_info',$this->do_info,true);
		$criteria->compare('ispay',$this->ispay,true);
		$criteria->compare('depart_id',$this->depart_id);
		$criteria->compare('sub_doctorid',$this->sub_doctorid,true);
		$criteria->compare('p_name',$this->p_name,true);
		$criteria->compare('p_sex',$this->p_sex);
		$criteria->compare('p_age',$this->p_age);
		$criteria->compare('p_birthday',$this->p_birthday);
		$criteria->compare('p_mobile',$this->p_mobile,true);
		$criteria->compare('p_creattime',$this->p_creattime);
		$criteria->compare('p_updatetime',$this->p_updatetime);
		$criteria->compare('p_cardnum',$this->p_cardnum);
		$criteria->compare('ex_say',$this->ex_say,true);
                $criteria->addInCondition('status',array('已审核','待审核'));
                $criteria->addInCondition('siteid',array(Yii::app()->user->siteid));
                $criteria->order='id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function search3()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('expertid',$this->expertid);
		$criteria->compare('do_doctorid',$this->do_doctorid);
		$criteria->compare('pre_time',$this->pre_time,true);
		$criteria->compare('illness',$this->illness,true);
		$criteria->addInCondition('siteid',array(Yii::app()->user->siteid));
		//$criteria->compare('status',$this->status);
               $criteria->addInCondition('status',array('已审核','待审核'));
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('hospitalid',$this->hospitalid);
		$criteria->compare('do_info',$this->do_info,true);
		$criteria->compare('ispay',$this->ispay,true);
		$criteria->compare('depart_id',$this->depart_id);
		$criteria->compare('sub_doctorid',$this->sub_doctorid,true);
		$criteria->compare('p_name',$this->p_name,true);
		$criteria->compare('p_sex',$this->p_sex);
		$criteria->compare('p_age',$this->p_age);
		$criteria->compare('p_birthday',$this->p_birthday);
		$criteria->compare('p_mobile',$this->p_mobile,true);
		$criteria->compare('p_creattime',$this->p_creattime);
		$criteria->compare('p_updatetime',$this->p_updatetime);
		$criteria->compare('p_cardnum',$this->p_cardnum);
		$criteria->compare('ex_say',$this->ex_say,true);
                $criteria->order='id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
	     public function searchDL()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('expertid',$this->expertid);
		$criteria->compare('do_doctorid',$this->do_doctorid);
		$criteria->compare('pre_time',$this->pre_time,true);
		$criteria->compare('illness',$this->illness,true);
		//$criteria->compare('status',$this->status);
        $criteria->addInCondition('status',array('已审核'));
        // $criteria->addInCondition('status',array('待审核','已审核'));
		$criteria->compare('end_time',$this->end_time,true);
		//$criteria->compare('hospitalid',$this->hospitalid);
		$criteria->compare('do_info',$this->do_info,true);
		$criteria->compare('ispay',$this->ispay,true);
		$criteria->compare('depart_id',$this->depart_id);
		$criteria->compare('sub_doctorid',$this->sub_doctorid,true);
		$criteria->compare('p_name',$this->p_name,true);
		$criteria->compare('p_sex',$this->p_sex);
		$criteria->compare('p_age',$this->p_age);
		$criteria->compare('p_birthday',$this->p_birthday);
		$criteria->compare('p_mobile',$this->p_mobile,true);
		$criteria->compare('p_creattime',$this->p_creattime);
		$criteria->compare('p_updatetime',$this->p_updatetime);
		$criteria->compare('p_cardnum',$this->p_cardnum);
		$criteria->compare('ex_say',$this->ex_say,true);
                $criteria->order='id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function searchDone(){
				$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('expertid',$this->expertid);
		$criteria->compare('do_doctorid',$this->do_doctorid);
		$criteria->compare('pre_time',$this->pre_time,true);
		$criteria->compare('illness',$this->illness,true);
		//$criteria->compare('status',$this->status);
        $criteria->addInCondition('status',array('已完成'));
		$criteria->compare('end_time',$this->end_time,true);
		//$criteria->compare('hospitalid',$this->hospitalid);
		$criteria->compare('do_info',$this->do_info,true);
		$criteria->compare('ispay',$this->ispay,true);
		$criteria->compare('depart_id',$this->depart_id);
		$criteria->compare('sub_doctorid',$this->sub_doctorid,true);
		$criteria->compare('p_name',$this->p_name,true);
		$criteria->compare('p_sex',$this->p_sex);
		$criteria->compare('p_age',$this->p_age);
		$criteria->compare('p_birthday',$this->p_birthday);
		$criteria->compare('p_mobile',$this->p_mobile,true);
		$criteria->compare('p_creattime',$this->p_creattime);
		$criteria->compare('p_updatetime',$this->p_updatetime);
		$criteria->compare('p_cardnum',$this->p_cardnum);
		$criteria->compare('ex_say',$this->ex_say,true);
                $criteria->order='id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchzj(){
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
	
	//专家端的需要得到患者要申请哪个医院记录专家是属于哪个医院的
	public function getInfo($hid){
	    $criteria=new CDbCriteria; 
		$criteria->select='h_name'; // only select the 'title' column
	/*	if($hid == "" || $hid == null){
			$criteria->condition='id=0';
		} else {*/
		$criteria->condition='id='.$hid ;
		//$criteria->params=array(":userid=>".$uid);
		$dkname=ZtcHospital::model()->find($criteria); // $params isnot needed  
		$name = $dkname['h_name'];
		return $name;
	}
        
	//获取专家姓名
		public function getZj($uid){
		    $criteria=new CDbCriteria; 
			$criteria->select='ename'; // only select the 'title' column 
			$criteria->condition='userid='.$uid;
			//$criteria->params=array(":userid=>".$uid);
			$ename=ZtcExpert::model()->find($criteria); // $params isnot needed  
			$name = $ename['ename'];
			return $name;
		}
	
	public function getUrl($uid,$keyid,$p_name,$role){


		  $uty = $role == 2?"3":"8";
		  $curr_date = date("Y-m-d H:i:s",time()+28800-120);

		  $ProductorFlag=2;// 1：课堂 2：会议
		  $MtgTitle="在线会诊";//会议标题
		  $MtgKey=$keyid;//会议号，可以数字字母 唯一性
		  $UserName=$p_name;//用户名 用户显示
		  $UserID=$uid;// 第三方ID
		  $UserType=$uty;//1主持人 2主讲人 3主持人+主讲人 8 普通参会者
		  $Timestamp=strtotime($curr_date);// 当前时间戳
		  $duration=7*24*3600;// 会议时长
		  $authid=strtoupper(MD5("md5cenwavepublickeyKingway" . $MtgKey . $UserID . $UserType . $Timestamp));//

		  $url="http://116.213.212.8/join_mtg_zd.asp?SiteID=Kingway&ProductorFlag=$ProductorFlag&MtgTitle=$MtgTitle&MtgKey=$MtgKey&UserName=$UserName&UserID=$UserID&UserType=$UserType&Language=0&Timestamp=$Timestamp&duration=$duration&authid=$authid";

		  return $url;
	}


	public function getMeetlink($status,$creattime,$cid)
	{

		if($status == "已审核"){
			echo "<a href='".$this->getUrl(Yii::app()->user->id,strtotime($creattime).$cid,Yii::app()->user->username,Yii::app()->user->role)."' >会诊</a>";
		}

	}
 
}