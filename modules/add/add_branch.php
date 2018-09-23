<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
if (!empty($_POST)) {
    $success = $settings->execute();       
    if ($success['status'] == 200) {
        $_SESSION['add_success'] = true;
        $_SESSION['feedback_message'] = "<strong>Successful:</strong> The branch has been created successfully.";
        App::redirectTo("?view_branches");
    } else {
        $_SESSION['add_fail'] = true;
        $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error creating the branch. Please try again.";
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
                            Add Branch
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
                                <input type="hidden" name="action" value="add_branch"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <div class="form-group">
                                    <label for="name">Branch Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="eg. Kigali" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="name">Branch ID</label>
                                    <input type="text" class="form-control" id="branch_code" name="branch_code" placeholder="eg. 1001" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="name">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" placeholder="eg. Kigali" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="name">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="eg. kigali@gmail.com" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="name">Telephone Number</label>
                                    <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="+256XXXXXXXXX" required="yes"/>
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