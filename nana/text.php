<?php
set_time_limit (0);
//include_once './curl_implement.php';
require_once 'functions.php';

$cookieFileName = getcwd() . DIRECTORY_SEPARATOR . "temp" . DIRECTORY_SEPARATOR . "cookie.txt";
$handle = fopen("textnowaccounts.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
		$line = explode(":", $line);
		$username = $line[0];  
		$pass = $line[1];
		//$code = $line[2];  //<--part I added
		$pass = preg_replace( "/\s/", "", $pass);		
		$url = 'https://www.textnow.com/login';
		$answer = curl_request($url, false, false, false, $cookieFileName);

		//$username = 'majazelahi'; $pass = 'elahi321';
		$url = 'https://www.textnow.com/api/sessions';
		$post = 'json=%7B%22username%22%3A%22' . $username . '%22%2C%22remember%22%3Afalse%2C%22password%22%3A%22' . $pass . '%22%7D';
		$answer = curl_request($url, $post, false, false, false, $cookieFileName);
		//print_r($answer); 
		
		$number = '66422';	 //Edit this to change number 
		$msg = 'GEM'; // Edit this to change message	
		$refferer = 'https://www.textnow.com/messaging';
		$url = 'https://www.textnow.com/api/users/' . $username . '/messages';
		$post = 'json=%7B%22contact_value%22%3A%22' . $number . '%22%2C%22contact_type%22%3A2%2C%22message%22%3A%22' . $msg . '%22%2C%22read%22%3A1%2C%22message_direction%22%3A2%2C%22message_type%22%3A1%2C%22date%22%3A%22Sat+Jul+22+2017+20%3A15%3A13+GMT%2B0500+(Pakistan+Standard+Time)%22%2C%22from_name%22%3A%22' . $username . '%22%7D';
		$answer = curl_request($url, $post, false, false, $cookieFileName, false, false, $refferer);
			//$arr = curl_request($url, $post);
				print_r($answer);
	
		Sleep(7);
    }

    fclose($handle);
} else {
    // error opening the file.
} 

?>