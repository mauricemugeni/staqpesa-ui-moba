
<?php
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
?>
<!-- header logo: style can be found in header.less -->
<header class="header">
    <a href="?dashboard" class="logo">
        <img style="margin-top: 0px;" src="img/branding/svg/moba.svg" width="160">
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <div>
            <a style="float: left;" class="navbar-btn sidebar-toggle" onclick="history.back(-1)">
                <i class="fa fa-arrow-left"></i> 
            </a>
            <a href="#" style="float: left;" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-align-justify"></i>
            </a>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <!--                <li class="dropdown messages-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-envelope"></i>
                                        <span class="label label-success">4</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="header">You have 4 messages</li>
                                        <li>
                                             inner menu: contains the actual data 
                                            <ul class="menu">
                                                <li> start message 
                                                    <a href="#">
                                                        <div class="pull-left">
                                                            <img src="img/26115.jpg" class="img-circle" alt="User Image"/>
                                                        </div>
                                                        <h4>
                                                            Support Team
                                                        </h4>
                                                        <p>Why not buy a new awesome theme?</p>
                                                        <small class="pull-right"><i class="fa fa-clock-o"></i> 5 mins</small>
                                                    </a>
                                                </li> end message 
                                                <li>
                                                    <a href="#">
                                                        <div class="pull-left">
                                                            <img src="img/26115.jpg" class="img-circle" alt="user image"/>
                                                        </div>
                                                        <h4>
                                                            Director Design Team
                                                        </h4>
                                                        <p>Why not buy a new awesome theme?</p>
                                                        <small class="pull-right"><i class="fa fa-clock-o"></i> 2 hours</small>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="pull-left">
                                                            <img src="img/avatar.png" class="img-circle" alt="user image"/>
                                                        </div>
                                                        <h4>
                                                            Developers
                
                                                        </h4>
                                                        <p>Why not buy a new awesome theme?</p>
                                                        <small class="pull-right"><i class="fa fa-clock-o"></i> Today</small>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="pull-left">
                                                            <img src="img/26115.jpg" class="img-circle" alt="user image"/>
                                                        </div>
                                                        <h4>
                                                            Sales Department
                
                                                        </h4>
                                                        <p>Why not buy a new awesome theme?</p>
                                                        <small class="pull-right"><i class="fa fa-clock-o"></i> Yesterday</small>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="pull-left">
                                                            <img src="img/avatar.png" class="img-circle" alt="user image"/>
                                                        </div>
                                                        <h4>
                                                            Reviewers
                
                                                        </h4>
                                                        <p>Why not buy a new awesome theme?</p>
                                                        <small class="pull-right"><i class="fa fa-clock-o"></i> 2 days</small>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="footer"><a href="#">See All Messages</a></li>
                                    </ul>
                                </li>-->
                <!--                <li class="dropdown tasks-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-tasks"></i>
                                        <span class="label label-danger">9</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="header">You have 9 tasks</li>
                                        <li>
                                             inner menu: contains the actual data 
                                            <ul class="menu">
                                                <li> Task item 
                                                    <a href="#">
                                                        <h3>
                                                            Design some buttons
                                                            <small class="pull-right">20%</small>
                                                        </h3>
                                                        <div class="progress progress-striped xs">
                                                            <div class="progress-bar progress-bar-success" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                                <span class="sr-only">20% Complete</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li> end task item 
                                                <li> Task item 
                                                    <a href="#">
                                                        <h3>
                                                            Create a nice theme
                                                            <small class="pull-right">40%</small>
                                                        </h3>
                                                        <div class="progress progress-striped xs">
                                                            <div class="progress-bar progress-bar-danger" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                                <span class="sr-only">40% Complete</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li> end task item 
                                                <li> Task item 
                                                    <a href="#">
                                                        <h3>
                                                            Some task I need to do
                                                            <small class="pull-right">60%</small>
                                                        </h3>
                                                        <div class="progress progress-striped xs">
                                                            <div class="progress-bar progress-bar-info" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                                <span class="sr-only">60% Complete</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li> end task item 
                                                <li> Task item 
                                                    <a href="#">
                                                        <h3>
                                                            Make beautiful transitions
                                                            <small class="pull-right">80%</small>
                                                        </h3>
                                                        <div class="progress progress-striped xs">
                                                            <div class="progress-bar progress-bar-warning" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                                <span class="sr-only">80% Complete</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li> end task item 
                                            </ul>
                                        </li>
                                        <li class="footer">
                                            <a href="#">View all tasks</a>
                                        </li>
                                    </ul>
                                </li>-->

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i>
                        <span><?php
                            if (isset($_SESSION['user'])) {
                                echo $_SESSION['user'];
                            }
                            ?> <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                        <li class="dropdown-header text-center">Account</li>

                        <!--                        <li>
                                                    <a href="#">
                                                        <i class="fa fa-clock-o fa-fw pull-right"></i>
                                                        <span class="badge badge-success pull-right">10</span> Updates</a>
                                                    <a href="#">
                                                        <i class="fa fa-envelope-o fa-fw pull-right"></i>
                                                        <span class="badge badge-danger pull-right">5</span> Messages</a>
                                                    <a href="#"><i class="fa fa-magnet fa-fw pull-right"></i>
                                                        <span class="badge badge-info pull-right">3</span> Subscriptions</a>
                                                    <a href="#"><i class="fa fa-question fa-fw pull-right"></i> <span class="badge pull-right">11</span> FAQ</a>
                                                </li>-->

                        <li class="divider"></li>

                        <li>

                            <?php
                            if (App::isLoggedIn()) {
                                $user_type_details = $users->fetchUserTypeDetails($_SESSION['login_user_type']);
                                if ($user_type_details['name'] == "STAFF") {
                                    $profile_link = "?view_staff_individual&code=" . $_SESSION['userid'];
                                } else if ($user_type_details['name'] == "ACCOUNT HOLDER") {
                                    $profile_link = "?view_account_holders_individual&code=" . $_SESSION['userid'];
                                } else if ($user_type_details['name'] == "INVESTOR") {
                                    $profile_link = "?view_investors_individual&code=" . $_SESSION['userid'];
                                } else if ($user_type_details['name'] == "SYSTEM ADMINISTRATOR") {
                                    $profile_link = "?view_system_administrators_individual&code=" . $_SESSION['userid'];
                                } else if ($user_type_details['name'] == "GUEST") {
                                    $profile_link = "?view_guest_users_individual&code=" . $_SESSION['userid'];
                                } else if ($user_type_details['name'] == "INSTITUTION") {
                                    $profile_link = "?view_system_administrators_individual&code=" . $_SESSION['userid'];
                                }
                                ?> 
                                <a data-toggle="modal" href="<?php echo $profile_link; ?>"><i class="fa fa-user fa-fw pull-right"></i> Profile </a>
                                <?php
                            }

                            if ((isset($_SESSION['staqpesa_admin']) AND $_SESSION['staqpesa_admin'] == true) OR ( isset($_SESSION['institution_admin']) AND $_SESSION['institution_admin'] == true)) {
                                ?>
                                <a data-toggle="modal" href="?settings"><i class="fa fa-cog fa-fw pull-right"></i> Settings</a>
                            <?php } ?>

                            <a href="?website_tac"><i class="fa fa-question fa-fw pull-right"></i> Website Terms & Conditions</a>
                            <a href="?borrowing_tac"><i class="fa fa-question fa-fw pull-right"></i> Borrowing Terms & Conditions</a>

                            <a href="?help"><i class="fa fa-question fa-fw pull-right"></i> Help</a>
                        </li>


                        <li class="divider"></li>

                        <li>
                            <a href="?logout"><i class="fa fa-ban fa-fw pull-right"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>