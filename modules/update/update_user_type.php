<?php
if (!App::isLoggedIn()) App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$code = $_SESSION['user_type'];
$update_type = $_GET['update_type'];
$details = $users->fetchUserTypeDetails($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $users->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_user_types");
    }
} else {
    $success = $users->updateUserType($code, $update_type);
//    if (is_bool($success) && $success == true) {
//        $_SESSION['update_success'] = "Record successfully updated";
//    } else if (is_bool($success) && $success == false) {
//        $_SESSION['update_error'] = "Error updating record";
//    }
//    App::redirectTo("?view_user_types");
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
<?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_settings.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Update User Type Details
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_user_type"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>">
                                <div class="form-group">
                                    <label for="name">Type Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Type Name" value="<?php echo $details['name']; ?>" required="yes"/>
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
