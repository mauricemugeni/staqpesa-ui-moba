<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Users.php";
$settings = new Settings();
$users = new Users();
$code = $_GET['code'];
$_SESSION['institution'] = $code;
$details = $settings->fetchInstitutionDetails($code);
$staff_details_createdby = $users->fetchStaffDetails($details['createdby']);

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
                <div class="col-lg-8">
                    <div class="panel">
                        <header class="panel-heading">
                            User Privilege Details
                        </header>
                        <div class="panel-body">
                            <div class="action">
                                <?php if (($details['createdby'] != $_SESSION['userid'] AND $details['status'] == 1001) OR ( $details['lastmodifiedby'] != $_SESSION['userid'] AND $details['status'] == 1032)) { ?>
                                    <a class="edit-individual" href="?update_institution&update_type=accept_approval&code=" <?php echo $code; ?> >
                                        Accept Approval
                                    </a>
                                    <a class="edit-individual-warning" href="?update_institution&update_type=reject_approval&code=" <?php echo $code; ?> >
                                        Reject Approval
                                    </a>
                                    <?php
                                }
                                if ($details['status'] == 1020) {
                                    ?>
                                    <a class="edit-individual" href="?update_institution&update_type=activate&code=" <?php echo $code; ?> >
                                        Activate
                                    </a>
                                <?php } if ($details['status'] == 1021) { ?>
                                    <a class="edit-individual-warning" href="?update_institution&update_type=deactivate&code=" <?php echo $code; ?> >
                                        Deactivate
                                    </a>
                                <?php } if ($details['status'] != 1000) { ?>
                                    <a class="edit-individual-warning" href="?update_institution&update_type=delete&code=" <?php echo $code; ?> >
                                        Delete
                                    </a>
                                    <?php
                                }

                                if ($details['status'] != 1032) {
                                    ?>
                                    <a class="edit-individual" href="?update_institution&update_type=edit&code=" <?php echo $code; ?> >
                                        Edit
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="status-element">
                                <div class="form-group">
                                    <label for="company_name">Company Name:</label>
                                    <span class="form-control"><?php echo $details['company_name']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="business_type">Business Type:</label>
                                    <span class="form-control"><?php echo $details['business_type']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="postal_number">Postal Number:</label>
                                    <span class="form-control"><?php echo $details['postal_number']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="postal_code">Postal Code:</label>
                                    <span class="form-control"><?php echo $details['postal_code']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="town">Town:</label>
                                    <span class="form-control"><?php echo $details['town']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone Number:</label>
                                    <span class="form-control"><?php echo $details['phone_number']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <span class="form-control"><?php echo $details['email']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="is_partner">Is a Partner:</label>
                                    <span class="form-control"><?php echo $details['is_partner']; ?></span>
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