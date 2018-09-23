<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$code = $_GET['code'];
$_SESSION['next_of_kin'] = $code;
$details = $users->fetchNextOfKinDetails($code);
$user_type_details = $users->fetchUserTypeDetails($details['ref_type']);
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
                <div class="col-lg-6">
                    <div class="panel">
                        <header class="panel-heading">
                            Business Form Details
                        </header>
                        <div class="panel-body">
                            <div class="action">
                                <?php if ($details['lastmodifiedby'] != $_SESSION['userid'] AND $details['status'] == 1032) { ?>
                                    <a class="edit-individual" href="?update_next_of_kin&update_type=accept_approval&code=" <?php echo $code; ?> >
                                        Accept Approval
                                    </a>
                                    <a class="edit-individual-warning" href="?update_next_of_kin&update_type=reject_approval&code=" <?php echo $code; ?> >
                                        Reject Approval
                                    </a>
                                    <?php
                                }
                                if ($details['status'] != 1032) {
                                    ?>
                                    <a class="edit-individual" href="?update_next_of_kin&update_type=edit&ref_type=" <?php echo $code; ?> >
                                        Edit
                                    </a>                    
                                <?php } ?>
                            </div>

                            <div id="status-element">
                                <!--                                <div class="form-group"> 
                                                                    <label for="ref_id">Reference ID:</label>
                                                                    <span class="form-control"><?php // echo $details['ref_id'];  ?></span>
                                                                </div>
                                                                <div class="form-group"> 
                                                                    <label for="ref_type">Reference Type:</label>
                                                                    <span class="form-control"><?php // echo $user_type_details['name'];  ?></span> 
                                                                </div>-->


                                <div class="form-group"> 
                                    <label for="ref_type">Reference Details:</label>
                                    <span class="form-control"><?php echo $user_type_details['name'] . " : " . $details['ref_id']; ?></span> 
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
                                <?php if (isset($details['status'])) { ?>
                                    <div class="form-group"> 
                                        <label for="status">Status:</label>
                                        <span class="form-control"><?php echo $status; ?></span> 
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group"> 
                                        <label for="status">Status:</label>
                                        <span class="form-control"><?php echo $details['status']; ?></span> 
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