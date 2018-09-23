<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$users = new Users();

if (!empty($_POST)) {

    $createdby = $_POST['createdby'];
    $filename = md5($createdby . time());
    $profpicture_name = $_FILES['profpicture']['name'];
    $tmp_name = $_FILES['profpicture']['tmp_name'];
    $extension = substr($profpicture_name, strpos($profpicture_name, '.') + 1);
    $profpicture = strtoupper($filename . '.' . $extension);
    $_SESSION['filename'] = $profpicture;
    $location = 'modules/images/staff/';

    $_SESSION['firstname'] = $_POST['firstname'];
    $_SESSION['middlename'] = $_POST['middlename'];
    $_SESSION['lastname'] = $_POST['lastname'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['idnumber'] = $_POST['idnumber'];
    $_SESSION['branch'] = $_POST['branch'];
    $_SESSION['position'] = $_POST['position'];
    $_SESSION['role'] = $_POST['role'];
    $_SESSION['createdby'] = $_POST['createdby'];
    $_SESSION['staff_id'] = $users->getNextStaffId();
    $_SESSION['createdat'] = time();
    $_SESSION['ref_type'] = $users->getUserRefTypeId($_POST['user_type']);

    if (move_uploaded_file($tmp_name, $location . $profpicture)) {
        if (isset($_SESSION['filename'])) {
            App::redirectTo("?add_contact&ref_type=" . $_SESSION['ref_type']);
        }
    } else {
        $_SESSION['create_error'] = "Error uploading photo. Kindly create staff again.";
    }
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_system_users.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Staff
                            <?php                            
                            if (isset($_SESSION['add_fail'])) {
                                echo $_SESSION['add_record_fail'];
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['add_fail']);
                            }                            
                            ?>
                        </header>
                        <div class="panel-body">
                            <form method="POST" role="form" enctype="multipart/form-data">
                                <input type="hidden" name="user_type" value="STAFF">
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>

                                <div class="form-group">
                                    <label for="profpicture">Profile Photo File</label>
                                    <input type="file" class="form-control" id="profpicture" name="profpicture"/>
                                </div>
                                <div class="form-group">
                                    <div class="row" id="date-group">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="firstname">First Name</label>
                                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="eg. John" required="yes"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="middlename">Middle Name</label>
                                                <input type="text" class="form-control" id="middlename" name="middlename" placeholder="eg. Fredrick" required="yes"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="lastname">Last Name</label>
                                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="eg. Kennedy" required="yes"/>
                                            </div>
                                        </div>
                                    </div>
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
                                    <input type="text" class="form-control" id="idnumber" name="idnumber" placeholder="eg. 78936412" required="yes"/>
                                </div>

                                <div class="form-group">
                                    <label for="branch">Branch Name</label>
                                    <select name="branch" class="form-control">          
                                        <?php echo $settings->getBranches(); ?> 
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="position">Position</label>
                                    <select name="position" class="form-control">          
                                        <?php echo $users->getPositions(); ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role" class="form-control">  
                                        <?php echo $users->getPositions(); ?>
                                        <?php // echo $users->getRoles(); ?>
                                        <?php // echo $users->getStaffUserTypes(); ?>
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