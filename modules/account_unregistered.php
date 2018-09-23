<?php
require_once WPATH . "modules/classes/Notifications.php";
$notifications = new Notifications();

if (App::isLoggedIn()) {
    $user_type_details = $users->fetchUserTypeDetails($_SESSION['login_user_type']);
    if ($user_type_details['name'] == "GUEST") {
        $user_details = $users->fetchGuestUserDetails($_SESSION['userid']);
        $profile_link = "?view_guest_users_individual&code=" . $_SESSION['userid'];
    }
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_settings.php'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <?php
                            if (is_menu_set('guest_loans') != "") {
                                $ending = "view your loans";
                            } else if (is_menu_set('guest_deposits') != "") {
                                $ending = "view your deposits";
                            } else if (is_menu_set('guest_shares') != "") {
                                $ending = "view your shares";
                            } else if (is_menu_set('guest_withdrawals') != "") {
                                $ending = "view your withdrawals";
                            } else if (is_menu_set('guest_account_to_account_transfers') != "") {
                                $ending = "view your account-to-account transfers";
                            } else if (is_menu_set('guest_transactions') != "") {
                                $ending = "view your transactions";
                            } else if (is_menu_set('guest_projects') != "") {
                                $ending = "view your projects";
                            } else if (is_menu_set('guest_contacts') != "") {
                                $ending = "view your contacts";
                            } else if (is_menu_set('guest_next_of_kins') != "") {
                                $ending = "view your next-of-kins";
                            }
                            ?>
                            Guest User
                        </header>
                        <div class="panel-body">
                            Hello <?php echo ucwords(strtolower($user_details['firstname'])); ?>,
                            <p></p>
                            <br /> Your membership account has not yet been updated. Please contact our team on the below details to <?php echo $ending; ?>.
                            <p></p>
                            <p>
                                <?php
                                echo "Phone : " . $_SESSION['institution_phone'];
                                echo "<br />";
                                echo "Email : " . $_SESSION['institution_email'];
                                ?>
                            </p>
                        </div>
                    </section>
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>
