<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
$loans = new Loans();
$code = $_GET['code'];
$_SESSION['loan_contact_person'] = $code;
unset($_SESSION['add_loan_contact_person']);
if (isset($_SESSION['transitional_data'])) {
    $transitional_details = $loans->transitionalFetchLoanContactPersonDetails($_SESSION['loan']);
    if ($transitional_details == false) {        
    $_SESSION['add_loan_contact_person'] = true;
    }
} else {
if (isset($_SESSION['loan'])) {
    $details = $loans->fetchLoanContactPersonDetails($_SESSION['loan']);
    $loan_status_details = $loans->fetchLoanStatusDetails($_SESSION['loan']);
} else {
    $details = $loans->fetchLoanContactPersonDetails($code);
    $loan_status_details = $loans->fetchLoanStatusDetails($code);
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
                    <div class="panel">
                        <header class="panel-heading">
                            Loan Contact Person Details
                        </header>
                        <div class="panel-body">
                            <div class="action">
                                <?php if (isset($_SESSION['add_loan_contact_person'])) { ?>

                                    <a class="edit-individual" href="?add_loan_contact_person" >
                                        Add Loan Contact Person Details
                                    </a> 
                                    <?php
                                } else {
                                    if (($loan_status_details['status'] == 1032) AND ( $details['lastmodifiedby'] != $_SESSION['userid'] AND $details['status'] == 1032)) {
                                        ?>
                                        <a class="edit-individual" href="?update_loan_contact_person&update_type=accept_approval&code=" <?php echo $code; ?> >
                                            Accept Approval
                                        </a>
                                        <a class="edit-individual-warning" href="?update_loan_contact_person&update_type=reject_approval&code=" <?php echo $code; ?> >
                                            Reject Approval
                                        </a>
                                        <?php
                                    }
                                    if ($loan_status_details['status'] != 1032) {
                                        ?>
                                        <a class="edit-individual" href="?update_loan_contact_person&update_type=edit&code=" <?php echo $code; ?> >
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
                                        <label for="firstname">First Name:</label>
                                        <span class="form-control"><?php echo $details['firstname']; ?></span>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="middlename">Middle Name:</label>
                                        <span class="form-control"><?php echo $details['middlename']; ?></span>
                                    </div>
                                    <div class="form-group">  
                                        <label for="lastname">Last Name:</label>
                                        <span class="form-control"><?php echo $details['lastname']; ?></span> 
                                    </div>
                                    <div class="form-group"> 
                                        <label for="relationship">Relationship:</label>
                                        <span class="form-control"><?php echo $details['relationship']; ?></span> 
                                    </div>
                                    <div class="form-group">  
                                        <label for="workplace">Workplace:</label>
                                        <span class="form-control"><?php echo $details['workplace']; ?></span>
                                    </div>
                                    <div class="form-group">  
                                        <label for="phone_number">Phone Number:</label>
                                        <span class="form-control"><?php echo $details['phone_number']; ?></span> 
                                    </div>
                                    <div class="form-group"> 
                                        <label for="postal_address">Postal Address:</label>
                                        <span class="form-control"><?php echo $details['postal_address']; ?></span> 
                                    </div>
                                    <div class="form-group"> 
                                        <label for="physical_address">Physical Address:</label>
                                        <span class="form-control"><?php echo $details['physical_address']; ?></span>
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