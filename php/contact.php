<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Invalid request method");
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$comments = $_POST['comments'] ?? '';

$errors = [];

if (empty($name)) {
    $errors[] = "Please enter your name.";
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please enter a valid email address.";
}

if (empty($comments)) {
    $errors[] = "Please enter your message.";
}

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo '<div class="error_message">' . $error . '</div>';
    }
    exit();
}

$address = "lovelyspace1991@gmail.com";
$e_subject = 'You have been contacted by ' . $name;
$e_body = "You have been contacted by $name. Their message is:" . PHP_EOL . PHP_EOL;
$e_content = $comments . PHP_EOL . PHP_EOL;
$e_reply = "You can contact $name via email: $email";

$msg = wordwrap($e_body . $e_content . $e_reply, 70);

$headers = "From: $email" . PHP_EOL;
$headers .= "Reply-To: $email" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;

if (mail($address, $e_subject, $msg, $headers)) {
    echo "<fieldset>";
    echo "<div id='success_page'>";
    echo "<h3>Email Sent Successfully.</h3>";
    echo "<p>Thank you <strong>$name</strong>, your message has been submitted to us.</p>";
    echo "</div>";
    echo "</fieldset>";
} else {
    echo "ERROR!";
}
