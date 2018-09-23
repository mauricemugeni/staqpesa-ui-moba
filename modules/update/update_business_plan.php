<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$users = new Users();
$_SESSION['user_type'] = $_GET['user_type'];

if (!empty($_POST)) {

    $createdby = $_POST['createdby'];
    $biz_plan = md5("biz_plan" . $createdby . time());
    $biz_plan_name = $_FILES['business_plan']['name'];
    $tmp_name_biz_plan = $_FILES['business_plan']['tmp_name'];
    $extension_biz_plan = substr($biz_plan_name, strpos($biz_plan_name, '.') + 1);
    $business_plan = strtoupper($biz_plan . '.' . $extension_biz_plan);
    $_SESSION['business_plan'] = $business_plan;
    $location = 'modules/images/projects/business_plans/';

    if (move_uploaded_file($tmp_name_biz_plan, $location . $business_plan)) {
        $success = $users->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Record successfully updated";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Error updating record";
        }
        App::redirectTo("?view_projects");
    }
}
?>


<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_funding.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Update Profile Picture
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="update_business_plan"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>" />
                                <div class="form-group">
                                    <label for="business_plan">Business Plan Document</label>
                                    <input type="file" name="business_plan" class="form-control" id="business_plan"/>
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

