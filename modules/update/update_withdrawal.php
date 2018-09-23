<?php
if (!App::isLoggedIn()) App::redirectTo("?");
require_once WPATH . "modules/classes/Transactions.php";
$withdrawals = new Transactions();
$code = $_SESSION['withdrawal'];
$update_type = $_GET['update_type'];

$success = $withdrawals->updateTransaction($code, $update_type);
if (is_bool($success) && $success == true) {
    $_SESSION['update_success'] = "Record successfully updated";
} else if (is_bool($success) && $success == false) {
    $_SESSION['update_error'] = "Error updating record";
}
App::redirectTo("?view_withdrawals");
?>