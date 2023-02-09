<?php
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Get the existing username and password information from the Raspberry Pi
  $existing_username = exec("echo $username");
  $existing_password = exec("sudo cat /etc/shadow | grep $USER  | awk -F':' '{print $2}'");

  // Check if the user input matches the stored information
  if ($username == $existing_username && crypt($password, $existing_password) == $existing_password) {
    echo "Access granted!";
  } else {
    echo "Access denied.";
  }
?>
