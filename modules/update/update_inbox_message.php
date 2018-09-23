<?php

if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$code = $_GET['code'];
$update_type = $_GET['update_type'];

$success = $users->updateInboxMessage($code, $update_type);
if (is_bool($success['message']) && $success['message'] == true) {
    $_SESSION['update_success'] = "Record successfully updated";
} else if (is_bool($success['message']) && $success['message'] == false) {
    $_SESSION['update_error'] = "Error updating record";
}
App::redirectTo("?view_inbox_messages");
?>
