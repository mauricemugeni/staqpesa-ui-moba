<?php
require_once WPATH . "modules/classes/Users.php";
$users = new Users();

if (!empty($_POST)) {
    $success = $users->execute();
    if (is_bool($success) && $success == true) {
        $_SESSION['update_pass_forgot'] = true;
    } else {
        $_SESSION['update_pass_forgot'] = false;
    }
    App::redirectTo("?forgot_password_next");
}
?>
<div class="background-image"></div>

<div class="column_right_grid sign-in" id="login">
    <div class="sign_in">
        <?php
        if (isset($_SESSION['update_pass_forgot']) AND $_SESSION['update_pass_forgot'] == true) {
            include 'modules/notification/notify.php';
            unset($_SESSION['update_pass_forgot']);
        } else if (isset($_SESSION['update_pass_forgot']) AND $_SESSION['update_pass_forgot'] == false) {
            include 'modules/notification/notify-false.php';
            unset($_SESSION['update_pass_forgot']);
        }
        ?>
        <div class="profile_picture">
            <a href="#"><img class="login" src="web/images/staqpesa.png" alt="Logo" />	</a>
        </div>
        <h3>StaqPesa | <b>Recovery</b></h3>

        <h4>Forgot your password? Fill your details below:</h4>                    
        <form method="POST">
            <input type="hidden" name="action" value="forgot_password"/>
            <span>
                <i><img src="web/images/iconset/fname.png" alt="" /></i>
                <input type="text" name="firstname" placeholder="First Name" required="yes"/>
            </span>
            <span>
                <i><img src="web/images/iconset/mname.png" alt="" /></i>
                <input type="text" name="lastname" placeholder="Last Name" required="yes"/>
            </span>
            <span>
                <i><img src="web/images/iconset/mail.png" alt="" /></i>
                <input type="email" name="email" placeholder="Email Address" required="yes"/>
            </span>
            <input type="submit" class="my_button" value="Reset Password">
        </form>
        <h4><a href="?login">Just Login!</a></h4>
    </div>
</div>