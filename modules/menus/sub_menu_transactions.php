<?php
require_once WPATH . "modules/classes/Notifications.php";
$notifications = new Notifications();

if (is_menu_set('?') != "") {
    $request_type = "search_user";
} else if (is_menu_set('add_withdrawal') != "") {
    $request_type = "search_withdrawals";
    $action_place_holder = "Search Withdrawals";
} else if (is_menu_set('add_account_to_account_transfer') != "") {
    $request_type = "search_account_to_account_transfers";
    $action_place_holder = "Search Account To Account Transfers";
} else if (is_menu_set('add_account_to_account_transfer_next') != "") {
    $request_type = "search_account_to_account_transfers";
    $action_place_holder = "Search Account To Account Transfers";
} else if ((is_menu_set('view_account_to_account_transfers') != "") OR ( is_menu_set('view_my_account_to_account_transfers') != "") OR ( is_menu_set('view_account_to_account_transfers_notifications') != "")) {
    $request_type = "search_account_to_account_transfers";
    $action_place_holder = "Search Account To Account Transfers";
    $notifications_count = $notifications->accountToAccountTransfersNotifications();
    $notification_url = "?view_account_to_account_transfers_notifications";
} else if (is_menu_set('transitional_add_withdrawal') != "") {
    $request_type = "search_withdrawals";
    $action_place_holder = "Search Withdrawals";
} else if ((is_menu_set('view_withdrawals') != "") OR (is_menu_set('view_account_withdrawals') != "") OR (is_menu_set('view_withdrawals_notifications') != "")) {
    $request_type = "search_withdrawals";
    $action_place_holder = "Search Withdrawals";
    $notifications_count = $notifications->withdrawalsNotifications();
    $notification_url = "?view_withdrawals_notifications";
} else if (is_menu_set('view_withdrawals_individual') != "") {
    $request_type = "search_withdrawals";
    $action_place_holder = "Search Withdrawals";
} else if (is_menu_set('add_transaction') != "") {
    $request_type = "search_transactions";
    $action_place_holder = "Search Transations";
} else if ((is_menu_set('view_transactions') != "") OR ( is_menu_set('view_account_transactions') != "")) {
    $request_type = "search_transactions";
    $action_place_holder = "Search Transations";
} else if (is_menu_set('add_deposit') != "") {
    $request_type = "search_deposits";
    $action_place_holder = "Search Deposits";
} else if (is_menu_set('add_shares') != "") {
    $request_type = "search_shares";
    $action_place_holder = "Search Sharess";
} else if ((is_menu_set('view_deposits') != "") OR ( is_menu_set('view_account_deposits') != "") OR ( is_menu_set('view_deposits_notifications') != "")) {
    $request_type = "search_deposits";
    $action_place_holder = "Search Deposits";
    $notifications_count = $notifications->depositsNotifications();
    $notification_url = "?view_deposits_notifications";
} else if ((is_menu_set('view_shares') != "") OR ( is_menu_set('view_account_shares') != "") OR ( is_menu_set('view_shares_notifications') != "")) {
    $request_type = "search_shares";
    $action_place_holder = "Search Shares";
    $notifications_count = $notifications->sharesNotifications();
    $notification_url = "?view_shares_notifications";
} else if (is_menu_set('transitional_add_deposit') != "") {
    $request_type = "search_deposits";
    $action_place_holder = "Search Deposits";
} else if (is_menu_set('transitional_view_deposits') != "") {
    $request_type = "search_deposits";
    $action_place_holder = "Search Deposits";
}
?>

<!--Mini Menu -->
<ul class="nav nav-pills">

    <?php if (isset($_SESSION['staqpesa_admin']) AND $_SESSION['staqpesa_admin'] == true) { ?>
        <li role="presentation" <?php if (is_menu_set('view_transactions') || is_menu_set('add_transaction') || is_menu_set('view_transactions_individual') || is_menu_set('update_transaction') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_transactions" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-money"></i>Transactions
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_deposits') || is_menu_set('add_deposit') || is_menu_set('view_deposits_individual') || is_menu_set('update_deposit') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_deposits" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-stack-exchange"></i>Savings 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_shares') || is_menu_set('add_shares') || is_menu_set('view_shares_individual') || is_menu_set('update_shares') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_shares" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-stack-exchange"></i>Shares 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_withdrawals') || is_menu_set('add_withdrawal') || is_menu_set('view_withdrawals_individual') || is_menu_set('update_withdrawal') || is_menu_set('transitional_add_withdrawal') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_withdrawals" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-calendar-o"></i>Withdrawals
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_account_to_account_transfers') || is_menu_set('add_account_to_account_transfer') || is_menu_set('view_account_to_account_transfers_individual') || is_menu_set('update_account_to_account_transfer') || is_menu_set('transitional_add_account_to_account_transfer') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_account_to_account_transfers" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-stack-overflow"></i>Account To Account Transfers
            </a>
        </li>
    <?php } else if (isset($_SESSION['institution_admin']) AND $_SESSION['institution_admin'] == true) { ?>
        <li role="presentation" <?php if (is_menu_set('view_transactions') || is_menu_set('add_transaction') || is_menu_set('view_transactions_individual') || is_menu_set('update_transaction') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_transactions" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-money"></i>Transactions
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_deposits') || is_menu_set('add_deposit') || is_menu_set('view_deposits_individual') || is_menu_set('update_deposit') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_deposits" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-stack-exchange"></i>Savings 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_shares') || is_menu_set('add_shares') || is_menu_set('view_shares_individual') || is_menu_set('update_shares') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_shares" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-stack-exchange"></i>Shares 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_withdrawals') || is_menu_set('add_withdrawal') || is_menu_set('view_withdrawals_individual') || is_menu_set('update_withdrawal') || is_menu_set('transitional_add_withdrawal') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_withdrawals" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-calendar-o"></i>Withdrawals
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_account_to_account_transfers') || is_menu_set('add_account_to_account_transfer') || is_menu_set('view_account_to_account_transfers_individual') || is_menu_set('update_account_to_account_transfer') || is_menu_set('transitional_add_account_to_account_transfer') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_account_to_account_transfers" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-stack-overflow"></i>Account To Account Transfers
            </a>
        </li>
    <?php } else if (isset($_SESSION['staqpesa_staff']) AND $_SESSION['staqpesa_staff'] == true) { ?>
        <li role="presentation" <?php if (is_menu_set('view_transactions') || is_menu_set('add_transaction') || is_menu_set('view_transactions_individual') || is_menu_set('update_transaction') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_transactions" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-money"></i>Transactions
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_deposits') || is_menu_set('add_deposit') || is_menu_set('view_deposits_individual') || is_menu_set('update_deposit') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_deposits" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-stack-exchange"></i>Savings 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_shares') || is_menu_set('add_shares') || is_menu_set('view_shares_individual') || is_menu_set('update_shares') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_shares" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-stack-exchange"></i>Shares 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_withdrawals') || is_menu_set('add_withdrawal') || is_menu_set('view_withdrawals_individual') || is_menu_set('update_withdrawal') || is_menu_set('transitional_add_withdrawal') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_withdrawals" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-calendar-o"></i>Withdrawals
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_account_to_account_transfers') || is_menu_set('add_account_to_account_transfer') || is_menu_set('view_account_to_account_transfers_individual') || is_menu_set('update_account_to_account_transfer') || is_menu_set('transitional_add_account_to_account_transfer') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_account_to_account_transfers" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-stack-overflow"></i>Account To Account Transfers
            </a>
        </li>
    <?php } else if (isset($_SESSION['institution_staff']) AND $_SESSION['institution_staff'] == true) { ?>
        <li role="presentation" <?php if (is_menu_set('view_transactions') || is_menu_set('add_transaction') || is_menu_set('view_transactions_individual') || is_menu_set('update_transaction') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_transactions" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-money"></i>Transactions
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_deposits') || is_menu_set('add_deposit') || is_menu_set('view_deposits_individual') || is_menu_set('update_deposit') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_deposits" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-stack-exchange"></i>Savings 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_shares') || is_menu_set('add_shares') || is_menu_set('view_shares_individual') || is_menu_set('update_shares') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_shares" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-stack-exchange"></i>Shares 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_withdrawals') || is_menu_set('add_withdrawal') || is_menu_set('view_withdrawals_individual') || is_menu_set('update_withdrawal') || is_menu_set('transitional_add_withdrawal') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_withdrawals" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-calendar-o"></i>Withdrawals
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_account_to_account_transfers') || is_menu_set('add_account_to_account_transfer') || is_menu_set('view_account_to_account_transfers_individual') || is_menu_set('update_account_to_account_transfer') || is_menu_set('transitional_add_account_to_account_transfer') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_account_to_account_transfers" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-stack-overflow"></i>Account To Account Transfers
            </a>
        </li>

        <?php
        if ((is_menu_set('view_account_to_account_transfers') != "") OR ( is_menu_set('view_withdrawals') != "") OR ( is_menu_set('view_deposits') != "")) {
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
        <li role="presentation" <?php if (is_menu_set('view_transactions') || is_menu_set('add_transaction') || is_menu_set('view_transactions_individual') || is_menu_set('update_transaction') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_transactions" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-money"></i>Transactions
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_deposits') || is_menu_set('add_deposit') || is_menu_set('view_deposits_individual') || is_menu_set('update_deposit') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_deposits" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-stack-exchange"></i>Savings 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_shares') || is_menu_set('add_shares') || is_menu_set('view_shares_individual') || is_menu_set('update_shares') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_shares" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-stack-exchange"></i>Shares 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_withdrawals') || is_menu_set('add_withdrawal') || is_menu_set('view_withdrawals_individual') || is_menu_set('update_withdrawal') || is_menu_set('transitional_add_withdrawal') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_withdrawals" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-calendar-o"></i>Withdrawals
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_account_to_account_transfers') || is_menu_set('add_account_to_account_transfer') || is_menu_set('view_account_to_account_transfers_individual') || is_menu_set('update_account_to_account_transfer') || is_menu_set('transitional_add_account_to_account_transfer') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_account_to_account_transfers" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-stack-overflow"></i>Account To Account Transfers
            </a>
        </li>
    <?php } else if ($_SESSION['logged_in_user_type_details']['name'] == "INVESTOR") { ?>

    <?php } else if ($_SESSION['logged_in_user_type_details']['name'] == "GUEST") { ?>

    <?php } ?>

    <!--    
        <li role="presentation" <?php // if (is_menu_set('view_withdrawals') || is_menu_set('add_withdrawal') || is_menu_set('view_withdrawals_individual') || is_menu_set('update_withdrawal') || is_menu_set('transitional_add_withdrawal') != "") {             ?> class="active" <?php // }             ?>>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-calendar-o"></i>Withdrawals <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li role="presentation" <?php // if (is_menu_set('view_withdrawals') || is_menu_set('add_transaction') || is_menu_set('view_withdrawals_individual') || is_menu_set('update_withdrawal') != "") {             ?> class="active" <?php // }             ?>><a href="?view_withdrawals">Withdrawals</a></li>
                <li role="presentation" <?php // if (is_menu_set('transitional_add_withdrawal') != "") {             ?> class="active" <?php // }             ?>><a href="?transitional_add_withdrawal">Old Withdrawal(Transition)</a></li>
            </ul>
        </li>
        <li role="presentation" <?php // if (is_menu_set('view_deposits') || is_menu_set('add_deposit') || is_menu_set('view_deposits_individual') || is_menu_set('update_deposit') != "") {             ?> class="active" <?php // }             ?>>
            <a class="dropdown-toggle" href="?view_deposits" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-stack-exchange"></i>Deposits 
            </a>
        </li>
        <li role="presentation" <?php // if (is_menu_set('transitional_add_deposit') || is_menu_set('transitional_view_deposits') != "") {             ?> class="active" <?php // }             ?>>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-stack-overflow"></i>Deposit(Transition)<span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li role="presentation" <?php // if (is_menu_set('transitional_view_deposits') != "") {             ?> class="active" <?php //}             ?>><a href="?transitional_view_deposits">Old Withdrawal(Transition)</a></li>
            </ul>
        </li>-->

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

<?php // if (isset($_SESSION['staqpesa_admin']) AND $_SESSION['staqpesa_admin'] == true) {?>

<?php // } else if (isset($_SESSION['institution_admin']) AND $_SESSION['institution_admin'] == true) {?>

<?php // } else if (isset($_SESSION['staqpesa_staff']) AND $_SESSION['staqpesa_staff'] == true) {?>

<?php // } else if (isset($_SESSION['institution_staff']) AND $_SESSION['institution_staff'] == true) {?>

<?php // } else if ($_SESSION['logged_in_user_type_details']['name'] == "ACCOUNT HOLDER") {?>

<?php // } else if ($_SESSION['logged_in_user_type_details']['name'] == "INVESTOR") {?>

<?php // } else if ($_SESSION['logged_in_user_type_details']['name'] == "GUEST") { ?>

<?php
// } ?>