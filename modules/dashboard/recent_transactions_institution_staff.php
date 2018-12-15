<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Reports.php";
$settings = new Settings();
$reports = new Reports();
unset($_SESSION['transaction']);
?>

<div class="col-md-12">
    <section class="panel">
        <header class="panel-heading">
            <i class="fa fa-code-fork"></i> <strong>RECENT TRANSACTIONS</strong>
        </header>
        <div class="panel-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Transaction Type</th>
                        <th>Date/Time</th>
                        <th>Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></th>
                        <th>Account Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $info = $reports->getRecentTransactions();
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
                            $settings = new Settings();
                            $transaction_type_details = $settings->fetchTransactionTypeDetails($data['transaction_type']);

                            echo '<tr>';
                            echo "<td> <a href='#'>" . $data['id'] . '</td>';
                            echo '<td>' . $transaction_type_details['name'] . '</td>';
                            echo '<td>' . date("Y-m-d H:i:s", $data['createdat']) . '</td>';
                            echo '<td>' . number_format($data['amount'], 2) . '</td>';
                            echo '<td>' . $data['account_number'] . '</td>';
                            echo '</tr>';

                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</div><!--end col-6 -->