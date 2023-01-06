<?php

// Check that the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Sanitize the form data
  $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_STRING);
  $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);

  // Set the recipient email address
  $to = 'g5trabalhoti@gmail.com';

  // Set the email subject
  $assunto = "$assunto";

  // Build the email content
  $email_content = "Nome: $nome\n";
  $email_content .= "Email: $email\n\n";
  $email_content .= "Mensagem:\n$mensagem\n";

  // Set the email headers
  $headers = "De: $nome <$email>";

  // Send the email
  if (mail($to, $subject, $email_content, $headers)) {
    // Set a 200 (okay) response code.
    http_response_code(200);
    echo 'Thank you for your message. I will get back to you as soon as possible.';
  } else {
    // Set a 500 (internal server error) response code.
    http_response_code(500);
    echo 'An error occurred and your message could not be sent.';
  }
} else {
  // Not a POST request, set a 403 (forbidden) response code.
  http_response_code(403);
  echo 'There was a problem with your submission, please try again.';
}

?>