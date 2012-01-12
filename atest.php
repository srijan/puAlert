<?php
require_once "constants.php"
$msg = "This service is still in beta. Please excuse unwanted messages.";

foreach($phone_receivers as $pr ) {
  $phone = $pr;
  $content =  'uid='.rawurlencode($uid).
    '&pwd='.rawurlencode($pwd).
    '&phone='.rawurlencode($phone).
    '&msg='.rawurlencode($msg).
    '&codes=1'.  // Use if you need a user freindly response message.
    '&provider='.rawurlencode($provider);

  $sms_response = file_get_contents('http://ubaid.tk/sms/sms.aspx?'.$content);
  echo $sms_response;
}

?>
