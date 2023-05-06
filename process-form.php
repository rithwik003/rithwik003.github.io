<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $message = test_input($_POST["message"]);

  // Validate the name
  if (empty($name)) {
    $nameErr = "Name is required";
  }

  // Validate the email
  if (empty($email)) {
    $emailErr = "Email is required";
  } else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  // Validate the message
  if (empty($message)) {
    $messageErr = "Message is required";
  }

  // If there are no errors, send the email
  if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
    $to = "amaraneni.rithwik@gmail.com";
    $subject = "New message from your portfolio website";
    $message_body = "Name: $name\n\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-type: text/plain\r\n";

    if (mail($to, $subject, $message_body, $headers)) {
      header("Location: thank-you.php");
      exit;
    } else {
      $messageErr = "There was an error sending your message. Please try again later.";
    }
  }
}

// Function to test and sanitize input data
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
