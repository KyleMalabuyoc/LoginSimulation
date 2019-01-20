<?php

//THIS PAGE IS FOR WHEN WE WANT TO LOGOUT

  if(isset($_POST['submit'])){
    session_start();
    session_unset(); //unsets all those sessions we set earlier
    session_destroy(); //destroys any remaining active sessions
    header("Location: ../loginHome.php");
  }

 ?>
