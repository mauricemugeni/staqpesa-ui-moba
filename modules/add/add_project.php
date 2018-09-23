<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Funding.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$funding = new Funding();
if (!empty($_POST)) {
    $createdby = $_POST['createdby'];
    $biz_plan = md5("biz_plan" . $createdby . time());
    $biz_plan_name = $_FILES['business_plan']['name'];
    $tmp_name_biz_plan = $_FILES['business_plan']['tmp_name'];
    $biz_plan_type = $_FILES['business_plan']['type'];
    $extension_biz_plan = substr($biz_plan_name, strpos($biz_plan_name, '.') + 1);
    $business_plan = strtoupper($biz_plan . '.' . $extension_biz_plan);
    $_SESSION['business_plan'] = $business_plan;
    $location = 'modules/images/projects/business_plans/';
    
    $logo = md5("project_logo" . $createdby . time());
    $project_logo_name = $_FILES['project_logo']['name'];
    $tmp_name_project_logo = $_FILES['project_logo']['tmp_name'];
    $project_logo_type = $_FILES['project_logo']['type'];
    $extension_logo = substr($project_logo_name, strpos($project_logo_name, '.') + 1);
    $project_logo = strtoupper($logo . '.' . $extension_logo);
    $_SESSION['project_logo'] = $project_logo;
    $location2 = 'modules/images/projects/logos/';
    
     $url = 'http://localhost/innovators_sacco_website/?admin_requests&';
//    $url = 'http://ictinnovators.co.ug/?admin_requests&';


    $business_plan_file = new CURLFile($tmp_name_biz_plan, $biz_plan_type, $biz_plan_name);
    $project_logo_file = new CURLFile($tmp_name_project_logo, $project_logo_type, $project_logo_name);
    $data = array("business_plan" => $business_plan_file, "business_plan_name" => $business_plan, "project_logo" => $project_logo_file, "project_logo_name" => $project_logo);

    $curl_session = curl_init();
    curl_setopt($curl_session, CURLOPT_URL, $url);
    curl_setopt($curl_session, CURLOPT_POST, true);
    curl_setopt($curl_session, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl_session);
    curl_close($curl_session);

    if ($response == true) {
    
//    if (move_uploaded_file($tmp_name_biz_plan, $location . $business_plan) AND move_uploaded_file($tmp_name_project_logo, $location2 . $project_logo)) {
        $success = $funding->execute();
        if ($success['status'] == 200) {
            $_SESSION['add_success'] = true;
            $_SESSION['feedback_message'] = "<strong>Successful:</strong> The project has been created successfully.";
            App::redirectTo("?view_projects");
        } else {
            $_SESSION['add_fail'] = true;
            $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error creating the project. Please try again.";
        }
    } else {
        $_SESSION['create_error'] = "Error uploading attachments. Kindly create project again.";
    }
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
                            Add Project
                            <?php
                            if (isset($_SESSION['add_fail'])) {
                                echo $_SESSION['add_record_fail'];
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['add_fail']);
                            }
                            ?>
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="add_project"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <?php if ($_SESSION['logged_in_user_type_details']['name'] == "ACCOUNT HOLDER") { ?>
                                    <div class="form-group">
                                        <label for="owner">Owner's Name</label>
                                        <input type="text" class="form-control" id="owner" name="owner" placeholder="Owner's Account Number" value="<?php echo $_SESSION['account']; ?>" readonly="yes"/>
                                    </div>                                    
                                <?php } else { ?>
                                    <div class="form-group">
                                        <label for="owner">Owner's Name</label>
                                        <input type="text" class="form-control" id="owner" name="owner" placeholder="Owner's Account Number" required="yes"/>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="title">Project Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="eg. Staqpesa Solution" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="description">Project Description</label>
                                    <textarea name="description" class="form-control textarea required" placeholder="eg. Staqpesa Solution is a ************************* " required="yes"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="business_plan">Business Plan</label>
                                    <input type="file" class="form-control" id="business_plan" name="business_plan"/>
                                </div>                                
                                <div class="form-group">
                                    <label for="project_logo">Project Logo</label>
                                    <input type="file" class="form-control" id="project_logo" name="project_logo"/>
                                </div>
                                <div class="form-group">
                                    <label for="sector">Sector</label>
                                    <select name="sector" class="form-control">  
<!--                                        <option value="1">AGRICULTURE</option>
                                        <option value="2">EDUCATION</option>
                                        <option value="3">ENERGY</option>
                                        <option value="4">FINANCE</option>
                                        <option value="5">HEALTH</option>
                                        <option value="6">ICT</option>-->
                                        
                                        <?php echo $settings->getSectors(); ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="funding_type">Funding Type</label>
                                    <select name="funding_type" class="form-control">          
                                        <?php echo $funding->getFundingTypes(); ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="financing_method">Financing Method</label>
                                    <select name="financing_method" class="form-control">          
                                        <?php echo $funding->getFinancingMethods(); ?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="investment_amount">Investment Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="text" class="form-control" id="investment_amount" name="investment_amount" placeholder="eg. 10000000" required="yes"/>
                                </div>
                                <div class="form-group checkbox">
                                    <label>
                                        <input type="checkbox" name="terms_and_conditions" value="" required="true"> I accept ICT Innovators' <a href="?website_tac">terms and conditions</a>
                                    </label>
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
