<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Transactions.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$withdrawals = new Transactions();
$transaction_type = "WITHDRAWAL";
unset($_SESSION['transaction_type']);
unset($_SESSION['withdrawal']);
unset($_SESSION['search']);
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_transactions.php'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <header class="panel-heading">
                            Withdrawals
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
                                    <th>Transaction ID</th>
                                    <th>Account Number</th>
                                    <th>Amount <?php echo '(' . $_SESSION['chapter_details']['currency'] . ')'; ?></th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                                <?php
                                if (isset($_SESSION['account'])) { 
                                    $info = $withdrawals->getAllAccountTransactions($transaction_type);
                                } else if (!empty($_POST) AND !isset($_POST['create_pdf'])) {
                                    $info = $withdrawals->execute();
                                } else if (is_menu_set('view_withdrawals_notifications') != "") {
                                    $info = $withdrawals->getAllTransactionNotifications($transaction_type);
                                } else {
                                    $info = $withdrawals->getAllTransactions($transaction_type);
                                }
                                
                                if (isset($_POST['create_pdf'])) {
                                    $_SESSION['author'] = $_SESSION['user_details']['firstname'] . ' ' . $_SESSION['user_details']['lastname'];
                                    $_SESSION['document_name'] = 'withdrawals.pdf';
                                    $_SESSION['title'] = 'Withdrawals';
                                    $_SESSION['key_words'] = 'withdrawal';
                                    $_SESSION['pdf_header_title'] = 'Withdrawals';
                                    $_SESSION['pdf_content'] = $info;
                                    $_SESSION['column_widths'] = array(50, 110, 60, 50);
                                    $_SESSION['column_titles'] = array('DATE CREATED', 'TRANSACTION ID', 'ACCOUNT NUMBER', 'AMOUNT');
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

                                        $staff_details_createdby = $users->fetchStaffDetails($data['createdby']);

                                        echo '<tr>';
                                        echo "<td> <a href='?view_withdrawals_individual&code=" . $data['id'] . "'>" . $data['id'] . '</td>';
                                        echo '<td>' . $data['account_number'] . '</td>';
                                        echo '<td>' . number_format($data['amount'], 2) . '</td>';
                                        echo '<td>' . date("Y-m-d H:i:s", $data['createdat']) . '</td>';
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