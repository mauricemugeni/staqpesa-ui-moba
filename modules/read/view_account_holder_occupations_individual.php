<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$users = new Users();
$code = $_GET['code'];
$_SESSION['account_holder_occupation'] = $code;
$details = $users->fetchAccountHolderOccupationDetails($code);
$holder_details = $users->fetchAccountHolderDetails($details['account_holder_id']);
$_SESSION['holder_id'] = $details['account_holder_id'];
$staff_details_createdby = $users->fetchStaffDetails($details['createdby']);
$staff_details_lastmodifiedby = $users->fetchStaffDetails($details['lastmodifiedby']);

if ($details['employer_id'] == 'N/A') {
    $employer = "N/A";
} else {
    $employer_details = $users->fetchCorporateDetails($details['employer_id']);
    $employer = $employer_details['company_name'];
}

if ($details['status'] == 1000) {
    $status = "DELETED";
} else if ($details['status'] == 1001 OR $details['status'] == 1032) {
    $status = "AWAITING APPROVAL";
} else if ($details['status'] == 1010) {
    $status = "APPROVAL REJECTED";
} else if ($details['status'] == 1011) {
    $status = "APPROVAL ACCEPTED";
} else if ($details['status'] == 1020) {
    $status = "NOT ACTIVE";
} else if ($details['status'] == 1021) {
    $status = "ACTIVE";
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_account.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel">
                        <header class="panel-heading">
                            <strong>ACCOUNT HOLDER OCCUPATION DETAILS</strong>
                        </header>
                        <div class="panel-body">
                            <div class="action">
                                <?php 
                                if ($details['status'] == 1020) {
                                    ?>
                                    <a class="edit-individual" href="?update_account_holder_occupation&update_type=activate&code=" <?php echo $code; ?> >
                                        Activate
                                    </a>
                                <?php } if ($details['status'] == 1021) { ?>
                                    <a class="edit-individual-warning" href="?update_account_holder_occupation&update_type=deactivate&code=" <?php echo $code; ?> >
                                        Deactivate
                                    </a>
                                <?php } if ($details['status'] != 1000) { ?>
                                    <a class="edit-individual-warning" href="?update_account_holder_occupation&update_type=delete&code=" <?php echo $code; ?> >
                                        Delete
                                    </a>
                                <?php } ?>
                                <?php if ($details['status'] != 1032) { ?>
                                    <a class="edit-individual" href="?update_account_holder&update_type=edit&code=" <?php echo $code; ?> >
                                        Edit
                                    </a>
                                <?php } ?>
                            </div>
                            <div id="status-element">
                                <div class="form-group">
                                    <label for="account_number">Account Number:</label>
                                    <span class="form-control"><?php echo $holder_details['account_number']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="account_holder_id">Account Holder ID:</label>
                                    <span class="form-control"><?php echo $details['account_holder_id']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="employment_status">Employment Status:</label>
                                    <span class="form-control"><?php echo $details['employment_status']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="monthly_income_range">Monthly Income Range:</label>
                                    <span class="form-control"><?php echo $details['monthly_income_range']; ?></span>
                                </div>
                                <div class="form-group"> 
                                    <label for="employer">Employer:</label>
                                    <span class="form-control"><?php echo $employer; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="employment_number">Employment Number:</label>
                                    <span class="form-control"><?php echo $details['employment_number']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="payroll_number">Payroll Number:</label>
                                    <span class="form-control"><?php echo $details['payroll_number']; ?></span>
                                </div>
                                <div class="form-group"> 
                                    <label for="station">Station:</label>
                                    <span class="form-control"><?php echo $details['station']; ?></span>
                                </div>
                                <div class="form-group"> 
                                    <label for="employment_terms">Employment Terms:</label>
                                    <span class="form-control"><?php echo $details['employment_terms']; ?></span>
                                </div>
                                <div class="form-group"> 
                                    <label for="employment_termination_date">Employment Termination Date:</label>
                                    <span class="form-control"><?php echo $details['employment_termination_date']; ?></span>
                                </div>
                                <div class="form-group"> 
                                    <label for="income_source_description">Income Source Description:</label>
                                    <span class="form-control"><?php echo $details['income_source_description']; ?></span>
                                </div>
                                <div class="form-group"> 
                                    <label for="status">Status:</label>
                                    <span class="form-control"><?php echo $status; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="createdat">Created At:</label>
                                    <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['createdat']); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="createdby">Created By:</label>
                                    <span class="form-control"><?php echo $staff_details_createdby['firstname'] . " " . $staff_details_createdby['middlename'] . " " . $staff_details_createdby['lastname']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="lastmodifiedat">Last Modified At:</label>
                                    <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['lastmodifiedat']); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="lastmodifiedby">Last Modified By:</label>
                                    <span class="form-control"><?php echo $staff_details_lastmodifiedby['firstname'] . " " . $staff_details_lastmodifiedby['middlename'] . " " . $staff_details_lastmodifiedby['lastname']; ?></span>
                                </div>
                            </div>
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel -->
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>