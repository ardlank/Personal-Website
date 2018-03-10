<?php
    
$to = 'ardlankhalili@gmail.com';
    
$subject = 'Website Contact';
    
$msg = 'Name:' .$_POST['name'] ."\n" ."\n"
      .'Email:' .$_POST['mail'] ."\n" ."\n"
      .'Message:' .$_POST['message'];

// Email Headers
$headers = "MIME-Version: 1.0" ."\r\n";
$headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";

// Additional Headers
$headers .= "From: " .$name. "<".$email.">". "\r\n";
    
mail($to, $subject, $msg, $headers);
    
echo '<script language="javascript">';
echo 'alert("The message was sent")';
echo '</script>';

echo '<script>window.location.href = "index.html";</script>';
?>