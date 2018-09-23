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
}
?>

<div class="background-image"></div>

<div class="templatemo-content-widget templatemo-login-widget white-bg">
    <header class="text-center">
        <h1><a href="http://ictinnovators.co.ug" title="ICT Innovators, UG | Main Site" class="logo"><img style="margin-bottom: 30px;" src="img/branding/logo_ic.svg" width="160"></a></h1>
        <h4>PASSWORD | <b>RECOVERY</h4>
    </header>

    <?php
    if (isset($_SESSION['update_pass_forgot']) AND ( $_SESSION['update_pass_forgot'] == false)) {
        ?>
        <div class="alert alert-error">
            <h4>Error:</h4>
            <p>Sorry, there was an error updating your password. Please confirm your email address and try the update process again.</p>
        </div>
        <?php
        unset($_SESSION['update_pass_forgot']);
    } else if (isset($_SESSION['update_pass_forgot']) AND ( $_SESSION['update_pass_forgot'] == true)) {
        ?>
        <div class="alert alert-success">
            <h4>Check your email:</h4>
            <p> We've sent you an email. Click the link in the email to reset your password.</p>
            <p>If you don't see the email, check other places it might be, like your junk, spam, social or other folders. </p>
        </div>
        <?php
        unset($_SESSION['update_pass_forgot']);
    }
    ?>     

    <form class="templatemo-login-form" method="POST">
        <input type="hidden" name="action" value="forgot_password"/>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
                <input  type="email" name="email" class="form-control" placeholder="Email Address" required="true">        
            </div>	
        </div>
        <div class="form-group">
            <button type="submit" class="templatemo-blue-button width-100">Reset Password</button>
        </div>
    </form>
</div>
<div class="templatemo-content-widget templatemo-login-widget templatemo-register-widget white-bg">
    <p>You remember your password: <strong><a href="?login" class="blue-text">Just Login</a></strong></p>
</div>  

