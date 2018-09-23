<?php
require_once WPATH . "modules/classes/Notifications.php";
$notifications = new Notifications();

if (is_menu_set('?') != "") {
    $request_type = "search_user";
} else if (is_menu_set('add_loan') != "") {
    $request_type = "search_loans";
    $action_place_holder = "Search Loans";
} else if ((is_menu_set('view_loans') != "") OR ( is_menu_set('view_loans_notifications') != "")) {
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
} else if ((is_menu_set('view_loan_repayments') != "") OR (is_menu_set('view_account_loan_repayments') != "")) {
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
}
?>

<!--Mini Menu -->
<ul class="nav nav-pills">


    <?php if (isset($_SESSION['staqpesa_admin']) AND $_SESSION['staqpesa_admin'] == true) { ?>
        <li role="presentation" <?php if (is_menu_set('view_loans') || is_menu_set('add_loan') || is_menu_set('view_loans_individual') || is_menu_set('update_loan') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_loans" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-clock-o"></i>Loans
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_loan_repayments') || is_menu_set('add_loan_repayment') || is_menu_set('view_loan_repayments_individual') || is_menu_set('update_loan_repayment') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_loan_repayments" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ambulance"></i>Loan Repayments
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_loan_guarantors') || is_menu_set('add_loan_guarantor') || is_menu_set('view_loan_guarantors_individual') || is_menu_set('update_loan_guarantor') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_loan_guarantors" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-users"></i>Loan Guarantors
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_loan_business_data') || is_menu_set('add_loan_business_data') || is_menu_set('view_loan_business_data_individual') || is_menu_set('update_loan_business_data') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_loan_business_data" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-save"></i>Loan Business Data
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('engage_loan_calculator')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?engage_loan_calculator" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bar-chart-o"></i>Amortization Calculator
            </a>
        </li>
    <?php } else if (isset($_SESSION['institution_admin']) AND $_SESSION['institution_admin'] == true) { ?>
        <li role="presentation" <?php if (is_menu_set('view_loans') || is_menu_set('add_loan') || is_menu_set('view_loans_individual') || is_menu_set('update_loan') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_loans" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-clock-o"></i>Loans
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_loan_repayments') || is_menu_set('add_loan_repayment') || is_menu_set('view_loan_repayments_individual') || is_menu_set('update_loan_repayment') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_loan_repayments" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ambulance"></i>Loan Repayments
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_loan_guarantors') || is_menu_set('add_loan_guarantor') || is_menu_set('view_loan_guarantors_individual') || is_menu_set('update_loan_guarantor') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_loan_guarantors" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-users"></i>Loan Guarantors
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_loan_business_data') || is_menu_set('add_loan_business_data') || is_menu_set('view_loan_business_data_individual') || is_menu_set('update_loan_business_data') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_loan_business_data" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-save"></i>Loan Business Data
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('engage_loan_calculator')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?engage_loan_calculator" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bar-chart-o"></i>Amortization Calculator
            </a>
        </li>
    <?php } else if (isset($_SESSION['staqpesa_staff']) AND $_SESSION['staqpesa_staff'] == true) { ?>
        <li role="presentation" <?php if (is_menu_set('view_loans') || is_menu_set('add_loan') || is_menu_set('view_loans_individual') || is_menu_set('update_loan') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_loans" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-clock-o"></i>Loans
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_loan_repayments') || is_menu_set('add_loan_repayment') || is_menu_set('view_loan_repayments_individual') || is_menu_set('update_loan_repayment') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_loan_repayments" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ambulance"></i>Loan Repayments
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_loan_guarantors') || is_menu_set('add_loan_guarantor') || is_menu_set('view_loan_guarantors_individual') || is_menu_set('update_loan_guarantor') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_loan_guarantors" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-users"></i>Loan Guarantors
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_loan_business_data') || is_menu_set('add_loan_business_data') || is_menu_set('view_loan_business_data_individual') || is_menu_set('update_loan_business_data') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_loan_business_data" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-save"></i>Loan Business Data
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('engage_loan_calculator')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?engage_loan_calculator" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bar-chart-o"></i>Amortization Calculator
            </a>
        </li>
    <?php } else if (isset($_SESSION['institution_staff']) AND $_SESSION['institution_staff'] == true) { ?>
        <li role="presentation" <?php if (is_menu_set('view_loans') || is_menu_set('add_loan') || is_menu_set('view_loans_individual') || is_menu_set('update_loan') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_loans" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-clock-o"></i>Loans
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_loan_repayments') || is_menu_set('add_loan_repayment') || is_menu_set('view_loan_repayments_individual') || is_menu_set('update_loan_repayment') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_loan_repayments" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ambulance"></i>Loan Repayments
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_loan_guarantors') || is_menu_set('add_loan_guarantor') || is_menu_set('view_loan_guarantors_individual') || is_menu_set('update_loan_guarantor') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_loan_guarantors" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-users"></i>Loan Guarantors
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_loan_business_data') || is_menu_set('add_loan_business_data') || is_menu_set('view_loan_business_data_individual') || is_menu_set('update_loan_business_data') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_loan_business_data" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-save"></i>Loan Business Data
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('engage_loan_calculator')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?engage_loan_calculator" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bar-chart-o"></i>Amortization Calculator
            </a>
        </li>

        <?php
        if ((is_menu_set('view_loans') != "") OR ( is_menu_set('view_loan_guarantors') != "") OR ( is_menu_set('view_loan_business_data') != "")) {
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
    <?php } else if ($_SESSION['logged_in_user_type_details']['name'] == "ACCOUNT HOLDER") { ?>
        <li role="presentation" <?php if (is_menu_set('view_loans') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_loans" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-clock-o"></i>My Loans
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_account_loan_repayments')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_account_loan_repayments" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ambulance"></i>My Loan Repayments
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_loan_guarantors') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_loan_guarantors" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-users"></i>My Loan Guarantors
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_loan_business_data') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_loan_business_data" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-save"></i>My Loan Business Data
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('engage_loan_calculator')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?engage_loan_calculator" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bar-chart-o"></i>Amortization Calculator
            </a>
        </li>
    <?php } else if ($_SESSION['logged_in_user_type_details']['name'] == "INVESTOR") { ?>

    <?php } else if ($_SESSION['logged_in_user_type_details']['name'] == "GUEST") { ?>

    <?php } ?>

    <?php if (!is_menu_set('engage_loan_calculator') != "") { ?>
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
    <?php } ?>
</ul>
<!--Mini Menu END -->