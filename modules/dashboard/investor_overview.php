<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Funding.php";
require_once WPATH . "modules/classes/Reports.php";
$reports = new Reports();
$funding = new Funding();
?>

<div class="col-md-4">
    <div class="panel">
        <header class="panel-heading">
            <i class="fa fa-rocket"></i> <strong>RECENT INVESTOR ACTIVITY</strong>
        </header>
        <div class="panel-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Last Login</th>
                </tr>
                <?php
                $info = $reports->getRecentInvestorActivity();
                if (count($info) == 0) {
                    echo "<tr>";
                    echo "<td>  No record found.</td>";
                    echo "<td> </td>";
                    echo "<td> </td>";
                    echo "</tr>";
                } else {
                    foreach ($info as $data) {
                        $investor_details = $funding->fetchInvestorDetails($data['ref_id']);
                        echo "<tr>";
                        echo "<td> <a href='?view_investors_individual&code=" . $data['ref_id'] . "'>" . $data['ref_id'] . "</td>";
                        echo "<td>" . $staff_details['firstname'] . " " . $staff_details['middlename'] . " " . $staff_details['lastname'] . "</td>";
                        echo "<td>" . date("Y-m-d H:i:s", $data['lastlogin']) . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table>
        </div><!-- /.panel-body -->
    </div><!-- /.panel -->
</div>