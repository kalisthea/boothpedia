<?php

  include 'config.php';

  if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phonenum = $_POST['phonenum'];
    $password = $_POST['password'];

    $checkEmail = "SELECT * FROM accounts WHERE email='$email'";
    $result=$conn->query($checkEmail);

    
    if($result->num_rows>0){
      echo "Email already exists!";
    }
    else if (empty($fullname) || empty($email) || empty($phonenum) || empty($password)){
      echo "Please insert valid information";
    }
    else{
      $insertQuery="INSERT INTO accounts(username, email, phonenumber, password, role) VALUES ('$fullname', '$email', '$phonenum', '$password', 'tenant')";

      if($conn->query($insertQuery)==TRUE){
        header("location: home.blade.php");
      }
      else{
        echo "error";
      }
    }
  }

?>