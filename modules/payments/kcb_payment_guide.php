<section class="panel">
    <header class="panel-heading">
        <i class="fa fa-money"></i> KCB Payment
    </header>
    <div class="panel-body" style="background-color: #39435c;">
        <div class="payment_box payment_method_mpesa">
            <ol style="color: #ffffff;">
                <li>Log into your KCB mobile banking application</li>
                <li>Select MYKASH</li>
                <li>Select PAY</li>
                <li>Select Transfer Cash</li>
                <li>SEND TO: KCB ACCOUNT</li>
                <li>Enter RECIPIENT ACCOUNT: <?php echo $_SESSION['institution_paybill_number']; ?></li>
                <li>Enter RECIPIENT NAME: <?php echo $_SESSION['institution_paybill_number']; ?></li>
                <li>Enter Amount: <?php // echo $_POST["amount"];         ?></li>
                <li>SUBMIT</li>
                <li>Once you receive a successful reply from KCB, fill out the 'Payment Reference Number' field on the left then proceed to submit the form.</li>
            </ol>
        </div>
        <br />
    </div>
</section>