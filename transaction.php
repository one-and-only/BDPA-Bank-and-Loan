<?php 
include 'header.php';
include 'connected.php';
require 'loginCheck.php';

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

$begin = "BEGIN";
$beginPrep = $connected->prepare($begin);
$beginPrep->execute();

$sqlSubtr = "UPDATE users SET balance = balance - :senderTransaction WHERE name = :sender";
$stmt = $connected->prepare($sqlSubtr);
$stmt = $connected->bindParam(':senderTransaction', $senderTransaction, PDO::PARAM_INT);
$stmt = $connected->bindParam(':senderTransaction', $sender, PDO::PARAM_STR);
$stmt->execute();

$sqlAdd = "UPDATE users SET balance = balance + :receiverTransaction WHERE name = :receiver";
$stmt = $connected->prepare($sqlSubtr);
$stmt = $connected->bindParam(':senderTransaction', $receiverTransaction, PDO::PARAM_INT);
$stmt = $connected->bindParam(':senderTransaction', $receiver, PDO::PARAM_STR);
$stmt->execute();

$balance = "SELECT balance FROM users WHERE name = :sender";
$balancePrep = $connected->prepare($balance);
$balancePrep->bindParam(':sender', $sender, PDO::PARAM_STR);
$balancePrep->execute();

if($balancePrep < 0) {
    $undo = "ROLLBACK";
    $undoPrep = $connected->prepare($undo);
    $undoPrep->execute();
}

include 'footer.php';
?>