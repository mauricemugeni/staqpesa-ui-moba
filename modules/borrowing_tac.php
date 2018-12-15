<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php require_once('modules/menus/main_sidebar.php'); ?>
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <header class="panel-heading">
                            MEMBERSHIP AND BORROWING TERMS AND CONDITIONS
                        </header>
                        <div class="panel-body">
                            <div class="section-title">
                                <h3>How <?php echo $_SESSION['chapter_details']['chapter_name'] . " "; ?> will use and share your information</h3>
                            </div>
                            <div class="text">
                                <p>This society will process your data in accordance with your rights under the Data Protection Act <br />
                                    Your information may be processed by this society in any form and on any database used by us for the following purposes:
                                </p>

                                <ul class="benifit-list">
                                    <li>To consider any applications made by you;</li>
                                    <li>To help us to make credit decisions about you and anyone to whom you are linked financially or other members of your household;</li>
                                    <li>To deal with your account(s) or run any other financial services we provide to you;</li>
                                    <li>To undertake statistical analysis, financial risk assessment, money laundering checks (which may include telephoning you), compliance and regulatory reporting, fraud prevention and debt tracing;</li>
                                    <li>To help us identify products and services which may be of interest to you (unless you have asked us not to)?</li>        
                                </ul>

                                <p>Please indicate on the application form if you do not want to be contacted for marketing purposes.
                                </p>

                                <p>You do agree that we can forward any newsletter, statement message, new terms and conditions or any information about changes to the way your 
                                    account(s) operate.
                                </p>
                            </div>

                            <div class="section-title">
                                <h3>Sharing Information</h3>
                            </div>
                            <div class="text">
                                <p>
                                    <?php echo $_SESSION['chapter_details']['chapter_name'] . " "; ?> will disclose information outside the society only:
                                </p>      

                                <ul class="benifit-list">
                                    <li>To our agent or sub-contractors for operational reasons;</li>
                                    <li>To any persons, including but not limited to, insurers, who provide a service of benefits to you or for us in connection with your account(s);</li>
                                    <li>To licensed credit reference agencies in accordance with the Data Protection Act and the terms of the society Act;</li>
                                    <li>To fraud prevention and other agencies to help prevent crime or where we suspect fraud;</li>
                                    <li>If compelled to do so by law;</li>
                                    <li>For the purpose of compliance and regulatory reporting, and to confirm your identity for money laundering purposes, which may include checking the electoral register.</li>
                                </ul>
                            </div>

                            <div class="section-title">
                                <h3>Subject Access Rights</h3>
                            </div>
                            <div class="text">
                                <p>
                                    If you write to us and pay the requisite fees you have a right of access to your information held by us. You have a right of access to information 
                                    held by society reference agencies on payment of a fee to them. If you ask, we will tell you the name and address of the society reference agencies we 
                                    may use.
                                </p>

                                <p>
                                    <?php echo $_SESSION['chapter_details']['chapter_name'] . " "; ?> is authorized and regulated by the 
                                    Cooperatives societies act cap 112 
                                </p>

                                <p>
                                    Society Registration No: <?php echo $_SESSION['chapter_details']['registration_number']; ?>.
                                </p>
                            </div>

                            <div class="section-title">
                                <h3>Loans – Points to Note</h3>
                            </div>
                            <div class="text">
                                <ul class="benifit-list">
                                    <li>All loans are subject to approval and availability of funds.</li>
                                    <li>For loans being repaid via payroll deduction, if you leave your employment you MUST inform us prior to your final pay, otherwise any such outstanding pay may be taken towards your outstanding loan.</li>
                                    <li>All loans can be cancelled within 14 days of taking the loan, provided that all transferred money is returned to the credit union.</li>
                                    <li>Your personal details will only be used in accordance with the Data Protection Act 1998.</li>
                                    <li>They will only be shared with licensed credit reference agencies and for debt recovery purposes, should this be necessary.</li>
                                </ul>
                            </div>

                            <div class="section-title">
                                <h3>Loan payment rates and fees</h3>
                            </div>
                            <div class="text">
                                <p>Interest Rate - What you pay each year in interest, shown as a percentage of the total amount you borrowed.</p>

                                <p>Origination Fee - one-time loan processing fee of 1-4% that’s only charged when you receive your loan. It’s deducted from your loan when the 
                                    loan is issued, so you’ll receive the amount you applied for minus the origination fee.</p>

                                <p>Annual Percentage Rate (APR) - The total yearly cost of your loan, including both the interest rate and the origination fee. The APR is the 
                                    best way to quickly compare your yearly costs for different loan options.</p>

                                <div class="section-title">
                                    <h4>Other fees</h4>
                                </div>
                                <ul class="benifit-list">
                                    <li>No application, brokerage or prepayment fees.</li>
                                    <li>Applying for a loan through <?php echo $_SESSION['chapter_details']['chapter_name'] . " "; ?> is absolutely free. We'll never ask you to pay any type 
                                        of up-front application fee or other advance payment to obtain a loan. And, you can pay your loan off any time with no prepayment fee.</li>
                                </ul>

                                <p>Late payment fee - If your payment is more than 20 days late, we may charge a late payment fee to compensate for the delay. The late payment 
                                    fee is 5.00% of your unpaid payment or <?php echo $_SESSION['currency'] . " "; ?> 50,000, whichever is greater. We charge this fee once for each late payment.</p>

                                <p>Check processing fee - Processing loan payments automatically helps us keep rates low, and there’s no fee for making payments automatically 
                                    by society from your bank account. Handling checks costs more, so we charge a <?php echo $_SESSION['currency'] . " "; ?>10, 000/= processing fee for each monthly payment made by check. However, 
                                    there is never a fee for paying your loan off early, even if you pay by check.</p>

                            </div>

                            <div class="section-title">
                                <h3>Credit Reference and Fraud Prevention Agencies</h3>
                            </div>
                            <div class="text">
                                <p>
                                    We may make searches about you at credit reference agencies who will supply us with credit information as well as information from the FINANCIAL 
                                    INSTITUTIONS. The agencies will record details of any search whether or not this application precedes. We may use credit scoring methods to assist 
                                    the application and to verify your identity. Credit searches and other information which is provided to us and/or the credit reference agencies about 
                                    you and anyone with whom you are linked financially or other members of your household may also be used for debt tracing and the prevention of money 
                                    laundering as well as the management of your account. In addition, we may ask you to provide physical forms of identification and/or we may telephone 
                                    you to confirm your identity.
                                </p>

                                <p>
                                    To prevent or detect fraud or to assist in verifying your identity, we may make searches of group records and at fraud prevention agencies who will 
                                    supply us with information. We may also pass information to financial and other organizations involved in fraud prevention to protect ourselves and 
                                    our customers from theft and fraud. If you give us false or inaccurate information, details will be passed to fraud prevention agencies. We may use 
                                    this information if financial or motor, household; credit, life or any other insurance decisions are made about you or others at your address (es). 
                                    This information may also be used for tracing and claims assessments and verifying identity.
                                </p>

                                <p>
                                    Information held about you by the credit referencing agencies may already be linked to records relating to anyone with whom you have had a financial 
                                    relationship such as a joint account.

                                </p>

                            </div>

                            <div class="section-title">
                                <h3>Privacy Policy</h3>
                            </div>
                            <div class="text">
                                <p>
                                    <?php echo $_SESSION['chapter_details']['chapter_name'] . " "; ?> is displaying this privacy statement in order to demonstrate our firm commitment to privacy. 
                                </p>

                                <p>
                                    1) We use your IP address to help diagnose problems with our server, and to administer our website. Your IP address is used to help identify you and 
                                    gather broad demographic information.
                                </p>

                                <p>
                                    2) In a few areas of the <?php echo $_SESSION['chapter_details']['chapter_name'] . " "; ?> website, we ask you to provide information that will enable us to keep you informed of our latest products 
                                    and services after your visit our website. The personal information that you supply to your society enables us to personalize 
                                    and improve your web browsing experience. It gives us a greater understanding of you, so that we can recommend services and promotions that we feel 
                                    would be of interest to you. It is completely optional for you to participate. We request information from you when you:
                                </p>
                                <ul class="benifit-list">
                                    <li>Subscribe to the newsletter service.</li>
                                    <li>Participate in a competition.</li>
                                    <li>Make an online enquiry.</li>
                                    <li>Submit feedback.</li>
                                    <li>Register as a member.</li>
                                    <li>Apply for a loan.</li>
                                </ul>

                                <p>
                                    3) Our site’s enquiry forms ask for your name, email address, and where appropriate other personal information that would be needed to register for 
                                    or subscribe to our services. In the case of newsletters or mailing lists you will be able to remove your name from these lists at any time.
                                </p>

                                <p>
                                    4) The information you provide will only be used to support and improve your customer relationship with Your society , and we guarantee that we will 
                                    never pass on any of your personal information to a third party without your express permission.
                                </p>

                                <p>
                                    5) When you visit <a href="<?php echo $_SESSION['website_url']; ?>" target="_blank"><?php echo $_SESSION['website_url']; ?></a> 
                                    you can surf the site anonymously and access important information without revealing your identity. In order to improve our site, we use “cookies” 
                                    to track your visit. A cookie is a small text file, which is stored within your web browser and identifies your 
                                    computer to our server. They also enable us to record how often you visit the site and the areas you navigate within it. It functions as your 
                                    identification card, recording your passwords and preferences. It cannot be executed as code or deliver viruses.
                                </p>

                                <p>
                                    6) Even as our Web servers automatically log the IP/Internet address of your computer, this information does not identify you personally and 
                                    you remain anonymous unless you have otherwise provided your society with personal information.
                                </p>

                                <p>
                                    7) If you have any questions about our terms of use, privacy statement, the practices of this site, or your dealings with this web site, you can 
                                    contact us <a href="?help"> here </a>
                                </p>
                            </div>

                        </div><!-- /.panel-body -->
                    </div><!-- /.panel -->
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>
