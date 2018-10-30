<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$code = $_GET['code'];
$_SESSION['account_banking_detail'] = $code;
$details = $users->fetchAccountBankingDtlDetails($code);
//$staff_details_lastmodifiedby = $users->fetchStaffDetails($details['lastmodifiedby']);
if ($details['status'] == 1000) {
    $status = "DELETED";
} else if ($details['status'] == 1031 OR $details['status'] == 1021) {
    $status = "ACTIVE";
} else if ($details['status'] == 1010) {
    $status = "ACTIVE";
} else if ($details['status'] == 1011) {
    $status = "ACTIVE";
} else if ($details['status'] == 1020) {
    $status = "NOT ACTIVE";
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_system_users.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel">
                        <header class="panel-heading">
                            <strong>ACCOUNT BANKING DETAILS</strong>
                        </header>
                        <div class="panel-body">
                            <div class="action">
                                <?php // if ($details['lastmodifiedby'] != $_SESSION['userid'] AND $details['status'] == 1032) { ?>
<!--                                    <a class="edit-individual" href="?update_account_banking_detail&update_type=accept_approval&code=" <?php // echo $code;     ?> >
                                        Accept Approval
                                    </a>
                                    <a class="edit-individual-warning" href="?update_account_banking_detail&update_type=reject_approval&code=" <?php // echo $code;     ?> >
                                        Reject Approval
                                    </a>-->
                                <?php
//                                }
//                                if ($details['status'] != 1032) {
//                                if (isset($_SESSION['account'])) {
                                ?>
                                <a class="edit-individual" href="?update_account_banking_details&update_type=edit&ref_type=" <?php echo $code;     ?> >
                                    Edit
                                </a>                    
                                <?php // } ?>
                            </div>

                            <div id="status-element">
                                <p />
                                <?php if (!isset($_SESSION['account'])) { ?>
                                    <div class="form-group">  
                                        <label for="account_number">Account Number:</label>
                                        <span class="form-control"><?php echo $details['account_number']; ?></span>
                                    </div>
                                <?php } ?>

                                <div class="form-group">  
                                    <label for="mobile_service_provider">Mobile Money Service Provider:</label>
                                    <span class="form-control"><?php echo $details['mobile_service_provider']; ?></span>
                                </div>
                                <div class="form-group">  
                                    <label for="mobile_number">Mobile Money Number:</label>
                                    <span class="form-control"><?php echo $details['mobile_number']; ?></span>
                                </div>
                                <div class="form-group">  
                                    <label for="bank_account_number">Bank Account Number:</label>
                                    <span class="form-control"><?php echo $details['bank_account_number']; ?></span>
                                </div>
                                <div class="form-group">  
                                    <label for="bank_name">Bank Name:</label>
                                    <span class="form-control"><?php echo $details['bank_name']; ?></span>
                                </div>
                                <div class="form-group"> 
                                    <label for="bank_code">Bank Code:</label>
                                    <span class="form-control"><?php echo $details['bank_code']; ?></span> 
                                </div>
                                <div class="form-group">  
                                    <label for="bank_branch_name">Bank Branch Name:</label>
                                    <span class="form-control"><?php echo $details['bank_branch_name']; ?></span>
                                </div>
                                <div class="form-group">  
                                    <label for="bank_branch_code">Bank Branch Code:</label>
                                    <span class="form-control"><?php echo $details['bank_branch_code']; ?></span>
                                </div>
                                <div class="form-group"> 
                                    <label for="status">Status:</label>
                                    <span class="form-control"><?php echo $status; ?></span>
                                </div>     
                                <div class="form-group">
                                    <label for="lastmodifiedat">Last Modified At:</label>
                                    <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['lastmodifiedat']); ?></span>
                                </div>
                            </div>
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel -->
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>