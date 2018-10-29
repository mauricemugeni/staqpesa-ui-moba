<?php
if (!App::isLoggedIn()) App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$code = $_SESSION['code'];
$update_type = $_GET['update_type'];
$details = $users->fetchContactDetails($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $users->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        
        App::redirectTo("?view_contacts_individual&code={$code}");
        
//        App::redirectTo("?view_contacts");
    }
} else {
    $success = $users->updateContact($code, $update_type);
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = "Record successfully updated";
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_error'] = "Error updating record";
    }
    
    App::redirectTo("?view_contacts_individual&code={$code}");
    
//    App::redirectTo("?view_contacts");
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
                            Update Contacts
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_contact"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>">
                                <input type="hidden" name="code" value="<?php echo $code; ?>">
                                <div class="form-group">
                                    <label for="phone_number1">Mobile</label>
                                    <input type="tel" class="form-control" id="phone_number1" name="phone_number1" placeholder="Mobile" value="<?php echo $details['phone_number1']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number2">Landline</label>
                                    <input type="tel" class="form-control" id="phone_number2" name="phone_number2" placeholder="Landline" value="<?php echo $details['phone_number2']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="<?php echo $details['email']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="postal_number">Postal Number</label>
                                    <input type="number" class="form-control" id="postal_number" name="postal_number" placeholder="Postal Number" value="<?php echo $details['postal_number']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="postal_code">Postal Code</label>
                                    <input type="number" class="form-control" id="postal_code" name="postal_code" placeholder="Postal Code" value="<?php echo $details['postal_code']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="town">Town</label>
                                    <input type="text" class="form-control" id="town" name="town" placeholder="Town" value="<?php echo $details['town']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="residential_area">Residential Area</label>
                                    <input type="text" class="form-control" id="residential_area" name="residential_area" placeholder="Residential Area" value="<?php echo $details['residential_area']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="estate">Estate</label>
                                    <input type="text" class="form-control" id="estate" name="estate" placeholder="Estate" value="<?php echo $details['estate']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="street">Street</label>
                                    <input type="text" class="form-control" id="street" name="street" placeholder="Street" value="<?php echo $details['street']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="division">Division</label>
                                    <input type="text" class="form-control" id="division" name="division" placeholder="Division" value="<?php echo $details['division']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="sub_location">Sub-Location</label>
                                    <input type="text" class="form-control" id="sub_location" name="sub_location" placeholder="Sub-Location" value="<?php echo $details['sub_location']; ?>" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="<?php echo $details['location']; ?>" required="yes"/>
                                </div>

                                <button type="submit" class="btn btn-info">Update</button>
                            </form>

                        </div>
                    </section>
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>