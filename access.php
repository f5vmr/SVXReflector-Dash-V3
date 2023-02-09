<?php
  $username = $_POST["username"];
  $password = $_POST["password"];
echo $username . "</br>";
echo $password . "</br>";
echo $node_user . "</br>";
echo $node_password ."</br>";
  // Get the existing username and password information from the Raspberry Pi
  
  // Check if the user input matches the stored information
  if ($username == $node_user and $password == $node_password) {
    echo "Access granted!"."</br>";
  } else {
    echo "Access denied."."</br>";
  }
?>
