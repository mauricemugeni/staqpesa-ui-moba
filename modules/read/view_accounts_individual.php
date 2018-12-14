<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
$users = new Users();
$settings = new Settings();
if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $_SESSION['account'] = $code;
} else if (isset($_SESSION['account'])) {
    $_SESSION['account'] = $_SESSION['account'];
}

$details = $users->fetchAccountDetails($_SESSION['account']);
$account_holders = $users->accountHoldersPerAccount($_SESSION['account']);
$account_type_details = $settings->fetchAccountTypeDetails($details['account_type']);
$branch_details = $settings->fetchBranchDetails($details['branch']);
$staff_details_createdby = $users->fetchStaffDetails($details['createdby']);
$details2 = $users->fetchIndividualAccountHolderDetails($_SESSION['account']);

if ($details['status'] != 1000 AND $details['status'] != 1020) {
    if ($account_type_details['name'] == "GROUP/JOINT ACCOUNT" OR ( $account_type_details['name'] == "PERSONAL ACCOUNT" AND $account_holders == 0)) {
//if (count($details2) == 0 OR $account_type_details['name'] == "GROUP/JOINT ACCOUNT") {
        $_SESSION['can_add_accountholder'] = true;
    }
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
            <?php require_once('modules/menus/sub_menu_account_individual_account.php'); ?>            
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel">
                        <header class="panel-heading">
                            <strong>ACCOUNT DETAILS</strong>
                        </header>
                        <div class="panel-body">
                            <div class="action">
                                <?php if (($details['createdby'] != $_SESSION['userid'] AND $details['status'] == 1001) OR ( $details['lastmodifiedby'] != $_SESSION['userid'] AND $details['status'] == 1032)) { ?>
                                    <a class="edit-individual" href="?update_account&update_type=accept_approval&code=" <?php echo $_SESSION['account']; ?> >
                                        Accept Approval
                                    </a>
                                    <a class="edit-individual-warning" href="?update_account&update_type=reject_approval&code=" <?php echo $_SESSION['account']; ?> >
                                        Reject Approval
                                    </a>
                                    <?php
                                }
                                if ($details['status'] != 1001) {
                                    if ($details['status'] == 1020) {
                                        ?>
                                        <a class="edit-individual" href="?update_account&update_type=activate&code=" <?php echo $_SESSION['account']; ?> >
                                            Activate
                                        </a>
                                    <?php } if ($details['status'] == 1021) { ?>
                                        <a class="edit-individual-warning" href="?update_account&update_type=deactivate&code=" <?php echo $_SESSION['account']; ?> >
                                            Deactivate
                                        </a>
                                    <?php } if ($details['status'] != 1000) { ?>
                                        <a class="edit-individual-warning" href="?update_account&update_type=delete&code=" <?php echo $_SESSION['account']; ?> >
                                            Delete
                                        </a>
                                        <?php
                                    }

                                    if ($details['status'] != 1032 AND $details['status'] != 1000 AND $details['status'] != 1020) {
                                        ?>
                                        <a class="edit-individual" href="?update_account&update_type=edit&code=<?php echo $_SESSION['account']; ?>" >
                                            Edit
                                        </a> 
                                        <?php
                                    }

                                    if ($details['status'] != 1000 AND $details['status'] != 1020) {
//                                        if ($account_type_details['name'] == "GROUP/JOINT ACCOUNT" OR ( $account_type_details['name'] == "PERSONAL ACCOUNT" AND $account_holders == 0)) {
                                    ?>
                                    <!--<a class="edit-individual" href="?add_account_holder"> Add Account Holder </a>-->
                                    <?php // } ?>
<!--                                    <a class="edit-individual" href="?add_deposit">
                                        Deposit
                                    </a>
                                    <a class="edit-individual" href="?add_shares">
                                        Buy Shares
                                    </a>
                                    <a class="edit-individual" href="?add_withdrawal">
                                        Withdraw
                                    </a>
                                    <a class="edit-individual" href="?add_account_to_account_transfer">
                                        Account Transfer
                                    </a>
                                    <a class="edit-individual" href="?add_loan">
                                        Request Loan
                                    </a>-->
                                    <?php  } ?>
                                    <a class="edit-individual" href="?view_loans">
                                        Account Loans
                                    </a>
                                    <a class="edit-individual" href="?view_transactions">
                                        Transactions Statement
                                    </a>
                                    <!--                                    <a class="edit-individual" href="?view_projects">
                                                                            Account Projects
                                                                        </a>-->
                                <?php } ?>
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
                                    <label for="account_name">Account Name:</label>
                                    <span class="form-control"><?php echo $details['account_name']; ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="account_type">Account Type:</label>
                                    <span class="form-control"><?php echo $account_type_details['name']; ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="branch">Branch:</label>
                                    <span class="form-control"><?php echo $branch_details['name']; ?></span>
                                </div>

                                <div class="form-group"> 
                                    <label for="referee">Account Referee:</label>
                                    <span class="form-control"><?php echo $details['referee']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="recruited_by">Recruited By:</label>
                                    <span class="form-control"><?php echo $details['recruited_by']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="number_of_shares">Number of Shares:</label>
                                    <span class="form-control"><?php echo $details['number_of_shares']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="value_of_shares">Value of Shares:</label>
                                    <span class="form-control"><?php echo $details['value_of_shares']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="contribution_amount">Monthly Contribution Amount:</label>
                                    <span class="form-control"><?php echo $details['contribution_amount']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="contribution_effective_date">Contribution Effective Date:</label>
                                    <span class="form-control"><?php echo $details['contribution_effective_date']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="remittance_mode">Proposed mode of remittance:</label>
                                    <span class="form-control"><?php echo $details['remittance_mode']; ?></span>
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
                                    $staff_details_lastmodifiedby = $users->fetchStaffDetails($details['lastmodifiedby']);
                                    $staff_details_lastauthorizedby = $users->fetchStaffDetails($details['lastauthorizedby']);
                                    ?>

                                    <div class="form-group">
                                        <label for="authorizedat">Authorized At:</label>
                                        <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['authorizedat']); ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="authorizedby">Authorized By:</label>
                                        <span class="form-control"><?php echo $staff_details_authorizedby['firstname'] . " " . $staff_details_authorizedby['middlename'] . " " . $staff_details_authorizedby['lastname']; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="lastmodifiedat">Last Modified At:</label>
                                        <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['lastmodifiedat']); ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="lastmodifiedby">Last Modified By:</label>
                                        <span class="form-control"><?php echo $staff_details_lastmodifiedby['firstname'] . " " . $staff_details_lastmodifiedby['middlename'] . " " . $staff_details_lastmodifiedby['lastname']; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="lastauthorizedat">Last Authorized At:</label>
                                        <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['lastauthorizedat']); ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="lastauthorizedby">Last Authorized By:</label>
                                        <span class="form-control"><?php echo $staff_details_lastauthorizedby['firstname'] . " " . $staff_details_lastauthorizedby['middlename'] . " " . $staff_details_lastauthorizedby['lastname']; ?></span>
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