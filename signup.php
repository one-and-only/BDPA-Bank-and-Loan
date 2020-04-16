<?php
//signup.php
include 'connected.php';
include 'header.php';
require 'loginCheck.php';
 
echo '<h3>Sign up</h3>';
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    /*the form hasn't been posted yet, display it
      note that the action="" will cause the form to post to the same page it is on */
    echo '<form method="post" align="center">
        Full Name: <input type="text" name="name" class="form-control" placeholder="John Smith" required>
        Password: <input type="password" class="form-control" placeholder="mypass123" name="pass" required>
        Phone Number: <input type="number" class="form-control" placeholder="1234567890" name="phone_num" required>
        <input type="submit" value="Complete Registration" required>
        </form>';
}
else
{
    /* so, the form has been posted, we'll process the data in three steps:
        1.  Check the data
        2.  Let the user refill the wrong fields (if necessary)
        3.  Save the data 
    */
    $errors = array(); /* declare the array for later use */
     
    if(isset($_POST['name']))
    {
        //the user name exists
        if(!ctype_alnum($_POST['name']))
        {
            $errors[] = 'The username can only contain letters and digits.';
        }
        if(strlen($_POST['name']) > 255)
        {
            $errors[] = 'The username cannot be longer than 255 characters.';
        }
    }

    if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
    {
        echo 'Uh-oh.. a couple of fields are not filled in correctly..';
        echo '<ul>';
        foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
        {
            echo '<li>' . $value . '</li>'; /* this generates a nice error list */
        }
        echo '</ul>';
    }
    else
    {
        //the form has been posted without, so save it
        
        $sql = $connected->prepare('INSERT INTO users (name, phone_num, password) VALUES (:name, :phone_num, :pass)');
        $sql->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
        $sql->bindParam(':phone_num', $_POST['phone_num'], PDO::PARAM_INT);
        $result = $sqlPrep->execute();
        if(!$result)
        {
            //something went wrong, display the error
            echo 'Something went wrong while registering. Please try again later.';
            echo $conected->errorInfo(); //debugging purposes, uncomment when needed
        }
        else
        {
            echo 'Successfully registered. You can now <a href="signin.php">sign in</a> and start posting! :-)';
        }
    }
}
 
include 'footer.php';
?>

