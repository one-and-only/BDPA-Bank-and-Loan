<?php 
include 'header.php';
include 'connected.php';
require 'loginCheck.php';

$curBalance = $connected->prepare('SELECT balance from users WHERE name = :name');
$curBalance->bindParam(':name', $_SESSION['name'], PDO::PARAM_STR);
$curBalance->execute();

echo '<form method="POST">
<div class="form-group" align="center">
    <p style="font-size: medium;" align="center">Amount: </p><input type="text" name="amount" placeholder="Ex: 1234" required>
    <p style="font-size: medium;" align="center">Who are you transferring the funds to? </p><input type="text" name="to" placeholder="Ex: John Smith" required>
    <br>
    <br>
    <button type="submit" class="btn btn-primary">Initiate the Transaction</button>
    <h3 style="font-size: medium;" align="center">Your Current Balance: '. $curBalance .'</h3>
</div>
</form>';
$senderTransaction = $_POST['amount'] * -1;
$receiverTransaction = $_POST['amount'];
$sender = $_SESSION['name'];
$receiver = $_POST['to'];

$begin = $connected->prepare('BEGIN');
$begin->execute();

$transactionSender = $connected->prepare('UPDATE users SET balance = balance - :senderTransaction WHERE name = :sender');
$transactionSender = $connectedStmt->bindParam(':senderTransaction', $senderTransaction, PDO::PARAM_INT);
$transactionSender = $connectedStmt->bindParam(':senderTransaction', $sender, PDO::PARAM_STR);
$transactionSender->execute();

$sqlAdd = $connected->prepare('UPDATE users SET balance = balance + :receiverTransaction WHERE name = :receiver');
$sqlAdd = $connectedStmt->bindParam(':senderTransaction', $receiverTransaction, PDO::PARAM_INT);
$$sqlAdd = $connectedStmt->bindParam(':senderTransaction', $receiver, PDO::PARAM_STR);
$sqlAdd->execute();

$balance = $connected->prepare('SELECT balance FROM users WHERE name = :sender');
$balance = $connectedStmt->bindParam(':sender', $sender, PDO::PARAM_STR);
$query = $balance->execute();

if($balance < 0 || !$query) {

    $undo = $connected->prepare('ROLLBACK');
    $undo->execute();
    echo 'Your transaction was declined because the recipient, ' . $receiver . ', was not found or your account has insufficient funds. Please check that the recipient you are trying to send funds to exists and that your account has sufficient funds.';
}

include 'footer.php';
?>