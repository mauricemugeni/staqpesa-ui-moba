<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
unset($_SESSION['account_holder']);
unset($_SESSION['search']);
if (!empty($_POST)) {
    $success = $users->execute();
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php require_once('modules/menus/sub_menu_account.php'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <header class="panel-heading">
                            <strong>ACCOUNT HOLDER OCCUPATIONS</strong>
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
                                    <th>Account Holder ID</th>
                                    <th>Employment Status</th>
                                    <th>Income Range</th>
                                    <th>Date Created</th>
                                    <th>Status</th>
                                </tr>                               
                               <?php
                            if (!empty($_POST) AND !isset($_POST['create_pdf'])) {
                                $info = $users->execute();
                            } else if (is_menu_set('view_account_holder_occupations_notifications') != "") {
                                $info = $users->getAllAccountHolderOccupationNotifications();
                            } else {
                                $info = $users->getAllAccountHolderOccupations();
                            }
                            
                                if (isset($_POST['create_pdf'])) {
                                    $_SESSION['author'] = $_SESSION['user_details']['firstname'] . ' ' . $_SESSION['user_details']['lastname'];
                                    $_SESSION['document_name'] = 'account holder occupations.pdf';
                                    $_SESSION['title'] = 'Account Holder Occupations';
                                    $_SESSION['key_words'] = 'account holder occupations, occupation, economic activities';
                                    $_SESSION['pdf_header_title'] = 'Account Holder Occupations';
                                    $_SESSION['pdf_content'] = $info;
                                    $_SESSION['column_widths'] = array(45, 50, 70, 30, 20, 55);
                                    $_SESSION['column_titles'] = array('ACCOUNT HOLDER ID', 'EMPLOYMENT STATUS', 'INCOME RANGE', 'DATE CREATED', 'STATUS');
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
                                    
                                    echo '<tr>';
                                    echo "<td> <a href='?view_account_holder_occupations_individual&code=" . $data['id'] . "'>" . $data['account_holder_id'] . '</td>';
                                    echo '<td>' . $data['employment_status'] . '</td>';
                                    echo '<td>' . $data['monthly_income_range'] . '</td>';
                                    echo '<td>' . date("Y-m-d H:i:s", $data['createdat']) . '</td>';
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