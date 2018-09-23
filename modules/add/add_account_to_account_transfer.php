<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
$users = new Users();

if (!empty($_POST)) {
    $account_exists = $users->confirmIfAccountExists($_POST['account_number']);
    if ($_SESSION['account'] == $_POST['account_number']) {
        
        $_SESSION['same_account_fail'] = true;
        $_SESSION['feedback_message'] = "<strong>Error!</strong> You cannot transfer to the same account!.";
        
//        echo '<script>$.notify("Warning: You cannot transfer to the same account!", "warn");</script>';
//        echo '<script>alert("You cannot transfer to the same account");</script>';
    } else {
        if ($account_exists == true) {
            $_SESSION['recipient_account_number'] = $_POST['account_number'];
            App::redirectTo("?add_account_to_account_transfer_next");
        } else {
            echo '<script>$.notify("Warning: Account does not exist. Try again!", "warn");</script>';
            echo '<script>alert("Account doesnt exits");</script>';
        }
    }
}
?>


<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_transactions.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Transfer to Another Account
                            <?php
                            if (isset($_SESSION['same_account_fail'])) {
                                echo $_SESSION['add_record_fail'];
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['same_account_fail']);
                            } else if (isset($_SESSION['add_fail'])) {
                                echo $_SESSION['add_record_fail'];
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['add_fail']);
                            }
                            ?>
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <div class="form-group">
                                    <label for="account_number">Enter Account Number</label>
                                    <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Enter Account Number" required="true" />
                                </div>
                                <button type="submit" class="btn btn-info">Proceed</button>
                            </form>

                        </div>
                    </section>
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>