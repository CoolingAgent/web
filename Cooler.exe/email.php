<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Check that data was sent to the mailer.
    if ( empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($message)) {
        // Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo "Oops! There was a problem with your submission. Please complete the form and try again.";
        exit;
    }

    // Recipient email address.
    $recipient = "bernave.beltran925@gmail.com";

    // Set the email subject.
    $subject = "New contact from $name";

    // Build the email content.
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Build the email headers.
    $email_headers = "From: $name <$email>";

    // Send the email.
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Set a 200 (okay) response code.
        http_response_code(200);
        echo "Thank You! Your message has been sent.";
    } else {
        // Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }

} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the name
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    if (!preg_match("/^[a-zA-Z0-9]+$/", $name)) {
        die("Invalid name; only letters and numbers allowed.");
    }
    
    // Email validation (FILTER_VALIDATE_EMAIL automatically checks for a valid email format)
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if (!$email) {
        die("Invalid email format.");
    }

    // Custom field validation, allowing specific symbols
    $customField = filter_input(INPUT_POST, 'customField', FILTER_SANITIZE_STRING);
    if (!preg_match("/^[a-zA-Z0-9.,!]+$/", $customField)) {
        die("Invalid input in custom field; only letters, numbers, and .,! symbols allowed.");
    }

    // Process your form (e.g., send an email, save to a database) securely after validation and sanitization
}
?>