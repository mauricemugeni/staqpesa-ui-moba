<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Transactions.php";
$transactions = new Transactions();
$loans = new Loans();
$code = $_SESSION['loan'];
$update_type = $_GET['update_type'];
$details = $loans->fetchLoanDetails($code);
// $status_details = $loans->fetchLoanStatusDetails($code);
$transaction_details = $transactions->fetchTransactionDetails($code);
$loan_principal_amount = $loans->fetchLoanPrincipalAmount($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $loans->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_loans");
    }
} else {
    $field = $_GET['field'];
    $success = $loans->updateLoan($field, $code, $update_type);
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = "Record successfully updated";
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_error'] = "Error updating record";
    }
    App::redirectTo("?view_loans");
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
                                <input type="hidden" name="action" value="edit_loan"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <div class="form-group">
                                    <label for="account_number">Account Number</label>
                                    <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Account Number" value="<?php echo $transaction_details['account_number']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="customer_name">Customer Name</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Customer Name" value="<?php echo $transaction_details['transactedby']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="loan_type">Loan Type</label>
                                    <select name="loan_type" class="form-control">        
                                        <?php echo $loans->getLoanTypes(); ?> 
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="principal_amount">Principal Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="principal_amount" name="principal_amount" placeholder="Principal Amount" value="<?php echo $loan_principal_amount; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="duration">Duration in Months</label>
                                    <input type="number" class="form-control" id="duration" name="duration" placeholder="Duration in Days" value="<?php echo $details['duration']; ?>" required="yes"/>
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