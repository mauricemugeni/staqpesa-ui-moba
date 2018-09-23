<?php
//if (!App::isLoggedIn()) App::redirectTo("?");
//require_once WPATH . "modules/menus/tmenu.php";
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Transitional.php";
$transitional_data = new Transitional();
$settings = new Settings();
$loans = new Loans();

if (!empty($_POST)) {
    if (isset($_SESSION['transitional_data'])) {
        $success = $transitional_data->execute();
        if ($success['status'] == 200) {
            $_SESSION['add_success'] = true;
        }
        App::redirectTo("?view_loans_individual&code={$_SESSION['loan']}");
    } else {
        $_SESSION['loan_contact_person_firstname'] = $_POST['firstname'];
        $_SESSION['loan_contact_person_middlename'] = $_POST['middlename'];
        $_SESSION['loan_contact_person_lastname'] = $_POST['lastname'];
        $_SESSION['loan_contact_person_workplace'] = $_POST['workplace'];
        $_SESSION['loan_contact_person_relationship'] = $_POST['relationship'];
        $_SESSION['loan_contact_person_phone_number'] = $_POST['phone_number'];
        $_SESSION['loan_contact_person_postal_address'] = $_POST['postal_address'];
        $_SESSION['loan_contact_person_physical_address'] = $_POST['physical_address'];
        $success = $loans->execute();
        if ($success['status'] == 200) {
            $_SESSION['add_success'] = true;
        }
        App::redirectTo("?view_loans");
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
                            Add Branch
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <?php if (isset($_SESSION['transitional_data'])) { ?>
                                    <input type="hidden" name="action" value="transitional_add_loan_contact_person"/>
                                    <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <?php } else { ?>                        
                                    <input type="hidden" name="action" value="add_loan">
                                <?php } ?> 
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="middlename">Middle Name</label>
                                    <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle Name" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="relationship">Relationship</label>
                                    <input type="text" class="form-control" id="relationship" name="relationship" placeholder="Relationship" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="workplace">Workplace</label>
                                    <input type="text" class="form-control" id="workplace" name="workplace" placeholder="Workplace" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Mobile</label>
                                    <input type="text" class="form-control" id="phone_number" placeholder="Mobile" name="phone_number" />
                                </div>
                                <div class="form-group">
                                    <label for="postal_address">Postal Address</label>
                                    <input type="text" class="form-control" id="postal_address" placeholder="Postal Address" name="postal_address" />
                                </div>
                                <div class="form-group">
                                    <label for="physical_address">Physical Address</label>
                                    <input type="text" class="form-control" id="physical_address" placeholder="Physical Address" name="physical_address" required/>
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