<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$code = $_GET['code'];
$_SESSION['default_charge_rate'] = $code;
$details = $settings->fetchDefaultChargeRateDetails($code);

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
            <?php require_once('modules/menus/sub_menu_settings.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel">
                        <header class="panel-heading">
                            Default Charge Rate Details
                        </header>
                        <div class="panel-body">
                            <div class="action">
                                <?php if (($details['createdby'] != $_SESSION['userid'] AND $details['status'] == 1001) OR ( $details['lastmodifiedby'] != $_SESSION['userid'] AND $details['status'] == 1032)) { ?>
                                    <a class="edit-individual" href="?update_default_charge_rate&update_type=accept_approval&code=" <?php echo $code; ?> >
                                        Accept Approval
                                    </a>
                                    <a class="edit-individual-warning" href="?update_default_charge_rate&update_type=reject_approval&code=" <?php echo $code; ?> >
                                        Reject Approval
                                    </a>
                                    <?php
                                }
                                if ($details['status'] == 1020) {
                                    ?>
                                    <a class="edit-individual" href="?update_default_charge_rate&update_type=activate&code=" <?php echo $code; ?> >
                                        Activate
                                    </a>
                                <?php } if ($details['status'] == 1021) { ?>
                                    <a class="edit-individual-warning" href="?update_default_charge_rate&update_type=deactivate&code=" <?php echo $code; ?> >
                                        Deactivate
                                    </a>
                                <?php } if ($details['status'] != 1000) { ?>
                                    <a class="edit-individual-warning" href="?update_default_charge_rate&update_type=delete&code=" <?php echo $code; ?> >
                                        Delete
                                    </a>
                                    <?php
                                }

                                if ($details['status'] != 1032) {
                                    ?>
                                    <a class="edit-individual" href="?update_default_charge_rate&update_type=edit&code=" <?php echo $code; ?> >
                                        Edit
                                    </a>
                                <?php } ?>
                            </div>     

                            <div id="status-element">
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <span class="form-control"><?php echo $details['description']; ?></span>
                                </div>
                                <div class="form-group"> 
                                    <label for="amount">Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?>:</label>
                                    <span class="form-control"><?php echo $_SESSION['currency'] ." .". number_format($details['amount'], 2); ?></span> 
                                </div>
                                <div class="form-group"> 
                                    <label for="status">Status:</label>
                                    <span class="form-control"><?php echo $status; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="createdat">Created At:</label>
                                    <span class="form-control"><?php echo $details['createdat']; ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="createdby">Created By:</label>
                                    <span class="form-control"><?php echo $details['createdby']; ?></span>
                                </div>

                                <?php if ($details['authorizedat'] != NULL AND $details['authorizedat'] != NULL) { ?>

                                    <div class="form-group">
                                        <label for="authorizedat">Authorized At:</label>
                                        <span class="form-control"><?php echo $details['authorizedat']; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="authorizedby">Authorized By:</label>
                                        <span class="form-control"><?php echo $details['authorizedby']; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="lastmodifiedat">Last Modified At:</label>
                                        <span class="form-control"><?php echo $details['lastmodifiedat']; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="lastmodifiedby">Last Modified By:</label>
                                        <span class="form-control"><?php echo $details['lastmodifiedby']; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="lastauthorizedat">Last Authorized At:</label>
                                        <span class="form-control"><?php echo $details['lastauthorizedat']; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="lastauthorizedby">Last Authorized By:</label>
                                        <span class="form-control"><?php echo $details['lastauthorizedby']; ?></span>
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