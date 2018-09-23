<?php
if (!App::isLoggedIn())
    App::redirectTo("?login");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Transitional.php";
$transitional_data = new Transitional();
$settings = new Settings();
$loans = new Loans();
if (!empty($_POST)) {
    if (isset($_SESSION['transitional_data'])) {
        $success = $transitional_data->execute();
        if ($success['status'] == 200) {
            $_SESSION['add_success'] = true;
        }
        App::redirectTo("?view_loans_individual&code={$_SESSION['loan']}");
    } else {
        $_SESSION['marital_status'] = $_POST['marital_status'];
        $_SESSION['spouse_firstname'] = $_POST['spouse_firstname'];
        $_SESSION['spouse_middlename'] = $_POST['spouse_middlename'];
        $_SESSION['spouse_lastname'] = $_POST['spouse_lastname'];
        $_SESSION['dependants'] = $_POST['dependants'];
        $_SESSION['landmark'] = $_POST['landmark'];
        $_SESSION['purpose'] = $_POST['purpose'];
        App::redirectTo("?add_loan_external_data");
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
                            Add Loan Information
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <?php if (isset($_SESSION['transitional_data'])) { ?>
                                    <input type="hidden" name="action" value="transitional_add_loan_data"/>
                                    <input type="hidden" name="createdby" value="<?php //echo $_SESSION['userid'];     ?>"/>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="marital_status">Marital Status</label>
                                    <select name="marital_status" onchange="checkSpouseDetails(this.value);" class="form-control">          
                                        <?php //echo $settings->getMaritalStatuses(); ?>
                                    </select> 
                                </div>
                                <div id="show_hide">
                                    <div class="form-group">
                                        <label for="spouse_firstname">Spouse First Name(if married/engaged)</label>
                                        <input type="text" class="form-control" id="spouse_firstname" name="spouse_firstname" placeholder="Spouse First Name(if married/engaged)"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="spouse_middlename">Spouse Middle Name(if married/engaged)</label>
                                        <input type="text" class="form-control" id="spouse_middlename" name="spouse_middlename" placeholder="Spouse Middle Name(if married/engaged)"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="spouse_lastname">Spouse Last Name(if married/engaged)</label>
                                        <input type="text" class="form-control" id="spouse_lastname" name="spouse_lastname" placeholder="Spouse Last Name(if married/engaged)"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="dependants">No. of Dependants</label>
                                    <input type="number" class="form-control" id="dependants" name="dependants" placeholder="No. of Dependants" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="landmark">Landmark</label>
                                    <input type="text" class="form-control" id="landmark" name="landmark" placeholder="Landmark" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="purpose">Purpose of Loan</label>
                                    <input type="text" class="form-control" id="purpose" name="purpose" placeholder="Purpose of Loan" required="yes"/>
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
