<?php

if (isset($_POST['submit'])) { //clicked submit
  include_once 'loginConnector.php'; //include the connection file

  //these 5 lines take in the inputted data from signupLogin.php and stores it into these variables
  $first = mysqli_real_escape_string($conn,$_POST['first']);
  $last = mysqli_real_escape_string($conn,$_POST['last']);
  $email  = mysqli_real_escape_string($conn,$_POST['email']);
  $uid = mysqli_real_escape_string($conn,$_POST['uid']);
  $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);

  //error handlers
  //if everything has been filled out
  //always check for errors first before success
  //we can also have a few more error handlers (more secure passwords, no usernames as admin, etc.)
  if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
    header("Location: ../signupLogin.php?signup=empty");
    exit();
  }else{ //go in here if everything was filled in
    //check if input characters are valid
    if (!preg_match("/^[a-zA-Z]*$/",$first) || !preg_match("/^[a-zA-Z]*$/",$last)) { //first name has illegal characters
      header("Location: ../signupLogin.php?signup=invalid");
      exit();
    }else{ //we have valid characters
      //check email validity
      if (!FILTER_VAR($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signupLogin.php?signup=invalidemail");
        exit();
      }else{ //valid email
        //check if username has been taken already
        $sql = "SELECT * FROM users WHERE user_uid ='$uid'";
        $result = mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result);//this checks if we actually had results from the sql command

        if ($resultCheck > 0) {
          header("Location: ../signupLogin.php?signup=usertaken");
          exit();
        }else{ //username not taken
          //now we have to hash the password
          $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); //default hashing method
          //insert the user into the database
          $sql = "INSERT INTO users(user_first,user_last,user_email,user_uid,user_pwd) VALUES('$first','$last','$email','$uid','$hashedPwd');";
          //we can reuse the $sql variable because we no longer need that variable after that check up
          mysqli_query($conn,$sql);
          //we dont need to store it into a variable because all we did was insert into the database
          //we didnt want to select anything or retrieve anything from the database
          header("Location: ../signupLogin.php?signup=success");
          exit();
        }
      }
    }
  }

}else{ //didnt click submit
  header("Location: ../signupLogin.php"); //didnt click submit, returns to sign up page
  exit(); //just like a break... stops script from running
}
