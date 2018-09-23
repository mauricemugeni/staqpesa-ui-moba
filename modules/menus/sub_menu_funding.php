<?php
require_once WPATH . "modules/classes/Notifications.php";
$notifications = new Notifications();

if (is_menu_set('?') != "") {
    $request_type = "search_user";
} else if (is_menu_set('add_investor') != "") {
    $request_type = "search_investors";
    $action_place_holder = "Search Investors";
} else if ((is_menu_set('view_investors') != "") OR ( is_menu_set('view_investors_notifications') != "")) {
    $request_type = "search_investors";
    $action_place_holder = "Search Investors";
    $notifications_count = $notifications->investorsNotifications();
    $notification_url = "?view_investors_notifications";
} else if (is_menu_set('view_investors_individual') != "") {
    $request_type = "search_investors";
    $action_place_holder = "Search Investors";
} else if (is_menu_set('update_investor') != "") {
    $request_type = "search_investors";
    $action_place_holder = "Search Investors";
} else if (is_menu_set('add_project') != "") {
    $request_type = "search_projects";
    $action_place_holder = "Search Projects";
} else if ((is_menu_set('view_projects') != "") OR ( is_menu_set('view_projects_notifications') != "")) {
    $request_type = "search_projects";
    $action_place_holder = "Search Projects";
    $notifications_count = $notifications->projectsNotifications();
    $notification_url = "?view_projects_notifications";
} else if (is_menu_set('view_member_projects') != "") {
    $request_type = "search_projects";
    $action_place_holder = "Search Projects";
} else if (is_menu_set('view_investor_projects') != "") {
    $request_type = "search_projects";
    $action_place_holder = "Search Projects";
} else if (is_menu_set('view_unbidded_projects') != "") {
    $request_type = "search_projects";
    $action_place_holder = "Search Projects";
} else if (is_menu_set('view_my_projects') != "") {
    $request_type = "search_projects";
    $action_place_holder = "Search Projects";
} else if (is_menu_set('view_projects_individual') != "") {
    $request_type = "search_projects";
    $action_place_holder = "Search Projects";
} else if (is_menu_set('update_project') != "") {
    $request_type = "search_projects";
    $action_place_holder = "Search Projects";
} else if (is_menu_set('add_project_bid') != "") {
    $request_type = "search_project_bids";
    $action_place_holder = "Search Project Bids";
} else if (is_menu_set('view_project_bids') != "") {
    $request_type = "search_project_bids";
    $action_place_holder = "Search Project Bids";
//    $notifications_count = $notifications->projectBidsNotifications();
//    $notification_url = "?view_project_bids_notifications";
} else if (is_menu_set('view_investor_project_bids') != "") {
    $request_type = "search_project_bids";
    $action_place_holder = "Search Project Bids";
} else if (is_menu_set('view_project_bids_individual') != "") {
    $request_type = "search_project_bids";
    $action_place_holder = "Search Project Bids";
} else if (is_menu_set('view_bids_on_project') != "") {
    $request_type = "search_project_bids";
    $action_place_holder = "Search Project Bids";
} else if (is_menu_set('update_project_bid') != "") {
    $request_type = "search_project_bids";
    $action_place_holder = "Search Project Bids";
}
?>

<!--Mini Menu -->
<ul class="nav nav-pills">


    <?php if (isset($_SESSION['staqpesa_admin']) AND $_SESSION['staqpesa_admin'] == true) { ?>
        <li role="presentation" <?php if (is_menu_set('view_investors') || is_menu_set('add_investor') || is_menu_set('view_investors_individual') || is_menu_set('update_investor') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_investors" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-fighter-jet"></i>Investors 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_projects') || is_menu_set('add_project') || is_menu_set('view_projects_individual') || is_menu_set('update_project') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_projects" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-code-fork"></i>All Projects
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_unbidded_projects') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_unbidded_projects" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-chain"></i>Unbidded Projects 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_project_bids') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_project_bids" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bullhorn"></i>Project Bids 
            </a>
        </li>
    <?php } else if (isset($_SESSION['institution_admin']) AND $_SESSION['institution_admin'] == true) { ?>
        <li role="presentation" <?php if (is_menu_set('view_investors') || is_menu_set('add_investor') || is_menu_set('view_investors_individual') || is_menu_set('update_investor') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_investors" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-fighter-jet"></i>Investors 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_projects') || is_menu_set('add_project') || is_menu_set('view_projects_individual') || is_menu_set('update_project') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_projects" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-code-fork"></i>All Projects
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_unbidded_projects') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_unbidded_projects" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-chain"></i>Unbidded Projects 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_project_bids') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_project_bids" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bullhorn"></i>Project Bids 
            </a>
        </li>
    <?php } else if (isset($_SESSION['staqpesa_staff']) AND $_SESSION['staqpesa_staff'] == true) { ?>
        <li role="presentation" <?php if (is_menu_set('view_investors') || is_menu_set('add_investor') || is_menu_set('view_investors_individual') || is_menu_set('update_investor') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_investors" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-fighter-jet"></i>Investors 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_projects') || is_menu_set('add_project') || is_menu_set('view_projects_individual') || is_menu_set('update_project') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_projects" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-code-fork"></i>All Projects
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_unbidded_projects') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_unbidded_projects" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-chain"></i>Unbidded Projects 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_project_bids') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_project_bids" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bullhorn"></i>Project Bids 
            </a>
        </li>
    <?php } else if (isset($_SESSION['institution_staff']) AND $_SESSION['institution_staff'] == true) { ?>
        <li role="presentation" <?php if (is_menu_set('view_investors') || is_menu_set('add_investor') || is_menu_set('view_investors_individual') || is_menu_set('update_investor') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_investors" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-fighter-jet"></i>Investors 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_projects') || is_menu_set('add_project') || is_menu_set('view_projects_individual') || is_menu_set('update_project') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_projects" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-code-fork"></i>All Projects
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_unbidded_projects') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_unbidded_projects" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-chain"></i>Unbidded Projects 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_project_bids') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_project_bids" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bullhorn"></i>Project Bids 
            </a>
        </li>

        <?php
        if ((( is_menu_set('view_investors') != "") OR ( is_menu_set('view_projects') != ""))) {
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
        <li role="presentation" <?php if (is_menu_set('view_projects') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_projects" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-chain"></i>My Projects 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_project_bids')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_project_bids" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bullhorn"></i>Bids On My Projects 
            </a>
        </li>
    <?php } else if ($_SESSION['logged_in_user_type_details']['name'] == "INVESTOR") { ?>
        <li role="presentation" <?php if (is_menu_set('view_unbidded_projects') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_unbidded_projects" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-chain"></i>Available Projects 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_investor_projects') != "") { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_investor_projects" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-chain"></i>My Projects 
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_project_bids')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_project_bids" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bullhorn"></i>My Project Bids 
            </a>
        </li>
    <?php } else if ($_SESSION['logged_in_user_type_details']['name'] == "GUEST") { ?>

    <?php } ?>


    <!--    <li role="presentation" <?php
//    if (is_menu_set('view_investor_types') || is_menu_set('add_investor_type') || is_menu_set('view_investor_types_individual') || is_menu_set('update_investor_type') ||
//            is_menu_set('view_investors') || is_menu_set('add_investor') || is_menu_set('view_investors_individual') || is_menu_set('update_investor') != "") {
    ?> class="active" <?php // }  ?>>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-fighter-jet"></i>Investors <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li role="presentation" <?php // if (is_menu_set('view_investor_types') || is_menu_set('add_investor_type') || is_menu_set('view_investor_types_individual') || is_menu_set('update_investor_type') != "") {    ?> class="active" <?php // }    ?>><a href="?view_investor_types">Investor Types</a></li>
                <li role="presentation" <?php // if (is_menu_set('view_investors') || is_menu_set('add_investor') || is_menu_set('view_investors_individual') || is_menu_set('update_investor') != "") {    ?> class="active" <?php // }    ?>><a href="?view_investors">Investors</a></li>
            </ul>
        </li>-->
    <!--    <li role="presentation" <?php
    // if (is_menu_set('view_projects') || is_menu_set('add_project') || is_menu_set('view_projects_individual') || is_menu_set('update_project') ||
//    is_menu_set('view_unbidded_projects') || is_menu_set('add_unbidded_project') || is_menu_set('view_unbidded_projects_individual') || is_menu_set('update_unbidded_project') || is_menu_set('view_my_projects') != "") { 
    ?> class="active" <?php // }   ?>>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-code-fork"></i>Projects <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li role="presentation"><a href="?view_funding_types">Funding Types</a></li>
                <li role="presentation"><a href="?add_funding_type">Add Funding Type</a></li>
            </ul>
        </li>-->
    <!--    <li role="presentation">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                Investors <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li role="presentation"><a href="?view_investor_types">Investor Types</a></li>
                <li role="presentation"><a href="?add_investor_type">Add Investor Type</a></li>
                <li role="presentation"><a href="?view_investors">Investors</a></li>
                <li role="presentation"><a href="?add_investor">Add Investor</a></li>
            </ul>
        </li>-->
    <!--    <li role="presentation">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                Projects <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li role="presentation"><a href="?view_projects">All Projects</a></li>
                <li role="presentation"><a href="?view_unbidded_projects">Unbidded Projects</a></li>
                <li role="presentation"><a href="?view_member_projects">Member Projects</a></li>
                <li role="presentation"><a href="?add_project">Add Project</a></li>
                <li role="presentation"><a href="?view_project_bids">View Project Bids</a></li>
                <li role="presentation"><a href="?view_investor_project_bids">View Investor Bids</a></li>
                <li role="presentation" <?php // if (is_menu_set('view_projects') || is_menu_set('add_project') || is_menu_set('view_projects_individual') || is_menu_set('update_project') != "") {    ?> class="active" <?php // }    ?>><a href="?view_projects">All Projects</a></li>
                <li role="presentation" <?php // if (is_menu_set('view_unbidded_projects') || is_menu_set('add_unbidded_project') || is_menu_set('view_unbidded_projects_individual') || is_menu_set('update_unbidded_project') != "") {    ?> class="active" <?php // }    ?>><a href="?view_unbidded_projects">Un-bid Projects</a></li>
                <li role="presentation" <?php // if (is_menu_set('view_my_projects') != "") {    ?> class="active" <?php // }    ?>><a href="?view_my_projects">My Projects</a></li>
            </ul>
        </li>-->

    <li role="presentation" style="float: right;"> 
        <form class="navbar-form navbar-left" method="POST">
            <div class="form-group">
                <input type="hidden" name="action" value="search"/>
                <input type="hidden" name="request_type" value="<?php echo $request_type; ?>"/>
                <input type="search" name="search_input" class="form-control" placeholder="<?php echo $action_place_holder; ?>" >
<!--                <input type="search" name="search_input" class="form-control" placeholder="<?php // echo $action_place_holder;       ?>" readonly="yes">-->
            </div>
            <button type="submit" class="btn btn-default">Search</button>
        </form>
    </li>
</ul>
<!--Mini Menu END -->