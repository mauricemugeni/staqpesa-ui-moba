<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$code = $_GET['code'];
$_SESSION['account_nominee'] = $code;
$details = $users->fetchAccountNomineeDetails($code);
$staff_details_lastmodifiedby = $users->fetchStaffDetails($details['lastmodifiedby']);
if ($details['status'] == 1000) {
    $status = "DELETED";
} else if ($details['status'] == 1001 OR $details['status'] == 1032) {
    $status = "AWAITING APPROVAL";
} else if ($details['status'] == 1010) {
    $status = "ACTIVE";
} else if ($details['status'] == 1011) {
    $status = "ACTIVE";
} else if ($details['status'] == 1020) {
    $status = "NOT ACTIVE";
} else if ($details['status'] == 1021) {
    $status = "ACTIVE";
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
                    <div class="panel">
                        <header class="panel-heading">
                            <strong>ACCOUNT NOMINEE DETAILS</strong>
                        </header>
                        <div class="panel-body">
                            <div class="action">
                                <?php // if ($details['lastmodifiedby'] != $_SESSION['userid'] AND $details['status'] == 1032) { ?>
<!--                                    <a class="edit-individual" href="?update_account_nominee&update_type=accept_approval&code=" <?php // echo $code;   ?> >
                                        Accept Approval
                                    </a>
                                    <a class="edit-individual-warning" href="?update_account_nominee&update_type=reject_approval&code=" <?php // echo $code;   ?> >
                                        Reject Approval
                                    </a>-->
                                <?php
//                                }
//                                if ($details['status'] != 1032) {
//                                if (isset($_SESSION['account'])) {
                                ?>
<!--                                    <a class="edit-individual" href="?update_account_nominee&update_type=edit&ref_type=" <?php // echo $code;   ?> >
                                        Edit
                                    </a>                    -->
                                <?php // } ?>
                            </div>

                            <div id="status-element">
                                <p />
                                <?php if (!isset($_SESSION['account'])) { ?>
                                    <div class="form-group">  
                                        <label for="account_number">Account Number:</label>
                                        <span class="form-control"><?php echo $details['account_number']; ?></span>
                                    </div>
                                <?php } ?>

                                <div class="form-group">  
                                    <label for="firstname">First Name:</label>
                                    <span class="form-control"><?php echo $details['firstname']; ?></span>
                                </div>
                                <div class="form-group">  
                                    <label for="middlename">Middle Name:</label>
                                    <span class="form-control"><?php echo $details['middlename']; ?></span>
                                </div>
                                <div class="form-group">  
                                    <label for="lastname">Last Name:</label>
                                    <span class="form-control"><?php echo $details['lastname']; ?></span>
                                </div>
                                <div class="form-group">  
                                    <label for="idnumber">ID Number:</label>
                                    <span class="form-control"><?php echo $details['idnumber']; ?></span>
                                </div>
                                <div class="form-group"> 
                                    <label for="relationship">Relationship:</label>
                                    <span class="form-control"><?php echo $details['relationship']; ?></span> 
                                </div>
                                <div class="form-group">  
                                    <label for="phone_number">Phone Number:</label>
                                    <span class="form-control"><?php echo $details['phone_number']; ?></span>
                                </div>
                                <div class="form-group">  
                                    <label for="email">Email Address:</label>
                                    <span class="form-control"><?php echo $details['email']; ?></span>
                                </div>
                                <div class="form-group"> 
                                    <label for="postal_address">Postal Address:</label>
                                    <span class="form-control"><?php echo $details['postal_address']; ?></span> 
                                </div>
                                <div class="form-group"> 
                                    <label for="percentage">Percentage:</label>
                                    <span class="form-control"><?php echo $details['percentage']; ?></span> 
                                </div>
                                <div class="form-group"> 
                                    <label for="status">Status:</label>
                                    <span class="form-control"><?php echo $status; ?></span>
                                </div>     
                                <div class="form-group">
                                    <label for="lastmodifiedat">Last Modified At:</label>
                                    <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['lastmodifiedat']); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="lastmodifiedby">Last Modified By:</label>
                                    <span class="form-control"><?php echo $staff_details_lastmodifiedby['firstname'] . " " . $staff_details_lastmodifiedby['middlename'] . " " . $staff_details_lastmodifiedby['lastname']; ?></span>
                                </div>
                                <?php
                                if ($details['lastauthorizedat'] != NULL AND $details['lastauthorizedat'] != NULL) {
                                    $staff_details_lastauthorizedby = $users->fetchStaffDetails($details['lastauthorizedby']);
                                    ?>
                                    <div class="form-group">
                                        <label for="lastauthorizedat">Last Authorized At:</label>
                                        <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['lastauthorizedat']); ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="lastauthorizedby">Last Authorized By:</label>
                                        <span class="form-control"><?php echo $staff_details_lastauthorizedby['firstname'] . " " . $staff_details_lastauthorizedby['middlename'] . " " . $staff_details_lastauthorizedby['lastname']; ?></span>
                                    </div>

                                <?php } ?>

                            </div>
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel -->
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>