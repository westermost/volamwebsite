<?php 
//callback.php

require_once 'global.inc.php';

if(isset($_POST['secret_key']) && $secret_key == $_POST['secret_key']) {
	//retrieve the $_POST variables
	$transaction_code = $_POST['transaction_code'];
	$status = $_POST['status'];
	$amount = $_POST['amount'];
	
	//select data
	$card = $db->select("cards", "*", [
		"transaction_code" => $transaction_code
	]); 	
	
	//success
	if($card && $status == 1) {
		$id = $card[0]['id'];
	}

	//update the results returned from the system
	$db->update("cards", [
		"status" => $status,
		"amount" => $amount,
		'updated_at' => date("Y-m-d H:i:s",time())
	], [
		"transaction_code" => $transaction_code
	]);
	
}