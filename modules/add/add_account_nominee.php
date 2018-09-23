<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$users = new Users();
$loans = new Loans();

if (!empty($_POST)) {
    $_SESSION['nominees_total_percentage'] = 0;
    $_SESSION['nominee_number'] = 1;

    $_SESSION['nominee_firstname'] = $_POST['firstname'];
    $_SESSION['nominee_middlename'] = $_POST['middlename'];
    $_SESSION['nominee_lastname'] = $_POST['lastname'];
    $_SESSION['nominee_idnumber'] = $_POST['idnumber'];
    $_SESSION['nominee_relationship'] = $_POST['relationship'];
    $_SESSION['nominee_phone_number'] = $_POST['phone_number'];
    $_SESSION['nominee_email'] = $_POST['email'];
    $_SESSION['nominee_postal_address'] = $_POST['postal_address'];
    $_SESSION['nominee_percentage'] = $_POST['percentage'];

//    while ($_SESSION['nominees_total_percentage'] < 100) {
//        $_SESSION['nominee_firstname_' . $_SESSION['nominee_number']] = $_POST['firstname'];
//        $_SESSION['nominee_middlename_' . $_SESSION['nominee_number']] = $_POST['middlename'];
//        $_SESSION['nominee_lastname_' . $_SESSION['nominee_number']] = $_POST['lastname'];
//        $_SESSION['nominee_idnumber_' . $_SESSION['nominee_number']] = $_POST['idnumber'];
//        $_SESSION['nominee_relationship_' . $_SESSION['nominee_number']] = $_POST['relationship'];
//        $_SESSION['nominee_phone_number_' . $_SESSION['nominee_number']] = $_POST['phone_number'];
//        $_SESSION['nominee_email_' . $_SESSION['nominee_number']] = $_POST['email'];
//        $_SESSION['nominee_postal_address_' . $_SESSION['nominee_number']] = $_POST['postal_address'];
//        $_SESSION['nominee_percentage_' . $_SESSION['nominee_number']] = $_POST['percentage'];

    $_SESSION['nominees_total_percentage'] = $_SESSION['nominees_total_percentage'] + $_SESSION['nominee_percentage' . '_' . $_SESSION['nominee_number']];
//        $_SESSION['nominee_number'] = $_SESSION['nominee_number'] + 1;
//    }

    $_SESSION['number_of_nominees'] = $_SESSION['nominee_number'];
    
    
    $success = $users->execute();
        if ($success['status'] == 200) {
            $_SESSION['add_success'] = true;
            $_SESSION['feedback_message'] = "<strong>Successful:</strong> The account record has been created successfully.";
            if ($_SESSION['account_type_details']['name'] == "PERSONAL ACCOUNT") {
                App::redirectTo("?view_accounts");
            } else if ($_SESSION['account_type_details']['name'] == "GROUP/JOINT ACCOUNT") {
                App::redirectTo("?view_account_holders_individual_account");
            }
        } else {
            $_SESSION['add_fail'] = true;
            $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error creating the account. Please try again.";
            App::redirectTo("?add_account");
        }
    
    
//    App::redirectTo("?add_contact&ref_type={$_SESSION['ref_type']}");
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_new_account.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            <strong>ACCOUNT NOMINEE</strong>
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="add_account"/>
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
                                    <label for="idnumber">ID/Passport Number</label>
                                    <input type="number" class="form-control" id="idnumber" name="idnumber" placeholder="eg. 98732145" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="relationship">Relationship</label>
                                    <input type="text" class="form-control" id="relationship" name="relationship" placeholder="eg. Brother"/>
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
                                    <label for="percentage">Percentage(%)</label>
                                    <input type="number" class="form-control" id="percentage" name="percentage" placeholder="eg. 50" value="100" required="yes"/>
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
