<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$users = new Users();
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_system_users.php'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <header class="panel-heading">
                            <?php
                            require_once('modules/menus/sub-sub-menu-buttons.php');
                            if (isset($_SESSION['add_success'])) {
                                echo $_SESSION['add_record_success'];
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['add_success']);
                            }
                            ?>
                            Inbox Messages                         
                        </header>
                        <div class="panel-body">
                            <table class="table table-striped">

                                <tr>
                                    <th>Message ID</th>
                                    <th>Sender's Name</th>
                                    <th>Sender's Email</th>
                                    <th>Sender's Telephone</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>

                                <?php
                                if (!empty($_POST) AND !isset($_POST['create_pdf'])) {
                                    $info = $users->execute();
                                } else if (is_menu_set('view_inbox_messages_notifications') != "") {
                                    $info = $users->getAllInboxMessagesNotifications();
                                } else {
                                    $info = $users->getAllInboxMessages();
                                }

                                if (isset($_POST['create_pdf'])) {
                                    $_SESSION['author'] = $_SESSION['user_details']['firstname'] . ' ' . $_SESSION['user_details']['lastname'];
                                    $_SESSION['document_name'] = 'inbox messages.pdf';
                                    $_SESSION['title'] = 'Inbox Messages';
                                    $_SESSION['key_words'] = 'inbox, message, name, email, phone';
                                    $_SESSION['pdf_header_title'] = 'Inbox Messages';
                                    $_SESSION['pdf_content'] = $info;
                                    $_SESSION['column_widths'] = array(35, 50, 85, 40, 60);
                                    $_SESSION['column_titles'] = array('MESSAGE ID', 'DATE CREATED', 'SENDER\'S NAME', 'TELEPHONE', 'STATUS');
                                    App::redirectTo("?generatepdf");
                                }

                                $total_records = count($info);
                                if (count($info) == 0) {
                                    echo "<tr>";
                                    echo "<td>  No record found.</td>";
                                    echo "<td> </td>";
                                    echo "<td> </td>";
                                    echo "<td> </td>";
                                    echo "<td> </td>";
                                    echo "<td> </td>";
                                    echo "<td> </td>";
                                    echo "<td> </td>";
                                    echo "<td> </td>";
                                    echo "</tr>";
                                } else {
                                    foreach ($info as $data) {
                                        if ($data['status'] == 1000) {
                                            $status = "DELETED";
                                        } else if ($data['status'] == 1001 OR $data['status'] == 1032) {
                                            $status = "AWAITING APPROVAL";
                                        } else if ($data['status'] == 1010) {
                                            $status = "APPROVAL REJECTED";
                                        } else if ($data['status'] == 1011) {
                                            $status = "APPROVAL ACCEPTED";
                                        } else if ($data['status'] == 1020) {
                                            $status = "NOT ACTIVE";
                                        } else if ($data['status'] == 1021) {
                                            $status = "ACTIVE";
                                        }

                                        $staff_details_createdby = $users->fetchStaffDetails($data['assigned_staff']);
                                        
                                        echo "<tr>";
                                        echo "<td> <a href='#'>" . $data['id'] . "</td>";
                                        echo "<td>" . $data['name'] . "</td>";
                                        echo "<td>" . $data['email'] . "</td>";
                                        echo "<td>" . $data['phone_number'] . "</td>";
                                        echo "<td>" . $data['subject'] . "</td>";
                                        echo "<td>" . $data['message'] . "</td>";
                                        echo "<td>" . date("Y-m-d H:i:s", $data['createdat']) . "</td>";
                                        if ($data['status'] == 1001) {
                                            echo "<td> OPEN </td>";
                                        } else {
                                            echo "<td> CLOSED </td>";
                                        }
                                        if ($data['status'] == 1001) {
                                            echo "<td> <a href='?update_inbox_message&update_type=close&code=" . $data['id'] . "'> CLOSE </td>";
                                        } else {
                                            echo "<td> CLOSED </td>";
                                        }
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </table>
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel -->
                </div>
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>
