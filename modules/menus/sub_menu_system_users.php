<?php
require_once WPATH . "modules/classes/Notifications.php";
$notifications = new Notifications();

if (is_menu_set('?') != "") {
    $request_type = "search_user";
} else if (is_menu_set('view_system_administrators')) {
    $request_type = "search_system_administrators";
    $action_place_holder = "Search System Administrators";
//    $notifications_count = $notifications->systemAdministratorsNotifications();
//    $notification_url = "?view_system_administrators_notifications";
} else if (is_menu_set('view_staff')) {
    $request_type = "search_staff";
    $action_place_holder = "Search Staff";
//    $notifications_count = $notifications->staffNotifications();
//    $notification_url = "?view_staff_notifications";
} else if (is_menu_set('view_guest_users') OR is_menu_set('view_guest_users_notifications')) {
    $request_type = "search_guest_users";
    $action_place_holder = "Search Guest Users";
    $notifications_count = $notifications->guestUsersNotifications();
    $notification_url = "?view_guest_users_notifications";
} else if (is_menu_set('view_next_of_kins')) {
    $request_type = "search_next_of_kins";
    $action_place_holder = "Search Next of Kins";
//    $notifications_count = $notifications->nextOfKinsNotifications();
//    $notification_url = "?view_next_of_kins_notifications";
}
?>

<!--Mini Menu -->
<ul class="menu nav nav-pills">


    <?php if (isset($_SESSION['staqpesa_admin']) OR isset($_SESSION['staqpesa_staff'])) { ?>    
        <li role="presentation" <?php if (is_menu_set('view_system_administrators')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_system_administrators" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-chain"></i>System Administrators
            </a>
        </li> 
        <?php
    }
    if (isset($_SESSION['staqpesa_admin']) OR isset($_SESSION['institution_admin'])) {
        ?> 
        <li role="presentation" <?php if (is_menu_set('view_staff')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_staff" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user-md"></i>Staff 
            </a>
        </li>
    <?php } ?>
    <li role="presentation" <?php if (is_menu_set('view_guest_users')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_guest_users" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-code-fork"></i>Guest Users
        </a>
    </li>   
    <li role="presentation" <?php if (is_menu_set('view_next_of_kins')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_next_of_kins" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bullhorn"></i>Next of Kins
        </a>
    </li>

    <?php
    if (is_menu_set('view_guest_users')) {
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
                <input type="search" <?php
//                if (is_menu_set('system_users')) {
//                    echo 'disabled';
//                }
                ?> name="search_input" class="form-control" placeholder="<?php echo $action_place_holder; ?>">
            </div>
            <button type="submit" class="btn btn-default">Search</button>
        </form>
    </li>
</ul>
<!--Mini Menu END -->