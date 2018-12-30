<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // access
        $secretKey = '6Lc2qoUUAAAAADjyk4NHdS8TMy3LIrfGzhJ3YXmQ';
        $captcha = $_POST['g-recaptcha-response'];

        if(!$captcha){
          echo '<p class="alert alert-warning">Please check the the captcha form.</p>';
          exit;
        }

        # FIX: Replace this email with recipient email
        $mail_to = "ardlankhalili@gmail.com";

        $subject = 'Website Contact';
        
        # Sender Data
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $message = trim($_POST["message"]);

        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);

        if(intval($responseKeys["success"]) !== 1) {
          echo '<p class="alert alert-warning">Please check the the captcha form.</p>';
        } else {
            # Mail Content
            $content = "Name: $name\n";
            $content .= "Email: $email\n\n";
            $content .= "Message:\n$message\n";

            # email headers.
            $headers .= "From: " .$name. "<".$email.">". "\r\n";

            # Send the email.
            $success = mail($mail_to, $subject, $content, $headers);
            if ($success) {
                # Set a 200 (okay) response code.
                http_response_code(200);
                echo '<p class="alert alert-success">Thank You! Your message has been sent.</p>';
            } else {
                # Set a 500 (internal server error) response code.
                http_response_code(500);
                echo '<p class="alert alert-warning">Oops! Something went wrong, we couldnt send your message.</p>';
            }
        }

    } else {
        # Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo '<p class="alert alert-warning">There was a problem with your submission, please try again.</p>';
    }

?>
