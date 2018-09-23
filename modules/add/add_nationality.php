<?php
if (!App::isLoggedIn()) App::redirectTo("?");
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
if (!empty($_POST)) {
    $success = $settings->execute();
    if ($success['status'] == 200) {
        $_SESSION['add_success'] = true;
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
                            Add Nationality
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="add_branch"/>
                                <input type="hidden" name="createdby" value="<?php  echo $_SESSION['userid'];     ?>"/>
                                <div class="form-group">
                                    <input type="hidden" name="action" value="add_nationality"/>
                                    <input type="hidden" name="createdby" value="<?php //echo $_SESSION['userid'];   ?>"/>

                                    <div class="form-group">
                                        <label for="principal_amount">Nationality</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nationality" required="yes"/>
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