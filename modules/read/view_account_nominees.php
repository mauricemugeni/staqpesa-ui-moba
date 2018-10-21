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
            <?php require_once('modules/menus/sub_menu_account.php'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <header class="panel-heading">
                            <strong>ACCOUNT NOMINEES</strong>
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
                                    <th>Reference ID</th>
                                    <th>Account Number</th>
                                    <th>Name</th>
                                    <?php if ($_SESSION['logged_in_user_type_details']['name'] == "ACCOUNT HOLDER") { ?>
                                        <th>Percentage (%)</th>
                                    <?php } else { ?>
                                        <th>Relationship</th>
                                    <?php } ?>
                                    <th>Phone No.</th>
                                    <th>Email Address</th>
                                    <th>Status</th>
                                </tr>
                                <?php
                                if (!empty($_POST) AND ! isset($_POST['create_pdf'])) {
                                    $info = $users->execute();
                                } else if (is_menu_set('view_account_nominees_notifications') != "") {
                                    $info = $users->getAllAccountNomineeNotifications();
                                } else if (isset($_SESSION['account'])) {
                                    $info = $users->getAllAccountNomineesIndividualAccount();
                                } else {
                                    $info = $users->getAllAccountNominees();
                                }

                                if (isset($_POST['create_pdf'])) {
                                    $_SESSION['author'] = $_SESSION['user_details']['firstname'] . ' ' . $_SESSION['user_details']['lastname'];
                                    $_SESSION['document_name'] = 'account_nominees.pdf';
                                    $_SESSION['title'] = 'Account Nominees';
                                    $_SESSION['key_words'] = 'nominee, account nominee';
                                    $_SESSION['pdf_header_title'] = 'Account Nominees';
                                    $_SESSION['pdf_content'] = $info;
                                    $_SESSION['column_widths'] = array(75, 40, 50, 105);
                                    $_SESSION['column_titles'] = array('NAME', 'ACCOUNT NUMBER', 'TELEPHONE', 'EMAIL ADDRESS', 'RELATIONSHIP');
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

                                        echo '<tr>';
                                        echo "<td> <a href='?view_account_nominees_individual&code=" . $data['id'] . "'>" . $data['id'] . '</td>';
                                        echo '<td>' . $data['account_number'] . '</td>';
                                        echo '<td>' . $data['firstname'] . " " . $data['middlename'] . " " . $data['lastname'] . '</td>';
                                        if ($_SESSION['logged_in_user_type_details']['name'] == "ACCOUNT HOLDER") {
                                            echo '<td>' . $data['percentage'] . '</td>';
                                        } else {
                                            echo '<td>' . $data['relationship'] . '</td>';
                                        }
                                        echo '<td>' . $data['phone_number'] . '</td>';
                                        echo '<td>' . $data['email'] . '</td>';
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