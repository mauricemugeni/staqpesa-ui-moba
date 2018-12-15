<section class="panel">
    <header class="panel-heading">
        <i class="fa fa-money"></i> PesaLink Payment
    </header>
    <div class="panel-body" style="background-color: #39435c;">
        <div class="payment_box payment_method_mpesa">
            <ol style="color: #ffffff;">         
                <li>Go to your mobile banking application</li>
                <li>Select Pesalink</li>
                <li>Pay to the mobile number: <?php echo '0710534013'; ?></li>
                <li>Enter <?php echo $_SESSION['account']; ?> as the payment reference/purpose/narrative/account</li>
                <li>Confirm the details above and commit your payment</li>
                <li>You will receive a confirmation SMS from Pesalink or your Bank.</li>
                <li>Once you receive a the confirmation SMS, fill out the 'Payment Reference Number' field on the left then proceed to submit the form.</li>
            </ol>
        </div>
        <br />
    </div>
</section>