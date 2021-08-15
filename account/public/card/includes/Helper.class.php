<?php
class Helper {
	
	public $merchant_id;
	public $secret_key;
	public $type;
	public $serial;
	public $code;
	public $amount;
	
	//Constructor is called whenever a new object is created.
	function __construct() {
		//
	}	
	
	public function connect() {
		
		$data = $this->merchant_id . $this->type . $this->serial . $this->code . $this->amount;

		$signature = hash_hmac('sha256', $data, $this->secret_key);		
		
		$ch = curl_init();
		
		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'https://recard.vn/api/card',
			CURLOPT_POST => 1,
			CURLOPT_SSL_VERIFYPEER => 1,
			CURLOPT_POSTFIELDS => array(
				'merchant_id' => $this->merchant_id,
				'secret_key' => $this->secret_key,
				'type' => $this->type,
				'serial' => $this->serial,
				'code' => $this->code,
				'amount' => $this->amount,
				'signature' => $signature
			)
		));
		
		$resp = curl_exec($ch);
		
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		if($resp === false) {
			$resp = curl_error($ch);
		}
		
		curl_close($ch);
		
		return $resp = [
			'code' => $httpcode,
			'response' => $resp
		];
	}
}