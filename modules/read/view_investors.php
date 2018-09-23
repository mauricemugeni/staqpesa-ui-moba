<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Funding.php";
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$settings = new Settings();
$funding = new Funding();
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_funding.php'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <header class="panel-heading">
                            Investors
                            <?php
                            require_once('modules/menus/sub-sub-menu-buttons.php');
                            if (isset($_SESSION['add_success'])) {
                                echo $_SESSION['add_investor_success'];
                                unset($_SESSION['add_success']);
                            }
                            ?>
                        </header>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>Investor Code</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>ID Number</th>
                                    <th>Nationality</th>
                                    <th>Investor Type</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                </tr> 
                                <?php
                                if (!empty($_POST) AND !isset($_POST['create_pdf'])) {
                                    $info = $funding->execute();
                                } else if (is_menu_set('view_investors_notifications') != "") {
                                    $info = $funding->getAllInvestorNotifications();
                                } else {
                                    $info = $funding->getAllInvestors();
                                }
                                
                                if (isset($_POST['create_pdf'])) {
                                    $_SESSION['author'] = $_SESSION['user_details']['firstname'] . ' ' . $_SESSION['user_details']['lastname'];
                                    $_SESSION['document_name'] = 'investors.pdf';
                                    $_SESSION['title'] = 'Investors';
                                    $_SESSION['key_words'] = 'investor';
                                    $_SESSION['pdf_header_title'] = 'Investors';
                                    $_SESSION['pdf_content'] = $info;
                                    $_SESSION['column_widths'] = array(45, 20, 50, 80, 20, 55);
                                    $_SESSION['column_titles'] = array('DATE CREATED', 'CODE', 'INVESTOR TYPE', 'INVESTOR NAME', 'GENDER', 'STATUS');
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
                                        
                                        $investor_type_details = $funding->fetchInvestorTypeDetails($data['investor_type']);
                                        
                                        if (is_numeric($data['createdby']) == true) {
                                            $staff_details_createdby = $users->fetchStaffDetails($data['createdby']);
                                            $creator = $staff_details_createdby['firstname'] . " " . $staff_details_createdby['middlename'] . " " . $staff_details_createdby['lastname'];
                                        } else {
                                            $creator = $data['createdby'];
                                        }                

                                        echo "<tr>";
                                        echo "<td> <a href='?view_investors_individual&code=" . $data['id'] . "'>" . $data['id'] . "</td>";
                                        echo '<td>' . $data['firstname'] . " " . $data['middlename'] . " " . $data['lastname'] . '</td>';
                                        echo "<td>" . $data['gender'] . "</td>";
                                        echo "<td>" . $data['idnumber'] . "</td>";
                                        echo "<td>" . $data['nationality'] . "</td>";
                                        echo "<td>" . $investor_type_details['name'] . "</td>";
                                        echo '<td>' . $creator . '</td>';
                                        echo "<td>" . $status . "</td>";
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
