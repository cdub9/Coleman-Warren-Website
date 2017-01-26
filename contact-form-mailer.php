<?php

	// Composes an email from the contact form submission and sends an email to me@colemanwarren.com

	require_once 'formvalidator.php';

	if(isset($_POST['submit'])) {
		$validator = new FormValidator();
		$validator->addValidation("name","req","Please enter your name");
		$validator->addValidation("email","email", "Please enter a valid email address");
		$validator->addValidation("email","req","Please enter your email address");

		if($validator->ValidateForm()) {
	        echo "<h2>Validation Success!</h2>";
	    }
	    else {
	        echo "<b>Validation Errors:</b>";
	 
	        $error_hash = $validator->GetErrors();
	        foreach($error_hash as $inpname => $inp_err) {
	          echo "<p>$inpname : $inp_err</p>\n";
	        }
	    }
	}

	$name = $_GET['name'];
	$visitor_email = $_GET['email'];
	$message = $_GET['message'];

	$email_from = "me@colemanwarren.com";
	$email_subject = "ColemanWarren.com Contact Form Submission";
	$email_body = "From $name: $message";

	$to = "me@colemanwarren.com";
	$headers = "Reply-To: $visitor_email \r\n";

	mail($to,$email_subject,$email_body,$headers);

	header('Location: thanks.html');
	exit();

?>