<?php
require_once("sdata-modules.php");

class HTTPHeaders
{
	function __construct()
	{
		$this->sdata  = new Sdata;
	}
	function Fingerprint(){
		$array  = array(
			'HTTP Strict Transport Security' 	=> 'Strict-Transport-Security', 
			'Content Security Policy' 			=> 'Content-Security-Policy', 
			'XSS Protection' 					=> 'X-XSS-Protection:', 
			'MIME Sniffing' 					=> 'X-Content-Type-Options.', 
			'X Frame Options' 					=> 'X-Frame-Options', 
			'HTTP cookies' 						=> "HttpOnly", 
		);
		return $array;
	}
	function Domain($Domain){
		$Fingerprint = $this->Fingerprint();
		$url[] = array(
			'url' => $Domain, 
		);
		$respons = $this->sdata->sdata($url);
		foreach ($respons as $key => $value) {
			foreach ($Fingerprint as $name => $regex) {
				if(preg_match("/".$regex."/", $value['respons'])){
					$check[] = array(
						'name' 		=> $name,
						'httpcode'  => $value[info][http_code],
						'header' 	=> true, 
					);
				}else{
					$check[] = array(
						'name' 		=> $name,
						'httpcode'  => $value[info][http_code],
						'header' 	=> false, 
					);
				}
			}
		}
		return $check;
	}
}