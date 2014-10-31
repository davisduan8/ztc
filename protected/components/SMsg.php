<?php

class SMsg extends CBehavior{
//class SMsg{

	private $userID;				//用户ID
	private $account;				//子账号名
	private $password;				//该账号密码
	private $phones=array();		//以半角分号分隔的电话号码序列（最后必须以一个分号结束）
	private $content=null;			//短信内容
	private $sendTime=null;				//发送时间，格式为 yyyy-mm-dd hh:mm:ss（为空则立即发送）
	private $sendType;				//发送类别（填1）
	private $postFixNumber;			//任务扩展号(1到9,或者为空)	
	private $backData=array();		//
	private	$url;								
	
	public function __construct($userID='993823',$account='yuancheng',$password='aaa888*',$sendType=1,$postFixNumber=null){
		$this->userID = $userID;
		$this->account = $account;
		$this->password = $password;
		$this->sendType = $sendType;
		$this->postFixNumber = $postFixNumber;
	}
	
	// 设置发送信息的内容
	public function setContent($content){
		$this->content = $content;
		return $this;
	}
	
	// 设置发送对象的电话
	public function setPhones($phones){
		if(is_array($phones)){
			$this->phones = implode(';',$phones);
			$this->phones .= ';';
		}else{
			$this->phones = $phones;
		}
		return $this;
	}

	// 设置发送时间
	public function setTime($sendTime){
		$this->sendTime = $sendTime;
		return $this;
	}
	

	// 得到发送信息的内容
	public function getContent(){
		return $this->content;
	}
	
	// 得到发送对象的电话
	public function getPhones(){
		return $this->phones;
	}	
	
	// 得到反馈信息
	public function getBackData(){
		return $this->backData;
	}
	
	// 获得执行的Url内容
	public function getUrl(){
		return $this->url;
	}		
	
	// 发送信息
	public function sendMessage(){
		$this->url = "http://www.mxtong.net.cn:8080/GateWay/Services.asmx/DirectSend?UserID=".$this->userID."&Account=".$this->account."&Password=".$this->password."&Phones=".$this->phones."&Content=".$this->content."&SendTime=".$this->sendTime."&SendType=".$this->sendType."&PostFixNumber=".$this->postFixNumber;
		$this->backData = $this->getMsgInfo(file_get_contents($this->url));
		if($this->backData['RetCode']=='Sucess')
			return true;
		else
			return false;
	}
	
	// 短信信息查询
	public function checkMessage(){
		$this->url = "http://www.mxtong.net.cn/Services.asmx/DirectGetStockDetails?UserID=".$this->userID."&Account=".$this->account."&Password=".$this->password;
		$this->backData = $this->getMsgInfo(file_get_contents($this->url));
		if($this->backData['RetCode']=='Sucess')
			return true;
		else
			return false;
	}
	
	// 接收回复的短信
	public function receiveMessage(){
		$this->url = "http://www.mxtong.net.cn/Services.asmx/DirectFetchSMS?UserID=".$this->userID."&Account=".$this->account."&Password=".$this->password;
		$this->backData = $this->getMsgInfo(file_get_contents($this->url));
		if($this->backData['RetCode']=='Sucess')
			return true;
		else
			return false;
	}
	
	// 解析xml字符串
	private function getMsgInfo($xml){
		$obj=@simplexml_load_string($xml);
		return $this->objectToArray($obj);
	}
	
	// 对象转数组
	private function objectToArray($obj){
	    $obj=(array)$obj;
	    foreach($obj as $k=>$v){
	        if( gettype($v)=='resource' ) return;
	        if( gettype($v)=='object' || gettype($v)=='array' )
	            $obj[$k]=(array)$this->objectToArray($v);
	    }
	    return $obj;
	}	

	public function nospace($str){
		return str_replace(array(" "),"",$str);		
	}
}