<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$loans = new Loans();

$user_type_details = $users->fetchUserTypeDetails($_SESSION['login_user_type']);

if (!empty($_POST)) {
    $loan_type_details = $loans->fetchLoanTypeDetails($_POST['loan_type']);

    if (isset($_SESSION['account'])) {
        $account_details = $users->fetchAccountDetails($_SESSION['account']);
        $loan_qualification_status = $loans->getLoanQualificationStatus($account_details['authorizedat'], $loan_type_details['qualification_time']);
    } else {
        $loan_qualification_status = true;
    }

    if ($loan_qualification_status == true) {
        $success = $loans->execute();
        if ($success['status'] == 200) {
            $_SESSION['loan_check_success'] = true;
        } else {
            $_SESSION['loan_check_fail'] = true;
            $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error with the loan calculation. Please try again.";
        }
        $_SESSION['loan_qualification'] = true;
    } else if ($loan_qualification_status == false) {
        $_SESSION['loan_qualification'] = false;
    }
}
?>


<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php
            if ($user_type_details['name'] != "GUEST") {
                require_once('modules/menus/sub_menu_loans.php');
            }
            ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Loan Calculator
                            <?php
                            if (isset($_SESSION['loan_check_fail'])) {
                                echo $_SESSION['add_record_fail'];
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['loan_check_fail']);
                            }
                            ?>
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="engage_loan_calculator"/>
                                <div class="form-group">
                                    <label for="loan_type">Loan Type</label>
                                    <select name="loan_type" class="form-control">        
                                        <?php echo $loans->getLoanTypes(); ?> 
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="principal_amount">Loan Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" id="principal_amount" name="principal_amount" value="<?php
                                    if (!empty($_POST['principal_amount'])) {
                                        echo $_POST['principal_amount'];
                                    }
                                    ?>" placeholder="eg. 500000" />
                                </div>
                                <div class="form-group">
                                    <label for="duration">Repayment Period (Months)</label>
                                    <input type="number" class="form-control" id="duration" name="duration" value="<?php
                                    if (!empty($_POST['duration'])) {
                                        echo $_POST['duration'];
                                    }
                                    ?>" placeholder="eg. 12" />
                                </div>
                                <!--                                <div class="form-group">
                                                                    <label for="duration">Repayment Period (Months)</label>
                                                                    <select name="duration" class="form-control">  
                                                                        <option value="1" selected>1</option>
                                                                        <option value="2" selected>2</option>
                                                                        <option value="3" selected>3</option>
                                                                        <option value="4" selected>4</option>
                                                                        <option value="5" selected>5</option>
                                                                        <option value="6" selected>6</option>
                                                                        <option value="7" selected>7</option>
                                                                        <option value="8" selected>8</option>
                                                                        <option value="9" selected>9</option>
                                                                        <option value="10" selected>10</option>
                                                                        <option value="11" selected>11</option>
                                                                        <option value="12" selected>12</option>
                                <?php // echo $loans->getLoanTypes(); ?> 
                                                                    </select> 
                                                                </div>-->

                                <?php if (isset($_SESSION['loan_check_success'])) { ?>
                                    <div class="form-group">
                                        <label for="total_interest">Total Interest <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                        <input type="text" class="form-control" id="total_interest" name="total_interest" placeholder="0" value="<?php
                                        if (!empty($_POST)) {
                                            echo $success['interest'];
                                        }
                                        ?>" readonly="true" />
                                    </div>
                                    <div class="form-group">
                                        <label for="total_repayment">Total Repayable Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                        <input type="text" class="form-control" id="total_repayment" name="total_repayment" placeholder="0" value="<?php
                                        if (!empty($_POST)) {
                                            echo $success['total_repayable_amount'];
                                        }
                                        ?>" readonly="true" />
                                    </div>
                                    <div class="form-group">
                                        <label for="monthly_repayment">Monthly Repayment <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                        <input type="text" class="form-control" id="monthly_repayment" name="monthly_repayment" placeholder="0" value="<?php
                                        if (!empty($_POST)) {
                                            echo $success['monthly_repayment'];
                                        }
                                        ?>" readonly="true" />
                                    </div>
                                    <?php
                                    unset($_SESSION['loan_check_success']);
                                }
                                ?>
                                <button type="submit" class="btn btn-info">Compute</button>
                            </form>

                        </div>
                    </section>
                </div>        
            </div>
        </section>
    </aside>
</div>