<?php
require_once WPATH . "modules/classes/Notifications.php";
$notifications = new Notifications();
$phone_number = "+254 710 534 013";
$email = "info@ictsacco.co.ug";

//if (App::isLoggedIn()) {
//    $user_type_details = $users->fetchUserTypeDetails($_SESSION['login_user_type']);
//    if ($user_type_details['name'] == "GUEST") {
//        $user_details = $users->fetchGuestUserDetails($_SESSION['userid']);
//        $profile_link = "?view_guest_users_individual&code=" . $_SESSION['userid'];
//    }
//}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>    
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            Hello <?php echo ucwords(strtolower($_SESSION['user_details']['firstname'])); ?>,
            <p></p>
            Select your preferred payment platform.    
            <p></p>
            <div class="row" style="margin-bottom:0px;">
                <div class="col-lg-6">
                    <div class="col-md-3">
                        <a href = '#'><img src = "modules/images/banking/airtel1.jpg" ></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="col-md-3">
                        <a href = '#'><img src = "modules/images/banking/mtn1.jpg" ></a>
                    </div>
                </div>
            </div> 
            <p></p>
            <div class="row" style="margin-bottom:0px;">
                <div class="col-lg-6">
                    <div class="col-md-3">
                        <a href = '#'><img src = "modules/images/banking/paypal1.jpg" ></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="col-md-3">
                        <a href = '#'><img src = "modules/images/banking/mastercard1.jpg" ></a>
                    </div>
                </div>
            </div>
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>
