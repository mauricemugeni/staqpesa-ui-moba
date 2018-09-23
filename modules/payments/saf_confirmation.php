<?php

//header("Content-Type:application/json");
require_once WPATH . "modules/classes/Transactions.php";
$transactions = new Transactions();

if (!isset($_GET["token"])) {
    echo "Technical error";
    exit();
}

if ($_GET["token"] != 'IP1962mm') {
    echo "Invalid authorization";
    exit();
}

if (!$request = file_get_contents('php://input')) {
    echo "Invalid input";
    exit();
}

//Put the json string that we received from Safaricom to an array
//$array = json_decode($request, true);
//$transaction = $transactions->addMpesaPaymentTransaction($array);

//$array = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
//$transaction = $transactions->addMpesaPaymentTransaction2(json_encode($array));


$transaction = $transactions->addMpesaPaymentTransaction2($request);

if (is_bool($transaction) && $transaction == true) {
    echo '{"ResultCode":0,"ResultDesc":"Confirmation received successfully"}';
}
?>