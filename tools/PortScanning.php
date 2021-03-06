<?php
require_once("sdata-modules.php");

class PORTScanning
{
	function __construct()
	{
		$this->sdata  	= new Sdata;
		$this->proxy 	= null;
		$this->count 	= 0;
	}
	function IP($IP){
		while (TRUE) {
			if($this->proxy){
				$url[] 		= array('url' => 'http://api.hackertarget.com/nmap/?q='.$IP,'note' => $IP);
				$head[]     = array('proxy' => $this->proxy , 'falsehead' => true,);
				$respons 	= $this->sdata->sdata($url,$head);unset($url);unset($head);
			}else{
				$url[] 		= array('url' => 'http://api.hackertarget.com/nmap/?q='.$IP,'note' => $IP);
				$head[]     = array('falsehead' => true);
				$respons 	= $this->sdata->sdata($url , $head);unset($url);unset($head);
			}
			foreach ($respons as $key => $value) {
				preg_match_all('/(.*?)  (.*) (.*)/m', $value['respons'], $portList);
				foreach ($portList[1] as $key => $ports) {
					if($key != 0){
						$arrayPort[] = array(
							'port' 	=> $ports, 
							'state' => $portList[2][$key], 
							'service' 	=> $portList[3][$key], 
						);
					}
				}
			}
			break;
		}
		return $arrayPort;
	}
}