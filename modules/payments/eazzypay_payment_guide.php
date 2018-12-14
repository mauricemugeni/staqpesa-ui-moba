<section class="panel">
    <header class="panel-heading">
        <i class="fa fa-money"></i> EazzyPay Payment
    </header>
    <div class="panel-body" style="background-color: #39435c;">
        <div class="payment_box payment_method_mpesa">
            <ol style="color: #ffffff;">         
                <li>Log into your EazzyBanking App or Equitel Menu</li>
                <li>Click the + button and Select Paybill Option</li>
                <li>Enter the Business Number: <?php echo $_SESSION['institution_paybill_number']; ?></li>
                <li>Enter Account Number: <?php echo $_SESSION['account']; ?></li>
                <li>Enter Amount: <?php // echo $_POST["amount"];         ?></li>
                <li>Then click PAY/SEND</li>
                <li>Once you receive a successful transaction confirmation SMS from Equity Bank (and iPay), fill out the 'Payment Reference Number' field on the left then proceed to submit the form.</li>
            </ol>
        </div>
        <br />
    </div>
</section>