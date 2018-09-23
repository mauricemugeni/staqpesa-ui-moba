<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$loans = new Loans();
unset($_SESSION['loan_type']);
unset($_SESSION['search']);
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_settings.php'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <header class="panel-heading">
                            Loan Types
                            <?php require_once('modules/menus/sub-sub-menu-buttons.php'); 
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
                                    <th>Name</th>
                                    <th>Qualification Time(Months)</th>
                                    <th>Interest Rate(%)</th>
                                    <th>Instalment Frequency</th>                                    
                                    <th>Default Rate(%)</th>
                                    <th>Status</th>
                                </tr>                               

                                <?php
                            if (!empty($_POST)) {
                                $info = $loans->execute();
                            } else if (is_menu_set('view_loan_types_notifications') != "") {
                                $info = $loans->getAllLoanTypeNotifications();
                            } else {
                                $info = $loans->getAllLoanTypes();
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

                                    $instalment_frequency = $loans->fetchInstalmentFrequencyDetails($data['instalment_frequency']);

                                    echo '<tr>';
                                    echo "<td> <a href='?view_loan_types_individual&code=" . $data['id'] . "'>" . $data['name'] . '</td>';
                                    echo '<td>' . $data['qualification_time'] . '</td>';
                                    echo '<td>' . $data['interest_rate'] . '</td>';
                                    echo '<td>' . $instalment_frequency['name'] . '</td>';
                                    echo '<td>' . $data['default_rate'] . '</td>';
                                    echo '<td>' . $status . '</td>';
                                    echo '</tr>';
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
