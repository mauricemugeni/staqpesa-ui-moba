<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/System_Administration.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$system_administration = new System_Administration();
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
                            System Privileges
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
                                    <th>Component</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                </tr> 
                                <?php
                                if (!empty($_POST) AND !isset($_POST['create_pdf'])) {
                                    $info = $system_administration->execute();
                                } else if (is_menu_set('view_system_privileges_notifications') != "") {
                                    $info = $system_administration->getAllSystemPrivilegeNotifications();
                                } else {
                                    $info = $system_administration->getAllSystemPrivileges();
                                }
                                
                                if (isset($_POST['create_pdf'])) {
                                    $_SESSION['author'] = $_SESSION['user_details']['firstname'] . ' ' . $_SESSION['user_details']['lastname'];
                                    $_SESSION['document_name'] = 'system privileges.pdf';
                                    $_SESSION['title'] = 'System Privileges';
                                    $_SESSION['key_words'] = 'privilege';
                                    $_SESSION['pdf_header_title'] = 'System Privileges';
                                    $_SESSION['pdf_content'] = $info;
                                    $_SESSION['column_widths'] = array(45, 20, 145, 60);
                                    $_SESSION['column_titles'] = array('DATE CREATED', 'ID', 'PRIVILEGE NAME', 'ASSOCIATED COMPONENT');
                                    App::redirectTo("?generatepdf");
                                }

                                $total_records = count($info);
                                if (count($info) == 0) {
                                    echo "<tr>";
                                    echo "<td>  No record found...</td>";
                                    echo "<td> </td>";
                                    echo "<td> </td>";
                                    echo "<td> </td>";
                                    echo "<td> </td>";
                                    echo "</tr>";
                                    unset($_SESSION['no_records']);
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
                                        echo "<td> <a href='?view_system_privileges_individual&code=" . $data['id'] . "'>" . $data['id'] . "</td>";
                                        echo "<td>" . $data['name'] . "</td>";
                                        echo "<td>" . $data['component'] . "</td>";
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
