<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$loans = new Loans();
$code = $_GET['code'];
$_SESSION['loan_business_data'] = $code;
unset($_SESSION['add_loan_business_data']);
if (isset($_SESSION['transitional_data'])) {
    $transitional_details = $loans->transitionalFetchLoanBusinessDataDetails($_SESSION['loan']);
    if ($transitional_details == false) {        
    $_SESSION['add_loan_business_data'] = true;
    }
} else {
if (isset($_SESSION['loan'])) {
    $details = $loans->fetchLoanBusinessDataDetails($_SESSION['loan']);
    $loan_status_details = $loans->fetchLoanStatusDetails($_SESSION['loan']);
} else {
    $details = $loans->fetchLoanBusinessDataDetails($code);
    $loan_status_details = $loans->fetchLoanStatusDetails($code);
}

if ($details['licensed'] == 1) {
    $status = "YES";
} else if ($details['licensed'] == 0) {
    $status = "NO";
}
$business_type_details = $settings->fetchBusinessTypeDetails($details['business_type']);
$business_form_details = $settings->fetchBusinessFormDetails($details['business_form']);
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
                    <div class="panel">
                        <header class="panel-heading">
                            Business Form Details
                        </header>
                        <div class="panel-body">
                            <div class="action">
                                <?php if (isset($_SESSION['add_loan_business_data'])) { ?>
                                    <div class="action">
                                        <a class="edit-individual" href="?add_loan_business_data" >
                                            Add Loan Business Data Details
                                        </a> 
                                    </div>
                                <?php } else { ?>

                                    <?php if (($loan_status_details['status'] == 1032) AND ( $details['lastmodifiedby'] != $_SESSION['userid'] AND $details['status'] == 1032)) { ?>
                                        <a class="edit-individual" href="?update_loan_business_data&update_type=accept_approval&code=" <?php echo $code; ?> >
                                            Accept Approval
                                        </a>
                                        <a class="edit-individual-warning" href="?update_loan_business_data&update_type=reject_approval&code=" <?php echo $code; ?> >
                                            Reject Approval
                                        </a>
                                        <?php
                                    }
                                    if ($loan_status_details['status'] != 1032) {
                                        ?>
                                        <a class="edit-individual" href="?update_loan_business_data&update_type=edit&code=" <?php echo $code; ?> >
                                            Edit
                                        </a>
                                    <?php } ?>
                                </div>

                                <div id="status-element">
                                    <div class="form-group"> 
                                        <label for="id">ID:</label>
                                        <span class="form-control"><?php echo $details['id']; ?></span>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="eunique_credit">? Credit:</label>
                                        <span class="form-control"><?php echo $details['eunique_credit']; ?></span>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="other_credit">Other Credit:</label>
                                        <span class="form-control"><?php echo $details['other_credit']; ?></span>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="business_type">Business Type:</label>
                                        <span class="form-control"><?php echo $business_type_details['name']; ?></span>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="business_form">Business Form:</label>
                                        <span class="form-control"><?php echo $business_form_details['name']; ?></span>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="business_time">Business Age:</label>
                                        <span class="form-control"><?php echo $details['business_time'] . " YEARS"; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="stock_value">Stock Value <?php echo '(' . $_SESSION['currency'] . ')'; ?>:</label>
                                        <span class="form-control"><?php echo $_SESSION['currency'] . " .". number_format($details['stock_value'], 2); ?></span>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="daily_sales">Daily Sales <?php echo '(' . $_SESSION['currency'] . ')'; ?>:</label>
                                        <span class="form-control"><?php echo $_SESSION['currency'] . " .". number_format($details['daily_sales'], 2); ?></span> 
                                    </div>
                                    <div class="form-group">
                                        <label for="monthly_income">Monthly Income <?php echo '(' . $_SESSION['currency'] . ')'; ?>:</label>
                                        <span class="form-control"><?php echo $_SESSION['currency'] . " .". number_format($details['monthly_income'], 2); ?></span>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="monthly_expenses">Monthly Expenses <?php echo '(' . $_SESSION['currency'] . ')'; ?>:</label>
                                        <span class="form-control"><?php echo $_SESSION['currency'] . " .". number_format($details['monthly_expenses'], 2); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="employees">Number of Employees:</label>
                                        <span class="form-control"><?php echo $details['employees']; ?></span> 
                                    </div>
                                    <div class="form-group">
                                        <label for="licensed">Is Licensed:</label>
                                        <span class="form-control"><?php echo $status; ?></span>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="road">Road:</label>
                                        <span class="form-control"><?php echo $details['road']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="street">Street:</label>
                                        <span class="form-control"><?php echo $details['street']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="location">Location:</label>
                                        <span class="form-control"><?php echo $details['location']; ?></span> 
                                    </div>
                                    <div class="form-group">
                                        <label for="building">Building:</label>
                                        <span class="form-control"><?php echo $details['building']; ?> </span> 
                                    </div>
                                    <div class="form-group"> 
                                        <label for="house_number">House Number:</label>
                                        <span class="form-control"><?php echo $details['house_number']; ?></span> 
                                    </div>
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