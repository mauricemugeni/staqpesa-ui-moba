<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Reports.php";
$reports = new Reports();
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>

    <aside class="right-side">

        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_settings.php'); ?>
            <?php // require_once('modules/sub_modules/overview.php'); ?>
            <!-- Main row -->
            <!--            <div class="row">
            <?php // require_once('modules/sub_modules/graph.php'); ?>
            <?php // require_once('modules/sub_modules/notifications.php'); ?>
                        </div>
            
                        <div class="row">
            <?php // require_once('modules/sub_modules/working_progress.php'); ?>
            <?php // require_once('modules/sub_modules/team_mates.php'); ?>
                        </div>
            
                        <div class="row">
            <?php // require_once('modules/sub_modules/new.php'); ?>
            <?php // require_once('modules/sub_modules/new2.php'); ?>
                        </div>
                        <div class="row">
            <?php // require_once('modules/sub_modules/privileges.php'); ?>
            <?php // require_once('modules/sub_modules/system_components.php'); ?>
                        </div>-->

            <!-- row end -->


            <div class="row" style="margin-bottom:0px;">

                <?php if (isset($_SESSION['staqpesa_admin']) AND $_SESSION['staqpesa_admin'] == true) { ?>
                    
                    <a href="?view_business_types" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-green"><i class="fa fa-bullseye"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_business_types"); ?></span>
                                    <span>Business Types</span>
                                </div>
                            </div>
                        </div>
                    </a>

                <a href="?view_instalment_frequencies" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-green"><i class="fa fa-clock-o"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_instalment_frequencies"); ?></span>
                                    <span>Instalment Frequencies</span>
                                </div>
                            </div>
                        </div>
                    </a>


                    <a href="?view_system_privileges" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-blue"><i class="fa fa-user-md"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_system_privileges"); ?></span>
                                    <span>System Privileges</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="?view_system_components" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-green"><i class="fa fa-bars"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_system_components"); ?></span>
                                    <span>System Components</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="?view_roles" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-green"><i class="fa fa-shield"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_roles"); ?></span>
                                    <span>Roles</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="?view_user_types" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-violet"><i class="fa fa-users"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_user_types"); ?></span>
                                    <span>User Types</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="?view_account_categories" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-red"><i class="fa fa-columns"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_account_categories"); ?></span>
                                    <span>Account Categories</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="?view_transaction_types" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-blue"><i class="fa fa-arrows"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_transaction_types"); ?></span>
                                    <span>Transaction Types</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="?view_business_forms" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-green"><i class="fa fa-file"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_business_forms"); ?></span>
                                    <span>Business Forms</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="?view_statuses" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-green"><i class="fa fa-code"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_statuses"); ?></span>
                                    <span>Status Codes</span>
                                </div>
                            </div>
                        </div>
                    </a>
                
                    <a href="?view_marital_statuses" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-blue"><i class="fa fa-umbrella"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_marital_statuses"); ?></span>
                                    <span>Marital Statuses</span>
                                </div>
                            </div>
                        </div>
                    </a>
                                
                    <a href="?view_account_types" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-green"><i class="fa fa-anchor"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_account_types"); ?></span>
                                    <span>Account Types</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="?view_responses" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-violet"><i class="fa fa-reply"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_responses"); ?></span>
                                    <span>Responses</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="?view_financing_methods" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-green"><i class="fa fa-money"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_financing_methods"); ?></span>
                                    <span>Financing Methods</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="?view_funding_types" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-violet"><i class="fa fa-usd"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_funding_types"); ?></span>
                                    <span>Funding Types</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="?view_investor_types" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-violet"><i class="fa fa-usd"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_investor_types"); ?></span>
                                    <span>Investor Types</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="?view_sectors" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-violet"><i class="fa fa-usd"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_sectors"); ?></span>
                                    <span>Sectors</span>
                                </div>
                            </div>
                        </div>
                    </a>

                <?php } else if (isset($_SESSION['institution_admin']) AND $_SESSION['institution_admin'] == true) { ?>
                    <a href="?view_branches" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-blue"><i class="fa fa-btc"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_branches"); ?></span>
                                    <span>Branches</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="?view_loan_types" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-green"><i class="fa fa-bitbucket"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_loan_types"); ?></span>
                                    <span>Loan Types</span>
                                </div>
                            </div>
                        </div>
                    </a>

<!--                    <a href="?view_default_charge_rates" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-violet"><i class="fa fa-money"></i></span>
                                <div class="sm-st-info">
                                    <span><?php // echo $reports->countAllSubjectAreaRecords("count_all_default_charge_rates"); ?></span>
                                    <span>Default Charge Rates</span>
                                </div>
                            </div>
                        </div>
                    </a>-->

                    <a href="?view_loan_processing_fees" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-red"><i class="fa fa-magnet"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_loan_processing_fees"); ?></span>
                                    <span>Loan Processing Fees</span>
                                </div>
                            </div>
                        </div>
                    </a>
                
                    <a href="?view_positions" >
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-red"><i class="fa fa-random"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $reports->countAllSubjectAreaRecords("count_all_positions"); ?></span>
                                    <span>Positions</span>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php } ?>

            </div>

        </section><!-- /.content -->

    </aside><!-- /.right-side -->
</div>