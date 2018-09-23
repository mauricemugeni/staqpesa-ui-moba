<?php
if (!App::isLoggedIn()) App::redirectTo("?");
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$code = $_SESSION['loan_processing_fee'];
$update_type = $_GET['update_type'];
$details = $settings->fetchIndividualLoanProcessingFeeDetails($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $settings->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_loan_processing_fees");
    }
} else {
    $success = $settings->updateLoanProcessingFees($code, $update_type);
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = "Record successfully updated";
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_error'] = "Error updating record";
    }
    App::redirectTo("?view_loan_processing_fees");
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
                            Update Loan Processing Fee
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_loan_processing_fees"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>">
                                <div class="form-group">
                                <label for="start">Start/Lower Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                <input type="number" class="form-control" id="start" name="start" placeholder="Start/Lower Amount" value="<?php echo $details['start']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                <label for="end">End/Upper Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                <input type="number" class="form-control" id="end" name="end" placeholder="End/Upper Amount" value="<?php echo $details['end']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                <label for="amount_type">Amount Type</label>
                                <select name="amount_type" class="form-control">
                                        <option value="<?php echo '(' . $_SESSION['currency'] . ')'; ?>">CURRENCY(<?php echo '(' . $_SESSION['currency'] . ')'; ?>)</option>
                                        <option value="PERCENT">PERCENTAGE</option>
                                    </select> 
                                </div>
                                <div class="form-group">
                                <label for="amount">Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount" value="<?php echo $details['amount']; ?>" required="yes"/>
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
