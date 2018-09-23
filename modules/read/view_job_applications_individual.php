<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$code = $_GET['code'];
$_SESSION['job_application'] = $code;
$details = $users->fetchJobApplicationDetails($code);
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
            <?php require_once('modules/menus/sub_menu_system_users.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel">
                        <header class="panel-heading">
                            Job Application Details
                        </header>
                        <div class="panel-body">
                            <div class="action">
                                <?php if (($details['createdby'] != $_SESSION['userid'] AND $details['status'] == 1001) OR ( $details['lastmodifiedby'] != $_SESSION['userid'] AND $details['status'] == 1032)) { ?>
                                    <a class="edit-individual" href="?update_job_application&update_type=accept_approval&code=" <?php echo $code; ?> >
                                        Accept Approval
                                    </a>
                                    <a class="edit-individual-warning" href="?update_job_application&update_type=reject_approval&code=" <?php echo $code; ?> >
                                        Reject Approval
                                    </a>
                                    <?php
                                }
                                if ($details['status'] == 1020) {
                                    ?>
                                    <a class="edit-individual" href="?update_job_application&update_type=activate&code=" <?php echo $code; ?> >
                                        Activate
                                    </a>
                                <?php } if ($details['status'] == 1021) { ?>
                                    <a class="edit-individual-warning" href="?update_job_application&update_type=deactivate&code=" <?php echo $code; ?> >
                                        Deactivate
                                    </a>
                                <?php } if ($details['status'] != 1000) { ?>
                                    <a class="edit-individual-warning" href="?update_job_application&update_type=delete&code=" <?php echo $code; ?> >
                                        Delete
                                    </a>
                                    <?php
                                }

                                if ($details['status'] != 1032) {
                                    ?>
                                    <a class="edit-individual" href="?update_job_application&update_type=edit&code=" <?php echo $code; ?> >
                                        Edit
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="status-element">
                                <div class="form-group">
                                    <label for="position">Position:</label>
                                    <span class="form-control"><?php echo $details['position']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="firstname">Firstname:</label>
                                    <span class="form-control"><?php echo $details['firstname']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="middlename">Middlename:</label>
                                    <span class="form-control"><?php echo $details['middlename']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Lastname:</label>
                                    <span class="form-control"><?php echo $details['lastname']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender:</label>
                                    <span class="form-control"><?php echo $details['gender']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="idnumber">ID Number:</label>
                                    <span class="form-control"><?php echo $details['idnumber']; ?></span>
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
                                    <label for="residence">Residence/Citizenship:</label>
                                    <span class="form-control"><?php echo $details['residence']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="past_employee">Have you worked with us before?</label>
                                    <span class="form-control"><?php echo $details['past_employee']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="education_level">Education Level:</label>
                                    <span class="form-control"><?php echo $details['education_level']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="availability">Availability:</label>
                                    <span class="form-control"><?php echo $details['availability']; ?></span>
                                </div>                                                                
                                <div class="form-group">
                                    <label for="referee1_firstname">First Referee Firstname:</label>
                                    <span class="form-control"><?php echo $details['referee1_firstname']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="referee1_lastname">First Referee Lastname:</label>
                                    <span class="form-control"><?php echo $details['referee1_lastname']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="referee1_phone_number">First Referee Phone Number:</label>
                                    <span class="form-control"><?php echo $details['referee1_phone_number']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="referee1_email">First Referee Email Address:</label>
                                    <span class="form-control"><?php echo $details['referee1_email']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="referee1_occupation">First Referee Occupation:</label>
                                    <span class="form-control"><?php echo $details['referee1_occupation']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="referee2_firstname">Second Referee Firstname:</label>
                                    <span class="form-control"><?php echo $details['referee2_firstname']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="referee2_lastname">Second Referee Lastname:</label>
                                    <span class="form-control"><?php echo $details['referee2_lastname']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="referee2_phone_number">Second Referee Phone Number:</label>
                                    <span class="form-control"><?php echo $details['referee2_phone_number']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="referee2_email">Second Referee Email Address:</label>
                                    <span class="form-control"><?php echo $details['referee2_email']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="referee2_occupation">Second Referee Occupation:</label>
                                    <span class="form-control"><?php echo $details['referee2_occupation']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="employee_brief">Employee Brief:</label>
                                    <span class="form-control"><?php echo $details['employee_brief']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <span class="form-control"><?php echo $status; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="createdat">Created At:</label>
                                    <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['createdat']); ?></span>
                                </div>

                                <?php
                                if ($details['reviewedat'] != NULL AND $details['reviewedat'] != NULL) {
                                    $staff_details_reviewedby = $users->fetchStaffDetails($details['reviewedby']);
                                    ?>

                                    <div class="form-group">
                                        <label for="reviewedat">Reviewed At:</label>
                                        <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['reviewedat']); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="reviewedby">Reviewed By:</label>
                                        <span class="form-control"><?php echo $staff_details_reviewedby['firstname'] . " " . $staff_details_reviewedby['middlename'] . " " . $staff_details_reviewedby['lastname']; ?></span>
                                    </div>
                                <div class="form-group">
                                    <label for="review_comment">Review Comment:</label>
                                    <span class="form-control"><?php echo $details['review_comment']; ?></span>
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