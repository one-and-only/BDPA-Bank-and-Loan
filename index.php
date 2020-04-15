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