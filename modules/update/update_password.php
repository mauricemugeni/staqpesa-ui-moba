<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$user_id = $_SESSION['userid'];
$details = $users->fetchStaffDetails($user_id);

if (!empty($_POST)) {
    $success = $users->execute();
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = true;
        App::redirectTo("?view_accounts");
//App::redirectTo("?view_staff_individual&code=" . $details['id']);
    } else {
        $_SESSION['update_success'] = false;
    }
}
?>
<div class="background-image"></div>

<div class="column_right_grid sign-in" id="login">
    <div class="sign_in">
        <div class="profile_picture">
            <a href="#"><img class="login" src="web/images/staqpesa.png" alt="Logo" />	</a>
        </div>
        <h3>StaqPesa | <b>New Password</b></h3>

        <?php if (isset($_SESSION['update_success']) AND $_SESSION['update_success'] == false) { ?>
            <div class="alert alert-error">
                <h4>Error:</h4>
                <p>Wrong passwords combination</p>
            </div>
            <?php
            unset($_SESSION['update_success']);
        }
        ?>

        <form method="POST">
            <input type="hidden" name="action" value="update_password"/>
            <input type="hidden" name="userid" value="<?php echo $user_id; ?>"/>

            <span>
                <i><img src="web/images/iconset/number.png" alt="" /></i>
                <input type="password" name="current_password" placeholder="Current Password" required="yes"/>
            </span>

            <span>
                <i><img src="web/images/iconset/number.png" alt="" /></i>
                <input type="password" name="new_password" placeholder="New Password" required="yes"/>
            </span>

            <span>
                <i><img src="web/images/iconset/form.png" alt="" /></i>
                <input type="password" name="confirm_password" placeholder="Confirm New Password" required="yes"/>
            </span>

            <input type="submit" class="my_button" value="Update">
        </form>
        <h4><a href="?login">Just Login!</a></h4>

        <!--            
                    <p style="margin-top: 40px;">Powered by: <a href="http://reflexconcepts.co.ke" target="_blank">
                            <img style="vertical-align: -8px;" src="web/images/reflex_logo.png" width="70"></a></p>-->

    </div>
    <!-- <div class="signin_facebook">
         <p><a href="#">  <i> <img src="web/images/facebook.png" alt="" /></i>Sign in with facebook</a></p>
     </div>-->
</div>
