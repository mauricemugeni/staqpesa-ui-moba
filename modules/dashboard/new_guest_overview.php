<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Reports.php";
$reports = new Reports();
?>

<div class="col-md-4">
    <div class="panel">
        <header class="panel-heading">
            <i class="fa fa-user"></i> <strong>RECENT GUEST SIGN UPS</strong>
        </header>
        <div class="panel-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                </tr>

                <?php
                $info = $reports->getRecentGuestUsers();
                if (count($info) == 0) {
                    echo "<tr>";
                    echo "<td>  No record found.</td>";
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
                        echo "<tr>";
                        echo "<td> <a href='?view_guest_users_individual&code=" . $data['id'] . "'>" . $data['id'] . "</td>";
                        echo "<td>" . $data['firstname'] . " " . $data['lastname'] . "</td>";
                        echo "<td>" . $status . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table>
        </div><!-- /.panel-body -->
    </div><!-- /.panel -->
</div>