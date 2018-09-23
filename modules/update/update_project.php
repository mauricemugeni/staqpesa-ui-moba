<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Funding.php";
$funding = new Funding();
$code = $_SESSION['project'];
$update_type = $_GET['update_type'];
$details = $funding->fetchProjectDetails($code);

if ($update_type == "edit") {
    if (!empty($_POST)) {
        $success = $funding->execute();
        if (is_bool($success) && $success == true) {
            $_SESSION['update_success'] = "Successfully updated details";
        } else if (is_bool($success) && $success == false) {
            $_SESSION['update_error'] = "Failed updating details";
        }
        App::redirectTo("?view_projects");
    }
} else {
    $success = $funding->updateProject($code, $update_type);
    if (is_bool($success) && $success == true) {
        $_SESSION['update_success'] = "Record successfully updated";
    } else if (is_bool($success) && $success == false) {
        $_SESSION['update_error'] = "Error updating record";
    }
    App::redirectTo("?view_projects");
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
                            Update Project
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="edit_project"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <div class="form-group">
                                    <label for="owner">Owner</label>
                                    <input type="text" class="form-control" id="owner" name="owner" value="<?php echo $details['owner']; ?>" placeholder="Owner" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="title">Project Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $details['title']; ?>" placeholder="Project Title" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" name="description" value="<?php echo $details['description']; ?>" placeholder="Description" required="yes"/>
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
                                    <input type="text" class="form-control" id="investment_amount" name="investment_amount" value="<?php echo $details['investment_amount']; ?>" placeholder="Investment Amount" required="yes"/>
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
