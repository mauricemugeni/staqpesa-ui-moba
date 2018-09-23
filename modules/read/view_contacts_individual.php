<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$code = $_GET['code'];
$_SESSION['code'] = $code;
$details = $users->fetchContactDetails($code);

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
            <?php require_once('modules/menus/sub_menu_system_users.php'); ?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel">
                        <header class="panel-heading">
                            Contact Details
                        </header>
                        <div class="panel-body">
                            <div class="action">
                                <?php if ($_SESSION['logged_in_user_type_details']['name'] != "INVESTOR") { ?>
                                    <?php if ($details['lastmodifiedby'] != $_SESSION['userid'] AND $details['status'] == 1032) { ?>
                                        <a class="edit-individual" href="?update_contact&update_type=accept_approval&code=" <?php echo $code; ?> >
                                            Accept Approval
                                        </a>
                                        <a class="edit-individual-warning" href="?update_contact&update_type=reject_approval&code=" <?php echo $code; ?> >
                                            Reject Approval
                                        </a>
                                        <?php
                                    }
                                    if ($details['status'] == 1020) {
                                        ?>
                                        <a class="edit-individual" href="?update_contact&update_type=activate&code=" <?php echo $code; ?> >
                                            Activate
                                        </a>
                                    <?php } if ($details['status'] == 1021) { ?>
                                        <a class="edit-individual-warning" href="?update_contact&update_type=deactivate&code=" <?php echo $code; ?> >
                                            Deactivate
                                        </a>
                                    <?php } if ($details['status'] != 1000) { ?>
                                        <a class="edit-individual-warning" href="?update_contact&update_type=delete&code=" <?php echo $code; ?> >
                                            Delete
                                        </a>
                                        <?php
                                    }
                                }
                                if ($details['status'] != 1032) {
                                    ?>
                                    <a class="edit-individual" href="?update_contact&update_type=edit&code=" <?php echo $code; ?> >
                                        Edit
                                    </a>
                                <?php } ?>
                            </div>

                            <div id="status-element">
                                <?php if ($_SESSION['logged_in_user_type_details']['name'] != "INVESTOR") { ?>
                                    <div class="form-group"> 
                                        <label for="ref_type">Reference Type:</label>
                                        <span class="form-control"><?php echo $details['ref_type']; ?> </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="ref_id">Reference ID:</label>
                                        <span class="form-control"><?php echo $details['ref_id']; ?></span>
                                    </div>
                                <?php } ?>
                                <div class="form-group"> 
                                    <label for="phone_number1">Mobile Number:</label>
                                    <span class="form-control"><?php echo $details['phone_number1']; ?></span>
                                </div>
                                <div class="form-group"> 
                                    <label for="phone_number2">Phone Number:</label>
                                    <span class="form-control"><?php echo $details['phone_number2']; ?> </span>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <span class="form-control"><?php echo $details['email']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="postal_number">Postal Number:</label>
                                    <span class="form-control"><?php echo $details['postal_number']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="postal_code">Postal Code:</label>
                                    <span class="form-control"><?php echo $details['postal_code']; ?> </span>
                                </div>
                                <div class="form-group"> 
                                    <label for="town">Town:</label>
                                    <span class="form-control"><?php echo $details['town']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="residential_area">Residential Area:</label>
                                    <span class="form-control"><?php echo $details['residential_area']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="estate">Estate:</label>
                                    <span class="form-control"><?php echo $details['estate']; ?></span>
                                </div>
                                <div class="form-group"> 
                                    <label for="street">Street:</label>
                                    <span class="form-control"><?php echo $details['street']; ?></span>
                                </div>
                                <div class="form-group"> 
                                    <label for="division">Division:</label>
                                    <span class="form-control"><?php echo $details['division']; ?></span>
                                </div>
                                <div class="form-group"> 
                                    <label for="location">Location:</label>
                                    <span class="form-control"><?php echo $details['location']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="sub_location">Sub-location:</label>
                                    <span class="form-control"><?php echo $details['sub_location']; ?></span>
                                </div>

                                <?php if ($details['status'] == 1000 OR $details['status'] == 1001 OR $details['status'] == 1032 OR $details['status'] == 1010 OR $details['status'] == 1011 OR $details['status'] == 1020 OR $details['status'] == 1021) { ?>
                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <span class="form-control"><?php echo $status; ?></span>
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