<?php
//if (!App::isLoggedIn())
//    App::redirectTo("?");
//require_once WPATH . "modules/menus/tmenu.php";
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Transactions.php";
$transactions = new Transactions();
$users = new Users();
$loans = new Loans();
$account_details = $users->fetchAccountDetails($_SESSION['account']);
unset($_SESSION["guarantors_list"]);

if (!empty($_POST)) {
    $loan_type_details = $loans->fetchLoanTypeDetails($_POST['loan_type']);
    $loan_qualification_status = $loans->getLoanQualificationStatus($account_details['authorizedat'], $loan_type_details['qualification_time']);

    if ($loan_qualification_status == true) {
        $_SESSION['loan_type'] = $_POST['loan_type'];
        App::redirectTo("?add_loan_next");
    } else if ($loan_qualification_status == false) {
        $_SESSION['loan_qualification'] = 0;
    }
}
?>


<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_loans.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Loan
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="transaction_type" value="LOAN APPLICATION"/>
                                <input type="hidden" name="createdby" value="<?php $_SESSION['userid'];   ?>"/>
                                <div class="form-group">
                                    <label for="account_name">Account Number</label>
                                    <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Account Number" value="<?php echo $_SESSION['account'];   ?>" readonly="true" />
                                </div>
                                <div class="form-group">
                                    <label for="account_name">Account Name</label>
                                    <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Name" value="<?php echo $account_details['account_name'];   ?>" readonly="true" />
                                </div>
                                <div class="form-group">
                                    <label for="loan_type">Loan Type</label>
                                    <select name="loan_type" class="form-control">        
                                        <?php echo $loans->getLoanTypes(); ?> 
                                    </select> 
                                </div>
                                <button type="submit" class="btn btn-info">Next</button>
                            </form>

                        </div>
                    </section>
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>