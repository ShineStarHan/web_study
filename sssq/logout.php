<?php
  session_start();
  unset($_SESSION["id"]);
  unset($_SESSION["name"]);
  
  echo("
       <script>
          location.href = 'index.php';
         </script>
       ");
?>
