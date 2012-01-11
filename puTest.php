<?php
require_once "Mail.php";

$from = "<PU_Alerts>";
$to = "<deepak28290@gmail.com>";$to1="<gauravkumar552@gmail.com>"; $to2="<srijan4@gmail.com>";$to3="<jagan387@gmail.com>";$to4="<>";
$subject = "New Notices on Placement Unit site ";
$body = "Hi,\nThere are new unread notices to be viewed on PU!\n\n";
$host = "mailserver.bits-pilani.ac.in";
$port = "25";
$username = "f2008093";
$password = "deepak28290";

$headers = array ('From' => $from,
  'To' => $to,
  'Subject' => $subject);
$smtp = Mail::factory('smtp',
  array ('host' => $host,
  'port' => $port,
  'auth' => true,
  'username' => $username,
  'password' => $password));


$html=file_get_contents('http://pu/notices_open.php');
$dom = new domDocument; 
$dom->loadHTML($html); 
$dom->preserveWhiteSpace = false; 
$ul = $dom->getElementsByTagName('ul'); 
$i=0;
$j=0;
$temp=$argv[1];
$notices="Showing the notices onDear All,
  ly uploaded after ".$temp."\n\n";
while($i<19){
  if(!strcmp($temp,$ul->item(1)->getElementsByTagName('li')->item($i)->nodeValue)){
    break;	
  }
  $j=$j+1;
  $notices=$notices.$j.". ".$ul->item(1)->getElementsByTagName('li')->item($i)->nodeValue."\n";


  $i=$i+1;	

}
if($j!=0){
  $body=$body.$notices."\nTo view them please visit http://pu/notices_open.php\nThanks for subscribing! Have a wonderful day!\n";
  //echo $body;

  $mail = $smtp->send($to, $headers, $body);
  $mail = $smtp->send($to1, $headers, $body);
  $mail = $smtp->send($to2, $headers, $body);
  $mail = $smtp->send($to3, $headers, $body);
  /*$mail = $smtp->send($to4, $headers, $body);*/
  if (PEAR::isError($mail)) {
    //echo("" . $mail->getMessage() . "");
  } else {
    //          echo("Message successfully sent!");
  }

}       
echo $ul->item(1)->getElementsByTagName('li')->item(0)->nodeValue;
?>
