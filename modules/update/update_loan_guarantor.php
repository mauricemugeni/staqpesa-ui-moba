<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$loans = new Loans();
$users = new Users();

$code = $_GET['code'];
$update_type = $_GET['update_type'];
$details = $loans->fetchLoanGuarantorDetails($code);

$success = $loans->updateLoanGuarantors($code, $update_type);
if (is_bool($success) && $success == true) {
    if ($update_type == "deactivate") {
        $guarantorship_action = 'deactivated';
    } else if ($update_type == "activate") {
        $guarantorship_action = 'activated';
    } else if ($update_type == "accept_approval") {
        $guarantorship_action = 'approved';
    } else if ($update_type == "reject_approval") {
        $guarantorship_action = 'rejected';
    }

    $_SESSION['success_message'] = "Guarantorship successfully {$guarantorship_action}.";
    App::redirectTo("?action_success");
} else if (is_bool($success) && $success == false) {
    if ($update_type == "deactivate") {
        $guarantorship_action = 'deactivating';
    } else if ($update_type == "activate") {
        $guarantorship_action = 'activating';
    } else if ($update_type == "accept_approval") {
        $guarantorship_action = 'approving';
    } else if ($update_type == "reject_approval") {
        $guarantorship_action = 'rejecting';
    }
    
    $_SESSION['fail_message'] = "There was an error {$guarantorship_action} the guarantorship. Please check and try again.";
    App::redirectTo("?action_fail");
}
?>

<!--<div class="wrapper row-offcanvas row-offcanvas-left">
<?php // require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
         Main content 
        <section class="content">
<?php // require_once('modules/menus/sub_menu_loans.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Update Loan Guarantor Details
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_loan_guarantor"/>
                                <input type="hidden" name="createdby" value="<?php // echo $_SESSION['userid'];  ?>">
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?php // echo $details['firstname'];  ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="middlename">Middle Name</label>
                                    <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle Name" value="<?php // echo $details['middlename'];  ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="<?php // echo $details['lastname'];  ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select> 
                                </div>
         
                                <button type="submit" class="btn btn-info">Update</button>
                            </form>

                        </div>
                    </section>
                </div>        
            </div>row1
        </section> /.content 
    </aside> /.right-side 
</div>-->
