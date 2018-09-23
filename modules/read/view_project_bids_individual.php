<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Funding.php";
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Users.php";
$funding = new Funding();
$settings = new Settings();
$users = new Users();
$code = $_GET['code'];
$_SESSION['project_bid'] = $code;
$details = $funding->fetchProjectBidDetails($code);
$project_details = $funding->fetchProjectDetails($details['project_id']);
$investor_details_biddedby = $funding->fetchInvestorDetails($details['bidded_by']);

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
            <?php require_once('modules/menus/sub_menu_funding.php'); ?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel">
                        <header class="panel-heading">
                            Project Details
                        </header>
                        <div class="panel-body">
                            <div class="action">
                                <?php if (($details['status'] == 1001 OR $details['status'] == 1032) AND $_SESSION['logged_in_user_type_details']['name'] == "STAFF") { ?>
                                    <a class="edit-individual" href="?update_project_bid&update_type=accept_approval&code=" <?php echo $code; ?> >
                                        Accept Approval
                                    </a>
                                    <a class="edit-individual-warning" href="?update_project_bid&update_type=reject_approval&code=" <?php echo $code; ?> >
                                        Reject Approval
                                    </a>
                                    <?php
                                }
//                                if ($details['status'] == 1020) {
                                    ?>
<!--                                    <a class="edit-individual" href="?update_project_bid&update_type=activate&code=" <?php // echo $code; ?> >
                                        Activate
                                    </a>-->
                                <?php // } if ($details['status'] == 1021) { ?>
<!--                                    <a class="edit-individual-warning" href="?update_project_bid&update_type=deactivate&code=" <?php // echo $code; ?> >
                                        Deactivate
                                    </a>
                                <?php // } if ($details['status'] != 1000) { ?>
                                    <a class="edit-individual-warning" href="?update_project_bid&update_type=delete&code=" <?php // echo $code; ?> >
                                        Delete
                                    </a>
                                    <?php
//                                }
//
//                                if ($details['status'] != 1032) {
                                    ?>
                                    <a class="edit-individual" href="?update_project_bid&update_type=edit&code=" <?php // echo $code; ?> >
                                        Edit
                                    </a>-->
                                <?php // } ?>
                            </div>
                            <div class="status-element">
                                <div class="form-group">
                                    <label for="project_id">Project ID:</label>
                                    <span class="form-control"><?php echo $details['project_id']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="project_name">Project Name:</label>
                                    <span class="form-control"><?php echo $project_details['title']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="bidded_by">Bid Made By:</label>
                                    <span class="form-control"><?php echo $investor_details_biddedby['firstname'] . " " . $investor_details_biddedby['middlename'] . " " . $investor_details_biddedby['lastname']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="bid_amount">Bid Amount <?php echo '(' . $_SESSION['chapter_details']['currency'] . ')'; ?>:</label>
                                    <span class="form-control"><?php echo $_SESSION['chapter_details']['currency'] . " ." . number_format($details['bid_amount'], 2); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="bid_balance">Bid Balance <?php echo '(' . $_SESSION['chapter_details']['currency'] . ')'; ?>:</label>
                                    <span class="form-control"><?php echo $_SESSION['chapter_details']['currency'] . " ." . number_format($details['bid_balance'], 2); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="createdat">Created At:</label>
                                    <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['createdat']); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="lastmodifiedat">Last Modified At:</label>
                                    <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['lastmodifiedat']); ?></span>
                                </div>

                                <?php
                                if ($details['authorizedat'] != NULL AND $details['authorizedat'] != NULL) {
                                    ?>
                                    <div class="form-group">
                                        <label for="authorizedat">Authorized At:</label>
                                        <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['authorizedat']); ?></span>
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