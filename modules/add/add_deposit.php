<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Transactions.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$deposits = new Transactions();
$account_details = $users->fetchAccountDetails($_SESSION['account']);
$transaction_type = $deposits->getTransactionRefTypeId("DEPOSIT");
$deposit_details = $deposits->fetchLastDepositDetails($_SESSION['account'], $transaction_type);

if (!empty($_POST)) {
    $success = $deposits->execute();
    if ($success['status'] == 200) {
        $_SESSION['add_success'] = true;
        $_SESSION['feedback_message'] = "<strong>Successful:</strong> The deposit transaction has been effected successfully.";
        App::redirectTo("?view_deposits");
    } else {
        $_SESSION['add_fail'] = true;
        $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error effecting the deposit transaction. Please try again.";
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
                            Savings Deposit
                            <?php
                            if (isset($_SESSION['add_fail'])) {
                                echo $_SESSION['add_record_fail'];
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['add_fail']);
                            }
                            ?>
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST"> 
                                <input type="hidden" name="action" value="add_deposit"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <input type="hidden" name="transaction_type" value="DEPOSIT"/>
                                <input type="hidden" name="transactedby" value="<?php echo $_SESSION['user_details']['firstname'] . " " . $_SESSION['user_details']['lastname']; ?>"/>
                                <div class="form-group">
                                    <label for="account_number">Account Number</label>
                                    <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Account Number" value="<?php echo $_SESSION['account']; ?>" readonly="true" />
                                </div>
                                <div class="form-group">
                                    <label for="account_name">Account Name</label>
                                    <input type="text" class="form-control" name="account_name" id="account_name" placeholder="Account Name" value="<?php echo $account_details['account_name']; ?>" readonly="true" />
                                </div>
                                <div class="form-group">
                                    <label for="last_payment_date">Last Payment Date</label>
                                    <input type="text" class="form-control" id="last_payment_date" name="last_payment_date" placeholder="Last Payment Date" value="<?php echo $deposit_details['payment_to_date']; ?>" readonly="true" />
                                </div>      
                                <div class="form-group">
                                    <label for="date-group">Payment to Date</label>
                                    <div class="row" id="date-group">
                                        <div class="col-lg-2">
                                            <select id="day" name="day" class="form-control">          
                                                <?php include 'modules/snippets/day.php'; ?>
                                            </select> 
                                        </div>
                                        <div class="col-lg-6">
                                            <select id="month" name="month" class="form-control">          
                                                <?php include 'modules/snippets/month.php'; ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <select id="year" name="year" class="form-control">  
                                                <?php include 'modules/snippets/year.php'; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="amount">Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount" required="true"/>
                                </div>
                                <div class="form-group">
                                    <label for="payment_method">Payment Method</label>
                                    <select name="payment_method" class="form-control">          
                                        <option value="Bank Deposit">Bank Deposit</option>
                                        <option value="Mobile Money">Mobile Money</option>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="payment_ref_number">Payment Reference Number</label>
                                    <input type="text" class="form-control" id="payment_ref_number" name="payment_ref_number" placeholder="Payment Reference Number" required="true" />
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
                <div class="col-lg-3">
                    <?php require_once('modules/payments/mpesa_payment_guide.php'); ?>
                </div><!--row1-->
                <div class="col-lg-3">
                    <?php require_once('modules/payments/kcb_payment_guide.php'); ?>
                </div><!--row1-->
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>