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
    $sign = md5("signature" . $createdby . time());
    $signature_name = $_FILES['signature']['name'];
    $tmp_name_sign = $_FILES['signature']['tmp_name'];
    $extension_sign = substr($signature_name, strpos($signature_name, '.') + 1);
    $signature = $sign . '.' . $extension_sign;
    $_SESSION['signature'] = $signature;

    if ($_SESSION['user_type'] == "account_holder") {
        $location = 'modules/images/customers/signatures/';
    }

    if (move_uploaded_file($tmp_name_sign, $location . $signature)) {
        $success = $users->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Record successfully updated";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Error updating record";
        }

        if ($_SESSION['user_type'] == "account_holder") {
            App::redirectTo("?view_account_holders");
        }
    }
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
<?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_contacts.php'); ?>
            <?php require_once('modules/menus/sub_menu_account.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Update Signature
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST" enctype="multipart/form-data"> 
                                <input type="hidden" name="action" value="update_signature"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>" />
                                <div class="form-group">
                                    <label for="signature">Signature File</label>
                                    <input type="file" name="signature" class="form-control"/>
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
