<?php
    include_once 'headerLogin.php'; //just included the header file so we dont have to re-write everything
 ?>

    <section class = "main-container">
      <div class="main-wrapper">
        <h2>Home</h2>
        <?php
          if(isset($_SESSION['u_id'])){ //isset is true if that variavle $_SESSION was activated in another file
            echo "You are logged in";
          }
         ?>
      </div>
    </section>

  <?php
    include_once 'footerLogin.php';
   ?>
