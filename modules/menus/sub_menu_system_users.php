<?php
require_once WPATH . "modules/classes/Notifications.php";
$notifications = new Notifications();

if (is_menu_set('?') != "") {
    $request_type = "search_user";
} else if (is_menu_set('add_contact') != "") {
    $request_type = "search_contacts";
    $action_place_holder = "Search Contacts";
} else if ((is_menu_set('view_contacts') != "") OR ( is_menu_set('view_contacts_notifications') != "")) {
    $request_type = "search_contacts";
    $action_place_holder = "Search Contacts";   
    $notifications_count = $notifications->contactsNotifications();
    $notification_url = "?view_contacts_notifications";
} else if (is_menu_set('update_contact') != "") {
    $request_type = "search_contacts";
    $action_place_holder = "Search Contacts";
} else if (is_menu_set('view_contacts_individual') != "") {
    $request_type = "search_contacts";
    $action_place_holder = "Search Contacts";
} else if (is_menu_set('add_guest_user') != "") {
    $request_type = "search_guest_users";
    $action_place_holder = "Search Guest Users";
} else if (is_menu_set('add_account_nominee') != "") {
    $request_type = "search_account_nominees";
    $action_place_holder = "Search Account Nominees";
} else if (is_menu_set('add_job_advertisement') != "") {
    $request_type = "search_job_advertisements";
    $action_place_holder = "Search Job Advertisement";
} else if ((is_menu_set('view_guest_users') != "") OR ( is_menu_set('view_guest_users_notifications') != "")) {
    $request_type = "search_guest_users";
    $action_place_holder = "Search Guest Users";   
    $notifications_count = $notifications->guestUsersNotifications();
    $notification_url = "?view_guest_users_notifications";
} else if ((is_menu_set('view_inbox_messages') != "") OR ( is_menu_set('view_inbox_messages_notifications') != "")) {
    $request_type = "search_inbox_messages";
    $action_place_holder = "Search Inbox Messages";   
    $notifications_count = $notifications->inboxMessagesNotifications();
    $notification_url = "?view_inbox_messages_notifications";
} else if ((is_menu_set('view_job_advertisements') != "") OR ( is_menu_set('view_job_advertisements_notifications') != "")) {
    $request_type = "search_job_advertisements";
    $action_place_holder = "Search Job Advertisements";   
    $notifications_count = $notifications->jobAdvertisementsNotifications();
    $notification_url = "?view_job_advertisements_notifications";
} else if (is_menu_set('view_job_advertisements_individual') != "") {
    $request_type = "search_job_advertisements";
    $action_place_holder = "Search Job Advertisements";
} else if ((is_menu_set('view_job_applications') != "") OR ( is_menu_set('view_job_applications_notifications') != "")) {
    $request_type = "search_job_applications";
    $action_place_holder = "Search Job Applications";   
    $notifications_count = $notifications->jobApplicationsNotifications();
    $notification_url = "?view_job_applications_notifications";
} else if (is_menu_set('update_guest_user') != "") {
    $request_type = "search_guest_users";
    $action_place_holder = "Search Guest Users";
} else if (is_menu_set('view_guest_users_individual') != "") {
    $request_type = "search_guest_users";
    $action_place_holder = "Search Guest Users";
} else if (is_menu_set('add_system_administrator') != "") {
    $request_type = "search_system_administrators";
    $action_place_holder = "Search System Administrators";
} else if ((is_menu_set('view_system_administrators') != "") OR ( is_menu_set('view_system_administrators_notifications') != "")) {
    $request_type = "search_system_administrators";
    $action_place_holder = "Search System Administrators";   
    $notifications_count = $notifications->systemAdministratorsNotifications();
    $notification_url = "?view_system_administrators_notifications";
} else if (is_menu_set('update_system_administrator') != "") {
    $request_type = "search_system_administrators";
    $action_place_holder = "Search System Administrators";
} else if (is_menu_set('view_system_administrators_individual') != "") {
    $request_type = "search_system_administrators";
    $action_place_holder = "Search System Administrators";
} else if (is_menu_set('add_staff') != "") {
    $request_type = "search_staff";
    $action_place_holder = "Search Staff";
} else if ((is_menu_set('view_staff') != "") OR ( is_menu_set('view_staff_notifications') != "")) {
    $request_type = "search_staff";
    $action_place_holder = "Search Staff";   
    $notifications_count = $notifications->staffNotifications();
    $notification_url = "?view_staff_notifications";
} else if (is_menu_set('update_staff') != "") {
    $request_type = "search_staff";
    $action_place_holder = "Search Staff";
} else if (is_menu_set('update_profpicture') != "") {
    $request_type = "search_staff";
    $action_place_holder = "Search Staff";
} else if (is_menu_set('view_staff_individual') != "") {
    $request_type = "search_staff";
    $action_place_holder = "Search Staff";
} else if ((is_menu_set('view_next_of_kins') != "") OR ( is_menu_set('view_next_of_kins_notifications') != "")) {
    $request_type = "search_next_of_kins";
    $action_place_holder = "Search Next of Kins";
    $notifications_count = $notifications->nextOfKinsNotifications();
    $notification_url = "?view_next_of_kins_notifications";
} else if (is_menu_set('update_next_of_kin') != "") {
    $request_type = "search_next_of_kins";
    $action_place_holder = "Search Next of Kins";
} else if (is_menu_set('view_next_of_kins_individual') != "") {
    $request_type = "search_next_of_kins";
    $action_place_holder = "Search Next of Kins";
} else if (is_menu_set('add_next_of_kin') != "") {
    $request_type = "search_next_of_kins";
    $action_place_holder = "Search Next of Kins";
}
?>

<!--Mini Menu -->
<ul class="menu nav nav-pills">
    
    
<?php if (isset($_SESSION['staqpesa_admin']) AND $_SESSION['staqpesa_admin'] == true) {?>
    <li role="presentation" <?php if (is_menu_set('view_staff') || is_menu_set('add_staff') || is_menu_set('view_staff_individual') || is_menu_set('update_staff') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_staff" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-md"></i>Staff 
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_guest_users') || is_menu_set('add_guest_user') || is_menu_set('view_guest_users_individual') || is_menu_set('update_guest_user') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_guest_users" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-code-fork"></i>Guest Users
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_system_administrators') || is_menu_set('add_system_administrator') || is_menu_set('view_system_administrators_individual') || is_menu_set('update_system_administrator') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_system_administrators" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-chain"></i>System Administrators
        </a>
    </li>    
    <li role="presentation" <?php if (is_menu_set('view_next_of_kins') || is_menu_set('add_next_of_kin') || is_menu_set('view_next_of_kins_individual') || is_menu_set('update_next_of_kin') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_next_of_kins" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bullhorn"></i>Next of Kins
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_contacts') || is_menu_set('add_contact') || is_menu_set('view_contacts_individual') || is_menu_set('update_contact') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_contacts" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-dot-circle-o"></i>Contacts
        </a>
    </li>
<?php } else if (isset($_SESSION['institution_admin']) AND $_SESSION['institution_admin'] == true) {?>
    <li role="presentation" <?php if (is_menu_set('view_staff') || is_menu_set('add_staff') || is_menu_set('view_staff_individual') || is_menu_set('update_staff') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_staff" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-md"></i>Staff 
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_guest_users') || is_menu_set('add_guest_user') || is_menu_set('view_guest_users_individual') || is_menu_set('update_guest_user') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_guest_users" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-code-fork"></i>Guest Users
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_next_of_kins') || is_menu_set('add_next_of_kin') || is_menu_set('view_next_of_kins_individual') || is_menu_set('update_next_of_kin') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_next_of_kins" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bullhorn"></i>Next of Kins
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_contacts') || is_menu_set('add_contact') || is_menu_set('view_contacts_individual') || is_menu_set('update_contact') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_contacts" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-dot-circle-o"></i>Contacts
        </a>
    </li>
<?php } else if (isset($_SESSION['staqpesa_staff']) AND $_SESSION['staqpesa_staff'] == true) {?>
    <li role="presentation" <?php if (is_menu_set('view_staff') || is_menu_set('add_staff') || is_menu_set('view_staff_individual') || is_menu_set('update_staff') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_staff" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-md"></i>Staff 
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_guest_users') || is_menu_set('add_guest_user') || is_menu_set('view_guest_users_individual') || is_menu_set('update_guest_user') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_guest_users" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-code-fork"></i>Guest Users
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_system_administrators') || is_menu_set('add_system_administrator') || is_menu_set('view_system_administrators_individual') || is_menu_set('update_system_administrator') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_system_administrators" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-chain"></i>System Administrators
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_next_of_kins') || is_menu_set('add_next_of_kin') || is_menu_set('view_next_of_kins_individual') || is_menu_set('update_next_of_kin') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_next_of_kins" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bullhorn"></i>Next of Kins
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_contacts') || is_menu_set('add_contact') || is_menu_set('view_contacts_individual') || is_menu_set('update_contact') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_contacts" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-dot-circle-o"></i>Contacts
        </a>
    </li>
    
    <?php
    if ((is_menu_set('view_guest_users') != "") OR ( is_menu_set('view_system_administrators') != "") OR ( is_menu_set('view_staff') != "") OR ( is_menu_set('view_contacts') != "")) {
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
<?php } else if (isset($_SESSION['institution_staff']) AND $_SESSION['institution_staff'] == true) {?>
    <li role="presentation" <?php if (is_menu_set('view_guest_users') || is_menu_set('add_guest_user') || is_menu_set('view_guest_users_individual') || is_menu_set('update_guest_user') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_guest_users" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-code-fork"></i>Guest Users
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_next_of_kins') || is_menu_set('add_next_of_kin') || is_menu_set('view_next_of_kins_individual') || is_menu_set('update_next_of_kin') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_next_of_kins" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bullhorn"></i>Next of Kins
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_contacts') || is_menu_set('add_contact') || is_menu_set('view_contacts_individual') || is_menu_set('update_contact') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_contacts" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-dot-circle-o"></i>Contacts
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_job_advertisements') || is_menu_set('add_job_advertisement') || is_menu_set('view_job_advertisements_individual') || is_menu_set('update_job_advertisement') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_job_advertisements" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-code-fork"></i>Job Advertisements
        </a>
    </li>
    <li role="presentation" <?php if (is_menu_set('view_job_applications') || is_menu_set('view_job_applications_individual') != "") { ?> class="active" <?php } ?>>
        <a class="dropdown-toggle" href="?view_job_applications" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-dot-circle-o"></i>Job Applications
        </a>
    </li>
    
    <?php
    if ((is_menu_set('view_guest_users') != "") OR ( is_menu_set('view_system_administrators') != "") OR ( is_menu_set('view_staff') != "") OR ( is_menu_set('view_job_advertisements') != "") OR ( is_menu_set('view_job_applications') != "") OR ( is_menu_set('view_contacts') != "") OR ( is_menu_set('view_next_of_kins') != "")) {
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
    
    
    <li role="presentation" style="float: right;"> 
        <form class="navbar-form navbar-left" method="POST">
            <div class="form-group">
                <input type="hidden" name="action" value="search"/>
                <input type="hidden" name="request_type" value="<?php echo $request_type; ?>"/>
                <input type="search" <?php if (is_menu_set('system_users')) {
            echo 'disabled';
        } ?> name="search_input" class="form-control" placeholder="<?php echo $action_place_holder; ?>">
            </div>
            <button type="submit" class="btn btn-default">Search</button>
        </form>
    </li>
</ul>
<!--Mini Menu END -->