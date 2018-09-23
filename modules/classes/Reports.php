<?php

require_once WPATH . "modules/classes/Settings.php";

class Reports extends Database {

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

    public function countAllSubjectAreaRecords($subject_area) {
        $data['request_type'] = $subject_area;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function countAllTransactionRecordsByTransactionType($transaction_type) {
        $data['request_type'] = "count_all_transaction_records_by_transaction_type";
        $data['transaction_type'] = $transaction_type;
        if (isset($_SESSION['account'])) {
            $data['account_number'] = $_SESSION['account'];
        }
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function sumAllTransactionAmountsByTransactionType($transaction_type) {
        $data['request_type'] = "sum_all_transaction_amounts_by_transaction_type";
        $data['transaction_type'] = $transaction_type;
        if (isset($_SESSION['account'])) {
            $data['account_number'] = $_SESSION['account'];
        }
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function countAllBidsByProject($project_id) {
        $data['request_type'] = "count_all_bids_by_project";
        $data['project_id'] = $project_id;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function sumAllBidsByProject($project_id) {
        $data['request_type'] = "sum_all_bids_by_project";
        $data['project_id'] = $project_id;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllTopProjects() {
        $data['request_type'] = 'get_all_top_projects';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllTopDeposits() {
        $data['request_type'] = 'get_all_top_deposits';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllTopLoanApplications() {
        $data['request_type'] = 'get_all_top_loan_applications';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getRecentStaffActivity() {
        $data['request_type'] = 'get_recent_staff_activity';
        if (isset($_SESSION['institution_admin']) AND $_SESSION['institution_admin'] == true) {
            $data['institution'] = $_SESSION['user_details']['institution'];
        }
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getRecentInvestorActivity() {
        $data['request_type'] = 'get_recent_investor_activity';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getRecentInvestorInvestments() {
        $data['request_type'] = 'get_recent_investor_investments';
        $data['investor_id'] = $_SESSION['investor'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getRecentGuestUsers() {
        $data['request_type'] = 'get_recent_guest_users';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }
    
    public function getRecentTransactions() {
        $data['request_type'] = 'get_recent_transactions';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }
    
    public function getRecentAccountTransactions() {
        $data['request_type'] = 'get_recent_account_transactions';
        $data['account_number'] = $_SESSION['account'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }
}
