<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Transactions.php";
$transactions = new Transactions();
$settings = new Settings();
$users = new Users();

if (!empty($_POST)) {
    $_SESSION['employment_status'] = $_POST['employment_status'];
    $_SESSION['monthly_income_range'] = $_POST['monthly_income_range'];
    if ($_POST['employment_status'] == "FORMALLY-EMPLOYED") {
        $_SESSION['employer'] = $_POST['employer'];
        if ($_POST['employer'] == "OTHER") {
            $_SESSION['company_name'] = $_POST['employer_name'];
            $_SESSION['company_business_type'] = $_POST['employer_business_type'];
            $_SESSION['company_location'] = $_POST['employer_location'];
            $_SESSION['company_phone_number'] = $_POST['employer_phone_number'];
            $_SESSION['company_email'] = $_POST['employer_email'];
            $_SESSION['company_postal_number'] = $_POST['employer_postal_number'];
            $_SESSION['company_postal_code'] = $_POST['employer_postal_code'];
            $_SESSION['company_town'] = $_POST['employer_town'];
        }
        $_SESSION['employment_number'] = $_POST['employment_number'];
        $_SESSION['payroll_number'] = $_POST['payroll_number'];
        $_SESSION['department'] = $_POST['department'];
        $_SESSION['station'] = $_POST['station'];
        $_SESSION['employment_terms'] = $_POST['employment_terms'];
        $_SESSION['employment_termination_date'] = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];

        //N/A Fields
        $_SESSION['income_source_description'] = 'N/A';
    } else if ($_POST['employment_status'] == "SELF-EMPLOYED") {
        $_SESSION['company_name'] = $_POST['company_name'];
        $_SESSION['company_business_type'] = $_POST['company_business_type'];
        $_SESSION['company_location'] = $_POST['company_location'];
        $_SESSION['company_phone_number'] = $_POST['company_phone_number'];
        $_SESSION['company_email'] = $_POST['company_email'];
        $_SESSION['company_postal_number'] = $_POST['company_postal_number'];
        $_SESSION['company_postal_code'] = $_POST['company_postal_code'];
        $_SESSION['company_town'] = $_POST['company_town'];

        //N/A Fields
        $_SESSION['employer'] = 'N/A';
        $_SESSION['employment_number'] = 'N/A';
        $_SESSION['payroll_number'] = 'N/A';
        $_SESSION['department'] = 'N/A';
        $_SESSION['station'] = 'N/A';
        $_SESSION['employment_terms'] = 'N/A';
        $_SESSION['employment_termination_date'] = 'N/A';
        $_SESSION['income_source_description'] = 'N/A';
    } else if ($_POST['employment_status'] == "NOT-EMPLOYED") {
        $_SESSION['income_source_description'] = $_POST['income_source_description'];

        //N/A Fields
        $_SESSION['employer'] = 'N/A';
        $_SESSION['company_name'] = 'N/A';
        $_SESSION['company_business_type'] = 'N/A';
        $_SESSION['company_location'] = 'N/A';
        $_SESSION['company_phone_number'] = 'N/A';
        $_SESSION['company_email'] = 'N/A';
        $_SESSION['company_postal_number'] = 'N/A';
        $_SESSION['company_postal_code'] = 'N/A';
        $_SESSION['company_town'] = 'N/A';
        $_SESSION['employment_number'] = 'N/A';
        $_SESSION['payroll_number'] = 'N/A';
        $_SESSION['department'] = 'N/A';
        $_SESSION['station'] = 'N/A';
        $_SESSION['employment_terms'] = 'N/A';
        $_SESSION['employment_termination_date'] = 'N/A';
    }

//    if (isset($_SESSION['account'])) {
//    App::redirectTo("?add_account_nominee");
    
    App::redirectTo("?add_contact&ref_type={$_SESSION['ref_type']}");
//    }
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_new_account.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            <strong>ACCOUNT HOLDER'S OCCUPATION</strong>
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <div class="form-group">
                                    <label for="employment_status">Occupation/Employment Status</label> 
                                    <select name="employment_status" class="form-control tripple" required="true">
                                        <option value="">SELECT STATUS</option> 
                                        <option value="FORMALLY-EMPLOYED">FORMALLY EMPLOYED</option> 
                                        <option value="SELF-EMPLOYED">SELF EMPLOYED</option> 
                                        <option value="NOT-EMPLOYED">NOT EMPLOYED</option>                 
                                    </select> 
                                </div>
                                <div class="FORMALLY-EMPLOYED boxout">
                                    <div class="form-group">
                                        <label for="employer">Select Employer</label>
                                        <select name="employer" class="form-control double">          
                                            <?php echo $users->getCorporates(); ?>
                                        </select> 
                                    </div>
                                    <div class="OTHER boxout">
                                        <div class="form-group">
                                            <label for="employer_name">Employer Name</label>
                                            <input type="text" class="form-control" name="employer_name" placeholder="eg. Safaris Limited" />
                                        </div>
                                        <div class="form-group">   
                                            <label for="employer_business_type">Business Type</label>
                                            <select name="employer_business_type" class="form-control">          
                                                <?php echo $settings->getBusinessForms(); ?>
                                            </select> 
                                        </div>
                                        <div class="form-group">
                                            <label for="employer_phone_number">Office Telephone</label>
                                            <input type="text" class="form-control" name="employer_phone_number" placeholder="+256XXXXXXXXX" />
                                        </div>
                                        <div class="form-group">
                                            <label for="employer_email">Office Email</label>
                                            <input type="email" class="form-control" name="employer_email" placeholder="eg. info@XXXXXXXXXX.com" />
                                        </div>
                                        <div class="form-group">
                                            <label for="employer_postal_number">Postal Number</label>
                                            <input type="text" class="form-control" name="employer_postal_number" placeholder="eg. 123456" />
                                        </div>
                                        <div class="form-group">
                                            <label for="employer_postal_code">Postal Code</label>
                                            <input type="text" class="form-control" name="employer_postal_code" placeholder="eg. 00100" />
                                        </div>
                                        <div class="form-group">
                                            <label for="employer_town">Town</label>
                                            <input type="text" class="form-control" name="employer_town" placeholder="eg. Kampala" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="employment_number">Employment Number</label>
                                        <input type="text" class="form-control" name="employment_number" placeholder="eg. K00001234" />
                                    </div>
                                    <div class="form-group">
                                        <label for="payroll_number">Payroll Number</label>
                                        <input type="text" class="form-control" name="payroll_number" placeholder="eg. eg. K00001234" />
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <input type="text" class="form-control" name="department" placeholder="eg. Accounts Department" />
                                    </div>
                                    <div class="form-group">
                                        <label for="station">Station</label>
                                        <input type="text" class="form-control" name="station" placeholder="eg. Mombasa Road" />
                                    </div>
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" class="form-control" name="location" placeholder="eg. Nairobi" />
                                    </div>
                                    <div class="form-group">
                                        <label for="employment_terms">Terms of Employment</label>
                                        <select name="employment_terms" class="form-control one">
                                            <option value="PERMANENT">PERMANENT</option> 
                                            <option value="CONTRACT">CONTRACT</option>                  
                                        </select> 
                                    </div>
                                    <div class="form-group">
                                        <label for="date-group">Retirement/Termination Date</label>
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
                                </div>
                                <div class="SELF-EMPLOYED boxout">
                                    <div class="form-group">
                                        <label for="employer_name">Business/Company Name</label>
                                        <input type="text" class="form-control" name="employer_name" placeholder="eg. Safaris Limited" />
                                    </div>
                                    <div class="form-group">   
                                        <label for="employer_business_type">Business Type</label>
                                        <select name="employer_business_type" class="form-control">          
                                            <?php echo $settings->getBusinessForms(); ?>
                                        </select> 
                                    </div>                                   
                                    <div class="form-group">
                                        <label for="location">Office Location</label>
                                        <input type="text" class="form-control" name="location" placeholder="eg. Nairobi" />
                                    </div>  
                                    <div class="form-group">
                                        <label for="employer_phone_number">Office Telephone</label>
                                        <input type="text" class="form-control" name="employer_phone_number" placeholder="+256XXXXXXXXX" />
                                    </div>
                                    <div class="form-group">
                                        <label for="employer_email">Office Email</label>
                                        <input type="email" class="form-control" name="employer_email" placeholder="eg. info@XXXXXXXXXX.com" />
                                    </div>
                                    <div class="form-group">
                                        <label for="employer_postal_number">Postal Number</label>
                                        <input type="text" class="form-control" name="employer_postal_number" placeholder="eg. 123456" />
                                    </div>
                                    <div class="form-group">
                                        <label for="employer_postal_code">Postal Code</label>
                                        <input type="text" class="form-control" name="employer_postal_code" placeholder="eg. 00100" />
                                    </div>
                                    <div class="form-group">
                                        <label for="employer_town">Town</label>
                                        <input type="text" class="form-control" name="employer_town" placeholder="eg. Kampala" />
                                    </div>    
                                </div>
                                <div class="NOT-EMPLOYED boxout">                                    
                                    <div class="form-group">
                                        <label for="income_source_description">Description of Source of Income</label>
                                        <input type="text" class="form-control" name="income_source_description" placeholder="eg. Car Taxi Services"/>
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <label for="monthly_income_range">Estimated Monthly Income</label>
                                    <select name="monthly_income_range" class="form-control one">
                                        <option value="0-20000">0-20000</option> 
                                        <option value="20001-50000">20001-50000</option>   
                                        <option value="50001-100000">50001-100000</option> 
                                        <option value="OVER 100000">OVER 100000</option> 
                                    </select> 
                                </div>
                                <br /><button type="submit" class="btn btn-info">Next</button>
                            </form>
                        </div>
                    </section>
                </div>        
            </div>
        </section>
    </aside>
</div>
