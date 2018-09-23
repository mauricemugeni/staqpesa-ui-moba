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
    $branch_details = $settings->fetchBranchDetails($_POST['branch']);
    $number_datetime = substr(time(), -10);

    if ($_POST['createdby'] < 1000) {
        if (strlen($_POST['createdby']) == 1) {
            $number_createdby = "000" . $_POST['createdby'];
        } else if (strlen($_POST['createdby']) == 2) {
            $number_createdby = "00" . $_POST['createdby'];
        } else if (strlen($_POST['createdby']) == 3) {
            $number_createdby = "0" . $_POST['createdby'];
        }
    } else {
        $number_createdby = $_POST['createdby'];
    }

    $_SESSION['account_name'] = $_POST['account_name'];
    $_SESSION['branch'] = $_POST['branch'];
    $_SESSION['account_type'] = $_POST['account_type'];
    $_SESSION['account_category'] = $_POST['account_category'];
    $_SESSION['company_name'] = $_POST['company_name'];
    $_SESSION['company_business_type'] = $_POST['company_business_type'];
    $_SESSION['company_postal_number'] = $_POST['company_postal_number'];
    $_SESSION['company_postal_code'] = $_POST['company_postal_code'];
    $_SESSION['company_town'] = $_POST['company_town'];
    $_SESSION['company_phone_number'] = $_POST['company_phone_number'];
    $_SESSION['company_email'] = $_POST['company_email'];
    $_SESSION['other_account'] = $_POST['other_account'];
    $_SESSION['other_account_number1'] = $_POST['other_account_number1'];
    $_SESSION['other_account_bank1'] = $_POST['other_account_bank1'];
    $_SESSION['other_account_branch1'] = $_POST['other_account_branch1'];
    $_SESSION['other_account_number2'] = $_POST['other_account_number2'];
    $_SESSION['other_account_bank2'] = $_POST['other_account_bank2'];
    $_SESSION['other_account_branch2'] = $_POST['other_account_branch2'];
    $_SESSION['createdby'] = $_POST['createdby'];
    $_SESSION['createdat'] = time();
    $_SESSION['transaction_type'] = $transactions->getTransactionRefTypeId($_POST['transaction_type']);
    $_SESSION['transaction_id'] = $transactions->getTransactionId($_POST['transaction_type'], $_POST['createdby'], $_SESSION['createdat'], $_SESSION['branch']);
    $_SESSION['account'] = $users->getNextAccountNumber($branch_details['code'], $number_createdby, $number_datetime);
    $_SESSION['ref_type_transactions'] = $settings->getTransactionRefTypeId($_POST['transaction_type']);
    $_SESSION['user_type'] = "ACCOUNT HOLDER";
    $_SESSION['ref_type'] = $users->getUserRefTypeId($_SESSION['user_type']);

    if (isset($_SESSION['account'])) {
        App::redirectTo("?add_next_of_kins&ref_type=" . $_SESSION['user_type']);
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
                            Open Account
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="add_account"/>
                                <input type="hidden" name="transaction_type" value="MEMBERSHIP APPLICATION">
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <div class="form-group">
                                    <label for="account_name">Account Name</label>
                                    <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Name" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="account_type">Product Type:</label>
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
                                <div class="form-group">
                                    <label for="branch">Branch</label>
                                    <select name="branch" class="form-control">          
                                        <?php echo $settings->getBranches(); ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="institution">Institution</label>
                                    <select name="institution" class="form-control">          
                                        <?php echo $settings->getInstitutions(); ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="company_name">Employer's/Company's Name</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Employer's/Company's Name" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="company_business_type">Employer's/Company's Occupation/Business</label>
                                    <input type="text" class="form-control" id="company_business_type" name="company_business_type" placeholder="Employer's/Company's Occupation/Business" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="company_postal_number">Company Postal Number</label>
                                    <input type="number" class="form-control" id="company_postal_number" name="company_postal_number" placeholder="Company Postal Number" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="company_postal_code">Company Postal Code</label>
                                    <input type="number" class="form-control" id="company_postal_code" name="company_postal_code" placeholder="Company Postal Code" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="company_town">Company Town</label>
                                    <input type="text" class="form-control" id="company_town" name="company_town" placeholder="Company Town" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="company_phone_number">Company Telephone</label>
                                    <input type="text" class="form-control" id="company_phone_number" name="company_phone_number" placeholder="Company Telephone" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="company_email">Company Email</label>
                                    <input type="email" class="form-control" id="company_email" name="company_email" placeholder="Company Email" required="yes"/>
                                </div>

                                <label for="other_account">Do you have any other account(s) with any bank, sacco or micro-finance:</label>
                                <select name="other_account" class="form-control">    
                                    <option value="0">NO</option>
                                    <option value="1">YES</option>                                
                                </select> 

                                <div class="1 box">                            
                                    <h4 id="divider">First Institution</h4>
                                    <div class="form-group">
                                        <label for="other_account_number1">Account Number</label>
                                        <input type="text" class="form-control" id="other_account_number1" name="other_account_number1" placeholder="Account Number" />
                                    </div>
                                    <div class="form-group">
                                        <label for="other_account_bank1">Bank Name</label>
                                        <input type="text" class="form-control" id="other_account_bank1" name="other_account_bank1" placeholder="Bank Name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="other_account_branch1">Branch Name</label>
                                        <input type="text" class="form-control" id="other_account_branch1" name="other_account_branch1" placeholder="Branch Name" />
                                    </div>
                                    <h4 id="divider">Second Institution</h4>
                                    <div class="form-group">
                                        <label for="other_account_number2">Account Number</label>
                                        <input type="text" class="form-control" id="other_account_number2" name="other_account_number2" placeholder="Account Number" />
                                    </div>
                                    <div class="form-group">
                                        <label for="other_account_bank2">Bank Name</label>
                                        <input type="text" class="form-control" id="other_account_bank2" name="other_account_bank2" placeholder="Bank Name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="other_account_branch2">Branch Name</label>
                                        <input type="text" class="form-control" id="other_account_branch2" name="other_account_branch2" placeholder="Branch Name" />
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
