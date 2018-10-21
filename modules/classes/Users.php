<?php

require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Funding.php";

//require_once WPATH . "modules/classes/ACL.php";

class Users extends Database {

    public function execute() {
        if ($_POST['action'] == "login") {
            return $this->loginSystem();
        } else if ($_POST['action'] == "update_password") {
            return $this->updatePassword();
        } else if ($_POST['action'] == "forgot_password") {
            return $this->forgotPassword();
        } else if ($_POST['action'] == "reset_password") {
            return $this->resetPassword();
        } else if ($_POST['action'] == "add_contact_us_message") {
            return $this->addContactUsMessage();
        } else if ($_POST['action'] == "add_account") {
            return $this->addAccount();
        } else if ($_POST['action'] == "edit_account") {
            return $this->editAccount();
        } else if ($_POST['action'] == "add_job_advertisement") {
            return $this->addJobAdvertisement();
        } else if ($_POST['action'] == "edit_job_advertisement") {
            return $this->editJobAdvertisement();
        } else if ($_POST['action'] == "add_account_holder") {
            return $this->addAccountHolder();
        } else if ($_POST['action'] == "edit_account_holder") {
            return $this->editAccountHolder();
        } else if ($_POST['action'] == "update_profpicture") {
            return $this->updateProfilePicture();
        } else if ($_POST['action'] == "update_signature") {
            return $this->updateSignature();
        } else if ($_POST['action'] == "add_role") {
            return $this->addRole();
        } else if ($_POST['action'] == "edit_role") {
            return $this->editRole();
        } else if ($_POST['action'] == "add_user_type") {
            return $this->addUserType();
        } else if ($_POST['action'] == "edit_user_type") {
            return $this->editUserType();
        } else if ($_POST['action'] == "add_position") {
            return $this->addPosition();
        } else if ($_POST['action'] == "edit_position") {
            return $this->editPosition();
        } else if ($_POST['action'] == "add_staff") {
            return $this->addStaff();
        } else if ($_POST['action'] == "edit_staff") {
            return $this->editStaff();
        } else if ($_POST['action'] == "add_guest_user") {
            return $this->addGuestUser();
        } else if ($_POST['action'] == "edit_guest_user") {
            return $this->editGuestUser();
        } else if ($_POST['action'] == "add_system_administrator") {
            return $this->addSystemAdministrator();
        } else if ($_POST['action'] == "edit_system_administrator") {
            return $this->editSystemAdministrator();
        } else if ($_POST['action'] == "add_next_of_kin") {
            return $this->addNextOfKin();
        } else if ($_POST['action'] == "edit_next_of_kin") {
            return $this->editNextOfKin();
        } else if ($_POST['action'] == "edit_contact") {
            return $this->editContact();
        } else if ($_POST['action'] == "view_statement_from_to") {
            $start_date = explode("/", $_POST['date1']);
            $end_date = explode("/", $_POST['date2']);
            $start_time = $start_date[2] . "-" . $start_date[0] . "-" . $start_date[1];
            $end_time = $end_date[2] . "-" . $end_date[0] . "-" . $end_date[1];
            if ($_POST['statement_type'] == "fetch_inbox_messages_statement") {
                return $this->inboxMessagesStatement(strtotime($start_time), strtotime("+1 day", strtotime($end_time)));
            } else if ($_POST['statement_type'] == "fetch_accounts_statement") {
                return $this->institutionAccountsStatement(strtotime($start_time), strtotime("+1 day", strtotime($end_time)));
            }
        } else if ($_POST['action'] == "search") {
            $settings = new Settings();
            return $settings->searchSystem($_POST['request_type'], $_POST['search_input']);
        }
    }

    private function sendHttpRequestPost($data_string) {
        $settings = new Settings();
        return $settings->sendHttpRequestPost($data_string);
    }

    private function sendHttpRequestGet($data_string) {
        $settings = new Settings();
        return $settings->sendHttpRequestGet($data_string);
    }

    private function sendHttpRequestPut($data_string) {
        $settings = new Settings();
        return $settings->sendHttpRequestPut($data_string);
    }

    private function loginSystem() {
        $data['request_type'] = 'login';
        $data['username'] = $_POST['username'];
        $data['password'] = $_POST['password'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $status = $decoded_response['status'];
        $info = $decoded_response['message'];

        if ($status == 200) {
            $_SESSION['userid'] = App::cleanText($info['userid']);
            $_SESSION['login_user_type'] = $info['user_type'];
            $_SESSION['login_user_type_ref_id'] = $info['user_type_ref_id'];
            $_SESSION['username'] = App::cleanText($info['userid']);
            $_SESSION['user'] = $data['username'];
            $_SESSION['logged_in_user_type_details'] = $this->fetchUserTypeDetails($_SESSION['login_user_type']);

            if ($_SESSION['logged_in_user_type_details']['name'] == "STAFF") {
                $_SESSION['user_details'] = $this->fetchStaffDetails($_SESSION['userid']);
                $_SESSION['profile_link'] = "?view_staff_individual&code=" . $_SESSION['userid'];
                $_SESSION['contacts'] = $this->fetchIndividualContactDetails($_SESSION['login_user_type'], $_SESSION['userid']);

                $settings = new Settings();
                $_SESSION['institution_details'] = $settings->fetchInstitutionDetails($_SESSION['user_details']['institution']);
                if ($_SESSION['user_details']['institution'] == $settings->getInstitutionRefTypeId("STAQPESA")) {
                    $_SESSION['staqpesa_staff'] = true;
                } else {
                    $_SESSION['institution_staff'] = true;
                }
            } else if ($_SESSION['logged_in_user_type_details']['name'] == "GUEST") {
                $_SESSION['user_details'] = $this->fetchGuestUserDetails($_SESSION['userid']);
                $_SESSION['profile_link'] = "?view_guest_users_individual&code=" . $_SESSION['userid'];
            } else if ($_SESSION['logged_in_user_type_details']['name'] == "ACCOUNT HOLDER") {
                $_SESSION['user_details'] = $this->fetchAccountHolderDetails($_SESSION['userid']);
                $_SESSION['profile_link'] = "?view_account_holders_individual&code=" . $_SESSION['userid'];
                $_SESSION['account'] = $_SESSION['user_details']['account_number'];
                $_SESSION['next_of_kins'] = $this->fetchIndividualNextOfKinDetails($_SESSION['login_user_type'], $_SESSION['account']);
                $_SESSION['contacts'] = $this->fetchIndividualContactDetails($_SESSION['login_user_type'], $_SESSION['userid']);
            } else if ($_SESSION['logged_in_user_type_details']['name'] == "INVESTOR") {
                $funding = new Funding();
                $_SESSION['user_details'] = $funding->fetchInvestorDetails($_SESSION['userid']);
                $_SESSION['profile_link'] = "?view_investors_individual&code=" . $_SESSION['userid'];
                $_SESSION['investor'] = $_SESSION['userid'];
                $_SESSION['next_of_kins'] = $this->fetchIndividualNextOfKinDetails($_SESSION['login_user_type'], $_SESSION['userid']);
                $_SESSION['contacts'] = $this->fetchIndividualContactDetails($_SESSION['login_user_type'], $_SESSION['userid']);
            } else if ($_SESSION['logged_in_user_type_details']['name'] == "INSTITUTION") {
                $_SESSION['user_details'] = $this->fetchSystemAdministratorDetails($_SESSION['userid']);
                $_SESSION['profile_link'] = "?view_system_administrators_individual&code=" . $_SESSION['userid'];
            } else if ($_SESSION['logged_in_user_type_details']['name'] == "SYSTEM ADMINISTRATOR") {
                // $_SESSION['user_details'] = $this->fetchSystemAdministratorDetails2($_SESSION['logged_in_user_details']['reference_type'], $_SESSION['logged_in_user_details']['reference_id']);
                $_SESSION['user_details'] = $this->fetchSystemAdministratorDetails($_SESSION['userid']);
                $_SESSION['profile_link'] = "?view_system_administrators_individual&code=" . $_SESSION['userid'];

                $settings = new Settings();
                $_SESSION['institution_details'] = $settings->fetchInstitutionDetails($_SESSION['user_details']['institution']);
                if ($_SESSION['user_details']['institution'] == $settings->getInstitutionRefTypeId("STAQPESA")) {
                    $_SESSION['staqpesa_admin'] = true;
                } else {
                    $_SESSION['institution_admin'] = true;
                }
            }

//            $acl = new ACL();
//            If (!$acl->check(view_admin_dashboard, 1, 1)) {
//                // user doesn't have permission to execute the following action
//                //do something here
//            }

            return true;
        } else if ($status == 500) {
            $_SESSION['login_error'] = $info;
            return false;
        }
    }

    public function confirmIfProposedGuarantorExists($idnumber) {
        $data['request_type'] = 'confirm_if_proposed_guarantor_exists';
        $data['idnumber'] = $idnumber;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $status = $decoded_response['status'];
        $info = $decoded_response['message'];
        if ($status == 200) {
            return true;
        } else if ($status == 500) {
            return false;
        }
    }

    public function confirmIfAccountExists($account_number) {
        $data['request_type'] = 'confirm_if_account_exists';
        $data['account_number'] = $account_number;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $status = $decoded_response['status'];
        $info = $decoded_response['message'];
        if ($status == 200) {
            return true;
        } else if ($status == 500) {
            return false;
        }
    }

    public function checkIfAccountHasKin() {
        $data['request_type'] = 'check_if_account_has_kin';
        $data['account_number'] = $_SESSION['account'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $status = $decoded_response['status'];
        $info = $decoded_response['message'];
        if ($status == 200) {
            return true;
        } else if ($status == 500) {
            return false;
        }
    }

    public function checkIfAccountHasBankingDetails() {
        $data['request_type'] = 'check_if_account_has_banking_details';
        $data['account_number'] = $_SESSION['account'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $status = $decoded_response['status'];
        $info = $decoded_response['message'];
        if ($status == 200) {
            return true;
        } else if ($status == 500) {
            return false;
        }
    }

    public function inboxMessagesStatement($start_time, $end_time) {
        $data['request_type'] = "fetch_inbox_messages_statement";
        $data['start_time'] = $start_time;
        $data['end_time'] = $end_time;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function institutionAccountsStatement($start_time, $end_time) {
        $data['request_type'] = "fetch_accounts_statement";
        $data['start_time'] = $start_time;
        $data['end_time'] = $end_time;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAccountCategoryId($account_category) {
        $data['request_type'] = 'get_account_category_id';
        $data['account_category'] = $account_category;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getUserTypeRefTypeId($user_type) {
        $data['request_type'] = 'get_user_type_ref_type_id';
        $data['user_type'] = $user_type;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getNextAccountNumber($branch, $createdby, $datetime) {
        $data['request_type'] = 'get_next_account_number';
        $data['branch'] = $branch;
        $data['createdby'] = $createdby;
        $data['datetime'] = $datetime;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getNextStaffId() {
        $data['request_type'] = 'get_next_staff_id';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getUserRefTypeId($user_type) {
        $data['request_type'] = 'get_user_ref_type_id';
        $data['user_type'] = $user_type;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAccountHolderID($account_number, $firstname, $middlename, $lastname, $idnumber, $birthdate, $profpicture, $signature, $createdat, $createdby) {
        $data['request_type'] = 'get_account_holder_id';
        $data['account_number'] = $account_number;
        $data['firstname'] = $firstname;
        $data['middlename'] = $middlename;
        $data['lastname'] = $lastname;
        $data['idnumber'] = $idnumber;
        $data['birthdate'] = $birthdate;
        $data['profpicture'] = $profpicture;
        $data['signature'] = $signature;
        $data['createdat'] = $createdat;
        $data['createdby'] = $createdby;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getCorporates() {
        $data['request_type'] = 'get_corporates';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['company_name'];
                if (!empty($_POST['corporate']) && $_POST['corporate'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['company_name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['company_name']}</option>";
                }
            } else {
                if (!empty($_POST['corporate']) && $_POST['corporate'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['company_name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['company_name']}</option>";
                }
            }
        }

//        foreach ($info as $row) {
//            if (is_null($currentGroup)) {
//                $currentGroup = $row['company_name'];
//                $html .= "<option value=\"{$row['id']}\" selected>{$row['company_name']}</option>";
//            } else {
//                $html .= "<option value=\"{$row['id']}\">{$row['company_name']}</option>";
//            }
//        }
        $html .= "<option value=OTHER>OTHER</option>";
        if ($html == "")
            $html = "<option value=\"\">No corporate entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getPositions() {
        $data['request_type'] = 'get_positions';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                if (!empty($_POST['position']) && $_POST['position'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            } else {
                if (!empty($_POST['position']) && $_POST['position'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            }
        }

//        foreach ($info as $row) {
//            if (is_null($currentGroup)) {
//                $currentGroup = $row['name'];
//                $html .= "<option value=\"{$row['id']}\" selected>{$row['name']}</option>";
//            } else {
//                $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
//            }
//        }
        if ($html == "")
            $html = "<option value=\"\">No position entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getUserTypes() {
        $data['request_type'] = 'get_user_types';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                if (!empty($_POST['user_type']) && $_POST['user_type'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            } else {
                if (!empty($_POST['user_type']) && $_POST['user_type'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            }
        }

//        foreach ($info as $row) {
//            if (is_null($currentGroup)) {
//                $currentGroup = $row['name'];
//                $html .= "<option value=\"{$row['id']}\" selected>{$row['name']}</option>";
//            } else {
//                $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
//            }
//        }
        if ($html == "")
            $html = "<option value=\"\">No user type entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getRoles() {
        $data['request_type'] = 'get_roles';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                if (!empty($_POST['role']) && $_POST['role'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            } else {
                if (!empty($_POST['role']) && $_POST['role'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            }
        }

//        foreach ($info as $row) {
//            if (is_null($currentGroup)) {
//                $currentGroup = $row['name'];
//                $html .= "<option value=\"{$row['id']}\" selected>{$row['name']}</option>";
//            } else {
//                $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
//            }
//        }
        if ($html == "")
            $html = "<option value=\"\">No role entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

//    public function getStaffUserTypes() {
//        $data['request_type'] = 'get_staff_user_types';
//        $data_string = http_build_query($data);
//        $process_request = $this->sendHttpRequestPost($data_string);
//        $decoded_response = json_decode($process_request, true);
//        $info = $decoded_response['message'];
//        $currentGroup = null;
//        $html = "";        
//        foreach ($info as $row) {
//            if (is_null($currentGroup)) {
//                $currentGroup = $row['name'];
//                if (!empty($_POST['user_type']) && $_POST['user_type'] == $row['id']) {
//                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
//                } else {
//                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
//                }
//            } else {
//                if (!empty($_POST['user_type']) && $_POST['user_type'] == $row['id']) {
//                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
//                } else {
//                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
//                }
//            }
//        }
//        
//        foreach ($info as $row) {
//            if (is_null($currentGroup)) {
//                $currentGroup = $row['name'];
//                $html .= "<option value=\"{$row['id']}\" selected>{$row['name']}</option>";
//            } else {
//                $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
//            }
//        }
//        if ($html == "")
//            $html = "<option value=\"\">No user type entered into the database!</option>";
//        echo $html;
//        return $currentGroup;
//    }

    public function getAllJobAdvertisementNotifications() {
        $data['request_type'] = 'get_all_job_advertisement_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllJobApplicationNotifications() {
        $data['request_type'] = 'get_all_job_application_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllInboxMessagesNotifications() {
        $data['request_type'] = 'get_all_inbox_messages_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllRoleNotifications() {
        $data['request_type'] = 'get_all_role_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllSystemAdministratorNotifications() {
        $data['request_type'] = 'get_all_system_administrator_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllGuestUserNotifications() {
        $data['request_type'] = 'get_all_guest_user_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllUserTypeNotifications() {
        $data['request_type'] = 'get_all_user_type_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllPositionNotifications() {
        $data['request_type'] = 'get_all_position_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllContactNotifications() {
        $data['request_type'] = 'get_all_contact_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllNextOfKinNotifications() {
        $data['request_type'] = 'get_all_next_of_kin_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllStaffNotifications() {
        $data['request_type'] = 'get_all_staff_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data['institution'] = $_SESSION['user_details']['institution'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllAccountNotifications() {
        $data['request_type'] = 'get_all_account_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllAccountHolderNotifications() {
        $data['request_type'] = 'get_all_account_holder_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllAccountHolderOccupationNotifications() {
        $data['request_type'] = 'get_all_account_holder_occupation_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllAccountNomineeNotifications() {
        $data['request_type'] = 'get_all_account_nominee_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllRolePrivileges($role) {
        $data['request_type'] = 'get_all_role_privileges';
        $data['role'] = $role;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllContacts() {
        $data['request_type'] = 'get_all_contacts';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllAccountHolders() {
        $data['request_type'] = 'get_all_account_holders';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllAccountHolderOccupations() {
        $data['request_type'] = 'get_all_account_holder_occupations';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllAccountNominees() {
        $data['request_type'] = 'get_all_account_nominees';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }
    
    public function getAllAccountNomineesIndividualAccount() {
        $data['request_type'] = 'get_all_account_nominees_individual_account';
        $data['account'] = $_SESSION['account'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllNextOfKins() {
        $data['request_type'] = 'get_all_next_of_kins';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllStaff() {
        $data['request_type'] = 'get_all_staff';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllInstitutionStaff() {
        $data['request_type'] = 'get_all_institution_staff';
        $data['institution'] = $_SESSION['user_details']['institution'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllOtherInstitutionsStaff() {
        $data['request_type'] = 'get_all_other_institutions_staff';
        $data['institution'] = $_SESSION['user_details']['institution'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllOtherInstitutionsSystemAdministrators() {
        $data['request_type'] = 'get_all_other_institutions_system_administrators';
        $data['institution'] = $_SESSION['user_details']['institution'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllRoles() {
        $data['request_type'] = 'get_all_roles';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllJobAdvertisements() {
        $data['request_type'] = 'get_all_job_advertisements';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllJobApplications() {
        $data['request_type'] = 'get_all_job_applications';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllInboxMessages() {
        $data['request_type'] = 'get_all_inbox_messages';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllUserTypes() {
        $data['request_type'] = 'get_all_user_types';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllGuestUsers() {
        $data['request_type'] = 'get_all_guest_users';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllSystemAdministrators() {
        $data['request_type'] = 'get_all_system_administrators';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllPositions() {
        $data['request_type'] = 'get_all_positions';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllAccounts() {
        $data['request_type'] = 'get_all_accounts';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAccountTypeDetails($code) {
        $settings = new Settings();
        return $settings->fetchAccountTypeDetails($code);
    }

    public function getAccountCategoryDetails($code) {
        $settings = new Settings();
        return $settings->fetchAccountCategoryDetails($code);
    }

    public function getBranchDetails($code) {
        $settings = new Settings();
        return $settings->fetchBranchDetails($code);
    }

    public function getLedgerBalance($code) {
        $transactions = new Transactions();
        return $transactions->fetchLedgerBalance($code);
    }

    private function addContactUsMessage() {
        $data['request_type'] = $_POST['action'];
        $data['user_type'] = $_SESSION['login_user_type'];
        $data['user_id'] = $_SESSION['userid'];
        $data['name'] = $_SESSION['user_details']['firstname'] . " " . $_SESSION['user_details']['lastname'];
        $data['email'] = $_SESSION['user'];
        $data['phone_number'] = "MISSING";
        $data['subject'] = $_POST['subject'];
        $data['message'] = $_POST['message'];
        $data['source'] = $_POST['source'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['name']) && !empty($data['email'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function forgotPassword() {
        $data['request_type'] = $_POST['action'];
        $data['email'] = $_POST['email'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    private function resetPassword() {
        if ($_POST['new_password'] != $_POST['confirm_password']) {
            return false;
        } else {
            $data['request_type'] = $_POST['action'];
            $data['code'] = $_POST['user_id'];
            $data['new_password'] = $_POST['new_password'];
            $data_string = http_build_query($data);
            $process_request = $this->sendHttpRequestPut($data_string);
            $decoded_response = json_decode($process_request, true);
            $info = $decoded_response['message'];
            return $info;
        }
    }

    private function updateSignature() {
        
    }

    private function updateProfilePicture() {
        
    }

    public function updateIndividualRolePrivileges($update_type, $role, $privilege) {
        $data['request_type'] = 'update_individual_role_privileges';
        $data['update_type'] = $update_type;
        $data['role'] = $role;
        $data['privilege'] = $privilege;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateIndividualUserPrivileges($update_type, $user_type, $user_id, $privilege) {
        $data['request_type'] = 'update_individual_user_privileges';
        $data['update_type'] = $update_type;
        $data['user_type'] = $user_type;
        $data['privilege'] = $privilege;
        $data['user'] = $user;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateAccount($code, $update_type) {
        $data['request_type'] = 'update_account';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateAccountHolder($code, $update_type) {
        $data['request_type'] = 'update_account_holder';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updatePosition($code, $update_type) {
        $data['request_type'] = 'update_position';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateSystemAdministrator($code, $update_type) {
        $data['request_type'] = 'update_system_administrator';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateGuestUser($code, $update_type) {
        $data['request_type'] = 'update_guest_user';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateRole($code, $update_type) {
        $data['request_type'] = 'update_role';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateInboxMessage($code, $update_type) {
        $data['request_type'] = 'update_inbox_message';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateUserType($code, $update_type) {
        $data['request_type'] = 'update_user_type';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateStaff($code, $update_type) {
        $data['request_type'] = 'update_staff';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateContact($code, $update_type) {
        $data['request_type'] = 'update_contact';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateNextOfKin($code, $update_type) {
        $data['request_type'] = 'update_next_of_kin';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchAccountBankingDtlDetails() {
        $data['request_type'] = 'fetch_account_banking_dtl_details';
        $data['account_number'] = $_SESSION['account'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchLoggedInUserDetails($user_type, $user_id) {
        $data['request_type'] = 'fetch_logged_in_user_details';
        $data['user_type'] = $user_type;
        $data['user_id'] = $user_id;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchAccountDetails($code) {
        $data['request_type'] = 'fetch_account_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchCorporateDetails($code) {
        $data['request_type'] = 'fetch_corporate_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchSystemLogDetails($entry_type, $table_name, $primary_key) {
        $data['request_type'] = 'fetch_system_log_details';
        $data['entry_type'] = $entry_type;
        $data['table_name'] = $table_name;
        $data['primary_key'] = $primary_key;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchPositionDetails($code) {
        $data['request_type'] = 'fetch_position_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchSystemAdministratorDetails($code) {
        $data['request_type'] = 'fetch_system_administrator_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchSystemAdministratorDetails2($reference_type, $reference_id) {
        $data['request_type'] = 'fetch_system_administrator_details2';
        $data['reference_type'] = $reference_type;
        $data['reference_id'] = $reference_id;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchGuestUserDetails($code) {
        $data['request_type'] = 'fetch_guest_user_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchRoleDetails($code) {
        $data['request_type'] = 'fetch_role_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchJobAdvertisementDetails($code) {
        $data['request_type'] = 'fetch_job_advertisement_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchInboxMessageDetails($code) {
        $data['request_type'] = 'fetch_inbox_message_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchUserTypeDetails($code) {
        $data['request_type'] = 'fetch_user_type_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchStaffDetails($code) {
        $data['request_type'] = 'fetch_staff_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchNextOfKinDetails($code) {
        $data['request_type'] = 'fetch_next_of_kin_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchIndividualNextOfKinDetails($ref_type, $ref_id) {
        $data['request_type'] = 'fetch_individual_next_of_kin_details';
        $data['ref_type'] = $ref_type;
        $data['ref_id'] = $ref_id;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchContactDetails($code) {
        $data['request_type'] = 'fetch_contact_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchIndividualContactDetails($ref_type, $ref_id) {
        $data['request_type'] = 'fetch_individual_contact_details';
        $data['ref_type'] = $ref_type;
        $data['ref_id'] = $ref_id;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function accountHoldersPerAccount($account_number) {
        $data['request_type'] = 'count_account_holders_per_account';
        $data['account_number'] = $account_number;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchAccountHolderDetails($code) {
        $data['request_type'] = 'fetch_account_holder_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchAccountHolderOccupationDetails($code) {
        $data['request_type'] = 'fetch_account_holder_occupation_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchAccountNomineeDetails($code) {
        $data['request_type'] = 'fetch_account_nominee_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchAccountHolderContactDetails($code) {
        $data['request_type'] = 'fetch_account_holder_contact_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchProposedGuarantorDetails($idnumber) {
        $data['request_type'] = 'fetch_proposed_guarantor_details';
        $data['idnumber'] = $idnumber;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchIndividualAccountHolderDetails($code) {
        $data['request_type'] = 'fetch_individual_account_holder_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function addAccount() {
        
        //add_account
        $data['request_type'] = $_POST['action'];
        $data['branch'] = $_SESSION['branch'];
        $data['account_type'] = $_SESSION['account_type'];
        $data['account_name'] = $_SESSION['account_name'];
        $data['referee'] = $_SESSION['referee'];
        $data['recruited_by'] = $_SESSION['recruited_by'];
        $data['number_of_shares'] = $_SESSION['number_of_shares'];
        $data['value_of_shares'] = $_SESSION['value_of_shares'];
        $data['contribution_amount'] = $_SESSION['contribution_amount'];
        $data['remittance_mode'] = $_SESSION['remittance_mode'];
        $data['contribution_effective_date'] = $_SESSION['contribution_effective_date'];
        $data['createdby'] = $_SESSION['createdby'];
        $data['transaction_type'] = $_SESSION['transaction_type'];
        $data['user_type'] = $_SESSION['user_type'];

        //add_account_holder
        $data['holder_profpicture'] = $_SESSION['holder_profpicture'];
        $data['holder_signature'] = $_SESSION['holder_signature'];
        $data['holder_identification_doc'] = $_SESSION['holder_identification_doc'];
        $data['holder_associated_membership_number'] = $_SESSION['holder_associated_membership_number'];
        $data['holder_title'] = $_SESSION['holder_title'];
        $data['holder_firstname'] = $_SESSION['holder_firstname'];
        $data['holder_middlename'] = $_SESSION['holder_middlename'];
        $data['holder_lastname'] = $_SESSION['holder_lastname'];
        $data['holder_gender'] = $_SESSION['holder_gender'];
        $data['holder_idnumber'] = $_SESSION['holder_idnumber'];
        $data['holder_birthdate'] = $_SESSION['holder_birthdate'];
        $data['holder_nationality'] = $_SESSION['holder_nationality'];
        $data['holder_marital_status'] = $_SESSION['holder_marital_status'];
        $data['holder_spouse_firstname'] = $_SESSION['holder_spouse_firstname'];
        $data['holder_spouse_middlename'] = $_SESSION['holder_spouse_middlename'];
        $data['holder_spouse_lastname'] = $_SESSION['holder_spouse_lastname'];
        $data['holder_dependants'] = $_SESSION['holder_dependants'];
        $data['holder_is_signatory'] = $_SESSION['holder_is_signatory'];
//        $data['holder_account_number'] = $_SESSION['holder_account_number'];
//        $data['holder_createdby'] = $_SESSION['holder_createdby'];
//        $data['holder_createdat'] = $_SESSION['holder_createdat'];
//    $_SESSION['user_type'] = "ACCOUNT HOLDER";
//    $_SESSION['ref_type'] = $users->getUserRefTypeId($_SESSION['user_type']);
    
        //add_personal_occupation_details
        $data['employment_status'] = $_SESSION['employment_status'];
        $data['monthly_income_range'] = $_SESSION['monthly_income_range'];
        $data['employer'] = $_SESSION['employer'];
        $data['employment_number'] = $_SESSION['employment_number'];
        $data['payroll_number'] = $_SESSION['payroll_number'];
        $data['department'] = $_SESSION['department'];
        $data['station'] = $_SESSION['station'];
        $data['employment_terms'] = $_SESSION['employment_terms'];
        $data['employment_termination_date'] = $_SESSION['employment_termination_date'];
        $data['income_source_description'] = $_SESSION['income_source_description'];
        $data['company_name'] = $_SESSION['company_name'];
        $data['company_business_type'] = $_SESSION['company_business_type'];
        $data['company_location'] = $_SESSION['company_location'];
        $data['company_phone_number'] = $_SESSION['company_phone_number'];
        $data['company_email'] = $_SESSION['company_email'];
        $data['company_postal_number'] = $_SESSION['company_postal_number'];
        $data['company_postal_code'] = $_SESSION['company_postal_code'];
        $data['company_town'] = $_SESSION['company_town'];

        //add_account_nominees
        $data['nominee_firstname'] = $_SESSION['nominee_firstname'];
        $data['nominee_middlename'] = $_SESSION['nominee_middlename'];
        $data['nominee_lastname'] = $_SESSION['nominee_lastname'];
        $data['nominee_idnumber'] = $_SESSION['nominee_idnumber'];
        $data['nominee_relationship'] = $_SESSION['nominee_relationship'];
        $data['nominee_phone_number'] = $_SESSION['nominee_phone_number'];
        $data['nominee_email'] = $_SESSION['nominee_email'];
        $data['nominee_postal_address'] = $_SESSION['nominee_postal_address'];
        $data['nominee_percentage'] = $_SESSION['nominee_percentage'];

        //Contacts
        $data['phone_number1'] = $_SESSION['phone_number1'];
        $data['phone_number2'] = $_SESSION['phone_number2'];
        $data['email'] = $_SESSION['email'];
        $data['postal_number'] = $_SESSION['postal_number'];
        $data['postal_code'] = $_SESSION['postal_code'];
        $data['town'] = $_SESSION['town'];
        $data['residential_area'] = $_SESSION['residential_area'];
        $data['estate'] = $_SESSION['estate'];
        $data['street'] = $_SESSION['street'];
        $data['division'] = $_SESSION['division'];
        $data['location'] = $_SESSION['location'];
        $data['sub_location'] = $_SESSION['sub_location'];
        $data['landmark_feature'] = $_SESSION['landmark_feature'];
        
        $data_string = http_build_query($data);
        
        if (!empty($data['request_type']) && !empty($data['account_type']) && !empty($data['holder_firstname']) && !empty($data['employment_status']) && !empty($data['nominee_percentage']) && !empty($data['phone_number1'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

//        public function addAccount() {
//        $data['request_type'] = $_POST['action'];
//        $data['id'] = $_SESSION['transaction_id'];
//        $data['account_number'] = $_SESSION['account'];
//        $data['account_name'] = $_SESSION['account_name'];
//        $data['account_type'] = $_SESSION['account_type'];
//        $data['referee'] = $_SESSION['referee'];
//        $data['account_category'] = $_SESSION['account_category'];
//        $data['branch'] = $_SESSION['branch'];
//        $data['ref_type'] = $_SESSION['ref_type'];
//        $data['other_account'] = $_SESSION['other_account'];
//
//        if ($_SESSION['other_account'] == "YES") {
//            $data['other_account_number1'] = $_SESSION['other_account_number1'];
//            $data['other_account_bank1'] = $_SESSION['other_account_bank1'];
//            $data['other_account_branch1'] = $_SESSION['other_account_branch1'];
//            $data['other_account_number2'] = $_SESSION['other_account_number2'];
//            $data['other_account_bank2'] = $_SESSION['other_account_bank2'];
//            $data['other_account_branch2'] = $_SESSION['other_account_branch2'];
//        }
//        $data['createdby'] = $_SESSION['createdby'];
//
//        //Next of kins
//        if ($_SESSION['account_category_details']['name'] == "INDIVIDUAL ACCOUNT") {
//            $data['is_employed'] = $_SESSION['is_employed'];
//            $data['employer'] = $_SESSION['employer'];
//
//            if ($_SESSION['employer'] == "OTHER") {
//                $data['company_name'] = $_SESSION['company_name'];
//                $data['company_business_type'] = $_SESSION['company_business_type'];
//                $data['company_postal_number'] = $_SESSION['company_postal_number'];
//                $data['company_postal_code'] = $_SESSION['company_postal_code'];
//                $data['company_town'] = $_SESSION['company_town'];
//                $data['company_phone_number'] = $_SESSION['company_phone_number'];
//                $data['company_email'] = $_SESSION['company_email'];
//            }
//
//            $data['external_source'] = $_SESSION['external_source'];
//            $data['description'] = $_SESSION['description'];
//            $data['source_amount'] = $_SESSION['source_amount'];
//
//            $data['next_of_kin_firstname'] = $_SESSION['next_of_kin_firstname'];
//            $data['next_of_kin_middlename'] = $_SESSION['next_of_kin_middlename'];
//            $data['next_of_kin_lastname'] = $_SESSION['next_of_kin_lastname'];
//            $data['next_of_kin_relationship'] = $_SESSION['next_of_kin_relationship'];
//            $data['next_of_kin_phone_number'] = $_SESSION['next_of_kin_phone_number'];
//            $data['next_of_kin_email'] = $_SESSION['next_of_kin_email'];
//            $data['next_of_kin_postal_address'] = $_SESSION['next_of_kin_postal_address'];
//            $data['next_of_kin_workplace'] = $_SESSION['next_of_kin_workplace'];
//            $data['next_of_kin_physical_address'] = $_SESSION['next_of_kin_physical_address'];
//        }
//
//        if ($_SESSION['account_category_details']['name'] == "GROUP ACCOUNT") {
//            $data['company_name'] = $_SESSION['company_name'];
//            $data['company_business_type'] = $_SESSION['company_business_type'];
//            $data['company_postal_number'] = $_SESSION['company_postal_number'];
//            $data['company_postal_code'] = $_SESSION['company_postal_code'];
//            $data['company_town'] = $_SESSION['company_town'];
//            $data['company_phone_number'] = $_SESSION['company_phone_number'];
//            $data['company_email'] = $_SESSION['company_email'];
//            $data['incorporation_certificate'] = $_SESSION['incorporation_certificate'];
//            $data['company_registration_number'] = $_SESSION['company_registration_number'];
//            $data['company_registration_date'] = $_SESSION['company_registration_date'];
//            $data['contact_person_firstname'] = $_SESSION['contact_person_firstname'];
//            $data['contact_person_lastname'] = $_SESSION['contact_person_lastname'];
//            $data['contact_person_phone_number'] = $_SESSION['contact_person_phone_number'];
//            $data['contact_person_email'] = $_SESSION['contact_person_email'];
//        }
//
//        //Transactions
//        $data['transaction_type'] = $_SESSION['transaction_type'];
//
//        $data_string = http_build_query($data);
//
//        if (!empty($data['request_type']) && !empty($data['id']) && !empty($data['account_number']) && !empty($data['account_name']) && !empty($data['ref_type']) && !empty($data['transaction_type']) && !empty($data['createdby'])) {
//            $process_request = $this->sendHttpRequestPost($data_string);
//            if ($process_request) {
//                $decoded_response = json_decode($process_request, true);
//                $response['status'] = $decoded_response['status'];
//                $response['message'] = $decoded_response['message'];
//            } else {
//                $response['status'] = 400;
//                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
//            }
//        } else {
//            $response['status'] = 400;
//            $response['message'] = "Error: Missing Values in Request";
//        }
//        return $response;
//    }

    public function addAccountBankingDetails() {
        $data['request_type'] = 'add_account_banking_details';
        $data['account_number'] = $_SESSION['account'];
        
        if($_POST['mobile_service_provider'] == "") {
            $data['mobile_service_provider'] = 'N/A';
        } else {
            $data['mobile_service_provider'] = $_POST['mobile_service_provider'];
        }
        
        if($_POST['mobile_number'] == "") {
            $data['mobile_number'] = 'N/A';
        } else {
            $data['mobile_number'] = $_POST['mobile_number'];
        }
        
        if($_POST['bank_account_number'] == "") {
            $data['bank_account_number'] = 'N/A';
        } else {
            $data['bank_account_number'] = $_POST['bank_account_number'];
        }
        
        if($_POST['bank_name'] == "") {
            $data['bank_name'] = 'N/A';
        } else {
            $data['bank_name'] = $_POST['bank_name'];
        }
        
        if($_POST['bank_code'] == "") {
            $data['bank_code'] = 'N/A';
        } else {
            $data['bank_code'] = $_POST['bank_code'];
        }
        
        if($_POST['bank_branch_name'] == "") {
            $data['bank_branch_name'] = 'N/A';
        } else {
            $data['bank_branch_name'] = $_POST['bank_branch_name'];
        }
        
        if($_POST['bank_branch_code'] == "") {
            $data['bank_branch_code'] = 'N/A';
        } else {
            $data['bank_branch_code'] = $_POST['bank_branch_code'];
        }
        
        $data_string = http_build_query($data);
        
        if (!empty($data['request_type']) && !empty($data['account_number']) && !empty($data['mobile_number'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function addPosition() {
        $data['request_type'] = $_POST['action'];
        $data['name'] = $_POST['name'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['name']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function addNextOfKin() {
        $data['request_type'] = $_POST['action'];
        $data['ref_type'] = $_SESSION['ref_type'];
        $data['ref_id'] = $_SESSION['ref_id'];
        $data['firstname'] = $_POST['firstname'];
        $data['middlename'] = $_POST['middlename'];
        $data['lastname'] = $_POST['lastname'];
        $data['relationship'] = $_POST['relationship'];
        $data['workplace'] = $_POST['workplace'];
        $data['phone_number'] = $_POST['phone_number'];
        $data['email'] = $_POST['email'];
        $data['postal_address'] = $_POST['postal_address'];
        $data['physical_address'] = $_POST['physical_address'];
        $data['createdby'] = $_SESSION['userid'];

        $data_string = http_build_query($data);
        
        if (!empty($data['request_type']) && !empty($data['ref_type']) && !empty($data['firstname']) && !empty($data['relationship'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function addGuestUser() {
        $data['request_type'] = $_POST['action'];
        $data['firstname'] = $_POST['firstname'];
        $data['lastname'] = $_POST['lastname'];
        $data['phone_number'] = $_POST['phone_number'];
        $data['email'] = $_POST['email'];
        $data['user_type'] = $_POST['user_type'];
//        $data['ref_type'] = $this->getUserRefTypeId($_POST['user_type']);
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['firstname']) && !empty($data['phone_number']) && !empty($data['user_type']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function addSystemAdministrator() {
        $data['request_type'] = $_POST['action'];
        $data['firstname'] = $_POST['firstname'];
        $data['lastname'] = $_POST['lastname'];
        $data['phone_number'] = $_POST['phone_number'];
        $data['email'] = $_POST['email'];
        $data['institution'] = $_POST['institution'];
        $data['user_type'] = $_POST['user_type'];
//        $data['ref_type'] = $this->getUserRefTypeId($_POST['user_type']);
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['firstname']) && !empty($data['phone_number']) && !empty($data['institution']) && !empty($data['user_type']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function addStaff() {
        $data['request_type'] = $_POST['action'];
        $data['id'] = $_SESSION['staff_id'];
        $data['firstname'] = $_SESSION['firstname'];
        $data['middlename'] = $_SESSION['middlename'];
        $data['lastname'] = $_SESSION['lastname'];
        $data['gender'] = $_SESSION['gender'];
        $data['idnumber'] = $_SESSION['idnumber'];
        $data['institution'] = $_SESSION['user_details']['institution'];
        $data['branch'] = $_SESSION['branch'];
        $data['profpicture'] = $_SESSION['filename'];
        $data['position'] = $_SESSION['position'];
        $data['role'] = $_SESSION['role'];
        $data['createdby'] = $_SESSION['createdby'];

        //Contacts
        $data['ref_type'] = $_SESSION['ref_type'];
        $data['phone_number1'] = $_SESSION['phone_number1'];
        $data['phone_number2'] = $_SESSION['phone_number2'];
        $data['email'] = $_SESSION['email'];
        $data['postal_number'] = $_SESSION['postal_number'];
        $data['postal_code'] = $_SESSION['postal_code'];
        $data['town'] = $_SESSION['town'];
        $data['residential_area'] = $_SESSION['residential_area'];
        $data['estate'] = $_SESSION['estate'];
        $data['street'] = $_SESSION['street'];
        $data['division'] = $_SESSION['division'];
        $data['location'] = $_SESSION['location'];
        $data['sub_location'] = $_SESSION['sub_location'];
        $data['landmark'] = $_SESSION['landmark'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['id']) && !empty($data['firstname']) && !empty($data['idnumber']) && !empty($data['role']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function addUserType() {
        $data['request_type'] = $_POST['action'];
        $data['name'] = $_POST['name'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['name']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function addRole() {
        $data['request_type'] = $_POST['action'];
        $data['name'] = $_POST['name'];
        $data['description'] = $_POST['description'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['name']) && !empty($data['description']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function addJobAdvertisement() {
        $data['request_type'] = $_POST['action'];
        $data['institution'] = $_SESSION['institution_name'];
        $data['title'] = $_POST['title'];
        $data['job_description'] = $_POST['job_description'];
        $data['tasks'] = $_POST['tasks'];
        $data['employment_type'] = $_POST['employment_type'];
        $data['station'] = $_POST['station'];
        $data['employment_terms'] = $_POST['employment_terms'];
        $data['required_education'] = $_POST['required_education'];
        $data['required_skills'] = $_POST['required_skills'];
        $data['required_experience'] = $_POST['required_experience'];
        $data['compensation_currency'] = $_SESSION['currency'];
        $data['compensation_amount'] = $_POST['compensation_amount'];
        $data['other_benefits'] = $_POST['other_benefits'];
        $data['application_deadline'] = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['title']) && !empty($data['job_description']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function addAccountHolder() {
        $settings = new Settings();
        $marital_status_details = $settings->fetchMaritalStatusDetails($_SESSION['holder_marital_status']);

        $data['request_type'] = $_POST['action'];
        $data['account_number'] = $_SESSION['holder_account_number'];
        $data['firstname'] = $_SESSION['holder_firstname'];
        $data['middlename'] = $_SESSION['holder_middlename'];
        $data['lastname'] = $_SESSION['holder_lastname'];
        $data['gender'] = $_SESSION['holder_gender'];
        $data['idnumber'] = $_SESSION['holder_idnumber'];
        $data['birthdate'] = $_SESSION['holder_birthdate'];
        $data['nationality'] = $_SESSION['holder_nationality'];
        $data['marital_status'] = $_SESSION['holder_marital_status'];

        if ($marital_status_details['name'] == "MARRIED") {
            $data['spouse_firstname'] = $_SESSION['holder_spouse_firstname'];
            $data['spouse_middlename'] = $_SESSION['holder_spouse_middlename'];
            $data['spouse_lastname'] = $_SESSION['holder_spouse_lastname'];
        }

        $data['dependants'] = $_SESSION['holder_dependants'];
        $data['profpicture'] = $_SESSION['holder_profpicture'];
        $data['signature'] = $_SESSION['holder_signature'];
        $data['signatory'] = $_SESSION['holder_signatory'];
        $data['createdby'] = $_SESSION['holder_createdby'];

        //Contacts
        $data['ref_type'] = $_SESSION['ref_type'];
        $data['phone_number1'] = $_SESSION['phone_number1'];
        $data['phone_number2'] = $_SESSION['phone_number2'];
        $data['email'] = $_SESSION['email'];
        $data['postal_number'] = $_SESSION['postal_number'];
        $data['postal_code'] = $_SESSION['postal_code'];
        $data['town'] = $_SESSION['town'];
        $data['residential_area'] = $_SESSION['residential_area'];
        $data['estate'] = $_SESSION['estate'];
        $data['street'] = $_SESSION['street'];
        $data['division'] = $_SESSION['division'];
        $data['location'] = $_SESSION['location'];
        $data['sub_location'] = $_SESSION['sub_location'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['account_number']) && !empty($data['firstname']) && !empty($data['gender']) && !empty($data['signatory']) && !empty($data['ref_type']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function editAccountHolder() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['account_holder'];
        $data['firstname'] = $_POST['firstname'];
        $data['middlename'] = $_POST['middlename'];
        $data['lastname'] = $_POST['lastname'];
        $data['gender'] = $_POST['gender'];
        $data['idnumber'] = $_POST['idnumber'];
        $data['day'] = $_POST['day'];
        $data['month'] = $_POST['month'];
        $data['year'] = $_POST['year'];
        $data['nationality'] = $_POST['nationality'];
        $data['signatory'] = $_POST['signatory'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['code']) && !empty($data['firstname']) && !empty($data['gender']) && !empty($data['idnumber']) && !empty($data['day']) && !empty($data['signatory']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function editAccount() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['account'];
        $data['account_name'] = $_POST['account_name'];
        $data['account_type'] = $_POST['account_type'];
        $data['account_category'] = $_POST['account_category'];
        $data['branch'] = $_POST['branch'];
        $data['other_account'] = $_POST['other_account'];

        if ($_POST['employer'] != NULL) {
            $data['employer'] = $_POST['employer'];
            $data['company_name'] = $_POST['company_name'];
            $data['company_business_type'] = $_POST['company_business_type'];
            $data['company_postal_number'] = $_POST['company_postal_number'];
            $data['company_postal_code'] = $_POST['company_postal_code'];
            $data['company_town'] = $_POST['company_town'];
            $data['company_phone_number'] = $_POST['company_phone_number'];
            $data['company_email'] = $_POST['company_email'];
        }

        if ($data['other_account'] == 1) {
            $data['other_account_number1'] = $_POST['other_account_number1'];
            $data['other_account_bank1'] = $_POST['other_account_bank1'];
            $data['other_account_branch1'] = $_POST['other_account_branch1'];
            $data['other_account_number2'] = $_POST['other_account_number2'];
            $data['other_account_bank2'] = $_POST['other_account_bank2'];
            $data['other_account_branch2'] = $_POST['other_account_branch2'];
        }

        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        argDump($data_string);
        argDump($data_string);
        argDump($data_string);
        exit();

        if (!empty($data['request_type']) && !empty($data['code']) && !empty($data['account_name']) && !empty($data['account_type']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function editPosition() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['position'];
        $data['name'] = $_POST['name'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['code']) && !empty($data['name']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function editUserType() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['user_type'];
        $data['name'] = $_POST['name'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['code']) && !empty($data['name']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function editGuestUser() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['guest_user'];
        $data['firstname'] = $_POST['firstname'];
        $data['lastname'] = $_POST['lastname'];
        $data['phone_number'] = $_POST['phone_number'];
        $data['email'] = $_POST['email'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['code']) && !empty($data['firstname']) && !empty($data['phone_number']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function editSystemAdministrator() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['system_administrator'];
        $data['firstname'] = $_POST['firstname'];
        $data['lastname'] = $_POST['lastname'];
        $data['phone_number'] = $_POST['phone_number'];
        $data['email'] = $_POST['email'];
        $data['institution'] = $_POST['institution'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['code']) && !empty($data['firstname']) && !empty($data['phone_number']) && !empty($data['institution']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function editRole() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['role'];
        $data['name'] = $_POST['name'];
        $data['description'] = $_POST['description'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['code']) && !empty($data['name']) && !empty($data['description']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    public function editStaff() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['staff'];
        $data['firstname'] = $_POST['firstname'];
        $data['middlename'] = $_POST['middlename'];
        $data['lastname'] = $_POST['lastname'];
        $data['gender'] = $_POST['gender'];
        $data['idnumber'] = $_POST['idnumber'];
        $data['branch'] = $_POST['branch'];
        $data['position'] = $_POST['position'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['code']) && !empty($data['firstname']) && !empty($data['gender']) && !empty($data['idnumber']) && !empty($data['branch']) && !empty($data['position']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    public function editNextOfKin() {
        $data['request_type'] = $_POST['action'];
        $data['id'] = $_POST['code'];
        $data['firstname'] = $_POST['firstname'];
        $data['middlename'] = $_POST['middlename'];
        $data['lastname'] = $_POST['lastname'];
        $data['relationship'] = $_POST['relationship'];
        $data['phone_number'] = $_POST['phone_number'];
        $data['email'] = $_POST['email'];
        $data['postal_address'] = $_POST['postal_address'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['id']) && !empty($data['firstname']) && !empty($data['phone_number']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    public function editContact() {
        $data['request_type'] = $_POST['action'];
        $data['id'] = $_POST['code'];
        $data['phone_number1'] = $_POST['phone_number1'];
        $data['phone_number2'] = $_POST['phone_number2'];
        $data['email'] = $_POST['email'];
        $data['postal_number'] = $_POST['postal_number'];
        $data['postal_code'] = $_POST['postal_code'];
        $data['town'] = $_POST['town'];
        $data['residential_area'] = $_POST['residential_area'];
        $data['estate'] = $_POST['estate'];
        $data['street'] = $_POST['street'];
        $data['division'] = $_POST['division'];
        $data['location'] = $_POST['location'];
        $data['sub_location'] = $_POST['sub_location'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['id']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    public function fetchChapterDetails($code) {
        $data['request_type'] = 'fetch_chapter_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchSoloChapterDetails($institution_code, $chapter_code) {
        $data['request_type'] = 'fetch_solo_chapter_details';
        $data['institution_code'] = $institution_code;
        $data['chapter_code'] = $chapter_code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

}
