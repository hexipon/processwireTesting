<?php namespace ProcessWire; ?>
<?php
$globalData = $pages->get("/global-website-data/");


$email = filter_var($_GET['emailAddress'], FILTER_VALIDATE_EMAIL);
if($email){
    //sent email
$to = $globalData->emailAddress;
$subject = "Contact from Website";
$txt = $_GET['message'];
$headers = "From: $email";

mail($to,$subject,$txt,$headers);

//send confirmation
$to = $email;
$subject = "Auto confirmation";
$txt = "Your email has been sent, please wait up to a week for a response. Thank you.";
$headers = "From: $globalData->emailAddress";

mail($to,$subject,$txt,$headers);

$referer = $pages->get("portfolio")->url;
header($referer);
}else{
$referer = $pages->get("contact")->url;
    
}
header("Location:" . $referer);
?>