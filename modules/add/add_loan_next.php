<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Transactions.php";
$transactions = new Transactions();
$users = new Users();
$loans = new Loans();
$account_details = $users->fetchAccountDetails($_SESSION['account']);
$loan_type_details = $loans->fetchLoanTypeDetails($_SESSION['loan_type']);

if (!empty($_POST)) {
    $instalment_frequency_details = $loans->fetchInstalmentFrequencyDetails($loan_type_details['instalment_frequency']);
    $_SESSION['transaction_type'] = $transactions->getTransactionRefTypeId($_POST['transaction_type']);

    if ($_SESSION['logged_in_user_type_details']['name'] == "ACCOUNT HOLDER") {
        $_SESSION['transactedby'] = $_SESSION['user_details']['firstname'] . " " . $_SESSION['user_details']['middlename'] . " " . $_SESSION['user_details']['lastname'];
    } else {
        $_SESSION['transactedby'] = $_POST['customer_name'];
    }

    $_SESSION['transaction_id'] = $transactions->getTransactionId($_POST['transaction_type'], $_POST['createdby'], $_POST['principal_amount']);
    $_SESSION['principal_amount'] = $_POST['principal_amount'];
    $_SESSION['interest'] = ($_POST['principal_amount'] * $loan_type_details['interest_rate'] * $_POST['duration']) / 100;
    $_SESSION['duration'] = $_POST['duration'];
    $_SESSION['due_date'] = date("Y-m-d H:i:s", strtotime("+" . $_POST['duration'] . "Months"));
    $due_date = new DateTime($_SESSION['due_date']);
    $current_date = new DateTime(date("Y-m-d H:i:s"));
    $interval = $current_date->diff($due_date);
    $interval_days = $interval->format('%a');

    if ($instalment_frequency_details['name'] == "DAILY") {
        $instalment_time = $interval_days;
    } else if ($instalment_frequency_details['name'] == "WEEKLY") {
        $instalment_time = round($interval_days / 7, 2);
    } else if ($instalment_frequency_details['name'] == "MONTHLY") {
        $instalment_time = $_POST['duration'];
    } else if ($instalment_frequency_details['name'] == "ANNUALLY") {
        $instalment_time = $_POST['duration'] / 12;
    }

    $_SESSION['instalment_amount'] = ($_POST['principal_amount'] + $_SESSION['interest']) / $instalment_time;
    $_SESSION['createdby'] = $_POST['createdby'];
    $_SESSION['user_type'] = "LOANEE";
    $_SESSION['ref_type'] = $users->getUserRefTypeId($_SESSION['user_type']);
    $_SESSION['purpose'] = $_POST['purpose'];
    $_SESSION['our_credit_status'] = $_POST['our_credit_status'];

    if ($_SESSION['our_credit_status'] == "YES") {
        $_SESSION['our_credit_amount'] = $_POST['our_credit_amount'];
        $_SESSION['our_credit_date_issued'] = $_POST['year1'] . "-" . $_POST['month1'] . "-" . $_POST['day1'];
    } else {
        $_SESSION['our_credit_amount'] = 0;
        $_SESSION['our_credit_date_issued'] = "2016-01-01";
    }

    $_SESSION['other_credit_status'] = $_POST['other_credit_status'];

    if ($_SESSION['other_credit_status'] == "YES") {
        $_SESSION['other_credit_organization'] = $_POST['other_credit_organization'];
        $_SESSION['other_credit_amount'] = $_POST['other_credit_amount'];
        $_SESSION['other_credit_date_issued'] = $_POST['year2'] . "-" . $_POST['month2'] . "-" . $_POST['day2'];
    } else {
        $_SESSION['other_credit_organization'] = "NONE";
        $_SESSION['other_credit_amount'] = 0;
        $_SESSION['other_credit_date_issued'] = "2016-01-01";
    }

    if ($loan_type_details['name'] == "BUSINESS LOAN") {
        App::redirectTo("?add_loan_business_data");
    } else {
//        App::redirectTo("?add_loan_data");
        App::redirectTo("?add_loan_guarantor");
    }
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
                            Customer Loan Request
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="transaction_type" value="LOAN APPLICATION"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <div class="form-group">
                                    <label for="principal_amount">Principal Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="principal_amount" name="principal_amount" placeholder="eg. 50000" required="yes"/>
                                </div>                                
                                <div class="form-group">
                                    <label for="duration">Duration in Months</label>
                                    <select name="duration" class="form-control" required="true">   
                                        <option value="">Select period</option>

                                        <?php
                                        $start_duration = 1;
                                        $end_duration = (int) $loan_type_details['maximum_duration'];

                                        while ($start_duration <= $end_duration) {
                                            echo '<option value="' . $start_duration . '">' . $start_duration . '</option>';
                                            $start_duration++;
                                        }
                                        ?>

                                    </select> 
                                </div>

                                <div class="form-group">
                                    <label for="purpose">Purpose of Loan</label>
                                    <input type="text" class="form-control" id="purpose" name="purpose" placeholder="eg. Business Expansion" required="yes"/>
                                </div>

                                <!--                                <div class="form-group">
                                                                    <label for="eunique_credit">Outstanding credit from us in <?php // echo '(' . $_SESSION['currency'] . ')';       ?></label>   
                                                                    <input type="number" class="form-control" id="eunique_credit" name="eunique_credit" placeholder="eg. 500000" required="yes"/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="other_credit">Credit from Other Sources in <?php // echo '(' . $_SESSION['currency'] . ')';       ?></label>
                                                                    <input type="number" class="form-control" id="other_credit" name="other_credit" placeholder="eg. 500000" required="yes"/>
                                                                </div>-->

                                <div class="form-group">
                                    <label for="our_credit_status">Do you have any outstanding credit from us:</label>
                                    <select name="our_credit_status" class="form-control one">    
                                        <option value="NO">NO</option>
                                        <option value="YES">YES</option>                                
                                    </select> 
                                </div>
                                <div class="YES boxed">
                                    <div class="form-group">
                                        <label for="our_credit_amount">Loan Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                        <input type="number" class="form-control" id="our_credit_amount" name="our_credit_amount" placeholder="eg. 500000" />
                                    </div>
                                    <div class="form-group">
                                        <label for="date-group">Date of Issue</label>
                                        <div class="row" id="date-group">
                                            <div class="col-lg-3">
                                                <select id="day1" name="day1" class="form-control">          
                                                    <?php include 'modules/snippets/day.php'; ?>
                                                </select> 
                                            </div>
                                            <div class="col-lg-6">
                                                <select id="month1" name="month1" class="form-control">          
                                                    <?php include 'modules/snippets/month.php'; ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-3">
                                                <select id="year1" name="year1" class="form-control">  
                                                    <?php include 'modules/snippets/year.php'; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="other_credit_status">Do you have any outstanding credit from Other Sources:</label>
                                    <select name="other_credit_status" class="form-control double">    
                                        <option value="NO-2">NO</option>
                                        <option value="YES-2">YES</option>                                
                                    </select> 
                                </div>

                                <div class="YES-2 boxing">
                                    <div class="form-group">
                                        <label for="other_credit_organization">Organization Name</label>
                                        <input type="text" class="form-control" id="other_credit_organization" name="other_credit_organization" placeholder="eg, Stima Sacco" />
                                    </div>
                                    <div class="form-group">
                                        <label for="other_credit_amount">Loan Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                        <input type="number" class="form-control" id="other_credit_amount" name="other_credit_amount" placeholder="eg. 500000" />
                                    </div>
                                    <div class="form-group">
                                        <label for="date-group">Date of Issue</label>
                                        <div class="row" id="date-group">
                                            <div class="col-lg-3">
                                                <select id="day2" name="day2" class="form-control">          
                                                    <?php include 'modules/snippets/day.php'; ?>
                                                </select> 
                                            </div>
                                            <div class="col-lg-6">
                                                <select id="month2" name="month2" class="form-control">          
                                                    <?php include 'modules/snippets/month.php'; ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-3">
                                                <select id="year2" name="year2" class="form-control">  
                                                    <?php include 'modules/snippets/year.php'; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($_SESSION['logged_in_user_type_details']['name'] != "ACCOUNT HOLDER") { ?>
                                    <div class="form-group">
                                        <label for="customer_name">Transacted by (Customer Name)</label>
                                        <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="eg. John Fredrick Kennedy" required="yes"/>
                                    </div>
                                <?php } ?>
                                
                                <button type="submit" class="btn btn-info">Next</button>
                            </form>

                        </div>
                    </section>
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>