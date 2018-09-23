<?php
require_once WPATH . "modules/classes/Notifications.php";
$notifications = new Notifications();

if (is_menu_set('?') != "") {
    $request_type = "search_user";
} else if (is_menu_set('add_transaction_type') != "") {
    $request_type = "search_transaction_types";
    $action_place_holder = "Search Transation Types";
} else if (is_menu_set('settings') != "") {
    $request_type = "search_settings";
    $action_place_holder = "Search Inactive";
} else if (is_menu_set('view_transaction_types_individual') != "") {
    $request_type = "search_transaction_types";
    $action_place_holder = "Search Transation Types";
} else if ((is_menu_set('view_transaction_types') != "") OR ( is_menu_set('view_transaction_types_notifications') != "")) {
    $request_type = "search_transaction_types";
    $action_place_holder = "Search Transation Types";
    $notifications_count = $notifications->transactionTypesNotifications();
    $notification_url = "?view_transaction_types_notifications";
} else if (is_menu_set('update_transaction_type') != "") {
    $request_type = "search_transaction_types";
    $action_place_holder = "Search Transation Types";
} else if (is_menu_set('add_investor_type') != "") {
    $request_type = "search_investor_types";
    $action_place_holder = "Search Investor Types";
} else if ((is_menu_set('view_investor_types') != "") OR ( is_menu_set('view_investor_types_notifications') != "")) {
    $request_type = "search_investor_types";
    $action_place_holder = "Search Investor Types";
    $notifications_count = $notifications->fundingTypesNotifications();
    $notification_url = "?view_investor_types_notifications";
} else if (is_menu_set('view_investor_types_individual') != "") {
    $request_type = "search_investor_types";
    $action_place_holder = "Search Investor Types";
} else if (is_menu_set('update_investor_type') != "") {
    $request_type = "search_investor_types";
    $action_place_holder = "Search Investor Types";
} else if (is_menu_set('add_branch') != "") {
    $request_type = "search_branches";
    $action_place_holder = "Search Branches";
} else if ((is_menu_set('view_branches') != "") OR ( is_menu_set('view_branches_notifications') != "")) {
    $request_type = "search_branches";
    $action_place_holder = "Search Branches";
    $notifications_count = $notifications->branchesNotifications();
    $notification_url = "?view_branches_notifications";
} else if (is_menu_set('update_branch') != "") {
    $request_type = "search_branches";
    $action_place_holder = "Search Branches";
} else if (is_menu_set('view_branches_individual') != "") {
    $request_type = "search_branches";
    $action_place_holder = "Search Branches";
} else if (is_menu_set('add_sector') != "") {
    $request_type = "search_sectors";
    $action_place_holder = "Search Sectors";
} else if ((is_menu_set('view_sectors') != "") OR ( is_menu_set('view_sectors_notifications') != "")) {
    $request_type = "search_sectors";
    $action_place_holder = "Search Sectors";
    $notifications_count = $notifications->sectorsNotifications();
    $notification_url = "?view_sectors_notifications";
} else if (is_menu_set('update_sector') != "") {
    $request_type = "search_sectors";
    $action_place_holder = "Search Sectors";
} else if (is_menu_set('view_sectors_individual') != "") {
    $request_type = "search_sectors";
    $action_place_holder = "Search Sectors";
} else if (is_menu_set('add_business_type') != "") {
    $request_type = "search_business_types";
    $action_place_holder = "Search Business Types";
} else if ((is_menu_set('view_business_types') != "") OR ( is_menu_set('view_business_types_notifications') != "")) {
    $request_type = "search_business_types";
    $action_place_holder = "Search Business Types";
    $notifications_count = $notifications->businessTypesNotifications();
    $notification_url = "?view_business_types_notifications";
} else if (is_menu_set('update_business_type') != "") {
    $request_type = "search_business_types";
    $action_place_holder = "Search Business Types";
} else if (is_menu_set('view_business_types_individual') != "") {
    $request_type = "search_business_types";
    $action_place_holder = "Search Business Types";
} else if (is_menu_set('add_marital_status') != "") {
    $request_type = "search_marital_statuses";
    $action_place_holder = "Search Marital Statuses";
} else if ((is_menu_set('view_marital_statuses') != "") OR ( is_menu_set('view_marital_statuses_notifications') != "")) {
    $request_type = "search_marital_statuses";
    $action_place_holder = "Search Marital Statuses";
    $notifications_count = $notifications->maritalStatusesNotifications();
    $notification_url = "?view_marital_statuses_notifications";
} else if (is_menu_set('update_marital_status') != "") {
    $request_type = "search_marital_statuses";
    $action_place_holder = "Search Marital Statuses";
} else if (is_menu_set('view_marital_statuses_individual') != "") {
    $request_type = "search_marital_statuses";
    $action_place_holder = "Search Marital Statuses";
} else if ((is_menu_set('view_default_charge_rates') != "") OR ( is_menu_set('view_default_charge_rates_notifications') != "")) {
    $request_type = "search_default_charge_rates";
    $action_place_holder = "Search Default Charge Rates";
    $notifications_count = $notifications->defaultChargeRatesNotifications();
    $notification_url = "?view_default_charge_rates_notifications";
} else if (is_menu_set('update_default_charge_rate') != "") {
    $request_type = "search_default_charge_rates";
    $action_place_holder = "Search Default Charge Rates";
} else if (is_menu_set('view_default_charge_rates_individual') != "") {
    $request_type = "search_default_charge_rates";
    $action_place_holder = "Search Default Charge Rates";
} else if (is_menu_set('add_default_charge_rate') != "") {
    $request_type = "search_default_charge_rates";
    $action_place_holder = "Search Default Charge Rates";
} else if (is_menu_set('add_loan_processing_fees') != "") {
    $request_type = "search_loan_processing_fees";
    $action_place_holder = "Search Loan Processing Fees";
} else if ((is_menu_set('view_loan_processing_fees') != "") OR ( is_menu_set('view_loan_processing_fees_notifications') != "")) {
    $request_type = "search_loan_processing_fees";
    $action_place_holder = "Search Loan Processing Fees";
    $notifications_count = $notifications->loanProcessingFeesNotifications();
    $notification_url = "?view_loan_processing_fees_notifications";
} else if (is_menu_set('update_loan_processing_fees') != "") {
    $request_type = "search_loan_processing_fees";
    $action_place_holder = "Search Loan Processing Fees";
} else if (is_menu_set('view_loan_processing_fees_individual') != "") {
    $request_type = "search_loan_processing_fees";
    $action_place_holder = "Search Loan Processing Fees";
} else if (is_menu_set('add_loan_type') != "") {
    $request_type = "search_loan_types";
    $action_place_holder = "Search Loan Types";
} else if ((is_menu_set('view_loan_types') != "") OR ( is_menu_set('view_loan_types_notifications') != "")) {
    $request_type = "search_loan_types";
    $action_place_holder = "Search Loan Types";
    $notifications_count = $notifications->loanTypesNotifications();
    $notification_url = "?view_loan_types_notifications";
} else if (is_menu_set('update_loan_type') != "") {
    $request_type = "search_loan_types";
    $action_place_holder = "Search Loan Types";
} else if (is_menu_set('view_loan_types_individual') != "") {
    $request_type = "search_loan_types";
    $action_place_holder = "Search Loan Types";
} else if (is_menu_set('add_response') != "") {
    $request_type = "search_responses";
    $action_place_holder = "Search Responses";
} else if ((is_menu_set('view_responses') != "") OR ( is_menu_set('view_responses_notifications') != "")) {
    $request_type = "search_responses";
    $action_place_holder = "Search Responses";
    $notifications_count = $notifications->responsesNotifications();
    $notification_url = "?view_responses_notifications";
} else if (is_menu_set('update_response') != "") {
    $request_type = "search_responses";
    $action_place_holder = "Search Responses";
} else if (is_menu_set('view_responses_individual') != "") {
    $request_type = "search_responses";
    $action_place_holder = "Search Responses";
} else if (is_menu_set('add_status') != "") {
    $request_type = "search_statuses";
    $action_place_holder = "Search Statuses";
} else if ((is_menu_set('view_statuses') != "") OR ( is_menu_set('view_statuses_notifications') != "")) {
    $request_type = "search_statuses";
    $action_place_holder = "Search Statuses";
    $notifications_count = $notifications->statusesNotifications();
    $notification_url = "?view_statuses_notifications";
} else if (is_menu_set('update_status') != "") {
    $request_type = "search_statuses";
    $action_place_holder = "Search Statuses";
} else if (is_menu_set('view_statuses_individual') != "") {
    $request_type = "search_statuses";
    $action_place_holder = "Search Statuses";
} else if (is_menu_set('add_business_form') != "") {
    $request_type = "search_business_forms";
    $action_place_holder = "Search Business Forms";
} else if ((is_menu_set('view_business_forms') != "") OR ( is_menu_set('view_business_forms_notifications') != "")) {
    $request_type = "search_business_forms";
    $action_place_holder = "Search Business Forms";
    $notifications_count = $notifications->businessFormsNotifications();
    $notification_url = "?view_business_forms_notifications";
} else if (is_menu_set('update_business_form') != "") {
    $request_type = "search_business_forms";
    $action_place_holder = "Search Business Forms";
} else if (is_menu_set('view_business_forms_individual') != "") {
    $request_type = "search_business_forms";
    $action_place_holder = "Search Business Forms";
} else if (is_menu_set('add_contact') != "") {
    $request_type = "search_contacts";
    $action_place_holder = "Search Contacts";
} else if ((is_menu_set('view_contacts') != "") OR ( is_menu_set('view_contacts_notifications') != "")) {
    $request_type = "search_contacts";
    $action_place_holder = "Search Contacts";
    $notifications_count = $notifications->contactsNotifications();
    $notification_url = "?view_contacts_notifications";
} else if (is_menu_set('update_contact') != "") {
    $request_type = "search_contacts";
    $action_place_holder = "Search Contacts";
} else if (is_menu_set('view_contacts_individual') != "") {
    $request_type = "search_contacts";
    $action_place_holder = "Search Contacts";
} else if ((is_menu_set('view_positions') != "") OR ( is_menu_set('view_positions_notifications') != "")) {
    $request_type = "search_positions";
    $action_place_holder = "Search Positions";
    $notifications_count = $notifications->positionsNotifications();
    $notification_url = "?view_positions_notifications";
} else if (is_menu_set('view_positions_individual') != "") {
    $request_type = "search_positions";
    $action_place_holder = "Search Positions";
} else if (is_menu_set('add_position') != "") {
    $request_type = "search_positions";
    $action_place_holder = "Search Positions";
} else if (is_menu_set('add_financing_method') != "") {
    $request_type = "search_financing_methods";
    $action_place_holder = "Search Financing Methods";
} else if ((is_menu_set('view_financing_methods') != "") OR ( is_menu_set('view_financing_methods_notifications') != "")) {
    $request_type = "search_financing_method";
    $action_place_holder = "Search Financing Methods";
    $notifications_count = $notifications->financingMethodsNotifications();
    $notification_url = "?view_financing_methods_notifications";
} else if (is_menu_set('view_financing_methods_individual') != "") {
    $request_type = "search_financing_methods";
    $action_place_holder = "Search Financing Methods";
} else if (is_menu_set('update_financing_method') != "") {
    $request_type = "search_financing_method";
    $action_place_holder = "Search Financing Methods";
} else if (is_menu_set('add_funding_type') != "") {
    $request_type = "search_funding_types";
    $action_place_holder = "Search Funding Types";
} else if ((is_menu_set('view_funding_types') != "") OR ( is_menu_set('view_funding_types_notifications') != "")) {
    $request_type = "search_funding_types";
    $action_place_holder = "Search Funding Types";
    $notifications_count = $notifications->fundingTypesNotifications();
    $notification_url = "?view_funding_types_notifications";
} else if (is_menu_set('view_funding_types_individual') != "") {
    $request_type = "search_funding_types";
    $action_place_holder = "Search Funding Types";
} else if (is_menu_set('update_funding_type') != "") {
    $request_type = "search_funding_types";
    $action_place_holder = "Search Funding Types";
} else if (is_menu_set('add_system_privilege') != "") {
    $request_type = "search_system_privileges";
    $action_place_holder = "Inactive";
} else if ((is_menu_set('view_system_privileges') != "") OR ( is_menu_set('view_system_privileges_notifications') != "")) {
    $request_type = "search_system_privileges";
    $action_place_holder = "Inactive";
    $notifications_count = $notifications->systemPrivilegesNotifications();
    $notification_url = "?view_system_privileges_notifications";
} else if (is_menu_set('view_system_privileges_individual') != "") {
    $request_type = "search_system_privileges";
    $action_place_holder = "Inactive";
} else if (is_menu_set('update_system_privilege') != "") {
    $request_type = "search_system_privileges";
    $action_place_holder = "Inactive";
} else if (is_menu_set('view_user_privileges') != "") {
    $request_type = "search_user_privileges";
    $action_place_holder = "Inactive";
} else if (is_menu_set('view_user_privileges_individual') != "") {
    $request_type = "search_user_privileges";
    $action_place_holder = "Inactive";
} else if (is_menu_set('update_user_type_privilege') != "") {
    $request_type = "search_user_type_privileges";
    $action_place_holder = "Inactive";
} else if (is_menu_set('add_system_component') != "") {
    $request_type = "search_system_components";
    $action_place_holder = "Inactive";
} else if ((is_menu_set('view_system_components') != "") OR ( is_menu_set('view_system_components_notifications') != "")) {
    $request_type = "search_system_components";
    $action_place_holder = "Inactive";
    $notifications_count = $notifications->systemComponentsNotifications();
    $notification_url = "?view_system_components_notifications";
} else if (is_menu_set('view_system_components_individual') != "") {
    $request_type = "search_system_components";
    $action_place_holder = "Inactive";
} else if (is_menu_set('update_system_component') != "") {
    $request_type = "search_system_components";
    $action_place_holder = "Inactive";
} else if (is_menu_set('view_role_privileges') != "") {
    $request_type = "search_role_privileges";
    $action_place_holder = "Inactive";
} else if (is_menu_set('update_role_user_privileges') != "") {
    $request_type = "search_role_user_privileges";
    $action_place_holder = "Inactive";
} else if (is_menu_set('add_user_type') != "") {
    $request_type = "search_user_types";
    $action_place_holder = "Search User Types";
} else if ((is_menu_set('view_user_types') != "") OR ( is_menu_set('view_user_types_notifications') != "")) {
    $request_type = "search_user_types";
    $action_place_holder = "Search User Types";
    $notifications_count = $notifications->userTypesNotifications();
    $notification_url = "?view_user_types_notifications";
} else if (is_menu_set('update_user_type') != "") {
    $request_type = "search_user_types";
    $action_place_holder = "Search User Types";
} else if (is_menu_set('view_user_types_individual') != "") {
    $request_type = "search_user_types";
    $action_place_holder = "Search User Types";
} else if (is_menu_set('add_role') != "") {
    $request_type = "search_roles";
    $action_place_holder = "Search Roles";
} else if ((is_menu_set('view_roles') != "") OR ( is_menu_set('view_roles_notifications') != "")) {
    $request_type = "search_roles";
    $action_place_holder = "Search Roles";
    $notifications_count = $notifications->rolesNotifications();
    $notification_url = "?view_roles_notifications";
} else if (is_menu_set('update_role') != "") {
    $request_type = "search_roles";
    $action_place_holder = "Search Roles";
} else if (is_menu_set('view_roles_individual') != "") {
    $request_type = "search_roles";
    $action_place_holder = "Search User Types";
} else if (is_menu_set('add_guest_user') != "") {
    $request_type = "search_guest_users";
    $action_place_holder = "Search Guest Users";
} else if ((is_menu_set('view_guest_users') != "") OR ( is_menu_set('view_guest_users_notifications') != "")) {
    $request_type = "search_guest_users";
    $action_place_holder = "Search Guest Users";
    $notifications_count = $notifications->guestUsersNotifications();
    $notification_url = "?view_guest_users_notifications";
} else if (is_menu_set('update_guest_user') != "") {
    $request_type = "search_guest_users";
    $action_place_holder = "Search Guest Users";
} else if (is_menu_set('view_guest_users_individual') != "") {
    $request_type = "search_guest_users";
    $action_place_holder = "Search Guest Users";
} else if (is_menu_set('add_system_administrator') != "") {
    $request_type = "search_system_administrators";
    $action_place_holder = "Search System Administrators";
} else if ((is_menu_set('view_system_administrators') != "") OR ( is_menu_set('view_system_administrators_notifications') != "")) {
    $request_type = "search_system_administrators";
    $action_place_holder = "Search System Administrators";
    $notifications_count = $notifications->systemAdministratorsNotifications();
    $notification_url = "?view_system_administrators_notifications";
} else if (is_menu_set('update_system_administrator') != "") {
    $request_type = "search_system_administrators";
    $action_place_holder = "Search System Administrators";
} else if (is_menu_set('view_system_administrators_individual') != "") {
    $request_type = "search_system_administrators";
    $action_place_holder = "Search System Administrators";
} else if (is_menu_set('add_staff') != "") {
    $request_type = "search_staff";
    $action_place_holder = "Search Staff";
} else if ((is_menu_set('view_staff') != "") OR ( is_menu_set('view_staff_notifications') != "")) {
    $request_type = "search_staff";
    $action_place_holder = "Search Staff";
    $notifications_count = $notifications->staffNotifications();
    $notification_url = "?view_staff_notifications";
} else if (is_menu_set('update_staff') != "") {
    $request_type = "search_staff";
    $action_place_holder = "Search Staff";
} else if (is_menu_set('view_staff_individual') != "") {
    $request_type = "search_staff";
    $action_place_holder = "Search Staff";
} else if (is_menu_set('update_account_category') != "") {
    $request_type = "search_account_categories";
    $action_place_holder = "Search Account Categories";
} else if (is_menu_set('add_account_category') != "") {
    $request_type = "search_account_categories";
    $action_place_holder = "Search Account Categories";
} else if ((is_menu_set('view_account_categories') != "") OR ( is_menu_set('view_account_categories_notifications') != "")) {
    $request_type = "search_account_categories";
    $action_place_holder = "Search Account Categories";
    $notifications_count = $notifications->accountCategoriesNotifications();
    $notification_url = "?view_account_categories_notifications";
} else if (is_menu_set('view_account_categories_individual') != "") {
    $request_type = "search_account_categories";
    $action_place_holder = "Search Account Categories";
} else if (is_menu_set('add_account_type') != "") {
    $request_type = "search_account_types";
    $action_place_holder = "Search Account Type";
} else if ((is_menu_set('view_account_types') != "") OR ( is_menu_set('view_account_types_notifications') != "")) {
    $request_type = "search_account_types";
    $action_place_holder = "Search Account Types";
    $notifications_count = $notifications->accountTypesNotifications();
    $notification_url = "?view_account_types_notifications";
} else if (is_menu_set('update_account_types') != "") {
    $request_type = "search_account_types";
    $action_place_holder = "Search Account Types";
} else if (is_menu_set('view_account_types_individual') != "") {
    $request_type = "search_account_types";
    $action_place_holder = "Search Account Types";
} else if (is_menu_set('add_instalment_frequency') != "") {
    $request_type = "search_instalment_frequencies";
    $action_place_holder = "Search Instalment Frequencies";
} else if ((is_menu_set('view_instalment_frequencies') != "") OR ( is_menu_set('view_instalment_frequencies_notifications') != "")) {
    $request_type = "search_instalment_frequencies";
    $action_place_holder = "Search Instalment Frequencies";
    $notifications_count = $notifications->instalmentFrequenciesNotifications();
    $notification_url = "?view_instalment_frequencies_notifications";
} else if (is_menu_set('update_instalment_frequency') != "") {
    $request_type = "search_instalment_frequencies";
    $action_place_holder = "Search Instalment Frequencies";
} else if (is_menu_set('view_instalment_frequencies_individual') != "") {
    $request_type = "search_instalment_frequencies";
    $action_place_holder = "Search Instalment Frequencies";
} else if (is_menu_set('view_transaction_types_individual') != "") {
    $request_type = "search_transaction_types";
    $action_place_holder = "Search Transaction Type";
}
?>

<!--Mini Menu -->
<ul class="menu nav nav-pills">


    <?php if (isset($_SESSION['staqpesa_admin']) AND $_SESSION['staqpesa_admin'] == true) { ?>
        <li role="presentation" <?php
        if (is_menu_set('view_system_components') || is_menu_set('add_system_component') || is_menu_set('view_system_components_individual') || is_menu_set('update_system_component') ||
                is_menu_set('view_role_privileges') || is_menu_set('add_role_privilege') || is_menu_set('view_role_privileges_individual') || is_menu_set('update_role_privilege') ||
                is_menu_set('view_statuses') || is_menu_set('add_status') || is_menu_set('view_statuses_individual') || is_menu_set('update_status') != "") {
            ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-dot-circle-o"></i> System Settings <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li role="presentation" <?php if (is_menu_set('view_system_privileges') || is_menu_set('add_system_privilege') || is_menu_set('view_system_privileges_individual') || is_menu_set('update_system_privilege') != "") { ?> class="active" <?php } ?>><a href="?view_system_privileges">System Privileges</a></li>
                <li role="presentation" <?php if (is_menu_set('view_system_components') || is_menu_set('add_system_component') || is_menu_set('view_system_components_individual') || is_menu_set('update_system_component') != "") { ?> class="active" <?php } ?>><a href="?view_system_components">System Components</a></li>
                <li role="presentation" <?php if (is_menu_set('view_statuses') || is_menu_set('add_status') || is_menu_set('view_statuses_individual') || is_menu_set('update_status') != "") { ?> class="active" <?php } ?>><a href="?view_statuses">Statuses</a></li>        
            </ul>
        </li>
        <li role="presentation" <?php
        if (is_menu_set('view_system_privileges') || is_menu_set('add_system_privilege') || is_menu_set('view_system_privileges_individual') || is_menu_set('update_system_privilege') ||
                is_menu_set('view_marital_statuses') || is_menu_set('add_marital_status') || is_menu_set('view_marital_statuses_individual') || is_menu_set('update_marital_status') ||
                is_menu_set('view_user_privileges') || is_menu_set('add_user_privilege') || is_menu_set('view_user_privileges_individual') || is_menu_set('update_user_privilege') ||
                is_menu_set('view_user_types') || is_menu_set('add_user_type') || is_menu_set('view_user_types_individual') || is_menu_set('update_user_type') ||
                is_menu_set('view_roles') || is_menu_set('add_role') || is_menu_set('view_roles_individual') || is_menu_set('update_role')) {
            ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user-md"></i>User Settings <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                    <!--            <li role="presentation" <?php // if (is_menu_set('view_role_privileges') || is_menu_set('add_role_privilege') || is_menu_set('view_role_privileges_individual') || is_menu_set('update_role_privilege') != "") {            ?> class="active" <?php // }            ?>><a href="?view_role_privileges">Role Privileges</a></li>
                <li role="presentation" <?php // if (is_menu_set('view_user_privileges') || is_menu_set('add_user_privilege') || is_menu_set('view_user_privileges_individual') || is_menu_set('update_user_privilege') != "") {            ?> class="active" <?php // }            ?>><a href="?view_user_privileges">User Privileges </a></li>-->
                <li role="presentation" <?php if (is_menu_set('view_user_types') || is_menu_set('add_user_type') || is_menu_set('view_user_types_individual') || is_menu_set('update_user_type') != "") { ?> class="active" <?php } ?>><a href="?view_user_types">User Types</a></li>
                <li role="presentation" <?php if (is_menu_set('view_roles') || is_menu_set('add_role') || is_menu_set('view_roles_individual') || is_menu_set('update_role') != "") { ?> class="active" <?php } ?>><a href="?view_roles">Roles</a></li>
                <li role="presentation" <?php if (is_menu_set('view_marital_statuses') || is_menu_set('add_marital_status') || is_menu_set('view_marital_statuses_individual') || is_menu_set('update_marital_status') != "") { ?> class="active" <?php } ?>><a href="?view_marital_statuses">Marital Status</a></li>               
            </ul>
        </li>
        <li role="presentation" <?php
        if (
                is_menu_set('view_account_categories') || is_menu_set('add_account_category') || is_menu_set('view_account_categories_individual') || is_menu_set('update_account_category') ||
                is_menu_set('view_business_forms') || is_menu_set('add_business_form') || is_menu_set('view_business_forms_individual') || is_menu_set('update_business_form') ||
                is_menu_set('view_business_types') || is_menu_set('add_business_type') || is_menu_set('view_business_types_individual') || is_menu_set('update_business_type') ||
                is_menu_set('view_instalment_frequencies') || is_menu_set('add_instalment_frequency') || is_menu_set('view_instalment_frequencies_individual') || is_menu_set('update_instalment_frequency') ||
                is_menu_set('view_transaction_types') || is_menu_set('add_transaction_type') || is_menu_set('view_transaction_types_individual') || is_menu_set('update_transaction_type') != "") {
            ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-dot-circle-o"></i> Transaction Settings <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li role="presentation" <?php if (is_menu_set('view_transaction_types') || is_menu_set('add_transaction_type') || is_menu_set('view_transaction_types_individual') || is_menu_set('update_transaction_type') != "") { ?> class="active" <?php } ?>><a href="?view_transaction_types">Transaction Types</a></li>
                <li role="presentation" <?php if (is_menu_set('view_account_categories') || is_menu_set('add_account_category') || is_menu_set('view_account_categories_individual') || is_menu_set('update_account_category') != "") { ?> class="active" <?php } ?>><a href="?view_account_categories">Account Categories</a></li>
                <li role="presentation" <?php if (is_menu_set('view_instalment_frequencies') || is_menu_set('add_instalment_frequency') || is_menu_set('view_instalment_frequencies_individual') || is_menu_set('update_instalment_frequency') != "") { ?> class="active" <?php } ?>><a href="?view_instalment_frequencies">Instalment Frequencies</a></li>
                <li role="presentation" <?php if (is_menu_set('view_business_types') || is_menu_set('add_business_type') || is_menu_set('view_business_types_individual') || is_menu_set('update_business_type') != "") { ?> class="active" <?php } ?>><a href="?view_business_types">Business Types</a></li>
                <li role="presentation" <?php if (is_menu_set('view_business_forms') || is_menu_set('add_business_form') || is_menu_set('view_business_forms_individual') || is_menu_set('update_business_form') != "") { ?> class="active" <?php } ?>><a href="?view_business_forms">Business Forms</a></li>
            </ul>
        </li>
        <?php
        if (is_menu_set('view_business_types') != "" OR is_menu_set('view_instalment_frequencies') != ""
                OR is_menu_set('view_marital_statuses') != "" OR is_menu_set('view_system_privileges') != "" OR is_menu_set('view_system_components') != ""
                OR is_menu_set('view_roles') != "" OR is_menu_set('view_user_types') != "" OR is_menu_set('view_account_categories') != ""
                OR is_menu_set('view_transaction_types') != "" OR is_menu_set('view_business_forms') != ""
                OR is_menu_set('view_statuses') != "" OR is_menu_set('view_marital_statuses') != "") {
            if ($notifications_count > 0) {
                ?>
                <li class="dropdown tasks-menu">
                    <a href="<?php echo $notification_url; ?>" class="dropdown-toggle">
                        <i class="fa fa-bell"></i> Pending Actions
                        <span class="label label-danger"><?php echo $notifications_count; ?> </span>
                    </a>
                </li>
                <?php
            }
        }
        ?>

    <?php } else if (isset($_SESSION['institution_admin']) AND $_SESSION['institution_admin'] == true) { ?>
        <li role="presentation" <?php
        if (is_menu_set('view_branches') || is_menu_set('add_branch') || is_menu_set('view_branches_individual') || is_menu_set('update_branch') ||
                is_menu_set('view_responses') || is_menu_set('add_response') || is_menu_set('view_responses_individual') || is_menu_set('update_response') ||
                is_menu_set('view_sectors') || is_menu_set('add_sector') || is_menu_set('view_sectors_individual') || is_menu_set('update_sector')) {
            ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-chain"></i>System Settings <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li role="presentation" <?php if (is_menu_set('view_branches') || is_menu_set('add_branch') || is_menu_set('view_branches_individual') || is_menu_set('update_branch')) { ?> class="active" <?php } ?>><a href="?view_branches">Branches</a></li>
                <li role="presentation" <?php if (is_menu_set('view_sectors') || is_menu_set('add_sector') || is_menu_set('view_sectors_individual') || is_menu_set('update_sector') != "") { ?> class="active" <?php } ?>><a href="?view_sectors">Sectors</a></li>            
                <li role="presentation" <?php if (is_menu_set('view_responses') || is_menu_set('add_response') || is_menu_set('view_responses_individual') || is_menu_set('update_response') != "") { ?> class="active" <?php } ?>><a href="?view_responses">Responses</a></li>
            </ul>
        </li>
        <li role="presentation" <?php
        if (is_menu_set('view_positions') || is_menu_set('add_position') || is_menu_set('view_positions_individual') || is_menu_set('update_position') ||
                is_menu_set('view_account_types') || is_menu_set('add_account_type') || is_menu_set('view_account_types_individual') || is_menu_set('update_account_type') ||
                is_menu_set('view_investor_types') || is_menu_set('add_investor_type') || is_menu_set('view_investor_types_individual') || is_menu_set('update_investor_type')) {
            ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-chain"></i>User Settings <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li role="presentation" <?php if (is_menu_set('view_account_types') || is_menu_set('add_account_type') || is_menu_set('view_account_types_individual') || is_menu_set('update_account_type') != "") { ?> class="active" <?php } ?>><a href="?view_account_types">Account Types</a></li>
                <li role="presentation" <?php if (is_menu_set('view_investor_types') || is_menu_set('add_investor_type') || is_menu_set('view_investor_types_individual') || is_menu_set('update_investor_type') != "") { ?> class="active" <?php } ?>><a href="?view_investor_types">Investor Types</a></li>
                <li role="presentation" <?php if (is_menu_set('view_positions') || is_menu_set('add_position') || is_menu_set('view_positions_individual') || is_menu_set('update_position') != "") { ?> class="active" <?php } ?>><a href="?view_positions">Positions</a></li>
            </ul>
        </li>
        <li role="presentation" <?php
        if (is_menu_set('view_default_charge_rates') || is_menu_set('add_default_charge_rate') || is_menu_set('view_default_charge_rates_individual') || is_menu_set('update_default_charge_rate') ||
                is_menu_set('view_loan_processing_fees') || is_menu_set('add_loan_processing_fees') || is_menu_set('view_loan_processing_fees_individual') || is_menu_set('update_loan_processing_fees') ||
                is_menu_set('view_loan_types') || is_menu_set('add_loan_type') || is_menu_set('view_loan_types_individual') || is_menu_set('update_loan_type') ||
                is_menu_set('view_financing_methods') || is_menu_set('add_financing_method') || is_menu_set('view_financing_methods_individual') || is_menu_set('update_financing_method') ||
                is_menu_set('view_funding_types') || is_menu_set('add_funding_type') || is_menu_set('view_funding_types_individual') || is_menu_set('update_funding_type')) {
            ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-chain"></i>Transaction Settings <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li role="presentation" <?php if (is_menu_set('view_loan_types') || is_menu_set('add_loan_type') || is_menu_set('view_loan_types_individual') || is_menu_set('update_loan_type') != "") { ?> class="active" <?php } ?>><a href="?view_loan_types">Loan Types</a></li>
                <li role="presentation" <?php if (is_menu_set('view_loan_processing_fees') || is_menu_set('add_loan_processing_fees') || is_menu_set('view_loan_processing_fees_individual') || is_menu_set('update_loan_processing_fees') != "") { ?> class="active" <?php } ?>><a href="?view_loan_processing_fees">Loan Processing Fees</a></li>
                <li role="presentation" <?php if (is_menu_set('view_default_charge_rates') || is_menu_set('add_default_charge_rate') || is_menu_set('view_default_charge_rates_individual') || is_menu_set('update_default_charge_rate') != "") { ?> class="active" <?php } ?>><a href="?view_default_charge_rates">Default Charge Rates</a></li>
                <li role="presentation" <?php if (is_menu_set('view_financing_methods') || is_menu_set('add_financing_method') || is_menu_set('view_financing_methods_individual') || is_menu_set('update_financing_method') != "") { ?> class="active" <?php } ?>><a href="?view_financing_methods">Financing Methods</a></li>
                <li role="presentation" <?php if (is_menu_set('view_funding_types') || is_menu_set('add_funding_type') || is_menu_set('view_funding_types_individual') || is_menu_set('update_funding_type') != "") { ?> class="active" <?php } ?>><a href="?view_funding_types">Funding Types</a></li>

            </ul>
        </li>
        <?php
        if (is_menu_set('view_branches') != "" OR is_menu_set('view_loan_types') != "" OR is_menu_set('view_default_charge_rates') != ""
                OR is_menu_set('view_loan_processing_fees') != "" OR ( is_menu_set('view_account_types') != "") OR ( is_menu_set('view_responses') != "")
                OR is_menu_set('view_positions') != "" OR is_menu_set('view_financing_methods') != "" OR is_menu_set('view_funding_types') != ""
                OR is_menu_set('view_investor_types') != "" OR is_menu_set('view_sectors') != "") {
            if ($notifications_count > 0) {
                ?>
                <li class="dropdown tasks-menu">
                    <a href="<?php echo $notification_url; ?>" class="dropdown-toggle">
                        <i class="fa fa-bell"></i> Pending Actions
                        <span class="label label-danger"><?php echo $notifications_count; ?> </span>
                    </a>
                </li>
                <?php
            }
        }
        ?>
    <?php } ?>


    <li role="presentation" style="float: right;"> 
        <form class="navbar-form navbar-left" method="POST">
            <div class="form-group">
                <input type="hidden" name="action" value="search"/>
                <input type="hidden" name="request_type" value="<?php echo $request_type; ?>"/>
                <input type="search" <?php
                if (is_menu_set('settings')) {
                    echo 'disabled';
                }
                ?> name="search_input" class="form-control" placeholder="<?php echo $action_place_holder; ?>">
            </div>
            <button type="submit" class="btn btn-default">Search</button>
        </form>
    </li>
</ul>
<!--Mini Menu END -->