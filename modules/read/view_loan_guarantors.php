<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
$loans = new Loans();
unset($_SESSION['loan_guarantor']);
unset($_SESSION['search']);
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php
            if (isset($_SESSION['loan'])) {
                require_once('modules/menus/sub_menu_loans_individual_loan.php');
            } else {
                require_once('modules/menus/sub_menu_loans.php');
            }
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <header class="panel-heading">
                            Loan Guarantors
                            <?php
                            require_once('modules/menus/sub-sub-menu-buttons.php');
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
                                    <th>Member ID No.</th>
                                    <th>Loan Number</th>
                                    <th>Member Name</th>
                                    <th>Email</th>
                                    <th>Telephone</th>
                                    <th>Amount <?php echo '(' . $_SESSION['chapter_details']['currency'] . ')'; ?></th>
                                    <th>Status</th>
                                </tr>
                                <?php
                                if (!empty($_POST) AND ! isset($_POST['create_pdf'])) {
                                    $info = $loans->execute();
                                } else if (is_menu_set('view_loan_guarantors_notifications') != "") {
                                    $info = $loans->getAllLoanGuarantorNotifications();
                                } else if (isset($_SESSION['account']) AND ! isset($_SESSION['loan'])) {
                                    $info = $loans->getAllAccountLoanGuarantors();
                                } else if (isset($_SESSION['loan'])) {
                                    $info = $loans->getAllIndividualLoanLoanGuarantors();
                                } else {
                                    $info = $loans->getAllLoanGuarantors();
                                }

                                if (isset($_POST['create_pdf'])) {
                                    $_SESSION['author'] = $_SESSION['user_details']['firstname'] . ' ' . $_SESSION['user_details']['lastname'];
                                    $_SESSION['document_name'] = 'loan guarantors.pdf';
                                    $_SESSION['title'] = 'Loan Guarantors';
                                    $_SESSION['key_words'] = 'loan, guarantor';
                                    $_SESSION['pdf_header_title'] = 'Loan Guarantors';
                                    $_SESSION['pdf_content'] = $info;
                                    $_SESSION['column_widths'] = array(50, 90, 30, 40, 60);
                                    $_SESSION['column_titles'] = array('GUARANTOR\'S ID NO.', 'LOAN NUMBER', 'AMOUNT', 'TELEPHONE', 'STATUS');
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

                                        $proposed_guarantor_details = $users->fetchAccountHolderDetails($data["guarantor_id"]);
                                        $proposed_guarantor_contact_details = $users->fetchAccountHolderContactDetails($data["guarantor_id"]);
                                        echo '<tr>';
                                        echo '<td>' . $proposed_guarantor_details['idnumber'] . '</td>';
                                        echo '<td>' . $data["loan_number"] . '</td>';
                                        echo '<td>' . $proposed_guarantor_details['firstname'] . " " . $proposed_guarantor_details['middlename'] . " " . $proposed_guarantor_details['lastname'] . '</td>';
                                        echo '<td>' . $proposed_guarantor_contact_details['email'] . '</td>';
                                        echo '<td>' . $proposed_guarantor_contact_details['phone_number1'] . '</td>';
                                        echo '<td>' . $data["amount"] . '</td>';
                                        echo '<td>' . $status . '</td>';
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