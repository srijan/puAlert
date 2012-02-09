<?php
error_reporting(E_ERROR);
require_once "Mail.php";

/**
 * Define the following constants in constants.php:
 * $phone_receivers
 * $uid = '1136824597'    // Replace with your phone number
 * $pwd = '35120'         // Replace with your password
 * $provider = 'fullonsms'
 */
require_once "constants.php";

$opts = array(
  'http'=>array(
    'header'=>"Cookie: open_notices_cookie=DUMMY;\r\n"
  )
);

$context = stream_context_create($opts);     
$html=file_get_contents('http://pu.bits-pilani.ac.in/notices_open.php',false,$context);
if($html==false) {
  echo $argv[1];
  return;
}
//echo $html;
$dom = new domDocument;
$dom->loadHTML($html);
$dom->preserveWhiteSpace = false; 
$ul = $dom->getElementsByTagName('ul'); 
$i=0;
$j=0;
$temp=$argv[1];
$notices="Showing the notices only uploaded after ".$temp."\n\n";
$sms = "New notices: \n";
while($i<19){
  if(!strcmp($temp,$ul->item(1)->getElementsByTagName('li')->item($i)->nodeValue)){
    break;
  }
  $j=$j+1;
  $notices=$notices.$j.". ".$ul->item(1)->getElementsByTagName('li')->item($i)->nodeValue."\n";
  $sms=$sms.$j.". ".$ul->item(1)->getElementsByTagName('li')->item($i)->nodeValue."\n";


  $i=$i+1;

}
if($j!=0 && $j!=19){
  $body=$body.$notices."\nTo view them please visit http://pu/notices_open.php\nThanks for subscribing! Have a wonderful day!\n";
  //echo $body;

  // mail sending..
  /*foreach($mail_receivers as $mr ) {
    $headers = array ('From' => $from, 'To' => $mr, 'Subject' => $subject);
    $mail = $smtp->send($mr, $headers, $body);
    if (PEAR::isError($mail)) {
    } else {
    }
  }*/
  // sms sending
  $msg = $sms."\n Go to PU site for details.";

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

}
if($j==19){
  $sms=$sms."1. ".$ul->item(1)->getElementsByTagName('li')->item(0)->nodeValue."\n";
   $msg = $sms."\n Go to PU site for details.";

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

  
}
echo $ul->item(1)->getElementsByTagName('li')->item(0)->nodeValue;
?>
