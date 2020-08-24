<?php 
include 'connected.php';
include 'header.php';
require 'loginCheck.php';

echo '<h3 align="center">You have chosen to not deposit your interest. You will automatically be redirected to your Dashboard shortly.</h3>';
sleep(5);

echo '<script>
                    window.location.href = "index.php";
              </script>';
include 'footer.php';

?>