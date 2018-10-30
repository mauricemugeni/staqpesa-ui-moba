<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Funding.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$funding = new Funding();
$code = $_SESSION['investor'];
$update_type = $_GET['update_type'];
$details = $funding->fetchInvestorDetails($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $funding->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_investors");
    }
} else {
    $success = $funding->updateInvestor($code, $update_type);
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = "Record successfully updated";
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_error'] = "Error updating record";
    }
    App::redirectTo("?view_investors");
}
?>


<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_funding.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Update Investor
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_investor"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $details['firstname']; ?>" placeholder="Name" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="middlename">Middle Name</label>
                                    <input type="text" class="form-control" id="middlename" name="middlename" value="<?php echo $details['middlename']; ?>" placeholder="Description" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $details['lastname']; ?>" placeholder="Description" required="yes"/>
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
                                    <input type="number" class="form-control" id="idnumber" name="idnumber" value="<?php echo $details['idnumber']; ?>" placeholder="ID Number" required="yes"/>
                                </div>

                                <!--                                <div class="form-group">
                                                                    <label for="date-group">Birth Date</label>
                                                                    <div class="row" id="date-group">
                                                                        <div class="col-lg-3">
                                                                            <select id="day" name="day" class="form-control">          
                                <?php // include 'modules/snippets/day.php'; ?>
                                                                            </select> 
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <select id="month" name="month" class="form-control">          
                                <?php // include 'modules/snippets/month.php'; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <select id="year" name="year" class="form-control">  
                                <?php // include 'modules/snippets/year.php'; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                                <div class="form-group">
                                    <label for="nationality">Nationality</label>
                                    <select name="nationality" class="form-control">          
                                        <?php echo $settings->getNationalities(); ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" name="description" value="<?php echo $details['description']; ?>" placeholder="Description" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="investor_type">Investor Type</label>
                                    <select name="investor_type" class="form-control">          
                                        <?php echo $funding->getInvestorTypes(); ?>
                                    </select> 
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
