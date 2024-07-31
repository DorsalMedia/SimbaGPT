<?php
require_once(APPPATH.'config/AfricasTalkingGateway.php');


class Africastalking_payment {
//   protected $_recipients;
//   protected $_message;
// // Be sure to include the file you've just downloaded

//  public function __construct($recipients, $message)
//   {
//     $this->_recipients     = $recipients;
//     $this->_message       = $message;

  
//   }

  

  public function __construct() {

  }

  public function sendPayment($productName,$phoneNumber,$currencyCode,$amount) {

	//Specify your credentials
	// $username = "sumit";
	// $apiKey   = "3b41981e95b930e605b1995bdc594ab0f1219284a5ebb7aad0ae64c890297e41";

  	$username   = "Rydlr"; 
      // sandbox useranem
      //$username   = "rydlr"; 
  	// this is api key for live account
  	//$apiKey     = "50df645aa4805bc1e6cb03b33ebe573db3c7b1c5d596480963a9f820644de8b9";	

      // this is api key for sandbox test
      $apiKey     = "3a145bbb25ac05da1daf515a9fbd05c60e11cd200362e41e146188c55fdc7ad3";
  	//$apiKey = "3417a9365b061d3061ffb8a5aaa831e95002935706ee6e079c15fc005c54a070";

	// NOTE: If connecting to the sandbox, please use your sandbox login credentials
	//Create an instance of our awesome gateway class and pass your credentials
	//$gateway = new AfricasTalkingGateway($username, $apiKey);
	// NOTE: If connecting to the sandbox, please add the sandbox flag to the constructor:
	/*************************************************************************************
	             ****SANDBOX****
	$gateway    = new AfricasTalkingGateway($username, $apiKey, "sandbox");
	**************************************************************************************/
	// Specify the name of your Africa's Talking payment product

	$gateway    = new AfricasTalkingGateway($username, $apiKey, "sandbox");

	// $productName  = "plan 2";
	// // The phone number of the customer checking out
	// $phoneNumber  = "+2547112233445";
	// // The 3-Letter ISO currency code for the checkout amount
	// $currencyCode = "KES";
	// // The checkout amount
	// $amount       = 100.50;
	//  Any metadata that you would like to send along with this request
	//  This metadata will be  included when we send back the final payment notification
	$metadata     = array("agentId"   => "1",
	                      "productId" => "1");

	try {
	  // Initiate the checkout. If successful, you will get back a transactionId
	  $transactionId = $gateway->initiateMobilePaymentCheckout($productName,
	                               $phoneNumber,
	                               $currencyCode,
	                               $amount,
	                               $metadata);
	  echo "The id here is ".$transactionId;
	}
	catch(AfricasTalkingGatewayException $e){
	  echo "Received error response: ".$e->getMessage();
	}
  }
}
?>