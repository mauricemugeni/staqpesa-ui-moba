<?php
if (!App::isLoggedIn()) App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$users = new Users();
$_SESSION['user_type'] = $_GET['user_type'];

if (!empty($_POST)) {
    $createdby = $_POST['createdby'];
    $photo = md5("photo" . $createdby . time());
    $profpicture_name = $_FILES['profpicture']['name'];
    $tmp_name_photo = $_FILES['profpicture']['tmp_name'];
    $extension_photo = substr($profpicture_name, strpos($profpicture_name, '.') + 1);
    $profpicture = strtoupper($photo . '.' . $extension_photo);
    $_SESSION['profpicture'] = $profpicture;
    
    if ($_SESSION['user_type'] == "account_holder") {
            $location = 'modules/images/customers/photos/';
        } else if ($_SESSION['user_type'] == "staff") {
            $location = 'modules/images/staff/';
        }
    

    if (move_uploaded_file($tmp_name_photo, $location . $profpicture)) {
        $success = $users->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Record successfully updated";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Error updating record";
        }
        
        if ($_SESSION['user_type'] == "account_holder") {
            App::redirectTo("?view_account_holders");
        } else if ($_SESSION['user_type'] == "staff") {
            App::redirectTo("?view_staff");
        }
    }
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_system_users.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Update Profile Picture
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="update_profpicture"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>" />
                                <div class="form-group">
                                    <label for="profpicture">Profile Photo File</label>
                                    <input type="file" name="profpicture" class="form-control" id="profpicture"/>
                                </div>

                                    <button type="submit" class="btn btn-info">Update</button>
                            </form>

                        </div>
                    </section>
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>
