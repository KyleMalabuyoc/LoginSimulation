<?php
//THIS PAGE IS FOR ACCOUNTS THAT HAVE ALREADY BEEN CREATED

session_start(); //starts the session in the website

if (isset($_POST['submit'])){ //check if we clicked the submit button
  include 'loginConnector.php';

  $uid = mysqli_real_escape_string($conn,$_POST['uid']);
  $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);

  //errorhandlers
  //check if inputs are Empty
  if(empty($uid) || empty($pwd)){
    header("Location: ../loginHome.php?login=empty");
    exit();
  }else{ //check if username exist in database, if it doesnt, they need to sign up
    $sql = "SELECT * FROM users WHERE user_uid = '$uid' OR user_email = '$uid'";
    $result = mysqli_query($conn,$sql); //run in the database
    $resultCheck = mysqli_num_rows($result); //finds how many rows were found using the parameters

    if($resultCheck < 1){ //username does not exist
      header("Location: ../loginHome.php?login=error");
      exit();
    }else{ //username exists
      //check if password user typed in matches with database password
      if ($row = mysqli_fetch_assoc($result)) { //(row is an array)taking the data that was returned from when searching the database
        //dehash the password
        $hashedPwdCheck = password_verify($pwd,$row['user_pwd']); //match user password with database password
        if ($hashedPwdCheck == false) { //password didnt match
          header("Location: ../loginHome.php?login=error");
          exit();
        }elseif($hashedPwdCheck == true){
          //log in the user here
          //these sessions allow the user to stay logged in through all pages
          $_SESSION['u_id'] = $row['user_id']; //using this to check if we are logged in
          $_SESSION['u_first'] = $row['user_first'];
          $_SESSION['u_last'] = $row['user_last'];
          $_SESSION['u_email'] = $row['user_email'];
          $_SESSION['u_uid'] = $row['user_uid'];
          header("Location: ../loginHome.php?login=success");
          exit();
        }
      }
    }

  }
}else{ //never clicked submit
  header("Location: ../loginHome.php?login=error");
  exit();
}
