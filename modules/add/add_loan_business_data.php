<?php
//if (!App::isLoggedIn()) App::redirectTo("?");
//require_once WPATH . "modules/menus/tmenu.php";
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
        $_SESSION['business_type'] = $_POST['business_type'];
        $_SESSION['business_form'] = $_POST['business_form'];
        $_SESSION['business_time'] = $_POST['business_time'];
        $_SESSION['stock_value'] = $_POST['stock_value'];
        $_SESSION['daily_sales'] = $_POST['daily_sales'];
        $_SESSION['monthly_income'] = $_POST['monthly_income'];
        $_SESSION['monthly_expenses'] = $_POST['monthly_expenses'];
        $_SESSION['employees'] = $_POST['employees'];
        $_SESSION['licensed'] = $_POST['licensed'];
        $_SESSION['road'] = $_POST['road'];
        $_SESSION['street'] = $_POST['street'];
        $_SESSION['location'] = $_POST['location'];
        $_SESSION['building'] = $_POST['building'];
        $_SESSION['house_number'] = $_POST['house_number'];

        App::redirectTo("?add_loan_guarantor");
    }
}
?>


<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_loans.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Customer Loan Business Data
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <?php if (isset($_SESSION['transitional_data'])) { ?>
                                    <input type="hidden" name="action" value="transitional_add_loan_business_data"/>
                                    <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <?php } ?>  
                                <div class="form-group">   
                                    <label for="business_type">Business Type</label>
                                    <select name="business_type" class="form-control">          
                                        <?php echo $settings->getBusinessTypes(); ?>
                                    </select> 
                                </div>
                                <div class="form-group">  
                                    <label for="business_form">Business Form</label>
                                    <select name="business_form" class="form-control">          
                                        <?php echo $settings->getBusinessForms(); ?>
                                    </select> 
                                </div>
                                <div class="form-group">  
                                    <label for="business_time">Business Age in Years</label>
                                    <input type="number" class="form-control" id="business_time" name="business_time" placeholder="eg. 10" required="yes"/>
                                </div>
                                <div class="form-group">  
                                    <label for="stock_value">Stock Value in <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="stock_value" name="stock_value" placeholder="eg. 500000" required="yes"/>
                                </div>
                                <div class="form-group">  
                                    <label for="daily_sales">Daily Sales in <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="daily_sales" name="daily_sales" placeholder="eg. 500000" required="yes"/>
                                </div>
                                <div class="form-group">  
                                    <label for="monthly_income">Monthly Income in <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="monthly_income" name="monthly_income" placeholder="eg. 500000" required="yes"/>
                                </div>
                                <div class="form-group">  
                                    <label for="monthly_expenses">Monthly Expenses in <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="monthly_expenses" name="monthly_expenses" placeholder="eg. 500000" required="yes"/>
                                </div>
                                <div class="form-group">  
                                    <label for="employees">No. of Employees</label>
                                    <input type="number" class="form-control" id="employees" name="employees" placeholder="eg. 20" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="licensed">Is Business Licensed</label>
                                    <select name="licensed" class="form-control">          
                                        <option value="YES">YES</option>
                                        <option value="NO">NO</option>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="road">Road Near Business</label>
                                    <input type="text" class="form-control" id="road" name="road" placeholder="eg. Mombasa Road" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="street">Street Near Business</label>
                                    <input type="text" class="form-control" id="street" name="street" placeholder="eg. Tom Mboya Street" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" id="location"  name="location" placeholder="eg. Umoja One" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="building">Building</label>
                                    <input type="text" class="form-control" id="building" name="building" placeholder="eg. Rentford House" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="house_number">House Number</label>
                                    <input type="text" class="form-control" id="house_number" name="house_number" placeholder="eg. A132"/>
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