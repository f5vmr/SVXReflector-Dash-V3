<?php
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Get the existing username and password information from the Raspberry Pi
  $existing_username = exec("echo $USER");
  echo $existing_username;
  $existing_password = exec("cat /etc/shadow | grep $existing_username | awk -F':' '{print $2}'");
  echo $password."</br>";
  echo $existing_password."</br>";
echo (crypt($password,$hash))."</br>";
  // Check if the user input matches the stored information
  if ($username == $existing_username && password_verify($password, $existing_password)) {
    echo "Access granted!"."</br>";
  } else {
    echo "Access denied."."</br>";
  }
?>
