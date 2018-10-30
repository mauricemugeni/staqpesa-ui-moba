<?php
if (!App::isLoggedIn()) {
    App::redirectTo("?");
}
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/System_Administration.php";
$system_administration = new System_Administration();
$users = new Users();
$code = $_SESSION['user_type'];
$details = $users->fetchUserTypeDetails($code);

if (!empty($_POST)) {
    $success = $users->execute();
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = true;
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_fail'] = true;
    }
    App::redirectTo("?view_role_privileges");
}
?>


<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_settings.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Update User Type Privilege
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_user_type_privilege"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['createdby']; ?>"/>
                                <div class="form-group">
                                    <label for="name">Component Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $_SESSION['name']; ?>" placeholder="Component Name" required="yes"/>
                                </div>
                                <div class="form-group" class="form-control">
                                    <label for="component">Component</label>
                                    <select name="component" class="form-control"> 
                                        <?php echo $system_administration->getAllComponents(); ?> 
                                    </select>
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
