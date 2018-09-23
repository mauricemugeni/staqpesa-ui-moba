<?php
if (!App::isLoggedIn()) {
    App::redirectTo("?");
}
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/System_Administration.php";
$system_administration = new System_Administration();
$users = new Users();
$code = $_SESSION['role'];
$details = $users->fetchRoleDetails($code);

if (!empty($_POST)) {
    $success = $system_administration->execute();
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
            <?php //require_once('modules/menus/sub_menu_settings.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Privilege to Role
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="add_privilege_to_role"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>

                                <div class="form-group">
                                    <label>Role</label>
                                    <input type="text" class="form-control" id="role" name="role" placeholder="Role Name" value="<?php echo $details['name']; ?>" readonly="yes"/>
                                </div>
                                <div class="form-group">
                                    <label>Select Privilege</label>
                                    <select class="form-control" name="privilege"> 
                                        <?php echo $system_administration->getSystemPrivileges(); ?> 
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-theme">Submit</button>
                            </form>
                        </div>
                    </section>
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>