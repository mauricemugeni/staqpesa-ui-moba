<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
unset($_SESSION['next_of_kin']);
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
                            Next of Kins
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
                                <th>Name</th>
                                <th>Relationship</th>
                                <th>Phone No.</th>
                                <th>Status</th>
                            </tr>
                            <?php
                            if (!empty($_POST) AND !isset($_POST['create_pdf'])) {
                                $info = $users->execute();
                            } else if (is_menu_set('view_next_of_kins_notifications') != "") {
                                $info = $users->getAllNextOfKinNotifications();
                            } else {
                                $info = $users->getAllNextOfKins();
                            }
                            
                                if (isset($_POST['create_pdf'])) {
                                    $_SESSION['author'] = $_SESSION['user_details']['firstname'] . ' ' . $_SESSION['user_details']['lastname'];
                                    $_SESSION['document_name'] = 'next of kins.pdf';
                                    $_SESSION['title'] = 'Next of Kins';
                                    $_SESSION['key_words'] = 'kin, next of kin';
                                    $_SESSION['pdf_header_title'] = 'Next of Kins';
                                    $_SESSION['pdf_content'] = $info;
                                    $_SESSION['column_widths'] = array(75, 40, 50, 105);
                                    $_SESSION['column_titles'] = array('NAME', 'TELEPHONE', 'RELATIONSHIP', 'REFERENCED USER (USER TYPE & ID)');
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
                                    echo "<td> <a href='?view_next_of_kins_individual&code=" . $data['id'] . "'>" . $data['id'] . '</td>';
                                    echo '<td>' . $ref_type_details['name'] . '</td>';
                                    echo '<td>' . $data['ref_id'] . '</td>';
                                    echo '<td>' . $data['firstname'] . " " . $data['middlename'] . " " . $data['lastname'] . '</td>';
                                    echo '<td>' . $data['relationship'] . '</td>';
                                    echo '<td>' . $data['phone_number'] . '</td>';
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