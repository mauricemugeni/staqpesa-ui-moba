<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Settings.php";
$settings = new Settings();
$loans = new Loans();
unset($_SESSION['loan_repayment']);
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
                            <?php if (is_menu_set('view_account_loan_repayments') != "") { ?>
                                Loan Statement
                                <?php require_once('modules/menus/sub-sub-menu-buttons.php'); ?>
                            <?php } else { ?>
                                Loans Repayments
                                <?php require_once('modules/menus/sub-sub-menu-buttons.php'); ?>
                            <?php
                            }
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
                                    <th>Transaction Number</th>
                                    <th>Instalment Amount <?php echo '(' . $_SESSION['chapter_details']['currency'] . ')'; ?></th>
                                    <th>Outstanding Bal. <?php echo '(' . $_SESSION['chapter_details']['currency'] . ')'; ?></th>
                                    <th>Date</th>
                                    <th>Next Date</th>
                                    <th>Loan Due Date</th>
                                    <th>Transaction Type</th>
                                    <th>Transacted By</th>
                                </tr>
                                <?php
                                if (!empty($_POST) AND !isset($_POST['create_pdf'])) {
                                    $info = $loans->execute();
                                } else if (is_menu_set('view_loan_repayments_notifications') != "") {
                                    $info = $loans->getAllLoanRepaymentNotifications();
                                } else if (isset($_SESSION['account'])) {
                                    $info = $loans->getAllAccountLoanRepayments();
                                } else {
                                    $info = $loans->getAllLoanRepayments();
                                }
                                
                                if (isset($_POST['create_pdf'])) {
                                    $_SESSION['author'] = $_SESSION['user_details']['firstname'] . ' ' . $_SESSION['user_details']['lastname'];
                                    $_SESSION['document_name'] = 'loan repayments.pdf';
                                    $_SESSION['title'] = 'Loan Repayments';
                                    $_SESSION['key_words'] = 'loan repayment, repayment';
                                    $_SESSION['pdf_header_title'] = 'Loan Repayments';
                                    $_SESSION['pdf_content'] = $info;
                                    $_SESSION['column_widths'] = array(50, 100, 80, 40);
                                    $_SESSION['column_titles'] = array('DATE CREATED', 'TRANSACTION ID', 'TRANSACTION TYPE', 'AMOUNT');
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
                                    echo "<td> </td>";
                                    echo "</tr>";
                                } else {
                                    foreach ($info as $data) {
                                        $transaction_type = $settings->fetchTransactionTypeDetails($data['transaction_type']);
                                        $loan_details = $loans->fetchLoanDetails($data['loan_number']);

                                        echo '<tr>';
                                        echo "<td> <a href=''>" . $data['id'] . '</td>';
                                        //    echo '<td>' . $data['loan_number'] . '</td>';
                                        echo '<td>' . number_format($data['amount'], 2) . '</td>';
                                        echo '<td>' . number_format($data['loan_balance'], 2) . '</td>';
                                        echo '<td>' . date("Y-m-d H:i:s", $data['paid_on']) . '</td>';
                                        echo '<td>' . $data['next_date'] . '</td>';
                                        echo '<td>' . $loan_details['due_date'] . '</td>';
                                        echo '<td>' . $transaction_type['name'] . '</td>';
                                        echo '<td>' . $data['transactedby'] . '</td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </table>
                        </div><!-- /.panel-body -->
<?php // echo $_SESSION['pagination'];  ?>
                    </div><!-- /.panel -->
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>