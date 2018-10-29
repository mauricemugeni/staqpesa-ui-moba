<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$loans = new Loans();
$code = $_GET['code'];
$_SESSION['loan_data'] = $code;
unset($_SESSION['add_loan_data']);
if (isset($_SESSION['transitional_data'])) {
    $transitional_details = $loans->transitionalFetchLoanDataDetails($_SESSION['loan']);
    if ($transitional_details == false) {        
    $_SESSION['add_loan_data'] = true;
    }
} else {
if (isset($_SESSION['loan'])) {
    $details = $loans->fetchLoanDataDetails($_SESSION['loan']);
    $loan_status_details = $loans->fetchLoanStatusDetails($_SESSION['loan']);
} else {
    $details = $loans->fetchLoanDataDetails($code);
    $loan_status_details = $loans->fetchLoanStatusDetails($code);
}
$marital_status_details = $settings->fetchMaritalStatusDetails($details['marital_status']);
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
                    <div class="panel">
                        <header class="panel-heading">
                            Loan Data Details
                        </header>
                        <div class="panel-body">
                            <div class="action">
                                <?php if (isset($_SESSION['add_loan_data'])) { ?>
                                    <a class="edit-individual" href="?add_loan_data" >
                                        Add Loan Data Details
                                    </a> 
                                <?php } else { ?>
                                    <?php if (($loan_status_details['status'] == 1032) AND ( $details['lastmodifiedby'] != $_SESSION['userid'] AND $details['status'] == 1032)) { ?>
                                        <a class="edit-individual" href="?update_loan_data&update_type=accept_approval&code=" <?php echo $code; ?> >
                                            Accept Approval
                                        </a>
                                        <a class="edit-individual-warning" href="?update_loan_data&update_type=reject_approval&code=" <?php echo $code; ?> >
                                            Reject Approval
                                        </a>
                                        <?php
                                    }
                                    if ($loan_status_details['status'] != 1032) {
                                        ?>
                                        <a class="edit-individual" href="?update_loan_data&update_type=edit&code=" <?php echo $code; ?> >
                                            Edit
                                        </a>
                                    <?php } ?>
                                </div>

                                <div id="status-element">
                                    <div class="form-group">
                                        <label for="id">Loan ID:</label>
                                        <span class="form-control"><?php echo $details['id']; ?></span>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="marital_status">Marital Status:</label>
                                        <span class="form-control"><?php echo $marital_status_details['name']; ?></span> 
                                    </div>
                                    <?php if ($marital_status_details['name'] == "MARRIED") { ?>
                                        <div class="form-group"> 
                                            <label for="spouse_firstname">Spouse First Name:</label>
                                            <span class="form-control"><?php echo $details['spouse_firstname']; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="spouse_middlename">Spouse Middle Name:</label>
                                            <span class="form-control"><?php echo $details['spouse_middlename']; ?></span> 
                                        </div>
                                        <div class="form-group"> 
                                            <label for="spouse_lastname">Spouse Last Name:</label>
                                            <span class="form-control"><?php echo $details['spouse_lastname']; ?></span>
                                        </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <label for="dependants">Dependants:</label>
                                        <span class="form-control"><?php echo $details['dependants']; ?></span> 
                                    </div>
                                    <div class="form-group"> 
                                        <label for="landmark">Landmark:</label>
                                        <span class="form-control"><?php echo $details['landmark']; ?></span>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="purpose">Purpose:</label>
                                        <span class="form-control"><?php echo $details['purpose']; ?></span>
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