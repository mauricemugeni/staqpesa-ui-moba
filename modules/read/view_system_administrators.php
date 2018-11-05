<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$users = new Users();
unset($_SESSION['system_administrator']);
unset($_SESSION['search']);
?>


<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_institutions_staqpesa.php'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <header class="panel-heading">
                            System Administrators
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
                                    <th>Administrator ID</th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Institution</th>
                                    <th>Status</th>
                                </tr>
                                <?php
                                if (!empty($_POST) AND !isset($_POST['create_pdf'])) {
                                    $info = $users->execute();
                                } else if (is_menu_set('view_system_administrators_notifications') != "") {
                                    $info = $users->getAllSystemAdministratorNotifications();
                                } else if (isset($_SESSION['staqpesa_admin']) AND $_SESSION['staqpesa_admin'] == true) {
                                    $info = $users->getAllSystemAdministrators();
                                } else if (isset($_SESSION['staqpesa_staff']) AND $_SESSION['staqpesa_staff'] == true) {
                                    $info = $users->getAllOtherInstitutionsSystemAdministrators();
                                }
                                
                                if (isset($_POST['create_pdf'])) {
                                    $_SESSION['author'] = $_SESSION['user_details']['firstname'] . ' ' . $_SESSION['user_details']['lastname'];
                                    $_SESSION['document_name'] = 'system administrators.pdf';
                                    $_SESSION['title'] = 'System Administrators';
                                    $_SESSION['key_words'] = 'admin, administrator';
                                    $_SESSION['pdf_header_title'] = 'System Administrators';
                                    $_SESSION['pdf_content'] = $info;
                                    $_SESSION['column_widths'] = array(45, 25, 75, 70, 55);
                                    $_SESSION['column_titles'] = array('DATE CREATED', 'ADMIN ID', 'ADMIN NAME', 'INSTITUTION', 'STATUS');
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

                                        $institution_details = $settings->fetchInstitutionDetails($data['institution']);
                                        
                                        echo '<tr>';
                                        echo "<td> <a href='?view_system_administrators_individual&code=" . $data['id'] . "'>" . $data['id'] . '</td>';                                        
                                        echo '<td>' . $data['firstname'] . " " . $data['lastname'] . '</td>';
                                        echo '<td>' . $data['phone_number'] . '</td>';
                                        echo '<td>' . $data['email'] . '</td>';
                                        echo '<td>' . $institution_details['company_name'] . '</td>';
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