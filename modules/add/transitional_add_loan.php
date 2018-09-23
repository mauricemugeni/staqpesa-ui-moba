<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Transactions.php";
require_once WPATH . "modules/classes/Transitional.php";
$transitional_data = new Transitional();
$transactions = new Transactions();
$users = new Users();
$loans = new Loans();
$account_details = $users->fetchAccountDetails($_SESSION['account']);

if (!empty($_POST)) {
    $success = $transitional_data->execute();    
    if ($success['status'] == 200) {
        $_SESSION['add_success'] = true;
        $_SESSION['feedback_message'] = "<strong>Successful:</strong> The loan application has been effected successfully.";
        App::redirectTo("?transitional_view_accounts_individual&code={$_SESSION['account']}");
    } else {
        $_SESSION['add_fail'] = true;
        $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error effecting the loan application. Please try again.";
    }
}
?>


<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_loans.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Customer Loan(Transitional)
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
                                <input type="hidden" name="action" value="transitional_add_loan"/>
                                <input type="hidden" name="transaction_type" value="LOAN APPLICATION"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>

                                <div class="form-group">
                                    <label for="transaction_id">Transaction ID</label>
                                    <input type="text" class="form-control" id="transacttion_id" name="transaction_id" placeholder="Transaction ID" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="loan_type">Loan Type</label>
                                    <select name="loan_type" class="form-control">        
                                        <?php //echo $loans->getLoanTypes(); ?> 
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="principal_amount">Principal Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="principal_amount" name="principal_amount" placeholder="Principal Amount" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="interest">Interest <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="interest" name="interest" placeholder="Interest" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="service_charge">Service Charge Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="service_charge" name="service_charge" placeholder="Service Charge Amount" required="true"/>
                                </div>
                                <div class="form-group">
                                    <label for="duration">Duration in Months</label>
                                    <input type="number" class="form-control" id="duration" name="duration" placeholder="Duration in Months" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="customer_name">Transacted by (Customer Name)</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Transacted by (Customer Name)" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="date-group">Date of Transaction</label>
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
                                <div class="form-group">
                                    <label for="approval_state">Loan Approval Status</label>
                                    <select name="approval_state" class="form-control">
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                    </select> 
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