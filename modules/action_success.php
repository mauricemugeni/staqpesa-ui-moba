
<div class="wrapper row-offcanvas row-offcanvas-left">
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            <?php if (isset($_SESSION['success_message'])) { ?>
                                <div class="alert alert-info fade in">
                                    <!--<button type="button" class="close" data-dismiss="alert">×</button>-->
                                    <strong>Successful:</strong> <?php echo $_SESSION['success_message']; ?> 
                                </div>
                                <?php
                                unset($_SESSION['success_message']);
                            }
                        ?>
                        </header>
                        <div class="panel-body">
                            <?php if (App::isLoggedIn()) { ?>                            
                            <a href='?dashboard'> <button type='button' class="btn btn-info">Home</button> </a>
                            <?php } else { ?>
                            <a href='?home'> <button type='button' class="btn btn-info">Login</button> </a>
                            <?php } ?>
                        </div>
                    </section>
                </div>        
            </div><!--row1-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>
