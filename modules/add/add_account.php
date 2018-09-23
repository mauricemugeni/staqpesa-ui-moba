<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Transactions.php";
$transactions = new Transactions();
$settings = new Settings();
$users = new Users();

if (!empty($_POST)) {


//    if ($users_management->checkIfStaffExists($_POST['recruited_by']) == true AND $users_management->checkIfAccountExists($_POST['referee']) == true) {
//    if ($_POST['createdby'] < 1000) {
//        if (strlen($_POST['createdby']) == 1) {
//            $number_createdby = "000" . $_POST['createdby'];
//        } else if (strlen($_POST['createdby']) == 2) {
//            $number_createdby = "00" . $_POST['createdby'];
//        } else if (strlen($_POST['createdby']) == 3) {
//            $number_createdby = "0" . $_POST['createdby'];
//        }
//    } else {
//        $number_createdby = $_POST['createdby'];
//    }
//    $branch_details = $settings->fetchBranchDetails($_SESSION['user_details']['branch']);
//    $number_datetime = substr(time(), -10);
    $_SESSION['branch'] = $_SESSION['user_details']['branch'];    
    $_SESSION['account_type'] = $_POST['account_type'];
    $_SESSION['account_name'] = $_POST['account_name'];
    $_SESSION['referee'] = $_POST['referee'];
    $_SESSION['recruited_by'] = $_POST['recruited_by'];

    $_SESSION['number_of_shares'] = $_POST['number_of_shares'];
    $_SESSION['value_of_shares'] = $_POST['value_of_shares'];
    $_SESSION['contribution_amount'] = $_POST['contribution_amount'];
    $_SESSION['remittance_mode'] = $_POST['remittance_mode'];
    $_SESSION['contribution_effective_date'] = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];

    $_SESSION['createdby'] = $_POST['createdby'];
//    $_SESSION['createdat'] = time();
    $_SESSION['transaction_type'] = $transactions->getTransactionRefTypeId($_POST['transaction_type']);
//    $_SESSION['transaction_id'] = $transactions->getTransactionId($_POST['transaction_type'], $_POST['createdby'], $_SESSION['createdat'], $_SESSION['branch']);
//    $_SESSION['account'] = $users->getNextAccountNumber($branch_details['code'], $number_createdby, $number_datetime);
//    $_SESSION['ref_type_transactions'] = $settings->getTransactionRefTypeId($_POST['transaction_type']);
    $_SESSION['user_type'] = "ACCOUNT HOLDER";
    $_SESSION['ref_type'] = $users->getUserRefTypeId($_SESSION['user_type']);


    $_SESSION['account_type_details'] = $settings->fetchAccountTypeDetails($_SESSION['account_type']);
    if ($_SESSION['account_type_details']['name'] == "PERSONAL ACCOUNT") {
        App::redirectTo("?add_account_holder");
    } else if ($_SESSION['account_type_details']['name'] == "GROUP/JOINT ACCOUNT") {
        App::redirectTo("?add_group_account_details");
    } else if ($_SESSION['account_type_details']['name'] == "BUSINESS ACCOUNT") {
        App::redirectTo("?add_business_account_details");
    }


//    } else {
//        if ($users_management->checkIfStaffExists($_POST['recruited_by']) == false AND $users_management->checkIfAccountExists($_POST['referee']) == false) {
//            $title = "Oops,";
//            $message = "Incorrect values entered for the recruiter and referee fields. Please check and try again.";
//            echo $feedback->errorFeedback($title, $message);
//        }
//        if ($users_management->checkIfStaffExists($_POST['recruited_by']) == false AND $users_management->checkIfAccountExists($_POST['referee']) == true) {
//            $title = "Oops,";
//            $message = "Seems the recruiter value is incorrect. Please check and try again.";
//            echo $feedback->errorFeedback($title, $message);
//        }
//        if ($users_management->checkIfStaffExists($_POST['recruited_by']) == true AND $users_management->checkIfAccountExists($_POST['referee']) == false) {
//            $title = "Oops,";
//            $message = "Seems the referee value is incorrect. Please check and try again.";
//            echo $feedback->errorFeedback($title, $message);
//        }
//    }
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_new_account.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            <strong>CREATE NEW ACCOUNT</strong>
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
                                <input type="hidden" name="transaction_type" value="MEMBERSHIP APPLICATION">
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <div class="form-group">
                                    <label for="account_type">Account Type:</label>
                                    <select name="account_type" class="form-control">          
                                        <?php echo $settings->getAccountTypes(); ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="account_name">Account Name</label>
                                    <input type="text" class="form-control" id="account_name" name="account_name" placeholder="eg. Mugeni Family Group" required="yes"/>
                                </div>                                
                                <div class="form-group">
                                    <label for="number_of_shares">Number of shares applied for:</label>
                                    <input type="number" class="form-control" id="number_of_shares" name="number_of_shares" value="100" readonly="yes" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="value_of_shares">Value of shares applied for(<?php echo $_SESSION['chapter_details']['currency']; ?>):</label>
                                    <input type="number" class="form-control" id="value_of_shares" name="value_of_shares" value="10000" readonly="yes" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="contribution_amount">Monthly contribution amount(<?php echo $_SESSION['chapter_details']['currency']; ?>):</label>
                                    <input type="number" class="form-control" id="contribution_amount" name="contribution_amount" placeholder="eg. 1000" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="date-group">Contribution Effective Date</label>
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
                                    <label for="remittance_mode">Proposed mode of remittance</label>
                                    <select name="remittance_mode" class="form-control" required="yes">
                                        <option value="">Select Remittance Mode</option>
                                        <option value="MOBILE MONEY">Mobile Money</option>
                                        <option value="CHECK-OFF">Check-off</option> 
                                        <option value="STANDING ORDER">Standing Order</option>           
                                        <option value="DIRECT DEBIT">Direct Debit</option>         
                                    </select> 
                                </div>                               
                                <div class="form-group">
                                    <label for="referee">Referee</label>
                                    <input type="text" class="form-control" id="referee" name="referee" placeholder="Member's A/C No. eg. MOBS00056" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="recruited_by">Recruited By</label>
                                    <input type="text" class="form-control" id="recruited_by" name="recruited_by" placeholder="Staff P/F No. eg. STAFF0003" required="yes"/>
                                </div>
                                <br /><button type="submit" class="btn btn-info">Next</button>
                            </form>
                        </div>
                    </section>
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>
