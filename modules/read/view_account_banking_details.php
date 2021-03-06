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
            <?php
            if (isset($_SESSION['account'])) {
                require_once('modules/menus/sub_menu_account_individual_account.php');
            } else {
                require_once('modules/menus/sub_menu_account.php');
            }
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <header class="panel-heading">
                            <strong>ACCOUNT BANKING DETAILS</strong>
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
                                    <th>Mobile Money No.</th>
                                    <th>Bank A/C Number</th>                                    
                                    <th>Bank Name</th>
                                    <th>Branch Name</th>
                                    <th>Status</th>
                                </tr>
                                <?php
                                if (!empty($_POST) AND !isset($_POST['create_pdf'])) {
                                    $info = $users->execute();
                                } else if (is_menu_set('view_account_banking_details_notifications') != "") {
                                    $info = $users->getAllAccountBankingDetailsNotifications();
                                } else if (isset($_SESSION['account'])) {
                                    $info = $users->getAllIndividualAccountAccountBankingDetails();
                                } else {
                                    $info = $users->getAllAccountBankingDetails();
                                }

                                if (isset($_POST['create_pdf'])) {
                                    $_SESSION['author'] = $_SESSION['user_details']['firstname'] . ' ' . $_SESSION['user_details']['lastname'];
                                    $_SESSION['document_name'] = 'account_banking_details.pdf';
                                    $_SESSION['title'] = 'Account Banking Details';
                                    $_SESSION['key_words'] = 'banking, account banking details';
                                    $_SESSION['pdf_header_title'] = 'Account Banking Details';
                                    $_SESSION['pdf_content'] = $info;
                                    $_SESSION['column_widths'] = array(40, 40, 40, 60, 60, 30);
                                    $_SESSION['column_titles'] = array('ACCOUNT NUMBER', 'MOBILE MONEY NUMBER', 'BANK A/C NUMBER', 'BANK NAME', 'BRANCH NAME', 'STATUS');
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
//                                    echo "<td> </td>";
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
                                        echo "<td> <a href='?view_account_banking_details_individual&code=" . $data['id'] . "'>" . $data['account_number'] . '</td>';
                                        echo '<td>' . $data['mobile_number'] . '</td>';
                                        echo '<td>' . $data['bank_account_number'] . '</td>';
                                        echo '<td>' . $data['bank_name'] . '</td>';
                                        echo '<td>' . $data['bank_branch_name'] . '</td>';
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