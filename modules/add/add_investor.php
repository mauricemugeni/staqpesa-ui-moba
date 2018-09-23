<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Funding.php";
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$settings = new Settings();
$funding = new Funding();
if (!empty($_POST)) {
    $_SESSION['firstname'] = $_POST['firstname'];
    $_SESSION['middlename'] = $_POST['middlename'];
    $_SESSION['lastname'] = $_POST['lastname'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['idnumber'] = $_POST['idnumber'];

    $_SESSION['birthdate'] = "2017-01-01";

//    $_SESSION['birthdate'] = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];

    $_SESSION['nationality'] = $_POST['nationality'];
    $_SESSION['description'] = $_POST['description'];

//    $_SESSION['investor_type'] = 1;

    $_SESSION['investor_type'] = $_POST['investor_type'];

    $_SESSION['user_type'] = $_POST['user_type'];
    $_SESSION['createdby'] = $_POST['createdby'];
    $_SESSION['investor_id'] = $funding->getNextInvestorId();
    $_SESSION['ref_type'] = $users->getUserRefTypeId($_POST['user_type']);

    App::redirectTo("?add_contact&ref_type=" . $_SESSION['ref_type']);
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_funding.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Investor
                            <?php
                            if (isset($_SESSION['add_fail'])) {
                                echo $_SESSION['add_record_fail'];                                
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['add_fail']);
                            }
                            ?>
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="user_type" value="INVESTOR">
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
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
                                    <label for="idnumber">ID/Passport Number</label>
                                    <input type="number" class="form-control" id="idnumber" name="idnumber" placeholder="ID Number" required="yes"/>
                                </div>

                                <!--
                                                                <div class="form-group">
                                                                    <label for="date-group">Date of Birth</label>
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
                                                                </div>
                                -->

                                <div class="form-group">
                                    <label for="nationality">Nationality</label>
                                    <select name="nationality" class="form-control">          
                                        <?php echo $settings->getNationalities(); ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control textarea required" placeholder="Description *********** " required="yes"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="investor_type">Investor Type</label>
                                    <select name="investor_type" class="form-control">          
                                        <?php echo $funding->getInvestorTypes(); ?>
                                    </select> 
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
