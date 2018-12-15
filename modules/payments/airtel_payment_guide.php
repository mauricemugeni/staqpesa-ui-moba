<section class="panel">
    <header class="panel-heading">
        <i class="fa fa-money"></i> Airtel Money Payment
    </header>
    <div class="panel-body" style="background-color: #39435c;">
        <div class="payment_box payment_method_mpesa">
            <ol style="color: #ffffff;">         
                <li>Go to the Airtel Money menu on your phone</li>
                <li>Select Make Payments</li>
                <li>Select Pay Bill</li>
                <li>Select Other</li>
                <li>Enter the Business Name: <?php echo $_SESSION['institution_paybill_number']; ?></li>
                <li>Enter Amount: <?php // echo $_POST["amount"];         ?></li>
                <li>Enter your PIN</li>
                <li>Enter <?php echo $_SESSION['account']; ?> as the Reference and then SEND</li>
                <li>Once you receive a successful transaction confirmation SMS from Airtel Money, fill out the 'Payment Reference Number' field on the left then proceed to submit the form.</li>
            </ol>
        </div>
        <br />
    </div>
</section>