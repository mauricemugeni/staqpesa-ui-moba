<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Loans.php";
$loans = new Loans();
$users = new Users();

if (isset($_SESSION['has_banking_details']) AND $_SESSION['has_banking_details'] == true) {
    $banking_details = $users->fetchAccountBankingDtlDetails();
}

if (!empty($_POST)) {
    if (isset($_SESSION['has_banking_details']) AND $_SESSION['has_banking_details'] == false) {
        $add_account_banking_details = $users->addAccountBankingDetails();
        
        if ($add_account_banking_details['status'] == 200) {
            $banking_details = $users->fetchAccountBankingDtlDetails();
        } else {
            $_SESSION['add_banking_details_fail'] = true;
            $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error creating the banking details entered. Please try again.";
            App::redirectTo("?add_account_banking");
        }
    }

    $_SESSION['delivery_method'] = $_POST['delivery_method'];
    $_SESSION['banking_details_id'] = $banking_details['id'];

    if (isset($_SESSION['transitional_data'])) {
        $success = $transitional_data->execute();
        if ($success['status'] == 200) {
            $_SESSION['add_success'] = true;
            $_SESSION['feedback_message'] = "<strong>Successful:</strong> The loan application has been submitted successfully. You shall be notified once the approval has been finalized.";
            App::redirectTo("?view_loans");
        } else {
            $_SESSION['add_fail'] = true;
            $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error submitting your loan application. Please try applying again.";
        }
    } else {
        $success = $loans->execute();
        if ($success['status'] == 200) {
            $_SESSION['add_success'] = true;
            $_SESSION['feedback_message'] = "<strong>Successful:</strong> The loan application has been submitted successfully. You shall be notified once the approval has been finalized.";
            App::redirectTo("?view_loans");
        } else {
            $_SESSION['add_fail'] = true;
            $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error submitting your loan application. Please try applying again.";
        }
    }
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
                            Banking Details
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <?php if (isset($_SESSION['transitional_data'])) { ?>
                                    <input type="hidden" name="action" value="transitional_add_loan_guarantor"/>
                                    <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <?php } else { ?>                        
                                    <input type="hidden" name="action" value="add_loan">
                                <?php } ?>

                                <div class="form-group">
                                    <label for="delivery_method">How would you like to receive the cash?</label>
                                    <select name="delivery_method" class="form-control" required="true">  
                                        <option value="">Select cash delivery method</option>
                                        <option value="MOBILE-MONEY">Mobile Number</option>
                                        <option value="BANK">Bank</option>                                
                                    </select> 
                                </div>
                                <div class="MOBILE-MONEY box">
                                    <?php if (isset($_SESSION['has_banking_details']) AND $_SESSION['has_banking_details'] == true) { ?>
                                        <div class="form-group">
                                            <label for="mobile_service_provider">Mobile network service provider</label>
                                            <input type="text" class="form-control" id="mobile_service_provider" name="mobile_service_provider" placeholder="<?php echo $banking_details['mobile_service_provider']; ?>" readonly="true"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile_number">Mobile Number</label>
                                            <input type="tel" class="form-control" id="mobile_number" name="mobile_number" placeholder="<?php echo $banking_details['mobile_number']; ?>" readonly="true"/>
                                        </div>
                                    <?php } else if (isset($_SESSION['has_banking_details']) AND $_SESSION['has_banking_details'] == false) { ?>
                                        <div class="form-group">
                                            <label for="mobile_service_provider">Mobile network service provider</label>
                                            <select name="mobile_service_provider" class="form-control">    
                                                <option value="SAFARICOM">Safaricom</option>
                                                <option value="AIRTEL">Airtel</option>  
                                                <option value="ORANGE">Orange</option>  
                                            </select> 
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile_number">Mobile Number</label>
                                            <input type="tel" class="form-control" id="mobile_number" name="mobile_number" placeholder="eg. +2567XXXXXXXX"/>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="BANK box"> 
                                    <?php if (isset($_SESSION['has_banking_details']) AND $_SESSION['has_banking_details'] == true) { ?>
                                        <div class="form-group">
                                            <label for="bank_account_number">Account Number</label>
                                            <input type="text" class="form-control" name="bank_account_number" placeholder="<?php echo $banking_details['bank_account_number']; ?>" readonly="true"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="bank_name">Bank Name</label>
                                            <input type="text" class="form-control" name="bank_name" placeholder="<?php echo $banking_details['bank_name']; ?>" readonly="true"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="bank_code">Bank Code</label>
                                            <input type="text" class="form-control" name="bank_code" placeholder="<?php echo $banking_details['bank_code']; ?>" readonly="true"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="bank_branch_name">Branch Name</label>
                                            <input type="text" class="form-control" name="bank_branch_name" placeholder="<?php echo $banking_details['bank_branch_name']; ?>" readonly="true"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="bank_branch_code">Branch Code</label>
                                            <input type="text" class="form-control" name="bank_branch_code" placeholder="<?php echo $banking_details['bank_branch_code']; ?>" readonly="true"/>
                                        </div>
                                    <?php } else if (isset($_SESSION['has_banking_details']) AND $_SESSION['has_banking_details'] == false) { ?>
                                        <div class="form-group">
                                            <label for="bank_account_number">Account Number</label>
                                            <input type="text" class="form-control" name="bank_account_number" placeholder="eg. ABCD1234EFG567/2017" />
                                        </div>
                                        <div class="form-group">
                                            <label for="bank_name">Bank Name</label>
                                            <input type="text" class="form-control" name="bank_name" placeholder="eg Barclays Bank" />
                                        </div>
                                        <div class="form-group">
                                            <label for="bank_code">Bank Code</label>
                                            <input type="text" class="form-control" name="bank_code" placeholder="eg. ABCDE" />
                                        </div>
                                        <div class="form-group">
                                            <label for="bank_branch_name">Branch Name</label>
                                            <input type="text" class="form-control" name="bank_branch_name" placeholder="eg. Nairobi" />
                                        </div>
                                        <div class="form-group">
                                            <label for="bank_branch_code">Branch Code</label>
                                            <input type="text" class="form-control" name="bank_branch_code" placeholder="eg. FGHIJ" />
                                        </div>
                                    <?php } ?>
                                </div>
                                <br />

                                <div class="form-group checkbox">
                                    <label>
                                        <input type="checkbox" name="terms_and_conditions" value="" required="true"> I accept <?php echo $_SESSION['chapter_details']['chapter_name']; ?> <a href="?website_tac">terms and conditions</a>
                                    </label>
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
