<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Reports.php";
require_once WPATH . "modules/classes/Transactions.php";
$transactions = new Transactions();
$reports = new Reports();
?>

<div class="row" style="margin-bottom:0px;">

    <div class="col-md-3">
        <div class="sm-st clearfix">
            <span class="sm-st-icon st-blue"><i class="fa fa-stack-overflow"></i></span>
            <div class="sm-st-info">
                <span><?php echo $_SESSION['chapter_details']['currency'] . ". " . $transactions->fetchLedgerBalance($_SESSION['account']); ?></span>
                Account Balance
            </div>
        </div>
    </div>
<!--    <div class="col-md-2">
        <div class="sm-st clearfix">
            <span class="sm-st-icon st-green"><i class="fa fa-money"></i></span>
            <div class="sm-st-info">
                <span><?php // echo $reports->countAllTransactionRecordsByTransactionType("WITHDRAWAL"); ?></span>
                Withdrawals
            </div>
        </div>
    </div>-->
    <div class="col-md-3">
        <div class="sm-st clearfix">
            <span class="sm-st-icon st-green"><i class="fa fa-chain"></i></span>
            <div class="sm-st-info">
                <span><?php echo $reports->countAllTransactionRecordsByTransactionType("LOAN APPLICATION"); ?></span>
                Loans
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="sm-st clearfix">
            <span class="sm-st-icon st-violet"><i class="fa fa-users"></i></span>
            <div class="sm-st-info">
                <span><?php
                    echo $reports->sumAllTransactionAmountsByTransactionType("DEPOSIT") +
                    $reports->sumAllTransactionAmountsByTransactionType("SHARES DEPOSIT");
                    ?></span>
                Money In
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="sm-st clearfix">
            <span class="sm-st-icon st-red"><i class="fa fa-code-fork"></i></span>
            <div class="sm-st-info">
                <span><?php
                    echo $reports->sumAllTransactionAmountsByTransactionType("WITHDRAWAL") +
//                    $reports->sumAllTransactionAmountsByTransactionType("DEPOSIT CHARGE") +
//                            $reports->sumAllTransactionAmountsByTransactionType("WITHDRAWAL CHARGE") +
//                            $reports->sumAllTransactionAmountsByTransactionType("WITHDRAWAL REVERSAL") +
//                            $reports->sumAllTransactionAmountsByTransactionType("DEPOSIT REVERSAL") +
//                            $reports->sumAllTransactionAmountsByTransactionType("ACCOUNT TO ACCOUNT TRANSFER CHARGE") +
                            $reports->sumAllTransactionAmountsByTransactionType("ACCOUNT TO ACCOUNT TRANSFER");
                    ?></span>
                Money Out
            </div>
        </div>
    </div>

<!--    <div class="col-md-2">
        <div class="sm-st clearfix">
            <span class="sm-st-icon st-green"><i class="fa fa-fighter-jet"></i></span>
            <div class="sm-st-info">
                <span>3</span>
                Projects
            </div>
        </div>
    </div>-->
</div>