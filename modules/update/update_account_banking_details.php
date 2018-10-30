<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$code = $_SESSION['account_banking_detail'];
$update_type = $_GET['update_type'];
$details = $users->fetchAccountBankingDtlDetails($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $users->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_account_banking_details_individual&code={$code}");
//        App::redirectTo("?view_next_of_kins");
    }
} else {
    $success = $users->updateAccountBankingDetail($code, $update_type);
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = "Record successfully updated";
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_error'] = "Error updating record";
    }
    App::redirectTo("?view_account_banking_details_individual&code={$code}");
//    App::redirectTo("?view_next_of_kins");
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_system_users.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Update Account Banking Details
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_account_banking_details"/>
                                <input type="hidden" name="code" value="<?php echo $code; ?>">
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <div class="form-group">
                                    <label for="mobile_service_provider">Mobile network service provider</label>
                                    <select name="mobile_service_provider" class="form-control">   
                                        <?php if ($details['mobile_service_provider'] == 'SAFARICOM') { ?>
                                            <option value="SAFARICOM" selected="true">Safaricom</option>
                                        <?php } else { ?>
                                            <option value="SAFARICOM">Safaricom</option>
                                        <?php } ?>
                                        <?php if ($details['mobile_service_provider'] == 'AIRTEL') { ?>
                                            <option value="AIRTEL" selected="true">Airtel</option>
                                        <?php } else { ?>
                                            <option value="AIRTEL">Airtel</option> 
                                        <?php } ?>
                                        <?php if ($details['mobile_service_provider'] == 'ORANGE') { ?>
                                            <option value="ORANGE" selected="true">Orange</option>
                                        <?php } else { ?>
                                            <option value="ORANGE">Orange</option>  
                                        <?php } ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="mobile_number">Mobile Number</label>
                                    <input type="tel" class="form-control" id="mobile_number" name="mobile_number" placeholder="eg. +2567XXXXXXXX" value="<?php echo $details['mobile_number']; ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="bank_account_number">Account Number</label>
                                    <input type="text" class="form-control" name="bank_account_number" placeholder="eg. ABCD1234EFG567/2017" value="<?php echo $details['bank_account_number']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="bank_name">Bank Name</label>
                                    <input type="text" class="form-control" name="bank_name" placeholder="eg Barclays Bank" value="<?php echo $details['bank_name']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="bank_code">Bank Code</label>
                                    <input type="text" class="form-control" name="bank_code" placeholder="eg. ABCDE" value="<?php echo $details['bank_code']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="bank_branch_name">Branch Name</label>
                                    <input type="text" class="form-control" name="bank_branch_name" placeholder="eg. Nairobi" value="<?php echo $details['bank_branch_name']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="bank_branch_code">Branch Code</label>
                                    <input type="text" class="form-control" name="bank_branch_code" placeholder="eg. FGHIJ" value="<?php echo $details['bank_branch_code']; ?>" />
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
