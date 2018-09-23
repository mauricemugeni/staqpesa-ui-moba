<?php
require_once WPATH . "modules/classes/Notifications.php";
$notifications = new Notifications();

if (is_menu_set('?') != "") {
    $request_type = "search_user";
} else if (is_menu_set('add_loan') != "") {
    $request_type = "search_loans";
    $action_place_holder = "Search Loans";
} else if ((is_menu_set('view_loans') != "") OR ( is_menu_set('view_loans_notifications') != "") OR ( is_menu_set('view_account_loans') != "")) {
    $request_type = "search_loans";
    $action_place_holder = "Search Loans";
    $notifications_count = $notifications->loansNotifications();
    $notification_url = "?view_loans_notifications";
} else if (is_menu_set('update_loan') != "") {
    $request_type = "search_loans";
    $action_place_holder = "Search Loans";
} else if (is_menu_set('view_loans_individual') != "") {
    $request_type = "search_loans";
    $action_place_holder = "Search Loans";
} else if (is_menu_set('transitional_add_loan') != "") {
    $request_type = "search_loans";
    $action_place_holder = "Search Loans";
} else if (is_menu_set('add_loan_business_data') != "") {
    $request_type = "search_loan_business_data";
    $action_place_holder = "Search Loan Business Data";
} else if (is_menu_set('view_loan_contact_persons_individual') != "") {
    $request_type = "search_loan_contact_persons";
    $action_place_holder = "Search Loan Contact Persons";
} else if ((is_menu_set('view_loan_contact_persons') != "") OR ( is_menu_set('view_loan_contact_persons_notifications') != "")) {
    $request_type = "search_loan_contact_persons";
    $action_place_holder = "Search Loan Contact Persons";
    $notifications_count = $notifications->loanContactPersonsNotifications();
    $notification_url = "?view_loan_contact_persons_notifications";
} else if (is_menu_set('update_loan_contact_person') != "") {
    $request_type = "search_loan_contact_persons";
    $action_place_holder = "Search Loan Contact Persons";
} else if (is_menu_set('add_loan_contact_person') != "") {
    $request_type = "search_loan_contact_persons";
    $action_place_holder = "Search Loan Contact Persons";
} else if (is_menu_set('add_loan_data') != "") {
    $request_type = "search_loan_data";
    $action_place_holder = "Search Loan Data";
} else if ((is_menu_set('view_loan_data') != "") OR ( is_menu_set('view_loan_data_notifications') != "")) {
    $request_type = "search_loan_data";
    $action_place_holder = "Search Loan Data";
    $notifications_count = $notifications->loanDataNotifications();
    $notification_url = "?view_loan_data_notifications";
} else if (is_menu_set('update_loan_data') != "") {
    $request_type = "search_loan_data";
    $action_place_holder = "Search Loan Data";
} else if (is_menu_set('view_loan_data_individual') != "") {
    $request_type = "search_loan_data";
    $action_place_holder = "Search Loan Data";
} else if (is_menu_set('add_loan_external_data') != "") {
    $request_type = "search_loan_external_data";
    $action_place_holder = "Search Loan External Data";
} else if ((is_menu_set('view_loan_external_data') != "") OR ( is_menu_set('view_loan_external_data_notifications') != "")) {
    $request_type = "search_loan_external_data";
    $action_place_holder = "Search Loan External Data";
    $notifications_count = $notifications->loanExternalDataNotifications();
    $notification_url = "?view_loan_external_data_notifications";
} else if (is_menu_set('update_loan_external_data') != "") {
    $request_type = "search_loan_external_data";
    $action_place_holder = "Search Loan External Data";
} else if (is_menu_set('view_loan_external_data_individual') != "") {
    $request_type = "search_loan_external_data";
    $action_place_holder = "Search Loan External Data";
} else if (is_menu_set('add_loan_guarantor') != "") {
    $request_type = "search_loan_guarantors";
    $action_place_holder = "Search Loan Guarantor";
} else if ((is_menu_set('view_loan_guarantors') != "") OR ( is_menu_set('view_loan_guarantors_notifications') != "")) {
    $request_type = "search_loan_guarantors";
    $action_place_holder = "Search Loan Guarantors";
    $notifications_count = $notifications->loanGuarantorsNotifications();
    $notification_url = "?view_loan_guarantors_notifications";
} else if (is_menu_set('update_loan_guarantor') != "") {
    $request_type = "search_loan_guarantors";
    $action_place_holder = "Search Loan Guarantors";
} else if (is_menu_set('view_loan_guarantors_individual') != "") {
    $request_type = "search_loan_guarantors";
    $action_place_holder = "Search Loan Guarantors";
} else if (is_menu_set('add_loan_guarantor2') != "") {
    $request_type = "search_loan_guarantors";
    $action_place_holder = "Search Loan Guarantor";
} else if (is_menu_set('add_loan_next') != "") {
    $request_type = "search_loans";
    $action_place_holder = "Search Loans";
} else if (is_menu_set('view_loan_repayments') != "") {
    $request_type = "search_loan_repayments";
    $action_place_holder = "Search Loan Repayments";
} else if (is_menu_set('update_loan_repayment') != "") {
    $request_type = "search_loan_repayments";
    $action_place_holder = "Search Loan Repayments";
} else if ((is_menu_set('view_loan_business_data') != "") OR ( is_menu_set('view_loan_business_data_notifications') != "")) {
    $request_type = "search_loan_business_data";
    $action_place_holder = "Search Loan Business Data";
    $notifications_count = $notifications->loanBusinessDataNotifications();
    $notification_url = "?view_loan_business_data_notifications";
} else if (is_menu_set('update_loan_business_data') != "") {
    $request_type = "search_loan_business_data";
    $action_place_holder = "Search Loan Business Data";
} else if (is_menu_set('view_loan_business_data_individual') != "") {
    $request_type = "search_loan_business_data";
    $action_place_holder = "Search Loan Business Data";
} else if (is_menu_set('engage_loan_calculator') != "") {
    $request_type = "search_loans";
    $action_place_holder = "Search Loans";
}
?>

<!--Mini Menu -->
<ul class="nav nav-pills">
    <li role="presentation" <?php
    if (is_menu_set('view_loans') || is_menu_set('add_loan') || is_menu_set('view_loans_individual') || is_menu_set('update_loan') ||
            is_menu_set('view_loan_repayments') || is_menu_set('add_loan_repayment') != "") {
        ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-chain"></i>Loans <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li role="presentation" <?php if (is_menu_set('view_loans') || is_menu_set('add_loan') || is_menu_set('view_loans_individual') || is_menu_set('update_loan') != "") { ?> class="active" <?php } ?>><a href="?view_loans">Loans</a></li>
            <li role="presentation" <?php if (is_menu_set('view_loan_repayments') || is_menu_set('add_loan_repayment') || is_menu_set('view_loan_repayments_individual') || is_menu_set('update_loan_repayment') != "") { ?> class="active" <?php } ?>><a href="?view_loan_repayments">Loan Repayments</a></li>
        </ul>
    </li>
    <li role="presentation" <?php
    if (is_menu_set('view_loan_data') || is_menu_set('add_loan_data') || is_menu_set('view_loan_data_individual') || is_menu_set('update_loan_data') ||
            is_menu_set('view_loan_external_data') || is_menu_set('add_loan_external_data') || is_menu_set('view_loan_external_data_individual') || is_menu_set('update_loan_external_data') ||
            is_menu_set('view_loan_guarantors') || is_menu_set('add_loan_guarantor') || is_menu_set('view_loan_guarantors_individual') || is_menu_set('update_loan_guarantor') ||
            is_menu_set('view_loan_business_data') || is_menu_set('add_loan_business_data') || is_menu_set('view_loan_business_datas_individual') || is_menu_set('update_loan_business_data') != "") {
        ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-file-excel"></i>Loan Data <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li role="presentation" <?php if (is_menu_set('view_loan_data') || is_menu_set('add_loan_data') || is_menu_set('view_loan_data_individual') || is_menu_set('update_loan_data') != "") { ?> class="active" <?php } ?>><a href="?view_loan_data">Loan Data</a></li>
            <li role="presentation" <?php if (is_menu_set('view_loan_external_data') || is_menu_set('add_loan_external_data') || is_menu_set('view_loan_external_data_individual') || is_menu_set('update_loan_external_data') != "") { ?> class="active" <?php } ?>><a href="?view_loan_external_data">Loan External Data</a></li>
            <li role="presentation" <?php if (is_menu_set('view_loan_guarantors') || is_menu_set('add_loan_guarantor') || is_menu_set('view_loan_guarantors_individual') || is_menu_set('update_loan_guarantor') != "") { ?> class="active" <?php } ?>><a href="?view_loan_guarantors">Loan Guarantors</a></li>
            <li role="presentation" <?php if (is_menu_set('view_loan_business_data') || is_menu_set('add_loan_business_data') || is_menu_set('view_loan_business_data_individual') || is_menu_set('update_loan_business_data') != "") { ?> class="active" <?php } ?>><a href="?view_loan_business_data">Loan Business Data</a></li>
        </ul>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_loan_contact_persons') || is_menu_set('add_loan_contact_person') || is_menu_set('view_loan_contact_persons_individual') || is_menu_set('update_loan_contact_person') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_loan_contact_persons" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-phone-square"></i>Loan Contact Persons
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('engage_loan_calculator')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?engage_loan_calculator" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bar-chart-o"></i>Amortization Calculator
        </a>
    </li>
    <?php
    if ((is_menu_set('view_loans') != "") OR ( is_menu_set('view_loan_contact_persons') != "") OR ( is_menu_set('view_loan_data') != "")
            OR ( is_menu_set('view_loan_external_data') != "") OR ( is_menu_set('view_loan_guarantors') != "") OR ( is_menu_set('view_loan_business_data') != "")) {
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
    <li role="presentation" style="float: right;"> 
        <form class="navbar-form navbar-left" method="POST">
            <div class="form-group">
                <input type="hidden" name="action" value="search"/>
                <input type="hidden" name="request_type" value="<?php echo $request_type; ?>"/>
                <input type="search" name="search_input" class="form-control" placeholder="<?php echo $action_place_holder; ?>">
            </div>
            <button type="submit" class="btn btn-default">Search</button>
        </form>
    </li>
</ul>
<!--Mini Menu END -->