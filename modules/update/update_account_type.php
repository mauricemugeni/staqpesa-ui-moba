<?php
if (!App::isLoggedIn()) App::redirectTo("?");
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$code = $_SESSION['account_type'];
$update_type = $_GET['update_type'];
$details = $settings->fetchAccountTypeDetails($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $settings->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_account_types");
    }
} else {
    $success = $settings->updateAccountType($code, $update_type);
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = "Record successfully updated";
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_error'] = "Error updating record";
    }
    App::redirectTo("?view_account_types");
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
                            Update Account Type
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_account_type"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>">
                                <div class="form-group">
                                    <label for="name">Account Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Account Name" value="<?php echo $details['name']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="opening_balance">Opening Balance <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="opening_balance" name="opening_balance" placeholder="Opening Balance" value="<?php echo $details['opening_balance']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="minimum_balance">Minimum Balance <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="minimum_balance" name="minimum_balance" placeholder="Minimum Balance" value="<?php echo $details['minimum_balance']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="minimum_deposit">Minimum Deposit <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="minimum_deposit" name="minimum_deposit" placeholder="Minimum Deposit" value="<?php echo $details['minimum_deposit']; ?>" required="yes"/>
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
