<?php
require_once("sdata-modules.php");

class Honeyscore
{
	function __construct()
	{
		$this->sdata  = new Sdata;
	}
	function IP($Domain){
		$ip = gethostbyname($Domain);
		return array('ip' => $ip , 'domain' => $Domain);
	}
	function Domain($Domain){
		$ip 		= $this->IP($Domain);
		$url[] 		= array('url' => 'https://api.shodan.io/labs/honeyscore/'.$ip['ip'].'?key=z3cBefrV3bmRx2rNZ0E1opuZxXNPrbIR','note' => $ip['ip']);
		$respons 	= $this->sdata->sdata($url);unset($url);
		foreach ($respons as $key => $value) {
			if($value['respons'] == 0){
				$honeypot = color("grey",'Not a honeypot'); 
			}else if($value['respons'] == '1.0'){
				$honeypot = color("red",'is a honeypot');
			}else{
				$honeypot = color("yellow",'Possible honeypot');
			}
			$data  = array(
				'ip' 		=> $ip['ip'], 
				'domain' 	=> $ip['domain'], 
				'score' 	=> $honeypot,
			);
		}
		return $data;
	}
}