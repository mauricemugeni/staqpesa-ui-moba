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
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search..."/>
                    <span class="input-group-btn">
                        <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" >

                <!--Accordion Main-->
                <div class="panel-group" id="accordionMenu" role="tablist" aria-multiselectable="true">
                    <?php
                    if ($_SESSION['logged_in_user_type_details']['name'] == "STAFF") {
                        if (isset($_SESSION['staqpesa_staff']) AND $_SESSION['staqpesa_staff'] == true) {
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
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <i class="fa fa-users"></i> <span id="title">Account Members</span>
                                    </a>
                                    <?php
                                    if ($notifications->accountsNotifications() > 0) {
                                        ?><span class="sidebar-notification label label-success"><a href="#"><i class="fa fa-bell"></i> </a></span>
                                    <?php } ?>

                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <ul class="nav">
                                            <li>
                                                <a id="mainMenuCollapeAccount" href="?view_accounts">
                                                    <span>Member Accounts</span>
                                                    <?php
                                                    if ($notifications->accountsNotifications() > 0) {
                                                        ?>
                                                        <span id="accounts-notification" class="accounts-notification sidebar-notification label label-success">
                                                            <?php
                                                            echo $notifications->accountsNotifications();
                                                        }
                                                        ?>
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="?view_account_holders">
                                                    <span>Account Holders</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="mainMenuCollapeAccount" href="?view_institutions">
                                                    <span>Institutions</span>
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
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!--Menu Item 2-->
                            <div class="panel panel-default" id="menu">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <i class="fa fa-clock-o"></i> <span id="title">Micro Lending</span>
                                        <?php
                                        if ($notifications->loansNotifications() > 0) {
                                            ?><span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                        <?php } ?>
                                    </a>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <ul class="nav">
                                            <li>
                                                <a href="?view_loans">
                                                    <span>Loans</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="?view_loan_repayments">
                                                    <span>Loan Repayments</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="?view_loan_guarantors">
                                                    <span>Loan Guarantors</span>
                                                </a>
                                            </li>
                                            <!--                                            <li>
                                                                                            <a href="?view_loan_business_data">
                                                                                                <span>Loan Business Data</span>
                                                                                            </a>
                                                                                        </li>-->
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!--Menu Item 3-->
                            <div class="panel panel-default" id="menu">
                                <div class="panel-heading" role="tab" id="headingFour">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                        <i class="fa fa-exchange"></i> <span id="title" title="View Deposits, Withdrawals and all Transactions">FOSA Transactions</span>
                                        <?php
                                        if ($notifications->transactionTypesNotifications() > 0 || $notifications->withdrawalsNotifications() > 0) {
                                            ?><span title="Some pending actions" class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                        <?php } ?>
                                    </a>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                    <div class="panel-body">
                                        <ul class="nav">
                                            <li>
                                                <a href="?view_deposits">
                                                    <span>Savings</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="?view_shares">
                                                    <span>Shares</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="?view_withdrawals">
                                                    <span>Withdrawals</span>
                                                    <?php
                                                    if ($notifications->transactionTypesNotifications() > 0) {
                                                        ?>
                                                        <span class="sidebar-notification label label-success">
                                                            <?php
                                                            echo $notifications->transactionTypesNotifications();
                                                        }
                                                        ?>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="?view_account_to_account_transfers">
                                                    <span>Account To Account Transfers</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="?view_transactions">
                                                    <span>All Transactions</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
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
                                                                        <li><a href="?view_investors">Investors</a></li>
                                                                        <li><a href="?view_project_bids">Project Bids</a></li>
                            
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>-->

                            <!--Menu Item 6-->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingSeven">
                                    <a role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                        <i class="fa fa-user-md"></i> <span id="title">System Users</span>
                                        <?php
                                        //if ($notifications->investorsNotifications() > 0 || $notifications->projectsNotifications() > 0 ) {
                                        ?><span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                        <?php //}     ?>
                                    </a>
                                </div>
                                <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                                    <div class="panel-body">
                                        <ul class="nav">
                                            <li><a href="?view_staff">Staff</a></li>
                                            <li><a href="?view_guest_users">Guest Users</a></li>
                                            <li><a href="?view_system_administrators">System Administrators</a></li>
                                            <!--<li><a href="?view_mentors">Mentors</a></li>-->
                                            <li><a href="?view_next_of_kins">Next of Kins</a></li>
                                            <li><a href="?view_contacts">Contacts</a></li>
                                        </ul>
                                    </div>
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


                            <!--Menu Item 9-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingTen">
                                    <a role="button" href="?engage_loan_calculator" >
                                        <i class="fa fa-magic"></i> <span id="title">Amortization Calculator</span>
                                    </a>
                                </div>
                            </div>

                        <?php } else if (isset($_SESSION['institution_staff']) AND $_SESSION['institution_staff'] == true) { ?>


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
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <i class="fa fa-users"></i> <span id="title">Account Members</span>
                                    </a>
                                    <?php
                                    if ($notifications->accountsNotifications() > 0) {
                                        ?><span class="sidebar-notification label label-success"><a href="#"><i class="fa fa-bell"></i> </a></span>
                                    <?php } ?>

                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <ul class="nav">
                                            <li>
                                                <a id="mainMenuCollapeAccount" href="?view_accounts">
                                                    <span>Member Accounts</span>
                                                    <?php
                                                    if ($notifications->accountsNotifications() > 0) {
                                                        ?>
                                                        <span id="accounts-notification" class="accounts-notification sidebar-notification label label-success">
                                                            <?php
                                                            echo $notifications->accountsNotifications();
                                                        }
                                                        ?>
                                                    </span>
                                                </a>
                                            </li>                                            
                                            <li>
                                                <a id="mainMenuCollapeAccount" href="?view_account_holders">
                                                    <span>Account Holders</span>
                                                    <?php
                                                    if ($notifications->accountHoldersNotifications() > 0) {
                                                        ?>
                                                        <span id="accounts-notification" class="accounts-notification sidebar-notification label label-success">
                                                            <?php
                                                            echo $notifications->accountHoldersNotifications();
                                                        }
                                                        ?>
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="?view_account_holder_occupations">
                                                    <span>Account Holder Occupations</span>
                                                    <?php
                                                    if ($notifications->accountHolderOccupationsNotifications() > 0) {
                                                        ?>
                                                        <span id="accounts-notification" class="accounts-notification sidebar-notification label label-success">
                                                            <?php
                                                            echo $notifications->accountHolderOccupationsNotifications();
                                                        }
                                                        ?>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="mainMenuCollapeAccount" href="?view_account_nominees">
                                                    <span>Account Nominees</span>
                                                    <?php
                                                    if ($notifications->accountNomineesNotifications() > 0) {
                                                        ?>
                                                        <span id="accounts-notification" class="accounts-notification sidebar-notification label label-success">
                                                            <?php
                                                            echo $notifications->accountNomineesNotifications();
                                                        }
                                                        ?>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!--Menu Item 2-->
                            <div class="panel panel-default" id="menu">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <i class="fa fa-clock-o"></i> <span id="title">Micro Lending</span>
                                        <?php
                                        if ($notifications->loansNotifications() > 0) {
                                            ?><span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                        <?php } ?>
                                    </a>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <ul class="nav">
                                            <li>
                                                <a href="?view_loans">
                                                    <span>Loans</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="?view_loan_repayments">
                                                    <span>Loan Repayments</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="?view_loan_guarantors">
                                                    <span>Loan Guarantors</span>
                                                </a>
                                            </li>
                                            <!--                                            <li>
                                                                                            <a href="?view_loan_business_data">
                                                                                                <span>Loan Business Data</span>
                                                                                            </a>
                                                                                        </li>-->
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!--Menu Item 3-->
                            <div class="panel panel-default" id="menu">
                                <div class="panel-heading" role="tab" id="headingFour">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                        <i class="fa fa-exchange"></i> <span id="title" title="View Deposits, Withdrawals and all Transactions">FOSA Transactions</span>
                                        <?php
                                        if ($notifications->transactionTypesNotifications() > 0 || $notifications->withdrawalsNotifications() > 0) {
                                            ?><span title="Some pending actions" class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                        <?php } ?>
                                    </a>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                    <div class="panel-body">
                                        <ul class="nav">
                                            <li>
                                                <a href="?view_deposits">
                                                    <span>Savings</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="?view_shares">
                                                    <span>Shares</span>
                                                </a>
                                            </li>
                                            <!--                                            <li>
                                                                                            <a href="?view_withdrawals">
                                                                                                <span>Withdrawals</span>
                                            <?php
//                                                    if ($notifications->transactionTypesNotifications() > 0) {
                                            ?>
                                                                                                    <span class="sidebar-notification label label-success">
                                            <?php
//                                                            echo $notifications->transactionTypesNotifications();
//                                                        }
                                            ?>
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>-->
                                            <!--                                            <li>
                                                                                            <a href="?view_account_to_account_transfers">
                                                                                                <span>Account To Account Transfers</span>
                                                                                            </a>
                                                                                        </li>-->
                                            <li>
                                                <a href="?view_transactions">
                                                    <span>All Transactions</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
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
                                                                        <li><a href="?view_investors">Investors</a></li>
                                                                        <li><a href="?view_project_bids">Project Bids</a></li>
                            
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>-->

                            <!--Menu Item 6-->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingSeven">
                                    <a role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                        <i class="fa fa-user-md"></i> <span id="title">System Users</span>
                                        <?php
                                        //if ($notifications->investorsNotifications() > 0 || $notifications->projectsNotifications() > 0 ) {
                                        ?><span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                        <?php //}     ?>
                                    </a>
                                </div>
                                <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                                    <div class="panel-body">
                                        <ul class="nav">
                                            <li><a href="?view_guest_users">Guest Users</a></li>                                            
                                            <!--<li><a href="?view_mentors">Mentors</a></li>-->
                                            <li><a href="?view_next_of_kins">Next of Kins</a></li>
                                            <li><a href="?view_contacts">Contacts</a></li>

                                        </ul>
                                    </div>
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

                            <!--Menu Item 9-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingTen">
                                    <a role="button" href="?engage_loan_calculator" >
                                        <i class="fa fa-magic"></i> <span id="title">Amortization Calculator</span>
                                    </a>
                                </div>
                            </div>
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

                        <!--Menu Item 1-->
<!--                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <a role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fa fa-money"></i> <span id="title">My Transactions</span>
                                    <span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                </a>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <ul class="nav">
                                        <li><a href="?view_transactions"><span>All Transactions</span></a></li>
                                        <li><a href="?view_deposits">Savings</a></li>
                                        <li><a href="?view_shares"><span>Shares</span></a></li>
                                        <li><a href="?view_withdrawals"><span>Withdrawals</span></a></li>
                                        <li><a href="?view_account_to_account_transfers">Account Transfers</a></li>
                                        <li><a href="?view_loans">Loans</a></li>
                                        <li><a href="?view_account_loan_repayments">Loan Repayments</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>-->
                        
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
                                                        <a role="button" href="?view_contacts_individual&code=<?php // echo $_SESSION['contacts']['id'];   ?>" >
                                                            <i class="fa fa-phone"></i> <span id="title">My Contacts</span>
                                                        </a>
                                                    </div>
                                                </div>
                        
                                                Menu Item 7
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" id="headingEight">
                                                        <a role="button" href="?view_next_of_kins_individual&code=<?php // echo $_SESSION['next_of_kins']['id'];   ?>" >
                                                            <i class="fa fa-dashboard"></i> <span id="title">Next Of Kin</span>
                                                        </a>
                                                    </div>
                                                </div>-->
                    <?php } else if ($_SESSION['logged_in_user_type_details']['name'] == "INSTITUTION") {
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
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fa fa-users"></i> <span id="title">Account Members</span>
                                </a>
                                <?php
                                if ($notifications->accountsNotifications() > 0) {
                                    ?><span class="sidebar-notification label label-success"><a href="#"><i class="fa fa-bell"></i> </a></span>
                                <?php } ?>

                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <ul class="nav">
                                        <li>
                                            <a id="mainMenuCollapeAccount" href="?view_accounts">
                                                <span>Member Accounts</span>
                                                <?php
                                                if ($notifications->accountsNotifications() > 0) {
                                                    ?>
                                                    <span id="accounts-notification" class="accounts-notification sidebar-notification label label-success">
                                                        <?php
                                                        echo $notifications->accountsNotifications();
                                                    }
                                                    ?>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="?view_account_holders">
                                                <span>Account Holders</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!--Menu Item 2-->
                        <div class="panel panel-default" id="menu">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="fa fa-clock-o"></i> <span id="title">Micro Lending</span>
                                    <?php
                                    if ($notifications->loansNotifications() > 0) {
                                        ?><span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                    <?php } ?>
                                </a>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <ul class="nav">
                                        <li>
                                            <a href="?view_loans">
                                                <span>Loans</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="?view_loan_repayments">
                                                <span>Loan Repayments</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="?view_loan_guarantors">
                                                <span>Loan Guarantors</span>
                                            </a>
                                        </li>
                                        <!--                                        <li>
                                                                                    <a href="?view_loan_business_data">
                                                                                        <span>Loan Business Data</span>
                                                                                    </a>
                                                                                </li>-->
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!--Menu Item 3-->
                        <div class="panel panel-default" id="menu">
                            <div class="panel-heading" role="tab" id="headingFour">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    <i class="fa fa-exchange"></i> <span id="title" title="View Deposits, Withdrawals and all Transactions">FOSA Transactions</span>
                                    <?php
                                    if ($notifications->transactionTypesNotifications() > 0 || $notifications->withdrawalsNotifications() > 0) {
                                        ?><span title="Some pending actions" class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                    <?php } ?>
                                </a>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                <div class="panel-body">
                                    <ul class="nav">
                                        <li>
                                            <a href="?view_deposits">
                                                <span>Savings</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="?view_shares">
                                                <span>Shares</span>
                                            </a>
                                        </li>
                                        <!--                                        <li>
                                                                                    <a href="?view_withdrawals">
                                                                                        <span>Withdrawals</span>
                                        <?php
//                                                if ($notifications->transactionTypesNotifications() > 0) {
                                        ?>
                                                                                            <span class="sidebar-notification label label-success">
                                        <?php
//                                                        echo $notifications->transactionTypesNotifications();
//                                                    }
                                        ?>
                                                                                        </span>
                                                                                    </a>
                                                                                </li>-->
                                        <!--                                        <li>
                                                                                    <a href="?view_account_to_account_transfers">
                                                                                        <span>Account To Account Transfers</span>
                                                                                    </a>
                                                                                </li>-->
                                        <li>
                                            <a href="?view_transactions">
                                                <span>All Transactions</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!--Menu Item 4-->
                        <!--                        <div class="panel panel-default">
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
                        <!--                        <div class="panel panel-default">
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
                                                                <li><a href="?view_investors">Investors</a></li>
                                                                <li><a href="?view_project_bids">Project Bids</a></li>
                        
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>-->

                        <!--Menu Item 6-->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingSeven">
                                <a role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                    <i class="fa fa-user-md"></i> <span id="title">System Users</span>
                                    <?php
                                    //if ($notifications->investorsNotifications() > 0 || $notifications->projectsNotifications() > 0 ) {
                                    ?><span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                    <?php //}     ?>
                                </a>
                            </div>
                            <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                                <div class="panel-body">
                                    <ul class="nav">
                                        <li><a href="?view_staff">Staff</a></li>
                                        <li><a href="?view_guest_users">Guest Users</a></li>
                                        <!--<li><a href="?view_mentors">Mentors</a></li>-->
                                        <li><a href="?view_next_of_kins"><span>Next Of Kins</span></a></li>
                                        <li><a href="?view_contacts">Contacts</a></li>

                                    </ul>
                                </div>
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
                            <div class="panel-heading" id="headingNine">
                                <a role="button" href="?engage_loan_calculator" >
                                    <i class="fa fa-magic"></i> <span id="title">Amortization Calculator</span>
                                </a>
                            </div>
                        </div>

                        <?php
                    } else if ($_SESSION['logged_in_user_type_details']['name'] == "SYSTEM ADMINISTRATOR") {
                        if (isset($_SESSION['staqpesa_admin']) AND $_SESSION['staqpesa_admin'] == true) {
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
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <i class="fa fa-users"></i> <span id="title">Account Members</span>
                                    </a>
                                    <?php
                                    if ($notifications->accountsNotifications() > 0) {
                                        ?><span class="sidebar-notification label label-success"><a href="#"><i class="fa fa-bell"></i> </a></span>
                                    <?php } ?>

                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <ul class="nav">
                                            <li>
                                                <a id="mainMenuCollapeAccount" href="?view_accounts">
                                                    <span>Member Accounts</span>
                                                    <?php
                                                    if ($notifications->accountsNotifications() > 0) {
                                                        ?>
                                                        <span id="accounts-notification" class="accounts-notification sidebar-notification label label-success">
                                                            <?php
                                                            echo $notifications->accountsNotifications();
                                                        }
                                                        ?>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="?view_account_holders">
                                                    <span>Account Holders</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="mainMenuCollapeAccount" href="?view_institutions">
                                                    <span>Institutions</span>
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
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!--Menu Item 2-->
                            <div class="panel panel-default" id="menu">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <i class="fa fa-clock-o"></i> <span id="title">Micro Lending</span>
                                        <?php
                                        if ($notifications->loansNotifications() > 0) {
                                            ?><span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                        <?php } ?>
                                    </a>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <ul class="nav">
                                            <li>
                                                <a href="?view_loans">
                                                    <span>Loans</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="?view_loan_repayments">
                                                    <span>Loan Repayments</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="?view_loan_guarantors">
                                                    <span>Loan Guarantors</span>
                                                </a>
                                            </li>
                                            <!--                                            <li>
                                                                                            <a href="?view_loan_business_data">
                                                                                                <span>Loan Business Data</span>
                                                                                            </a>
                                                                                        </li>-->
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!--Menu Item 3-->
                            <div class="panel panel-default" id="menu">
                                <div class="panel-heading" role="tab" id="headingFour">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                        <i class="fa fa-exchange"></i> <span id="title" title="View Deposits, Withdrawals and all Transactions">FOSA Transactions</span>
                                        <?php
                                        if ($notifications->transactionTypesNotifications() > 0 || $notifications->withdrawalsNotifications() > 0) {
                                            ?><span title="Some pending actions" class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                        <?php } ?>
                                    </a>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                    <div class="panel-body">
                                        <ul class="nav">
                                            <li>
                                                <a href="?view_deposits">
                                                    <span>Savings</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="?view_shares">
                                                    <span>Shares</span>
                                                </a>
                                            </li>
                                            <!--                                            <li>
                                                                                            <a href="?view_withdrawals">
                                                                                                <span>Withdrawals</span>
                                            <?php
//                                                    if ($notifications->transactionTypesNotifications() > 0) {
                                            ?>
                                                                                                    <span class="sidebar-notification label label-success">
                                            <?php
//                                                            echo $notifications->transactionTypesNotifications();
//                                                        }
                                            ?>
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>-->
                                            <!--                                            <li>
                                                                                            <a href="?view_account_to_account_transfers">
                                                                                                <span>Account To Account Transfers</span>
                                                                                            </a>
                                                                                        </li>-->
                                            <li>
                                                <a href="?view_transactions">
                                                    <span>All Transactions</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
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
                            <?php //}      ?>
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
                            <?php //}      ?>
                                                                </a>
                                                            </div>
                                                            <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                                                                <div class="panel-body">
                                                                    <ul class="nav">
                                                                        <li><a href="?view_investors">Investors</a></li>
                                                                        <li><a href="?view_project_bids">Project Bids</a></li>
                            
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>-->

                            <!--Menu Item 6-->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingSeven">
                                    <a role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                        <i class="fa fa-user-md"></i> <span id="title">System Users</span>
                                        <?php
                                        //if ($notifications->investorsNotifications() > 0 || $notifications->projectsNotifications() > 0 ) {
                                        ?><span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                        <?php //}      ?>
                                    </a>
                                </div>
                                <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                                    <div class="panel-body">
                                        <ul class="nav">
                                            <li><a href="?view_staff">Staff</a></li>
                                            <li><a href="?view_guest_users">Guest Users</a></li>
                                            <li><a href="?view_system_administrators">System Administrators</a></li>
                                            <!--<li><a href="?view_mentors">Mentors</a></li>-->
                                            <li><a href="?view_next_of_kins">Next of Kins</a></li>
                                            <li><a href="?view_contacts">Contacts</a></li>

                                        </ul>
                                    </div>
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

                            <!--Menu Item 9-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingTen">
                                    <a role="button" href="?engage_loan_calculator" >
                                        <i class="fa fa-magic"></i> <span id="title">Amortization Calculator</span>
                                    </a>
                                </div>
                            </div>
                            <?php
                        } else if (isset($_SESSION['institution_admin']) AND $_SESSION['institution_admin'] == true) {
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
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <i class="fa fa-users"></i> <span id="title">Account Members</span>
                                    </a>
                                    <?php
                                    if ($notifications->accountsNotifications() > 0) {
                                        ?><span class="sidebar-notification label label-success"><a href="#"><i class="fa fa-bell"></i> </a></span>
                                    <?php } ?>

                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <ul class="nav">
                                            <li>
                                                <a id="mainMenuCollapeAccount" href="?view_accounts">
                                                    <span>Member Accounts</span>
                                                    <?php
                                                    if ($notifications->accountsNotifications() > 0) {
                                                        ?>
                                                        <span id="accounts-notification" class="accounts-notification sidebar-notification label label-success">
                                                            <?php
                                                            echo $notifications->accountsNotifications();
                                                        }
                                                        ?>
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="?view_account_holders">
                                                    <span>Account Holders</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!--Menu Item 2-->
                            <div class="panel panel-default" id="menu">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <i class="fa fa-clock-o"></i> <span id="title">Micro Lending</span>
                                        <?php
                                        if ($notifications->loansNotifications() > 0) {
                                            ?><span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                        <?php } ?>
                                    </a>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <ul class="nav">
                                            <li>
                                                <a href="?view_loans">
                                                    <span>Loans</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="?view_loan_repayments">
                                                    <span>Loan Repayments</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="?view_loan_guarantors">
                                                    <span>Loan Guarantors</span>
                                                </a>
                                            </li>
                                            <!--                                            <li>
                                                                                            <a href="?view_loan_business_data">
                                                                                                <span>Loan Business Data</span>
                                                                                            </a>
                                                                                        </li>-->
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!--Menu Item 3-->
                            <div class="panel panel-default" id="menu">
                                <div class="panel-heading" role="tab" id="headingFour">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                        <i class="fa fa-exchange"></i> <span id="title" title="View Deposits, Withdrawals and all Transactions">FOSA Transactions</span>
                                        <?php
                                        if ($notifications->transactionTypesNotifications() > 0 || $notifications->withdrawalsNotifications() > 0) {
                                            ?><span title="Some pending actions" class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                        <?php } ?>
                                    </a>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                    <div class="panel-body">
                                        <ul class="nav">
                                            <li>
                                                <a href="?view_deposits">
                                                    <span>Savings</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="?view_shares">
                                                    <span>Shares</span>
                                                </a>
                                            </li>
                                            <!--                                            <li>
                                                                                            <a href="?view_withdrawals">
                                                                                                <span>Withdrawals</span>
                                            <?php
//                                                    if ($notifications->transactionTypesNotifications() > 0) {
                                            ?>
                                                                                                    <span class="sidebar-notification label label-success">
                                            <?php
//                                                            echo $notifications->transactionTypesNotifications();
//                                                        }
                                            ?>
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>-->
                                            <!--                                            <li>
                                                                                            <a href="?view_account_to_account_transfers">
                                                                                                <span>Account To Account Transfers</span>
                                                                                            </a>
                                                                                        </li>-->
                                            <li>
                                                <a href="?view_transactions">
                                                    <span>All Transactions</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
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
                            <?php //}      ?>
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
                            <?php //}      ?>
                                                                </a>
                                                            </div>
                                                            <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                                                                <div class="panel-body">
                                                                    <ul class="nav">
                                                                        <li><a href="?view_investors">Investors</a></li>
                                                                        <li><a href="?view_project_bids">Project Bids</a></li>
                            
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>-->

                            <!--Menu Item 6-->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingSeven">
                                    <a role="button" data-toggle="collapse" data-parent="#accordionMenu" href="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                        <i class="fa fa-user-md"></i> <span id="title">System Users</span>
                                        <?php
                                        //if ($notifications->investorsNotifications() > 0 || $notifications->projectsNotifications() > 0 ) {
                                        ?><span class="sidebar-notification label label-success"><i class="fa fa-bell"></i> </span>
                                        <?php //}      ?>
                                    </a>
                                </div>
                                <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                                    <div class="panel-body">
                                        <ul class="nav">
                                            <li><a href="?view_staff">Staff</a></li>
                                            <li><a href="?view_guest_users">Guest Users</a></li>
                                            <li><a href="?view_next_of_kins">Next of Kins</a></li>
                                            <li><a href="?view_contacts">Contacts</a></li>

                                        </ul>
                                    </div>
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

                            <!--Menu Item 9-->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingTen">
                                    <a role="button" href="?engage_loan_calculator" >
                                        <i class="fa fa-magic"></i> <span id="title">Amortization Calculator</span>
                                    </a>
                                </div>
                            </div>
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
