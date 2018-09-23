<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
unset($_SESSION['contact']);
unset($_SESSION['search']);
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_system_users.php'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <header class="panel-heading">
                            Contacts
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
                                    <th>Reference ID</th>
                                    <th>User Type</th>
                                    <th>User ID</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Residential Area</th>
                                    <th>Status</th>
                                </tr>
                                <?php
                                if (!empty($_POST)) {
                                    $info = $users->execute();
                                } else if (is_menu_set('view_contacts_notifications') != "") {
                                    $info = $users->getAllContactNotifications();
                                } else {
                                    $info = $users->getAllContacts();
                                }
                                $total_records = count($info);
                                if (count($info) == 0) {
                                    echo "<tr>";
                                    echo "<td>  No record found.</td>";
                                    echo "<td> </td>";
                                    echo "<td> </td>";
                                    echo "<td> </td>";
                                    echo "<td> </td>";
                                    echo "<td> </td>";
                                    echo "<td> </td>";
                                    echo "</tr>";
                                } else {
                                    foreach ($info as $data) {
                                        if ($data['status'] == 1000) {
                                            $status = "DELETED";
                                        } else if ($data['status'] == 1001 OR $data['status'] == 1032) {
                                            $status = "AWAITING APPROVAL";
                                        } else if ($data['status'] == 1010) {
                                            $status = "ACTIVE";
                                        } else if ($data['status'] == 1011) {
                                            $status = "ACTIVE";
                                        } else if ($data['status'] == 1020) {
                                            $status = "NOT ACTIVE";
                                        } else if ($data['status'] == 1021) {
                                            $status = "ACTIVE";
                                        }

                                        $ref_type_details = $users->fetchUserTypeDetails($data['ref_type']);

                                        echo '<tr>';
                                        echo "<td> <a href='?view_contacts_individual&code=" . $data['id'] . "'>" . $data['id'] . '</td>';
                                        echo '<td>' . $ref_type_details['name'] . '</td>';
                                        echo '<td>' . $data['ref_id'] . '</td>';
                                        echo '<td>' . $data['phone_number1'] . '</td>';
                                        echo '<td>' . $data['email'] . '</td>';
                                        echo '<td>' . $data['residential_area'] . '</td>';
                                        echo '<td>' . $status . '</td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </table>
                        </div><!-- /.panel-body -->
                        <?php // echo $_SESSION['pagination']; ?>
                    </div><!-- /.panel -->
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>