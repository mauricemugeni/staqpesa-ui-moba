<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Funding.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$funding = new Funding();
unset($_SESSION['project']);
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
                            Projects
                            <?php require_once('modules/menus/sub-sub-menu-buttons.php'); 
                            if (isset($_SESSION['add_success'])) {
                                echo $_SESSION['add_record_success'];
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['add_success']);
                            }
                            ?>
                        </header>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>Code</th>
                                    <th>Title</th>
                                    <th>Funding Type</th>
                                    <th>Financing Method</th>
                                    <th>Investment Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></th>
                                    <th>Outstanding Balance <?php echo '(' . $_SESSION['currency'] . ')'; ?></th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                </tr> 

                                <?php
                                if (!empty($_POST) AND !isset($_POST['create_pdf'])) {
                                    $info = $funding->execute();
                                } else if (is_menu_set('view_projects_notifications') != "") {
                                    $info = $funding->getAllProjectNotifications();
                                } else if (isset($_SESSION['account'])) {
                                    $info = $funding->getAllAccountProjects();
                                } else if (isset($_SESSION['investor'])) {
                                    $info = $funding->getAllInvestorProjects();
                                } else {
                                    $info = $funding->getAllProjects();
                                }
                                
                                if (isset($_POST['create_pdf'])) {
                                    $_SESSION['author'] = $_SESSION['user_details']['firstname'] . ' ' . $_SESSION['user_details']['lastname'];
                                    $_SESSION['document_name'] = 'projects.pdf';
                                    $_SESSION['title'] = 'Projects';
                                    $_SESSION['key_words'] = 'project';
                                    $_SESSION['pdf_header_title'] = 'Projects';
                                    $_SESSION['pdf_content'] = $info;
                                    $_SESSION['column_widths'] = array(45, 20, 100, 50, 55);
                                    $_SESSION['column_titles'] = array('DATE CREATED', 'CODE', 'PROJECT TITLE', 'PROJECT OWNER', 'STATUS');
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
                                        
                                        $bid_balance_details = $funding->fetchProjectBidBalanceDetails($data['id']);    
                                        $funding_type_details = $funding->fetchFundingTypeDetails($data['funding_type']);
                                        $financing_method_details = $funding->fetchFinancingMethodDetails($data['financing_method']);
                                        
                                        if (is_numeric($data['createdby']) == true) {
                                            $staff_details_createdby = $users->fetchStaffDetails($data['createdby']);
                                            $creator = $staff_details_createdby['firstname'] . " " . $staff_details_createdby['middlename'] . " " . $staff_details_createdby['lastname'];
                                        } else {
                                            $creator = $data['createdby'];
                                        }                                        
                                        
                                        echo "<tr>";
                                        echo "<td> <a href='?view_projects_individual&code=" . $data['id'] . "'>" . $data['id'] . "</td>";
                                        echo "<td>" . $data['title'] . "</td>";
                                        echo "<td>" . $funding_type_details['name'] . "</td>";
                                        echo "<td>" . $financing_method_details['name'] . "</td>";
                                        echo "<td>" . number_format($data['investment_amount'], 2) . "</td>";
                                        echo "<td>" . number_format($bid_balance_details['bid_balance'], 2) . "</td>";
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
