<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/System_Administration.php";
$system_administration = new System_Administration();
if (!empty($_POST)) {
    $success = $system_administration->execute();    
    if ($success['status'] == 200) {
        $_SESSION['add_success'] = true;
        $_SESSION['feedback_message'] = "<strong>Successful:</strong> The system privilege has been created successfully.";
        App::redirectTo("?view_system_privileges");
    } else {
        $_SESSION['add_fail'] = true;
        $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error creating the system privilege. Please try again.";
    }
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
                            Add System Privilege
                            <?php
                            if (isset($_SESSION['add_fail'])) {
                                echo $_SESSION['add_record_fail'];
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['add_fail']);
                            }
                            ?>
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="add_system_privilege"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <div class="form-group">
                                    <label for="name">Privilege Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="eg. Can add staff" required="yes"/>
                                </div>
                                <div class="form-group" class="form-control">
                                    <label for="component">Related Component</label>
                                    <select name="component" class="form-control"> 
                                        <?php echo $system_administration->getSystemComponents(); ?> 
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info">Submit</button>
                            </form>                           

                        </div>
                    </section>
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>
