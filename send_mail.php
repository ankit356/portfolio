<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form values and sanitize
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject'] ?? 'No Subject'));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    // Validate required fields
    if (!$name || !$email || !$message) {
        echo "Please fill in all required fields.";
        exit;
    }

    // Email settings
    $to = "ankitsrivastava356@gmail.com"; // Replace with your email
    $email_subject = "Contact Form: " . $subject;
    $email_body = "You received a message from $name <$email>:\n\n$message";
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send the message.";
    }
} else {
    echo "Invalid request.";
}
?>
