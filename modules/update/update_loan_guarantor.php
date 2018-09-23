<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$loans = new Loans();
$users = new Users();
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
                            Update Loan Guarantor Details
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_loan_guarantor"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>">
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?php echo $details['firstname']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="middlename">Middle Name</label>
                                    <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle Name" value="<?php echo $details['middlename']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $details['lastname']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="idnumber">ID Number</label>
                                    <input type="number" class="form-control" id="idnumber" name="idnumber" placeholder="ID Number" value="<?php echo $details['idnumber']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="relationship">Relationship</label>
                                    <input type="text" class="form-control" id="relationship" name="relationship" placeholder="Relationship" value="<?php echo $details['relationship']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Mobile</label>
                                    <input type="text" class="form-control" id="phone_number" placeholder="Mobile" name="phone_number" value="<?php echo $details['phone_number']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="postal_address">Postal Address</label>
                                    <input type="text" class="form-control" id="postal_address" placeholder="Postal Address" name="postal_address" value="<?php echo $details['postal_address']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="physical_address">Location</label>
                                    <input type="text" class="form-control" id="physical_address" placeholder="Location" name="physical_address" value="<?php echo $details['physical_address']; ?>" required/>
                                </div>
                                <div class="form-group">
                                    <label for="place_of_residence">Place of Residence</label>
                                    <input type="text" class="form-control" id="place_of_residence" placeholder="Place of Residence" name="place_of_residence" value="<?php echo $details['place_of_residence']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="estate">Estate</label>
                                    <input type="text" class="form-control" id="estate" placeholder="Estate" name="estate" value="<?php echo $details['estate']; ?>" />
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
