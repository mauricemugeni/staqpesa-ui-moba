<?php
require_once WPATH . "modules/classes/Notifications.php";
$notifications = new Notifications();

if (is_menu_set('?') != "") {
    $request_type = "search_user";
} else if (is_menu_set('view_contacts')) {
    $request_type = "search_contacts";
    $action_place_holder = "Search Contacts";
} else if ((is_menu_set('view_inbox_messages') != "") OR ( is_menu_set('view_inbox_messages_notifications') != "")) {
    $request_type = "search_inbox_messages";
    $action_place_holder = "Search Inbox Messages";
    
    if (isset($_SESSION['staqpesa_admin']) OR isset($_SESSION['institution_admin'])) {
//      $notifications_count = $notifications->assignedOpenInboxMessagesNotifications();
        $notifications_count = $notifications->unassignedInboxMessagesNotifications();
    } else if (isset($_SESSION['staqpesa_staff']) OR isset($_SESSION['institution_staff'])) {
        $notifications_count = $notifications->assignedInboxMessagesNotifications();
    }
    
    $notification_url = "?view_inbox_messages_notifications";
}
?>

<!--Mini Menu -->
<ul class="menu nav nav-pills">


    <?php if (isset($_SESSION['staqpesa_admin']) OR isset($_SESSION['institution_admin']) OR isset($_SESSION['staqpesa_staff']) OR isset($_SESSION['institution_staff'])) { ?>
        <li role="presentation" <?php if (is_menu_set('view_inbox_messages') || is_menu_set('view_inbox_messages_notifications') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_inbox_messages" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user-md"></i>Inbox Messages 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_contacts')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_contacts" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-dot-circle-o"></i>Contacts
            </a>
        </li>
        <?php
        if (is_menu_set('view_inbox_messages') OR is_menu_set('view_inbox_messages_notifications')) {
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
<?php } ?>

    <li role="presentation" style="float: right;"> 
        <form class="navbar-form navbar-left" method="POST">
            <div class="form-group">
                <input type="hidden" name="action" value="search"/>
                <input type="hidden" name="request_type" value="<?php echo $request_type; ?>"/>
                <input type="search" <?php
                       if (is_menu_set('system_users')) {
                           echo 'disabled';
                       }
                       ?> name="search_input" class="form-control" placeholder="<?php echo $action_place_holder; ?>">
            </div>
            <button type="submit" class="btn btn-default">Search</button>
        </form>
    </li>
</ul>
<!--Mini Menu END -->