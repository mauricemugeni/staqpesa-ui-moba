<?php

require_once WPATH . "modules/classes/Transactions.php";
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Users.php";

class Loans extends Database {

    public function execute() {
        if ($_POST['action'] == "add_instalment_frequency") {
            return $this->addInstalmentFrequency();
        } else if ($_POST['action'] == "edit_instalment_frequency") {
            return $this->editInstalmentFrequency();
        } else if ($_POST['action'] == "add_loan_type") {
            return $this->addLoanType();
        } else if ($_POST['action'] == "add_loan") {
            return $this->addLoan();
        } else if ($_POST['action'] == "engage_loan_calculator") {
            return $this->engageLoanCalculator();
        } else if ($_POST['action'] == "edit_loan") {
            return $this->editLoan();
        } else if ($_POST['action'] == "edit_loan_type") {
            return $this->editLoanType();
        } else if ($_POST['action'] == "edit_loan_business_data") {
            return $this->editLoanBusinessData();
        } else if ($_POST['action'] == "edit_loan_guarantor") {
            return $this->editLoanGuarantor();
        } else if ($_POST['action'] == "get_loan_repayment_details") {
            return $this->getLoanRepaymentDetails();
        } else if ($_POST['action'] == "update_loan_repayment") {
            return $this->updateLoanRepayment();
        } else if ($_POST['action'] == "search") {
            $settings = new Settings();
            return $settings->searchSystem($_POST['request_type'], $_POST['search_input']);
        } else if ($_POST['action'] == "view_statement_from_to") {
            $start_date = explode("/", $_POST['date1']);
            $end_date = explode("/", $_POST['date2']);
            $start_time = $start_date[2] . "-" . $start_date[0] . "-" . $start_date[1];
            $end_time = $end_date[2] . "-" . $end_date[0] . "-" . $end_date[1];
            return $this->loansStatement(strtotime($start_time), strtotime("+1 day", strtotime($end_time)));
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

    public function engageLoanCalculator() {
        $data['request_type'] = $_POST['action'];
        $data['loan_type'] = $_POST['loan_type'];
        $data['principal_amount'] = $_POST['principal_amount'];
        $data['duration'] = $_POST['duration'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getLoanQualificationStatus($authorizedat, $qualification_time) {
        $data['request_type'] = 'get_loan_qualification_status';
        $data['authorizedat'] = $authorizedat;
        $data['qualification_time'] = $qualification_time;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function checkLoanNumber($loan_number) {
        $data['request_type'] = 'check_loan_number';
        $data['loan_number'] = $loan_number;
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

    public function getTransactionDetails($code) {
        $transactions = new Transactions();
        return $transactions->fetchTransactionDetails($code);
    }

    public function getLedgerBalance($code) {
        $transactions = new Transactions();
        return $transactions->fetchLedgerBalance($code);
    }

    public function getApprovalStatus($code) {
        $transactions = new Transactions();
        return $transactions->fetchTransactionDetails($code);
    }

    public function getTransactionTypeDetails($code) {
        $settings = new Settings();
        return $settings->fetchTransactionTypeDetails($code);
    }

    public function setPagination($sql, $total_records, $targetpage) {
        $settings = new Settings();
        return $settings->pagination($sql, $total_records, $targetpage);
    }

    public function fetchLoanBalance($loan_number) {
        $data['request_type'] = 'fetch_loan_balance';
        $data['loan_number'] = $loan_number;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function loansStatement($start_time, $end_time) {
        $data['request_type'] = "fetch_loans_statement";
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

    public function updateLoanBalance() {
        $data['request_type'] = 'update_loan_balance';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateLoanDefault() {
        $data['request_type'] = 'update_loan_default';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateLoan($field, $code, $update_type) {
        $data['request_type'] = 'update_loan';
        $data['code'] = $code;
        $data['field'] = $field;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateLoanBusinessData($code, $update_type) {
        $data['request_type'] = 'update_loan_business_data';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateLoanGuarantors($code, $update_type) {
        $data['request_type'] = 'update_loan_guarantors';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateLoanType($code, $update_type) {
        $data['request_type'] = 'update_loan_type';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateInstalmentFrequency($code, $update_type) {
        $data['request_type'] = 'update_instalment_frequency';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    private function editLoan() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['loan'];
        $data['loan_type'] = $_POST['loan_type'];
        $data['transactedby'] = $_POST['customer_name'];
        $data['account_number'] = $_POST['account_number'];
        $data['principal_amount'] = $_POST['principal_amount'];
        $data['duration'] = $_POST['duration'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['code']) && !empty($data['loan_type']) && !empty($data['transactedby']) && !empty($data['account_number']) && !empty($data['principal_amount']) && !empty($data['duration']) && !empty($data['createdby'])) {
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

    private function editLoanType() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['loan_type'];
        $data['name'] = $_POST['name'];
        $data['qualification_time'] = $_POST['qualification_time'];
        $data['qualification_amount'] = $_POST['qualification_amount'];
        $data['interest_rate'] = $_POST['interest_rate'];
        $data['maximum_duration'] = $_POST['maximum_duration'];
        $data['instalment_frequency'] = $_POST['instalment_frequency'];
        $data['default_rate'] = $_POST['default_rate'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['code']) && !empty($data['name']) && !empty($data['qualification_time']) && !empty($data['qualification_amount']) && !empty($data['interest_rate']) && !empty($data['maximum_duration']) && !empty($data['instalment_frequency']) && !empty($data['default_rate']) && !empty($data['createdby'])) {
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

    private function editLoanGuarantor() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_POST['code'];
        $data['firstname'] = $_POST['firstname'];
        $data['middlename'] = $_POST['middlename'];
        $data['lastname'] = $_POST['lastname'];
        $data['gender'] = $_POST['gender'];
        $data['idnumber'] = $_POST['idnumber'];
        $data['relationship'] = $_POST['relationship'];
        $data['phone_number'] = $_POST['phone_number'];
        $data['postal_address'] = $_POST['postal_address'];
        $data['physical_address'] = $_POST['physical_address'];
        $data['place_of_residence'] = $_POST['place_of_residence'];
        $data['estate'] = $_POST['estate'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['code']) && !empty($data['firstname']) && !empty($data['gender']) && !empty($data['idnumber']) && !empty($data['relationship']) && !empty($data['createdby'])) {
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

    private function editLoanBusinessData() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['loan_business_data'];
        $data['eunique_credit'] = $_POST['eunique_credit'];
        $data['other_credit'] = $_POST['other_credit'];
        $data['business_type'] = $_POST['business_type'];
        $data['business_form'] = $_POST['business_form'];
        $data['business_time'] = $_POST['business_time'];
        $data['stock_value'] = $_POST['stock_value'];
        $data['daily_sales'] = $_POST['daily_sales'];
        $data['monthly_income'] = $_POST['monthly_income'];
        $data['monthly_expenses'] = $_POST['monthly_expenses'];
        $data['employees'] = $_POST['employees'];
        $data['licensed'] = $_POST['licensed'];
        $data['road'] = $_POST['road'];
        $data['street'] = $_POST['street'];
        $data['location'] = $_POST['location'];
        $data['building'] = $_POST['building'];
        $data['house_number'] = $_POST['house_number'];
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

    private function editInstalmentFrequency() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['instalment_frequency'];
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

    private function getAccountDetails($code) {
        $users = new Users();
        return $users->fetchAccountDetails($code);
    }

    public function getStaffDetails($code) {
        $users = new Users();
        return $users->fetchStaffDetails($code);
    }

    public function fetchLoanBusinessDataDetails($code) {
        $data['request_type'] = 'fetch_loan_business_data_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchLoanPrincipalAmount($transactionId) {
        $data['request_type'] = 'fetch_loan_principal_amount';
        $data['transactionId'] = $transactionId;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchInstalmentFrequencyDetails($code) {
        $data['request_type'] = 'fetch_instalment_frequency_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchLoanDetails($code) {
        $data['request_type'] = 'fetch_loan_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchLoanStatusDetails($code) {
        $data['request_type'] = 'fetch_loan_status_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchLoanRepaymentDetails($code) {
        $data['request_type'] = 'fetch_loan_repayment_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchLoanTypeDetails($code) {
        $data['request_type'] = 'fetch_loan_type_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchLoanGuarantorDetails($code) {
        $data['request_type'] = 'fetch_loan_guarantor_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchIndividualLoanGuarantorDetails($code) {
        $data['request_type'] = 'fetch_individual_loan_guarantor_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function transitionalFetchLoanGuarantorDetails($code) {
        $data['request_type'] = 'transitional_fetch_loan_guarantor_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function transitionalFetchLoanBusinessDataDetails($code) {
        $data['request_type'] = 'transitional_fetch_loan_business_data_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllInstalmentFrequencyNotifications() {
        $data['request_type'] = 'get_all_instalment_frequency_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllLoanRepaymentNotifications() {
        $data['request_type'] = 'get_all_loan_repayment_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllLoanBusinessDataNotifications() {
        $data['request_type'] = 'get_all_loan_business_data_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllLoanGuarantorNotifications() {
        $data['request_type'] = 'get_all_loan_guarantor_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllLoanTypeNotifications() {
        $data['request_type'] = 'get_all_loan_type_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllLoanNotifications() {
        $data['request_type'] = 'get_all_loan_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllInstalmentFrequencies() {
        $data['request_type'] = 'get_all_instalment_frequencies';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllLoanRepayments() {
        $data['request_type'] = 'get_all_loan_repayments';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllAccountLoanRepayments() {
        $data['request_type'] = 'get_all_account_loan_repayments';
        $data['account'] = $_SESSION['account'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllLoanBusinessData() {
        $data['request_type'] = 'get_all_loan_business_data';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllAccountLoanBusinessData() {
        $data['request_type'] = 'get_all_account_loan_business_data';
        $data['account'] = $_SESSION['account'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllLoanGuarantors() {
        $data['request_type'] = 'get_all_loan_guarantors';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllAccountLoanGuarantors() {
        $data['request_type'] = 'get_all_account_loan_guarantors';
        $data['account'] = $_SESSION['account'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllLoanTypes() {
        $data['request_type'] = 'get_all_loan_types';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllAccountLoans() {
        $data['request_type'] = 'get_all_account_loans';
        $data['account'] = $_SESSION['account'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllLoans() {
        $data['request_type'] = 'get_all_loans';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getMaritalStatusDetails($code) {
        $settings = new Settings();
        return $settings->fetchMaritalStatusDetails($code);
    }

    public function getBusinessTypeDetails($code) {
        $settings = new Settings();
        return $settings->fetchBusinessTypeDetails($code);
    }

    public function getBusinessFormDetails($code) {
        $settings = new Settings();
        return $settings->fetchBusinessFormDetails($code);
    }

    public function getNextTransactionId() {
        $data['request_type'] = 'get_next_transaction_id';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getLoanTypes() {
        $data['request_type'] = 'get_loan_types';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                if (!empty($_POST['loan_type']) && $_POST['loan_type'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            } else {
                if (!empty($_POST['loan_type']) && $_POST['loan_type'] == $row['id']) {
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
            $html = "<option value=\"\">No loan type entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getInstalmentFrequencies() {
        $data['request_type'] = 'get_instalment_frequencies';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                if (!empty($_POST['instalment_frequency']) && $_POST['instalment_frequency'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            } else {
                if (!empty($_POST['instalment_frequency']) && $_POST['instalment_frequency'] == $row['id']) {
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
            $html = "<option value=\"\">No instalment frequency entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    private function addLoan() {
        $data['request_type'] = $_POST['action'];

        // Loans        
        $data['loan_type'] = $_SESSION['loan_type'];
        $data['principal_amount'] = $_SESSION['principal_amount'];
        $data['interest'] = $_SESSION['interest'];
        $data['due_date'] = $_SESSION['due_date'];
        $data['transaction_id'] = $_SESSION['transaction_id'];
        $data['duration'] = $_SESSION['duration'];
        $data['instalment_amount'] = $_SESSION['instalment_amount'];
        $data['purpose'] = $_SESSION['purpose'];
        $data['our_credit_status'] = $_SESSION['our_credit_status'];
        $data['our_credit_amount'] = $_SESSION['our_credit_amount'];
        $data['our_credit_date_issued'] = $_SESSION['our_credit_date_issued'];
        $data['other_credit_status'] = $_SESSION['other_credit_status'];
        $data['other_credit_organization'] = $_SESSION['other_credit_organization'];
        $data['other_credit_amount'] = $_SESSION['other_credit_amount'];
        $data['other_credit_date_issued'] = $_SESSION['other_credit_date_issued'];
        $data['createdby'] = $_SESSION['createdby'];

        // Transactions
        $data['transaction_type'] = $_SESSION['transaction_type'];
        $data['account_number'] = $_SESSION['account'];
        $data['transactedby'] = $_SESSION['transactedby'];

        // Loan Business Data
        $loan_type_details = $this->fetchLoanTypeDetails($_SESSION['loan_type']);
        if ($loan_type_details['name'] == "BUSINESS LOAN") {
            $data['business_type'] = $_SESSION['business_type'];
            $data['business_form'] = $_SESSION['business_form'];
            $data['business_time'] = $_SESSION['business_time'];
            $data['stock_value'] = $_SESSION['stock_value'];
            $data['daily_sales'] = $_SESSION['daily_sales'];
            $data['monthly_income'] = $_SESSION['monthly_income'];
            $data['monthly_expenses'] = $_SESSION['monthly_expenses'];
            $data['employees'] = $_SESSION['employees'];
            $data['licensed'] = $_SESSION['licensed'];
            $data['road'] = $_SESSION['road'];
            $data['street'] = $_SESSION['street'];
            $data['location'] = $_SESSION['location'];
            $data['building'] = $_SESSION['building'];
            $data['house_number'] = $_SESSION['house_number'];
        }

        // Loan Guarantor
        $data['guarantors_details'] = $_SESSION['guarantors_list'];
        
        $data_string = http_build_query($data);
        
        if (!empty($data['request_type']) && !empty($data['loan_type']) && !empty($data['principal_amount']) && !empty($data['account_number']) && !empty($data['transaction_type']) && !empty($data['guarantors_details']) && !empty($data['createdby'])) {
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

    private function addInstalmentFrequency() {
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

    private function addLoanType() {
        $data['request_type'] = $_POST['action'];
        $data['name'] = $_POST['name'];
        $data['qualification_time'] = $_POST['qualification_time'];
        $data['qualification_amount'] = $_POST['qualification_amount'];
        $data['interest_rate'] = $_POST['interest_rate'];
        $data['maximum_duration'] = $_POST['maximum_duration'];
        $data['instalment_frequency'] = $_POST['instalment_frequency'];
        $data['default_rate'] = $_POST['default_rate'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['name']) && !empty($data['qualification_time']) && !empty($data['interest_rate']) && !empty($data['instalment_frequency']) && !empty($data['createdby'])) {
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

}
