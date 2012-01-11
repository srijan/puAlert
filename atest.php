<?php
$uid = '8130824397';
$pwd = '35690';
$phone = '9660004052';
$msg = 'No new messages on PU. Thanks for subscribing.';
$provider = 'fullonsms';

$content =  'uid='.rawurlencode($uid).
  '&pwd='.rawurlencode($pwd).
  '&phone='.rawurlencode($phone).
  '&msg='.rawurlencode($msg).
  '&codes=1'.  // Use if you need a user freindly response message.
  '&provider='.rawurlencode($provider);

$sms_response = file_get_contents('http://ubaid.tk/sms/sms.aspx?'.$content);

echo $sms_response;
?>
