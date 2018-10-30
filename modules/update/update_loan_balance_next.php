<?php
if (!App::isLoggedIn()) App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Transactions.php";
$loans = new Loans();
$transactions = new Transactions();
$loan_details = $loans->fetchLoanDetails($_SESSION['loan_number']);
$loan_repayment_details = $loans->fetchLoanRepaymentDetails($_SESSION['loan_number']);
$transaction_details = $transactions->fetchTransactionDetails($_SESSION['loan_number']);

if (!empty($_POST)) {
    $success = $loans->execute();
    if (is_bool($success) && $success == true) {
        $_SESSION['add_success'] = true;
    }
    App::redirectTo("?view_loan_repayments");
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_loans.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Branch
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="update_loan_balance"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>">
                                <input type="hidden" name="transaction_type" value="LOAN SETTLEMENT"/>

                                <div id="status-element">
                                    <div class="form-group">
                                        <span id="loan_number">
                                            <label for="loan_number">Loan Number:</label>
                                            <?php echo $_SESSION['loan_number']; ?> 
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <span id="account_number">
                                            <label for="account_number">Account Number:</label>
                                            <?php echo $transaction_details['account_number']; ?>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <span id="outstanding_balance">
                                            <label for="outstanding_balance">Outstanding Balance <?php echo '(' . $_SESSION['currency'] . ')'; ?>:</label>
                                            <?php echo $loan_balance_details['loan_balance']; ?> 
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <span id="instalment_amount">
                                            <label for="instalment_amount">Instalment Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?>:</label>
                                            <?php echo $loan_details['instalment_amount']; ?> 
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="instalment">Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?>:</label>
                                    <input type="number" class="form-control" id="instalment" name="instalment" placeholder="Instalment Amount"/>
                                </div>
                                <div class="form-group">
                                    <label for="transactedby">Paid In By:</label>
                                    <input type="text" class="form-control" id="transactedby" name="transactedby" placeholder="Paid In By"/>
                                </div>

                                <button type="submit" class="btn btn-info">Update</button>
                            </form>

                        </div>
                    </section>
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>
