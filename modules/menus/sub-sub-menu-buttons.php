<?php
if (is_menu_set('?') != "") {
    $action = "search_user";
} else if ((is_menu_set('view_loan_processing_fees') != "") OR ( is_menu_set('view_loan_processing_fees_notifications') != "")) {
    $request_url = "?add_loan_processing_fees";
    $action_holder = "Add Loan Processing Fee";
} else if ((is_menu_set('view_sectors') != "") OR ( is_menu_set('view_sectors_notifications') != "")) {
    $request_url = "?add_sector";
    $action_holder = "Add Sector";
} else if ((is_menu_set('view_inbox_messages') != "") OR ( is_menu_set('view_inbox_messages_notifications') != "")) {
    $statement_type = "fetch_inbox_messages_statement";
    $request_url = "?view_inbox_messages";
    $action_holder = "View Messages";
} else if ((is_menu_set('view_job_advertisements') != "") OR ( is_menu_set('view_job_advertisements_notifications') != "")) {
    $statement_type = "fetch_job_advertisements_statement";
    $request_url = "?add_job_advertisement";
    $action_holder = "Add Job Advertisement";
} else if ((is_menu_set('view_job_applications') != "") OR ( is_menu_set('view_job_applications_notifications') != "")) {
    $statement_type = "fetch_job_applications_statement";
    $request_url = "?view_job_applications";
    $action_holder = "View Job Applications";
} else if ((is_menu_set('view_account_categories') != "") OR ( is_menu_set('view_account_categories_notifications') != "")) {
    $request_url = "?add_account_category";
    $action_holder = "Add Account Category";
} else if ((is_menu_set('view_accounts') != "") OR ( is_menu_set('view_accounts_notifications') != "")) {
    $statement_type = "fetch_accounts_statement";
    $request_url = "?add_account";
    $action_holder = "Add Account";
} else if ((is_menu_set('view_loan_guarantors') != "") OR ( is_menu_set('view_loan_guarantors_notifications') != "")) {
    $request_url = "#";
    $action_holder = "Loan Guarantors";
} else if (is_menu_set('view_account_loan_guarantors') != "") {
    $request_url = "#";
    $action_holder = "My Loan Guarantors";
} else if ((is_menu_set('view_loan_guarantors') != "") OR ( is_menu_set('view_loan_guarantor_notifications') != "")) {
    $request_url = "?add_loan_guarantor";
    $action_holder = "Add Loan Guarantor";
} else if ((is_menu_set('view_account_business_data') != "") OR ( is_menu_set('view_account_business_data_notifications') != "")) {
    $request_url = "#";
    $action_holder = "Business Details";
}

//else if (is_menu_set('view_account_loan_business_data') != "") {
//    $request_url = "#";
//    $action_holder = "My Loan Business Data";
//}
else if ((is_menu_set('view_loans') != "") OR ( is_menu_set('view_loans_notifications') != "")) {
    $statement_type = "fetch_loans_statement";
    if (isset($_SESSION['account']) AND $_SESSION['logged_in_user_type_details']['name'] == "ACCOUNT HOLDER") {
        $request_url = "?add_loan";
        $action_holder = "Add Loan";
    } else {
        $request_url = "#";
        $action_holder = "View Loans";
    }
} else if (is_menu_set('view_account_loans') != "") {
    $statement_type = "fetch_loans_statement";
    $request_url = "?add_loan";
    $action_holder = "Request For Loan";
} else if ((is_menu_set('view_investors') != "") OR ( is_menu_set('view_investors_notifications') != "")) {
    $request_url = "?add_investor";
    $action_holder = "Add Investor";
} else if ((is_menu_set('view_investor_types') != "") OR ( is_menu_set('view_investor_types_notifications') != "")) {
    $request_url = "?add_investor_type";
    $action_holder = "Add Investor Type";
} else if ((is_menu_set('view_instalment_frequencies') != "") OR ( is_menu_set('view_instalment_frequencies_notifications') != "")) {
    $request_url = "?add_instalment_frequency";
    $action_holder = "Add Instalment Frequency";
} else if ((is_menu_set('view_funding_types') != "") OR ( is_menu_set('view_funding_types_notifications') != "")) {
    $request_url = "?add_funding_type";
    $action_holder = "Add Funding Type";
} else if ((is_menu_set('view_financing_methods') != "") OR ( is_menu_set('view_financing_methods_notifications') != "")) {
    $request_url = "?add_financing_method";
    $action_holder = "Add Financing Method";
} else if ((is_menu_set('view_default_charge_rates') != "") OR ( is_menu_set('view_default_charge_rates_notifications') != "")) {
    $request_url = "?add_default_charge_rate";
    $action_holder = "Add Default Charge Rate";
} else if ((is_menu_set('view_institutions') != "") OR ( is_menu_set('view_institutions_notifications') != "")) {
    $request_url = "?add_institution";
    $action_holder = "Add Institution";
} else if ((is_menu_set('view_business_types') != "") OR ( is_menu_set('view_business_types_notifications') != "")) {
    $request_url = "?add_business_type";
    $action_holder = "Add Business Type";
} else if ((is_menu_set('view_business_forms') != "") OR ( is_menu_set('view_business_forms_notifications') != "")) {
    $request_url = "?add_business_form";
    $action_holder = "Add Business Form";
} else if ((is_menu_set('view_branches') != "") OR ( is_menu_set('view_branches_notifications') != "")) {
    $request_url = "?add_branch";
    $action_holder = "Add Branch";
} else if ((is_menu_set('view_account_holders') != "") OR ( is_menu_set('view_account_holders_notifications') != "")) {
    if (isset($_SESSION['can_add_accountholder'])) {
        $request_url = "?add_account_holder";
        $action_holder = "Add Account Holder";
    } else {
        $request_url = "#";
        $action_holder = "Account Holders";
    }
} else if ((is_menu_set('view_account_nominees') != "") OR ( is_menu_set('view_account_nominees_notifications') != "")) {
    $request_url = "#";
    $action_holder = "Account Nominees";
} else if ((is_menu_set('view_account_banking_details') != "") OR ( is_menu_set('view_account_banking_details_notifications') != "")) {
    $request_url = "#";
    $action_holder = "Account Banking Details";
} else if ((is_menu_set('view_account_holder_occupations') != "") OR ( is_menu_set('view_account_holder_occupations_notifications') != "")) {
    $request_url = "#";
    $action_holder = "Account Holder Occupations";
}

//else if (is_menu_set('view_account_holders_individual_account') != "") {
//    if (isset($_SESSION['can_add_accountholder']) AND $_SESSION['can_add_accountholder'] == true) {
//        $request_url = "?add_account_holder";
//        $action_holder = "Add Account Holder";
//    } else {
//        $request_url = "#";
//        $action_holder = "Account Holders";
//    }
//}
else if ((is_menu_set('view_loan_types') != "") OR ( is_menu_set('view_loan_types_notifications') != "")) {
    $request_url = "?add_loan_type";
    $action_holder = "Add Loan Type";
} else if ((is_menu_set('view_marital_statuses') != "") OR ( is_menu_set('view_marital_statuses_notifications') != "")) {
    $request_url = "?add_marital_status";
    $action_holder = "Add Marital Status";
} else if ((is_menu_set('view_my_projects') != "") OR ( is_menu_set('view_my_projects_notifications') != "")) {
    $request_url = "?add_my_project";
    $action_holder = "Add New Project";
} else if ((is_menu_set('view_next_of_kins') != "") OR ( is_menu_set('view_next_of_kins_notifications') != "")) {
    $request_url = "?add_next_of_kin";
    $action_holder = "Add Next-of-Kin";
} else if (is_menu_set('view_project_bids') != "") {
    $request_url = "?view_projects";
    $action_holder = "Add Project Bid";
} else if (is_menu_set('view_bids_on_project') != "") {
    $request_url = "?view_projects";
    $action_holder = "Projects";
} else if ((is_menu_set('view_projects') != "") OR ( is_menu_set('view_investor_projects') != "") OR ( is_menu_set('view_projects_notifications') != "")) {
    $request_url = "?add_project";
    $action_holder = "Add Project";
} else if (is_menu_set('view_member_projects') != "") {
    $request_url = "?add_project";
    $action_holder = "Add Project";
} else if (is_menu_set('view_projects_individual') != "") {
    $request_url = "?add_project_bid";
    $action_holder = "Bid on Project";
} else if ((is_menu_set('view_responses') != "") OR ( is_menu_set('view_responses_notifications') != "")) {
    $request_url = "?add_response";
    $action_holder = "Add Response";
} else if (is_menu_set('view_role_privileges') != "") {
    $request_url = "?add_privilege_to_role";
    $action_holder = "Add Role Privilege";
} else if ((is_menu_set('view_staff') != "") OR ( is_menu_set('view_staff_notifications') != "")) {
    $request_url = "?add_staff";
    $action_holder = "Add Staff";
} else if ((is_menu_set('view_statuses') != "") OR ( is_menu_set('view_statuses_notifications') != "")) {
    $request_url = "?add_status";
    $action_holder = "Add Status";
} else if ((is_menu_set('view_system_components') != "") OR ( is_menu_set('view_system_components_notifications') != "")) {
    $request_url = "?add_system_component";
    $action_holder = "Add System Component";
} else if ((is_menu_set('view_system_privileges') != "") OR ( is_menu_set('view_system_privileges_notifications') != "")) {
    $request_url = "?add_system_privilege";
    $action_holder = "Add System Privilege";
} else if ((is_menu_set('view_transaction_types') != "") OR ( is_menu_set('view_transaction_types_notifications') != "")) {
    $request_url = "?add_transaction_type";
    $action_holder = "Add Transaction Type";
} else if (is_menu_set('view_unbidded_projects') != "") {
    $request_url = "?add_project";
    $action_holder = "Add New Project";
} else if ((is_menu_set('view_guest_users') != "") OR ( is_menu_set('view_guest_users_notifications') != "")) {
    $request_url = "?add_guest_user";
    $action_holder = "Add Guest User";
} else if ((is_menu_set('view_system_administrators') != "") OR ( is_menu_set('view_system_administrators_notifications') != "")) {
    $request_url = "?add_system_administrator";
    $action_holder = "Add System Administrator";
} else if (is_menu_set('view_user_privileges') != "") {
    $request_url = "?add_user_privilege";
    $action_holder = "Add User Privilege";
} else if ((is_menu_set('view_user_types') != "") OR ( is_menu_set('view_user_types_notifications') != "")) {
    $request_url = "?add_user_type";
    $action_holder = "Add User Type";
} else if ((is_menu_set('view_roles') != "") OR ( is_menu_set('view_roles_notifications') != "")) {
    $request_url = "?add_role";
    $action_holder = "Add Role";
} else if (is_menu_set('view_roles_individual') != "") {
    $request_url = "?add_privilege_to_role";
    $action_holder = "Add privilege";
//    $request_url2 = "?view_role_privileges";
//    $action_holder2 = "View Privileges";
} else if ((is_menu_set('view_withdrawals') != "") OR ( is_menu_set('view_withdrawals_notifications') != "")) {
    $statement_type = "WITHDRAWAL";
    if (isset($_SESSION['account'])) {
        $request_url = "?add_withdrawal";
        $action_holder = "Withdraw Cash";
    } else {
        $request_url = "#";
        $action_holder = "Withdrawals";
    }
} else if ((is_menu_set('view_deposits') != "") OR ( is_menu_set('view_deposits_notifications') != "")) {
    $statement_type = "DEPOSIT";
    if (isset($_SESSION['account'])) {
        $request_url = "?add_deposit";
        $action_holder = "Add Deposit";
    } else {
        $request_url = "#";
        $action_holder = "Deposits";
    }
} else if ((is_menu_set('view_shares') != "") OR ( is_menu_set('view_shares_notifications') != "")) {
    $statement_type = "SHARES DEPOSIT";
    if (isset($_SESSION['account'])) {
        $request_url = "?add_shares";
        $action_holder = "Add Shares";
    } else {
        $request_url = "#";
        $action_holder = "View Shares";
    }
} else if ((is_menu_set('view_account_to_account_transfers') != "") OR ( is_menu_set('view_account_to_account_transfers_notifications') != "")) {
    $statement_type = "ACCOUNT TO ACCOUNT TRANSFER";
    if (isset($_SESSION['account'])) {
        $request_url = "?add_account_to_account_transfer";
        $action_holder = "Transfer to Another Account";
    } else {
        $request_url = "#";
        $action_holder = "Account to Account Transfers";
    }
} else if ((is_menu_set('view_transactions') != "") OR ( is_menu_set('view_transactions_notifications') != "")) {
    $statement_type = "ALL";
    $request_url = "#";
    $action_holder = "Transactions";
}

//else if (is_menu_set('view_account_loans') != "") {
//    $request_url = "?add_account_loan";
//    $action_holder = "Add Account Loan";
//}
else if ((is_menu_set('view_account_types') != "") OR ( is_menu_set('view_account_types_notifications') != "")) {
    $request_url = "?add_account_type";
    $action_holder = "Add Account Type";
} else if ((is_menu_set('view_loan_processing_fees') != "") OR ( is_menu_set('view_loan_processing_fees_notifications') != "")) {
    $request_url = "?add_loan_processing_fees";
    $action_holder = "Add Loan Processing Fee";
} else if ((is_menu_set('view_positions') != "") OR ( is_menu_set('view_positions_notifications') != "")) {
    $request_url = "?add_position";
    $action_holder = "Add Postition";
} else if (is_menu_set('transitional_view_account') != "") {
    $request_url = "?add_account";
    $action_holder = "Add Account";
} else if (is_menu_set('view_loan_repayments') != "") {
    $request_url = "#";
    $action_holder = "Loan Repayments";
} else if (is_menu_set('view_account_loan_repayments') != "") {
    $request_url = "#";
    $action_holder = "My Loan Repayments";
} else if (is_menu_set('add_loan_guarantor') != "") {
    $request_url = "#";
    $action_holder = "Unguaranteed: ";
//    $action_holder = "Unguaranteed: " . $_SESSION['outstanding_balance_to_be_guaranteed'];
}
?>


<?php
if (is_menu_set('view_inbox_messages') != "" OR is_menu_set('view_job_advertisements') != "" OR is_menu_set('view_job_applications') != "" OR is_menu_set('view_accounts') != ""
        OR is_menu_set('view_loan_guarantors') != "" OR is_menu_set('view_account_loan_guarantors') != "" OR is_menu_set('view_account_business_data') != "" OR is_menu_set('view_loans') != ""
        OR is_menu_set('view_account_loans') != "" OR is_menu_set('view_investors') != "" OR is_menu_set('view_institutions') != "" OR is_menu_set('view_account_holders') != ""
        OR is_menu_set('view_projects') != "" OR is_menu_set('view_investor_projects') != "" OR is_menu_set('view_member_projects') != "" OR is_menu_set('view_project_bids') != ""
        OR is_menu_set('view_bids_on_project') != "" OR is_menu_set('view_staff') != ""
        OR is_menu_set('view_statuses') != "" OR is_menu_set('view_system_components') != "" OR is_menu_set('view_system_privileges') != "" OR is_menu_set('view_next_of_kins') != ""
        OR is_menu_set('view_guest_users') != "" OR is_menu_set('view_system_administrators') != "" OR is_menu_set('view_transactions') != "" OR is_menu_set('view_withdrawals') != "" OR is_menu_set('view_deposits') != ""
        OR is_menu_set('view_shares') != "" OR is_menu_set('view_account_to_account_transfers') != "" OR is_menu_set('view_account_loans') != "" OR is_menu_set('view_loan_repayments') != ""
        OR is_menu_set('view_account_loan_repayments') != "") {
    ?>
    <form method="POST">
        <input type="submit" name="create_pdf" class="btn btn-danger sub-sub-menu-buttons" value="Download PDF" />
    </form>
<?php } ?>
<?php if ((!isset($_SESSION['investor'])) AND ( !is_menu_set('add_loan_guarantor')) AND ( !is_menu_set('view_contacts')) AND ( !is_menu_set('view_contacts_notifications'))) { ?>
    <a href="<?php echo $request_url; ?>" class="btn btn-success sub-sub-menu-buttons">
        <i class="fa fa-plus"></i> 
    <?php echo $action_holder; ?>
    </a>
    <?php } ?>
<?php if (is_menu_set('add_loan_guarantor') != "") { ?>
    <a href="<?php echo $request_url; ?>" class="btn btn-danger sub-sub-menu-buttons">
    <?php echo $action_holder; ?>
    </a>
    <?php } ?>
<?php if (is_menu_set('view_roles_individual') != "") { ?>
    <a href="<?php echo "?view_role_privileges"; ?>" class="btn btn-success sub-sub-menu-buttons">
        <i class="fa fa-plus"></i> 
    <?php echo "View Privileges"; ?>
    </a>
    <?php } ?>

<?php
if (is_menu_set('view_transactions') != "" OR is_menu_set('view_account_to_account_transfers') != "" OR is_menu_set('view_deposits') != "" OR is_menu_set('view_withdrawals') != ""
        OR is_menu_set('view_shares') != "" OR is_menu_set('view_loans') != "" OR is_menu_set('view_accounts') != "" OR is_menu_set('view_inbox_messages') != "") {
    ?>

    <form role="form" method="POST">
        <input type="hidden" name="action" value="view_statement_from_to"/>
        <input type="hidden" name="statement_type" value="<?php echo $statement_type; ?>"/><div class="form-group">
            <div class="row">
                <div class="col-lg-2">
                    <div class="input-group">
                        <span class="input-group-addon">
                            Start
                        </span>
                        <input class="form-control" type="text" id="datepicker" name="date1" value="01/01/2017" />
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-2">
                    <div class="input-group">
                        <span class="input-group-addon">
                            End
                        </span>
                        <input class="form-control" type="text" id="datepicker2" name="date2" value="01/31/2017" />
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->

                <div class="col-lg-1">
                    <button type="submit" class="btn btn-info">Filter</button>
                </div>
            </div><!-- /.row -->
        </div>
    </form>
<?php } ?>

<?php
if (is_menu_set('add_loan_guarantor') != "") {

    $_SESSION['outstanding_balance_to_be_guaranteed'] = $_SESSION['principal_amount'];
    //   $outstanding_balance_to_be_guaranteed = $_SESSION['principal_amount'];
    if (!empty($_POST) AND $_POST['action'] == "update_loan_guarantors_list") {
        $_SESSION['new_outstanding_balance_to_be_guaranteed'] = $_SESSION['outstanding_balance_to_be_guaranteed'] - $_POST["amount"];
        $_SESSION['outstanding_balance_to_be_guaranteed'] = $_SESSION['new_outstanding_balance_to_be_guaranteed'];
    }
    ?>

    <form role="form" method="POST">
        <input type="hidden" name="action" value="update_loan_guarantors_list"/>
        <div class="row">
            <div class="col-lg-4">
                <div class="input-group">
                    <span class="input-group-addon">
                        ID/Passport Number
                    </span>
                    <input type="text" class="form-control" id="idnumber" name="idnumber" placeholder="eg. 78936412" required="yes"/>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-lg-4">
                <div class="input-group">
                    <span class="input-group-addon">
                        Guarantee Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?>
                    </span>
                    <input type="number" class="form-control" id="amount" name="amount" placeholder="<?php echo $_SESSION['outstanding_balance_to_be_guaranteed']; ?>" required="true"/>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-lg-1">
                <button type="submit" class="btn btn-info">Update Guarantors List</button>
            </div>
        </div><!-- /.row -->
    </div>
    </form>
<?php } ?>

