<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
$users = new Users();
$settings = new Settings();
unset($_SESSION['staff']);
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
                            Staff
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
                                    <th>Staff ID</th>
                                    <th>Name</th>
                                    <th>Institution</th>
                                    <th>Branch</th>
                                    <th>Position</th>
                                    <th>Status</th>
                                </tr>
                                <?php
                                if (!empty($_POST) AND !isset($_POST['create_pdf'])) {
                                    $info = $users->execute();
                                } else if (is_menu_set('view_staff_notifications') != "") {
                                    $info = $users->getAllStaffNotifications();
                                } else if (isset($_SESSION['staqpesa_admin']) AND $_SESSION['staqpesa_admin'] == true) {
                                    $info = $users->getAllStaff();
                                } else if (isset($_SESSION['staqpesa_staff']) AND $_SESSION['staqpesa_staff'] == true) {
                                    $info = $users->getAllOtherInstitutionsStaff();
                                } else {
                                    $info = $users->getAllInstitutionStaff();
                                }
                                
                                if (isset($_POST['create_pdf'])) {
                                    $_SESSION['author'] = $_SESSION['user_details']['firstname'] . ' ' . $_SESSION['user_details']['lastname'];
                                    $_SESSION['document_name'] = 'staff.pdf';
                                    $_SESSION['title'] = 'Staff';
                                    $_SESSION['key_words'] = 'staff, employee';
                                    $_SESSION['pdf_header_title'] = 'Staff';
                                    $_SESSION['pdf_content'] = $info;
                                    $_SESSION['column_widths'] = array(45, 20, 75, 75, 55);
                                    $_SESSION['column_titles'] = array('DATE CREATED', 'STAFF ID', 'STAFF NAME', 'INSTITUTION', 'STATUS');
                                    App::redirectTo("?generatepdf");
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

                                        $position = $users->fetchPositionDetails($data['position']);
                                        $institution = $settings->fetchInstitutionDetails($data['institution']);
                                        $branch = $settings->fetchBranchDetails($data['branch']);

                                        echo '<tr>';
                                        echo "<td> <a href='?view_staff_individual&code=" . $data['id'] . "'>" . $data['id'] . '</td>';
                                        echo '<td>' . $data['firstname'] . " " . $data['middlename'] . " " . $data['lastname'] . '</td>';
                                        echo '<td>' . $institution['company_name'] . '</td>';
                                        echo '<td>' . $branch['name'] . '</td>';
                                        echo '<td>' . $position['name'] . '</td>';
                                        echo '<td>' . $status . '</td>';
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