<?php
require_once "Mail.php";

$mail_receivers = array("<deepak28290@gmail.com>","<srijan4@gmail.com>"/*",<gauravkumar552@gmail.com>","<jagan387@gmail.com>","<ntsh.jain@gmail.com>"*/);
$phone_receivers = array("8130824397","7737076417","9772975073","9602214007","9660004052","9828672255");


$from = "<PU_Alerts>";
$subject = "New Notices on Placement Unit site ";
$body = "Hi,\nThere are new unread notices to be viewed on PU!\n\n";
$host = "mailserver.bits-pilani.ac.in";
$port = "25";
$username = "f2008093";
$password = "deepak28290";

/*$smtp = Mail::factory('smtp',
  array ('host' => $host,
  'port' => $port,
  'auth' => true,
  'username' => $username,
  'password' => $password));

if (PEAR::isError($smtp)) {
  echo("<p>" . $smtp->getMessage() . "</p>");
}
 */
$html=file_get_contents('http://pu/notices_open.php');
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
if($j!=0){
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
  $uid = '8130824397';
  $pwd = '35690';
  $msg = $sms+"\n Go to PU site for details.";
  $provider = 'fullonsms';

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
