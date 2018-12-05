<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Transitional.php";
$transitional_data = new Transitional();
$users = new Users();
$settings = new Settings();
$loans = new Loans();

if (!empty($_POST)) {
    if ($_POST['action'] == "update_loan_guarantors_list") {
        $proposed_guarantor_exists = $users->confirmIfProposedGuarantorExists($_POST['idnumber']);
        if ($proposed_guarantor_exists == true) {
            $proposedGuarantorById = $users->fetchProposedGuarantorDetails($_POST["idnumber"]);
            $itemArray = array($proposedGuarantorById["id"] => array('id' => $proposedGuarantorById["id"], 'account_number' => $proposedGuarantorById["account_number"],
                    'firstname' => $proposedGuarantorById["firstname"], 'middlename' => $proposedGuarantorById["middlename"], 'lastname' => $proposedGuarantorById["lastname"],
                    'gender' => $proposedGuarantorById["gender"], 'idnumber' => $proposedGuarantorById["idnumber"], 'amount' => $_POST["amount"]));

            if (!empty($_SESSION["guarantors_list"])) {
                $_SESSION["guarantors_list"] = array_merge($_SESSION["guarantors_list"], $itemArray);
            } else {
                $_SESSION["guarantors_list"] = $itemArray;
            }

            App::redirectTo("?add_loan_guarantor");
        } else {
            $_SESSION['account_does_not_exist'] = true;
            $_SESSION['feedback_message'] = "<strong>Ooops:</strong> The entered Identification number does not relate with any of the existing members. Please check and try again.";

            App::redirectTo("?add_loan_guarantor");
        }
    } else if ($_POST['action'] == "proceed") {
        $checkIfAccountHasKin = $users->checkIfAccountHasKin();
        
        if ($checkIfAccountHasKin == true) {
            $checkIfAccountHasBankingDetails = $users->checkIfAccountHasBankingDetails();

            if ($checkIfAccountHasBankingDetails == true) {
                $_SESSION['has_banking_details'] = true;
            } else if ($checkIfAccountHasBankingDetails == false) {
                $_SESSION['has_banking_details'] = false;
            }
            
            App::redirectTo("?add_account_banking");
        } else if ($checkIfAccountHasKin == false) {
            App::redirectTo("?add_next_of_kin");
        }
    }
}
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <?php // require_once('modules/menus/sub_menu_loans.php'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <header class="panel-heading">
                            ADD LOAN GUARANTOR
                            <br /><br />
                            <?php
                            require_once('modules/menus/sub-sub-menu-buttons.php');
                            if (isset($_SESSION['account_does_not_exist'])) {

                                $_SESSION['add_record_fail'] = "<div class='alert alert-block alert-danger'>
                                        <button data-dismiss='alert' class='close close-sm' type='button'>
                                            <i class='fa fa-times'></i>
                                        </button>"
                                        . $_SESSION['feedback_message']
                                        . "</div>";

                                echo $_SESSION['add_record_fail'];
                                unset($_SESSION['feedback_message']);
                                unset($_SESSION['account_does_not_exist']);
                            } else if (isset($_SESSION['add_success'])) {
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
                                    <th>Member ID No:</th>
                                    <th>Member Name</th>
                                    <th>Email</th>
                                    <th>Telephone</th>
                                    <th>Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></th>
                                </tr>
                                <?php
                                if (!empty($_POST)) {
                                    $info = $loans->execute();
                                } else {
                                    if (isset($_SESSION["number_of_guarantors"]) AND $_SESSION["number_of_guarantors"] == 0) {
                                        echo "<tr>";
                                        echo "<td>  No record found.</td>";
                                        echo "<td> </td>";
                                        echo "<td> </td>";
                                        echo "<td> </td>";
                                        echo "<td> </td>";
                                        echo "<td> </td>";
                                        echo "</tr>";
                                    } else {
                                        if (isset($_SESSION["guarantors_list"])) {
//            $item_total = 0;
                                            foreach ($_SESSION["guarantors_list"] as $item) {
                                                $proposed_guarantor_details = $users->fetchAccountHolderDetails($item["id"]);
                                                $proposed_guarantor_contact_details = $users->fetchAccountHolderContactDetails($item["id"]);
                                                echo '<tr>';
                                                echo '<td>' . $proposed_guarantor_details['account_number'] . '</td>';
                                                echo '<td>' . $proposed_guarantor_details['idnumber'] . '</td>';
                                                echo '<td>' . $proposed_guarantor_details['firstname'] . " " . $proposed_guarantor_details['middlename'] . " " . $proposed_guarantor_details['lastname'] . '</td>';
                                                echo '<td>' . $proposed_guarantor_contact_details['email'] . '</td>';
                                                echo '<td>' . $proposed_guarantor_contact_details['phone_number1'] . '</td>';
                                                echo '<td>' . $item["amount"] . '</td>';
                                                echo '</tr>';
                                            }
//            $item_total += ($item["price"] * $item["quantity"]);
                                        }
                                    }
                                }
                                ?>
                            </table>
                            <?php
//                            $outstanding_balance = 12000;
                            $outstanding_balance = 0;
                            if ($outstanding_balance < 1) {
                                ?>
                                <form role="form" method="POST">
                                    <input type="hidden" name="action" value="proceed"/>
                                    <p /><p />
                                    <button type="submit" class="btn btn-info">Next</button>
                                </form>
                            <?php } ?>
                        </div>
                        <?php // echo $_SESSION['pagination'];      ?>
                    </div>
                </div>        
            </div>
        </section>
    </aside>
</div>