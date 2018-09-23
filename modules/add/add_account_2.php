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
    $branch_details = $settings->fetchBranchDetails($_SESSION['user_details']['branch']);
    $number_datetime = substr(time(), -10);
    $_SESSION['branch'] = $_SESSION['user_details']['branch'];
    $_SESSION['account_type'] = $_POST['account_type'];
    $_SESSION['account_category'] = $_POST['account_category'];
    $_SESSION['account_category_details'] = $settings->fetchAccountCategoryDetails($_SESSION['account_category']);
    if (!isset($_POST['account_name'])) {
        $_SESSION['account_name'] = NULL;
    } else {
        $_SESSION['account_name'] = $_POST['account_name'];
    }

    $_SESSION['createdby'] = $_POST['createdby'];
    $_SESSION['createdat'] = time();
    $_SESSION['transaction_type'] = $transactions->getTransactionRefTypeId($_POST['transaction_type']);
    $_SESSION['transaction_id'] = $transactions->getTransactionId($_POST['transaction_type'], $_POST['createdby'], $_SESSION['createdat'], $_SESSION['branch']);
    $_SESSION['account'] = $users->getNextAccountNumber($branch_details['code'], $number_createdby, $number_datetime);
    $_SESSION['ref_type_transactions'] = $settings->getTransactionRefTypeId($_POST['transaction_type']);
    $_SESSION['user_type'] = "ACCOUNT HOLDER";
    $_SESSION['ref_type'] = $users->getUserRefTypeId($_SESSION['user_type']);

    if (isset($_SESSION['account'])) {
        if ($_SESSION['account_category_details']['name'] == "JOINT ACCOUNT") {
            App::redirectTo("?add_account_banking");
        } else {
            App::redirectTo("?add_account_next");
        }
        
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
                            <?php
                            if (isset($_SESSION['add_fail'])) {
                                echo $_SESSION['add_record_fail'];
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['add_fail']);
                            }
                            ?>
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="transaction_type" value="MEMBERSHIP APPLICATION">
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <div class="form-group">
                                    <label for="account_type">Product Type:</label>
                                    <select name="account_type" class="form-control">          
                                        <?php echo $settings->getAccountTypes(); ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="account_category">Account Category</label>
                                    <select name="account_category" id="account_category" class="form-control">          
                                        <?php echo $settings->getAccountCategories(); ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="account_name">Account Name</label>
                                    <input type="text" class="form-control" id="account_name" name="account_name" placeholder="eg. Mugeni Family Group" required="yes"/>
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
