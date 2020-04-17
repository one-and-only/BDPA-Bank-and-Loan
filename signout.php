<?php
//signout.php
include 'connected.php';
include 'header.php';
require 'loginCheck.php';

session_destroy();

echo "<h3 align='center'>You have successfully signed out. You will automatically be redirected to the login page, or you may safely close this tab if you are finished.</h3>";
sleep(3);
echo '<script>
                    window.location.href = "index.php";
              </script>';
include 'footer.php';
?>