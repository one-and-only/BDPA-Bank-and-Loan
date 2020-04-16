<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" src="style.css">

<?php
include 'connected.php';
include 'header.php';
require 'loginCheck.php';

$sql = "SELECT name phone_num balance last_transaction_id FROM users WHERE name LIKE ':name'";
$connected->prepare($sql);
$connected->bindParam(':name', $_SESSION(['username']), PDO::PARAM_STR);
$result = $connected->execute();

if(!$result)
{
    echo $connected->errorInfo();
}
else
{
    if($result->rowCount() == 0)
    {
        echo 'You are not logged in. <a href="login.php">Login</a> or <a href="signup.php">create an account</a>!';
    }
    else
    {
        //prepare the table
        echo '<table border="1">
              <tr>
                <th>Account Name</th>
                <th>Account Phone Number</th>
                <th>Account Balance</th>
                <th>Last Transaction ID</th>
              </tr>'; 
             
        while($row = $result->fetch(PDO::FETCH_ASSOC))
        { 
            
         echo   '<tr>';
         echo       '<td>'.$row['name'].'</td>';
         echo       '<td>'.$row['phone_num'].'</td>';
         echo       '<td>'.$row['balance'].'</td>';
         echo       '<td>'.$row['last_transaction_id'].'</td>';
         echo   '</tr>';
            
        }
    }
}

echo "would you like to <a href='transaction.php'>make a transaction</a or view <a href='interest.php'>interest earned today</a>?";

?>