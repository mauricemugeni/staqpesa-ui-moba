<?php
if (!App::isLoggedIn()) App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Transitional.php";
$transitional_data = new Transitional();
$users = new Users();
$account_details = $users->fetchAccountDetails($_SESSION['account']);

if (!empty($_POST)) {
    $success = $transitional_data->execute();
    if ($success['status'] == 200) {
        $_SESSION['add_success'] = true;
        $_SESSION['feedback_message'] = "<strong>Successful:</strong> The withdrawal transaction has been effected successfully.";
        App::redirectTo("?transitional_view_accounts_individual&code={$_SESSION['account']}");
    } else {
        $_SESSION['add_fail'] = true;
        $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error effecting the withdrawal transaction. Please try again.";
    }
}
?>



<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_transactions.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Customer Withdrawal(Transitional)
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
                                <input type="hidden" name="action" value="transitional_add_withdrawal"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid'];   ?>"/>
                                <input type="hidden" name="transaction_type" value="WITHDRAWAL"/>
                                <div class="form-group">
                                    <label for="account_name">Account Number:</label>
                                    <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Account Number" value="<?php echo $_SESSION['account']; ?>" readonly="true" />
                                </div>
                                <div class="form-group">
                                    <label for="account_name">Account Name:</label>
                                    <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Name" value="<?php echo $account_details['account_name']; ?>" readonly="true" />
                                </div>
                                <div class="form-group">
                                    <label for="transaction_id">Transaction ID:</label>
                                    <input type="text" class="form-control" id="transacttion_id" name="transaction_id" placeholder="Transaction ID" />
                                </div>
                                <div class="form-group">
                                    <label for="amount">Withdrawal Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="amount" name="amount" placeholder="Withdrawal Amount" required="true"/>
                                </div>
                                <div class="form-group">
                                    <label for="service_charge">Service Charge Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="service_charge" name="service_charge" placeholder="Service Charge Amount" required="true"/>
                                </div>
                                <div class="form-group">
                                    <label for="ledger_balance">Ledger Balance <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="ledger_balance" name="ledger_balance" placeholder="Ledger Balance" required="true"/>
                                </div>
                                <div class="form-group">
                                    <label for="transactedby">Withdrawn By</label>
                                    <input type="text" class="form-control" id="transactedby" name="transactedby" placeholder="Withdrawn By" required="true"/>
                                </div>
                                <div class="form-group">
                                    <label for="date-group2">Date of Withdrawal</label>
                                    <div class="row" id="date-group2">
                                        <div class="col-lg-3">
                                            <select id="day" name="day2" class="form-control">          
                                                <?php include 'modules/snippets/day.php'; ?>
                                            </select> 
                                        </div>
                                        <div class="col-lg-6">
                                            <select id="month" name="month2" class="form-control">          
                                                <?php include 'modules/snippets/month.php'; ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <select id="year" name="year2" class="form-control">  
                                                <?php include 'modules/snippets/year.php'; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="date-group">Date of Approval</label>
                                    <div class="row" id="date-group">
                                        <div class="col-lg-3">
                                            <select id="day" name="day" class="form-control">          
                                                <?php include 'modules/snippets/day.php'; ?>
                                            </select> 
                                        </div>
                                        <div class="col-lg-6">
                                            <select id="month" name="month" class="form-control">          
                                                <?php include 'modules/snippets/month.php'; ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <select id="year" name="year" class="form-control">  
                                                <?php include 'modules/snippets/year.php'; ?>
                                            </select>
                                        </div>
                                    </div>
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