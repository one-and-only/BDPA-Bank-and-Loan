<?php 
include 'connect.php';
include 'header.php';
require 'loginCheck.php';

$curBalance = $connected->prepare('SELECT balance from users WHERE name = :name');
$curBalance->bindParam(':name', $_SESSION['name'], PDO::PARAM_STR);
$curBalance->execute();

$interestNoPower = $curBalance * 2.71828;
$power = 0.0299 / 365;
$interestEarned = pow($interestEarnedNoPower, $power);

echo '<h3 align="center">You have earned $'. $interestEarned . ' in interest today. Would you like to deposit this to your account?</h3>';
echo '<form align = "center" action="deposit-interest.php" method="post">
<input type="submit" class="btn btn-primary "name="deposit" value="Deposit Your Earned Interest" />
</form>';

echo '<form align = "center" action="no-interest.php" method="post">
<input type="submit" class="btn btn-primary "name="deposit" value="Don\'t Deposit Your Earned Interest" />
</form>';



?>