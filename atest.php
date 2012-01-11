<?php
$phone_receivers = array("8130824397","7737076417","9772975073","9602214007","9660004052","9828672255");

$uid = '8130824397';
$pwd = '35690';
$provider = 'fullonsms';
$msg = "Thank you for subscribing to puAlerts on your phone. Rs 100 have been deducted from your mess bill.";

foreach($phone_receivers as $pr ) {
  $phone = $pr;
  $content =  'uid='.rawurlencode($uid).
    '&pwd='.rawurlencode($pwd).
    '&phone='.rawurlencode($phone).
    '&msg='.rawurlencode($msg).
    //'&codes=1'.  // Use if you need a user freindly response message.
    '&provider='.rawurlencode($provider);

  $sms_response = file_get_contents('http://ubaid.tk/sms/sms.aspx?'.$content);
  //echo $sms_response;
}

?>
