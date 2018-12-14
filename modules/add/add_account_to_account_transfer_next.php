<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Transactions.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$transactions = new Transactions();
$account_details = $users->fetchAccountDetails($_SESSION['account']);
$recipient_account_details = $users->fetchAccountDetails($_SESSION['recipient_account_number']);

if (!empty($_POST)) {
    $success = $transactions->execute();
    if ($success['status'] == 200) {
        $_SESSION['feedback_message'] = "<strong>Successful:</strong> The funds transfer has been effected successfully.";
        $_SESSION['add_success'] = true;
        App::redirectTo("?view_account_to_account_transfers");
    } else {
        $_SESSION['add_fail'] = true;
        $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error effecting the funds transfer. Please try again.";
        App::redirectTo("?add_account_to_account_transfer");
    }
}
?>


<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_fosa_transactions.php');  ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Transfer to Another Account
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="add_account_to_account_transfer"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <input type="hidden" name="account_number" value="<?php echo $_SESSION['account']; ?>"/>
                                <div class="form-group">
                                    <label for="recipient_account_number">Account Number</label>
                                    <input type="text" class="form-control" id="recipient_account_number" name="recipient_account_number" placeholder="Account Number" value="<?php echo $_SESSION['recipient_account_number']; ?>" readonly="true" />
                                </div>
                                <div class="form-group">
                                    <label for="account_name">Account Name</label>
                                    <input type="text" class="form-control" name="account_name" id="account_name" placeholder="Account Name" value="<?php echo $recipient_account_details['account_name']; ?>" readonly="true" />
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount" required="true"/>
                                </div>
                                <div class="form-group checkbox">
                                    <label>
                                        <input type="checkbox" name="terms_and_conditions" value="" required="true"> I accept ICT Innovators' <a href="?website_tac">terms and conditions</a>
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