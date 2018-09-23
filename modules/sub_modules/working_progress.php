<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Funding.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$funding = new Funding();
?>

<div class="col-md-12">
    <section class="panel">
        <header class="panel-heading">
            <i class="fa fa-code-fork"></i> Top Projects
        </header>
        <div class="panel-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Project</th>
                        <th>Manager</th>
                        <!-- <th>Client</th> -->
                        <th>Funding Type</th>
                        <!-- <th>Price</th> -->
                        <th>Financing</th>
                        <th style='text-align:right;'>Funding Completion<?php echo '(' . $_SESSION['chapter_details']['currency'] . ')'; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($_POST)) {
                        $info = $funding->execute();
                    } else if (is_menu_set('view_projects_notifications') != "") {
                        $info = $funding->getAllProjectNotifications();
                    } else {
                        $info = $funding->getAllProjects();
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

                            $funding_type_details = $funding->fetchFundingTypeDetails($data['funding_type']);
                            $staff_details_createdby = $users->fetchStaffDetails($data['createdby']);
                            $financing_method_details = $funding->fetchFinancingMethodDetails($data['financing_method']);

                            echo "<tr>";
                            echo "<td> <a href='?view_projects_individual&code=" . $data['id'] . "'>" . $data['id'] . "</td>";
                            echo "<td>" . $data['title'] . "</td>";
                            echo '<td>' . $staff_details_createdby['firstname'] . " " . $staff_details_createdby['lastname'] . '</td>';
                            echo "<td>" . $funding_type_details['name'] . "</td>";
                            echo "<td>" . $financing_method_details['name'] . "</td>";
                            echo "<td style='text-align:right;'>" . number_format($data['investment_amount'], 2) . "</td>";


                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</div><!--end col-6 -->