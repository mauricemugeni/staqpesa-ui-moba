<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Funding.php";
$funding = new Funding();
$code = $_SESSION['project_bid'];
$update_type = $_GET['update_type'];
$details = $funding->fetchInvestorTypeDetails($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $funding->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_project_bids");
    }
} else {
    $success = $funding->updateProjectBid($code, $update_type);
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = "Record successfully updated";
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_error'] = "Error updating record";
    }
    App::redirectTo("?view_project_bids");
}

//else {
//    $success = $settings->updateInvestorTypesDetails($code, $update_type);
//    if (is_bool($success) && $success == true) {
//        $_SESSION['update_success'] = "Record successfully updated";
//    } else if (is_bool($success) && $success == false) {
//        $_SESSION['update_error'] = "Error updating record";
//    }
//    App::redirectTo("?view_project_bids");
//}
?>


<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_funding.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Update Investor
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_project_bid"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['createdby']; ?>"/>
                                <div class="form-group">
                                    <label for="project_name">Project Name</label>
                                    <input type="text" class="form-control" id="project_name" name="project_name" value="<?php echo $_SESSION['project_name']; ?>" placeholder="Project Name" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="bid_amount">Bid Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="bid_amount" name="bid_amount" value="<?php echo $_SESSION['bid_amount']; ?>" placeholder="Bid Amount" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="bid_balance">Project Balance <?php echo '(' . $_SESSION['currency'] . ')'; ?>   </label>
                                    <input type="text" class="form-control" id="bid_balance" name="bid_balance" value="<?php echo $_SESSION['bid_balance']; ?>" placeholder="Bid Balance" required="yes"/>
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
