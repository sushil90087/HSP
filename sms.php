<?php
$to      = '123sushil.123singh@gmail.com';
$subject = 'testing mail ';
$message = 'If we can read this, it means that our fake Sendmail setup works!';
$headers = 'From: sps90087@gmail.com' . "\r\n" .
           'Reply-To: sps90087@gmail.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

if(mail($to, $subject, $message, $headers)) {
    echo 'Email sent successfully!';
} else {
    die('Failure: Email was not sent!');
}
?>