<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Transactions.php";
$transactions = new Transactions();
$settings = new Settings();
$users = new Users();
$code = $_SESSION['account'];
$update_type = $_GET['update_type'];
$details = $users->fetchAccountDetails($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $users->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_accounts_individual");
    }
} else {
    $success = $users->updateAccount($code, $update_type);
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = "Record successfully updated";
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_error'] = "Error updating record";
    }
    App::redirectTo("?view_accounts_individual");
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
                            Update Account
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_account"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>">
 
                                <div class="form-group">
                                    <label for="account_name">Account Name</label>
                                    <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Name" value="<?php echo $details['account_name']; ?>" required="yes"/>
                                </div>  
                                <div class="form-group">
                                    <label for="account_type">Account Type</label>
                                    <select name="account_type" class="form-control">          
                                        <?php echo $settings->getAccountTypes(); ?>
                                    </select> 
                                </div>                                
                                <?php if (isset($_SESSION['staqpesa_admin']) OR isset($_SESSION['staqpesa_staff'])) { ?>                                
                                    <div class="form-group">
                                        <label for="branch">Branch</label>
                                        <select name="branch" class="form-control">          
                                            <?php echo $settings->getBranches(); ?>
                                        </select> 
                                    </div>                                
                                <?php } else if (isset($_SESSION['institution_admin']) OR isset($_SESSION['institution_staff'])) { ?>
                                    <div class="form-group">
                                        <label for="branch">Branch</label>
                                        <select name="branch" class="form-control">          
                                            <?php echo $settings->getInstitutionBranches($_SESSION['user_details']['institution']); ?>
                                        </select> 
                                    </div>                                
                                <?php } ?> 
                                <div class="form-group">
                                    <label for="contribution_amount">Monthly contribution amount(<?php echo $_SESSION['currency']; ?>):</label>
                                    <input type="number" class="form-control" id="contribution_amount" name="contribution_amount" placeholder="eg. 1000" value="<?php echo $details['contribution_amount']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="date-group">Contribution Effective Date</label>
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
                                <div class="form-group">
                                    <label for="remittance_mode">Proposed mode of remittance</label>
                                    <select name="remittance_mode" class="form-control" required="yes">                                        
                                        <?php if ($details['remittance_mode'] == 'MOBILE MONEY') { ?>
                                            <option value="MOBILE MONEY" selected="true">Mobile Money</option>
                                        <?php } else { ?>
                                            <option value="MOBILE MONEY">Mobile Money</option>
                                        <?php } ?>

                                        <?php if ($details['remittance_mode'] == 'CHECK-OFF') { ?>
                                            <option value="CHECK-OFF" selected="true">Check-off</option>
                                        <?php } else { ?>
                                            <option value="CHECK-OFF">Check-off</option>
                                        <?php } ?>

                                        <?php if ($details['remittance_mode'] == 'STANDING ORDER') { ?>
                                            <option value="STANDING ORDER" selected="true">Standing Order</option>
                                        <?php } else { ?>
                                            <option value="STANDING ORDER">Standing Order</option>
                                        <?php } ?>

                                        <?php if ($details['remittance_mode'] == 'DIRECT DEBIT') { ?>
                                            <option value="DIRECT DEBIT" selected="true">Direct Debit</option>
                                        <?php } else { ?>
                                            <option value="DIRECT DEBIT">Direct Debit</option>
                                        <?php } ?>

                                        <!--                                        <option value="">Select Remittance Mode</option>
                                                                                <option value="MOBILE MONEY">Mobile Money</option>
                                                                                <option value="CHECK-OFF">Check-off</option> 
                                                                                <option value="STANDING ORDER">Standing Order</option>           
                                                                                <option value="DIRECT DEBIT">Direct Debit</option>         -->

                                    </select> 
                                </div> 

                                <div class="form-group">
                                    <label for="referee">Referee</label>
                                    <input type="text" class="form-control" id="referee" name="referee" placeholder="Member's A/C No. eg. MOBS00056" value="<?php echo $details['referee']; ?>" required="yes"/>
                                </div>                                
                                <div class="form-group">
                                    <label for="recruited_by">Recruited By</label>
                                    <input type="text" class="form-control" id="recruited_by" name="recruited_by" placeholder="Staff P/F No. eg. STAFF0003" value="<?php echo $details['recruited_by']; ?>" required="yes"/>
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
