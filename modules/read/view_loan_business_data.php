<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$loans = new Loans();
unset($_SESSION['loan_business_data']);
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
                            Loan Business Data
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
                                    <th>Loan ID</th>
                                    <th>Business Type</th>
                                    <th>Business Form</th>
                                    <th>Daily Sales <?php echo '(' . $_SESSION['chapter_details']['currency'] . ')'; ?></th>
                                    <th>Is Licensed</th>
                                </tr>
                                <?php
                                if (!empty($_POST) AND !isset($_POST['create_pdf'])) {
                                    $info = $loans->execute();
                                } else if (is_menu_set('view_loan_business_data_notifications') != "") {
                                    $info = $loans->getAllLoanBusinessDataNotifications();
                                } else if (isset($_SESSION['account'])) {
                                    $info = $loans->getAllAccountLoanBusinessData();
                                } else {
                                    $info = $loans->getAllLoanBusinessData();
                                }
                                
                                if (isset($_POST['create_pdf'])) {
                                    $_SESSION['author'] = $_SESSION['user_details']['firstname'] . ' ' . $_SESSION['user_details']['lastname'];
                                    $_SESSION['document_name'] = 'loan business data.pdf';
                                    $_SESSION['title'] = 'Loan Business Data';
                                    $_SESSION['key_words'] = 'loan, business data';
                                    $_SESSION['pdf_header_title'] = 'Loan Business Data';
                                    $_SESSION['pdf_content'] = $info;
                                    $_SESSION['column_widths'] = array(60, 75, 75, 60);
                                    $_SESSION['column_titles'] = array('Loan ID', 'Business Type', 'Business Form', 'Daily Sales Amount');
                                    App::redirectTo("?generatepdf");
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
                                        if ($data['licensed'] == 1) {
                                            $status = "YES";
                                        } else if ($data['licensed'] == 0) {
                                            $status = "NO";
                                        }

                                        $business_type = $settings->fetchBusinessTypeDetails($data['business_type']);
                                        $business_form = $settings->fetchBusinessFormDetails($data['business_form']);

                                        echo '<tr>';
                                        echo "<td> <a href='?view_loan_business_data_individual&code=" . $data['id'] . "'>" . $data['id'] . '</td>';
                                        echo '<td>' . $business_type['name'] . '</td>';
                                        echo '<td>' . $business_form['name'] . '</td>';
                                        echo '<td>' . number_format($data['daily_sales'], 2) . '</td>';
                                        echo '<td>' . $status . '</td>';
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