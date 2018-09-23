<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
$loans = new Loans();
$code = $_GET['code'];
$_SESSION['loan_guarantor'] = $code;
unset($_SESSION['add_loan_guarantor']);
if (isset($_SESSION['transitional_data'])) {
    $transitional_details = $loans->transitionalFetchLoanGuarantorDetails($_SESSION['loan']);
    if ($transitional_details == false) {        
    $_SESSION['add_loan_guarantor'] = true;
    }
} else {
if (isset($_SESSION['loan'])) {
    $details2 = $loans->fetchLoanGuarantorDetails($_SESSION['loan']);
    $loan_status_details = $loans->fetchLoanStatusDetails($_SESSION['loan']);
} else {
    $details2 = $loans->fetchLoanGuarantorDetails($code);
    $loan_status_details = $loans->fetchLoanStatusDetails($code);
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
                            Loan Guarantor Details
                        </header>
                        <div class="panel-body">
                            <?php if (isset($_SESSION['add_loan_guarantor'])) { ?>
                                <div class="action">
                                    <a class="edit-individual" href="?add_loan_guarantor" >
                                        Add Loan Guarantor Details
                                    </a> 
                                </div>
                            <?php } else { ?>
                                <div class="action">
                                    <?php if (($loan_status_details['status'] == 1032) AND ( $details2[0]['lastmodifiedby'] != $_SESSION['userid'] AND $details2[0]['status'] == 1032)) { ?>
                                        <a class="edit-individual" href="?update_loan_guarantor&update_type=accept_approval&code=" <?php echo $code; ?> >
                                            Accept Approval
                                        </a>
                                        <a class="edit-individual-warning" href="?update_loan_guarantor&update_type=reject_approval&code=" <?php echo $code; ?> >
                                            Reject Approval
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div id="status-element">
                                    <span id="id"> 
                                        <label for="id">Loan ID:</label>
                                        <?php
                                        if (isset($_SESSION['loan'])) {
                                            echo $_SESSION['loan'];
                                        } else {
                                            echo $code;
                                        }
                                        ?>
                                    </span>

                                    <?php
                                    foreach ($details2 as $details) {
                                        if ($loan_status_details['status'] != 1032) {
                                            ?>                
                                            <a class="edit-individual" href="?update_loan_guarantor&update_type=edit&code=<?php echo $details['number']; ?>" >
                                                Edit
                                            </a>
                                        <?php } ?>

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
                                        <div class="form-group"> 
                                            <label for="place_of_residence">Place of Residence:</label>
                                            <span class="form-control"><?php echo $details['place_of_residence']; ?></span>
                                        </div>
                                        <div class="form-group"> 
                                            <label for="estate">Estate:</label>
                                            <span class="form-control"><?php echo $details['estate']; ?></span>
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