<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
$users = new Users();
$settings = new Settings();
$code = $_GET['code'];
$_SESSION['account'] = $code;
$details = $users->fetchAccountDetails($code);
$account_holders = $users->accountHoldersPerAccount($code);
$_SESSION['account_category'] = $details['account_category'];
$account_type_details = $settings->fetchAccountTypeDetails($details['account_type']);
$account_category_details = $settings->fetchAccountCategoryDetails($details['account_category']);
$branch_details = $settings->fetchBranchDetails($details['branch']);
$staff_details_createdby = $users->fetchStaffDetails($details['createdby']);

if ($details['other_account'] == 1) {
    $other_account = "YES";
} else if ($details['other_account'] == 0) {
    $other_account = "NO";
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
            <?php require_once('modules/menus/sub_menu_account.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Accounts Details
                            <?php require_once('modules/menus/sub-sub-menu-buttons.php'); ?>
                        </header>
                        <div class="panel-body">
                            <div class="action">
                                <?php
                                if ($details['status'] != 1001) {
                                    if ($details['status'] != 1032 AND $details['status'] != 1000 AND $details['status'] != 1020) {
                                        ?>
                                        <a class="edit-individual" href="?transitional_update_account&update_type=edit&code=<?php echo $code; ?>" >
                                            Edit
                                        </a> 
                                        <?php
                                    }
                                    if ($details['status'] != 1000 AND $details['status'] != 1020) {
                                        ?>
                                        <a class="edit-individual" href="?transitional_add_deposit">
                                            Deposit
                                        </a>
                                        <a class="edit-individual" href="?transitional_add_withdrawal">
                                            Withdraw
                                        </a>
                                        <a class="edit-individual" href="?transitional_add_loan">
                                            Loan
                                        </a>
                                    <?php } ?>
                                    <a class="edit-individual" href="?view_account_loans">
                                        Account Loans
                                    </a>
                                    <a class="edit-individual" href="?view_transactions_individual_account">
                                        Transactions Statement
                                    </a>
                                <?php } ?>
                            </div>

                            <div id="status-element">
                                <form role = "form">
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
                                        <label for="old_account_number">Old Account Number:</label>
                                        <span class="form-control"><?php echo $details['old_account_number']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="account_type">Account Type:</label>
                                        <span class="form-control"><?php echo $account_type_details['name']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="account_category">Account Category:</label>
                                        <span class="form-control"><?php echo $account_category_details['name']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="branch">Branch:</label>
                                        <span class="form-control"><?php echo $branch_details['name']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="company_name">Employer's/Company's Name:</label>
                                        <span class="form-control"><?php echo $details['company_name']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="business_type">Employer's/Company's Occupation/Business:</label>
                                        <span class="form-control"><?php echo $details['business_type']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="postal_number">Postal Number:</label>
                                        <span class="form-control"><?php echo $details['postal_number']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="postal_code">Postal Code:</label>
                                        <span class="form-control"><?php echo $details['postal_code']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="town">Town:</label>
                                        <span class="form-control"><?php echo $details['town']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone_number">Telephone Number:</label>
                                        <span class="form-control"><?php echo $details['phone_number']; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email Address:</label>
                                        <span class="form-control"><?php echo $details['email']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="other_account">Do you have any other account(s) with any bank, sacco or micro-finance:</label>
                                        <?php echo $other_account; ?>
                                    </div>
                                    <?php if ($details['other_account'] == 1) { ?>
                                        <hr/>
                                        <h4 id="divider">First Institution</h4>
                                        <div class="form-group">
                                            <label for="account_number1">Account Number:</label>
                                            <span class="form-control"><?php echo $details['account_number1']; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="account_bank1">Bank Name:</label>
                                            <span class="form-control"><?php echo $details['account_bank1']; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="account_branch1">Branch Name:</label>
                                            <span class="form-control"><?php echo $details['account_branch1']; ?></span>
                                        </div>

                                        <h4 id="divider">Second Institution</h4>
                                        <div class="form-group">
                                            <label for="account_number2">Account Number:</label>
                                            <span class="form-control"><?php echo $details['account_number2']; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="account_bank2">Bank Name:</label>
                                            <span class="form-control"><?php echo $details['account_bank2']; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="account_branch2">Branch Name:</label>
                                            <span class="form-control"><?php echo $details['account_branch2']; ?></span>
                                        </div>
                                        <hr/>
                                    <?php } ?>

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
                                        <span class="form-control"><?php echo $staff_details_createdby['firstname'] . " " . $staff_details_createdby['middlename'] . " " . $staff_details_createdby['lastname']; ?></div>
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
                        </form>

                </div>


        </section>
</div>        
</div><!--row1-->
</section><!-- /.content -->
</aside><!-- /.right-side -->
</div>