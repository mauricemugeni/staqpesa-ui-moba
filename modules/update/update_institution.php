<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/System_Administration.php";
$settings = new Settings();
$code = $_SESSION['institution'];
$update_type = $_GET['update_type'];
$details = $settings->fetchInstitutionDetails($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $settings->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_institutions");
    }
} else {
    if (!empty($_POST)) {
        $success = $settings->updateInstitution($code, $update_type, $_POST['approval_comment']);
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Record successfully updated";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Error updating record";
        }
        App::redirectTo("?view_institutions");
    }
}
?>


<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_account.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <?php if ($update_type == "edit") { ?>
                        <section class="panel">
                            <header class="panel-heading">
                                Update Institution
                            </header>
                            <div class="panel-body">
                                <form role="form" method="POST">
                                    <input type="hidden" name="action" value="edit_institution"/>
                                    <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                    <div class="form-group">
                                        <label for="company_name">Company Name</label>
                                        <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $details['company_name']; ?>" placeholder="Company Name" required="yes"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="business_type">Business Type</label>
                                        <input type="text" class="form-control" id="business_type" name="business_type" value="<?php echo $details['business_type']; ?>" placeholder="Business Type" required="yes"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="postal_number">Postal Number</label>
                                        <input type="text" class="form-control" id="postal_number" name="postal_number" value="<?php echo $details['postal_number']; ?>" placeholder="Postal Number" required="yes"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="postal_code">Postal Code</label>
                                        <input type="text" class="form-control" id="postal_code" name="postal_code" value="<?php echo $details['postal_code']; ?>" placeholder="Postal Code" required="yes"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="town">Town</label>
                                        <input type="text" class="form-control" id="town" name="town" value="<?php echo $details['town']; ?>" placeholder="Town" required="yes"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $details['phone_number']; ?>" placeholder="Phone Number" required="yes"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $details['email']; ?>" placeholder="Email" required="yes"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_partner">Are You a Partner?  </label>
                                        <input type="radio" name="is_partner" value="Y" required="true"/> Yes 
                                        <input type="radio" name="is_partner" value="N" required="true"/> No 
                                    </div>

                                    <button type="submit" class="btn btn-info">Update</button>
                                </form>

                            </div>
                        </section>
                    <?php } else if ($update_type == "accept_approval") { ?>
                        <section class="panel">
                            <header class="panel-heading">
                                Approve Application
                            </header>
                            <div class="panel-body">
                                <form role="form" method="POST">
                                    <div class="control-group">
                                        <label for="approval_comment">Approval Comment</label>
                                        <textarea type="text" class="form-control" id="approval_comment" name="approval_comment" placeholder="The application meets all the requirements......." required="yes"></textarea>
                                    </div><br />
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </form>
                            </div>
                        </section>
                    <?php } else if ($update_type == "reject_approval") { ?>
                        <section class="panel">
                            <header class="panel-heading">
                                Reject Application
                            </header>
                            <div class="panel-body">
                                <form role="form" method="POST">
                                    <div class="control-group">
                                        <label for="approval_comment">Rejection Comment/Reason</label>
                                        <textarea type="text" class="form-control" id="approval_comment" name="approval_comment" placeholder="Application rejected because....." required="yes"></textarea>
                                    </div><br />
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </form>
                            </div>
                        </section>
                    <?php } else if ($update_type == "activate") { ?>
                        <section class="panel">
                            <header class="panel-heading">
                                Activate Institution
                            </header>
                            <div class="panel-body">
                                <form role="form" method="POST">
                                    <div class="control-group">
                                        <label for="approval_comment">Activation Comment/Reason</label>
                                        <textarea type="text" class="form-control" id="approval_comment" name="approval_comment" placeholder="The institution has updated the required......." required="yes"></textarea>
                                    </div><br />
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </form>
                            </div>
                        </section>
                    <?php } else if ($update_type == "deactivate") { ?>
                        <section class="panel">
                            <header class="panel-heading">
                                Deactivate Institution
                            </header>
                            <div class="panel-body">
                                <form role="form" method="POST">
                                    <div class="control-group">
                                        <label for="approval_comment">Deactivation Comment/Reason</label>
                                        <textarea type="text" class="form-control" id="approval_comment" name="approval_comment" placeholder="The institution has been deactivated because......." required="yes"></textarea>
                                    </div><br />
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </form>
                            </div>
                        </section>
                    <?php } else if ($update_type == "delete") { ?>
                        <section class="panel">
                            <header class="panel-heading">
                                Delete Institution
                            </header>
                            <div class="panel-body">
                                <form role="form" method="POST">
                                    <div class="control-group">
                                        <label for="approval_comment">Deletion Comment/Reason</label>
                                        <textarea type="text" class="form-control" id="approval_comment" name="approval_comment" placeholder="The institution has been deleted because....." required="yes"></textarea>
                                    </div><br />
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </form>
                            </div>
                        </section>
                    <?php } ?>
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>


