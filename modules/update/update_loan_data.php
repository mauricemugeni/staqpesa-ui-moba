<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$loans = new Loans();
$code = $_SESSION['loan_data'];
$update_type = $_GET['update_type'];
if (isset($_SESSION['loan'])) {
    $code = $_SESSION['loan'];
} else if (isset($_SESSION['loan_data'])) {
    $code = $_SESSION['loan_data'];
}
$details = $loans->fetchLoanDataDetails($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $loans->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_loan_data");
    }
} else {
    $success = $loans->updateLoanData($code, $update_type);
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = "Record successfully updated";
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_error'] = "Error updating record";
    }
    App::redirectTo("?view_loan_data");
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
                            Update Loan Data Details
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_loan_data"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>">
                                <div class="form-group">
                                    <label for="marital_status">Marital Status</label>
                                    <select name="marital_status" class="form-control" onchange="checkSpouseDetails(this.value);">          
                                        <?php echo $settings->getMaritalStatuses(); ?>
                                    </select> 
                                </div>

                                <div id="show_hide"> 
                                    <div class="form-group">
                                        <label for="spouse_firstname"> Spouse First Name</label>
                                        <input type="text" class="form-control" id="spouse_firstname" name="spouse_firstname" placeholder="Spouse First Name(if married/engaged)" value="<?php echo $details['spouse_firstname']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="spouse_middlename">Spouse Middle Name</label>
                                        <input type="text" class="form-control" id="spouse_middlename" name="spouse_middlename" placeholder="Spouse Middle Name(if married/engaged)" value="<?php echo $details['spouse_middlename']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="spouse_lastname">Spouse Last Name</label>
                                        <input type="text" class="form-control" id="spouse_lastname" name="spouse_lastname" placeholder="Spouse Last Name(if married/engaged)" value="<?php echo $details['spouse_lastname']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="dependants">No. of Dependants</label>
                                        <input type="number" class="form-control" id="dependants" name="dependants" placeholder="No. of Dependants" required="yes" value="<?php echo $details['dependants']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="landmark">Landmark</label>
                                        <input type="text" class="form-control" id="landmark" name="landmark" placeholder="Landmark" required="yes" value="<?php echo $details['landmark']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="purpose">Purpose of Loan</label>
                                        <input type="text" class="form-control" id="purpose" name="purpose" placeholder="Purpose of Loan" required="yes" value="<?php echo $details['purpose']; ?>" />
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
