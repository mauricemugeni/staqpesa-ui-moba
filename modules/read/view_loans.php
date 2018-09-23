<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Transactions.php";
$transactions = new Transactions();
$users = new Users();
$loans = new Loans();
unset($_SESSION['loan']);
unset($_SESSION['loan_type_name']);
unset($_SESSION['search']);
unset($_SESSION["guarantors_list"]);

?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_loans.php'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <header class="panel-heading">
                            <?php if (is_menu_set('view_account_loans') != "") { ?>
                                Account Loans
                                <?php require_once('modules/menus/sub-sub-menu-buttons.php'); ?>
                            <?php } else { ?>
                                Loans
                                <?php require_once('modules/menus/sub-sub-menu-buttons.php'); ?>
                            <?php }
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
                                    <th>Account Name</th>
                                    <th>Amount <?php echo '(' . $_SESSION['chapter_details']['currency'] . ')'; ?></th>
                                    <!--<th>Duration(Months)</th>-->
                                    <th>Created At</th>
                                    <th>Approval Status</th>
                                    <th>Due Date</th>
                                    <th>Repayment Status</th>
                                </tr>
                                <?php
                                if (!empty($_POST) AND !isset($_POST['create_pdf'])) {
                                    $info = $loans->execute();
                                } else if (is_menu_set('view_loans_notifications') != "") {
                                    $info = $loans->getAllLoanNotifications();
                                } else if (isset($_SESSION['account'])) {
                                    $info = $loans->getAllAccountLoans();
                                } else {
                                    $info = $loans->getAllLoans();
                                }
                                
                                if (isset($_POST['create_pdf'])) {
                                    $_SESSION['author'] = $_SESSION['user_details']['firstname'] . ' ' . $_SESSION['user_details']['lastname'];
                                    $_SESSION['document_name'] = 'loans.pdf';
                                    $_SESSION['title'] = 'Loans';
                                    $_SESSION['key_words'] = 'loan';
                                    $_SESSION['pdf_header_title'] = 'Loans';
                                    $_SESSION['pdf_content'] = $info;
                                    $_SESSION['column_widths'] = array(45, 90, 30, 50, 55);
                                    $_SESSION['column_titles'] = array('DATE CREATED', 'TRANSACTION ID', 'AMOUNT', 'DURATION (MONTHS)', 'STATUS');
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
                                    foreach ($info as $details) {
                                        $loan_status = $loans->fetchLoanStatusDetails($details['id']);
                                        if ($loan_status['status'] == 1001) {
                                            $system_log_details = $users->fetchSystemLogDetails("CREATE", "TRANSACTIONS", $details['id']);
                                            $old_value = json_decode($system_log_details['old_value']);
                                            $createdat = $old_value->createdat;
                                            $account_number = $old_value->account_number;
                                        } else {
                                            $loan_transaction_details = $transactions->fetchTransactionDetails($details['id']);
                                            $account_number = $loan_transaction_details['account_number'];
                                            $createdat = $loan_transaction_details['createdat'];
                                        }

                                        $loan_account_details = $users->fetchAccountDetails($account_number);

                                        if ($loan_status['credit_status'] == 1001) {
                                            $approval_statement = "AWAITING CREDIT APPROVAL";
                                        } else if ($loan_status['account_status'] == 1001 AND ( $loan_status['credit_status'] == 1011 OR $loan_status['credit_status'] == 1031)) {
                                            $approval_statement = "AWAITING ACCOUNT APPROVAL";
                                        } else if ($loan_status['credit_status'] == 1010) {
                                            $approval_statement = "CREDIT APPROVAL REJECTED";
                                        } else if ($loan_status['account_status'] == 1010) {
                                            $approval_statement = "ACCOUNT APPROVAL REJECTED";
                                        } else if (( $loan_status['credit_status'] == 1011 OR $loan_status['credit_status'] == 1031) AND ( $loan_status['account_status'] == 1011 OR $loan_status['account_status'] == 1031)) {
                                            $approval_statement = "APPROVAL ACCEPTED";
                                        }

                                        if ($loan_status['status'] == 1001 OR $loan_status['status'] == 1032) {
                                            $repayment_statement = "PENDING APPROVAL";
                                        } else if ($loan_status['status'] == 1040) {
                                            $repayment_statement = "PENDING MATURITY";
                                        } else if ($loan_status['status'] == 1021) {
                                            $repayment_statement = "LOAN IS ACTIVE";
                                        } else if ($loan_status['status'] == 1020) {
                                            $repayment_statement = "LOAN IS DOMANT/DEFAULTED";
                                        } else if ($loan_status['status'] == 1041) {
                                            $repayment_statement = "LOAN IS SETTLED";
                                        }

                                        $loan_principal_amount = $details['principal_amount'];

//                $loan_principal_amount = $this->fetchLoanPrincipalAmount($details['id']);

                                        echo '<tr>';
                                        echo "<td> <a href='?view_loans_individual&code=" . $details['id'] . "'>" . $details['id'] . '</td>';
                                        echo '<td>' . $loan_account_details['account_name'] . '</td>';
                                        echo '<td>' . number_format($loan_principal_amount, 2) . '</td>';
                                        //  echo '<td>' . $details['duration'] . '</td>';
                                        //    echo '<td>' . date("Y-m-d H:i:s", $approval_status['createdat']) . '</td>';
                                        echo '<td>' . date("Y-m-d H:i:s", $createdat) . '</td>';
                                        echo '<td>' . $approval_statement . '</td>';
                                        echo '<td>' . $details['due_date'] . '</td>';
                                        echo '<td>' . $repayment_statement . '</td>';
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