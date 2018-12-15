
<div class="wrapper row-offcanvas row-offcanvas-left">
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            <?php if (isset($_SESSION['fail_message'])) { ?>                            
                                <div class="alert alert-block alert-error fade in">
                                    <!--<button type="button" class="close" data-dismiss="alert">×</button>-->
                                    <strong>Error!</strong> <?php echo $_SESSION['fail_message']; ?>
                                </div>
                                <?php
                                unset($_SESSION['fail_message']);
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
