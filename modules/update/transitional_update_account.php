<?php
if (!App::isLoggedIn()) App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Transactions.php";
require_once WPATH . "modules/classes/Transitional.php";
$transitional = new Transitional();
$settings = new Settings();
$users = new Users();
$code = $_SESSION['account'];
$update_type = $_GET['update_type'];
$details = $users->fetchAccountDetails($code);

 if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $transitional->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?transitional_view_accounts");
    }
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
             <?php // require_once('modules/menus/sub_menu_account.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Update Account(Transitional)
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="transitional_edit_account"/>
                                <input type="hidden" name="transaction_type" value="MEMBERSHIP APPLICATION">
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid'];  ?>">
                                <div class="form-group">
                                    <label for="account_number">Account Number</label>
                                    <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Account Number" value="<?php echo $details['account_number']; ?>" readonly="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="account_name">Account Name</label>
                                    <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Name" value="<?php echo $details['account_name']; ?>" readonly="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="old_account_number">Previous Account Number</label>
                                    <input type="text" class="form-control" id="old_account_number" name="old_account_number" placeholder="Enter Previous Account Number" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="service_charge">Account Opening/Application Fees <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="service_charge" name="service_charge" placeholder="Enter Amount" required="true"/>
                                </div>
                                <div class="form-group">
                                    <label for="date-group">Account Opening Date</label>
                                    <div class="row" id="date-group">
                                        <div class="col-lg-3">
                                            <select id="day" name="day" class="form-control">          
                                                <?php include 'modules/snippets/day.php'; ?>
                                            </select> 
                                        </div>
                                        <div class="col-lg-6">
                                            <select id="month" name="month" class="form-control">          
                                                <?php include 'modules/snippets/month.php'; ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <select id="year" name="year" class="form-control">  
                                                <?php include 'modules/snippets/year.php'; ?>
                                            </select>
                                        </div>
                                    </div>
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
