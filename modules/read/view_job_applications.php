<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
unset($_SESSION['job_application']);
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
                            Job Applications
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
                                    <th>ID</th>
                                    <th>Position</th>
                                    <th>Name</th>
                                    <th>Phone Number</th>                                     
                                    <th>Education Level</th>
                                    <th>Availability</th> 
                                    <th>Status</th>
                                </tr>                               
                                <?php
                                if (!empty($_POST) AND !isset($_POST['create_pdf'])) {
                                    $info = $users->execute();
                                } else if (is_menu_set('view_job_applications_notifications') != "") {
                                    $info = $users->getAllJobApplicationNotifications();
                                } else {
                                    $info = $users->getAllJobApplications();
                                }
                                $total_records = count($info);
                                
                                if (isset($_POST['create_pdf'])) {
                                    $_SESSION['author'] = $_SESSION['user_details']['firstname'] . ' ' . $_SESSION['user_details']['lastname'];
                                    $_SESSION['document_name'] = 'job applications.pdf';
                                    $_SESSION['title'] = 'Job Applications';
                                    $_SESSION['key_words'] = 'career, job, application, apply, vacancy';
                                    $_SESSION['pdf_header_title'] = 'Job Applications';
                                    $_SESSION['pdf_content'] = $info;
                                    $_SESSION['column_widths'] = array(45, 80, 65, 40, 40);
                                    $_SESSION['column_titles'] = array('DATE CREATED', 'POSITION', 'NAME', 'TELEPHONE', 'AVAILABILITY');
                                    App::redirectTo("?generatepdf");
                                }

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
                                            $status = "APPROVAL REJECTED";
                                        } else if ($data['status'] == 1011) {
                                            $status = "APPROVAL ACCEPTED";
                                        } else if ($data['status'] == 1020) {
                                            $status = "NOT ACTIVE";
                                        } else if ($data['status'] == 1021) {
                                            $status = "ACTIVE";
                                        }
                                        echo "<tr>";
                                        echo "<td> <a href='?view_job_applications_individual&code=" . $data['id'] . "'>" . $data['id'] . "</td>";
                                        echo "<td>" . $data['position'] . "</td>";
                                        echo '<td>' . $data['firstname'] . " " . $data['middlename'] . " " . $data['lastname'] . '</td>';
                                        echo "<td>" . $data['phone_number'] . "</td>";
                                        echo "<td>" . $data['education_level'] . "</td>";
                                        echo "<td>" . $data['availability'] . "</td>";
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
