<?php

require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Transactions.php";

class Transitional extends Database {

    public function execute() {
        if ($_POST['action'] == "transitional_add_withdrawal") {
            return $this->addTransaction();
        } else if ($_POST['action'] == "transitional_add_deposit") {
            return $this->addTransaction();
        } else if ($_POST['action'] == "transitional_add_loan_business_data") {
            return $this->addLoanBusinessData();
        } else if ($_POST['action'] == "transitional_add_loan_guarantor") {
            return $this->addLoanGuarantor();
        } else if ($_POST['action'] == "transitional_edit_account") {
            return $this->editAccount();
        } else if ($_POST['action'] == "transitional_add_loan") {
            return $this->addLoan();
        }
        
//        else if ($_POST['action'] == "transitional_add_loan_external_data") {
//            return $this->addLoanExternalData();
//        } else if ($_POST['action'] == "transitional_add_loan_contact_person") {
//            return $this->addLoanContactPerson();
//        } else if ($_POST['action'] == "transitional_add_loan_data") {
//            return $this->addLoanData();
//        }
        
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

    private function addLoanBusinessData() {
        $data['request_type'] = $_POST['action'];
        $data['id']= $_SESSION['loan'];
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

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) ) {
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

    private function addLoanContactPerson() {
        $data['request_type'] = $_POST['action'];
        $data['id']= $_SESSION['loan'];
        $data['firstname'] = $_POST['firstname'];
        $data['middlename'] = $_POST['middlename'];
        $data['lastname'] = $_POST['lastname'];
        $data['relationship'] = $_POST['relationship'];
        $data['workplace'] = $_POST['workplace'];
        $data['phone_number'] = $_POST['phone_number'];
        $data['postal_address'] = $_POST['postal_address'];
        $data['physical_address'] = $_POST['physical_address'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) ) {
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

    private function addLoanData() {
        $data['request_type'] = $_POST['action'];
        $data['id']= $_SESSION['loan'];
        $data['marital_status'] = $_POST['marital_status'];
        $data['spouse_firstname'] = $_POST['spouse_firstname'];
        $data['spouse_middlename'] = $_POST['spouse_middlename'];
        $data['spouse_lastname'] = $_POST['spouse_lastname'];
        $data['dependants'] = $_POST['dependants'];
        $data['landmark'] = $_POST['landmark'];
        $data['purpose'] = $_POST['purpose'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) ) {
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

    private function addLoanGuarantor() {
        $data['request_type'] = $_POST['action'];
        $data['id']= $_SESSION['loan'];
        $data['guarantor1_firstname'] = $_SESSION['guarantor1_firstname'];
        $data['guarantor1_middlename'] = $_SESSION['guarantor1_middlename'];
        $data['guarantor1_lastname'] = $_SESSION['guarantor1_lastname'];
        $data['guarantor1_gender'] = $_SESSION['guarantor1_gender'];
        $data['guarantor1_idnumber'] = $_SESSION['guarantor1_idnumber'];
        $data['guarantor1_relationship'] = $_SESSION['guarantor1_relationship'];
        $data['guarantor1_phone_number'] = $_SESSION['guarantor1_phone_number'];
        $data['guarantor1_postal_address'] = $_SESSION['guarantor1_postal_address'];
        $data['guarantor1_physical_address']= $_SESSION['guarantor1_physical_address'];
        $data['guarantor1_place_of_residence'] = $_SESSION['guarantor1_place_of_residence'];
        $data['guarantor1_estate'] = $_SESSION['guarantor1_estate'];
        
        $data['guarantor2_firstname'] = $_SESSION['guarantor2_firstname'];
        $data['guarantor2_middlename'] = $_SESSION['guarantor2_middlename'];
        $data['guarantor2_lastname'] = $_SESSION['guarantor2_lastname'];
        $data['guarantor2_gender'] = $_SESSION['guarantor2_gender'];
        $data['guarantor2_idnumber'] = $_SESSION['guarantor2_idnumber'];
        $data['guarantor2_relationship'] = $_SESSION['guarantor2_relationship'];
        $data['guarantor2_phone_number'] = $_SESSION['guarantor2_phone_number'];
        $data['guarantor2_postal_address'] = $_SESSION['guarantor2_postal_address'];
        $data['guarantor2_physical_address']= $_SESSION['guarantor2_physical_address'];
        $data['guarantor2_place_of_residence'] = $_SESSION['guarantor2_place_of_residence'];
        $data['guarantor2_estate'] = $_SESSION['guarantor2_estate'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) ) {
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

    private function addLoan() {        
        $data['request_type'] = $_POST['action'];
        $data['loan_type'] = $_POST['loan_type'];
        $data['principal_amount'] = $_POST['principal_amount'];
        $data['interest'] = $_POST['interest'];
        $data['day'] = $_POST['day'];
        $data['month'] = $_POST['month'];
        $data['year'] = $_POST['year'];
        $data['duration'] = $_POST['duration'];
        $data['transaction_id'] = $_POST['transaction_id'];
        $data['createdby'] = $_POST['createdby'];
        $data['transaction_type'] = $_POST['transaction_type'];
        $data['account_number'] = $_SESSION['account'];
        $data['service_charge'] = $_POST['service_charge'];
        $data['customer_name'] = $_POST['customer_name'];
        $data['approval_state'] = $_POST['approval_state'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type'])) {
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

    private function addLoanExternalData() {
        
    }

    private function addTransaction() {
        $data['request_type'] = 'transitional_add_transaction';
        $data['day'] = $_POST['day'];
        $data['day2'] = $_POST['day2'];
        $data['month'] = $_POST['month'];
        $data['month2'] = $_POST['month2'];
        $data['year'] = $_POST['year'];
        $data['year2'] = $_POST['year2'];
        $data['transaction_type'] = $_POST['transaction_type'];
        $data['transaction_id'] = $_POST['transaction_id'];
        $data['account_number'] = $_POST['account_number'];
        $data['transactedby'] = $_POST['transactedby'];
        $data['createdby'] = $_POST['createdby'];
        $data['service_charge'] = $_POST['service_charge'];
        $data['ledger_balance'] = $_POST['ledger_balance'];
        $data['amount'] = $_POST['amount'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['day']) && !empty($data['day2']) && !empty($data['transaction_type']) && !empty($data['account_number']) && !empty($data['ledger_balance'])) {
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

    private function addTransactionCharge($transaction_id, $account_number, $transaction_type, $createdat_charge, $createdby, $service_charge, $ledger_balance) {
        
    }

    public function updateTransaction($code, $update_type) {
        
    }

    private function editAccount() {
        $data['request_type'] = $_POST['action'];
        $data['code'] = $_SESSION['account'];
        $data['day'] = $_POST['day'];
        $data['month'] = $_POST['month'];
        $data['year'] = $_POST['year'];
        $data['old_account_number'] = $_POST['old_account_number'];
        $data['transaction_type'] = $_POST['transaction_type'];
        $data['service_charge'] = $_POST['service_charge'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['code']) && !empty($data['day']) && !empty($data['transaction_type']) && !empty($data['createdby'])) {
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

    public function getAllTransactions($transaction_type) {
        
    }

    public function getTransactionId($transaction_type, $createdby, $amount) {
        $transaction_id = md5($transaction_type . $createdby . $amount . time());
        return strtoupper($transaction_id);
    }

    public function getTransactionRefTypeId($transaction_type) {
        $settings = new Settings();
        return $settings->getTransactionRefTypeId($transaction_type);
    }

    public function fetchLedgerBalance($account_number) {
        
    }

    public function fetchTransactionRefTypeId($code) {
        $transactions = new Transactions();
        return $transactions->getTransactionRefTypeId($code);
    }

    public function getLoanTypeDetails($code) {
        $loans = new Loans();
        return $loans->fetchLoanTypeDetails($code);
    }

    public function getAccountDetails($code) {
        $users = new Users();
        return $users->fetchAccountDetails($code);
    }

    public function getStaffDetails($code) {
        $users = new Users();
        return $users->fetchStaffDetails($code);
    }

    public function getInstalmentFrequencyDetails($code) {
        $loans = new Loans();
        return $loans->fetchInstalmentFrequencyDetails($code);
    }

    public function setPagination($sql, $total_records, $targetpage) {
        $settings = new Settings();
        return $settings->pagination($sql, $total_records, $targetpage);
    }

    private function reverseTransaction($account_number, $amount, $parent_transaction_id, $parent_transaction_type) {
        
    }

    private function reverseTransactionCharge($account_number, $transaction_type, $createdat_charge, $transactedby, $createdby) {
        
    }

}
