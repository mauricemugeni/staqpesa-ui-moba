<?php
require_once WPATH . "modules/classes/Notifications.php";
$notifications = new Notifications();

if (is_menu_set('?') != "") {
    $action = "search_user";
} else if ((is_menu_set('add_account') != "") OR (is_menu_set('add_personal_occupation_details') != "") OR (is_menu_set('add_group_account_details') != "") OR (is_menu_set('add_business_account_details') != "") OR ( is_menu_set('add_account_banking') != "")) {
    $request_type = "search_accounts";
    $action_place_holder = "Search Accounts";
} else if (is_menu_set('transitional_update_account') != "") {
    $request_type = "search_accounts";
    $action_place_holder = "Search Accounts";
} else if (is_menu_set('add_institution') != "") {
    $request_type = "search_institutions";
    $action_place_holder = "Search Institutions";
} else if ((is_menu_set('view_institutions') != "") OR ( is_menu_set('view_institutions_notifications') != "")) {
    $request_type = "search_institutions";
    $action_place_holder = "Search Institutions";
    $notifications_count = $notifications->institutionsNotifications();
    $notification_url = "?view_institutions_notifications";
} else if (is_menu_set('update_institution') != "") {
    $request_type = "search_institutions";
    $action_place_holder = "Search Institutions";
} else if (is_menu_set('view_institutions_individual') != "") {
    $request_type = "search_institutions";
    $action_place_holder = "Search Institutions";
} else if (is_menu_set('update_account') != "") {
    $request_type = "search_accounts";
    $action_place_holder = "Search Accounts";
} else if (is_menu_set('update_account_holder') != "") {
    $request_type = "search_account_holders";
    $action_place_holder = "Search Account Holders";
} else if (is_menu_set('update_signature') != "") {
    $request_type = "search_account_holders";
    $action_place_holder = "Search Account Holders";
} else if (is_menu_set('add_account_holder') != "") {
    $request_type = "search_account_holder";
    $action_place_holder = "Search Account Holders";
} else if (is_menu_set('view_accounts_individual') != "") {
    $request_type = "search_accounts";
    $action_place_holder = "Search Accounts";
} else if ((is_menu_set('view_accounts') != "") OR ( is_menu_set('view_accounts_notifications') != "")) {
    $request_type = "search_accounts";
    $action_place_holder = "Search Accounts";
    $notifications_count = $notifications->accountsNotifications();
    $notification_url = "?view_accounts_notifications";
} else if (is_menu_set('transitional_view_account') != "") {
    $request_type = "search_accounts";
    $action_place_holder = "Search Accounts";
} else if (is_menu_set('transitional_view_accounts_individual') != "") {
    $request_type = "search_accounts";
    $action_place_holder = "Search Accounts";
} else if ((is_menu_set('view_account_holders') != "") OR ( is_menu_set('view_account_holders_notifications') != "")) {
    $request_type = "search_account_holders";
    $action_place_holder = "Search Account Holders";
    $notifications_count = $notifications->accountHoldersNotifications();
    $notification_url = "?view_account_holders_notifications";
} else if (is_menu_set('view_account_holders_individual') != "") {
    $request_type = "search_account_holders";
    $action_place_holder = "Search Account Holders";
} else if (is_menu_set('view_account_holders_individual_account') != "") {
    $request_type = "search_account_holders";
    $action_place_holder = "Search Account Holders";
}
else if (is_menu_set('add_account_former') != "") {
    $request_type = "search_account_holders";
    $action_place_holder = "Search Account Holders";
}
?>

<!--Mini Menu -->
<ul class="nav nav-pills">
    
    
<?php if (isset($_SESSION['staqpesa_admin']) AND $_SESSION['staqpesa_admin'] == true) {?>
    <li role="presentation" <?php if (is_menu_set('view_institutions') || is_menu_set('add_institution') || is_menu_set('view_institutions_individual') || is_menu_set('update_institution') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_institutions" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-archive"></i>Institutions 
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_accounts') || is_menu_set('add_account') || is_menu_set('view_accounts_individual') || is_menu_set('update_account') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_accounts" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-archive"></i>Accounts 
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_account_holders') || is_menu_set('add_account_holder') || is_menu_set('view_account_holders_individual') || is_menu_set('update_account_holder') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_account_holders" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-md"></i>Account Holders 
        </a>
    </li>
<?php } else if (isset($_SESSION['institution_admin']) AND $_SESSION['institution_admin'] == true) {?>
    <li role="presentation" <?php if (is_menu_set('view_accounts') || is_menu_set('add_account') || is_menu_set('view_accounts_individual') || is_menu_set('update_account') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_accounts" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-archive"></i>Accounts 
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_account_holders') || is_menu_set('add_account_holder') || is_menu_set('view_account_holders_individual') || is_menu_set('update_account_holder') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_account_holders" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-md"></i>Account Holders 
        </a>
    </li>
<?php } else if (isset($_SESSION['staqpesa_staff']) AND $_SESSION['staqpesa_staff'] == true) {?>
    <li role="presentation" <?php if (is_menu_set('view_institutions') || is_menu_set('add_institution') || is_menu_set('view_institutions_individual') || is_menu_set('update_institution') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_institutions" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-archive"></i>Institutions 
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_accounts') || is_menu_set('add_account') || is_menu_set('view_accounts_individual') || is_menu_set('update_account') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_accounts" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-archive"></i>Accounts 
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_account_holders') || is_menu_set('add_account_holder') || is_menu_set('view_account_holders_individual') || is_menu_set('update_account_holder') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_account_holders" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-md"></i>Account Holders 
        </a>
    </li>
<?php } else if (isset($_SESSION['institution_staff']) AND $_SESSION['institution_staff'] == true) {?>
    <li role="presentation" <?php if (is_menu_set('view_accounts') || is_menu_set('add_account') || is_menu_set('view_accounts_individual') || is_menu_set('update_account') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_accounts" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-archive"></i>Accounts 
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_account_holders') || is_menu_set('add_account_holder') || is_menu_set('view_account_holders_individual') || is_menu_set('update_account_holder') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_account_holders" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-md"></i>Account Holders 
        </a>
    </li>    
    <?php
    if ((is_menu_set('view_accounts') != "") OR ( is_menu_set('view_account_holders') != "")) {
        if ($notifications_count > 0) {
            ?>
            <li class="dropdown tasks-menu">
                <a href="<?php echo $notification_url; ?>" class="dropdown-toggle">
                    <i class="fa fa-bell"></i> Pending Actions
                    <span class="label label-danger"><?php echo $notifications_count; ?> </span>
                </a>
            </li>
        <?php }
    }
    ?>
<?php } else if ($_SESSION['logged_in_user_type_details']['name'] == "ACCOUNT HOLDER") {?>
    
<?php } else if ($_SESSION['logged_in_user_type_details']['name'] == "INVESTOR") {?>
    
<?php } else if ($_SESSION['logged_in_user_type_details']['name'] == "GUEST") { ?>
    
<?php } ?>
    
    
<!--    <li role="presentation" <?php // if (is_menu_set('transitional_view_account') || is_menu_set('view_accounts') || is_menu_set('add_account') || is_menu_set('update_account') || is_menu_set('view_accounts_individual') != "") { ?> class="active" <?php // } ?>>
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-archive"></i>Accounts <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li role="presentation" <?php // if (is_menu_set('view_accounts') != "") { ?> class="active" <?php // } ?>><a href="?view_accounts">Accounts</a></li>
            <li role="presentation" <?php // if (is_menu_set('transitional_view_account') != "") { ?> class="active" <?php // } ?>><a href="?transitional_view_account">Accounts(Transition)</a></li>
        </ul>
    </li>-->

<!--    <li role="presentation" <?php
    // if (is_menu_set('view_account_holders') || is_menu_set('add_account_holder') || is_menu_set('update_account_holder') || is_menu_set('view_account_holders_individual') ||
//            is_menu_set('view_next_of_kins') || is_menu_set('add_next_of_kin') || is_menu_set('update_next_of_kin') || is_menu_set('view_next_of_kins_individual') != "") {
        ?> class="active" <?php // } ?>>
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-md"></i>Account Holders <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li role="presentation" <?php // if (is_menu_set('view_account_holders') || is_menu_set('add_account_holder') || is_menu_set('update_account_holder') || is_menu_set('view_account_holders_individual') != "") { ?> class="active" <?php // } ?>><a href="?view_account_holders">Account Holders</a></li>
            <li role="presentation" <?php // if (is_menu_set('view_next_of_kins') || is_menu_set('add_next_of_kin') || is_menu_set('update_next_of_kin') || is_menu_set('view_next_of_kins_individual') != "") { ?> class="active" <?php // } ?>><a href="?view_next_of_kins">Next of Kins</a></li>
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
<!--Mini Menu END -->