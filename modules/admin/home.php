
<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <section class="content">
            <?php if (isset($_SESSION['staqpesa_admin']) AND $_SESSION['staqpesa_admin'] == true) { ?>
                <?php require_once('modules/dashboard/overview.php'); ?>
                <div class="row">
                    <div class="col-md-7">
                        <?php require_once('modules/dashboard/top_deposits.php'); ?>
                        <?php require_once('modules/dashboard/top_loans.php'); ?>
                    </div>
                    <div class="col-md-5">
                        <?php require_once('modules/dashboard/recent_transactions.php'); ?>
                    </div>
                </div>
            <?php } else if (isset($_SESSION['staqpesa_staff']) AND $_SESSION['staqpesa_staff'] == true) { ?>
                <?php require_once('modules/dashboard/overview.php'); ?>
                <div class="row">
                    <div class="col-md-7">
                        <?php require_once('modules/dashboard/top_deposits.php'); ?>
                        <?php require_once('modules/dashboard/top_loans.php'); ?>
                    </div>
                    <div class="col-md-5">
                        <?php require_once('modules/dashboard/recent_transactions.php'); ?>
                    </div>
                </div>
            <?php } else if (isset($_SESSION['institution_admin']) AND $_SESSION['institution_admin'] == true) { ?>
                <?php require_once('modules/dashboard/overview.php'); ?>
                <div class="row">
                    <div class="col-md-7">
                        <?php require_once('modules/dashboard/top_deposits.php'); ?>
                        <?php require_once('modules/dashboard/top_loans.php'); ?>
                    </div>
                    <div class="col-md-5">
                        <?php require_once('modules/dashboard/recent_transactions.php'); ?>
                    </div>
                </div>
            <?php } else if (isset($_SESSION['institution_staff']) AND $_SESSION['institution_staff'] == true) { ?>
                <?php require_once('modules/dashboard/overview.php'); ?>
                <div class="row">
                    <?php require_once('modules/dashboard/recent_transactions_institution_staff.php'); ?>
                </div>
            <?php } else if ($_SESSION['logged_in_user_type_details']['name'] == "ACCOUNT HOLDER") { ?>
                <?php require_once('modules/dashboard/account_overview.php'); ?>
                <div class="row">
                    <?php require_once('modules/dashboard/recent_transactions_account_holder.php'); ?>
                    <?php require_once('modules/dashboard/loan_calculator.php'); ?>
                </div>
            <?php } else if ($_SESSION['logged_in_user_type_details']['name'] == "INVESTOR") { ?>
                <div class="row">
                    <?php require_once('modules/dashboard/top_projects.php'); ?>
                    <?php require_once('modules/dashboard/recent_investments.php'); ?>
                </div>
            <?php } else if ($_SESSION['logged_in_user_type_details']['name'] == "GUEST") { ?>
                <div class="row">
                    <?php require_once('modules/dashboard/top_projects.php'); ?>
                    <?php require_once('modules/dashboard/loan_calculator.php'); ?>
                </div>
            <?php } ?>
        </section>
    </aside>
</div>