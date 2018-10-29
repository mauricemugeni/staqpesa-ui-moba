<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$users = new Users();
unset($_SESSION['account_business_data']);
unset($_SESSION['search']);
?>


<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php
            if (isset($_SESSION['account'])) {
                require_once('modules/menus/sub_menu_account_individual_account.php');
            } else {
                require_once('modules/menus/sub_menu_account.php');
            }
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <header class="panel-heading">
                            Business Details
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
                                    <th>Account Number</th>
                                    <th>Business Type</th>
                                    <th>Business Form</th>
                                    <th>Daily Sales <?php echo '(' . $_SESSION['chapter_details']['currency'] . ')'; ?></th>
                                    <th>Employees Number</th>
                                    <th>Location</th>
                                    <th>Is Licensed</th>
                                </tr>
                                <?php
                                if (!empty($_POST) AND !isset($_POST['create_pdf'])) {
                                    $info = $users->execute();
                                } else if (is_menu_set('view_account_business_data_notifications') != "") {
                                    $info = $users->getAllAccountBusinessDataNotifications();
                                } else if (isset($_SESSION['account'])) {
                                    $info = $users->getAllIndividualAccountAccountBusinessData();
                                } else {
                                    $info = $users->getAllAccountBusinessData();
                                }
                                
                                if (isset($_POST['create_pdf'])) {
                                    $_SESSION['author'] = $_SESSION['user_details']['firstname'] . ' ' . $_SESSION['user_details']['lastname'];
                                    $_SESSION['document_name'] = 'account business data.pdf';
                                    $_SESSION['title'] = 'Account Business Details';
                                    $_SESSION['key_words'] = 'account, business details';
                                    $_SESSION['pdf_header_title'] = 'Account Business Details';
                                    $_SESSION['pdf_content'] = $info;
                                    $_SESSION['column_widths'] = array(60, 75, 75, 60);
                                    $_SESSION['column_titles'] = array('Account ID', 'Business Type', 'Business Form', 'Daily Sales Amount');
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
                                    echo "<td> </td>";
                                    echo "<td> </td>";
                                    echo "</tr>";
                                } else {
                                    foreach ($info as $data) {
                                        if ($data['licensed'] == 1) {
                                            $licensed_status = "YES";
                                        } else if ($data['licensed'] == 0) {
                                            $licensed_status = "NO";
                                        }

                                        $business_type = $settings->fetchBusinessTypeDetails($data['business_type']);
                                        $business_form = $settings->fetchBusinessFormDetails($data['business_form']);

                                        echo '<tr>';
                                        echo "<td> <a href='?view_account_business_data_individual&code=" . $data['id'] . "'>" . $data['id'] . '</td>';
                                        echo '<td>' . $business_type['name'] . '</td>';
                                        echo '<td>' . $business_form['name'] . '</td>';
                                        echo '<td>' . number_format($data['daily_sales'], 2) . '</td>';
                                        echo '<td>' . $data['employees'] . '</td>';
                                        echo '<td>' . $data['location'] . '</td>';
                                        echo '<td>' . $licensed_status . '</td>';
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