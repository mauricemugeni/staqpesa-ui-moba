<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Transactions.php";
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$settings = new Settings();
$transactions = new Transactions();
unset($_SESSION['transaction']);
unset($_SESSION['search']);
$transaction_type = "ALL";
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_fosa_transactions.php'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <header class="panel-heading">
                            Transactions
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
                                    <th>Transaction ID</th>
                                    <th>Transaction Type</th>
                                    <th>Date</th>
                                    <th>Amount <?php echo '(' . $_SESSION['chapter_details']['currency'] . ')'; ?></th>
                                    <?php
                                    if (is_menu_set('view_transactions_individual_account') != "" OR $_SESSION['logged_in_user_type_details']['name'] == "ACCOUNT HOLDER") {
                                        echo "<th>Ledger Balance</th>";
                                    } else {
                                        echo "<th>Account Number</th>";
                                    }
                                    ?>
                                    <th>Transacted By</th>
                                </tr>
                                <?php
                                if (!empty($_POST) AND !isset($_POST['create_pdf'])) {
                                    $info = $transactions->execute();
                                } else if (is_menu_set('view_transactions_notifications') != "") {
                                    $info = $transactions->getAllTransactionNotifications($transaction_type);
                                } else if (isset($_SESSION['account'])) {
                                    $info = $transactions->getAllAccountTransactions($transaction_type);
                                } else {
                                    $info = $transactions->getAllTransactions($transaction_type);
                                }
                                
                                if (isset($_POST['create_pdf'])) {
                                    $_SESSION['author'] = $_SESSION['user_details']['firstname'] . ' ' . $_SESSION['user_details']['lastname'];
                                    $_SESSION['document_name'] = 'transactions.pdf';
                                    $_SESSION['title'] = 'Transactions';
                                    $_SESSION['key_words'] = 'transaction';
                                    $_SESSION['pdf_header_title'] = 'Transactions';
                                    $_SESSION['pdf_content'] = $info;
                                    $_SESSION['column_widths'] = array(50, 95, 100, 25);
                                    $_SESSION['column_titles'] = array('DATE CREATED', 'TRANSACTION ID', 'TRANSACTION TYPE', 'AMOUNT');
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

                                        $staff_details_createdby = $users->fetchStaffDetails($data['createdby']);

                                        echo '<tr>';

                                        $settings = new Settings();
                                        $details = $settings->fetchTransactionTypeDetails($data['transaction_type']);
                                        echo "<td> <a href='#'>" . $data['id'] . '</td>';
                                        echo '<td>' . $details['name'] . '</td>';
                                        echo '<td>' . date("Y-m-d H:i:s", $data['createdat']) . '</td>';
                                        echo '<td>' . number_format($data['amount'], 2) . '</td>';
                                        if (is_menu_set('view_transactions_individual_account') != "" OR $_SESSION['logged_in_user_type_details']['name'] == "ACCOUNT HOLDER") {
                                            echo '<td>' . number_format($data['ledger_balance'], 2) . '</td>';
                                        } else {
                                            echo '<td>' . $data['account_number'] . '</td>';
                                        }
                                        echo '<td>' . $data['transactedby'] . '</td>';
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