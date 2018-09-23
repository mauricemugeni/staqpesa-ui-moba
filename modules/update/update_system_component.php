<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/System_Administration.php";
require_once WPATH . "modules/classes/Users.php";
$system_administration = new System_Administration();
$users = new Users();
$code = $_SESSION['system_component'];
$update_type = $_GET['update_type'];
$details = $system_administration->fetchSystemComponentDetails($code);
// $details = $system_administration->fetchSystemPrivilegeDetails($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $funding->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_system_components");
    }
} else {
    $success = $system_administration->updateSystemComponentDetails($code, $update_type);
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = "Record successfully updated";
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_error'] = "Error updating record";
    }
    App::redirectTo("?view_system_components");
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
                            Update System Component
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_system_component"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $details['name']; ?>" placeholder="Component Name" required="yes"/>
                                </div>
                                <div class="form-group" class="form-control">
                                    <label for="acronym">Acronym</label>
                                    <input type="text" class="form-control" id="acronym" name="acronym" value="<?php echo $details['acronym']; ?>" placeholder="Acronym" required="yes"/>
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
