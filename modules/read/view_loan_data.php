<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$loans = new Loans();
unset($_SESSION['loan_data']);
unset($_SESSION['search']);
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_loans.php'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <header class="panel-heading">
                            Loan Data
                            <?php require_once('modules/menus/sub-sub-menu-buttons.php'); ?>
                        </header>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>Loan ID</th>
                                    <th>Marital Status</th>
                                    <th>Spouse Name</th>
                                    <th>Dependants</th>
                                    <th>Landmark</th>
                                </tr>
                                <?php
                                if (!empty($_POST)) {
                                    $info = $loans->execute();
                                } else if (is_menu_set('view_loan_data_notifications') != "") {
                                    $info = $loans->getAllLoanDataNotifications();
                                } else {
                                    $info = $loans->getAllLoanData();
                                }
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
                                        $marital_status = $settings->fetchMaritalStatusDetails($data['marital_status']);
                                        echo '<tr>';
                                        echo "<td> <a href='?view_loan_data_individual&code=" . $data['id'] . "'>" . $data['id'] . '</td>';
                                        echo '<td>' . $marital_status['name'] . '</td>';
                                        echo '<td>' . $data['spouse_firstname'] . " " . $data['spouse_middlename'] . " " . $data['spouse_lastname'] . '</td>';
                                        echo '<td>' . $data['dependants'] . '</td>';
                                        echo '<td>' . $data['landmark'] . '</td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </table>
                        </div><!-- /.panel-body -->
                        <?php // echo $_SESSION['pagination']; ?>
                    </div><!-- /.panel -->
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>