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
            echo '<script>$.notify("Warning: Guarantor does not exist. Try again!", "warn");</script>';
            echo '<script>alert("Account doesnt exits");</script>';
        }
    } else {
        if (isset($_SESSION['transitional_data'])) {
            $success = $transitional_data->execute();
            if ($success['status'] == 200) {
                $_SESSION['add_success'] = true;
                $_SESSION['feedback_message'] = "<strong>Successful:</strong> The loan application has been submitted successfully. You shall be notified once the approval has been finalized.";
                App::redirectTo("?view_loans");
            } else {
                $_SESSION['add_fail'] = true;
                $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error submitting your loan application. Please try applying again.";
            }
        } else {
            $success = $loans->execute();
            if ($success['status'] == 200) {
                $_SESSION['add_success'] = true;
                $_SESSION['feedback_message'] = "<strong>Successful:</strong> The loan application has been submitted successfully. You shall be notified once the approval has been finalized.";
                App::redirectTo("?view_loans");
            } else {
                $_SESSION['add_fail'] = true;
                $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error submitting your loan application. Please try applying again.";
            }
        }
    }
}
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
                            ADD LOAN GUARANTOR
                            <br /><br />
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
                                    <th>Account Number</th>
                                    <th>Member ID No:</th>
                                    <th>Member Name</th>
                                    <th>Email</th>
                                    <th>Telephone</th>
                                    <th>Amount <?php echo '(' . $_SESSION['chapter_details']['currency'] . ')'; ?></th>
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
                                    <?php if (isset($_SESSION['transitional_data'])) { ?>
                                        <input type="hidden" name="action" value="transitional_add_loan_guarantor"/>
                                        <input type="hidden" name="createdby" value="<?php echo $_SESSION['userid']; ?>"/>
                                    <?php } else { ?>                        
                                        <input type="hidden" name="action" value="add_loan">
                                    <?php } ?>
                                    <button type="submit" class="btn btn-info">Submit</button>
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