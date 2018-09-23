<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
$loans = new Loans();
$code = $_SESSION['loan_external_data'];
$update_type = $_GET['update_type'];
if (isset($_SESSION['loan'])) {
    $code = $_SESSION['loan'];
} else if (isset($_SESSION['loan_external_data'])) {
    $code = $_SESSION['loan_external_data'];
}
$details = $loans->fetchLoanExternalDataDetails($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $loans->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_loan_external_data");
    }
} else {
    $success = $loans->updateLoanExternalData($code, $update_type);
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = "Record successfully updated";
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_error'] = "Error updating record";
    }
    App::redirectTo("?view_loan_external_data");
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
                            Update Loan External Data Details
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_loan_external_data"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>">
                                <div class="form-group">
                                    <label for="bank">Bank</label>
                                    <input type="text" class="form-control" id="bank" name="bank" placeholder="Bank Name" value="<?php echo $details['bank']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="branch">Branch Name</label>
                                    <input type="text" class="form-control" id="branch" name="branch" placeholder="Branch Name" value="<?php echo $details['branch']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="organization">Organization Name</label>
                                    <input type="text" class="form-control" id="organization" name="organization" placeholder="Organization Name" value="<?php echo $details['organization']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="loan_amount">Loan Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="loan_amount" name="loan_amount" placeholder="Loan Amount" value="<?php echo $details['loan_amount']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">   
                                    <label for="date-group">Date of Issue</label>
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
                                    <label for="external_source">Do you have an External Source of Income</label>
                                    <select name="external_source" class="form-control">          
                                        <option value="1">YES</option>
                                        <option value="0">NO</option>
                                    </select> 
                                </div>
                                <div class="form-group">  
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $details['description']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">  
                                    <label for="source_amount">Source Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="source_amount" name="source_amount" placeholder="Source Amount" value="<?php echo $details['source_amount']; ?>" required="yes"/>
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
