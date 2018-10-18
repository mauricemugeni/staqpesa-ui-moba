<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$users = new Users();


if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $_SESSION['account_holder'] = $code;
} 

//else if (isset($_SESSION['account'])) {
//    $_SESSION['account_holder'] = $code;
//}

$details = $users->fetchAccountHolderDetails($code);
$_SESSION['holder_id'] = $details['id'];
$staff_details_createdby = $users->fetchStaffDetails($details['createdby']);

if ($details['is_signatory'] == 1) {
    $signatory = "YES";
} else if ($details['is_signatory'] == 0) {
    $signatory = "NO";
}

if ($details['gender'] == "M") {
    $gender = "MALE";
} else if ($details['gender'] == "F") {
    $gender = "FEMALE";
}

if ($details['status'] == 1000) {
    $status = "DELETED";
} else if ($details['status'] == 1001 OR $details['status'] == 1032) {
    $status = "AWAITING APPROVAL";
} else if ($details['status'] == 1010) {
    $status = "APPROVAL REJECTED";
} else if ($details['status'] == 1011) {
    $status = "APPROVAL ACCEPTED";
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
            <?php // require_once('modules/menus/sub_menu_account.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel">
                        <header class="panel-heading">
                            <strong>ACCOUNT HOLDER DETAILS</strong>
                        </header>
                        <div class="panel-body">
                            <div class="action">
                                <?php if (($details['createdby'] != $_SESSION['userid'] AND $details['status'] == 1001) OR ( $details['lastmodifiedby'] != $_SESSION['userid'] AND $details['status'] == 1032)) { ?>
                                    <a class="edit-individual" href="?update_account_holder&update_type=accept_approval&code=" <?php echo $code; ?> >
                                        Accept Approval
                                    </a>
                                    <a class="edit-individual-warning" href="?update_account_holder&update_type=reject_approval&code=" <?php echo $code; ?> >
                                        Reject Approval
                                    </a>
                                    <?php
                                }
                                if ($details['status'] == 1020) {
                                    ?>
                                    <a class="edit-individual" href="?update_account_holder&update_type=activate&code=" <?php echo $code; ?> >
                                        Activate
                                    </a>
                                <?php } if ($details['status'] == 1021) { ?>
                                    <a class="edit-individual-warning" href="?update_account_holder&update_type=deactivate&code=" <?php echo $code; ?> >
                                        Deactivate
                                    </a>
                                <?php } if ($details['status'] != 1000) { ?>
                                    <a class="edit-individual-warning" href="?update_account_holder&update_type=delete&code=" <?php echo $code; ?> >
                                        Delete
                                    </a>
                                <?php } ?>

                                <a class="edit-individual" href="?update_signature&user_type=account_holder" >
                                    Update Signature
                                </a>

                                <a class="edit-individual" href="?update_profpicture&user_type=account_holder" >
                                    Update Profile Picture
                                </a>

                                <?php if ($details['status'] != 1032) { ?>
                                    <a class="edit-individual" href="?update_account_holder&update_type=edit&code=" <?php echo $code; ?> >
                                        Edit
                                    </a>
                                <?php } ?>
                            </div>
                            <div id="status-element">

                                <div class="form-group">
                                    <label for="profpicture">Profile Picture:</label>
                                    <img src="modules/images/customers/photos/<?php echo $details['profpicture'] ?>" alt="Account Holder's Image" />
                                </div>

                                <div class="form-group">
                                    <label for="account_number">Account Number:</label>
                                    <span class="form-control"><?php echo $details['account_number']; ?></span>
                                </div>

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
                                    <label for="gender">Gender:</label>
                                    <span class="form-control"><?php echo $gender; ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="idnumber">ID Number:</label>
                                    <span class="form-control"><?php echo $details['idnumber']; ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="birthdate">Date of Birth:</label>
                                    <span class="form-control"><?php echo $details['birthdate']; ?></span>
                                </div>

                                <div class="form-group"> 
                                    <label for="nationality">Nationality:</label>
                                    <span class="form-control"><?php echo $details['nationality']; ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="signature">Signature:</label>
                                    <img src="modules/images/customers/signatures/<?php echo $details['signature'] ?>" alt="Account Holder's Signature" />
                                </div>

                                <div class="form-group">
                                    <label for="signatory">Is account holder a signatory:</label>
                                    <span class="form-control"><?php echo $signatory; ?></span>
                                </div>

                                <div class="form-group"> 
                                    <label for="status">Status:</label>
                                    <span class="form-control"><?php echo $status; ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="createdat">Created At:</label>
                                    <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['createdat']); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="createdby">Created By:</label>
                                    <span class="form-control"><?php echo $staff_details_createdby['firstname'] . " " . $staff_details_createdby['middlename'] . " " . $staff_details_createdby['lastname']; ?></span>
                                </div>

                                <?php
                                if ($details['authorizedat'] != NULL AND $details['authorizedat'] != NULL) {
                                    $staff_details_authorizedby = $users->fetchStaffDetails($details['authorizedby']);
                                    $staff_details_lastmodifiedby = $users->fetchStaffDetails($details['lastmodifiedby']);
                                    $staff_details_lastauthorizedby = $users->fetchStaffDetails($details['lastauthorizedby']);
                                    ?>

                                    <div class="form-group">
                                        <label for="authorizedat">Authorized At:</label>
                                        <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['authorizedat']); ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="authorizedby">Authorized By:</label>
                                        <span class="form-control"><?php echo $staff_details_authorizedby['firstname'] . " " . $staff_details_authorizedby['middlename'] . " " . $staff_details_authorizedby['lastname']; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="lastmodifiedat">Last Modified At:</label>
                                        <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['lastmodifiedat']); ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="lastmodifiedby">Last Modified By:</label>
                                        <span class="form-control"><?php echo $staff_details_lastmodifiedby['firstname'] . " " . $staff_details_lastmodifiedby['middlename'] . " " . $staff_details_lastmodifiedby['lastname']; ?></span>
                                    </div>

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