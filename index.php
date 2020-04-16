<?php
session_start();
include 'connected.php';
include 'header.php';
require 'loginCheck.php';

$sql = "SELECT name phone_num balance last_transaction_id FROM users WHERE name = :name";
$connected->prepare($sql);
$connected = $connectedStmt->bindParam(':name', $_SESSION(['name']), PDO::PARAM_STR);
$result = $connectedStmt->execute();

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
        echo '<table border="1" class="table table-striped">
              <tr>
                <th scope="col">Account Name</th>
                <th scope="col">Account Phone Number</th>
                <th scope="col">Account Balance</th>
                <th scope="col">Last Transaction ID</th>
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

include 'footer.php';
?>