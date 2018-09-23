<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$settings = new Settings();
unset($_SESSION['account']);
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
                    <section class="panel">
                        <header class="panel-heading">
                            Accounts(Transitional)
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
                                        <th>Account Number</th>
                                        <th>Account Name</th>
                                        <th>Account Type</th>
                                        <th>Account Category</th>
                                        <th>Branch</th>
                                        <th>Status</th>
                                    </tr>
                                   <?php
                            if (!empty($_POST)) {
                                $info = $users->execute();
                            } else if (is_menu_set('view_accounts_notifications') != "") {
                                $info = $users->getAllAccountNotifications();
                            } else {
                                $info = $users->getAllAccounts();
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
                                    $account_category = $settings->fetchAccountCategoryDetails($data['account_category']);
                                    $branch = $settings->fetchBranchDetails($data['branch']);

                                    echo '<tr>';

                                    if (is_menu_set('transitional_view_accounts')) {
                                        echo "<td> <a href='?transitional_view_accounts_individual&code=" . $data['account_number'] . "'>" . $data['account_number'] . '</td>';
                                    } else {
                                        echo "<td> <a href='?view_accounts_individual&code=" . $data['account_number'] . "'>" . $data['account_number'] . '</td>';
                                    }
                                    echo '<td>' . $data['account_name'] . '</td>';
                                    echo '<td>' . $account_type['name'] . '</td>';
                                    echo '<td>' . $account_category['name'] . '</td>';
                                    //    echo '<td>' . $data['branch'] . '</td>';
                                    echo '<td>' . $branch['name'] . '</td>';
                                    echo '<td>' . $status . '</td>';
                                    echo '</tr>';
                                }
                            }
                            ?>

                                </table>
                            </div>

                            <?php // echo $_SESSION['pagination']; ?>
                        
                    </section>
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>