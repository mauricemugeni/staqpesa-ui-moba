<?php
if (!App::isLoggedIn())
    App::redirectTo("?");
require_once WPATH . "modules/classes/Reports.php";
$reports = new Reports();
?>

<div class="row" style="margin-bottom:0px;">    
    <div class="col-md-4">
        <div class="sm-st clearfix">
            <span class="sm-st-icon st-violet"><i class="fa fa-users"></i></span>
            <div class="sm-st-info">
                <span><?php echo $reports->countAllSubjectAreaRecords("count_all_accounts"); ?></span>
                <span>Accounts</span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="sm-st clearfix">
            <span class="sm-st-icon st-blue"><i class="fa fa-stack-overflow"></i></span>
            <div class="sm-st-info">
                <span><?php echo $reports->countAllTransactionRecordsByTransactionType("DEPOSIT"); ?></span>
                <span>Deposits</span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="sm-st clearfix">
            <span class="sm-st-icon st-green"><i class="fa fa-chain"></i></span>
            <div class="sm-st-info">
                <span><?php echo $reports->countAllTransactionRecordsByTransactionType("LOAN APPLICATION"); ?></span>
                <span>Loans</span>
            </div>
        </div>
    </div>
</div>