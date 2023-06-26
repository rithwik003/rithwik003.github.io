<?php
/*
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
      header("Location: index.html");
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
}*/


  $name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$message = htmlspecialchars($_POST['message']);

if (!empty($email) && !empty($message)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $filename = 'messages.txt';
        date_default_timezone_set('Asia/Kolkata'); // Replace 'Your/Timezone' with your actual timezone
        $content = "Date: " . date('d F Y h:i:s A') . "\n";
        $content .= "Name: $name\n";
        $content .= "Email: $email\n";
        $content .= "Message: $message\n\n";

        // Save the message to a file
        if (file_put_contents($filename, $content, FILE_APPEND | LOCK_EX) !== false) {
            echo "Your message has been sent successfully.";
        } else {
            echo "Failed to send the message.";
        }
    } else {
        echo "Enter a valid email address!";
    }
} else {
    echo "Email and message fields are required!";
}




?>
