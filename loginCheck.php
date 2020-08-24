<?php
    
     //At the top of the page check to see whether the user is logged in or not
     if(empty($_SESSION['name']))
    {
        // If they are not, redirect them to the login page.
        echo '<script>
                    window.location.href = "login.php";
              </script>';
        
        // Remember that this die statement is absolutely critical.  Without it,
        // people can view your members-only content without logging in.
        die('User '.$_SESSION['name'].' Authenticated');
    }
?>
    