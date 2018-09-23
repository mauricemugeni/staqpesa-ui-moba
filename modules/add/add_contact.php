<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Funding.php";
$funding = new Funding();
$settings = new Settings();
$users = new Users();
$loans = new Loans();
if (isset($_GET['ref_type'])) {
    $ref_type = $_GET['ref_type'];
}

if (!empty($_POST)) {

    $_SESSION['phone_number1'] = $_POST['phone_number1'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['phone_number2'] = $_POST['phone_number2'];
    $_SESSION['postal_number'] = $_POST['postal_number'];
    $_SESSION['postal_code'] = $_POST['postal_code'];
    $_SESSION['town'] = $_POST['town'];
    $_SESSION['residential_area'] = $_POST['residential_area'];
    $_SESSION['estate'] = $_POST['estate'];
    $_SESSION['street'] = $_POST['street'];
    $_SESSION['division'] = $_POST['division'];
    $_SESSION['location'] = $_POST['location'];
    $_SESSION['sub_location'] = $_POST['sub_location'];
    $_SESSION['landmark_feature'] = $_POST['landmark_feature'];

    if ($ref_type == $users->getUserRefTypeId("STAFF")) {
        $success = $users->execute();
        if ($success['status'] == 200) {
            $_SESSION['add_success'] = true;
            $_SESSION['feedback_message'] = "<strong>Successful:</strong> The staff record has been created successfully.";
            App::redirectTo("?view_staff");
        } else {
            $_SESSION['add_fail'] = true;
            $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error creating the staff record. Please try again.";
            App::redirectTo("?add_staff");
        }
    } else if ($ref_type == $users->getUserRefTypeId("INVESTOR")) {
        $success = $funding->execute();
        if ($success['status'] == 200) {
            $_SESSION['add_success'] = true;
            $_SESSION['feedback_message'] = "<strong>Successful:</strong> The investor record has been created successfully.";
            App::redirectTo("?view_investors");
        } else {
            $_SESSION['add_fail'] = true;
            $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error creating the investor record. Please try again.";
            App::redirectTo("?add_investor");
        }
    } else if ($ref_type == $users->getUserRefTypeId("ACCOUNT HOLDER")) {
        App::redirectTo("?add_account_nominee");
    }
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">

        <!-- Main content -->
        <section class="content"> 
            <?php
//            if ($ref_type == $users->getUserRefTypeId("ACCOUNT HOLDER")) {
//                require_once('modules/menus/sub_menu_new_account.php');
//            } else {
//                require_once('modules/menus/sub_menu_system_users.php');
//            }
            ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            <?php if ($ref_type == $users->getUserRefTypeId("STAFF")) { ?>
                                <strong>STAFF CONTACT DETAILS</strong>
                            <?php } else if ($ref_type == $users->getUserRefTypeId("ACCOUNT HOLDER")) { ?>
                                <strong>ACCOUNT HOLDER CONTACT DETAILS</strong>
                            <?php } else if ($ref_type == $users->getUserRefTypeId("INVESTOR")) { ?>
                                <strong>INVESTOR CONTACT DETAILS</strong>
                            <?php } ?>
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <?php if ($ref_type == $users->getUserRefTypeId("STAFF")) { ?>
                                    <input type="hidden" name="action" value="add_staff"/>
                                    <?php // } else if ($ref_type == $users->getUserRefTypeId("ACCOUNT HOLDER")) { ?>
                                    <!--<input type="hidden" name="action" value="add_account"/>-->
                                <?php } else if ($ref_type == $users->getUserRefTypeId("INVESTOR")) { ?>
                                    <input type="hidden" name="action" value="add_investor"/>
                                <?php } ?>

                                <div class="form-group">
                                    <label for="phone_number1">Mobile Phone Number</label>
                                    <input type="tel" class="form-control" id="phone_number1" name="phone_number1" placeholder="eg. +2567XXXXXXXX" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number2">Landline Telephone Number</label>
                                    <input type="tel" class="form-control" id="phone_number2" name="phone_number2" placeholder="+25620XXXXXXX" />
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="eg. info@XXXXXXXXXX.com" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="postal_number">Postal Number</label>
                                    <input type="number" class="form-control" id="postal_number" name="postal_number" placeholder="eg. 123456" />
                                </div>
                                <div class="form-group">
                                    <label for="postal_code">Postal Code</label>
                                    <input type="number" class="form-control" id="postal_code" name="postal_code" placeholder="eg. 00100" />
                                </div>
                                <div class="form-group">
                                    <label for="town">Town</label>
                                    <input type="text" class="form-control" id="town" name="town" placeholder="eg. Kampala" />
                                </div>
                                <div class="form-group">
                                    <label for="residential_area">Residential Area(County/District/Major Town)</label>
                                    <input type="text" class="form-control" id="residential_area" name="residential_area" placeholder="eg. Kampala" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="estate">Estate</label>
                                    <input type="text" class="form-control" id="estate" name="estate" placeholder="eg. Westlands" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="street">Street</label>
                                    <input type="text" class="form-control" id="street" name="street" placeholder="eg. Kimathi Street" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="division">Division</label>
                                    <input type="text" class="form-control" id="division" name="division" placeholder="eg. Kasarani" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" placeholder="eg. Umoja One" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="sub_location">Sub-Location</label>
                                    <input type="text" class="form-control" id="sub_location" name="sub_location" placeholder="eg. Tena" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="landmark_feature">Landmark Feature</label>
                                    <input type="text" class="form-control" id="landmark_feature" name="landmark_feature" placeholder="eg. Opposite National Cinema - Nairobi" required="yes"/>
                                </div>

                                <?php if ($ref_type == $users->getUserRefTypeId("ACCOUNT HOLDER")) { ?>
                                    <button type="submit" class="btn btn-info">Next</button>
                                <?php } else { ?>
                                    <button type="submit" class="btn btn-info">Submit</button>
                                <?php } ?>
                            </form>

                        </div>
                    </section>
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>