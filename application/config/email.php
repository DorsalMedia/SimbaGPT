<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| EMAIL CONFING
| -------------------------------------------------------------------
| Configuration of outgoing mail server.
| This config file will override user and programming settings for email.
| To activate this file copy paste this file in the '/encube/application/config' folder and rename it to 'email.php'
| */

// ----------------------  this is email configuation for live domain www.rydlr.com

 // $config['useragent']    = 'Sumit Solanki';
 // $config['protocol']     = 'smtp';
 // $config['smtp_host']    = 'ssl://mail.rydlr.com';
 // $config['smtp_port']    = '465';
 // $config['smtp_timeout'] = '30';
 // $config['smtp_user']    = 'info@rydlr.com';	// enter your bluehost email id Eg. yourname@yourdomain.com
 // $config['smtp_pass']    = 'x@@m1006!';		// enter your password
 // $config['charset']      = 'utf-8';
 // $config['newline']      = "\r\n";
 // $config['crlf']      = "\r\n";
 //$config['mailtype']     = "html";
 //$config['validate']     = TRUE;

// -------------------------- this is email configuation for localhost

// $config['useragent']    = 'Sumit Solanki';
// $config['protocol']     = 'smtp';
// $config['smtp_host']    = 'ssl://smtp.gmail.com';
// $config['smtp_port']    = '465';
// $config['smtp_timeout'] = '30';
// $config['smtp_user']    = 'chirag@xoomsolutions.com';	// enter your bluehost email id Eg. yourname@yourdomain.com
// $config['smtp_pass']    = 'chirag_2468';		// enter your password
// $config['charset']      = 'utf-8';
// $config['newline']      = "\r\n";
// $config['crlf']      = "\r\n";
// $config['mailtype']     = "html";
// $config['validate']     = TRUE;
// 
// 
//  --------------------------this email configuration for live site
 $config['useragent']    = 'rydlr';
  $config['protocol']     = 'smtp';
  //$config['smtp_host']    = 'ssl://mail.rydlr.com';
	$config['smtp_host']    = 'Twiga.tamshi.com';
	//$config['smtp_port']    = '465'; // do  not use smtp_port its give error for smtp_mailer. 
 //	$config['smtp_port']    = '8443'; //do not use prot its give error
  $config['smtp_timeout'] = '30';
  $config['smtp_user']    = 'info@rydlr.com';	// enter your bluehost email id Eg. yourname@yourdomain.com
  $config['smtp_pass']    = 'x@@m1006!';		// enter your password
  $config['charset']      = 'utf-8';
  $config['newline']      = "\r\n";
  $config['crlf']      = "\r\n";
 $config['mailtype']     = "html";
 $config['validate']     = TRUE;
/* End of file email.php */
/* Location: ./system/application/config/email.php */
?>
