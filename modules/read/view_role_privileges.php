<?php
if (!App::isLoggedIn()) {
    App::redirectTo("?");
}
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/System_Administration.php";
$system_administration = new System_Administration();
$users = new Users();
if (isset($_GET['privilege'])) {
    $role = $_GET['role'];
    $privilege = $_GET['privilege'];
    $update_type = $_GET['update_type'];
    $users->updateIndividualRolePrivileges($update_type, $role, $privilege);
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_settings.php'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <header class="panel-heading">
                            Role Privileges
                            <?php require_once('modules/menus/sub-sub-menu-buttons.php'); 
                            if (isset($_SESSION['add_success'])) {
                                echo $_SESSION['add_record_success'];
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['add_success']);
                            }
                            ?>
                        </header>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>Privilege ID</th>
                                    <th>Name</th>
                                    <th>Creation Date</th>
                                    <th>Status</th>
                                    <th></th>
                                    <th></th>
                                </tr> 

                                <?php
                                $info = $users->getAllRolePrivileges($_SESSION['role']);
                                if (count($info) == 0) {
                                    echo "<tr>";
                                    echo "<td>No record found.</td>";
                                    echo "<td> </td>";
                                    echo "<td> </td>";
                                    echo "<td> </td>";
                                    echo "<td> </td>";
                                    echo "<td> </td>";
                                    echo "</tr>";
                                } else {
                                    foreach ($info as $data) {
                                        if ($data['status'] == 1020) {
                                            $status = "NOT ACTIVE";
                                            $action = "<a href='?view_role_privileges&role={$data['role']}&privilege={$data['privilege']}&update_type=activate'>ACTIVATE</a>";
                                        } else if ($data['status'] == 1021) {
                                            $status = "ACTIVE";
                                            $action = "<a href='?view_role_privileges&role={$data['role']}&privilege={$data['privilege']}&update_type=deactivate'>DEACTIVATE</a>";
                                        }
                                        
                                        $delete_action = "<a href='?view_role_privileges&role={$data['role']}&privilege={$data['privilege']}&update_type=delete'>DELETE</a>";

                                        echo "<tr>";
                                        $privilege = $system_administration->fetchSystemPrivilegeDetails($data['privilege']);
                                        echo "<td> <a href='?view_role_privileges_individual&code=" . $data['id'] . "'>" . $data['id'] . '</td>';
                                        echo "<td>" . $privilege['name'] . "</td>";
                                        echo "<td>" . date("Y-m-d H:i:s", $data['createdat']) . "</td>";
                                        echo "<td>" . $status . "</td>";
                                        echo "<td>" . $action . "</td>";
                                        echo "<td>" . $delete_action . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </table>
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel -->
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>
