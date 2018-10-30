<?php
require_once WPATH . "modules/classes/Notifications.php";
$notifications = new Notifications();

if (is_menu_set('?') != "") {
    $request_type = "search_user";
} else if (is_menu_set('view_loan_repayments')) {
    $request_type = "search_loan_repayments";
    $action_place_holder = "Search Loan Repayments";
} else if (is_menu_set('view_loan_guarantors')) {
    $request_type = "search_loan_guarantors";
    $action_place_holder = "Search Loan Guarantors";
    $notifications_count = $notifications->loanGuarantorsNotifications();
    $notification_url = "?view_loan_guarantors_notifications";
}
?>

<!--Mini Menu -->
<ul class="nav nav-pills">
    <li role="presentation" <?php if (is_menu_set('view_loans')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_loans" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-clock-o"></i>All Loans
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_loans_individual')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_loans_individual&code=<?php echo $_SESSION['loan']; ?>" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-clock-o"></i>Loan Details
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_loan_repayments')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_loan_repayments" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-ambulance"></i>Repayment Details
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_loan_guarantors')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_loan_guarantors" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-users"></i>Loan Guarantors
        </a>
    </li>
</ul>
<!--Mini Menu END -->