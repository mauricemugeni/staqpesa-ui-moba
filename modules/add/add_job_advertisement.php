<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
if (!empty($_POST)) {
    $success = $users->execute();
    if ($success['status'] == 200) {
        $_SESSION['add_success'] = true;
        $_SESSION['feedback_message'] = "<strong>Successful:</strong> The job advert has been created successfully.";
        App::redirectTo("?view_job_advertisements");
    } else {
        $_SESSION['add_fail'] = true;
        $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error creating the job advert. Please try again.";
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
                            Add a Job Advertisement
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="add_job_advertisement"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Credit Officer" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="job_description">Job Description</label>
                                    <textarea name="job_description" class="form-control textarea required" placeholder="Job Description *********** " required="yes"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="tasks">Tasks</label>
                                    <textarea name="tasks" class="form-control textarea required" placeholder="1. *********** \n 2. *********** " required="yes"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="employment_type">Employment Type</label>
                                    <select name="employment_type" class="form-control">          
                                        <option value="Full Time">Full Time</option>
                                        <option value="Part Time">Part Time</option>
                                        <option value="Seasonal">Seasonal</option>
                                        <option value="Casual">Casual</option>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="station">Station</label>
                                    <input type="text" class="form-control" name="station" placeholder="eg. Nairobi, Kenya" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="employment_terms">Employment Terms</label>
                                    <select name="employment_terms" class="form-control">          
                                        <option value="Permanent">Permanent</option>
                                        <option value="Contract">Contract</option>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="required_education">Required Education Level</label>
                                    <select name="required_education" class="form-control">          
                                        <option value="Primary School">Primary School</option>
                                        <option value="Secondary School">Secondary School</option>
                                        <option value="College Certificate">College Certificate</option>
                                        <option value="First Degree">First Degree</option>
                                        <option value="Masters Degree">Masters Degree</option>
                                        <option value="PHD">PHD</option>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="required_skills">Required Skills</label>
                                    <textarea name="required_skills" class="form-control textarea required" placeholder="1. *********** \n 2. *********** " required="yes"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="required_experience">Required Experience</label>
                                    <textarea name="required_experience" class="form-control textarea required" placeholder="1. *********** \n 2. *********** " required="yes"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="compensation_amount">Salary <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                    <input type="number" class="form-control" name="compensation_amount" placeholder="100000" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="other_benefits">Other Benefits</label>
                                    <textarea name="other_benefits" class="form-control textarea required" placeholder="1. *********** \n 2. *********** " required="yes"></textarea>
                                </div>                                
                                <div class="form-group">
                                    <label for="date-group">Application Deadline</label>
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
                                <button type="submit" class="btn btn-info">Submit</button>
                            </form>

                        </div>
                    </section>
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>