<?php
require_once("sdata-modules.php");

class EmailFinder
{
	function __construct()
	{
		$this->sdata  = new Sdata;
	}
	function Domain($Domain){
		$url[] 		= array('url' => 'https://api.hunter.io/v2/domain-search?domain='.$Domain.'&api_key=61150cc37813ef999eba7556f301b88e98b12061','note' => $ip['ip']);
		$head[] 	= array('falsehead' => true);
		$respons 	= $this->sdata->sdata($url,$head);unset($url);
		foreach ($respons as $key => $value) {
			$json = json_decode($value['respons'],true);
			if($json['data']['emails']){
				foreach ($json['data']['emails'] as $key => $email) {
					if($email['first_name']){
						$emailist[] = color("green",$email['value']." (".$email['first_name']." ".$email['last_name'].")");
					}else{
						$emailist[] = color("green",$email['value']);
					}
				}
			}else{
				$emailist[] = color("red",'Email not found.');
			}
		}
		return $emailist;
	}
}