<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Transactions.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$withdrawals = new Transactions();
$code = $_GET['code'];
$_SESSION['withdrawal'] = $code;
$details = $withdrawals->fetchTransactionDetails($code);
$staff_details_createdby = $users->fetchStaffDetails($details['createdby']);

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
            <?php require_once('modules/menus/sub_menu_transactions.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel">
                        <header class="panel-heading">
                            Withdrawal Details
                        </header>
                        <div class="panel-body">
                            <div class="action">
                                <?php
//                                if (isset($_SESSION['institution_staff'])) {
//                                    if ($details['createdby'] != $_SESSION['userid'] AND ( $details['status'] == 1001 OR $details['status'] == 1032)) {
//                                        
                                ?>
<!--                                        <a class="edit-individual" href="?update_withdrawal&update_type=accept_approval&code="<?php // echo $code;   ?> >
                                            Accept Approval
                                        </a>
                                        <a class="edit-individual-warning" href="?update_withdrawal&update_type=reject_approval&code="<?php // echo $code;   ?> >
                                            Reject Approval
                                        </a>-->
                                <?php
//                                    }
//                                }
                                ?>
                            </div>

                            <div id="status-element">
                                <div class="form-group">   
                                    <label for="id">Transaction ID:</label>
                                    <span class="form-control"><?php echo $details['id']; ?></span>
                                </div>
                                <div class="form-group">   
                                    <label for="account_number">Account Number:</label>
                                    <span class="form-control"><?php echo $details['account_number']; ?></span> 
                                </div>
                                <div class="form-group">   
                                    <label for="amount">Amount <?php echo '(' . $_SESSION['chapter_details']['currency'] . ')'; ?>:</label>
                                    <span class="form-control"><?php echo $_SESSION['chapter_details']['currency'] . " ." . number_format($details['amount'], 2); ?></span> 
                                </div>
                                <div class="form-group">     
                                    <label for="transactedby">Transacted By:</label>
                                    <span class="form-control"><?php echo $details['transactedby']; ?></span> 
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

                                <?php
                                if ($details['authorizedat'] != NULL AND $details['authorizedat'] != NULL) {

                                    $staff_details_authorizedby = $users->fetchStaffDetails($details['authorizedby']);

                                    if ($details['status'] == 1011) {
                                        ?>
                                        <div class="form-group"> 
                                            <label for="authorizedat">Authorized At:</label>
                                            <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['authorizedat']); ?></span> 
                                        </div>
                                        <div class="form-group"> 
                                            <label for="authorizedby">Authorized By:</label>
                                            <span class="form-control"><?php echo $staff_details_authorizedby['firstname'] . " " . $staff_details_authorizedby['middlename'] . " " . $staff_details_authorizedby['lastname']; ?></span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                            </div>
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel -->
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>