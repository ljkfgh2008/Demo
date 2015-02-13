<?php



if(!$_POST) exit;



function tommus_email_validate($email) { return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email); }


$name = $_POST['name']; $email = $_POST['email']; $comments = $_POST['comments'];



if(trim($name) == '') {

	exit('<div class="error_message">Attention! You must enter your name.</div>');

} else if(trim($name) == 'Name') {

	exit('<div class="error_message">Attention! You must enter your name.</div>');

} else if(trim($email) == '') {

	exit('<div class="error_message">Attention! Please enter a valid email address.</div>');

} else if(!tommus_email_validate($email)) {

	exit('<div class="error_message">Attention! You have entered an invalid e-mail address.</div>');

} else if(trim($comments) == 'Comment') {

	exit('<div class="error_message">Attention! Please enter your message.</div>');

} else if(trim($comments) == '') {

	exit('<div class="error_message">Attention! Please enter your message.</div>');

} if(get_magic_quotes_gpc()) { $comments = stripslashes($comments); }



$address = 'hello@email.com';



$e_subject = 'You\'ve been contacted by ' . $name . '.';

$e_body = "You have been contacted by $name from your contact form, their additional message is as follows." . "\r\n" . "\r\n";

$e_content = "\"$comments\"" . "\r\n" . "\r\n";

$e_reply = "You can contact $name via email, $email";



$msg = wordwrap( $e_body . $e_content . $e_reply, 70 );



$headers = "From: $email" . "\r\n";

$headers .= "Reply-To: $email" . "\r\n";

$headers .= "MIME-Version: 1.0" . "\r\n";

$headers .= "Content-type: text/plain; charset=utf-8" . "\r\n";

$headers .= "Content-Transfer-Encoding: quoted-printable" . "\r\n";



if(mail($address, $e_subject, $msg, $headers)) { echo "<fieldset><div id='success_page'><h3>Email Sent Successfully.</h3><p>Thank you $name, your message has been submitted to us.</p></div></fieldset>"; }