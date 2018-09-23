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
    $_SESSION['bank_account'] = $_POST['bank_account'];
    $_SESSION['bank_account_number1'] = $_POST['bank_account_number1'];
    $_SESSION['bank_account_bank1'] = $_POST['bank_account_bank1'];
    $_SESSION['bank_account_branch1'] = $_POST['bank_account_branch1'];
    $_SESSION['bank_account_number2'] = $_POST['bank_account_number2'];
    $_SESSION['bank_account_bank2'] = $_POST['bank_account_bank2'];
    $_SESSION['bank_account_branch2'] = $_POST['bank_account_branch2'];

    if ($_SESSION['account_type_details']['name'] == "GROUP/JOINT ACCOUNT" OR $_SESSION['account_type_details']['name'] == "BUSINESS ACCOUNT") {
        $success = $users->addAccount();
        if ($success['status'] == 200) {
            $_SESSION['add_success'] = true;
            $_SESSION['feedback_message'] = "<strong>Successful:</strong> The account has been created successfully.";
            App::redirectTo("?view_accounts");
        } else {
            $_SESSION['add_fail'] = true;
            $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error creating the account. Please try again.";
            App::redirectTo("?add_account");
        }
    } else if ($_SESSION['account_type_details']['name'] == "PERSONAL ACCOUNT") {
        App::redirectTo("?add_nominees");
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
                            Banking Details
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <div class="form-group">
                                    <label for="delivery_method">How would you like to receive the cash?</label>
                                    <select name="delivery_method" class="form-control">    
                                        <option value="MOBILE-MONEY">Mobile Number</option>
                                        <option value="BANK">Bank</option>                                
                                    </select> 
                                </div>
                                <div class="MOBILE-MONEY box">
                                    <div class="form-group">
                                        <label for="network_provider">How would you like to receive the cash?</label>
                                        <select name="network_provider" class="form-control">    
                                            <option value="SAFARICOM">Safaricom</option>
                                            <option value="AIRTEL">Airtel</option>  
                                            <option value="ORANGE">Orange</option>  
                                        </select> 
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile_number">Mobile Number</label>
                                        <input type="tel" class="form-control" id="mobile_number" name="mobile_number" placeholder="eg. +2567XXXXXXXX" required="yes"/>
                                    </div>
                                </div>
                                <div class="BANK box">    
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
                                        <input type="text" class="form-control" name="bank_branch" placeholder="eg. Nairobi" />
                                    </div>
                                    <div class="form-group">
                                        <label for="bank_branch_code">Branch Code</label>
                                        <input type="text" class="form-control" name="bank_branch_code" placeholder="eg. FGHIJ" />
                                    </div>
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
