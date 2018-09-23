<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Transactions.php";
$transactions = new Transactions();
$settings = new Settings();
$users = new Users();

//$_SESSION['account_category_details'] = $settings->fetchAccountCategoryDetails($_SESSION['account_category']);

if (!empty($_POST)) {

    if ($_SESSION['account_category_details']['name'] == "GROUP ACCOUNT") {
        $filename = md5($_SESSION['createdby'] . time());
        $incorporation_certificate_name = $_FILES['incorporation_certificate']['name'];
        $tmp_name = $_FILES['incorporation_certificate']['tmp_name'];
        $extension = substr($incorporation_certificate_name, strpos($incorporation_certificate_name, '.') + 1);
        $incorporation_certificate = strtoupper($filename . '.' . $extension);
        $_SESSION['incorporation_certificate'] = $incorporation_certificate;
        $location = 'modules/images/customers/certificates/';

        $_SESSION['company_name'] = $_POST['company_name'];
        $_SESSION['company_registration_number'] = $_POST['company_registration_number'];
        $_SESSION['company_business_type'] = $_POST['company_business_type'];
        $_SESSION['company_registration_date'] = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
        $_SESSION['company_phone_number'] = $_POST['company_phone_number'];
        $_SESSION['company_email'] = $_POST['company_email'];
        $_SESSION['company_postal_number'] = $_POST['company_postal_number'];
        $_SESSION['company_postal_code'] = $_POST['company_postal_code'];
        $_SESSION['company_town'] = $_POST['company_town'];
        $_SESSION['contact_person_firstname'] = $_POST['contact_person_firstname'];
        $_SESSION['contact_person_lastname'] = $_POST['contact_person_lastname'];
        $_SESSION['contact_person_phone_number'] = $_POST['contact_person_phone_number'];
        $_SESSION['contact_person_email'] = $_POST['contact_person_email'];

        move_uploaded_file($tmp_name, $location . $incorporation_certificate);

//        App::redirectTo("?add_account_banking");        
//        $success = $users->addAccount();        
//        if ($success['status'] == 200) {
//            $_SESSION['add_success'] = true;
//        }
//        App::redirectTo("?view_accounts");
    } else if ($_SESSION['account_category_details']['name'] == "INDIVIDUAL ACCOUNT") {
        $_SESSION['is_employed'] = $_POST['is_employed'];
        $_SESSION['employer'] = $_POST['employer'];
        $_SESSION['company_name'] = $_POST['employer_name'];
        $_SESSION['company_business_type'] = $_POST['employer_business_type'];
        $_SESSION['company_phone_number'] = $_POST['employer_phone_number'];
        $_SESSION['company_email'] = $_POST['employer_email'];
        $_SESSION['company_postal_number'] = $_POST['employer_postal_number'];
        $_SESSION['company_postal_code'] = $_POST['employer_postal_code'];
        $_SESSION['company_town'] = $_POST['employer_town'];
        $_SESSION['external_source'] = $_POST['external_source'];
        $_SESSION['description'] = $_POST['description'];
        $_SESSION['source_amount'] = $_POST['source_amount'];
    }

    if (isset($_SESSION['account'])) {
        App::redirectTo("?add_account_banking");
    }
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php
            require_once('modules/menus/sub_menu_account.php');
            if ($_SESSION['account_category_details']['name'] == "GROUP ACCOUNT") {
                ?>
                <div class="row">
                    <div class="col-lg-6">
                        <section class="panel">
                            <header class="panel-heading">
                                Organization Details
                            </header>
                            <div class="panel-body">
                                <form role="form" method="POST"  enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="company_name">Institution Name</label>
                                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="eg. Safaris Limited" required="yes"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="company_registration_number">Registration Number</label>
                                        <input type="text" class="form-control" id="company_registration_number" name="company_registration_number" placeholder="eg. ABCXYZ/2017" required="yes"/>
                                    </div>

                                    <div class="form-group">   
                                        <label for="company_business_type">Business Type</label>
                                        <select name="company_business_type" class="form-control">          
                                            <?php echo $settings->getBusinessForms(); ?>
                                        </select> 
                                    </div>
                                    <div class="form-group">
                                        <label for="date-group">Date Established/Incorporated</label>
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
                                        <label for="company_phone_number">Office Telephone</label>
                                        <input type="text" class="form-control" name="company_phone_number" placeholder="+256XXXXXXXXX" required="yes"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="company_email">Office Email</label>
                                        <input type="email" class="form-control" name="company_email" placeholder="eg. info@XXXXXXXXXX.com" required="yes"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="company_postal_number">Postal Number</label>
                                        <input type="text" class="form-control" id="company_postal_number" name="company_postal_number" placeholder="eg. 123456" required="yes"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="postal_code">Postal Code</label>
                                        <input type="text" class="form-control" id="company_postal_code" name="company_postal_code" placeholder="eg. 00100" required="yes"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="town">Town</label>
                                        <input type="text" class="form-control" id="company_town" name="company_town" placeholder="eg. Kampala" required="yes"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_person">Organization's contact person </label>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="contact_person_firstname" placeholder="First Name" required="yes"/>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="contact_person_lastname" placeholder="Last Name" required="yes"/>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="form-group">
                                        <div class="col-lg-6">
                                            <input type="tel" class="form-control" name="contact_person_phone_number" placeholder="Phone Number" required="yes"/>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="email" class="form-control" name="contact_person_email" placeholder="Email Address" required="yes"/>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="form-group">
                                        <label for="incorporation_certificate">Certificate of Incorporation</label>
                                        <input type="file" name="incorporation_certificate" />
                                    </div>
                                    <br /><button type="submit" class="btn btn-info">Next</button>
                                </form>

                            </div>
                        </section>
                    </div>        
                </div><!--row1-->
            <?php } else if ($_SESSION['account_category_details']['name'] == "INDIVIDUAL ACCOUNT") {
                ?>
                <div class="row">
                    <div class="col-lg-6">
                        <section class="panel">
                            <header class="panel-heading">
                                Further Details
                            </header>
                            <div class="panel-body">

                                <form role="form" method="POST">
                                    <div class="form-group">
                                        <label for="is_employed">Are you in formal employment?</label>
                                        <select name="is_employed" class="form-control one">
                                            <option value="YES">YES</option>     
                                            <option value="NO">NO</option>                               
                                        </select> 
                                    </div>
                                    <div class="form-group YES boxed">
                                        <label for="employer">Select Employer</label>
                                        <select name="employer" class="form-control double">          
                                            <?php echo $users->getCorporates(); ?>
                                        </select> 
                                    </div>
                                    <div class="other boxing">
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
                                        <label for="external_source">Do you have an External Source of Income</label>
                                        <select name="external_source" class="form-control tripple">    
                                            <option  value="NO-2">NO</option>
                                            <option  value="YES-2">YES</option>
                                        </select> 
                                    </div>
                                    
                                    <div class="YES-2 boxout">
                                        <div class="form-group">
                                            <label for="description">Description/Type of External Source of Income</label>
                                            <input type="text" class="form-control" id="description" name="description" placeholder="eg. Car Taxi Services" />
                                        </div>
                                        <div class="form-group">
                                            <label for="source_amount">Monthly Income from External Source in <?php echo '(' . $_SESSION['chapter_details']['currency'] . ')'; ?></label>
                                            <input type="number" class="form-control" id="source_amount" name="source_amount" placeholder="eg. 500000" />
                                        </div>
                                    </div>
                                    
                                    <br /><button type="submit" class="btn btn-info">Next</button>
                                </form>

                            </div>
                        </section>
                    </div>        
                </div><!--row1-->
            <?php } ?>

        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>
