<?php
if (!App::isLoggedIn()) App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
$loans = new Loans();
$code = $_SESSION['loan_type'];
$update_type = $_GET['update_type'];
$details = $loans->fetchLoanTypeDetails($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $loans->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_loan_types");
    }
} else {
    $success = $loans->updateLoanType($code, $update_type);
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = "Record successfully updated";
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_error'] = "Error updating record";
    }
    App::redirectTo("?view_loan_types");
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
                            Update Account Category
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_loan_type"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>">
                                <div class="form-group">
                                    <label for="name">Account Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Account Name" value="<?php echo $details['name']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="qualification_time">Qualification Time(Months)</label>
                                    <input type="text" class="form-control" id="qualification_time" name="qualification_time" placeholder="Qualification Time(Months)" value="<?php echo $details['qualification_time']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="qualification_amount">Qualification Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="qualification_amount" name="qualification_amount" placeholder="Qualification Amount" value="<?php echo $details['qualification_amount']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="interest_rate">Interest Rate</label>
                                    <input type="number" class="form-control" id="interest_rate" name="interest_rate" placeholder="Interest Rate" value="<?php echo $details['interest_rate']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="maximum_duration">Maximum Duration</label>
                                    <input type="number" class="form-control" id="maximum_duration" name="maximum_duration" placeholder="Maximum Duration" value="<?php echo $details['maximum_duration']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="instalment_frequency">Instalment Frequency</label>
                                    <select name="instalment_frequency" class="form-control">          
                                    <?php echo $loans->getInstalmentFrequencies(); ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="default_rate">Default Rate(%)</label>
                                    <input type="number" class="form-control" id="default_rate" name="default_rate" placeholder="Default Rate" value="<?php echo $details['default_rate']; ?>" required="yes"/>
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
