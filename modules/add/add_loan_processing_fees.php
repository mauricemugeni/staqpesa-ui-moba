<?php
if (!App::isLoggedIn()) App::redirectTo("?");
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
if (!empty($_POST)) {
    $success = $settings->execute();    
    if ($success['status'] == 200) {
        $_SESSION['add_success'] = true;
        $_SESSION['feedback_message'] = "<strong>Successful:</strong> The loan processing fee has been added successfully.";
        App::redirectTo("?view_loan_processing_fees");
    } else {
        $_SESSION['add_fail'] = true;
        $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error adding the loan processing fee. Please try again.";
    }
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
                    <section class="panel">
                        <header class="panel-heading">
                            Add Loan Processing Fee
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
                                <input type="hidden" name="action" value="add_loan_processing_fees"/>
                                <input type="hidden" name="createdby" value="<?php  echo $_SESSION['userid']; ?>"/>
                                <div class="form-group">
                                    <label for="name">Start/Lower Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="start" name="start" placeholder="eg. 0" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="name">End/Upper Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="end" name="end" placeholder="eg. 100000" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="amount_type">Amount Type</label>
                                    <select name="amount_type" class="form-control m-b-10">
                                        <option value="<?php echo $configs["currency"]; ?>">CURRENCY(<?php echo $configs["currency"]; ?>)</option>
                                        <option value="PERCENT">PERCENTAGE(%)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount<?php echo '(' . $_SESSION['currency'] . ')'; ?>/Value(%) </label>
                                    <input type="number" class="form-control" id="amount" name="amount" placeholder="eg. 100" required="yes"/>
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