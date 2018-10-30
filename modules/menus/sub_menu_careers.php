<?php
require_once WPATH . "modules/classes/Notifications.php";
$notifications = new Notifications();

if (is_menu_set('?') != "") {
    $request_type = "search_user";
} else if (is_menu_set('view_job_advertisements')) {
    $request_type = "search_job_advertisements";
    $action_place_holder = "Search Job Advertisements";
//    $notifications_count = $notifications->jobAdvertisementsNotifications();
//    $notification_url = "?view_job_advertisements_notifications";
} else if (is_menu_set('view_job_applications') OR is_menu_set('view_job_applications_notifications')) {
    $request_type = "search_job_applications";
    $action_place_holder = "Search Job Applications";
    $notifications_count = $notifications->jobApplicationsNotifications();
    $notification_url = "?view_job_applications_notifications";
}
?>

<!--Mini Menu -->
<ul class="menu nav nav-pills">

    <li role="presentation" <?php if (is_menu_set('view_job_advertisements')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_job_advertisements" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-code-fork"></i>Job Advertisements
        </a>
    </li>   
    <li role="presentation" <?php if (is_menu_set('view_job_applications')) { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_job_applications" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bullhorn"></i>Job Applications
        </a>
    </li>

    <?php
    if (is_menu_set('view_job_applications')) {
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