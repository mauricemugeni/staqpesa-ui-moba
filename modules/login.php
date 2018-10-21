<?php
$configs = parse_ini_file(WPATH . "core/configs.ini");

require_once WPATH . "modules/classes/Users.php";
$users = new Users();

$_SESSION['host_name'] = $configs["host_name"];
$_SESSION['db_name'] = $configs["db_name"];
$_SESSION['db_user'] = $configs["db_user"];
$_SESSION['db_password'] = $configs["db_password"];
$_SESSION['api_url'] = $configs["api_url"];
$_SESSION['website_url'] = $configs["website_url"];
$_SESSION['admin_url'] = $configs["admin_url"];
$_SESSION['facebook_page'] = $configs["facebook_page"];
$_SESSION['twitter_handle'] = $configs["twitter_handle"];
$_SESSION['application_email'] = $configs["application_email"];
$_SESSION['application_phone'] = $configs["application_phone"];
$_SESSION['institution_code'] = $configs["institution_code"];
$_SESSION['institution_name'] = $configs["institution_name"];
$_SESSION['institution_email'] = $configs["institution_email"];
$_SESSION['institution_phone'] = $configs["institution_phone"];
$_SESSION['institution_paybill_number'] = $configs["institution_paybill_number"];
$_SESSION['reflex_paybill_number'] = $configs["reflex_paybill_number"];
$_SESSION['solo_chapter_code'] = $configs["solo_chapter_code"];

if (!isset($_SESSION['chapter_details'])) {
    if (isset($_SESSION['chapter_code'])) {
        $_SESSION['chapter_details'] = $users->fetchChapterDetails($_SESSION['chapter_code']);
    } 
    
//    else if (isset($_GET['chapter_code'])) {
//        $_SESSION['chapter_code'] = $_GET['chapter_code'];
//        $_SESSION['chapter_details'] = $users->fetchChapterDetails($_SESSION['chapter_code']);
//    } 
    
    else {
        $_SESSION['chapter_code'] = $_SESSION['solo_chapter_code'];
        $_SESSION['chapter_details'] = $users->fetchSoloChapterDetails($_SESSION['institution_code'], $_SESSION['solo_chapter_code']);
    }
}

if (!empty($_POST)) {
    $success = $users->execute();
    if (is_bool($success) && $success == true) {
        $user_details = $users->fetchLoggedInUserDetails($_SESSION['login_user_type'], $_SESSION['userid']);
        if ($user_details['status'] == 1) {
            $_SESSION['account_blocked'] = true;
        }
        if ($user_details['password_new'] == 0) {
            App::redirectTo("?update_password");
        }
        App::redirectTo("?dashboard");
    }
}
?>

<div class="background-image"></div>


<div class="templatemo-content-widget templatemo-login-widget white-bg">
    <header class="text-center">
        <h1><a href="<?php echo $_SESSION['website_url']; ?>" title="MOBA Sacco" class="logo">
                <img style="margin-top: 30px;" src="img/branding/chapter_logos/<?php echo $_SESSION['chapter_code'] . '.svg'; ?>" width="160">
            </a></h1>
        <h5>Realize Your Dreams</h5>
    </header>

    <?php if (isset($_SESSION['login_error'])) { ?>
        <div class="alert alert-error">
            <h4>Login Error:</h4>
            <p>Wrong username/password combination</p>
        </div>
        <?php
        unset($_SESSION['login_error']);
    }
    if (isset($_SESSION['account_blocked'])) {
        ?>
        <div class="alert alert-error">
            <h4>Login Error</h4>
            <p>Your Account Has been Deactivated please contact <a href="mailto:<?php echo $_SESSION['institution_email']; ?>"><?php echo $_SESSION['institution_email']; ?></a></p>
        </div>
        <?php
        unset($_SESSION['account_blocked']);
    }
    ?>     

    <form class="templatemo-login-form" method="POST">
        <input type="hidden" name="action" value="login">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
                <input type="text" class="form-control" placeholder="<?php echo $_SESSION['institution_email']; ?>" name="username" required/>           
            </div>	
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>	        		
                <input type="password" class="form-control" name="password" placeholder="***********" required/>           
            </div>	
        </div>	          	
        <div class="form-group">
            <div class="checkbox squaredTwo">
                <input type="checkbox" id="c1" name="cc" />
                <label for="c1"><span></span>Remember me</label>
            </div>				    
        </div>
        <div class="form-group">
            <button type="submit" class="templatemo-blue-button width-100">Login</button>
        </div>
    </form>
    <h5><a href="?forgot_password">Forgot Password?</a></h5>
</div>
<div class="templatemo-content-widget templatemo-login-widget templatemo-register-widget white-bg">
    <p>Not a registered user yet? <strong><a href="<?php echo $_SESSION['website_url']; ?>/?applying" class="blue-text">Sign up now!</a></strong></p>
</div>  


<!--            
            <p style="margin-top: 40px;">Powered by: <a href="http://reflexconcepts.co.ke" target="_blank">
                    <img style="vertical-align: -8px;" src="web/images/reflex_logo.png" width="70"></a></p>-->