<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Settings.php";
$loans = new Loans();
$settings = new Settings();
$code = $_SESSION['loan_business_data'];
$update_type = $_GET['update_type'];
if (isset($_SESSION['loan'])) {
    $code = $_SESSION['loan'];
} else if (isset($_SESSION['loan_business_data'])) {
    $code = $_SESSION['loan_business_data'];
}
$details = $loans->fetchLoanBusinessDataDetails($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $loans->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_loan_business_data");
    }
} else {
    $success = $loans->updateLoanBusinessData($code, $update_type);
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = "Record successfully updated";
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_error'] = "Error updating record";
    }
    App::redirectTo("?view_loan_business_data");
}
?>


<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_loans.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Update Loan Business Data Details
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_loan_business_data"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>">
                                <div class="form-group">
                                    <label for="eunique_credit">? Credit</label>
                                    <input type="number" class="form-control" id="eunique_credit" name="eunique_credit" placeholder="Eunique Credit" value="<?php echo $details['eunique_credit']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="other_credit">Other Credit</label>
                                    <input type="number" class="form-control" id="other_credit" name="other_credit" placeholder="Other Credit" value="<?php echo $details['other_credit']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="business_type">Business Type</label>
                                    <select name="business_type" class="form-control">          
                                        <?php echo $settings->getBusinessTypes(); ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="business_form">Business Form</label>
                                    <select name="business_form" class="form-control">          
                                        <?php echo $settings->getBusinessForms(); ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="business_time">Business Age</label>
                                    <input type="number" class="form-control" id="business_time" name="business_time" placeholder="Business Age" value="<?php echo $details['business_time']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="stock_value">Stock Value <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="stock_value" name="stock_value" placeholder="Stock Value" value="<?php echo $details['stock_value']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="daily_sales">Daily Sales <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="daily_sales" name="daily_sales" placeholder="Daily Sales" value="<?php echo $details['daily_sales']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="monthly_income">Monthly Income <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="monthly_income" name="monthly_income" placeholder="Monthly Income" value="<?php echo $details['monthly_income']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="monthly_expenses">Monthly Expenses <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="monthly_expenses" name="monthly_expenses" placeholder="Monthly Expenses" value="<?php echo $details['monthly_expenses']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="employees">No. of Employees</label>
                                    <input type="number" class="form-control" id="employees" name="employees" placeholder="No. of Employees" value="<?php echo $details['employees']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="licensed">Business License</label>
                                    <select name="licensed" class="form-control">          
                                        <option value="1">YES</option>
                                        <option value="0">NO</option>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="road">Road Near Business</label>
                                    <input type="text" class="form-control" id="road" name="road" placeholder="Road Near Business" value="<?php echo $details['road']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="street">Street Near Business</label>
                                    <input type="text" class="form-control" id="street" name="street" placeholder="Street Near Business" value="<?php echo $details['street']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="<?php echo $details['location']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="building">Building</label>
                                    <input type="text" class="form-control" id="building" name="building" placeholder="Building" value="<?php echo $details['building']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="house_number">House Number</label>
                                    <input type="text" class="form-control" id="house_number" name="house_number" placeholder="House Number" value="<?php echo $details['house_number']; ?>" />
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
