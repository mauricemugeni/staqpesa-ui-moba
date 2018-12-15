<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Transactions.php";
require_once WPATH . "modules/classes/Users.php";
$loans = new Loans();
$transactions = new Transactions();
$users = new Users();
if (!isset($_SESSION['loan'])) {
    $_SESSION['loan'] = $_GET['code'];
}
$loan_details = $loans->fetchLoanDetails($_SESSION['loan']);
$loan_status_details = $loans->fetchLoanStatusDetails($_SESSION['loan']);
//$transaction_details = $transactions->fetchTransactionDetails($_SESSION['loan']);
//$createdby = $users->fetchStaffDetails($transaction_details['createdby']);
$loan_type = $loans->fetchLoanTypeDetails($loan_details['loan_type']);
$loan_principal_amount = $loan_details['principal_amount'];

if ($loan_status_details['status'] == 1001) {
    $system_log_details = $users->fetchSystemLogDetails("CREATE", "TRANSACTIONS", $_SESSION['loan']);
    $old_value = json_decode($system_log_details['old_value']);
    $account_number = $old_value->account_number;
    $createdat = $old_value->createdat;
    $createdby_user = $users->fetchStaffDetails($old_value->createdby);
    $createdby = $createdby_user['firstname'] . " " . $createdby_user['middlename'] . " " . $createdby_user['lastname'];
} else {
    $transaction_details = $transactions->fetchTransactionDetails($_SESSION['loan']);
    $createdat = $transaction_details['createdat'];
    $createdby_user = $users->fetchStaffDetails($transaction_details['createdby']);
    $account_number = $transaction_details['account_number'];
    $createdby = $createdby_user['firstname'] . " " . $createdby_user['middlename'] . " " . $createdby_user['lastname'];
}

//$loan_principal_amount = $loans->fetchLoanPrincipalAmount($_SESSION['loan']);
$_SESSION['loan_type_name'] = $loan_type['name'];

$repayable_amount = $loan_principal_amount + $loan_details['interest'];

if ($loan_status_details['credit_status'] == 1001) {
    $_SESSION['loan_active_status'] = 0;
    $approval_statement = "AWAITING CREDIT APPROVAL";
} else if ($loan_status_details['account_status'] == 1001 AND ( $loan_status_details['credit_status'] == 1011 OR $loan_status_details['credit_status'] == 1031)) {
    $_SESSION['loan_active_status'] = 0;
    $approval_statement = "AWAITING ACCOUNT APPROVAL";
} else if ($loan_status_details['credit_status'] == 1010) {
    $_SESSION['loan_active_status'] = 0;
    $approval_statement = "APPLICATION REJECTED";
} else if ($loan_status_details['account_status'] == 1010) {
    $_SESSION['loan_active_status'] = 0;
    $approval_statement = "APPROVAL REJECTED";
} else if (( $loan_status_details['credit_status'] == 1011 OR $loan_status_details['credit_status'] == 1031) AND ( $loan_status_details['account_status'] == 1011 OR $loan_status_details['account_status'] == 1031)) {
    $_SESSION['loan_active_status'] = 1;
    $approval_statement = "APPROVAL ACCEPTED";
}

if ($loan_status_details['status'] == 1001 OR $loan_status_details['status'] == 1032) {
    $repayment_statement = "PENDING APPROVAL";
} else if ($loan_status_details['status'] == 1040) {
    $repayment_statement = "PENDING MATURITY";
} else if ($loan_status_details['status'] == 1021) {
    $repayment_statement = "LOAN IS ACTIVE";
} else if ($loan_status_details['status'] == 1020) {
    $repayment_statement = "LOAN IS DOMANT/DEFAULTED";
} else if ($loan_status_details['status'] == 1041) {
    $repayment_statement = "LOAN IS SETTLED";
} else if ($loan_status_details['status'] == 1010) {
    $repayment_statement = "APPLICATION REJECTED";
}

if ($loan_status_details['credit_status'] == 1000) {
    $credit_status = "DELETED";
} else if ($loan_status_details['credit_status'] == 1001) {
    $credit_status = "AWAITING APPROVAL";
} else if ($loan_status_details['credit_status'] == 1010) {
    $credit_status = "APPLICATION REJECTED";
} else if ($loan_status_details['credit_status'] == 1011) {
    $credit_status = "APPLICATION ACCEPTED";
} else if ($loan_status_details['credit_status'] == 1020) {
    $credit_status = "NOT ACTIVE";
} else if ($loan_status_details['credit_status'] == 1021) {
    $credit_status = "ACTIVE";
}

if ($loan_status_details['account_status'] == 1000) {
    $account_status = "DELETED";
} else if ($loan_status_details['account_status'] == 1001 AND $loan_status_details['credit_status'] == 1010) {
    $account_status = "APPLICATION REJECTED";
} else if ($loan_status_details['account_status'] == 1001 AND $loan_status_details['credit_status'] <> 1010) {
    $account_status = "AWAITING APPROVAL";
} else if ($loan_status_details['account_status'] == 1010) {
    $account_status = "APPROVAL REJECTED";
} else if ($loan_status_details['account_status'] == 1011) {
    $account_status = "APPROVAL ACCEPTED";
} else if ($loan_status_details['account_status'] == 1020) {
    $account_status = "NOT ACTIVE";
} else if ($loan_status_details['account_status'] == 1021) {
    $account_status = "ACTIVE";
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_loans_individual_loan.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel">
                        <header class="panel-heading">
                            Loan Details
                        </header>
                        <div class="panel-body">
                            <?php
                            if (isset($_SESSION['transitional_data']) AND isset($_SESSION['add_success'])) {
                                include 'modules/notification/notify.php';
                                unset($_SESSION['add_success']);
                            } else if (!empty($_POST) AND isset($_SESSION['transitional_data'])) {
                                include 'modules/notification/notify-false.php';
                            }
                            ?>
                            <div class="action">

                                <?php
                                if (isset($_SESSION['institution_staff'])) {
                                    if ($loan_status_details['credit_status'] == 1001) {
                                        ?>
                                        <a class="edit-individual" href="?update_loan&update_type=accept_approval&field=credit_status&code=" <?php echo $_SESSION['loan']; ?> >
                                            Accept Approval
                                        </a>
                                        <a class="edit-individual-warning" href="?update_loan&update_type=reject_approval&field=credit_status&code=" <?php echo $_SESSION['loan']; ?> >
                                            Reject Approval
                                        </a>
                                        <?php
//                                        if ($loan_status_details['status'] == 1001 AND $loan_status_details['account_status'] == 1001) {
                                            ?>
<!--                                            <a class="edit-individual" href="?update_loan&update_type=edit&code=" <?php // echo $_SESSION['loan']; ?> >
                                                Edit
                                            </a> <p />-->
                                            <?php
//                                        }
                                    }

                                    if ($loan_status_details['creditedby'] != $_SESSION['userid']) {

                                        if ($loan_status_details['credit_status'] != 1010 AND $loan_status_details['credit_status'] != 1001) {
                                            ?>

                                            <?php if ($loan_status_details['account_status'] == 1001) { ?>
                                                <a class="edit-individual" href="?update_loan&update_type=accept_approval&field=account_status&code=" <?php echo $_SESSION['loan']; ?> >
                                                    Accept Approval
                                                </a>
                                                <a class="edit-individual-warning" href="?update_loan&update_type=reject_approval&field=account_status&code=" <?php echo $_SESSION['loan']; ?> >
                                                    Reject Approval
                                                </a>
                                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>
                            </div>

                            <div id="status-element">
                                <div class="form-group">
                                    <label for="id">Transaction ID:</label>
                                    <span class="form-control"><?php echo $_SESSION['loan']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="loan_type">Loan Type:</label>
                                    <span class="form-control"><?php echo $loan_type['name']; ?></span> 
                                </div>
                                <div class="form-group">
                                    <label for="account_number">Account Number:</label>
                                    <span class="form-control"><?php echo $account_number; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="principal_amount">Principal Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?>:</label>
                                    <span class="form-control"><?php echo $_SESSION['currency'] . " ." . number_format($loan_principal_amount, 2); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="interest">Cumulative Interest <?php echo '(' . $_SESSION['currency'] . ')'; ?>:</label>
                                    <span class="form-control"><?php echo $_SESSION['currency'] . " ." . number_format($loan_details['interest'], 2); ?></span> 
                                </div>
                                <div class="form-group">
                                    <label for="repayable_amount">Total Repayable Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?>:</label>
                                    <span class="form-control"><?php echo $_SESSION['currency'] . " ." . number_format($repayable_amount, 2); ?></span> 
                                </div>
                                <div class="form-group">
                                    <label for="duration">Duration:</label>
                                    <span class="form-control"><?php echo $loan_details['duration'] . " MONTH(S)"; ?></span> 
                                </div>
                                <div class="form-group">
                                    <label for="due_date">Due Date:</label>
                                    <span class="form-control"><?php echo $loan_details['due_date']; ?></span> 
                                </div>
                                <div class="form-group">
                                    <label for="instalment_amount">Instalment Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?>:</label>
                                    <span class="form-control"><?php echo $_SESSION['currency'] . " ." . number_format($loan_details['instalment_amount'], 2); ?></span> 
                                </div>
                                <div class="form-group">
                                    <label for="createdat">Created At:</label>
                                    <span class="form-control"><?php echo date("Y-m-d H:i:s", $createdat); ?></span> 
                                </div>
                                <div class="form-group">
                                    <label for="createdby">Created By:</label>
                                    <span class="form-control"><?php echo $createdby; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="approval_status">Approval Status:</label>
                                    <span class="form-control"><?php echo $approval_statement; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="repayment_status">Repayment Status:</label>
                                    <span class="form-control"><?php echo $repayment_statement; ?></span> 
                                </div>
                                <div class="form-group">
                                    <label for="credit_status">Credit Status:</label>
                                    <span class="form-control"><?php echo $credit_status; ?></span> 
                                </div>

                                <?php
                                if ($loan_status_details['creditedat'] != NULL) {
                                    $creditedby = $users->fetchStaffDetails($loan_status_details['creditedby']);
                                    ?>

                                    <div class="form-group">
                                        <label for="creditedat">Credited At:</label>
                                        <span class="form-control"><?php echo date("Y-m-d H:i:s", $loan_status_details['creditedat']); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="creditedby">Credited By:</label>
                                        <span class="form-control"><?php echo $creditedby['firstname'] . " " . $creditedby['middlename'] . " " . $creditedby['lastname']; ?></span>
                                    </div>

                                <?php } ?>

                                <div class="form-group">
                                    <label for="account_status">Account Status:</label>
                                    <span class="form-control"><?php echo $account_status; ?></span> 
                                </div>

                                <?php
                                if ($loan_status_details['accountedat'] != NULL) {
                                    $accountedby = $users->fetchStaffDetails($loan_status_details['accountedby']);
                                    ?>

                                    <div class="form-group">
                                        <label for="accountedat">Accounted At:</label>
                                        <span class="form-control"><?php echo date("Y-m-d H:i:s", $loan_status_details['accountedat']); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="accountedby">Accounted By:</label>
                                        <span class="form-control"><?php echo $accountedby['firstname'] . " " . $accountedby['middlename'] . " " . $accountedby['lastname']; ?></span>
                                    </div>

                                <?php } ?>

                                <?php
                                if ($loan_details['lastmodifiedat'] != NULL AND $loan_details['lastmodifiedat'] != NULL) {
                                    $lastmodifiedby = $users->fetchStaffDetails($loan_details['lastmodifiedby']);
                                    ?>

                                    <div class="form-group">
                                        <label for="lastmodifiedat">Last Modified At:</label>
                                        <span class="form-control"><?php echo date("Y-m-d H:i:s", $loan_details['lastmodifiedat']); ?> </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastmodifiedby">Last Modified By:</label>
                                        <span class="form-control"><?php echo $lastmodifiedby['firstname'] . " " . $lastmodifiedby['middlename'] . " " . $lastmodifiedby['lastname']; ?></span>
                                    </div>

                                    <?php
                                }
                                if ($loan_details['lastauthorizedat'] != NULL AND $loan_details['lastauthorizedat'] != NULL) {
                                    $lastauthorizedby = $users->fetchStaffDetails($loan_details['lastauthorizedby']);
                                    ?>

                                    <div class="form-group">
                                        <label for="lastauthorizedat">Last Authorized At:</label>
                                        <span class="form-control"><?php echo date("Y-m-d H:i:s", $loan_details['lastauthorizedat']); ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="lastauthorizedby">Last Authorized By:</label>
                                        <span class="form-control"><?php echo $lastauthorizedby['firstname'] . " " . $lastauthorizedby['middlename'] . " " . $lastauthorizedby['lastname']; ?></span>
                                    </div>

                                <?php } ?>
                            </div>
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel -->
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>