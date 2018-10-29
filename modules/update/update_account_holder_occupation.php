<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$users = new Users();
$code = $_SESSION['account_holder_occupation'];
$update_type = $_GET['update_type'];
$details = $users->fetchAccountHolderOccupationDetails($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $users->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_account_holder_occupations_individual&code={$code}");
    }
} else {
    $success = $users->updateAccountHolder($code, $update_type);
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = "Record successfully updated";
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_error'] = "Error updating record";
    }
    App::redirectTo("?view_account_holder_occupations_individual&code={$code}");
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_account.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Update Account Holder Occupation Details
                        </header>




                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_account_holder_occupation"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>">
                                <div class="form-group">
                                    <label for="employment_status">Occupation/Employment Status</label> 
                                    <select name="employment_status" class="form-control tripple" required="true">
                                        <option value="">SELECT STATUS</option> 
                                        <?php // if ($details['employment_status'] == 'FORMALLY-EMPLOYED') { ?>
                                        <!--<option value="FORMALLY-EMPLOYED" selected="true">FORMALLY EMPLOYED</option>-->
                                        <?php // } else { ?>
                                        <!--<option value="FORMALLY-EMPLOYED">FORMALLY EMPLOYED</option>-->
                                        <?php // } ?>

                                        <?php if ($details['employment_status'] == 'SELF-EMPLOYED') { ?>
                                            <option value="SELF-EMPLOYED" selected="true">SELF EMPLOYED</option>
                                        <?php } else { ?>
                                            <option value="SELF-EMPLOYED">SELF EMPLOYED</option>
                                        <?php } ?>

                                        <?php if ($details['employment_status'] == 'NOT-EMPLOYED') { ?>
                                            <option value="NOT-EMPLOYED" selected="true">NOT EMPLOYED</option>
                                        <?php } else { ?>
                                            <option value="NOT-EMPLOYED">NOT EMPLOYED</option>
                                        <?php } ?>
                                        <!--                                        <option value="FORMALLY-EMPLOYED">FORMALLY EMPLOYED</option> 
                                                                                <option value="SELF-EMPLOYED">SELF EMPLOYED</option> 
                                                                                <option value="NOT-EMPLOYED">NOT EMPLOYED</option>                 -->
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
                                            <input type="text" class="form-control" name="employer_name" placeholder="eg. Safaris Limited" value="<?php echo $details['firstname']; ?>" />
                                        </div>
                                        <div class="form-group">   
                                            <label for="employer_business_type">Business Type</label>
                                            <select name="employer_business_type" class="form-control">          
                                                <?php echo $settings->getBusinessForms(); ?>
                                            </select> 
                                        </div>
                                        <div class="form-group">
                                            <label for="employer_phone_number">Office Telephone</label>
                                            <input type="text" class="form-control" name="employer_phone_number" placeholder="+256XXXXXXXXX" value="<?php echo $details['firstname']; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="employer_email">Office Email</label>
                                            <input type="email" class="form-control" name="employer_email" placeholder="eg. info@XXXXXXXXXX.com" value="<?php echo $details['firstname']; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="employer_postal_number">Postal Number</label>
                                            <input type="text" class="form-control" name="employer_postal_number" placeholder="eg. 123456" value="<?php echo $details['firstname']; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="employer_postal_code">Postal Code</label>
                                            <input type="text" class="form-control" name="employer_postal_code" placeholder="eg. 00100" value="<?php echo $details['firstname']; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="employer_town">Town</label>
                                            <input type="text" class="form-control" name="employer_town" placeholder="eg. Kampala" value="<?php echo $details['firstname']; ?>" value="<?php echo $details['firstname']; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="employment_number">Employment Number</label>
                                        <input type="text" class="form-control" name="employment_number" placeholder="eg. K00001234" value="<?php echo $details['firstname']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="payroll_number">Payroll Number</label>
                                        <input type="text" class="form-control" name="payroll_number" placeholder="eg. eg. K00001234" value="<?php echo $details['firstname']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <input type="text" class="form-control" name="department" placeholder="eg. Accounts Department" value="<?php echo $details['firstname']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="station">Station</label>
                                        <input type="text" class="form-control" name="station" placeholder="eg. Mombasa Road" value="<?php echo $details['firstname']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" class="form-control" name="location" placeholder="eg. Nairobi" value="<?php echo $details['firstname']; ?>" />
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
                                        <input type="text" class="form-control" name="employer_name" placeholder="eg. Safaris Limited" value="<?php echo $details['firstname']; ?>" />
                                    </div>
                                    <div class="form-group">   
                                        <label for="employer_business_type">Business Type</label>
                                        <select name="employer_business_type" class="form-control">          
                                            <?php echo $settings->getBusinessForms(); ?>
                                        </select> 
                                    </div>                                   
                                    <div class="form-group">
                                        <label for="location">Office Location</label>
                                        <input type="text" class="form-control" name="location" placeholder="eg. Nairobi" value="<?php echo $details['firstname']; ?>" />
                                    </div>  
                                    <div class="form-group">
                                        <label for="employer_phone_number">Office Telephone</label>
                                        <input type="text" class="form-control" name="employer_phone_number" placeholder="+256XXXXXXXXX" value="<?php echo $details['firstname']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="employer_email">Office Email</label>
                                        <input type="email" class="form-control" name="employer_email" placeholder="eg. info@XXXXXXXXXX.com" value="<?php echo $details['firstname']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="employer_postal_number">Postal Number</label>
                                        <input type="text" class="form-control" name="employer_postal_number" placeholder="eg. 123456" value="<?php echo $details['firstname']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="employer_postal_code">Postal Code</label>
                                        <input type="text" class="form-control" name="employer_postal_code" placeholder="eg. 00100" value="<?php echo $details['firstname']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="employer_town">Town</label>
                                        <input type="text" class="form-control" name="employer_town" placeholder="eg. Kampala" value="<?php echo $details['firstname']; ?>" />
                                    </div>    
                                </div>
                                <div class="NOT-EMPLOYED boxout">                                    
                                    <div class="form-group">
                                        <label for="income_source_description">Description of Source of Income</label>
                                        <input type="text" class="form-control" name="income_source_description" placeholder="eg. Car Taxi Services" value="<?php echo $details['firstname']; ?>" />
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




                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_account_holder"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>">
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?php echo $details['firstname']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="middlename">Middle Name</label>
                                    <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle Name" value="<?php echo $details['middlename']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $details['lastname']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-control">          
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="idnumber">ID Number</label>
                                    <input type="number" class="form-control" id="idnumber" name="idnumber" placeholder="ID Number" value="<?php echo $details['idnumber']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="date-group">Birth Date</label>
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
                                    <label for="nationality">Nationality</label>
                                    <select name="nationality" class="form-control">          
                                        <?php echo $settings->getNationalities(); ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="is_signatory">Signatory</label>
                                    <?php if ($details['is_signatory'] == 1) { ?>
                                        <input type="radio" name="is_signatory" value="1" required="true" checked="checked"/> Yes 
                                        <input type="radio" name="is_signatory" value="0" required="true"/> No
                                    <?php } else if ($details['is_signatory'] == 0) { ?>
                                        <input type="radio" name="is_signatory" value="1" required="true"/> Yes 
                                        <input type="radio" name="is_signatory" value="0" required="true" checked="checked"/> No
                                    <?php } ?>
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
