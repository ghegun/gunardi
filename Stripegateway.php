<?php

include ("./vendor/autoload.php");

class Stripegateway {
	
	public function __construct(){
		$stripe = array(
			"secret_key" => "sk_test_r97QCmBwplvScpNNeVlWWcax",
			"public_key" => "pk_test_VOJo6OeglNZCjhDTwuaAxydY"
		);
		\Stripe\Stripe::setApiKey($stripe["secret_key"]);
	}

	public function checkout($data){
		$message = "";
		try{
			$mycard = array('number' => $data['number'],
							'exp_month' => $data['exp_month'],
							'exp_year' => $data['exp_year']);
			$charge = \Stripe\Charge::create(array('card'=>$mycard,
													'amount'=>$data['amount'],
													'currency'=>'usd'));
			$message = $charge->status;											
		}catch (Exception $e){
			$message = $e->getMessage();
		}	
		return $message;
	}
}

	
	


