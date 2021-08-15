<?php 
//card.php

require_once 'global.inc.php';

//initialize php variables used in the form
$type = "";
$serial = "";
$code = "";
$amount = "";

//check to see that the form has been submitted
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) { 
	
	//retrieve the $_POST variables
	$type = $_POST['type'];
	$serial = $_POST['serial'];
	$code = $_POST['code'];
	$amount = $_POST['amount'];

	//initialize variables for form validation
	$success = false;
	
	$helper = new Helper();
	
	$helper->merchant_id = $merchant_id;
	$helper->secret_key = $secret_key;
	$helper->type = $type;
	$helper->serial = $serial;
	$helper->code = $code;
	$helper->amount = $amount;
	
	$connect = $helper->connect();
	
	if($connect) {

		$resp = json_decode($connect['response'], true);
		
		// The results returned successfully
		if($connect['code'] === 200 && $resp['success'] == 1) {
			$transaction_code = $resp['transaction_code'];
			
			$output = [
				'success' => 1
			];
			
			$response = json_encode($output);
			
			$success = true;
			
		} else {
			$response = $connect['response'];
		}
		
	} else {
				
		$response = 'Kết nối đến hệ thống bị gián đoạn';
	}
	
	if($success)
	{
		
		//save data
		$db->insert('cards', [
			'type' => $type,
			'serial' => $serial,
			'code' => $code,
			'amount' => $amount,
			'transaction_code' => $transaction_code,
			'created_at' => date("Y-m-d H:i:s",time())
		]);
	}
	
	echo $response;

}