<!DOCTYPE html>
<html>
<head>
    <title>Email sending test</title>
</head>
<body>
<?php
require '../mailer/phpmailer/PHPMailerAutoload.php';
require '../mailer/pelago/Emogrifier.php';
require '../mailer/phpmailer/extras/htmlfilter.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
//Set who the message is to be sent from
$mail->setFrom('from@example.com', 'First Last');
//Set an alternative reply-to address
$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('gilles.migliori@gmail.com');
//Set the subject line
$mail->Subject = 'PHPMailer sendmail test';

$html = file_get_contents('../mailer/email-templates/contact-email.html');
$css = file_get_contents('../mailer/email-templates/contact-email.css');
// Merge css into html (inline-style) for compatibility.
$emogrifier = new Emogrifier();
$emogrifier->setHtml($html);
$emogrifier->setCss($css);
$mergedHtml = $emogrifier->emogrify();
// Filter content to prevent attacks. To block external images, switch false to true.
HTMLFilter($mergedHtml, '', false);
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($mergedHtml, dirname(__FILE__), true);
//Replace the plain text body with one created manually
// $mail->AltBody = 'This is a plain-text message body';
//Attach an image file
$mail->addAttachment('assets/img/wallacegromit.jpg');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>
</body>
</html>
