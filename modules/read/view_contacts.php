<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Funding.php";
$funding = new Funding();
$users = new Users();
unset($_SESSION['contact']);
unset($_SESSION['search']);
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_system_contacts.php'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <header class="panel-heading">
                            Contacts
                            <?php
                            require_once('modules/menus/sub-sub-menu-buttons.php');
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
                                    <th>Name</th>
                                    <th>User Type</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Postal Address</th>
                                    <th>Residential Area</th>
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
                                    echo "</tr>";
                                } else {
                                    foreach ($info as $data) {

                                        $ref_type_details = $users->fetchUserTypeDetails($data['ref_type']);

                                        if ($ref_type_details['name'] == "STAFF") {
                                            $user_details = $users->fetchStaffDetails($data['ref_id']);
//                                        } else if ($ref_type_details['name'] == "GUEST") {                                            
                                        } else if ($ref_type_details['name'] == "ACCOUNT HOLDER") {
                                            $user_details = $users->fetchAccountHolderDetails($data['ref_id']);
                                        } else if ($ref_type_details['name'] == "INVESTOR") {
                                            $user_details = $funding->fetchInvestorDetails($data['ref_id']);
                                        } else if ($ref_type_details['name'] == "INSTITUTION") {
                                            $user_details = $users->fetchSystemAdministratorDetails($data['ref_id']);
                                        } else if ($ref_type_details['name'] == "SYSTEM ADMINISTRATOR") {
                                            $user_details = $users->fetchSystemAdministratorDetails($data['ref_id']);
                                        }

                                        echo '<tr>';
                                        echo "<td> <a href='?view_contacts_individual&code=" . $data['id'] . "'>" . $user_details['firstname'] . " " . $user_details['lastname'] . '</td>';
                                        echo '<td>' . $ref_type_details['name'] . '</td>';
                                        
                                        if (is_null($data['phone_number1']) == TRUE OR $data['phone_number1'] == "") {
                                            echo '<td> MISSING </td>';
                                        } else {
                                            echo '<td>' . $data['phone_number1'] . '</td>';
                                        }
                                        if (is_null($data['email']) == TRUE OR $data['email'] == "") {
                                            echo '<td> MISSING </td>';
                                        } else {
                                            echo '<td>' . $data['email'] . '</td>';
                                        }
                                        if (is_null($data['postal_number']) == TRUE OR $data['postal_number'] == "") {
                                            echo '<td> MISSING </td>';
                                        } else {
                                            echo '<td>' . $data['postal_number'] . " - " . $data['postal_code'] . ", " . $data['town'] . '</td>';
                                        }
                                        if (is_null($data['residential_area']) == TRUE OR $data['residential_area'] == "") {
                                            echo '<td> MISSING </td>';
                                        } else {
                                            echo '<td>' . $data['residential_area'] . '</td>';
                                        }
                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </table>
                        </div><!-- /.panel-body -->
                        <?php // echo $_SESSION['pagination'];  ?>
                    </div><!-- /.panel -->
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>