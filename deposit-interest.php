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
        
        echo '<h3 align="center">You have chosen to deposit your interest. You will automatically be redirected to your Dashboard shortly.</h3>';
        sleep(5);

        header('Location: index.php');

        include 'footer.php';
    }
?>