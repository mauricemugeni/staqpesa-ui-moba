<?php

require_once WPATH . "modules/classes/Users.php";

class Settings extends Database {

    public function execute() {
        if ($_POST['action'] == "add_account_category") {
            return $this->addAccountCategory();
        } else if ($_POST['action'] == "edit_account_category") {
            return $this->editAccountCategory();
        } else if ($_POST['action'] == "edit_account_type") {
            return $this->editAccountType();
        } else if ($_POST['action'] == "edit_branch") {
            return $this->editBranch();
        } else if ($_POST['action'] == "edit_loan_processing_fees") {
            return $this->editLoanProcessingFees();
        } else if ($_POST['action'] == "edit_business_form") {
            return $this->editBusinessForm();
        } else if ($_POST['action'] == "edit_business_type") {
            return $this->editBusinessType();
        } else if ($_POST['action'] == "edit_transaction_type") {
            return $this->editTransactionType();
        } else if ($_POST['action'] == "edit_default_charge_rate") {
            return $this->editDefaultChargeRate();
        } else if ($_POST['action'] == "add_account_type") {
            return $this->addAccountType();
        } else if ($_POST['action'] == "add_branch") {
            return $this->addBranch();
        } else if ($_POST['action'] == "add_sector") {
            return $this->addSector();
        } else if ($_POST['action'] == "add_loan_processing_fees") {
            return $this->addLoanProcessingFees();
        } else if ($_POST['action'] == "add_business_type") {
            return $this->addBusinessType();
        } else if ($_POST['action'] == "add_business_form") {
            return $this->addBusinessForm();
        } else if ($_POST['action'] == "add_default_charge_rate") {
            return $this->addDefaultChargeRate();
        } else if ($_POST['action'] == "edit_status") {
            return $this->editStatus();
        } else if ($_POST['action'] == "edit_sector") {
            return $this->editSector();
        } else if ($_POST['action'] == "add_status") {
            return $this->addStatus();
        } else if ($_POST['action'] == "add_marital_status") {
            return $this->addMaritalStatus();
        } else if ($_POST['action'] == "edit_marital_status") {
            return $this->editMaritalStatus();
        } else if ($_POST['action'] == "add_response") {
            return $this->addResponse();
        } else if ($_POST['action'] == "edit_response") {
            return $this->editResponse();
        } else if ($_POST['action'] == "add_transaction_type") {
            return $this->addTransactionType();
        } else if ($_POST['action'] == "search") {
            return $this->searchSystem($_POST['request_type'], $_POST['search_input']);
        } else if ($_POST['action'] == "add_institution") {
            return $this->addInstitution();
        } else if ($_POST['action'] == "edit_institution") {
            return $this->editInstitution();
        }
    }

    public function sendHttpRequestPost($data_string) {
        $curl_session = curl_init();
        curl_setopt($curl_session, CURLOPT_URL, $_SESSION["api_url"]);
        curl_setopt($curl_session, CURLOPT_POST, true);
        curl_setopt($curl_session, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl_session);
        curl_close($curl_session);
        return $response;
    }

    public function sendHttpRequestGet($data_string) {
        curl_setopt($curl_session, CURLOPT_URL, $_SESSION["api_url"] . $data_string);
        curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl_session);
        curl_close($curl_session);
        return $response;
    }

    public function sendHttpRequestPut($data_string) {
        $curl_session = curl_init();
        curl_setopt($curl_session, CURLOPT_URL, $_SESSION["api_url"] . $data_string);
        curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_session, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl_session, CURLOPT_POSTFIELDS, $data_string);
        $response = curl_exec($curl_session);
        curl_close($curl_session);
        return $response;
    }

    public function sentenceCase($string) {
        $sentences = preg_split('/([.?!]+)/', $string, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        $newString = '';
        foreach ($sentences as $key => $sentence) {
            $newString .= ($key & 1) == 0 ?
                    ucfirst(strtolower(trim($sentence))) :
                    $sentence . ' ';
        }
        return trim($newString);
    }

    public function searchSystem($request_type, $search_input) {
        $data['request_type'] = $request_type;
        $data['search_input'] = $search_input;
        if ($request_type == "search_system_administrators") {
            $data['institution'] = $_SESSION['user_details']['institution'];
        }


        if ($request_type == "search_deposits") {
            $data['request_type'] = 'search_transactions';
            $data['transaction_type'] = "DEPOSIT";
            if (isset($_SESSION['account'])) {
                $data['account'] = $_SESSION['account'];
            }
        }
        if ($request_type == "search_withdrawals") {
            $data['request_type'] = 'search_transactions';
            $data['transaction_type'] = "WITHDRAWAL";
            if (isset($_SESSION['account'])) {
                $data['account'] = $_SESSION['account'];
            }
        }
        if ($request_type == "search_shares") {
            $data['request_type'] = 'search_transactions';
            $data['transaction_type'] = "SHARES DEPOSIT";
            if (isset($_SESSION['account'])) {
                $data['account'] = $_SESSION['account'];
            }
        }
        if ($request_type == "search_account_to_account_transfers") {
            $data['request_type'] = 'search_transactions';
            $data['transaction_type'] = "ACCOUNT TO ACCOUNT TRANSFER";
            if (isset($_SESSION['account'])) {
                $data['account'] = $_SESSION['account'];
            }
        }
        if ($request_type == "search_transactions") {
            $data['request_type'] = 'search_transactions';
            $data['transaction_type'] = "ALL";
            if (isset($_SESSION['account'])) {
                $data['account'] = $_SESSION['account'];
            }
        }


//        if ($request_type == "search_deposits") {
//            $data['transaction_type'] = "DEPOSIT";
//        }
//        if ($request_type == "search_withdrawals") {
//            $data['transaction_type'] = "WITHDRAWAL";
//        }
//        if ($request_type == "search_shares") {
//            $data['transaction_type'] = "SHARES DEPOSIT";
//        }
//        if ($request_type == "search_account_to_account_transfers") {
//            $data['transaction_type'] = "ACCOUNT TO ACCOUNT TRANSFER";
//        }
//        if ($request_type == "search_transactions") {
//            $data['transaction_type'] = "ALL";
//        }
//        if ($request_type == "search_account_shares") {
//            $data['transaction_type'] = "SHARES DEPOSIT";
//            $data['account'] = $_SESSION['account'];
//        }
//        if ($request_type == "search_account_deposits") {
//            $data['transaction_type'] = "DEPOSIT";
//            $data['account'] = $_SESSION['account'];
//        }
//        if ($request_type == "search_account_withdrawals") {
//            $data['transaction_type'] = "WITHDRAWAL";
//            $data['account'] = $_SESSION['account'];
//        }
//        if ($request_type == "search_account_search_account_to_account_transfers") {
//            $data['transaction_type'] = "ACCOUNT TO ACCOUNT TRANSFER";
//            $data['account'] = $_SESSION['account'];
//        }
//        if ($request_type == "search_account_shares") {
//            $data['transaction_type'] = "ALL";
//            $data['account'] = $_SESSION['account'];
//        }
        
        $data_string = http_build_query($data);
        
        
        
        argDump($data_string);
        argDump($data_string);
        exit();
        
        
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function transactionsStatement($statement_type, $start_time, $end_time) {
        $data['request_type'] = "fetch_transactions_statement";
        $data['statement_type'] = $statement_type;
        $data['start_time'] = $start_time;
        $data['end_time'] = $end_time;
        if (isset($_SESSION['account'])) {
            $data['account_number'] = $_SESSION['account'];
        }
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllInstitutionNotifications() {
        $data['request_type'] = 'get_all_institution_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllTransactionTypeNotifications() {
        $data['request_type'] = 'get_all_transaction_type_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllStatusNotifications() {
        $data['request_type'] = 'get_all_status_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllSectorsNotifications() {
        $data['request_type'] = 'get_all_sectors_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllResponseNotifications() {
        $data['request_type'] = 'get_all_response_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllMaritalStatusNotifications() {
        $data['request_type'] = 'get_all_marital_status_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllDefaultChargeRateNotifications() {
        $data['request_type'] = 'get_all_default_charge_rate_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllBusinessTypeNotifications() {
        $data['request_type'] = 'get_all_business_type_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllBusinessFormNotifications() {
        $data['request_type'] = 'get_all_business_form_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllLoanProcessingFeeNotifications() {
        $data['request_type'] = 'get_all_loan_processing_fee_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllAccountTypeNotifications() {
        $data['request_type'] = 'get_all_account_type_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllAccountCategoryNotifications() {
        $data['request_type'] = 'get_all_account_category_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllBranchNotifications() {
        $data['request_type'] = 'get_all_branch_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllBranches() {
        $data['request_type'] = 'get_all_branches';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllAccountCategories() {
        $data['request_type'] = 'get_all_account_categories';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllAccountTypes() {
        $data['request_type'] = 'get_all_account_types';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllLoanProcessingFees() {
        $data['request_type'] = 'get_all_loan_processing_fees';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllBusinessForms() {
        $data['request_type'] = 'get_all_business_forms';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllBusinessTypes() {
        $data['request_type'] = 'get_all_business_types';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllDefaultChargeRates() {
        $data['request_type'] = 'get_all_default_charge_rates';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllMaritalStatuses() {
        $data['request_type'] = 'get_all_marital_statuses';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllResponses() {
        $data['request_type'] = 'get_all_responses';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllStatuses() {
        $data['request_type'] = 'get_all_statuses';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllSectors() {

        $sql = "SELECT * FROM sectors ORDER BY name ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info;

//        $data['request_type'] = 'get_all_sectors';
//        $data_string = http_build_query($data);
//        $process_request = $this->sendHttpRequestPost($data_string);
//        $decoded_response = json_decode($process_request, true);
//        $info = $decoded_response['message'];
//        return $info;
    }

    public function getAllTransactionTypes() {
        $data['request_type'] = 'get_all_transaction_types';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllInstitutions() {
        $data['request_type'] = 'get_all_institutions';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getSystemLogDetails($entry_type, $table_name, $primary_key) {
        $users = new Users();
        return $users->fetchSystemLogDetails($entry_type, $table_name, $primary_key);
    }

    public function getStaffDetails($code) {
        $users = new Users();
        return $users->fetchStaffDetails($code);
    }

    public function getMaritalStatuses() {
        $data['request_type'] = 'get_marital_statuses';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                if (!empty($_POST['marital_status']) && $_POST['marital_status'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" id=\"{$row['show_hide']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\" id=\"{$row['show_hide']}\" >{$row['name']}</option>";
                }
            } else {
                if (!empty($_POST['marital_status']) && $_POST['marital_status'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" id=\"{$row['show_hide']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\" id=\"{$row['show_hide']}\" >{$row['name']}</option>";
                }
            }
        }

//        foreach ($info as $row) {
//            if (is_null($currentGroup)) {
//                $currentGroup = $row['name'];
//                $html .= "<option value=\"{$row['id']}\" id=\"{$row['show_hide']}\" selected>{$row['name']}</option>";
//            } else {
//                $html .= "<option value=\"{$row['id']}\" id=\"{$row['show_hide']}\">{$row['name']}</option>";
//            }
//        }
        if ($html == "")
            $html = "<option value=\"\">No marital status entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getBusinessForms() {
        $data['request_type'] = 'get_business_forms';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                if (!empty($_POST['business_form']) && $_POST['business_form'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            } else {
                if (!empty($_POST['business_form']) && $_POST['business_form'] == $row['id']) {
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
            $html = "<option value=\"\">No business form entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getBusinessTypes() {
        $data['request_type'] = 'get_business_types';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                if (!empty($_POST['business_type']) && $_POST['business_type'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            } else {
                if (!empty($_POST['business_type']) && $_POST['business_type'] == $row['id']) {
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
            $html = "<option value=\"\">No business type entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getSectors() {
//        $data['request_type'] = 'get_sectors';
//        $data_string = http_build_query($data);
//        $process_request = $this->sendHttpRequestPost($data_string);
//        $decoded_response = json_decode($process_request, true);
//        $info = $decoded_response['message'];

        $stmt = $this->prepareQuery("SELECT * FROM sectors WHERE status=1011 "
                . "OR status=1021 OR status=1031 ORDER BY name ASC");
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                if (!empty($_POST['sector']) && $_POST['sector'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            } else {
                if (!empty($_POST['sector']) && $_POST['sector'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            }
        }
        if ($html == "")
            $html = "<option value=\"\">No sector entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getNationalities() {
        $html = '';
        $html = '<option value="Afghanistan" title="Afghanistan">Afghanistan</option>
                                <option value="Åland Islands" title="Åland Islands">Åland Islands</option>
                                <option value="Albania" title="Albania">Albania</option>
                                <option value="Algeria" title="Algeria">Algeria</option>
                                <option value="American Samoa" title="American Samoa">American Samoa</option>
                                <option value="Andorra" title="Andorra">Andorra</option>
                                <option value="Angola" title="Angola">Angola</option>
                                <option value="Anguilla" title="Anguilla">Anguilla</option>
                                <option value="Antarctica" title="Antarctica">Antarctica</option>
                                <option value="Antigua and Barbuda" title="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina" title="Argentina">Argentina</option>
                                <option value="Armenia" title="Armenia">Armenia</option>
                                <option value="Aruba" title="Aruba">Aruba</option>
                                <option value="Australia" title="Australia">Australia</option>
                                <option value="Austria" title="Austria">Austria</option>
                                <option value="Azerbaijan" title="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas" title="Bahamas">Bahamas</option>
                                <option value="Bahrain" title="Bahrain">Bahrain</option>
                                <option value="Bangladesh" title="Bangladesh">Bangladesh</option>
                                <option value="Barbados" title="Barbados">Barbados</option>
                                <option value="Belarus" title="Belarus">Belarus</option>
                                <option value="Belgium" title="Belgium">Belgium</option>
                                <option value="Belize" title="Belize">Belize</option>
                                <option value="Benin" title="Benin">Benin</option>
                                <option value="Bermuda" title="Bermuda">Bermuda</option>
                                <option value="Bhutan" title="Bhutan">Bhutan</option>
                                <option value="Bolivia, Plurinational State of Bolivia" title="Bolivia, Plurinational State of Bolivia">Bolivia, Plurinational State of Bolivia</option>
                                <option value="Bonaire, Sint Eustatius and Saba" title="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
                                <option value="Bosnia and Herzegovina" title="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value="Botswana" title="Botswana">Botswana</option>
                                <option value="Bouvet Island" title="Bouvet Island">Bouvet Island</option>
                                <option value="Brazil" title="Brazil">Brazil</option>
                                <option value="British Indian Ocean Territory" title="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                <option value="Brunei Darussalam" title="Brunei Darussalam">Brunei Darussalam</option>
                                <option value="Bulgaria" title="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso" title="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi" title="Burundi">Burundi</option>
                                <option value="Cambodia" title="Cambodia">Cambodia</option>
                                <option value="Cameroon" title="Cameroon">Cameroon</option>
                                <option value="Canada" title="Canada">Canada</option>
                                <option value="Cape Verde" title="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands" title="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic" title="Central African Republic">Central African Republic</option>
                                <option value="Chad" title="Chad">Chad</option>
                                <option value="Chile" title="Chile">Chile</option>
                                <option value="China" title="China">China</option>
                                <option value="Christmas Island" title="Christmas Island">Christmas Island</option>
                                <option value="Cocos (Keeling) Islands" title="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                <option value="Colombia" title="Colombia">Colombia</option>
                                <option value="Comoros" title="Comoros">Comoros</option>
                                <option value="Congo" title="Congo">Congo</option>
                                <option value="Congo, the Democratic Republic of Congo" title="Congo, the Democratic Republic of Congo">Congo, the Democratic Republic of Congo</option>
                                <option value="Cook Islands" title="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica" title="Costa Rica">Costa Rica</option>
                                <option value="Côte d\'Ivoire" title="Côte d\'Ivoire">Côte d\'Ivoire</option>
                                <option value="Croatia" title="Croatia">Croatia</option>
                                <option value="Cuba" title="Cuba">Cuba</option>
                                <option value="Curaçao" title="Curaçao">Curaçao</option>
                                <option value="Cyprus" title="Cyprus">Cyprus</option>
                                <option value="Czech Republic" title="Czech Republic">Czech Republic</option>
                                <option value="Denmark" title="Denmark">Denmark</option>
                                <option value="Djibouti" title="Djibouti">Djibouti</option>
                                <option value="Dominica" title="Dominica">Dominica</option>
                                <option value="Dominican Republic" title="Dominican Republic">Dominican Republic</option>
                                <option value="Ecuador" title="Ecuador">Ecuador</option>
                                <option value="Egypt" title="Egypt">Egypt</option>
                                <option value="El Salvador" title="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea" title="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea" title="Eritrea">Eritrea</option>
                                <option value="Estonia" title="Estonia">Estonia</option>
                                <option value="Ethiopia" title="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands (Malvinas)" title="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                <option value="Faroe Islands" title="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji" title="Fiji">Fiji</option>
                                <option value="Finland" title="Finland">Finland</option>
                                <option value="France" title="France">France</option>
                                <option value="French Guiana" title="French Guiana">French Guiana</option>
                                <option value="French Polynesia" title="French Polynesia">French Polynesia</option>
                                <option value="French Southern Territories" title="French Southern Territories">French Southern Territories</option>
                                <option value="Gabon" title="Gabon">Gabon</option>
                                <option value="Gambia" title="Gambia">Gambia</option>
                                <option value="Georgia" title="Georgia">Georgia</option>
                                <option value="Germany" title="Germany">Germany</option>
                                <option value="Ghana" title="Ghana">Ghana</option>
                                <option value="Gibraltar" title="Gibraltar">Gibraltar</option>
                                <option value="Greece" title="Greece">Greece</option>
                                <option value="Greenland" title="Greenland">Greenland</option>
                                <option value="Grenada" title="Grenada">Grenada</option>
                                <option value="Guadeloupe" title="Guadeloupe">Guadeloupe</option>
                                <option value="Guam" title="Guam">Guam</option>
                                <option value="Guatemala" title="Guatemala">Guatemala</option>
                                <option value="Guernsey" title="Guernsey">Guernsey</option>
                                <option value="Guinea" title="Guinea">Guinea</option>
                                <option value="Guinea-Bissau" title="Guinea-Bissau">Guinea-Bissau</option>
                                <option value="Guyana" title="Guyana">Guyana</option>
                                <option value="Haiti" title="Haiti">Haiti</option>
                                <option value="Heard Island and McDonald Islands" title="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                                <option value="Holy See (Vatican City State)" title="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                <option value="Honduras" title="Honduras">Honduras</option>
                                <option value="Hong Kong" title="Hong Kong">Hong Kong</option>
                                <option value="Hungary" title="Hungary">Hungary</option>
                                <option value="Iceland" title="Iceland">Iceland</option>
                                <option value="India" title="India">India</option>
                                <option value="Indonesia" title="Indonesia">Indonesia</option>
                                <option value="Iran, Islamic Republic of Iran" title="Iran, Islamic Republic of Iran">Iran, Islamic Republic of Iran</option>
                                <option value="Iraq" title="Iraq">Iraq</option>
                                <option value="Ireland" title="Ireland">Ireland</option>
                                <option value="Isle of Man" title="Isle of Man">Isle of Man</option>
                                <option value="Israel" title="Israel">Israel</option>
                                <option value="Italy" title="Italy">Italy</option>
                                <option value="Jamaica" title="Jamaica">Jamaica</option>
                                <option value="Japan" title="Japan">Japan</option>
                                <option value="Jersey" title="Jersey">Jersey</option>
                                <option value="Jordan" title="Jordan">Jordan</option>
                                <option value="Kazakhstan" title="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya" title="Kenya">Kenya</option>
                                <option value="Kiribati" title="Kiribati">Kiribati</option>
                                <option value="Korea, Democratic People\'s Republic of Korea" title="Korea, Democratic People\'s Republic of Korea">Korea, Democratic People\'s Republic of Korea</option>
                                <option value="Korea, Republic of Korea" title="Korea, Republic of Korea">Korea, Republic of Korea</option>
                                <option value="Kuwait" title="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan" title="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Lao People\'s Democratic Republic" title="Lao People\'s Democratic Republic">Lao People\'s Democratic Republic</option>
                                <option value="Latvia" title="Latvia">Latvia</option>
                                <option value="Lebanon" title="Lebanon">Lebanon</option>
                                <option value="Lesotho" title="Lesotho">Lesotho</option>
                                <option value="Liberia" title="Liberia">Liberia</option>
                                <option value="Libya" title="Libya">Libya</option>
                                <option value="Liechtenstein" title="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania" title="Lithuania">Lithuania</option>
                                <option value="Luxembourg" title="Luxembourg">Luxembourg</option>
                                <option value="Macao" title="Macao">Macao</option>
                                <option value="Macedonia, the former Yugoslav Republic of Macedonia" title="Macedonia, the former Yugoslav Republic of Macedonia">Macedonia, the former Yugoslav Republic of Macedonia</option>
                                <option value="Madagascar" title="Madagascar">Madagascar</option>
                                <option value="Malawi" title="Malawi">Malawi</option>
                                <option value="Malaysia" title="Malaysia">Malaysia</option>
                                <option value="Maldives" title="Maldives">Maldives</option>
                                <option value="Mali" title="Mali">Mali</option>
                                <option value="Malta" title="Malta">Malta</option>
                                <option value="Marshall Islands" title="Marshall Islands">Marshall Islands</option>
                                <option value="Martinique" title="Martinique">Martinique</option>
                                <option value="Mauritania" title="Mauritania">Mauritania</option>
                                <option value="Mauritius" title="Mauritius">Mauritius</option>
                                <option value="Mayotte" title="Mayotte">Mayotte</option>
                                <option value="Mexico" title="Mexico">Mexico</option>
                                <option value="Micronesia, Federated States of Micronesia" title="Micronesia, Federated States ofMicronesia">Micronesia, Federated States of Micronesia</option>
                                <option value="Moldova, Republic of Moldova" title="Moldova, Republic of Moldova">Moldova, Republic of Moldova</option>
                                <option value="Monaco" title="Monaco">Monaco</option>
                                <option value="Mongolia" title="Mongolia">Mongolia</option>
                                <option value="Montenegro" title="Montenegro">Montenegro</option>
                                <option value="Montserrat" title="Montserrat">Montserrat</option>
                                <option value="Morocco" title="Morocco">Morocco</option>
                                <option value="Mozambique" title="Mozambique">Mozambique</option>
                                <option value="Myanmar" title="Myanmar">Myanmar</option>
                                <option value="Namibia" title="Namibia">Namibia</option>
                                <option value="Nauru" title="Nauru">Nauru</option>
                                <option value="Nepal" title="Nepal">Nepal</option>
                                <option value="Netherlands" title="Netherlands">Netherlands</option>
                                <option value="New Caledonia" title="New Caledonia">New Caledonia</option>
                                <option value="New Zealand" title="New Zealand">New Zealand</option>
                                <option value="Nicaragua" title="Nicaragua">Nicaragua</option>
                                <option value="Niger" title="Niger">Niger</option>
                                <option value="Nigeria" title="Nigeria">Nigeria</option>
                                <option value="Niue" title="Niue">Niue</option>
                                <option value="Norfolk Island" title="Norfolk Island">Norfolk Island</option>
                                <option value="Northern Mariana Islands" title="Northern Mariana Islands">Northern Mariana Islands</option>
                                <option value="Norway" title="Norway">Norway</option>
                                <option value="Oman" title="Oman">Oman</option>
                                <option value="Pakistan" title="Pakistan">Pakistan</option>
                                <option value="Palau" title="Palau">Palau</option>
                                <option value="Palestinian Territory, Occupied" title="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                <option value="Panama" title="Panama">Panama</option>
                                <option value="Papua New Guinea" title="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay" title="Paraguay">Paraguay</option>
                                <option value="Peru" title="Peru">Peru</option>
                                <option value="Philippines" title="Philippines">Philippines</option>
                                <option value="Pitcairn" title="Pitcairn">Pitcairn</option>
                                <option value="Poland" title="Poland">Poland</option>
                                <option value="Portugal" title="Portugal">Portugal</option>
                                <option value="Puerto Rico" title="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar" title="Qatar">Qatar</option>
                                <option value="Réunion" title="Réunion">Réunion</option>
                                <option value="Romania" title="Romania">Romania</option>
                                <option value="Russian Federation" title="Russian Federation">Russian Federation</option>
                                <option value="Rwanda" title="Rwanda">Rwanda</option>
                                <option value="Saint Barthélemy" title="Saint Barthélemy">Saint Barthélemy</option>
                                <option value="Saint Helena, Ascension and Tristan da Cunha" title="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
                                <option value="Saint Kitts and Nevis" title="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                <option value="Saint Lucia" title="Saint Lucia">Saint Lucia</option>
                                <option value="Saint Martin (French part)" title="Saint Martin (French part)">Saint Martin (French part)</option>
                                <option value="Saint Pierre and Miquelon" title="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                <option value="Saint Vincent and the Grenadines" title="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                <option value="Samoa" title="Samoa">Samoa</option>
                                <option value="San Marino" title="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe" title="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value="Saudi Arabia" title="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal" title="Senegal">Senegal</option>
                                <option value="Serbia" title="Serbia">Serbia</option>
                                <option value="Seychelles" title="Seychelles">Seychelles</option>
                                <option value="Sierra Leone" title="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore" title="Singapore">Singapore</option>
                                <option value="Sint Maarten (Dutch part)" title="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
                                <option value="Slovakia" title="Slovakia">Slovakia</option>
                                <option value="Slovenia" title="Slovenia">Slovenia</option>
                                <option value="Solomon Islands" title="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia" title="Somalia">Somalia</option>
                                <option value="South Africa" title="South Africa">South Africa</option>
                                <option value="South Georgia and the South Sandwich Islands" title="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                                <option value="South Sudan" title="South Sudan">South Sudan</option>
                                <option value="Spain" title="Spain">Spain</option>
                                <option value="Sri Lanka" title="Sri Lanka">Sri Lanka</option>
                                <option value="Sudan" title="Sudan">Sudan</option>
                                <option value="Suriname" title="Suriname">Suriname</option>
                                <option value="Svalbard and Jan Mayen" title="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                <option value="Swaziland" title="Swaziland">Swaziland</option>
                                <option value="Sweden" title="Sweden">Sweden</option>
                                <option value="Switzerland" title="Switzerland">Switzerland</option>
                                <option value="Syrian Arab Republic" title="Syrian Arab Republic">Syrian Arab Republic</option>
                                <option value="Taiwan, Province of China" title="Taiwan, Province of China">Taiwan, Province of China</option>
                                <option value="Tajikistan" title="Tajikistan">Tajikistan</option>
                                <option value="Tanzania, United Republic of Tanzania" title="Tanzania, United Republic of Tanzania">Tanzania, United Republic of Tanzania</option>
                                <option value="Thailand" title="Thailand">Thailand</option>
                                <option value="Timor-Leste" title="Timor-Leste">Timor-Leste</option>
                                <option value="Togo" title="Togo">Togo</option>
                                <option value="Tokelau" title="Tokelau">Tokelau</option>
                                <option value="Tonga" title="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago" title="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia" title="Tunisia">Tunisia</option>
                                <option value="Turkey" title="Turkey">Turkey</option>
                                <option value="Turkmenistan" title="Turkmenistan">Turkmenistan</option>
                                <option value="Turks and Caicos Islands" title="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                <option value="Tuvalu" title="Tuvalu">Tuvalu</option>
                                <option value="Uganda" title="Uganda">Uganda</option>
                                <option value="Ukraine" title="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates" title="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom" title="United Kingdom">United Kingdom</option>
                                <option value="United States" title="United States">United States</option>
                                <option value="United States Minor Outlying Islands" title="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                <option value="Uruguay" title="Uruguay">Uruguay</option>
                                <option value="Uzbekistan" title="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu" title="Vanuatu">Vanuatu</option>
                                <option value="Venezuela, Bolivarian Republic of Venezuela" title="Venezuela, Bolivarian Republic of Venezuela">Venezuela, Bolivarian Republic of Venezuela</option>
                                <option value="Viet Nam" title="Viet Nam">Viet Nam</option>
                                <option value="Virgin Islands, British" title="Virgin Islands, British">Virgin Islands, British</option>
                                <option value="Virgin Islands, U.S." title="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                <option value="Wallis and Futuna" title="Wallis and Futuna">Wallis and Futuna</option>
                                <option value="Western Sahara" title="Western Sahara">Western Sahara</option>
                                <option value="Yemen" title="Yemen">Yemen</option>
                                <option value="Zambia" title="Zambia">Zambia</option>
                                <option value="Zimbabwe" title="Zimbabwe">Zimbabwe</option>';
        return $html;
    }

    public function getAccountCategories() {
        $data['request_type'] = 'get_account_categories';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                if (!empty($_POST['account_category']) && $_POST['account_category'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            } else {
                if (!empty($_POST['account_category']) && $_POST['account_category'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            }
        }
        if ($html == "")
            $html = "<option value=\"\">No account category entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getAccountTypes() {
        $data['request_type'] = 'get_account_types';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                $html .= "<option value=\"{$row['id']}\" selected>{$row['name']}</option>";
            } else {
                $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
            }
        }
        if ($html == "")
            $html = "<option value=\"\">No account type entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getChapterBranches() {
        $data['request_type'] = 'get_chapter_branches';
        $data['chapter'] = $_SESSION['user_details']['chapter'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                $html .= "<option value=\"{$row['id']}\" selected>{$row['name']}</option>";
            } else {
                $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
            }
        }
        if ($html == "")
            $html = "<option value=\"\">No branch entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getInstitutionBranches($institution) {
        $data['request_type'] = 'get_institution_branches';
        $data['institution'] = $institution;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                $html .= "<option value=\"{$row['id']}\" selected>{$row['name']}</option>";
            } else {
                $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
            }
        }
        if ($html == "")
            $html = "<option value=\"\">No branch entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getBranches() {
        $data['request_type'] = 'get_branches';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                $html .= "<option value=\"{$row['id']}\" selected>{$row['name']}</option>";
            } else {
                $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
            }
        }
        if ($html == "")
            $html = "<option value=\"\">No branch entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getInstitutions() {
        $data['request_type'] = 'get_institutions';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['company_name'];
                $html .= "<option value=\"{$row['id']}\" selected>{$row['company_name']}</option>";
            } else {
                $html .= "<option value=\"{$row['id']}\">{$row['company_name']}</option>";
            }
        }
        if ($html == "") {
            $html = "<option value=\"\">No institution entered into the database!</option>";
        } else {
            $html .= "<option value=0>OTHER</option>";
        }
        echo $html;
        return $currentGroup;
    }

    public function getTransactionTypes() {
        $data['request_type'] = 'get_transaction_types';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                $html .= "<option value=\"{$row['id']}\" selected>{$row['name']}</option>";
            } else {
                $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
            }
        }
        if ($html == "")
            $html = "<option value=\"\">No transaction type entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getTransactionRefTypeId($transaction_type) {
        $data['request_type'] = 'get_transaction_ref_type_id';
        $data['transaction_type'] = $transaction_type;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return strtoupper($info);
    }

    public function getInstitutionRefTypeId($institution_name) {
        $data['request_type'] = 'get_institution_ref_type_id';
        $data['institution_name'] = $institution_name;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return strtoupper($info);
    }

    private function addBranch() {
        $data['request_type'] = $_POST['action'];
        $data['institution'] = $_SESSION['user_details']['institution'];
        $data['code'] = $_POST['branch_code'];
        $data['name'] = $_POST['name'];
        $data['email'] = $_POST['email'];
        $data['phone_number'] = $_POST['phone_number'];
        $data['location'] = $_POST['location'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['code']) && !empty($data['name']) && !empty($data['email']) && !empty($data['phone_number']) && !empty($data['location']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
                echo '<div class="alert alert-block alert-danger ">
                        <button data-dismiss="alert" class="close close-sm" type="button">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Oh snap!</strong> Change a few things up and try submitting again.
                     </div>';
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

    private function addTransactionType() {
        $data['request_type'] = $_POST['action'];
        $data['name'] = $_POST['name'];
        $data['charge'] = $_POST['charge'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['name']) && !empty($data['charge']) && !empty($data['createdby'])) {
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

    private function addResponse() {
        $data['request_type'] = $_POST['action'];
        $data['component'] = $_POST['component'];
        $data['message'] = $_POST['message'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['message']) && !empty($data['createdby'])) {
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

    private function addMaritalStatus() {
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

    private function addStatus() {
        $data['request_type'] = $_POST['action'];
        $data['status_code'] = $_POST['status_code'];
        $data['description'] = $_POST['description'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['status_code']) && !empty($data['description']) && !empty($data['createdby'])) {
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

    private function addSector() {
        $data['request_type'] = $_POST['action'];
        $data['name'] = $_POST['name'];
        $data['description'] = $_POST['description'];
        $data['cover_photo'] = $_SESSION['filename'];
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

    private function addDefaultChargeRate() {
        $data['request_type'] = $_POST['action'];
        $data['description'] = $_POST['description'];
        $data['amount'] = $_POST['amount'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['description']) && !empty($data['amount']) && !empty($data['createdby'])) {
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

    private function addBusinessType() {
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

    private function addBusinessForm() {
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

    private function addLoanProcessingFees() {
        $data['request_type'] = $_POST['action'];
        $data['start'] = $_POST['start'];
        $data['end'] = $_POST['end'];
        $data['amount_type'] = $_POST['amount_type'];
        $data['amount'] = $_POST['amount'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['start']) && !empty($data['end']) && !empty($data['amount_type']) && !empty($data['amount']) && !empty($data['createdby'])) {
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

    private function addAccountCategory() {
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

    private function addAccountType() {
        $data['request_type'] = $_POST['action'];
        $data['name'] = $_POST['name'];
        $data['opening_balance'] = $_POST['opening_balance'];
        $data['minimum_balance'] = $_POST['minimum_balance'];
        $data['minimum_deposit'] = $_POST['minimum_deposit'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['name']) && !empty($data['opening_balance']) && !empty($data['minimum_balance']) && !empty($data['minimum_deposit']) && !empty($data['createdby'])) {
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

    private function addInstitution() {
        $data['request_type'] = $_POST['action'];
        $data['company_name'] = $_POST['company_name'];
        $data['registration_number'] = $_POST['company_registration_number'];
        $data['business_type'] = $_POST['company_business_type'];
        $data['incorporation_certificate'] = $_SESSION['incorporation_certificate'];
        $data['registration_date'] = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
        $data['phone_number'] = $_POST['company_phone_number'];
        $data['email'] = $_POST['company_email'];
        $data['postal_number'] = $_POST['company_postal_number'];
        $data['postal_code'] = $_POST['company_postal_code'];
        $data['town'] = $_POST['company_town'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['company_name']) && !empty($data['business_type']) && !empty($data['phone_number']) && !empty($data['email']) && !empty($data['createdby'])) {
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

    public function fetchBranchDetails($code) {
        $data['request_type'] = 'fetch_branch_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchTransactionTypeDetails($code) {
        $data['request_type'] = 'fetch_transaction_type_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchLoanProcessingFeeDetails($code) {
        $data['request_type'] = 'fetch_loan_processing_fee_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchStatusDetails($code) {
        $data['request_type'] = 'fetch_status_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchSectorDetails($code) {
        $data['request_type'] = 'fetch_sector_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchResponseDetails($code) {
        $data['request_type'] = 'fetch_response_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchMaritalStatusDetails($code) {
        $data['request_type'] = 'fetch_marital_status_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchDefaultChargeRateDetails($code) {
        $data['request_type'] = 'fetch_default_charge_rate_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchBusinessTypeDetails($code) {
        $data['request_type'] = 'fetch_business_type_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchBusinessFormDetails($code) {
        $data['request_type'] = 'fetch_business_form_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchAccountTypeDetails($code) {
        $data['request_type'] = 'fetch_account_type_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchAccountCategoryDetails($code) {
        $data['request_type'] = 'fetch_account_category_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchInstitutionDetails($code) {
        $data['request_type'] = 'fetch_institution_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    private function editLoanProcessingFees() {
        $data['request_type'] = $_POST['action'];
        $data['id'] = $_SESSION['loan_processing_fee'];
        $data['start'] = $_POST['start'];
        $data['end'] = $_POST['end'];
        $data['amount_type'] = $_POST['amount_type'];
        $data['amount'] = $_POST['amount'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['id']) && !empty($data['start']) && !empty($data['end']) && !empty($data['amount_type']) && !empty($data['amount']) && !empty($data['createdby'])) {
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

    private function editBranch() {
        $data['request_type'] = $_POST['action'];
        $data['id'] = $_SESSION['branch'];
        $data['code'] = $_POST['branch_code'];
        $data['name'] = $_POST['name'];
        $data['email'] = $_POST['email'];
        $data['phone_number'] = $_POST['phone_number'];
        $data['location'] = $_POST['location'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['id']) && !empty($data['code']) && !empty($data['name']) && !empty($data['email']) && !empty($data['phone_number']) && !empty($data['location']) && !empty($data['createdby'])) {
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

    private function editDefaultChargeRate() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['default_charge_rate'];
        $data['description'] = $_POST['description'];
        $data['amount'] = $_POST['amount'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['code']) && !empty($data['description']) && !empty($data['amount']) && !empty($data['createdby'])) {
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

    private function editMaritalStatus() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['marital_status'];
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

    private function editResponse() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['response'];
        $data['message'] = $_POST['message'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['code']) && !empty($data['message']) && !empty($data['createdby'])) {
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

    private function editStatus() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['status'];
        $data['status_code'] = $_POST['status_code'];
        $data['description'] = $_POST['description'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['code']) && !empty($data['status_code']) && !empty($data['description']) && !empty($data['createdby'])) {
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

    private function editSector() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['sector'];
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

    private function editTransactionType() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['transaction_type'];
        $data['name'] = $_POST['name'];
        $data['charge'] = $_POST['charge'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['code']) && !empty($data['name']) && !empty($data['charge']) && !empty($data['createdby'])) {
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

    private function editBusinessType() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['business_type'];
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

    private function editBusinessForm() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['business_form'];
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

    private function editAccountType() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['account_type'];
        $data['opening_balance'] = $_POST['opening_balance'];
        $data['minimum_balance'] = $_POST['minimum_balance'];
        $data['minimum_deposit'] = $_POST['minimum_deposit'];
        $data['name'] = $_POST['name'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['code']) && !empty($data['opening_balance']) && !empty($data['minimum_balance']) && !empty($data['minimum_deposit']) && !empty($data['name']) && !empty($data['createdby'])) {
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

    private function editAccountCategory() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['account_category'];
        $data['new_name'] = $_POST['name'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['code']) && !empty($data['new_name']) && !empty($data['createdby'])) {
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

    private function editInstitution() {
        $data['request_type'] = $_POST['action'];
        $data['company_name '] = $_POST['company_name '];
        $data['business_type '] = $_POST['business_type '];
        $data['postal_number'] = $_POST['postal_number'];
        $data['postal_code'] = $_POST['postal_code'];
        $data['town'] = $_POST['town'];
        $data['phone_number'] = $_POST['phone_number'];
        $data['email'] = $_POST['email'];
        $data['is_partner '] = $_POST['is_partner '];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['company_name']) && !empty($data['business_type']) && !empty($data['postal_number']) && !empty($data['postal_code']) && !empty($data['town']) && !empty($data['phone_number']) && !empty($data['email']) && !empty($data['is_partner']) && !empty($data['createdby'])) {
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

    public function updateAccountCategory($code, $update_type) {
        $data['request_type'] = 'update_account_category';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateTransactionType($code, $update_type) {
        $data['request_type'] = 'update_transaction_type';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateStatus($code, $update_type) {
        $data['request_type'] = 'update_status';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateResponse($code, $update_type) {
        $data['request_type'] = 'update_response';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateMaritalStatus($code, $update_type) {
        $data['request_type'] = 'update_marital_status';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateDefaultChargeRate($code, $update_type) {
        $data['request_type'] = 'update_default_charge_rate';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateBusinessType($code, $update_type) {
        $data['request_type'] = 'update_business_type';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateSector($code, $update_type) {
        $data['request_type'] = 'update_sector';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateBusinessForm($code, $update_type) {
        $data['request_type'] = 'update_business_form';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateLoanProcessingFees($code, $update_type) {
        $data['request_type'] = 'update_loan_processing_fees';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateBranch($code, $update_type) {
        $data['request_type'] = 'update_branch';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateAccountType($code, $update_type) {
        $data['request_type'] = 'update_account_type';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateInstitution($code, $update_type, $approval_comment) {
        $data['request_type'] = 'update_institution';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['approval_comment'] = $approval_comment;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

}
