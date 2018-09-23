<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Transitional.php";
$transitional_data = new Transitional();
$loans = new Loans();
if (!empty($_POST)) {
    if (isset($_SESSION['transitional_data'])) {
        $success = $transitional_data->execute();
        if ($success['status'] == 200) {
            $_SESSION['add_success'] = true;
        }
        App::redirectTo("?view_loans_individual&code={$_SESSION['loan']}");
    } else {
        $_SESSION['bank'] = $_POST['bank'];
        $_SESSION['branch'] = $_POST['branch'];
        $_SESSION['organization'] = $_POST['organization'];
        $_SESSION['loan_amount'] = $_POST['loan_amount'];
        $_SESSION['date_issued'] = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
        $_SESSION['external_source'] = $_POST['external_source'];
        $_SESSION['description'] = $_POST['description'];
        $_SESSION['source_amount'] = $_POST['source_amount'];
        App::redirectTo("?add_loan_guarantor");
    }
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_loans.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Add External Loan Data
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <?php if (isset($_SESSION['transitional_data'])) { ?>
                                    <input type="hidden" name="action" value="transitional_add_loan_external_data"/>
                                    <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid'];       ?>"/>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="bank">Bank Name</label>
                                    <input type="text" class="form-control" id="bank" name="bank" placeholder="Bank Name" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="branch">Branch Name</label>
                                    <input type="text" class="form-control" id="branch" name="branch" placeholder="Branch Name" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="organization">External Loan Source</label>
                                    <input type="text" class="form-control" id="organization" name="organization" placeholder="Organization Name" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="loan_amount">Loan Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="loan_amount" name="loan_amount" placeholder="Loan Amount" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="date-group">Date of Issue</label>
                                    <div class="row" id="date-group">
                                        <div class="col-lg-3">
                                            <select id="day" name="day" class="form-control">          
                                                <?php include 'modules/snippets/day.php'; ?>
                                            </select> 
                                        </div>
                                        <div class="col-lg-6">
                                            <select id="month" name="month" class="form-control">          
                                                <?php include 'modules/snippets/month.php'; ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <select id="year" name="year" class="form-control">  
                                                <?php include 'modules/snippets/year.php'; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="external_source">Do you have an External Source of Income</label>
                                    <select name="external_source" class="form-control">    
                                        <option id="hide" value="0">NO</option>
                                        <option id="show" value="1">YES</option>
                                    </select> 
                                </div>
                                <div id="show_hide">
                                    <div class="form-group">
                                        <label for="description">Description/Type of External Source of Income</label>
                                        <input type="text" class="form-control" id="description" name="description" placeholder="Description/Type of External Source of Income" />
                                    </div>
                                    <div class="form-group">
                                        <label for="source_amount">Monthly Income from External Source in <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                        <input type="number" class="form-control" id="source_amount" name="source_amount" placeholder="Monthly Income from External Source in KES." />
                                    </div>
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