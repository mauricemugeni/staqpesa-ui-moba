<?php

require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$component = $_GET['component'];
$user_type = $_GET['user_type'];
$user_id = $_GET['user_id'];
$privilege = $_GET['privilege'];
$update_type = $_GET['update_type'];

if ($component == "user_privileges") {
    $users->updateRoleUserPrivileges($update_type, $component, $user_type, $user_id, $privilege);
} else if ($component == "role_privileges") {
    $users->updateRoleUserPrivileges($update_type, $component);
}

?>