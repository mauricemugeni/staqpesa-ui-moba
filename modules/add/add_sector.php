<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
if (!empty($_POST)) {
    $filename = md5($_POST['createdby'] . time());
    $cover_photo_name = $_FILES['cover_photo']['name'];
    $tmp_name = $_FILES['cover_photo']['tmp_name'];
    $cover_photo_type = $_FILES['cover_photo']['type'];
    $extension = substr($cover_photo_name, strpos($cover_photo_name, '.') + 1);
    $cover_photo = strtoupper($filename . '.' . $extension);
    $_SESSION['filename'] = $cover_photo;

    $url = $_SESSION['website_url'] . '/?admin_requests&';

    $cfile = new CURLFile($tmp_name, $cover_photo_type, $cover_photo_name);
    $data = array("cover_photo" => $cfile, "cover_name" => $cover_photo);

    $curl_session = curl_init();
    curl_setopt($curl_session, CURLOPT_URL, $url);
    curl_setopt($curl_session, CURLOPT_POST, true);
    curl_setopt($curl_session, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl_session);
    curl_close($curl_session);

    if ($response == true) {
        $success = $settings->execute();
        if ($success['status'] == 200) {
            $_SESSION['add_success'] = true;
            $_SESSION['feedback_message'] = "<strong>Successful:</strong> The sector has been created successfully.";
            App::redirectTo("?view_sectors");
        } else {
            $_SESSION['add_fail'] = true;
            $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error creating the sector. Please try again.";
        }
    } else {
        $_SESSION['add_error'] = "Error uploading the sector's cover photo. Kindly add the sector again.";
    }
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_settings.php'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Sector
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
                                <input type="hidden" name="action" value="add_sector"/>
                                <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                <div class="form-group">
                                    <label for="name">Sector Name</label>
                                    <input type="text" class="form-control" id="status_code" name="name" placeholder="eg. Education" required="yes"/>
                                </div>                                
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control textarea required" placeholder="eg. ICT Innovators Society supports ventures that bridge the gap in skills-based training, provide access to continual learning, and a higher quality education........ " required="yes"></textarea>
                                </div>                                                               
                                <div class="form-group">
                                    <label for="cover_photo">Sector Cover Photo</label>
                                    <input type="file" class="form-control" id="cover_photo" name="cover_photo"/>
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