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
    $_SESSION['other_account'] = $_POST['other_account'];
    $_SESSION['other_account_number1'] = $_POST['other_account_number1'];
    $_SESSION['other_account_bank1'] = $_POST['other_account_bank1'];
    $_SESSION['other_account_branch1'] = $_POST['other_account_branch1'];
    $_SESSION['other_account_number2'] = $_POST['other_account_number2'];
    $_SESSION['other_account_bank2'] = $_POST['other_account_bank2'];
    $_SESSION['other_account_branch2'] = $_POST['other_account_branch2'];

    if ($_SESSION['account_category_details']['name'] == "GROUP ACCOUNT" OR $_SESSION['account_category_details']['name'] == "JOINT ACCOUNT") {
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
    } else if ($_SESSION['account_category_details']['name'] == "INDIVIDUAL ACCOUNT") {
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
                            Banking Details
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <div class="form-group">
                                    <label for="other_account">Do you have any other account(s) with any bank, sacco or micro-finance:</label>
                                    <select name="other_account" class="form-control">    
                                        <option value="NO">NO</option>
                                        <option value="YES">YES</option>                                
                                    </select> 
                                </div>
                                <div class="YES box">                            
                                    <h4 id="divider">First Institution</h4>
                                    <div class="form-group">
                                        <label for="other_account_number1">Account Number</label>
                                        <input type="text" class="form-control" name="other_account_number1" placeholder="eg. ABCD1234EFG567/2017" />
                                    </div>
                                    <div class="form-group">
                                        <label for="other_account_bank1">Bank Name</label>
                                        <input type="text" class="form-control" name="other_account_bank1" placeholder="eg Barclays Bank" />
                                    </div>
                                    <div class="form-group">
                                        <label for="other_account_branch1">Branch Name</label>
                                        <input type="text" class="form-control" name="other_account_branch1" placeholder="eg. Jinja" />
                                    </div>
                                    <h4 id="divider">Second Institution</h4>
                                    <div class="form-group">
                                        <label for="other_account_number2">Account Number</label>
                                        <input type="text" class="form-control" name="other_account_number2" placeholder="eg. 1234EFGABCD567X7Y8Z9" />
                                    </div>
                                    <div class="form-group">
                                        <label for="other_account_bank2">Bank Name</label>
                                        <input type="text" class="form-control" name="other_account_bank2" placeholder="eg. Starndard Chartered Bank" />
                                    </div>
                                    <div class="form-group">
                                        <label for="other_account_branch2">Branch Name</label>
                                        <input type="text" class="form-control" name="other_account_branch2" placeholder="eg. Nairobi" />
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
