<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Reports.php";
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Funding.php";
$funding = new Funding();
$users = new Users();
$reports = new Reports();
unset($_SESSION['project']);
?>

<div class="col-md-8">
    <div class="panel">
        <header class="panel-heading">
            <i class="fa fa-code-fork"></i> <strong>TOP PROJECTS</strong>
        </header>
        <div class="panel-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Project</th>
                        <th>Number of Bids</th>
                        <th>Value of Bids</th>
                        <th style='text-align:right;'>Balance<?php echo '(' . $_SESSION['currency'] . ')'; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $info = $reports->getAllTopProjects();
                    $total_records = count($info);
                    if (count($info) == 0) {
                        echo "<tr>";
                        echo "<td>  No record found.</td>";
                        echo "<td> </td>";
                        echo "<td> </td>";
                        echo "<td> </td>";
                        echo "<td> </td>";
                        echo "</tr>";
                    } else {
                        foreach ($info as $data) {
                            $number_of_project_bids = $reports->countAllBidsByProject($data['id']);
                            $value_of_project_bids = $reports->sumAllBidsByProject($data['id']);
                            $bid_balance_details = $funding->fetchProjectBidBalanceDetails($data['id']);
                            echo "<tr>";
                            echo "<td> <a href='?view_projects_individual&code=" . $data['id'] . "'>" . $data['id'] . "</td>";
                            echo "<td>" . $data['title'] . "</td>";
                            echo "<td>" . $number_of_project_bids . "</td>";
                            echo "<td style='text-align:right;'>" . number_format($value_of_project_bids, 2) . "</td>";
                            echo "<td style='text-align:right;'>" . number_format($bid_balance_details['bid_balance'], 2) . "</td>";


                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div><!--end col-6 -->