<?php 

$curBalance = $connected->prepare('SELECT balance from users WHERE name = :name');
$curBalance->bindParam(':name', $_SESSION['name'], PDO::PARAM_STR);
$curBalance->execute();

$interestNoPower = $curBalance * 2.71828;
$power = 0.0299 / 365;
$interestEarned = pow($interestEarnedNoPower, $power);

$depositInterest = $connected->prepare('UPDATE users SET balance = balance + :interestEarned');
$depositInterest->bindParam(':interestEarned', $interestEarned, PDO::PARAM_INT);
$depositInterest->execute();

echo '<h3 align="center">You have earned $'. $interestEarned . ' in interet today. This has already been automatically deposited to your account.</h3>';

?>