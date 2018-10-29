<?php
require_once WPATH . "modules/classes/Notifications.php";
$notifications = new Notifications();

if (is_menu_set('?') != "") {
    $action = "search_user";
} else if (is_menu_set('view_accounts_individual') != "") {
    $request_type = "search_accounts";
    $action_place_holder = "Search Accounts";
} else if ((is_menu_set('view_account_holders') != "") OR ( is_menu_set('view_account_holders_notifications') != "")) {
    $request_type = "search_account_holders";
    $action_place_holder = "Search Account Holders";
    $notifications_count = $notifications->accountHoldersNotifications();
    $notification_url = "?view_account_holders_notifications";
} else if ((is_menu_set('view_account_nominees') != "") OR ( is_menu_set('view_account_nominees_notifications') != "")) {
    $request_type = "search_account_nominees";
    $action_place_holder = "Search Account Nominees";
    $notifications_count = $notifications->accountNomineesNotifications();
    $notification_url = "?view_account_nominees_notifications";
} else if ((is_menu_set('view_account_holder_occupations') != "") OR ( is_menu_set('view_account_holder_occupations_notifications') != "")) {
    $request_type = "search_account_holder_occupations";
    $action_place_holder = "Search Account Holder Occupations";
    $notifications_count = $notifications->accountHolderOccupationsNotifications();
    $notification_url = "?view_account_holder_occupations_notifications";
}
?>

<!--Mini Menu -->
<ul class="nav nav-pills">
    <li role="presentation" <?php if (is_menu_set('view_accounts')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_accounts" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-archive"></i>All Accounts
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_accounts_individual')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_accounts_individual" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-archive"></i>Account Details
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_account_holders')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_account_holders" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-archive"></i>Account Holders
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_account_holder_occupations')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_account_holder_occupations" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-archive"></i>Occupation Details
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_account_business_data')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_account_business_data" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-archive"></i>Business Details
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_account_banking_details')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_account_banking_details" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-archive"></i>Banking Details
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_account_nominees')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_account_nominees" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-archive"></i>Account Nominees
        </a>
    </li>
<!--    <li role="presentation" <?php // if (is_menu_set('view_contacts')) { ?> class="active" <?php // } ?>>
        <a class="dropdown-toggle" href="?view_contacts" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-archive"></i>Contact Details
        </a>
    </li>-->
</ul>
<!--Mini Menu END -->