
<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
if (!empty($_POST)) {
    $success = $users->execute();
    if ($success['status'] == 200) {
        $_SESSION['add_success'] = true;
    } else {
        $_SESSION['add_fail'] = true;
    }
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Get in touch with us:

                            <?php if (isset($_SESSION['add_success']) && $_SESSION['add_success'] == true) { ?>
                                <div class="alert alert-info fade in">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Successful:</strong> Your enquiry has been sent successfully. 
                                </div>
                                <?php
                                unset($_SESSION['add_success']);
                            }
                            if (isset($_SESSION['add_fail']) && $_SESSION['add_fail'] == true) {
                                ?>
                                <div class="alert alert-block alert-error fade in">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Error!</strong> There was an error sending your enquiry. Please try again.
                                </div>
                                <?php
                                unset($_SESSION['add_fail']);
                            }
                        ?>
                        </header>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <input type="hidden" name="action" value="add_contact_us_message"/>
                                <input type="hidden" name="source" value="WEB SYSTEM" />
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required="yes"/>
                                </div>
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="message" class="form-control textarea required" placeholder="Message ****************** " required="yes"></textarea>
                                </div>
                                <button type="submit" class="btn btn-info">Send</button>
                            </form>

                        </div>
                    </section>
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>
