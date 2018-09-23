<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Transactions.php";
$transactions = new Transactions();
$settings = new Settings();
$users = new Users();
$code = $_SESSION['account'];
$update_type = $_GET['update_type'];
$details = $users->fetchAccountDetails($code);

if ($details['employer'] != NULL) {
    $corporate_details = $users->fetchCorporateDetails($details['employer']);
}

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $users->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_accounts");
    }
} else {
    $success = $users->updateAccount($code, $update_type);
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = "Record successfully updated";
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_error'] = "Error updating record";
    }
    App::redirectTo("?view_accounts");
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
                            Update Account
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_account"/>
                                <input type="hidden" name="employer" value="<?php echo $details['employer']; ?>">
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>">

                                <div class="form-group">
                                    <label for="account_name">Account Name</label>
                                    <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Name" value="<?php echo $details['account_name']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="account_type">Account Type</label>
                                    <select name="account_type" class="form-control">          
                                        <?php echo $settings->getAccountTypes(); ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="account_category">Account Category</label>
                                    <select name="account_category" class="form-control">          
                                        <?php echo $settings->getAccountCategories(); ?>
                                    </select> 
                                </div>
                                <?php if ((isset($_SESSION['staqpesa_admin']) AND $_SESSION['staqpesa_admin'] == true) OR (isset($_SESSION['staqpesa_staff']) AND $_SESSION['staqpesa_staff'] == true)) { ?>                                
                                <div class="form-group">
                                    <label for="branch">Branch</label>
                                    <select name="branch" class="form-control">          
                                        <?php echo $settings->getBranches(); ?>
                                    </select> 
                                </div>                                
                                <?php } else if ((isset($_SESSION['institution_admin']) AND $_SESSION['institution_admin'] == true) OR (isset($_SESSION['institution_staff']) AND $_SESSION['institution_staff'] == true)) { ?>
                                <div class="form-group">
                                    <label for="branch">Branch</label>
                                    <select name="branch" class="form-control">          
                                        <?php echo $settings->getInstitutionBranches($_SESSION['user_details']['institution']); ?>
                                    </select> 
                                </div>
                                
                                <?php } ?>
                                
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

                                <?php if ($details['employer'] != NULL) { ?>
                                    <h4 id="divider">Employer's/Company's Details</h4>
                                    <div class="form-group">
                                        <label for="company_name">Employer's/Company's Name</label>
                                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Employer's/Company's Name"  value="<?php echo $corporate_details['company_name']; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="company_business_type">Employer's/Company's Occupation/Business</label>
                                        <input type="text" class="form-control" id="company_business_type" name="company_business_type" placeholder="Employer's/Company's Occupation/Business"  value="<?php echo $corporate_details['business_type']; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="company_postal_number">Postal Number</label>
                                        <input type="number" class="form-control" id="company_postal_number" name="company_postal_number" placeholder="Postal Number"  value="<?php echo $corporate_details['postal_number']; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="company_postal_code">Postal Code</label>
                                        <input type="number" class="form-control" id="company_postal_code" name="company_postal_code" placeholder="Postal Code"  value="<?php echo $corporate_details['postal_code']; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="company_town">Town</label>
                                        <input type="text" class="form-control" id="company_town" name="company_town" placeholder="Town"  value="<?php echo $corporate_details['town']; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="company_phone_number">Telephone Number</label>
                                        <input type="number" class="form-control" id="company_phone_number" name="company_phone_number" placeholder="Telephone Number" value="<?php echo $corporate_details['phone_number']; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="company_email">Email Address</label>
                                        <input type="email" class="form-control" id="company_email" name="company_email" placeholder="Email Address" value="<?php echo $corporate_details['email']; ?>" />
                                    </div>
                                <?php } ?>

                                <h4 id="divider">Banking Details</h4>
                                <div class="form-group">
                                    <label for="other_account">Do you have any other account(s) with any bank, sacco or micro-finance</label>
                                    <select name="other_account" class="form-control">    
                                        <option value="NO">NO</option>
                                        <option value="YES">YES</option>                                
                                    </select> 
                                </div>
                                <!--                                <div id="show_hide">                            
                                                                    <h4 id="divider">First Institution</h4>    -->
                                <div class="YES box">                            
                                    <h4 id="divider">First Institution</h4>
                                    <div class="form-group">
                                        <label for="other_account_number1">Account Number</label>
                                        <input type="text" class="form-control" id="other_account_number1" name="other_account_number1" placeholder="Account Number" value="<?php echo $details['account_number1']; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="other_account_bank1">Bank Name</label>
                                        <input type="text" class="form-control" id="other_account_bank1" name="other_account_bank1" placeholder="Bank Name" value="<?php echo $details['account_bank1']; ?>"  />
                                    </div>
                                    <div class="form-group">
                                        <label for="other_account_branch1">Branch Name</label>
                                        <input type="text" class="form-control" id="other_account_branch1" name="other_account_branch1" placeholder="Branch Name" value="<?php echo $details['account_branch1']; ?>"  />
                                    </div>
                                    <h4 id="divider">Second Institution</h4>
                                    <div class="form-group">
                                        <label for="other_account_number2">Account Number</label>
                                        <input type="text" class="form-control" id="other_account_number2" name="other_account_number2" placeholder="Account Number" value="<?php echo $details['account_number2']; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="other_account_bank2">Bank Name</label>
                                        <input type="text" class="form-control" id="other_account_bank2" name="other_account_bank2" placeholder="Bank Name" value="<?php echo $details['account_bank2']; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="other_account_branch2">Branch Name</label>
                                        <input type="text" class="form-control" id="other_account_branch2" name="other_account_branch2" placeholder="Branch Name" value="<?php echo $details['account_branch2']; ?>"/>
                                    </div>
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
