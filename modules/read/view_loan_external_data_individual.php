<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
$loans = new Loans();
$code = $_GET['code'];
$_SESSION['loan_external_data'] = $code;
unset($_SESSION['add_loan_external_data']);
if (isset($_SESSION['transitional_data'])) {
    $transitional_details = $loans->transitionalFetchLoanExternalDataDetails($_SESSION['loan']);
    if ($transitional_details == false) {        
    $_SESSION['add_loan_external_data'] = true;
    }
} else {
    if (isset($_SESSION['loan'])) {
        $details = $loans->fetchLoanExternalDataDetails($_SESSION['loan']);
        $loan_status_details = $loans->fetchLoanStatusDetails($_SESSION['loan']);
    } else {
        $details = $loans->fetchLoanExternalDataDetails($code);
        $loan_status_details = $loans->fetchLoanStatusDetails($code);
    }

    if ($details['external_source'] == 1) {
        $external_source = "YES";
    } else if ($details['external_source'] == 0) {
        $external_source = "NO";
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
                    <div class="panel">
                        <header class="panel-heading">
                            Loan External Data Details
                        </header>
                        <div class="panel-body">

                            <div class="action">
                                <?php if (isset($_SESSION['add_loan_external_data'])) { ?>
                                    <a class="edit-individual" href="?add_loan_external_data" >
                                        Add Loan External Data Details
                                    </a> 

                                    <?php
                                } else {
                                    if (($loan_status_details['status'] == 1032) AND ( $details['lastmodifiedby'] != $_SESSION['userid'] AND $details['status'] == 1032)) {
                                        ?>
                                        <a class="edit-individual" href="?update_loan_external_data&update_type=accept_approval&code=" <?php echo $code; ?> >
                                            Accept Approval
                                        </a>
                                        <a class="edit-individual-warning" href="?update_loan_external_data&update_type=reject_approval&code=" <?php echo $code; ?> >
                                            Reject Approval
                                        </a>
                                        <?php
                                    }
                                    if ($loan_status_details['status'] != 1032) {
                                        ?>
                                        <a class="edit-individual" href="?update_loan_external_data&update_type=edit&code=" <?php echo $code; ?> >
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
                                        <label for="bank">Bank:</label>
                                        <span class="form-control"><?php echo $details['bank']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="branch">Branch:</label>
                                        <span class="form-control"><?php echo $details['branch']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="organization">Organization:</label>
                                        <span class="form-control"><?php echo $details['organization']; ?></span> 
                                    </div>
                                    <div class="form-group"> 
                                        <label for="loan_amount">Loan Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?>:</label>
                                        <span class="form-control"><?php echo $_SESSION['currency'] ." .". number_format($details['loan_amount'], 2); ?></span>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="date_issued">Date Issued:</label>
                                        <span class="form-control"><?php echo $details['date_issued']; ?></span> 
                                    </div>
                                    <div class="form-group">
                                        <label for="external_source">Do you have an External Source of Income:</label>
                                        <span class="form-control"><?php echo $external_source; ?></span> 
                                    </div>

                                    <?php if ($details['external_source'] == 1) { ?>
                                        <div class="form-group">
                                            <label for="description">External Source Description:</label>
                                            <span class="form-control"><?php echo $details['description']; ?></span> 
                                        </div>
                                        <div class="form-group"> 
                                            <label for="source_amount">Monthly Income from External Source <?php echo '(' . $_SESSION['currency'] . ')'; ?>:</label>
                                            <span class="form-control"><?php echo $_SESSION['currency'] . " .". number_format($details['source_amount'], 2); ?></span>
                                        </div>
                                    <?php } ?>
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