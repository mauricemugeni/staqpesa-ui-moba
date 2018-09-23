<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Transitional.php";
$transitional_data = new Transitional();
$settings = new Settings();
$loans = new Loans();
if (!empty($_POST)) {
    $_SESSION['guarantor2_firstname'] = $_POST['firstname'];
    $_SESSION['guarantor2_middlename'] = $_POST['middlename'];
    $_SESSION['guarantor2_lastname'] = $_POST['lastname'];
    $_SESSION['guarantor2_gender'] = $_POST['gender'];
    $_SESSION['guarantor2_idnumber'] = $_POST['idnumber'];
    $_SESSION['guarantor2_relationship'] = $_POST['relationship'];
    $_SESSION['guarantor2_phone_number'] = $_POST['phone_number'];
    $_SESSION['guarantor2_postal_address'] = $_POST['postal_address'];
    $_SESSION['guarantor2_physical_address'] = $_POST['physical_address'];
    $_SESSION['guarantor2_place_of_residence'] = $_POST['place_of_residence'];
    $_SESSION['guarantor2_estate'] = $_POST['estate'];
    if (isset($_SESSION['transitional_data'])) {
        $success = $transitional_data->execute();
        if ($success['status'] == 200) {
            $_SESSION['add_success'] = true;
        }
        App::redirectTo("?view_loans_individual&code={$_SESSION['loan']}");
    } else {
        App::redirectTo("?add_loan_contact_person");
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
                            Add Second Loan Guarantor
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <?php if (isset($_SESSION['transitional_data'])) { ?>
                                    <input type="hidden" name="action" value="transitional_add_loan_guarantor"/>
                                    <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
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
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-control">          
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="idnumber">ID Number</label>
                                    <input type="number" class="form-control" id="idnumber" name="idnumber" placeholder="ID Number" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="relationship">Relationship</label>
                                    <input type="text" class="form-control" id="relationship" name="relationship" placeholder="Relationship"/>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Mobile</label>
                                    <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="Mobile" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="postal_address">Postal Address</label>
                                    <input type="number" class="form-control" id="postal_address" name="postal_address" placeholder="Postal Address" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="physical_address">Location</label>
                                    <input type="text" class="form-control" id="physical_address" placeholder="Location" name="physical_address" required/>
                                </div>
                                <div class="form-group">
                                    <label for="place_of_residence">Place of Residence</label>
                                    <input type="text" class="form-control" id="place_of_residence" placeholder="Place of Residence" name="place_of_residence" />
                                </div>
                                <div class="form-group">
                                    <label for="estate">Estate</label>
                                    <input type="text" class="form-control" id="estate" placeholder="Estate" name="estate" />
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