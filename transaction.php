<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" src="style.css">

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
    <h3 style="font-size: medium;" align="center">Your Current Ballance: $curBalance</h3>
</div>
</form>';
$senderTransaction = $_POST['amount'] * -1;
$receiverTransaction = $_POST['amount'];
$sender = $_SESSION['name'];
$receiver = $_POST['to'];

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
?>