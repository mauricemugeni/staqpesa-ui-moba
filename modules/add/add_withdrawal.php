<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Transactions.php";
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$loans = new Loans();
$withdrawals = new Transactions();
$ledger_balance = $withdrawals->fetchLedgerBalance($_SESSION['account']);
$account_details = $users->fetchAccountDetails($_SESSION['account']);
$account_type_details = $settings->fetchAccountTypeDetails($account_details['account_type']);

if (!empty($_POST)) {
    $next_ledger_balance = $ledger_balance - $_POST['amount'];
    if ($next_ledger_balance < $account_type_details['minimum_balance']) {
        $_SESSION['minimum_bal_fail'] = true;
        $_SESSION['feedback_message'] = "<strong>Error!</strong> This transaction violates the minimum balance requirement. Please review the amounts and try again.";
    } else {
        $success = $withdrawals->execute();
        if ($success['status'] == 200) {
            $_SESSION['add_success'] = true;
            $_SESSION['feedback_message'] = "<strong>Successful:</strong> The withdrawal transaction has been effected successfully.";
            App::redirectTo("?view_withdrawals");
        } else {
            $_SESSION['add_fail'] = true;
            $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error effecting the withdrawal transaction. Please try again.";
        }
    }
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_fosa_transactions.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Customer Withdrawal

                            <?php
                            if (isset($_SESSION['minimum_bal_fail'])) {
                                require_once "modules/snippets/feedback.php";
                                echo $_SESSION['add_record_fail'];
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['minimum_bal_fail']);
                            } else if (isset($_SESSION['add_fail'])) {
                                require_once "modules/snippets/feedback.php";
                                echo $_SESSION['add_record_fail'];
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['add_fail']);
                            }
                            ?>
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="add_withdrawal"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>                        
                                <input type="hidden" name="transaction_type" value="WITHDRAWAL"/>

                                <div class="form-group">
                                    <label for="account_number">Account Number</label>
                                    <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Account Number" value="<?php echo $_SESSION['account']; ?>" readonly="true" />
                                </div>

                                <div class="form-group">
                                    <label for="account_name">Account Name</label>
                                    <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Name" value="<?php echo $account_details['account_name']; ?>" readonly="true" />
                                </div>

                                <div class="form-group">
                                    <label for="account_balance">Account Balance <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="text" class="form-control" id="account_balance" name="account_balance" placeholder="Account Balance" value="<?php echo "KES. " . $ledger_balance; ?>" readonly="true" />
                                </div>

                                <div class="form-group">
                                    <label for="minimum_balance">Minimum Balance <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="text" class="form-control" id="minimum_balance" name="minimum_balance" placeholder="Minimum Balance" value="<?php echo "KES. " . $account_type_details['minimum_balance']; ?>" readonly="true" />
                                </div>

                                <div class="form-group">
                                    <label for="amount">Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount"/>
                                </div>
                                <div class="form-group">
                                    <label for="transactedby">Withdrawn By</label>
                                    <input type="text" class="form-control" id="transactedby" name="transactedby" placeholder="Withdrawn By"/>
                                </div>
                                <div class="form-group checkbox">
                                    <label>
                                        <input type="checkbox" name="terms_and_conditions" value="" required="true"> I accept <?php echo $_SESSION['chapter_details']['chapter_name']; ?> <a href="?website_tac">terms and conditions</a>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-info">Submit</button>
                            </form>

                        </div>
                    </section>
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>