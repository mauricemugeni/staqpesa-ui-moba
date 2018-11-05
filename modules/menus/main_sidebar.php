<?php
require_once WPATH . "modules/classes/Notifications.php";
$notifications = new Notifications();
if (App::isLoggedIn()) {
    ?>
    <script>
        $('#noti-box-menu').slimScrol({
            width: '100px',
            size: '2px',
            BorderRadius: '5px'
        });
    </script>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas" style="position: fixed;">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <div class="user-panel">
                <!--<div class="pull-left image">
                    <img src="img/26115.jpg" class="img-circle" alt="User Image" />
                </div> -->
                <div class="pull-left info">       
                    <a href="<?php echo $_SESSION['profile_link']; ?>">
                        <p>Hello,  <?php
                            if (isset($_SESSION['user'])) {
                                echo ucwords(strtolower($_SESSION['user_details']['firstname']));
                            }
                            ?></p>
                        <i class="fa fa-circle text-success"></i> Online 
                    </a>
                </div>

            </div>

            <!-- search form -->
            <!--<form action="#" method="get" class="sidebar-form">-->
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
            <!--</form>-->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" >

                <!--Accordion Main-->
                <div class="panel-group" id="accordionMenu" role="tablist" aria-multiselectable="true">
                    <?php
                    if ($_SESSION['logged_in_user_type_details']['name'] == "STAFF") {
                        if (isset($_SESSION['staqpesa_staff']) AND $_SESSION['staqpesa_staff'] == true) {
                            ?>

                            <!--Menu Item 1-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingOne">
                                    <a role="button" href="?dashboard" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Dashboard</span>
                                    </a>
                                </div>
                            </div>

                            <!--Menu Item 2-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingTwo">
                                    <a id="mainMenuCollapeAccount" href="?view_institutions">
                                        <i class="fa fa-dashboard"></i> <span id="title">Institutions</span>
                                        <?php
                                        if ($notifications->institutionsNotifications() > 0) {
                                            ?>
                                            <span id="accounts-notification" class="accounts-notification sidebar-notification label label-success">
                                                <?php
                                                echo $notifications->institutionsNotifications();
                                            }
                                            ?>
                                        </span>
                                    </a>
                                </div>
                            </div>

                            <!--Menu Item 2-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingTwo">
                                    <a id="mainMenuCollapeAccount" href="?view_system_administrators">
                                        <i class="fa fa-dashboard"></i> <span id="title">Institution Administrators</span>
                                        <?php
                                        if ($notifications->systemAdministratorsNotifications() > 0) {
                                            ?>
                                            <span id="accounts-notification" class="accounts-notification sidebar-notification label label-success">
                                                <?php
                                                echo $notifications->systemAdministratorsNotifications();
                                            }
                                            ?>
                                        </span>
                                    </a>
                                </div>
                            </div>

                            <!--Menu Item 7-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingEight">
                                    <a role="button" href="?view_inbox_messages" >
                                        <i class="fa fa-magic"></i> <span id="title">Inbox Messages</span>
                                    </a>
                                </div>
                            </div>
                        <?php } else if (isset($_SESSION['institution_staff']) AND $_SESSION['institution_staff'] == true) { ?>

                            <!--Menu Item 1-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingOne">
                                    <a role="button" href="?dashboard" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Dashboard</span>
                                    </a>
                                </div>
                            </div>

                            <!--Menu Item 3-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingThree">
                                    <a role="button" href="?view_deposits" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Savings</span>
                                    </a>
                                </div>
                            </div>

                            <!--Menu Item 4-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingFour">
                                    <a role="button" href="?view_shares" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Shares</span>
                                    </a>                                    
                                </div>
                            </div>

                            <!--Menu Item 5-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingFive">
                                    <a role="button" href="?view_withdrawals" >
                                        <i class="fa fa-magic"></i> <span id="title">Withdrawals</span>
                                    </a>
                                </div>
                            </div>


                            <!--Menu Item 6-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingSix">
                                    <a role="button" href="?view_account_to_account_transfers" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Account Transfers</span>
                                    </a>
                                </div>
                            </div>

                            <!--Menu Item 7-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingSeven">
                                    <a role="button" href="?view_loans" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Loans</span>
                                    </a>    
                                    <?php
                                    if ($notifications->loansNotifications() > 0) {
                                        ?><span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                    <?php } ?>
                                </div>
                            </div>

                            <!--Menu Item 2-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingTwo">
                                    <a role="button" href="?view_accounts" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Account Members</span>
                                    </a>
                                    <?php if ($notifications->accountsNotifications() > 0 OR $notifications->accountHoldersNotifications() > 0) { ?>
                                        <span class="sidebar-notification label label-success"><a href="#"><i class="fa fa-bell"></i> </a></span>
                                    <?php } ?>
                                </div>
                            </div>

                            <!--Menu Item 9-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingNine">
                                    <a role="button" href="?view_guest_users" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Guest Users</span>
                                    </a>
                                    <?php if ($notifications->guestUsersNotifications() > 0) { ?>
                                        <span class="sidebar-notification label label-success"><a href="#"><i class="fa fa-bell"></i> </a></span>
                                    <?php } ?>                                    
                                </div>
                            </div>

                            <!--Menu Item 10-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingTen"> 
                                    <a role="button" href="?view_next_of_kins" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Next of kins</span>
                                    </a>
                                </div>
                            </div>                            

                            <!--Menu Item 11-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingEleven">
                                    <a role="button" href="?view_inbox_messages" >
                                        <i class="fa fa-magic"></i> <span id="title">Inbox Messages</span>
                                    </a>
                                    <?php
                                    if (isset($_SESSION['staqpesa_admin']) OR isset($_SESSION['institution_admin'])) {
//      $notifications_count = $notifications->assignedOpenInboxMessagesNotifications();
                                        $notifications_count = $notifications->unassignedInboxMessagesNotifications();
                                    } else if (isset($_SESSION['staqpesa_staff']) OR isset($_SESSION['institution_staff'])) {
                                        $notifications_count = $notifications->assignedInboxMessagesNotifications();
                                    }
                                    if ($notifications_count > 0) {
                                        ?>
                                        <span class="sidebar-notification label label-success"><a href="#"><i class="fa fa-bell"></i> </a></span>
                                    <?php } ?>                                    
                                </div>
                            </div>

                            <!--Menu Item 12-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingTwelve">
                                    <a role="button" href="?view_contacts" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Contacts</span>
                                    </a>                                    
                                </div>
                            </div>

                            <!--Menu Item 13-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingThirteen">
                                    <a role="button" href="?engage_loan_calculator" >
                                        <i class="fa fa-magic"></i> <span id="title">Amortization Calculator</span>
                                    </a>
                                </div>
                            </div>


                            <!--Menu Item 4-->
                            <!--                            <div class="panel panel-default">
                                                            <div class="panel-heading" role="tab" id="headingFive">
                                                                <a role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                                                    <i class="fa fa-code"></i> <span id="title">Projects</span>
                            <?php
                            //if ($notifications->investorsNotifications() > 0 || $notifications->projectsNotifications() > 0 ) {
                            ?><span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                            <?php //}     ?>
                                                                </a>
                                                            </div>
                                                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                                                <div class="panel-body">
                                                                    <ul class="nav">
                                                                        <li><a href="?view_projects">All Projects</a></li>
                                                                        <li><a href="?view_unbidded_projects">Unbidded Projects</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>-->

                            <!--Menu Item 5-->
                            <!--                            <div class="panel panel-default">
                                                            <div class="panel-heading" role="tab" id="headingSix">
                                                                <a role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                                                    <i class="fa fa-rocket"></i> <span id="title">Investors</span>
                            <?php
                            //if ($notifications->investorsNotifications() > 0 || $notifications->projectsNotifications() > 0 ) {
                            ?><span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                            <?php //}     ?>
                                                                </a>
                                                            </div>
                                                            <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                                                                <div class="panel-body">
                                                                    <ul class="nav">
                                                                        <li><a href="?view_mentors">Mentors</a></li>
                                                                        <li><a href="?view_investors">Investors</a></li>
                                                                        <li><a href="?view_project_bids">Project Bids</a></li>                            
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>-->


                            <!--Menu Item 8-->
                            <!--                            <div class="panel panel-default">
                                                            <div class="panel-heading" role="tab" id="headingNine">
                                                                <a role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                                                                    <i class="fa fa-user-md"></i> <span id="title">Jobs Corner</span>
                            <?php
                            //if ($notifications->jobAdvertisementsNotifications() > 0 || $notifications->jobApplicationsNotifications() > 0 ) {
                            ?><span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                            <?php //}     ?>
                                                                </a>
                                                            </div>
                                                            <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
                                                                <div class="panel-body">
                                                                    <ul class="nav">
                                                                        <li><a href="?view_job_advertisements">Job Advertisements</a></li>
                                                                        <li><a href="?view_job_applications">Job Applications</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>-->

                            <!--Menu Item 9-->
                            <!--                            <div class="panel panel-default">
                                                            <div class="panel-heading" id="headingTen">
                                                                <a role="button" href="?engage_loan_calculator" >
                                                                    <i class="fa fa-magic"></i> <span id="title">Amortization Calculator</span>
                                                                </a>
                                                            </div>
                                                        </div>-->
                            <?php
                        }
                    } else if ($_SESSION['logged_in_user_type_details']['name'] == "ACCOUNT HOLDER") {
                        ?>

                        <!--Menu Item 0-->
                        <div class="panel panel-default">
                            <div class="panel-heading" id="headingOne">
                                <a role="button" href="?dashboard" >
                                    <i class="fa fa-dashboard"></i> <span id="title">Dashboard</span>
                                </a>
                            </div>
                        </div>


                        <!--Menu Item 1-->
                        <div class="panel panel-default">
                            <div class="panel-heading" id="headingTwo">
                                <a role="button" href="?view_transactions" >
                                    <i class="fa fa-home"></i> <span id="title">All Transactions</span>
                                </a>
                            </div>
                        </div>


                        <!--Menu Item 2-->
                        <div class="panel panel-default">
                            <div class="panel-heading" id="headingThree">
                                <a role="button" href="?view_deposits" >
                                    <i class="fa fa-home"></i> <span id="title">Savings</span>
                                </a>
                            </div>
                        </div>

                        <!--Menu Item 3-->
                        <div class="panel panel-default">
                            <div class="panel-heading" id="headingFour">
                                <a role="button" href="?view_shares" >
                                    <i class="fa fa-home"></i> <span id="title">Shares</span>
                                </a>
                            </div>
                        </div>


                        <!--Menu Item 4-->
                        <div class="panel panel-default">
                            <div class="panel-heading" id="headingFive">
                                <a role="button" href="?view_withdrawals" >
                                    <i class="fa fa-home"></i> <span id="title">Withdrawals</span>
                                </a>
                            </div>
                        </div>

                        <!--Menu Item 5-->
                        <div class="panel panel-default">
                            <div class="panel-heading" id="headingSix">
                                <a role="button" href="?view_account_to_account_transfers" >
                                    <i class="fa fa-home"></i> <span id="title">Account Transfers</span>
                                </a>
                            </div>
                        </div>


                        <!--Menu Item 6-->
                        <div class="panel panel-default">
                            <div class="panel-heading" id="headingSeven">
                                <a role="button" href="?view_loans" >
                                    <i class="fa fa-home"></i> <span id="title">Loans</span>
                                </a>
                            </div>
                        </div>

                        <!--Menu Item 7-->
                        <div class="panel panel-default">
                            <div class="panel-heading" id="headingEight">
                                <a role="button" href="?view_account_loan_repayments" >
                                    <i class="fa fa-home"></i> <span id="title">Loan Repayments</span>
                                </a>
                            </div>
                        </div>

                        <!--Menu Item 6-->
                        <!--                        <div class="panel panel-default">
                                                    <div class="panel-heading" id="headingSeven">
                                                        <a role="button" href="?view_projects" >
                                                            <i class="fa fa-code"></i> <span id="title">Projects</span>
                                                        </a>
                                                    </div>
                                                </div>-->

                        <!--Menu Item 7-->
                        <div class="panel panel-default">
                            <div class="panel-heading" id="headingEight">
                                <a role="button" href="?view_contacts_individual&code=<?php echo $_SESSION['contacts']['id']; ?>" >
                                    <i class="fa fa-phone-square"></i> <span id="title">My Contacts</span>
                                </a>
                            </div>
                        </div>

                        <!--Menu Item 8-->
                        <div class="panel panel-default">
                            <div class="panel-heading" id="headingNine">
                                <a role="button" href="?view_next_of_kins_individual&code=<?php echo $_SESSION['next_of_kins']['id']; ?>" >
                                    <i class="fa fa-users"></i> <span id="title">Next Of Kin</span>
                                </a>
                            </div>
                        </div>

                        <!--Menu Item 10-->
                        <div class="panel panel-default">
                            <div class="panel-heading" id="headingEleven">
                                <a role="button" href="?view_account_nominees" >
                                    <i class="fa fa-users"></i> <span id="title">Account Nominees</span>
                                </a>
                            </div>
                        </div>

                        <!--Menu Item 9-->
                        <div class="panel panel-default">
                            <div class="panel-heading" id="headingTen">
                                <a role="button" href="?engage_loan_calculator" >
                                    <i class="fa fa-magic"></i> <span id="title">Amortization Calculator</span>
                                </a>
                            </div>
                        </div>

                    <?php } else if ($_SESSION['logged_in_user_type_details']['name'] == "GUEST") {
                        ?>

                        <!--Menu Item 0-->
                        <div class="panel panel-default">
                            <div class="panel-heading" id="headingOne">
                                <a role="button" href="?dashboard" >
                                    <i class="fa fa-dashboard"></i> <span id="title">Dashboard</span>
                                </a>
                            </div>
                        </div>

                        <!--Menu Item 1-->
                        <div class="panel panel-default">
                            <div class="panel-heading" id="headingTwo">
                                <a role="button" href="?guest_loans" >
                                    <i class="fa fa-clock-o"></i> <span id="title">Loans</span>
                                </a>
                            </div>
                        </div>

                        <!--Menu Item 2-->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <a role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    <i class="fa fa-money"></i> <span id="title">Contributions</span>
                                    <span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                </a>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <ul class="nav">
                                        <li><a href="?guest_deposits">Savings</a></li>
                                        <li><a href="?guest_shares"><span>Shares</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!--Menu Item 3-->
                        <!--                        <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="headingFour">
                                                        <a role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                                            <i class="fa fa-arrow-circle-up"></i> <span id="title">Withdrawals</span>
                                                            <span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                                        </a>
                                                    </div>
                                                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                                        <div class="panel-body">
                                                            <ul class="nav">
                                                                <li><a href="?guest_withdrawals">Account Withdrawals</a></li>
                                                                <li><a href="?guest_account_to_account_transfers"><span>Account-To-Account Transfers</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>-->

                        <!--Menu Item 4-->
                        <div class="panel panel-default">
                            <div class="panel-heading" id="headingFIve">
                                <a role="button" href="?banking" >
                                    <i class="fa fa-home"></i> <span id="title">Banking</span>
                                </a>
                            </div>
                        </div>

                        <!--Menu Item 5-->
                        <div class="panel panel-default">
                            <div class="panel-heading" id="headingSix">
                                <a role="button" href="?guest_transactions" >
                                    <i class="fa fa-exchange"></i> <span id="title">All My Transactions</span>
                                </a>
                            </div>
                        </div>

                        <!--Menu Item 6-->
                        <!--                        <div class="panel panel-default">
                                                    <div class="panel-heading" id="headingSeven">
                                                        <a role="button" href="?guest_projects" >
                                                            <i class="fa fa-code"></i> <span id="title">Projects</span>
                                                        </a>
                                                    </div>
                                                </div>-->

                        <!--Menu Item 7-->
                        <div class="panel panel-default">
                            <div class="panel-heading" id="headingEight">
                                <a role="button" href="?guest_contacts" >
                                    <i class="fa fa-phone"></i> <span id="title">My Contacts</span>
                                </a>
                            </div>
                        </div>

                        <!--Menu Item 8-->
                        <div class="panel panel-default">
                            <div class="panel-heading" id="headingNine">
                                <a role="button" href="?guest_next_of_kins" >
                                    <i class="fa fa-users"></i> <span id="title">Next Of Kin</span>
                                </a>
                            </div>
                        </div>

                        <!--Menu Item 10-->
                        <div class="panel panel-default">
                            <div class="panel-heading" id="headingTen">
                                <a role="button" href="?engage_loan_calculator" >
                                    <i class="fa fa-magic"></i> <span id="title">Amortization Calculator</span>
                                </a>
                            </div>
                        </div>

                        <?php // } else if ($_SESSION['logged_in_user_type_details']['name'] == "INVESTOR") {
                        ?>

                        <!--Menu Item 0-->
                        <!--                        <div class="panel panel-default">
                                                    <div class="panel-heading" id="headingOne">
                                                        <a role="button" href="?dashboard" >
                                                            <i class="fa fa-dashboard"></i> <span id="title">Dashboard</span>
                                                        </a>
                                                    </div>
                                                </div>
                        
                                                Menu Item 1
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" id="headingTwo">
                                                        <a role="button" href="?view_unbidded_projects" >
                                                            <i class="fa fa-code"></i> <span id="title">Available Projects</span>
                                                        </a>
                                                    </div>
                                                </div>
                        
                                                Menu Item 2
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" id="headingThree">
                                                        <a role="button" href="?view_investor_projects" >
                                                            <i class="fa fa-coffee"></i> <span id="title">My Projects</span>
                                                        </a>
                                                    </div>
                                                </div>
                        
                                                Menu Item 3
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" id="headingThree">
                                                        <a role="button" href="?view_investor_project_bids" >
                                                            <i class="fa fa-code-fork"></i> <span id="title">My Project Bids</span>
                                                        </a>
                                                    </div>
                                                </div>
                        
                                                Menu Item 5
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" id="headingSix">
                                                        <a role="button" href="?banking" >
                                                            <i class="fa fa-home"></i> <span id="title">Banking</span>
                                                        </a>
                                                    </div>
                                                </div>
                        
                                                Menu Item 6
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" id="headingSeven">
                                                        <a role="button" href="?view_contacts_individual&code=<?php // echo $_SESSION['contacts']['id'];                ?>" >
                                                            <i class="fa fa-phone"></i> <span id="title">My Contacts</span>
                                                        </a>
                                                    </div>
                                                </div>
                        
                                                Menu Item 7
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" id="headingEight">
                                                        <a role="button" href="?view_next_of_kins_individual&code=<?php // echo $_SESSION['next_of_kins']['id'];                ?>" >
                                                            <i class="fa fa-dashboard"></i> <span id="title">Next Of Kin</span>
                                                        </a>
                                                    </div>
                                                </div>-->
                        <?php
                    } else if ($_SESSION['logged_in_user_type_details']['name'] == "SYSTEM ADMINISTRATOR") {
                        if (isset($_SESSION['staqpesa_admin']) AND $_SESSION['staqpesa_admin'] == true) {
                            ?>
                            <!--Menu Item 1-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingOne">
                                    <a role="button" href="?dashboard" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Dashboard</span>
                                    </a>
                                </div>
                            </div>

                            <!--Menu Item 2-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingTwo">
                                    <a id="mainMenuCollapeAccount" href="?view_institutions">
                                        <i class="fa fa-dashboard"></i> <span id="title">Institutions</span>
                                        <?php
                                        if ($notifications->institutionsNotifications() > 0) {
                                            ?>
                                            <span id="accounts-notification" class="accounts-notification sidebar-notification label label-success">
                                                <?php
                                                echo $notifications->institutionsNotifications();
                                            }
                                            ?>
                                        </span>
                                    </a>
                                </div>
                            </div>

                            <!--Menu Item 2-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingTwo">
                                    <a id="mainMenuCollapeAccount" href="?view_system_administrators">
                                        <i class="fa fa-dashboard"></i> <span id="title">Institution Administrators</span>
                                        <?php
                                        if ($notifications->systemAdministratorsNotifications() > 0) {
                                            ?>
                                            <span id="accounts-notification" class="accounts-notification sidebar-notification label label-success">
                                                <?php
                                                echo $notifications->systemAdministratorsNotifications();
                                            }
                                            ?>
                                        </span>
                                    </a>
                                </div>
                            </div>

                            <!--Menu Item 2-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingTwo">
                                    <a id="mainMenuCollapeAccount" href="?view_staff">
                                        <i class="fa fa-dashboard"></i> <span id="title">Staff Members</span>
                                        <?php
                                        if ($notifications->staffNotifications() > 0) {
                                            ?>
                                            <span id="accounts-notification" class="accounts-notification sidebar-notification label label-success">
                                                <?php
                                                echo $notifications->staffNotifications();
                                            }
                                            ?>
                                        </span>
                                    </a>
                                </div>
                            </div>

                            <!--Menu Item 3-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingOne">
                                    <a role="button" href="?settings" >
                                        <i class="fa fa-dashboard"></i> <span id="title">System Settings</span>
                                    </a>
                                </div>
                            </div>

                            <!--Menu Item 7-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingEight">
                                    <a role="button" href="?view_inbox_messages" >
                                        <i class="fa fa-magic"></i> <span id="title">Inbox Messages</span>
                                    </a>
                                </div>
                            </div>

                            <!--Menu Item 8-->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingNine">
                                    <a role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                                        <i class="fa fa-user-md"></i> <span id="title">Jobs Corner</span>
                                        <?php
                                        //if ($notifications->jobAdvertisementsNotifications() > 0 || $notifications->jobApplicationsNotifications() > 0 ) {
                                        ?><span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                        <?php //}     ?>
                                    </a>
                                </div>
                                <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
                                    <div class="panel-body">
                                        <ul class="nav">
                                            <li><a href="?view_job_advertisements">Job Advertisements</a></li>
                                            <li><a href="?view_job_applications">Job Applications</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>                            
                            <?php
                        } else if (isset($_SESSION['institution_admin']) AND $_SESSION['institution_admin'] == true) {
                            ?>

                            <!--Menu Item 1-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingOne">
                                    <a role="button" href="?dashboard" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Dashboard</span>
                                    </a>
                                </div>
                            </div>

                            <!--Menu Item 3-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingThree">
                                    <a role="button" href="?view_deposits" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Savings</span>
                                    </a>
                                </div>
                            </div>

                            <!--Menu Item 4-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingFour">
                                    <a role="button" href="?view_shares" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Shares</span>
                                    </a>                                    
                                </div>
                            </div>

                            <!--Menu Item 5-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingFive">
                                    <a role="button" href="?view_withdrawals" >
                                        <i class="fa fa-magic"></i> <span id="title">Withdrawals</span>
                                    </a>
                                </div>
                            </div>


                            <!--Menu Item 6-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingSix">
                                    <a role="button" href="?view_account_to_account_transfers" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Account Transfers</span>
                                    </a>
                                </div>
                            </div>

                            <!--Menu Item 7-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingSeven">
                                    <a role="button" href="?view_loans" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Loans</span>
                                    </a>    
                                    <?php
                                    if ($notifications->loansNotifications() > 0) {
                                        ?><span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                    <?php } ?>
                                </div>
                            </div>

                            <!--Menu Item 2-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingTwo">
                                    <a role="button" href="?view_accounts" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Account Members</span>
                                    </a>
                                    <?php if ($notifications->accountsNotifications() > 0 OR $notifications->accountHoldersNotifications() > 0) { ?>
                                        <span class="sidebar-notification label label-success"><a href="#"><i class="fa fa-bell"></i> </a></span>
                                    <?php } ?>
                                </div>
                            </div>

                            <!--Menu Item 9-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingNine">
                                    <a role="button" href="?view_staff" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Staff</span>
                                    </a>
                                    <?php if ($notifications->staffNotifications() > 0) { ?>
                                        <span class="sidebar-notification label label-success"><a href="#"><i class="fa fa-bell"></i> </a></span>
                                    <?php } ?>                                    
                                </div>
                            </div>

                            <!--Menu Item 9-->
                            <!--                            <div class="panel panel-default">
                                                            <div class="panel-heading" id="headingNine">
                                                                <a role="button" href="?view_system_administrators" >
                                                                    <i class="fa fa-dashboard"></i> <span id="title">System Administrators</span>
                                                                </a>
                            <?php // if ($notifications->systemAdministratorsNotifications() > 0) { ?>
                                                                    <span class="sidebar-notification label label-success"><a href="#"><i class="fa fa-bell"></i> </a></span>
                            <?php // } ?>                                    
                                                            </div>
                                                        </div>-->

                            <!--Menu Item 10-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingTen"> 
                                    <a role="button" href="?view_next_of_kins" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Next of kins</span>
                                    </a>
                                </div>
                            </div>                            

                            <!--Menu Item 11-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingEleven">
                                    <a role="button" href="?view_inbox_messages" >
                                        <i class="fa fa-magic"></i> <span id="title">Inbox Messages</span>
                                    </a>
                                    <?php
                                    if (isset($_SESSION['staqpesa_admin']) OR isset($_SESSION['institution_admin'])) {
//      $notifications_count = $notifications->assignedOpenInboxMessagesNotifications();
                                        $notifications_count = $notifications->unassignedInboxMessagesNotifications();
                                    } else if (isset($_SESSION['staqpesa_staff']) OR isset($_SESSION['institution_staff'])) {
                                        $notifications_count = $notifications->assignedInboxMessagesNotifications();
                                    }
                                    if ($notifications_count > 0) {
                                        ?>
                                        <span class="sidebar-notification label label-success"><a href="#"><i class="fa fa-bell"></i> </a></span>
                                    <?php } ?>                                    
                                </div>
                            </div>

                            <!--Menu Item 12-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingTwelve">
                                    <a role="button" href="?view_contacts" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Contacts</span>
                                    </a>                                    
                                </div>
                            </div>

                            <!--Menu Item 12-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingTwelve">
                                    <a role="button" href="?view_institutions_individual&code=<?php echo $_SESSION['user_details']['institution']; ?>" >
                                        <i class="fa fa-dashboard"></i> <span id="title">Institution Details</span>
                                    </a>                                    
                                </div>
                            </div>

                            <!--Menu Item 13-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingThirteen">
                                    <a role="button" href="?engage_loan_calculator" >
                                        <i class="fa fa-magic"></i> <span id="title">Amortization Calculator</span>
                                    </a>
                                </div>
                            </div>


                            <!--Menu Item 4-->
                            <!--                            <div class="panel panel-default">
                                                            <div class="panel-heading" role="tab" id="headingFive">
                                                                <a role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                                                    <i class="fa fa-code"></i> <span id="title">Projects</span>
                            <?php
                            //if ($notifications->investorsNotifications() > 0 || $notifications->projectsNotifications() > 0 ) {
                            ?><span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                            <?php //}     ?>
                                                                </a>
                                                            </div>
                                                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                                                <div class="panel-body">
                                                                    <ul class="nav">
                                                                        <li><a href="?view_projects">All Projects</a></li>
                                                                        <li><a href="?view_unbidded_projects">Unbidded Projects</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>-->

                            <!--Menu Item 5-->
                            <!--                            <div class="panel panel-default">
                                                            <div class="panel-heading" role="tab" id="headingSix">
                                                                <a role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                                                    <i class="fa fa-rocket"></i> <span id="title">Investors</span>
                            <?php
                            //if ($notifications->investorsNotifications() > 0 || $notifications->projectsNotifications() > 0 ) {
                            ?><span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                            <?php //}     ?>
                                                                </a>
                                                            </div>
                                                            <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                                                                <div class="panel-body">
                                                                    <ul class="nav">
                                                                        <li><a href="?view_mentors">Mentors</a></li>
                                                                        <li><a href="?view_investors">Investors</a></li>
                                                                        <li><a href="?view_project_bids">Project Bids</a></li>                            
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>-->


                            <!--Menu Item 8-->
                            <!--                            <div class="panel panel-default">
                                                            <div class="panel-heading" role="tab" id="headingNine">
                                                                <a role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                                                                    <i class="fa fa-user-md"></i> <span id="title">Jobs Corner</span>
                            <?php
                            //if ($notifications->jobAdvertisementsNotifications() > 0 || $notifications->jobApplicationsNotifications() > 0 ) {
                            ?><span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                            <?php //}     ?>
                                                                </a>
                                                            </div>
                                                            <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
                                                                <div class="panel-body">
                                                                    <ul class="nav">
                                                                        <li><a href="?view_job_advertisements">Job Advertisements</a></li>
                                                                        <li><a href="?view_job_applications">Job Applications</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>-->

                            <!--Menu Item 9-->
                            <!--                            <div class="panel panel-default">
                                                            <div class="panel-heading" id="headingTen">
                                                                <a role="button" href="?engage_loan_calculator" >
                                                                    <i class="fa fa-magic"></i> <span id="title">Amortization Calculator</span>
                                                                </a>
                                                            </div>
                                                        </div>-->

                            <?php
                        }
                    }
                }
                ?>

            </div>
        </ul>
        <!--Accordion Main-->



    </section>
    <!-- /.sidebar -->
</aside>
<script>
    $('.sidebar').enscroll({
        showOnHover: true,
        verticalTrackClass: 'track3',
        verticalHandleClass: 'handle3'
    });

    $("#accounts-notification").click(function () {
        alert('I got a click');
    });
</script>
