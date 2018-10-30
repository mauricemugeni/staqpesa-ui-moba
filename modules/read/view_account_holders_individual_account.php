<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$users = new Users();
$code = $_SESSION['account'];
$details2 = $users->fetchIndividualAccountHolderDetails($code);
?>


<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_account.php'); ?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel">
                        <header class="panel-heading">
                            Account Holder Details
                            <?php
                            require_once('modules/menus/sub-sub-menu-buttons.php');
                            if (isset($_SESSION['add_success'])) {
                                echo $_SESSION['add_account_holder_success'];
                                unset($_SESSION['add_success']);
                            }
                            unset($_SESSION['can_add_accountholder']);
                            ?>
                        </header>
                        <div class="panel-body">
                            <?php
                            if (count($details2) == 0) {
                                echo "No account holder records found for this account";
                            } else {
                                foreach ($details2 as $details) {
                                    $staff_details_createdby = $users->fetchStaffDetails($details['createdby']);
                                    $ref_type = $users->getUserRefTypeId("ACCOUNT HOLDER");

                                    $account_holder_contact_details = $users->fetchIndividualContactDetails($ref_type, $details['id']);

                                    if ($details['signatory'] == 1) {
                                        $signatory = "YES";
                                    } else if ($details['signatory'] == 0) {
                                        $signatory = "NO";
                                    }

                                    if ($details['gender'] == "M") {
                                        $gender = "MALE";
                                    } else if ($details['gender'] == "F") {
                                        $gender = "FEMALE";
                                    }

                                    if ($details['status'] == 1000) {
                                        $status = "DELETED";
                                    } else if ($details['status'] == 1001 OR $details['status'] == 1032) {
                                        $status = "AWAITING APPROVAL";
                                    } else if ($details['status'] == 1010) {
                                        $status = "APPROVAL REJECTED";
                                    } else if ($details['status'] == 1011) {
                                        $status = "APPROVAL ACCEPTED";
                                    } else if ($details['status'] == 1020) {
                                        $status = "NOT ACTIVE";
                                    } else if ($details['status'] == 1021) {
                                        $status = "ACTIVE";
                                    }
                                    ?>
                                    <div id="status-element">
                                        <div class="form-group">
                                            <label for="profpicture">Profile Picture:</label>
                                            <img src="modules/images/customers/photos/<?php echo $details['profpicture'] ?>" alt="Account Holder's Image" />
                                        </div>

                                        <div class="form-group">
                                            <label for="account_number">Account Number:</label>
                                            <span class="form-control"><?php echo $details['account_number']; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="firstname">First Name:</label>
                                            <span class="form-control"><?php echo $details['firstname']; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="middlename">Middle Name:</label>
                                            <span class="form-control"><?php echo $details['middlename']; ?></span>
                                        </div>

                                        <div class="form-group"> 
                                            <label for="lastname">Last Name:</label>
                                            <span class="form-control"><?php echo $details['lastname']; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="gender">Gender:</label>
                                            <span class="form-control"><?php echo $gender; ?></span>
                                        </div>

                                        <div class="form-group"> 
                                            <label for="idnumber">ID Number:</label>
                                            <span class="form-control"><?php echo $details['idnumber']; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="birthdate">Date of Birth:</label>
                                            <span class="form-control"><?php echo $details['birthdate']; ?></span>
                                        </div>

                                        <div class="form-group"> 
                                            <label for="nationality">Nationality:</label>
                                            <span class="form-control"><?php echo $details['nationality']; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="signature">Signature:</label>
                                            <img src="modules/images/customers/signatures/<?php echo $details['signature'] ?>" alt="Account Holder's Signature" />
                                        </div>

                                        <div class="form-group">
                                            <label for="signatory">Is account holder a signatory:</label>
                                            <span class="form-control"><?php echo $signatory; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Status:</label>
                                            <span class="form-control"><?php echo $status; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="createdat">Created At:</label>
                                            <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['createdat']); ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="createdby">Created By:</label>
                                            <span class="form-control"><?php echo $staff_details_createdby['firstname'] . " " . $staff_details_createdby['middlename'] . " " . $staff_details_createdby['lastname']; ?></span>
                                        </div>

                                        <?php
                                        if ($details['authorizedat'] != NULL AND $details['authorizedat'] != NULL) {
                                            $staff_details_authorizedby = $users->fetchStaffDetails($details['authorizedby']);
                                            $staff_details_lastmodifiedby = $users->fetchStaffDetails($details['lastmodifiedby']);
                                            $staff_details_lastauthorizedby = $users->fetchStaffDetails($details['lastauthorizedby']);
                                            ?>

                                            <div class="form-group">
                                                <label for="authorizedat">Authorized At:</label>
                                                <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['authorizedat']); ?></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="authorizedby">Authorized By:</label>
                                                <span class="form-control"><?php echo $staff_details_authorizedby['firstname'] . " " . $staff_details_authorizedby['middlename'] . " " . $staff_details_authorizedby['lastname']; ?></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="lastmodifiedat">Last Modified At:</label>
                                                <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['lastmodifiedat']); ?></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="lastmodifiedby">Last Modified By:</label>
                                                <span class="form-control"><?php echo $staff_details_lastmodifiedby['firstname'] . " " . $staff_details_lastmodifiedby['middlename'] . " " . $staff_details_lastmodifiedby['lastname']; ?></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="lastauthorizedat">Last Authorized At:</label>
                                                <span class="form-control"><?php echo date("Y-m-d H:i:s", $details['lastauthorizedat']); ?></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="lastauthorizedby">Last Authorized By:</label>
                                                <span class="form-control"> <?php echo $staff_details_lastauthorizedby['firstname'] . " " . $staff_details_lastauthorizedby['middlename'] . " " . $staff_details_lastauthorizedby['lastname']; ?></span>
                                            </div>
                                        <?php } ?>

                                        <div class="clear"></div>
                                        <label for="account_holder1"><h3>Holder Contact Details:</h3></label>
                                        <div class="clear"></div>

                                        <div class="form-group">
                                            <label for="phone_number1">Mobile Number:</label>
                                            <span class="form-control"><?php echo $account_holder_contact_details['phone_number1']; ?></span>
                                        </div>
                                        <div class="form-group"> 
                                            <label for="phone_number2">Phone Number:</label>
                                            <span class="form-control"><?php echo $account_holder_contact_details['phone_number2']; ?> </span>
                                        </div>
                                        <div class="form-group"> 
                                            <label for="email">Email:</label>
                                            <span class="form-control"><?php echo $account_holder_contact_details['email']; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="postal_number">Postal Number:</label>
                                            <span class="form-control"><?php echo $account_holder_contact_details['postal_number']; ?></span>
                                        </div>
                                        <div class="form-group"> 
                                            <label for="postal_code">Postal Code:</label>
                                            <span class="form-control"><?php echo $account_holder_contact_details['postal_code']; ?> </span>
                                        </div>
                                        <div class="form-group"> 
                                            <label for="town">Town:</label>
                                            <span class="form-control"><?php echo $account_holder_contact_details['town']; ?></span>
                                        </div>
                                        <div class="form-group"> 
                                            <label for="residential_area">Residential Area:</label>
                                            <span class="form-control"><?php echo $account_holder_contact_details['residential_area']; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="estate">Estate:</label>
                                            <span class="form-control"><?php echo $account_holder_contact_details['estate']; ?></span>
                                        </div>
                                        <div class="form-group"> 
                                            <label for="street">Street:</label>
                                            <span class="form-control"><?php echo $account_holder_contact_details['street']; ?></span>
                                        </div>
                                        <div class="form-group"> 
                                            <label for="division">Division:</label>
                                            <span class="form-control"><?php echo $account_holder_contact_details['division']; ?></span>
                                        </div>
                                        <div class="form-group"> 
                                            <label for="location">Location:</label>
                                            <span class="form-control"><?php echo $account_holder_contact_details['location']; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="sub_location">Sub-location:</label>
                                            <span class="form-control"><?php echo $account_holder_contact_details['sub_location']; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status:</label>
                                            <span class="form-control"><?php echo $status; ?></span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel -->
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>