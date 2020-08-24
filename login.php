<?php
include 'connected.php';
include 'header.php';

echo 'you are not signed in. Please sign in to continue or create an account.';
echo '
<br>
<br>';
echo '<form method="post" action="">
            Username: <input type="text" name="user_name" required>
            Password: <input type="password" name="user_pass" required>
            <input type="submit" value="Sign in" />
         </form>
         <button class="btn btn-primary" onclick="href= signnup.php" href="signup.php">Create an account</button>';
         
         if(!$result)
            {
                //something went wrong, display the error
                echo 'Something went wrong while signing in. Please try again later.';
                //echo mysqli_error(); //debugging purposes, uncomment when needed
            }
            else
            {
                //the query was successfully executed, there are 2 possibilities
                //1. the query returned data, the user can be signed in
                //2. the query returned an empty result set, the credentials were wrong
                if($connected->rowCount($result) == 0)
                {
                    echo 'You have supplied a wrong user/password combination. Please try again.';
                }
                else
                {
                    //set the $_SESSION['signed_in'] variable to TRUE
                    $_SESSION['signed_in'] = true;
                     
                    //we also put the user_id and user_name values in the $_SESSION, so we can use it at various pages
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $_SESSION['user_id']    = $row['user_id'];
                        $_SESSION['user_name']  = $row['user_name'];
                        $_SESSION['user_level'] = $row['user_level'];
                    }
                     
                    echo 'Welcome, ' . $_SESSION['user_name'] . '. <a href="index.php">Proceed to the forum overview</a>.';
                }
            }
?>
