<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
$loans = new Loans();
$code = $_SESSION['loan_contact_person'];
$update_type = $_GET['update_type'];
if (isset($_SESSION['loan'])) {
    $code = $_SESSION['loan'];
} else if (isset($_SESSION['loan_contact_person'])) {
    $code = $_SESSION['loan_contact_person'];
}
$details = $loans->fetchLoanContactPersonDetails($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $loans->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_loan_contact_persons");
    }
} else {
    $success = $loans->updateLoanContactPersons($code, $update_type);
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = "Record successfully updated";
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_error'] = "Error updating record";
    }
    App::redirectTo("?view_loan_contact_persons");
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_loans.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                           Update Loan Contact Person Details
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_loan_contact_person"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>">
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?php echo $details['firstname']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="middlename">Middle Name</label>
                                    <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle Name" value="<?php echo $details['middlename']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $details['lastname']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="relationship">Relationship</label>
                                    <input type="text" class="form-control" id="relationship" name="relationship" placeholder="Relationship" value="<?php echo $details['relationship']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="workplace">Workplace</label>
                                    <input type="text" class="form-control" id="workplace" name="workplace" placeholder="Workplace" value="<?php echo $details['workplace']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" placeholder="Mobile" name="phone_number" value="<?php echo $details['phone_number']; ?>" required/>
                                </div>
                                <div class="form-group">
                                    <label for="postal_address">Postal Address</label>
                                    <input type="text" class="form-control" id="postal_address" placeholder="Postal Address" name="postal_address" value="<?php echo $details['postal_address']; ?>" required/>
                                </div>
                                <div class="form-group">
                                    <label for="physical_address">Physical Address</label>
                                    <input type="text" class="form-control" id="physical_address" placeholder="Physical Address" name="physical_address" value="<?php echo $details['physical_address']; ?>" required/>
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
