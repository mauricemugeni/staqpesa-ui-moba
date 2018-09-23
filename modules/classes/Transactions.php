<?php

require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Users.php";

class Transactions extends Database {

    public function execute() {
        if ($_POST['action'] == "add_withdrawal") {
            return $this->addTransaction();
        } else if ($_POST['action'] == "add_deposit") {
            return $this->addTransaction();
        } else if ($_POST['action'] == "add_shares") {
            return $this->addTransaction();
        } else if ($_POST['action'] == "add_account_to_account_transfer") {
            return $this->addAccountToAccountTransfer();
        } else if ($_POST['action'] == "search") {
            $settings = new Settings();
            return $settings->searchSystem($_POST['request_type'], $_POST['search_input']);
        } else if ($_POST['action'] == "view_statement_from_to") {
            $start_date = explode("/", $_POST['date1']);
            $end_date = explode("/", $_POST['date2']);
            $start_time = $start_date[2] . "-" . $start_date[0] . "-" . $start_date[1];
            $end_time = $end_date[2] . "-" . $end_date[0] . "-" . $end_date[1];
            $settings = new Settings();
            return $settings->transactionsStatement($_POST['statement_type'], strtotime($start_time), strtotime("+1 day", strtotime($end_time)));
        }

//        else if ($_POST['action'] == "search_transactions") {
//            return $this->searchSystem($_POST['transaction_type']);
//        } 
        else if ($_POST['action'] == "search") {
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

    public function getAllAccountTransactions($transaction_type) {
        $data['request_type'] = 'get_all_account_transactions';
        $data['account'] = $_SESSION['account'];
        $data['transaction_type'] = $transaction_type;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllTransactions($transaction_type) {
        $data['request_type'] = 'get_all_transactions';
        $data['transaction_type'] = $transaction_type;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllTransactionNotifications($transaction_type) {
        if ($transaction_type == "ALL") {
            $data['request_type'] = 'get_all_transaction_notifications';
        } else if ($transaction_type == "DEPOSIT") {
            $data['request_type'] = 'get_all_deposit_notifications';
        } else if ($transaction_type == "WITHDRAWAL") {
            $data['request_type'] = 'get_all_withdrawal_notifications';
        } else if ($transaction_type == "ACCOUNT TO ACCOUNT TRANSFER") {
            $data['request_type'] = 'get_all_account_to_account_transfer_notifications';
        }
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getTransactionId($transaction_type, $createdby, $amount) {
        $transaction_id = md5($transaction_type . $createdby . $amount . time());
        return strtoupper($transaction_id);
    }

    public function getTransactionRefTypeId($transaction_type) {
        $settings = new Settings();
        return $settings->getTransactionRefTypeId($transaction_type);
    }

    public function getStaffDetails($code) {
        $users = new Users();
        return $users->fetchStaffDetails($code);
    }

    public function setPagination($sql, $total_records, $targetpage) {
        $settings = new Settings();
        return $settings->pagination($sql, $total_records, $targetpage);
    }

    private function addTransaction() {
        $data['request_type'] = $_POST['action'];
        $data['account_number'] = $_POST['account_number'];
        $data['amount'] = $_POST['amount'];
        $data['transactedby'] = $_POST['transactedby'];
        $data['transaction_type'] = $_POST['transaction_type'];
        if (isset($_POST['day'])) {
            $data['day'] = $_POST['day'];
            $data['month'] = $_POST['month'];
            $data['year'] = $_POST['year'];
        }
        if (isset($_POST['payment_ref_number'])) {
            $data['payment_ref_number'] = $_POST['payment_ref_number'];
            $data['payment_method'] = $_POST['payment_method'];
        }
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['account_number']) && !empty($data['amount']) && !empty($data['transaction_type']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];

                $response['account_number'] = $decoded_response['account_number'];
                $response['amount'] = $decoded_response['amount'];
                $response['payment_method'] = $decoded_response['payment_method'];
                $response['payment_ref_number'] = $decoded_response['payment_ref_number'];
                $response['transactedby'] = $decoded_response['transactedby'];
                $response['transaction_type_name'] = $decoded_response['transaction_type_name'];
                $response['day'] = $decoded_response['day'];
                $response['month'] = $decoded_response['month'];
                $response['year'] = $decoded_response['year'];
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

    private function addAccountToAccountTransfer() {
        $data['request_type'] = $_POST['action'];
        $data['account_number'] = $_POST['account_number'];
        $data['recipient_account_number'] = $_POST['recipient_account_number'];
        $data['amount'] = $_POST['amount'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['account_number']) && !empty($data['amount']) && !empty($data['recipient_account_number']) && !empty($data['createdby'])) {
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

    public function addMpesaPaymentTransaction2($payment_details) {
        $sql = "INSERT INTO mpesa_response (response)"
                . " VALUES (:payment_details)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("payment_details", $payment_details);
        if ($stmt->execute()) {
            return true;
        } else
            return false;
    }

    public function addMpesaPaymentTransaction($payment_details) {
        $sql = "INSERT INTO payment_transactions (transaction_id, source, transaction_type, trans_id, trans_time, trans_amount, business_short_code, bill_ref_number, invoice_number, third_party_trans_id, msidn, firstname, middlename, lastname, account_balance)"
                . " VALUES (:transaction_id, :source, :transaction_type, :trans_id, :trans_time, :trans_amount, :business_short_code, :bill_ref_number, :invoice_number, :third_party_trans_id, :msidn, :firstname, :middlename, :lastname, :account_balance)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("transaction_id", $_SESSION["transaction_id"]);
        $stmt->bindValue("source", 'MPESA');
        $stmt->bindValue("transaction_type", $payment_details['TransactionType']);
        $stmt->bindValue("trans_id", $payment_details['TransID']);
        $stmt->bindValue("trans_time", $payment_details['TransTime']);
        $stmt->bindValue("trans_amount", $payment_details['TransAmount']);
        $stmt->bindValue("business_short_code", $payment_details['BusinessShortCode']);
        $stmt->bindValue("bill_ref_number", $payment_details['BillRefNumber']);
        $stmt->bindValue("invoice_number", $payment_details['InvoiceNumber']);
        $stmt->bindValue("third_party_trans_id", "TEST");  // $payment_details['TransactionType']
        $stmt->bindValue("msidn", $payment_details['MSISDN']);
        $stmt->bindValue("firstname", $payment_details['FirstName']);
        $stmt->bindValue("middlename", $payment_details['MiddleName']);
        $stmt->bindValue("lastname", $payment_details['LastName']);
        $stmt->bindValue("account_balance", $payment_details['OrgAccountBalance']);
        if ($stmt->execute()) {
            $this->updateTransactionPaymentStatus($transaction_id);
            return true;
        } else
            return false;
    }

    public function updateTransactionPaymentStatus($transaction_id) {
        $sql = "UPDATE booking_transaction_details SET payment_status=:payment_status WHERE transaction_id=:transaction_id";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("transaction_id", $transaction_id);
        $stmt->bindValue("payment_status", 1011);
        if ($stmt->execute()) {
            return true;
        } else
            return false;
    }

    public function fetchLedgerBalance($account_number) {
        $data['request_type'] = 'fetch_ledger_balance';
        $data['account_number'] = $account_number;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchTransactionDetails($code) {
        $data['request_type'] = 'fetch_transaction_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchTransactionChargeDetails($code) {
        $data['request_type'] = 'fetch_transaction_charge_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchLastDepositDetails($account_number, $transaction_type) {
        $data['request_type'] = 'fetch_last_deposit_details';
        $data['account_number'] = $account_number;
        $data['transaction_type'] = $transaction_type;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateTransaction($code, $update_type) {
        $data['request_type'] = 'update_transaction';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

}
