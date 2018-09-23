<?php

require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Transactions.php";

class Funding extends Database {

    public function execute() {
        if ($_POST['action'] == "add_financing_method") {
            return $this->addFinancingMethod();
        } else if ($_POST['action'] == "add_funding_type") {
            return $this->addFundingType();
        } else if ($_POST['action'] == "add_investor") {
            return $this->addInvestor();
        } else if ($_POST['action'] == "add_investor_type") {
            return $this->addInvestorType();
        } else if ($_POST['action'] == "add_project") {
            return $this->addProject();
        } else if ($_POST['action'] == "add_project_bid") {
            return $this->addProjectBid();
        } else if ($_POST['action'] == "edit_financing_method") {
            return $this->editFinancingMethod();
        } else if ($_POST['action'] == "edit_funding_type") {
            return $this->editFundingType();
        } else if ($_POST['action'] == "edit_investor") {
            return $this->editInvestor();
        } else if ($_POST['action'] == "edit_investor_type") {
            return $this->editInvestorType();
        } else if ($_POST['action'] == "edit_project") {
            return $this->editProject();
        } else if ($_POST['action'] == "edit_project_bid") {
            return $this->editProjectBid();
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

    private function getProjectBidId($project_id, $bidded_by, $bid_amount) {
        $transactions = new Transactions();
        return $transactions->getTransactionId($project_id, $bidded_by, $bid_amount);
    }

    public function searchSystem($request_type, $search_input) {
        $data['request_type'] = $request_type;
        $data['search_input'] = $search_input;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    /** Adding functions ************************************************************** */
    private function addFinancingMethod() {
        $data['request_type'] = $_POST['action'];
        $data['name'] = $_POST['name'];
        $data['createdby'] = $_POST['createdby'];
        $data['description'] = $_POST['description'];
        $data_string = http_build_query($data);
        if (!empty($data['request_type']) && !empty($data['name']) && !empty($data['createdby']) && !empty($data['description'])) {
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

    private function addFundingType() {
        $data['request_type'] = $_POST['action'];
        $data['name'] = $_POST['name'];
        $data['createdby'] = $_POST['createdby'];
        $data['description'] = $_POST['description'];
        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['name']) && !empty($data['createdby']) && !empty($data['description'])) {
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

    public function getNextInvestorId() {
        $data['request_type'] = 'get_next_investor_id';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    private function addInvestor() {
        $data['request_type'] = $_POST['action'];
        $data['ref_type'] = $_SESSION['ref_type'];
        $data['id'] = $_SESSION['investor_id'];
        $data['firstname'] = $_SESSION['firstname'];
        $data['middlename'] = $_SESSION['middlename'];
        $data['lastname'] = $_SESSION['lastname'];
        $data['gender'] = $_SESSION['gender'];
        $data['idnumber'] = $_SESSION['idnumber'];
        $data['birthdate'] = $_SESSION['birthdate'];
        $data['nationality'] = $_SESSION['nationality'];
        $data['description'] = $_SESSION['description'];
        $data['investor_type'] = $_SESSION['investor_type'];
        $data['createdby'] = $_SESSION['createdby'];

        //Contacts
        $data['phone_number1'] = $_POST['phone_number1'];
        $data['email'] = $_POST['email'];
        $data['phone_number2'] = $_POST['phone_number2'];
        $data['postal_number'] = $_POST['postal_number'];
        $data['postal_code'] = $_POST['postal_code'];
        $data['town'] = $_POST['town'];
        $data['residential_area'] = $_POST['residential_area'];
        $data['estate'] = $_POST['estate'];
        $data['street'] = $_POST['street'];
        $data['division'] = $_POST['division'];
        $data['location'] = $_POST['location'];
        $data['sub_location'] = $_POST['sub_location'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['ref_type']) && !empty($data['id']) &&
                !empty($data['firstname']) && !empty($data['middlename']) && !empty($data['lastname']) &&
                !empty($data['gender']) && !empty($data['idnumber']) && !empty($data['birthdate']) &&
                !empty($data['nationality']) && !empty($data['investor_type']) && !empty($data['description']) &&
                !empty($data['createdby']) && !empty($data['email']) && !empty($data['phone_number1'])) {
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

    private function addInvestorType() {
        $data['request_type'] = $_POST['action'];
        $data['name'] = $_POST['name'];
        $data['createdby'] = $_POST['createdby'];
        $data['description'] = $_POST['description'];
        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['name']) && !empty($data['createdby']) && !empty($data['description'])) {
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

    private function addProject() {
        $data['request_type'] = $_POST['action'];
        $data['owner'] = $_POST['owner'];
        $data['title'] = $_POST['title'];
        $data['description'] = $_POST['description'];
        $data['sector'] = $_POST['sector'];
        $data['business_plan'] = $_SESSION['business_plan'];
        $data['project_logo'] = $_SESSION['project_logo'];
        $data['funding_type'] = $_POST['funding_type'];
        $data['financing_method'] = $_POST['financing_method'];
        $data['investment_amount'] = $_POST['investment_amount'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);
        if (!empty($data['request_type']) && !empty($data['owner']) && !empty($data['createdby']) && !empty($data['description']) && !empty($data['title']) && !empty($data['business_plan']) && !empty($data['funding_type']) && !empty($data['financing_method']) && !empty($data['investment_amount'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];

                /** Send Email * */
                require_once WPATH . "modules/mailing/send_mail_config.php";

                $mail->Subject = 'StaqpesaInfo: Test Mail with PHPMailer';
                $mail->Body = 'This is the HTML message body <b>in bold! <br/>WARNING: Respond if received.</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if (!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'Message has been sent';
                }
                /** Send Email END * */
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

    private function addProjectBid() {
        $data['request_type'] = $_POST['action'];
        $data['id'] = $this->getProjectBidId($_POST['project_id'], $_POST['bidded_by'], $_POST['bid_amount']);
        $data['project_id'] = $_POST['project_id'];
        $data['bidded_by'] = $_POST['bidded_by'];
        $data['bid_amount'] = $_POST['bid_amount'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['id']) && !empty($data['project_id']) && !empty($data['bidded_by']) && !empty($data['bid_amount'])) {
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

    /** Fetching all functions ************************************************************** */
    public function getAllFinancingMethods() {
        $data['request_type'] = 'get_all_financing_methods';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllFundingTypes() {
        $data['request_type'] = 'get_all_funding_types';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllInvestors() {
        $data['request_type'] = 'get_all_investors';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllTopInvestors() {
        $data['request_type'] = 'get_all_top_investors';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllInvestorTypes() {
//        $data['request_type'] = 'get_all_investor_types';
//        $data_string = http_build_query($data);
//        $process_request = $this->sendHttpRequestPost($data_string);
//        $decoded_response = json_decode($process_request, true);
//        $info = $decoded_response['message'];


        $sql = "SELECT * FROM investor_types ORDER BY id ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info;
    }

    public function getAllAccountProjects() {
        $data['request_type'] = 'get_all_account_projects';
        $data['account'] = $_SESSION['account'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllInvestorProjects() {
        $data['request_type'] = 'get_all_investor_projects';
        $data['investor'] = $_SESSION['investor'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllProjects() {
//        $data['request_type'] = 'get_all_projects';
//        $data_string = http_build_query($data);
//        $process_request = $this->sendHttpRequestPost($data_string);
//        $decoded_response = json_decode($process_request, true);
//        $info = $decoded_response['message'];
//        return $info;

        $sql = "SELECT * FROM projects ORDER BY id ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info;
    }

    public function getAllUnbiddedProjects() {
        $data['request_type'] = 'get_all_unbidded_projects';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllMemberProjects() {
        $data['request_type'] = 'get_all_member_projects';
        $data['code'] = $_SESSION['account'];
        //    $data['code'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllProjectBids() {
        $data['request_type'] = 'get_all_project_bids';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllIndividualProjectBids($code) {
        $data['request_type'] = 'get_all_individual_project_bids';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllInvestorProjectBids() {
        $data['request_type'] = 'get_all_investor_project_bids';
        $data['code'] = $_SESSION['investor'];
//        $data['code'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllAccountProjectBids() {
        $data['request_type'] = 'get_all_account_project_bids';
        $data['account'] = $_SESSION['account'];
//        $data['code'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    /** Fetching details functions ************************************************************** */
    public function fetchFinancingMethodDetails($code) {
        $data['request_type'] = 'fetch_financing_method_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchProjectBidBalanceDetails($code) {
        $data['request_type'] = 'fetch_project_bid_balance_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchFundingTypeDetails($code) {
        $data['request_type'] = 'fetch_funding_type_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchInvestorDetails($code) {
        $data['request_type'] = 'fetch_investor_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchInvestorTypeDetails($code) {
        $data['request_type'] = 'fetch_investor_type_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchProjectDetails($code) {
        $data['request_type'] = 'fetch_project_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchProjectBidDetails($code) {
        $data['request_type'] = 'fetch_project_bid_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    /** Editing functions ************************************************************** */
    private function editFinancingMethod() {
        $data['id'] = $_SESSION['financing_method'];
        $data['request_type'] = $_POST['action'];
        $data['name'] = $_POST['name'];
        $data['createdby'] = $_POST['createdby'];
        $data['description'] = $_POST['description'];
        $data_string = http_build_query($data);
        if (!empty($data['request_type']) && !empty($data['name']) && !empty($data['createdby']) && !empty($data['description'])) {
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

    private function editFundingType() {
        $data['request_type'] = $_POST['action'];
        $data['id'] = $_SESSION['funding_type'];
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

    private function editInvestor() {
        $data['request_type'] = $_POST['action'];
        $data['id'] = $_SESSION['investor'];
        $data['firstname'] = $_POST['firstname'];
        $data['middlename'] = $_POST['middlename'];
        $data['lastname'] = $_POST['lastname'];
        $data['gender'] = $_POST['gender'];
        $data['idnumber'] = $_POST['idnumber'];
        $_SESSION['birthdate'] = "2017-01-01";
//        $data['birthdate'] = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
        $data['nationality'] = $_POST['nationality'];
        $data['description'] = $_POST['description'];
        $data['investor_type'] = $_POST['investor_type'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['firstname']) && !empty($data['middlename']) &&
                !empty($data['lastname']) && !empty($data['gender']) && !empty($data['idnumber']) &&
                !empty($data['birthdate']) && !empty($data['nationality']) && !empty($data['description']) && !empty($data['investor_type']) &&
                !empty($data['createdby'])) {
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

    private function editInvestorType() {
        $data['request_type'] = $_POST['action'];
        $data['id'] = $_SESSION['investor_type'];
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

    private function editProject() {
        $data['request_type'] = $_POST['action'];
        $data['id'] = $_SESSION['project'];
        $data['owner'] = $_POST['owner'];
        $data['title'] = $_POST['title'];
        $data['description'] = $_POST['description'];
        $data['funding_type'] = $_POST['funding_type'];
        $data['financing_method'] = $_POST['financing_method'];
        $data['investment_amount'] = $_POST['investment_amount'];
        $data['createdby'] = $_POST['createdby'];

        $data_string = http_build_query($data);
        if (!empty($data['request_type']) && !empty($data['id']) && !empty($data['owner']) && !empty($data['description']) && !empty($data['title']) && !empty($data['funding_type']) && !empty($data['financing_method']) && !empty($data['investment_amount']) && !empty($data['createdby'])) {
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

    private function editProjectBid() {
        $data['request_type'] = $_POST['action'];
        $data['project_id'] = $_POST['project_id'];
        $data['bidded_by'] = $_POST['bidded_by'];
        $data['project_name'] = $_POST['project_name'];
        $data['bid_amount'] = $_POST['bid_amount'];
        $data['bid_balance'] = $_POST['bid_balance'];

        $data_string = http_build_query($data);

        if (!empty($data['request_type']) && !empty($data['project_id']) && !empty($data['bidded_by']) && !empty($data['project_name']) && !empty($data['bid_amount']) && !empty($data['bid_balance'])) {
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

    /** Updating functions ************************************************************** */
    public function updateFinancingMethod($code, $update_type) {
        $data['request_type'] = 'update_financing_method';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateFundingType($code, $update_type) {
        $data['request_type'] = 'update_funding_type';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateInvestor($code, $update_type) {
        $data['request_type'] = 'update_investor';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateInvestorType($code, $update_type) {
        $data['request_type'] = 'update_investor_type';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateProject($code, $update_type) {
        $data['request_type'] = 'update_project';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateProjectBid($code, $update_type) {
        $data['request_type'] = 'update_project_bid';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    /** Drop down functions ************************************************************** */
    public function getInvestorTypes() {
        $data['request_type'] = 'get_investor_types';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                if (!empty($_POST['investor_type']) && $_POST['investor_type'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            } else {
                if (!empty($_POST['investor_type']) && $_POST['investor_type'] == $row['id']) {
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
            $html = "<option value=\"\">No investor type entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getFundingTypes() {
        $data['request_type'] = 'get_funding_types';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                if (!empty($_POST['funding_type']) && $_POST['funding_type'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            } else {
                if (!empty($_POST['funding_type']) && $_POST['funding_type'] == $row['id']) {
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
            $html = "<option value=\"\">No funding type entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getFinancingMethods() {
        $data['request_type'] = 'get_financing_methods';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                if (!empty($_POST['financing_method']) && $_POST['financing_method'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            } else {
                if (!empty($_POST['financing_method']) && $_POST['financing_method'] == $row['id']) {
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
            $html = "<option value=\"\">No financing method entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    /** Notifications functions ************************************************************** */
    public function getAllFundingTypeNotifications() {
        $data['request_type'] = 'get_all_funding_type_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllFinancingMethodNotifications() {
        $data['request_type'] = 'get_all_financing_method_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllProjectBidNotifications() {
        $data['request_type'] = 'get_all_project_bid_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllProjectNotifications() {
        $data['request_type'] = 'get_all_project_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllInvestorNotifications() {
        $data['request_type'] = 'get_all_investor_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

}
