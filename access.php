<?php
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Get the existing username and password information from the Raspberry Pi
  
  // Check if the user input matches the stored information
  if ($username == $node_user && password_verify($password, $node_password)) {
    echo "Access granted!"."</br>";
  } else {
    echo "Access denied."."</br>";
  }
?>
