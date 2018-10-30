<?php
require_once WPATH . "modules/classes/Notifications.php";
$notifications = new Notifications();

if (is_menu_set('?') != "") {
    $action = "search_user";
} else if ((is_menu_set('view_institutions')) OR (is_menu_set('view_institutions_notifications'))) {
    $request_type = "search_institutions";
    $action_place_holder = "Search Institutions";
    $notifications_count = $notifications->institutionsNotifications();
    $notification_url = "?view_institutions_notifications";
} else if ((is_menu_set('view_accounts')) OR (is_menu_set('view_accounts_notifications'))) {
    $request_type = "search_accounts";
    $action_place_holder = "Search Accounts";
    $notifications_count = $notifications->accountsNotifications();
    $notification_url = "?view_accounts_notifications";
} else if ((is_menu_set('view_account_holders')) OR (is_menu_set('view_account_holders_notifications'))) {
    $request_type = "search_account_holders";
    $action_place_holder = "Search Account Holders";
    $notifications_count = $notifications->accountHoldersNotifications();
    $notification_url = "?view_account_holders_notifications";
} else if ((is_menu_set('view_account_business_data') != "") OR (is_menu_set('view_account_business_data_notifications') != "")) {
    $request_type = "search_account_business_data";
    $action_place_holder = "Search Business Data";
    $notifications_count = $notifications->accountBusinessDataNotifications();
    $notification_url = "?view_business_data_notifications";
} else if ((is_menu_set('view_account_holder_occupations') != "") OR (is_menu_set('view_account_holder_occupations_notifications') != "")) {
    $request_type = "search_account_holder_occupations";
    $action_place_holder = "Search Account Holder Occupations";
    $notifications_count = $notifications->accountHolderOccupationsNotifications();
    $notification_url = "?view_account_holder_occupations_notifications";
} else if ((is_menu_set('view_account_nominees') != "") OR (is_menu_set('view_account_nominees_notifications') != "")) {
    $request_type = "search_account_nominees";
    $action_place_holder = "Search Account Nominees";
    $notifications_count = $notifications->accountNomineesNotifications();
    $notification_url = "?view_account_nominees_notifications";
} else if ((is_menu_set('view_account_banking_details') != "") OR (is_menu_set('view_account_banking_details_notifications') != "")) {
    $request_type = "search_account_banking_details";
    $action_place_holder = "Search Account Banking Details";
    $notifications_count = $notifications->accountBankingDetailsNotifications();
    $notification_url = "?view_account_banking_details_notifications";
}
?>

<!--Mini Menu -->
<ul class="nav nav-pills">


    <?php if (isset($_SESSION['staqpesa_admin']) OR isset($_SESSION['staqpesa_staff'])) { ?>
        <li role="presentation" <?php if (is_menu_set('view_institutions')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_institutions" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Institutions 
            </a>
        </li>
    <?php } ?>
    <li role="presentation" <?php if (is_menu_set('view_accounts')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_accounts" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-archive"></i>Accounts 
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_account_holders')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_account_holders" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-md"></i>Account Holders 
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_account_business_data')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_account_business_data" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-md"></i>Business Details 
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_account_holder_occupations')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_account_holder_occupations" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-md"></i>Member Occupations
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_account_nominees')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_account_nominees" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-md"></i>Account Nominees
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_account_banking_details')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_account_banking_details" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-md"></i>Banking Details
        </a>
    </li>    
    <?php
    if ((is_menu_set('view_accounts') != "") OR (is_menu_set('view_account_holders') != "")) {
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