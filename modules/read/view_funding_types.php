<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Funding.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$funding = new Funding();
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
                            Funding Types
                            <?php require_once('modules/menus/sub-sub-menu-buttons.php'); 
                            if (isset($_SESSION['add_success'])) {
                                echo $_SESSION['add_record_success'];
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['add_success']);
                            }?>
                        </header>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Created By</th> 
                                     <th>Status</th> 
                                </tr>                               
                                <?php
                                if (!empty($_POST)) {
                                    $info = $funding->execute();
                                } else if (is_menu_set('view_funding_types_notifications') != "") {
                                    $info = $funding->getAllFundingTypeNotifications();
                                } else {
                                    $info = $funding->getAllFundingTypes();
                                }
                                $total_records = count($info);
                                if (count($info) == 0) {
                                    echo "<tr>";
                                    echo "<td>  No record found.</td>";
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
                                            $status = "APPROVAL REJECTED";
                                        } else if ($data['status'] == 1011) {
                                            $status = "APPROVAL ACCEPTED";
                                        } else if ($data['status'] == 1020) {
                                            $status = "NOT ACTIVE";
                                        } else if ($data['status'] == 1021) {
                                            $status = "ACTIVE";
                                        }
                                        
                                        if (is_numeric($data['createdby']) == true) {
                                            $staff_details_createdby = $users->fetchStaffDetails($data['createdby']);
                                            $creator = $staff_details_createdby['firstname'] . " " . $staff_details_createdby['middlename'] . " " . $staff_details_createdby['lastname'];
                                        } else {
                                            $creator = $data['createdby'];
                                        }                

                                        echo "<tr>";
                                        echo "<td> <a href='?view_funding_types_individual&code=" . $data['id'] . "'>" . $data['id'] . "</td>";
                                        echo "<td>" . $data['name'] . "</td>";
                                        echo "<td>" . $data['description'] . "</td>";
                                        echo '<td>' . $creator . '</td>';
                                        echo "<td>" . $status . "</td>";
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
