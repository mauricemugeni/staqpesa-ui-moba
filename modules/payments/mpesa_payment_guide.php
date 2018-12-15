<section class="panel">
    <header class="panel-heading">
        <i class="fa fa-money"></i> Mpesa Payment
    </header>
    <div class="panel-body" style="background-color: #39435c;">
        <div class="payment_box payment_method_mpesa">
            <ol style="color: #ffffff;">         
                <li>Go to Mpesa on your phone</li>
                <li>Select Lipa na Mpesa</li>
                <li>Select Pay Bill</li>
                <li>Enter Business Number: <?php echo $_SESSION['institution_paybill_number']; ?></li>
                <li>Enter Account Number: <?php echo $_SESSION['account']; ?></li>
                <li>Enter Amount: <?php // echo $_POST["amount"];         ?></li>
                <li>Enter your Mpesa PIN and send</li>
                <li>Once you receive a successful reply from Mpesa, fill out the 'Payment Reference Number' field on the left then proceed to submit the form.</li>
            </ol>
        </div>
        <br />
    </div>
</section>

<!--<section class="panel">
    <header class="panel-heading">
        <i class="fa fa-money"></i> Mpesa Payment
    </header>
    <div class="panel-body" style="background-color: #39435c;">
        <div class="payment_box payment_method_mpesa">
            <ol style="color: #ffffff;">         
                <li>Click on the SUBMIT button to generate a payment request on your phone</li>
                <li>Enter your Mpesa PIN on your phone to complete the payment</li>
                <li>You will receive your receipt SMS from MPESA (and iPay).</li>
                <li>Didn't get the prompt on your phone? Kindly dial *234*1*6# to force a SIM update. For SIM cards more than 2 years old, a SIM swap may be necessary.</li>
            </ol>
        </div>
        <br />
    </div>
</section>-->