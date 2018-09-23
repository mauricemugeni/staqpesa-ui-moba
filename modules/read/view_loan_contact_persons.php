<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
$loans = new Loans();
unset($_SESSION['loan_contact_person']);
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
                            Loan Contact Persons
                            <?php require_once('modules/menus/sub-sub-menu-buttons.php'); ?>
                        </header>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>Loan ID</th>
                                    <th>Name</th>
                                    <th>Relationship</th>
                                    <th>Phone Number</th>
                                    <th>Physical Address</th>
                                </tr>
                                <?php
                                if (!empty($_POST)) {
                                    $info = $loans->execute();
                                } else if (is_menu_set('view_loan_contact_persons_notifications') != "") {
                                    $info = $loans->getAllLoanContactPersonNotifications();
                                } else {
                                    $info = $loans->getAllLoanContactPersons();
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
                                        echo '<tr>';
                                        echo "<td> <a href='?view_loan_contact_persons_individual&code=" . $data['id'] . "'>" . $data['id'] . '</td>';
                                        echo '<td>' . $data['firstname'] . " " . $data['middlename'] . " " . $data['lastname'] . '</td>';
                                        echo '<td>' . $data['relationship'] . '</td>';
                                        echo '<td>' . $data['phone_number'] . '</td>';
                                        echo '<td>' . $data['physical_address'] . '</td>';
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