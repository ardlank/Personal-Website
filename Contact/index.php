<?php
	// Message Vars
	$msg = '';
	$msgClass = '';

	// Check For Submit
	if(filter_has_var(INPUT_POST, 'submit')){
		// Get Form Data
		$name = htmlspecialchars($_POST['name']);
		$email = htmlspecialchars($_POST['email']);
		$message = htmlspecialchars($_POST['message']);

		// Check Required Fields
		if(!empty($email) && !empty($name) && !empty($message)){
			// Passed
			// Check Email
			if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
				// Failed
				$msg = 'Please use a valid email';
				$msgClass = 'alert-danger';
			} else {
				// Passed
				$toEmail = 'ardlankhalili@gmail.com';
				$subject = 'Contact Request From '.$name;
				$body = '<h2>Contact Request</h2>
					<h4>Name</h4><p>'.$name.'</p>
					<h4>Email</h4><p>'.$email.'</p>
					<h4>Message</h4><p>'.$message.'</p>
				';

				// Email Headers
				$headers = "MIME-Version: 1.0" ."\r\n";
				$headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";

				// Additional Headers
				$headers .= "From: " .$name. "<".$email.">". "\r\n";

				if(mail($toEmail, $subject, $body, $headers)){
					// Email Sent
					$msg = 'Your email has been sent';
					$msgClass = 'alert-success';
				} else {
					// Failed
					$msg = 'Your email was not sent';
					$msgClass = 'alert-danger';
				}
			}
		} else {
			// Failed
			$msg = 'Please fill in all fields';
			$msgClass = 'alert-danger';
		}
	}
?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" property="og:description" content="Ardlan Khalili's Personal Website">
    <meta name="keywords" content="Ardlan Khalili Personal website, ardlan khalili, Ardlan, Khalili, Ardlan Khalili, software developer, personal, software, developer">
    <meta name="author" content="Ardlan Khalili">
    <meta property="og:site_name" content="ardlank"/>
    <meta property="og:image" content="http://ardlank.com/images/profile-pic.png">
    <meta property="og:title" content="Ardlan Khalili | Contact"/>
    <meta property="og:url" content="http://ardlank.com/Contact">
    <meta property="og:type" content="Ardlan Khalili"/>
    <title>Ardlan Khalili | Contact Me</title>
    <link rel="stylesheet" href="../CSS/contact.css">
    <link rel="stylesheet" href="../CSS/nav.css">
    <link rel="icon" type="image/png" href="../images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../images/favicon-16x16.png" sizes="16x16" />
</head>

<body>
    <ul class="navMain">
        <li><a href="..">Home</a></li>
        <li><a href="../About/">About</a></li>
        <li><a href="../Portfolio/">Portfolio</a></li>
        <li><a href="../Resume/">Resume</a></li>
        <li><a href="../Publicity/">Publicity</a></li>
        <li><a href="../Contact/" id="contact">Contact</a></li>
    </ul>
     <div class="spacer">
        &nbsp;
    </div>
    <div class="spacer2">
        &nbsp;
    </div>
    <div class="container">
    <?php if($msg != ''): ?>
    		<div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
    	<?php endif; ?>
    <h1 class="title">Contact Me</h1>
    <form id="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <ul>
            <li>
                <label for="name" class="label">Name:</label>
                <input type="text" placeholder="Your Name" id="name" name="name" tabindex="1" value="<?php echo isset($_POST['name']) ? $name : ''; ?>"/>
            </li>
            <li>
                <label for="email" class="label">Email:</label>
                <input type="email" placeholder="Your Email" id="email" name="email" tabindex="2"value="<?php echo isset($_POST['email']) ? $email : ''; ?>"/>
            </li>
            <li>
                <label for="message" class="label">Message:</label>
                <textarea placeholder="Message…" id="message" name="message" tabindex="3"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
            </li>
        </ul>
        <button type="submit" name="submit" value="Send Message" id="submit">Submit</button>
    </form>
    </div>
</body>
</html>
