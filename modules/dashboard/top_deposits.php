<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Reports.php";
$reports = new Reports();
unset($_SESSION['deposit']);
?>

<div class="panel">
    <header class="panel-heading">
        <i class="fa fa-code-fork"></i> <strong>TOP DEPOSITS</strong>
    </header>
    <div class="panel-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Date Deposited</th>
                    <th>Account Number</th>
                    <th>Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $info = $reports->getAllTopDeposits();
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
                        echo '<tr>';
                        echo "<td> <a href='#'>" . $data['id'] . '</td>';
                        echo '<td>' . date("Y-m-d", $data['createdat']) . '</td>';
                        echo '<td>' . $data['account_number'] . '</td>';
                        echo '<td style="text-align:right;">' . number_format($data['amount'], 2) . '</td>';
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>