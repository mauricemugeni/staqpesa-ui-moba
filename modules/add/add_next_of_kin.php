<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$users = new Users();
$loans = new Loans();
//$ref_type = $_GET['ref_type'];

if (!empty($_POST)) {
    if ($_SESSION['account']) {
        $_SESSION['ref_type'] = $users->getUserRefTypeId("ACCOUNT HOLDER");
        $_SESSION['ref_id'] = $_SESSION['account'];
        $add_next_of_kin_details = $users->execute();
        if ($add_next_of_kin_details['status'] == 200) {
            $checkIfAccountHasBankingDetails = $users->checkIfAccountHasBankingDetails();
            if ($checkIfAccountHasBankingDetails == true) {
                $_SESSION['has_banking_details'] = true;
            } else if ($checkIfAccountHasBankingDetails == false) {
                $_SESSION['has_banking_details'] = false;
            }
            App::redirectTo("?add_account_banking");
        } else {
            $_SESSION['add_next_of_kin_fail'] = true;
            $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error saving the next of kin's details entered. Please try again.";
            App::redirectTo("?add_next_of_kin");
        }
    }
}
?>


<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_system_users.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Next of Kin
                            <?php
                            if (isset($_SESSION['add_next_of_kin_fail'])) {
                                echo $_SESSION['add_record_fail'];
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['add_next_of_kin_fail']);
                            }
                            ?>
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <?php // if ($ref_type == "ACCOUNT HOLDER") {  ?>
                                    <!--<input type="hidden" name="action" value="add_account"/>-->
                                <?php // } else {  ?>
                                <input type="hidden" name="action" value="add_next_of_kin"/>
                                <?php // }  ?>
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="eg. John" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="middlename">Middle Name</label>
                                    <input type="text" class="form-control" id="middlename" name="middlename" placeholder="eg. Fredrick" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="eg. Kennedy" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="relationship">Relationship</label>
                                    <input type="text" class="form-control" id="relationship" name="relationship" placeholder="eg. Brother"/>
                                </div>
                                <div class="form-group">
                                    <label for="workplace">Workplace</label>
                                    <input type="text" class="form-control" id="workplace" name="workplace" placeholder="eg. Safaricom Headquarters, Westlands" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="eg. +2547XXXXXXXX" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="eg. abcdef@gmail.com" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="postal_address">Postal Address</label>
                                    <input type="text" class="form-control" id="postal_address" name="postal_address" placeholder="eg. 45656-00200 Nairobi" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="physical_address">Physical Address</label>
                                    <input type="text" class="form-control" id="physical_address" name="physical_address" placeholder="eg. Nairobi" required/>
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
