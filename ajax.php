<?php 
error_reporting(0);
$msg = '';
if(isset($_POST['btn']))  
{
	if($_POST['domain']) 
	{
		
		$domain = $_POST['domain'];
		$domain = preg_replace("(^https?://)", "", $domain );
		$domain = str_replace('www.', '', $domain);
		$domain = str_replace('/', '', $domain);
		$url = "https://api.api-ninjas.com/v1/dnslookup?domain=".$domain;



		#Api key
		$api =array('X-Api-Key:duOi5aiT4UZZ32B9Fh6NKw==PxNlI8cLcFlJqzLl');

		$ch = curl_init();
		$timeout=60;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);  
		curl_setopt($ch, CURLOPT_HTTPHEADER, $api);
		$result = curl_exec($ch);
		curl_close($ch);


// echo $result;

		$checkDomain = json_decode($result, true);
//		print_r($checkDomain);
		if ( $result == '[]' ){
			   	$data = array(
			    	'status' => '1',
			    	'domain' => $domain,
			    );
			    $data = json_encode($data);
				echo $data;
			}
			else{
				$data = array(
				    	'status' => '0',
				    	'domain' => $domain,
				    );
			    $data = json_encode($data);
				echo $data;
			}

	} else {
		$msg='<div class="alert alert-danger">Please enter any domain keyword</div>';
	}
}

?>
