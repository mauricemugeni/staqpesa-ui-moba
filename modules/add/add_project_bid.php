<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Funding.php";
$funding = new Funding();
$bid_balance_details = $funding->fetchProjectBidBalanceDetails($_SESSION['project']);

if (!empty($_POST)) {
    $success = $funding->execute();    
    if ($success['status'] == 200) {
        $_SESSION['add_success'] = true;
        $_SESSION['feedback_message'] = "<strong>Successful:</strong> The project bid transaction has been saved successfully.";
        App::redirectTo("?view_project_bids");
    } else {
        $_SESSION['add_fail'] = true;
        $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error saving the project transaction bid. Please try again.";
    }
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_funding.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Project Bid
                            <?php
                            if (isset($_SESSION['add_fail'])) {
                                echo $_SESSION['add_record_fail'];
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['add_fail']);
                            }
                            ?>
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="add_project_bid"/>
                                <input type="hidden" name="bidded_by" value="<?php echo $_SESSION['userid']; ?>"/>
                                <input type="hidden" name="project_id" value="<?php echo $_SESSION['project']; ?>"/>
                                <div class="form-group">
                                    <label for="bid_balance">Outstanding Balance <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="text" class="form-control" id="bid_balance" name="bid_balance" placeholder="Outstanding Balance" value="<?php echo number_format($bid_balance_details['bid_balance'], 2); ?>" readonly="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="bid_amount">Bid Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="bid_amount" name="bid_amount" placeholder="Bid Amount" required="yes"/>
                                </div>
                                <button type="submit" class="btn btn-info">Submit</button>
                            </form>

                        </div>
                    </section>
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>
