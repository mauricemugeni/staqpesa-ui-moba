<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Funding.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
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
                            Projects
                            <?php
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
                                    <th>Bid Amount</th>
                                    <th>Ownership(%)</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                </tr> 

                                <?php
                                if (!empty($_POST)) {
                                    $info = $funding->execute();
                                } else if (is_menu_set('view_project_bids_notifications') != "") {
                                    $info = $funding->getAllProjectBidNotifications();
                                } else {
                                    $info = $funding->getAllAccountProjectBids();
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
                                    echo "</tr>";
                                } else {
                                    foreach ($info as $data) {
                                        $project_details = $funding->fetchProjectDetails($data['project_id']);
//                                        $account_details = $users->fetchAccountDetails($data['bidded_by']);
//                                        $investor_details_biddedby = $funding->fetchInvestorDetails($data['bidded_by']);

                                        if ($data['bid_amount'] > 0 AND $project_details['investment_amount']) {
                                            $ownership = $data['bid_amount'] / $project_details['investment_amount'] * 100;
                                        } else {
                                            $ownership = 0;
                                        }

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
                                        echo "<td>" . $data['bid_amount'] . "</td>";
                                        echo "<td>" . $ownership . "</td>";
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
