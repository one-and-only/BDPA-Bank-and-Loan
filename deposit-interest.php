<?php
include 'interest.php';
include 'connect.php';
include 'header.php';
require 'loginCheck.php';

    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['deposit']))
    {
        deposit();
    }
    function deposit()
    {
        $depositInterest = $connected->prepare('UPDATE users SET balance = balance + :interestEarned');
        $depositInterest = $connectedStmt->bindParam(':interestEarned', $interestEarned, PDO::PARAM_INT);
        $depositInterest = $connectedStmt->execute();   
    }
?>