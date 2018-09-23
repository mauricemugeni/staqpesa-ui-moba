<?php
if (!App::isLoggedIn()) App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
$loans = new Loans();
if (!empty($_POST)) {
    $success = $loans->execute();    
    if ($success['status'] == 200) {
        $_SESSION['add_success'] = true;
        $_SESSION['feedback_message'] = "<strong>Successful:</strong> The loan type has been added successfully.";
        App::redirectTo("?view_loan_types");
    } else {
        $_SESSION['add_fail'] = true;
        $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error adding the loan type. Please try again.";
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
                            Add Loan Type
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
                                <input type="hidden" name="action" value="add_loan_type"/>
                                <input type="hidden" name="createdby" value="<?php  echo $_SESSION['userid'];  ?>"/>
                                <div class="form-group">
                                    <label for="name">Type Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="eg. Emergency Loan" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="qualification_time">Qualification Time (Months)</label>
                                    <input type="text" class="form-control" id="qualification_time" name="qualification_time" placeholder="eg. 6" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="qualification_amount">Amount Multiplier</label>
                                    <input type="text" class="form-control" id="qualification_amount" name="qualification_amount" placeholder="eg. 3" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="interest_rate">Percentage Interest Rate (Monthly)</label>
                                    <input type="text" class="form-control" id="interest_rate" name="interest_rate" placeholder="eg. 2" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="maximum_duration">Maximum Duration (Months)</label>
                                    <input type="tel" class="form-control" id="maximum_duration" name="maximum_duration" placeholder="eg. 72" required="yes"/>
                                </div>                        
                                <div class="form-group">
                                    <label for="instalment_frequency">Instalment Frequency</label>
                                    <select name="instalment_frequency" class="form-control m-b-10">          
                                       <?php echo $loans->getInstalmentFrequencies(); ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="default_rate">Percentage Loan Default Rate (Monthly)</label>
                                    <input type="text" class="form-control" id="default_rate" name="default_rate" placeholder="eg. 3" required="yes"/>
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
