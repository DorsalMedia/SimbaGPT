<?php
require_once(APPPATH.'config/AfricasTalkingGateway.php');

class Africastalking {
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

  // public function sendSMS1(){
  //   echo 'function call';
  // }
  
  public function sendSMS($recipients, $message) {
      $resultss = '';
      // Specify your login credentials 
      // live account username
      // $username   = "Rydlr"; 
      // sandbox useranem
      $username   = "Rydlr"; 
      // sandbox useranem
      //$username   = "rydlr"; 
    // this is api key for live account
    //$apiKey     = "50df645aa4805bc1e6cb03b33ebe573db3c7b1c5d596480963a9f820644de8b9"; 

      // this is api key for sandbox test
      $apiKey     = "483bf63530d7eee35da064e6e4936000fe68aaefe07eda303bc56ac3d05685b9";

      // NOTE: If connecting to the sandbox, please use your sandbox login credentials
      // Specify the numbers that you want to send to in a comma-separated list
      // Please ensure you include the country code (+254 for Kenya in this case)
      // $recipients = "+254711XXXYYY,+254733YYYZZZ";
          

      // // And of course we want our recipients to know what we really do
      // $message    = "Curious to know what's hot at your destination? Enter ".$random_number." on the tablet screen and interact with your favorite brands. RYDLR, Got You Moving";

      // $message    = "I'm a lumberjack and its ok, I sleep all night and I work all day";
      // Create a new instance of our awesome gateway class

      // unable it on live
      // $gateway    = new AfricasTalkingGateway($username, $apikey);
      $gateway    = new AfricasTalkingGateway($username, $apiKey);
      // NOTE: If connecting to the sandbox, please add the sandbox flag to the constructor:
      /*************************************************************************************
                   ****SANDBOX****
      $gateway    = new AfricasTalkingGateway($username, $apiKey, "sandbox");
      **************************************************************************************/
      // Any gateway error will be captured by our custom Exception class below, 
      // so wrap the call in a try-catch block
      try 
      { 
        // Thats it, hit send and we'll take care of the rest. 
        // $results = $gateway->sendMessage($recipients, $message);
        $results = $gateway->sendMessage($recipients, $message);   
        foreach($results as $result) {
          // status is either "Success" or "error message"

          $response = array(
              "Number" => $result->number,
              "Status" => $result->status,
              "MessageId" => $result->messageId,
              "Cost" => $result->cost,   
              "status_sent" => '1'           
          );          
          
          if($response['Status'] == 'Success'){
            $resultss .= '1';
          } else {
            $resultss .= '0';
          }  
          

          
          // echo " Number: " .$result->number;
          // echo " Status: " .$result->status;
          // echo " MessageId: " .$result->messageId;
          // echo " Cost: "   .$result->cost."\n";          
        }
        
      }
      catch ( AfricasTalkingGatewayException $e )
      {        
        echo "Encountered an error while sending: ".$e->getMessage();                
        $resultss .= 'fail';                
      } 
      return $resultss;   
  }
  
}
// DONE!!! 