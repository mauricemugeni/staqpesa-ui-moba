<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$users = new Users();

if (!empty($_POST)) {
    $createdby = $_POST['createdby'];
    $_SESSION['createdby'] = $createdby;
    $photo = md5("photo" . $createdby . time());
    $profpicture_name = $_FILES['profpicture']['name'];
    $tmp_name_photo = $_FILES['profpicture']['tmp_name'];
    $extension_photo = substr($profpicture_name, strpos($profpicture_name, '.') + 1);
    $profpicture = strtoupper($photo . '.' . $extension_photo);
    $_SESSION['holder_profpicture'] = $profpicture;
    $location1 = 'modules/images/customers/photos/';

    $sign = md5("signature" . $createdby . time());
    $signature_name = $_FILES['signature']['name'];
    $tmp_name_sign = $_FILES['signature']['tmp_name'];
    $extension_sign = substr($signature_name, strpos($signature_name, '.') + 1);
    $signature = strtoupper($sign . '.' . $extension_sign);
    $_SESSION['holder_signature'] = $signature;
    $location2 = 'modules/images/customers/signatures/';

    $_SESSION['holder_firstname'] = $_POST['firstname'];
    $_SESSION['holder_middlename'] = $_POST['middlename'];
    $_SESSION['holder_lastname'] = $_POST['lastname'];
    $_SESSION['holder_gender'] = $_POST['gender'];
    $_SESSION['holder_idnumber'] = $_POST['idnumber'];
    $_SESSION['holder_birthdate'] = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
    $_SESSION['holder_nationality'] = $_POST['nationality'];
    $_SESSION['holder_marital_status'] = $_POST['marital_status'];
    $_SESSION['holder_spouse_firstname'] = $_POST['spouse_firstname'];
    $_SESSION['holder_spouse_middlename'] = $_POST['spouse_middlename'];
    $_SESSION['holder_spouse_lastname'] = $_POST['spouse_lastname'];
    $_SESSION['holder_dependants'] = $_POST['dependants'];
    $_SESSION['holder_signatory'] = $_POST['signatory'];
    $_SESSION['holder_account_number'] = $_SESSION['account'];
    $_SESSION['holder_createdby'] = $_POST['createdby'];
    $_SESSION['holder_createdat'] = time();
    $_SESSION['user_type'] = "ACCOUNT HOLDER";
    $_SESSION['ref_type'] = $users->getUserRefTypeId($_SESSION['user_type']);

    if (move_uploaded_file($tmp_name_photo, $location1 . $profpicture) AND move_uploaded_file($tmp_name_sign, $location2 . $signature)) {
        if (isset($_SESSION['holder_profpicture']) AND isset($_SESSION['holder_signature'])) {
            App::redirectTo("?add_contact&ref_type=" . $_SESSION['ref_type']);
        } else {
            $_SESSION['create_error'] = "Error uploading attachments. Kindly create account holder again.";
        }
    }
}
?>


<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_account.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Account Holder Details
                            <?php 
                            if (isset($_SESSION['add_success'])) {
                                echo $_SESSION['add_record_success'];
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['add_success']);
                            } else if (isset($_SESSION['add_fail'])) {
                                echo $_SESSION['add_record_fail'];
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['add_fail']);
                            }
                            ?>
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <div class="form-group">
                                    <label for="profpicture">Profile Photo File</label>
                                    <input type="file" class="form-control" id="profpicture" name="profpicture"/>
                                </div>
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
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-control">          
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="idnumber">ID/Passport Number</label>
                                    <input type="number" class="form-control" id="idnumber" name="idnumber" placeholder="eg. 98732145" required="yes"/>
                                </div>

                                <div class="form-group">
                                    <label for="date-group">Birth Date</label>
                                    <div class="row" id="date-group">
                                        <div class="col-lg-3">
                                            <select id="day" name="day" class="form-control">          
                                                <?php include 'modules/snippets/day.php'; ?>
                                            </select> 
                                        </div>
                                        <div class="col-lg-6">
                                            <select id="month" name="month" class="form-control">          
                                                <?php include 'modules/snippets/month.php'; ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <select id="year" name="year" class="form-control">  
                                                <?php include 'modules/snippets/year.php'; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nationality">Nationality</label>
                                    <select name="nationality" class="form-control">          
                                        <?php echo $settings->getNationalities(); ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="marital_status">Marital Status</label>
                                    <select name="marital_status" onchange="checkSpouseDetails(this.value);" class="form-control">          
                                        <?php echo $settings->getMaritalStatuses(); ?>
                                    </select> 
                                </div>
                                
								<div class="1 ENGAGED MARRIED box"> <!--1 = MARRIED in the DB. Change to relevant ID if necessary -->
                                    <div class="form-group">
                                        <label for="spouse_firstname">Spouse First Name</label>
                                        <input type="text" class="form-control" id="spouse_firstname" name="spouse_firstname" placeholder="eg. John"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="spouse_middlename">Spouse Middle Name</label>
                                        <input type="text" class="form-control" id="spouse_middlename" name="spouse_middlename" placeholder="eg. Fredrick"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="spouse_lastname">Spouse Last Name</label>
                                        <input type="text" class="form-control" id="spouse_lastname" name="spouse_lastname" placeholder="eg. Kennedy"/>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="dependants">No. of Dependants</label>
                                    <input type="number" class="form-control" id="dependants" name="dependants" placeholder="eg. 10" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="signature">Signature File</label>
                                    <input type="file" name="signature" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label for="signature">Signatory</label>
                                    <input type="radio" name="signatory" value="YES" required="true"/> Yes 
                                    <input type="radio" name="signatory" value="NO" required="true"/> No 
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
