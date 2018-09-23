<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Reports.php";
$settings = new Settings();
$reports = new Reports();
?>

    <div class="panel">
        <header class="panel-heading">
            <i class="fa fa-dollar"></i> <strong>RECENT TRANSACTIONS</strong>
        </header>
        <div class="panel-body">
            <table class="table table-bordered">
                <tr>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Date/Time</th>
                </tr>
                <?php
                $info = $reports->getRecentTransactions();
                if (count($info) == 0) {
                    echo "<tr>";
                    echo "<td>  No record found.</td>";
                    echo "<td> </td>";
                    echo "<td> </td>";
                    echo "</tr>";
                } else {
                    foreach ($info as $data) {
                        $settings = new Settings();
                        $transaction_type_details = $settings->fetchTransactionTypeDetails($data['transaction_type']);
                        echo "<tr>";
                        echo "<td>" . $transaction_type_details['name'] . "</td>";
                        echo "<td>" . $data['amount'] . "</td>";
                        echo "<td>" . date("Y-m-d H:i:s", $data['createdat']) . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table>
        </div>
    </div>