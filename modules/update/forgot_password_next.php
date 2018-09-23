<?php
require_once WPATH . "modules/classes/Users.php";
$users = new Users();

//if (!empty($_POST)) {
//    $success = $users->execute();
//    if (is_bool($success) && $success == true) {
//        $_SESSION['update_pass_forgot'] = true;
//    } else {
//        $_SESSION['update_pass_forgot'] = false;
//    }
//}
?>
<div class="background-image"></div>

<div class="column_right_grid sign-in" id="login">
    <div class="sign_in">       
        <div class="profile_picture">
            <a href="#"><img class="login" src="web/images/staqpesa.png" alt="Logo" />	</a>
        </div>
        <h3>StaqPesa | <b>Recovery</b></h3>
        <?php         
         if (isset($_SESSION['account_blocked']) AND $_SESSION['account_blocked'] == true) {
            ?>  

            <h4>Sorry, your account has been blocked. Kindly contact your system administrator. </h4>

            <?php
            unset($_SESSION['account_blocked']);
        }
        
        if (isset($_SESSION['update_pass_forgot']) AND $_SESSION['update_pass_forgot'] == true) { ?>    

            <h4>Password successfully reset. Check your email for the new credentials. </h4>

            <?php
            unset($_SESSION['update_pass_forgot']);
        } else if (isset($_SESSION['update_pass_forgot']) AND $_SESSION['update_pass_forgot'] == false) {
            ?>  

            <h4>There is no such user. </h4>

            <?php
            unset($_SESSION['update_pass_forgot']);
        }
        ?>

        <h4><a href="?login">Now Login!</a></h4>
    </div>
</div>
