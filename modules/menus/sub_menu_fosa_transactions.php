<?php
require_once WPATH . "modules/classes/Notifications.php";
$notifications = new Notifications();

if (is_menu_set('?') != "") {
    $request_type = "search_user";
} else if ((is_menu_set('view_account_to_account_transfers')) OR (is_menu_set('view_my_account_to_account_transfers')) OR ( is_menu_set('view_account_to_account_transfers_notifications'))) {
    $request_type = "search_account_to_account_transfers";
    $action_place_holder = "Search Account To Account Transfers";
//    $notifications_count = $notifications->accountToAccountTransfersNotifications();
//    $notification_url = "?view_account_to_account_transfers_notifications";
} else if ((is_menu_set('view_withdrawals')) OR (is_menu_set('view_account_withdrawals')) OR (is_menu_set('view_withdrawals_notifications'))) {
    $request_type = "search_withdrawals";
    $action_place_holder = "Search Withdrawals";
//    $notifications_count = $notifications->withdrawalsNotifications();
//    $notification_url = "?view_withdrawals_notifications";
} else if ((is_menu_set('view_transactions')) OR (is_menu_set('view_account_transactions'))) {
    $request_type = "search_transactions";
    $action_place_holder = "Search Transations";
} else if ((is_menu_set('view_deposits')) OR (is_menu_set('view_account_deposits')) OR (is_menu_set('view_deposits_notifications')) OR (is_menu_set('transitional_view_deposits'))) {
    $request_type = "search_deposits";
    $action_place_holder = "Search Deposits";
//    $notifications_count = $notifications->depositsNotifications();
//    $notification_url = "?view_deposits_notifications";
} else if ((is_menu_set('view_shares')) OR (is_menu_set('view_account_shares')) OR (is_menu_set('view_shares_notifications'))) {
    $request_type = "search_shares";
    $action_place_holder = "Search Shares";
//    $notifications_count = $notifications->sharesNotifications();
//    $notification_url = "?view_shares_notifications";
}
?>

<!--Mini Menu -->
<ul class="nav nav-pills">

    <?php if (isset($_SESSION['staqpesa_admin']) OR isset($_SESSION['staqpesa_staff']) OR isset($_SESSION['institution_admin']) OR isset($_SESSION['institution_staff'])) { ?>
        <li role="presentation" <?php if (is_menu_set('view_transactions')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_transactions" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-money"></i>All Transactions
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_deposits')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_deposits" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-stack-exchange"></i>Savings 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_shares')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_shares" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-stack-exchange"></i>Shares 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_withdrawals')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_withdrawals" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-calendar-o"></i>Withdrawals
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_account_to_account_transfers')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_account_to_account_transfers" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-stack-overflow"></i>Account Transfers
            </a>
        </li>
    <?php } ?>

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
