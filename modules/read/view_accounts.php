<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$settings = new Settings();
unset($_SESSION['account']);
unset($_SESSION['search']);
//unset($_SESSION['new_login']);
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
                            Accounts
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
                                    <th>Account Number</th>
                                    <th>Account Name</th>
                                    <th>Account Type</th>
                                    <th>Date Created</th>
                                    <th>Contribution Start Date</th>
                                    <th>Status</th>
                                </tr>                               
                                <?php
                                if (!empty($_POST) AND !isset($_POST['create_pdf'])) {
                                    $info = $users->execute();
                                } else if (is_menu_set('view_accounts_notifications') != "") {
                                    $info = $users->getAllAccountNotifications();
                                } else {
                                    $info = $users->getAllAccounts();
                                }

                                if (isset($_POST['create_pdf'])) {
                                    $_SESSION['author'] = $_SESSION['user_details']['firstname'] . ' ' . $_SESSION['user_details']['lastname'];
                                    $_SESSION['document_name'] = 'accounts.pdf';
                                    $_SESSION['title'] = 'Accounts';
                                    $_SESSION['key_words'] = 'accounts';
                                    $_SESSION['pdf_header_title'] = 'Accounts';
                                    $_SESSION['pdf_content'] = $info;
                                    $_SESSION['column_widths'] = array(50, 55, 110, 55);
                                    $_SESSION['column_titles'] = array('DATE CREATED', 'ACCOUNT NUMBER', 'ACCOUNT NAME', 'STATUS');
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

                                        $account_type = $settings->fetchAccountTypeDetails($data['account_type']);

                                        echo '<tr>';

                                        if (is_menu_set('transitional_view_accounts')) {
                                            echo "<td> <a href='?transitional_view_accounts_individual&code=" . $data['account_number'] . "'>" . $data['account_number'] . '</td>';
                                        } else {
                                            echo "<td> <a href='?view_accounts_individual&code=" . $data['account_number'] . "'>" . $data['account_number'] . '</td>';
                                        }
                                        echo '<td>' . $data['account_name'] . '</td>';
                                        echo '<td>' . $account_type['name'] . '</td>';
                                        echo '<td>' . date("Y-m-d H:i:s", $data['createdat']) . '</td>';
                                        echo '<td>' . $data['contribution_effective_date'] . '</td>';
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