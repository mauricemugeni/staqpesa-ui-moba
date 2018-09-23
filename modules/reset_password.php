<?php
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$id = $_GET['id'];

if (!empty($_POST)) {
    $success = $users->execute();
    if (is_bool($success) && $success == true) {
        $_SESSION['reset_password'] = true;
    } else {
        $_SESSION['reset_password'] = false;
    }
}
?>

<div class="background-image"></div>

<div class="templatemo-content-widget templatemo-login-widget white-bg">
    <header class="text-center">
        <h1><a href="http://ictinnovators.co.ug" title="ICT Innovators, UG | Main Site" class="logo"><img style="margin-bottom: 30px;" src="img/branding/logo_ic.svg" width="160"></a></h1>
        <h4><b>RESET | </b>PASSWORD</h4>
    </header>

    <?php
    if (isset($_SESSION['reset_password']) AND ( $_SESSION['reset_password'] == false)) {
        ?>
        <div class="alert alert-error">
            <h4>Error:</h4>
            <p>Sorry, there was an error updating your password. Please try again.</p>
        </div>
        <?php
        unset($_SESSION['reset_password']);
    } else if (isset($_SESSION['reset_password']) AND ( $_SESSION['reset_password'] == true)) {
        ?>
        <div class="alert alert-success">
            <h4>Success:</h4>
            <p>Your password has been updated successfully. </p>
        </div>
        <?php
        unset($_SESSION['reset_password']);
    }
    ?>     

    <form class="templatemo-login-form" method="POST">
        <input type="hidden" name="action" value="reset_password"/>
        <input type="hidden" name="user_id" value="<?php echo $id; ?>"/>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
                <input  type="password" name="new_password" class="form-control" placeholder="New Password" required="true">        
            </div>	
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
                <input  type="password" name="confirm_password" class="form-control" placeholder="Confirm New Password" required="true">        
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

