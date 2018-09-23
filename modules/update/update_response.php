<?php
if (!App::isLoggedIn()) App::redirectTo("?");
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$code = $_SESSION['response'];
$update_type = $_GET['update_type'];
$details = $settings->fetchResponseDetails($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $settings->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_responses");
    }
} else {
    $success = $settings->updateResponse($code, $update_type);
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = "Record successfully updated";
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_error'] = "Error updating record";
    }
    App::redirectTo("?view_responses");
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
                            Update Response Details
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_response"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>">
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea type="text" class="form-control" id="message" name="message" placeholder="Message" value="<?php echo $details['message']; ?>" required="yes"></textarea>
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
