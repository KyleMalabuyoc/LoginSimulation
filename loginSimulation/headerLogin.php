<?php
  session_start(); //starts the session in the website
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <header>
      <nav>
        <div class="main-wrapper">
          <ul>
            <li><a href="loginHome.php">Home</a></li>
          </ul>
          <div class="nav-login">
            <?php
              if (isset($_SESSION['u_id'])) { //we are logged in so it is just a logout button on top of the screen
                echo '<form action="includes/logout.inc.php" method="post">
                      <button type="submit" name="submit">Logout</button>
                      </form>';
              }else{ //not logged in so we see the whole nav bar with all the buttons (specifically the login stuff)
                echo '<form action="includes/loggedin.inc.php" method = "POST">
                      <input type="text" name="uid" placeholder="Username/Email">
                      <input type="password" name="pwd" placeholder="Password">
                      <button type="submit" name="submit">Login</button>
                      </form>
                      <a href="signupLogin.php">Sign Up</a>';
              }
            ?>
          </div>
        </div>
      </nav>
    </header>
