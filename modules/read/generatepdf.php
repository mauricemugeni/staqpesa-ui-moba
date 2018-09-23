<?php

require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";
require_once WPATH . "modules/classes/Loans.php";
require_once WPATH . "modules/classes/Transactions.php";
require_once WPATH . "modules/classes/Funding.php";

// Include the main TCPDF library (search for installation path).
require_once('modules/tcpdf/tcpdf.php');
require_once('modules/tcpdf/config/tcpdf_config.php');

// create new PDF document
class MYPDF extends TCPDF {

    // Load table data from DB
    public function LoadData() {
//        argDump($_SESSION['pdf_content']);
//        exit();

        return $_SESSION['pdf_content'];
    }

    // Colored table
    public function ColoredTable($header, $data) {
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = $_SESSION['column_widths'];
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;

        foreach ($data as $row) {
            if ($row['status'] == 1000) {
                $status = "DELETED";
            } else if ($row['status'] == 1001 OR $row['status'] == 1032) {
                $status = "AWAITING APPROVAL";
            } else if ($row['status'] == 1010) {
                $status = "APPROVAL REJECTED";
            } else if ($row['status'] == 1011) {
                $status = "APPROVAL ACCEPTED";
            } else if ($row['status'] == 1020) {
                $status = "NOT ACTIVE";
            } else if ($row['status'] == 1021) {
                $status = "ACTIVE";
            }

            if ($_SESSION['title'] == 'Inbox Messages') {
                $this->Cell($w[0], 6, $row['id'], 'LR', 0, 'C', $fill);
                $this->Cell($w[1], 6, date("Y-m-d H:i:s", $row['createdat']), 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['name'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $row['phone_number'], 'LR', 0, 'L', $fill);
                $this->Cell($w[4], 6, $status, 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'Job Advertisements') {
                $this->Cell($w[0], 6, $row['id'], 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, date("Y-m-d H:i:s", $row['createdat']), 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['title'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $row['station'], 'LR', 0, 'L', $fill);
                $this->Cell($w[4], 6, $row['employment_terms'], 'LR', 0, 'L', $fill);
                $this->Cell($w[5], 6, $row['compensation_amount'], 'LR', 0, 'L', $fill);
                $this->Cell($w[6], 6, $status, 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'Job Applications') {
                $this->Cell($w[0], 6, date("Y-m-d H:i:s", $row['createdat']), 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['position'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['firstname'] . ' ' . $row['laststname'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $row['phone_number'], 'LR', 0, 'L', $fill);
                $this->Cell($w[4], 6, $row['availability'], 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'Accounts') {
                $this->Cell($w[0], 6, date("Y-m-d H:i:s", $row['createdat']), 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['account_number'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['account_name'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $status, 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'Loan Guarantors') {
                $users = new Users();
                $proposed_guarantor_details = $users->fetchAccountHolderDetails($row["id"]);
                $proposed_guarantor_contact_details = $users->fetchAccountHolderContactDetails($row["id"]);

                $this->Cell($w[0], 6, $proposed_guarantor_details['idnumber'], 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['loan_number'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['amount'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $proposed_guarantor_contact_details['phone_number1'], 'LR', 0, 'L', $fill);
                $this->Cell($w[4], 6, $status, 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'Loan Business Data') {
                $settings = new Settings();
                $business_type = $settings->fetchBusinessTypeDetails($row['business_type']);
                $business_form = $settings->fetchBusinessFormDetails($row['business_form']);

                $this->Cell($w[0], 6, $row['id'], 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $business_type['name'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $business_form['name'] . ' ' . $row['laststname'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $row['daily_sales'], 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'Loans') {
                $transactions = new Transactions();
                $loans = new Loans();
                $users = new Users();
                $loan_status = $loans->fetchLoanStatusDetails($row['id']);
                if ($loan_status['status'] == 1001) {
                    $system_log_details = $users->fetchSystemLogDetails("CREATE", "TRANSACTIONS", $row['id']);
                    $old_value = json_decode($system_log_details['old_value']);
                    $createdat = $old_value->createdat;
                } else {
                    $loan_transaction_details = $transactions->fetchTransactionDetails($row['id']);
                    $createdat = $loan_transaction_details['createdat'];
                }

                if ($loan_status['status'] == 1001 OR $loan_status['status'] == 1032) {
                    $repayment_statement = "PENDING APPROVAL";
                } else if ($loan_status['status'] == 1040) {
                    $repayment_statement = "PENDING MATURITY";
                } else if ($loan_status['status'] == 1021) {
                    $repayment_statement = "LOAN IS ACTIVE";
                } else if ($loan_status['status'] == 1020) {
                    $repayment_statement = "LOAN IS DOMANT/DEFAULTED";
                } else if ($loan_status['status'] == 1041) {
                    $repayment_statement = "LOAN IS SETTLED";
                }

                $this->Cell($w[0], 6, date("Y-m-d H:i:s", $createdat), 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['id'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['principal_amount'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $row['duration'], 'LR', 0, 'L', $fill);
                $this->Cell($w[4], 6, $repayment_statement, 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'Account Holders') {
                $this->Cell($w[0], 6, date("Y-m-d H:i:s", $row['createdat']), 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['account_number'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $row['idnumber'], 'LR', 0, 'L', $fill);
                $this->Cell($w[4], 6, $row['gender'], 'LR', 0, 'L', $fill);
                $this->Cell($w[5], 6, $status, 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'Investors') {
                $funding = new Funding();
                $investor_type_details = $funding->fetchInvestorTypeDetails($row['investor_type']);

                $this->Cell($w[0], 6, date("Y-m-d H:i:s", $row['createdat']), 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['id'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $investor_type_details['name'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname'], 'LR', 0, 'L', $fill);
                $this->Cell($w[4], 6, $row['gender'], 'LR', 0, 'L', $fill);
                $this->Cell($w[5], 6, $status, 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'Institutions') {
                $this->Cell($w[0], 6, date("Y-m-d H:i:s", $row['createdat']), 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['id'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['company_name'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $row['business_type'], 'LR', 0, 'L', $fill);
                $this->Cell($w[4], 6, $status, 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'Projects') {
                $this->Cell($w[0], 6, date("Y-m-d H:i:s", $row['createdat']), 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['id'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['title'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $row['owner'], 'LR', 0, 'L', $fill);
                $this->Cell($w[4], 6, $status, 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'Project Bids') {
                $funding = new Funding();
                $investor_details_biddedby = $funding->fetchInvestorDetails($row['bidded_by']);

                $this->Cell($w[0], 6, date("Y-m-d H:i:s", $row['createdat']), 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['id'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $investor_details_biddedby['firstname'] . " " . $investor_details_biddedby['lastname'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $row['bid_amount'], 'LR', 0, 'L', $fill);
                $this->Cell($w[4], 6, $status, 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'Staff') {
                $settings = new Settings();
                $institution = $settings->fetchInstitutionDetails($row['institution']);

                $this->Cell($w[0], 6, date("Y-m-d H:i:s", $row['createdat']), 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['id'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $institution['company_name'], 'LR', 0, 'L', $fill);
                $this->Cell($w[4], 6, $status, 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'System Status Codes') {
                $this->Cell($w[0], 6, date("Y-m-d H:i:s", $row['createdat']), 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['status_code'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['description'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $status, 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'System Components') {
                $this->Cell($w[0], 6, date("Y-m-d H:i:s", $row['createdat']), 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['id'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['name'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $row['acronym'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $status, 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'System Privileges') {
                $this->Cell($w[0], 6, date("Y-m-d H:i:s", $row['createdat']), 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['id'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['name'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $row['component'], 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'Next of Kins') {
                $users = new Users();
                $ref_type_details = $users->fetchUserTypeDetails($row['ref_type']);

                $this->Cell($w[0], 6, $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname'], 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['phone_number'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['relationship'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $ref_type_details['name'] . ' (' . $row['ref_id'] . ')', 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'System Administrators') {
                $settings = new Settings();
                $institution_details = $settings->fetchInstitutionDetails($row['institution']);

                $this->Cell($w[0], 6, date("Y-m-d H:i:s", $row['createdat']), 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['id'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $institution_details['company_name'], 'LR', 0, 'L', $fill);
                $this->Cell($w[4], 6, $status, 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'Transactions') {
                $settings = new Settings();
                $details = $settings->fetchTransactionTypeDetails($row['transaction_type']);

                $this->Cell($w[0], 6, date("Y-m-d H:i:s", $row['createdat']), 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['id'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $details['name'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $row['amount'], 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'Guest Users') {
                $this->Cell($w[0], 6, date("Y-m-d H:i:s", $row['createdat']), 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['firstname'] . " " . $row['lastname'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['email'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $row['phone_number'], 'LR', 0, 'L', $fill);
                $this->Cell($w[4], 6, $status, 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'Deposits') {
                $this->Cell($w[0], 6, date("Y-m-d H:i:s", $row['createdat']), 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['id'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['account_number'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $row['amount'], 'LR', 0, 'L', $fill);
                $this->Cell($w[4], 6, $row['transactedby'], 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'Shares') {
                $this->Cell($w[0], 6, date("Y-m-d H:i:s", $row['createdat']), 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['id'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['account_number'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $row['amount'], 'LR', 0, 'L', $fill);
                $this->Cell($w[4], 6, $row['transactedby'], 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'Withdrawals') {
                $this->Cell($w[0], 6, date("Y-m-d H:i:s", $row['createdat']), 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['id'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['account_number'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $row['amount'], 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'Account to Account Transfers') {
                $this->Cell($w[0], 6, date("Y-m-d H:i:s", $row['createdat']), 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['id'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['transactedby'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $row['account_number'], 'LR', 0, 'L', $fill);
                $this->Cell($w[4], 6, $row['amount'], 'LR', 0, 'L', $fill);
            } else if ($_SESSION['title'] == 'Loan Repayments') {
                $settings = new Settings();
                $transaction_type = $settings->fetchTransactionTypeDetails($row['transaction_type']);
                
                $this->Cell($w[0], 6, date("Y-m-d H:i:s", $row['paid_on']), 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['id'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $transaction_type['name'], 'LR', 0, 'L', $fill);
                $this->Cell($w[3], 6, $row['amount'], 'LR', 0, 'L', $fill);
            }

            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }

}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($_SESSION['author']);
$pdf->SetTitle($_SESSION['title']);
$pdf->SetSubject($_SESSION['pdf_header_title']);
$pdf->SetKeywords($_SESSION['key_words']);

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage('L');

// column titles
$header = $_SESSION['column_titles'];

// data loading
$data = $pdf->LoadData();

// print colored table
$pdf->ColoredTable($header, $data);

// ---------------------------------------------------------
// close and output PDF document
ob_clean();
$pdf->Output($_SESSION['document_name'], 'D');

unset($_SESSION['author']);
unset($_SESSION['document_name']);
unset($_SESSION['title']);
unset($_SESSION['key_words']);
unset($_SESSION['pdf_header_title']);
unset($_SESSION['pdf_content']);
unset($_SESSION['column_widths']);
unset($_SESSION['column_titles']);
