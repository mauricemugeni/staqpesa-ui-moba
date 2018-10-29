<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$code = $_SESSION['branch'];
$update_type = $_GET['update_type'];
$details = $settings->fetchBranchDetails($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $settings->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_branches");
    }
} else {
    $success = $settings->updateBranch($code, $update_type);
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = "Record successfully updated";
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_error'] = "Error updating record";
    }
    App::redirectTo("?view_branches");
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
                            Update Branch
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="add_branch"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <div class="form-group">
                                    <label for="name">Branch Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Branch Name" value="<?php echo $details['name']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="name">Branch ID</label>
                                    <input type="text" class="form-control" id="branch_code" name="branch_code" placeholder="Branch ID" value="<?php echo $details['code']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="name">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="<?php echo $details['location']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="name">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address"  value="<?php echo $details['email']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="name">Telephone Number</label>
                                    <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="Telephone" value="<?php echo $details['phone_number']; ?>"  required="yes"/>
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
