<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Funding.php";
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
                            Projects Bids
                            <?php
                            require_once('modules/menus/sub-sub-menu-buttons.php');
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
                                    <th>Bid ID</th>
                                    <th>Project Name</th>
                                    <th>Was Bid By</th>
                                    <th>Bid Amount <?php echo '(' . $_SESSION['chapter_details']['currency'] . ')'; ?></th>
                                    <th>Bid Balance <?php echo '(' . $_SESSION['chapter_details']['currency'] . ')'; ?></th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                </tr> 

                                <?php
                                if (!empty($_POST) AND !isset($_POST['create_pdf'])) {
                                    $info = $funding->execute();
                                } else if (is_menu_set('view_project_bids_notifications') != "") {
                                    $info = $funding->getAllProjectBidNotifications();
                                } else if (isset($_SESSION['investor'])) {
                                    $info = $funding->getAllInvestorProjectBids();
                                } else if (isset($_SESSION['account'])) {
                                    $info = $funding->getAllAccountProjectBids();
                                } else {
                                    $info = $funding->getAllProjectBids();
                                }
                                
                                if (isset($_POST['create_pdf'])) {
                                    $_SESSION['author'] = $_SESSION['user_details']['firstname'] . ' ' . $_SESSION['user_details']['lastname'];
                                    $_SESSION['document_name'] = 'project bids.pdf';
                                    $_SESSION['title'] = 'Project Bids';
                                    $_SESSION['key_words'] = 'project, bid';
                                    $_SESSION['pdf_header_title'] = 'Project Bids';
                                    $_SESSION['pdf_content'] = $info;
                                    $_SESSION['column_widths'] = array(45, 90, 55, 25, 55);
                                    $_SESSION['column_titles'] = array('DATE CREATED', 'BID ID', 'BIDDER', 'AMOUNT', 'STATUS');
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
                                    echo "</tr>";
                                } else {
                                    foreach ($info as $data) {
                                        $project_details = $funding->fetchProjectDetails($data['project_id']);
                                        $investor_details_biddedby = $funding->fetchInvestorDetails($data['bidded_by']);
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
                                        echo "<tr>";
                                        echo "<td> <a href='?view_project_bids_individual&code=" . $data['id'] . "'>" . $data['id'] . "</td>";
                                        echo "<td>" . $project_details['title'] . "</td>";
                                        echo "<td>" . $investor_details_biddedby['firstname'] . " " . $investor_details_biddedby['middlename'] . " " . $investor_details_biddedby['lastname'] . "</td>";
                                        echo "<td>" . number_format($data['bid_amount'], 2) . "</td>";
                                        echo "<td>" . number_format($data['bid_balance'], 2) . "</td>";
                                        echo "<td>" . date("Y-m-d H:i:s", $data['createdat']) . "</td>";
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
