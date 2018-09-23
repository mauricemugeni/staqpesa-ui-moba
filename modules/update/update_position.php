<?php
if (!App::isLoggedIn()) App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$code = $_SESSION['position'];
$update_type = $_GET['update_type'];
$details = $users->fetchPositionDetails($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $users->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_positions");
    }
} else {
    $success = $users->updatePosition($code, $update_type);
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = "Record successfully updated";
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_error'] = "Error updating record";
    }
    App::redirectTo("?view_positions");
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
<?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_staff.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Update Position Details
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_position"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>">
                                <div class="form-group">
                                    <label for="name">Position Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Position Name" value="<?php echo $details['name']; ?>" required="yes"/>
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
