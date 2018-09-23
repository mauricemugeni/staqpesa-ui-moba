<div class="col-md-4">
    <div class="panel">
        <header class="panel-heading">
            <i class="fa fa-rocket"></i> <strong>RECENT INVESTMENTS</strong>

        </header>
        <div class="panel-body">
            <table class="table table-bordered">
                <tr>
                    <th>Bid ID</th>
                    <th>Amount</th>
                </tr>
                <?php
                $info = $reports->getRecentInvestorInvestments();
                if (count($info) == 0) {
                    echo "<tr>";
                    echo "<td>  No record found.</td>";
                    echo "<td> </td>";
                    echo "</tr>";
                } else {
                    foreach ($info as $data) {
                        echo "<tr>";
                        echo "<td> <a href='?view_project_bids_individual&code=" . $data['id'] . "'>" . $data['id'] . "</td>";
                        echo "<td>" . $data['bid_amount'] . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table>
        </div><!-- /.panel-body -->
    </div><!-- /.panel -->
</div>