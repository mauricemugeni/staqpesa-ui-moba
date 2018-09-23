<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();

//  $project_details = $funding->fetchProjectDetails($_SESSION['project']);
//  $project_bid_balance_details = $funding->fetchProjectBidsBalanceDetails($_SESSION['project']);

if (!empty($_POST)) {

    $filename = md5($_POST['createdby'] . time());
    $incorporation_certificate_name = $_FILES['incorporation_certificate']['name'];
    $tmp_name = $_FILES['incorporation_certificate']['tmp_name'];
    $extension = substr($incorporation_certificate_name, strpos($incorporation_certificate_name, '.') + 1);
    $incorporation_certificate = strtoupper($filename . '.' . $extension);
    $_SESSION['incorporation_certificate'] = $incorporation_certificate;
    $location = 'modules/images/customers/certificates/institutions/';
    
    move_uploaded_file($tmp_name, $location . $incorporation_certificate);
    
    $success = $settings->execute();    
    if ($success['status'] == 200) {
        $_SESSION['add_success'] = true;
        $_SESSION['feedback_message'] = "<strong>Successful:</strong> The institution has been created successfully.";
        App::redirectTo("?view_institutions");
    } else {
        $_SESSION['add_fail'] = true;
        $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error creating the institution. Please try again.";
    }
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_account.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Institution
                            <?php
                            if (isset($_SESSION['add_fail'])) {
                                echo $_SESSION['add_record_fail'];
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['add_fail']);
                            }
                            ?>
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST"  enctype="multipart/form-data">
                                <input type="hidden" name="action" value="add_institution"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
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
<!--                                <div class="form-group">
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
                                </div>-->
                                <!--<br><br>-->
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
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>
