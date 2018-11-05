<?php
require_once WPATH . "modules/classes/Notifications.php";
$notifications = new Notifications();

if (is_menu_set('?') != "") {
    $action = "search_user";
} else if ((is_menu_set('view_chapters') != "") OR ( is_menu_set('view_chapters_notifications') != "")) {
    $request_type = "search_chapters";
    $action_place_holder = "Search Chapters";
    $notifications_count = $notifications->chaptersNotifications();
    $notification_url = "?view_chapters_notifications";
} else if ((is_menu_set('view_system_administrators') != "") OR ( is_menu_set('view_system_administrators_notifications') != "")) {
    $request_type = "search_system_administrators";
    $action_place_holder = "Search System Administrators";
    $notifications_count = $notifications->systemAdministratorsNotifications();
    $notification_url = "?view_system_administrators_notifications";
}
?>

<!--Mini Menu -->
<ul class="nav nav-pills">
     <?php if (isset($_SESSION['institution_admin'])) { ?>
        <li role="presentation" <?php if (is_menu_set('view_system_administrators_individual')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_system_administrators_individual&code=<?php echo $_SESSION['userid']; ?>" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Admin Details
            </a>
        </li>        
    <?php } ?>
    <li role="presentation" <?php if (is_menu_set('view_institutions_individual')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_institutions_individual&code=<?php echo $_SESSION['user_details']['institution']; ?>" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-archive"></i>Institution Details
        </a>
    </li>
<!--    <li role="presentation" <?php // if (is_menu_set('view_chapters')) { ?> class="active" <?php // } ?>>
        <a class="dropdown-toggle" href="?view_chapters" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-archive"></i>Institution Chapters
        </a>
    </li>-->
    <?php if (isset($_SESSION['staqpesa_admin']) OR isset($_SESSION['staqpesa_staff'])) { ?>
        <li role="presentation" <?php if (is_menu_set('view_system_administrators')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_system_administrators" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>System Administrators
            </a>
        </li>        
    <?php } ?>
</ul>
<!--Mini Menu END -->