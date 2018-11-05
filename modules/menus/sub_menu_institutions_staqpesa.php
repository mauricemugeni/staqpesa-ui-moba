<?php
require_once WPATH . "modules/classes/Notifications.php";
$notifications = new Notifications();

if (is_menu_set('?') != "") {
    $action = "search_user";
} else if ((is_menu_set('view_institutions') != "") OR ( is_menu_set('view_institutions_notifications') != "")) {
    $request_type = "search_institutions";
    $action_place_holder = "Search Institutions";
    $notifications_count = $notifications->institutionsNotifications();
    $notification_url = "?view_institutions_notifications";
} else if ((is_menu_set('view_system_administrators') != "") OR ( is_menu_set('view_system_administrators_notifications') != "")) {
    $request_type = "search_system_administrators";
    $action_place_holder = "Search System Administrators";
    $notifications_count = $notifications->systemAdministratorsNotifications();
    $notification_url = "?view_system_administrators_notifications";
}
?>

<!--Mini Menu -->
<ul class="nav nav-pills">
    <li role="presentation" <?php if (is_menu_set('view_institutions')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_institutions" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-archive"></i>Institutions
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_system_administrators')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_system_administrators" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-archive"></i>Institution Administrators
        </a>
    </li>

    <?php
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

