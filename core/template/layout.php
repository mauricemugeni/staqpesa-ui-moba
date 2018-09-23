<?php

if (is_menu_set('saf_validation') != "" OR is_menu_set('saf_confirmation') != "" OR is_menu_set('saf_registration') != "") {
    header("Content-Type:application/json");
    require_once $currentPage;
} else {
    
// Before anything is sent, set the appropriate header
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set("Africa/Nairobi");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="img/branding/favicon_1.ico" type="image/ico" sizes="16x16 32x32">
        <link rel="icon" href="img/branding/favicon_1.png" type="image/png" sizes="16x16 32x32">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="description" content="Developed By Reflex Concepts LTD">
        <meta name="keywords" content="">

        <!--iziToast-->
        <link rel="stylesheet" href="web/dist/css/iziToast.min7012.css?v=115">
        <!--<link rel="stylesheet" href="web/dist/css/demo7012.css?v=115">-->
        <!--iziToast END-->

        <!-- bootstrap 3.0.2 -->
        <link href="web/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="web/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="web/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="web/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="web/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="web/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <!-- <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" /> -->
        <!-- Daterange picker -->
        <link href="web/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="web/css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'> -->

        <?php if (App::isLoggedIn()) { ?>
            <!-- Theme style -->
            <link href="web/css/style.css" rel="stylesheet" type="text/css" />
            <!-- Menu style -->
            <!--<link href="web/css/menu-custom.css" rel="stylesheet" type="text/css" />-->
            <!-- Side bar menu style -->
            <link href="web/css/side-bar-custom.css" rel="stylesheet" type="text/css" />
        <?php } else { ?>
            <link href="web/css/login/style.css" rel="stylesheet" type="text/css" />
        <?php } ?>
        <style type="text/css">

        </style>

        <?php
        if (isset($_SESSION['feedback_message'])) {
            $_SESSION['add_record_success'] = "<div class='alert alert-success'>
                                               <button data-dismiss='alert' class='close close-sm' type='button'>
                                                    <i class='fa fa-times'></i>
                                               </button>"
                    . $_SESSION['feedback_message']
                    . "</div>";
        }

        if (isset($_SESSION['feedback_message'])) {
            $_SESSION['add_record_fail'] = "<div class='alert alert-block alert-danger'>
                                        <button data-dismiss='alert' class='close close-sm' type='button'>
                                            <i class='fa fa-times'></i>
                                        </button>"
                    . $_SESSION['feedback_message']
                    . "</div>";
        }
        ?>

        <?php
        /*         * *
         * This section specifies the page header
         */

        // The page title
        if ($templateResource = TemplateResource::getResource('title')) {
            ?>
            <title><?php echo $templateResource; ?></title>
        <?php } ?>
        <!-- Basic CSS -->
        <!-- End of basic CSS -->
        <?php
        // The CSS included
        if ($templateResource = TemplateResource::getResource('css')) {
            ?>
            <!-- Additional CSS -->
            <?php
            foreach ($templateResource as $style) {
                $style = "web/$style";
                ?>
                <link rel="stylesheet" href="<?php echo $style; ?>" />
                <?php
            }
            ?>
            <!-- Additional CSS end -->
            <?php
        }
        ?>

        <!-- Favicon and touch icons -->

    </head>
    <!--    <body>-->

    <body class="skin-black">

        <?php
        if (App::isLoggedIn()) {
            require_once "header.php";
        }
        ?>

        <?php
        require_once $currentPage;
        ?>

        <?php
        if (App::isLoggedIn()) {
            require_once "footer.php";
        }
        ?>

        <!-- Basic scripts -->
        <script src="web/js/jquery-1.10.1.js"></script>
        <script src="web/js/jq-sticky-anything.js"></script>
        <!-- jQuery 2.0.2 -->
        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
        <script src="web/js/jquery.min.js" type="text/javascript"></script>

        <!-- jQuery UI 1.10.3 -->
        <script src="web/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="web/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="web/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

        <script src="web/js/plugins/chart.js" type="text/javascript"></script>
        <!--NOtifications-->
        <script src="web/js/notify.js" type="text/javascript"></script>
        <script src="web/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- calendar -->
        <script src="web/js/plugins/fullcalendar/fullcalendar.js" type="text/javascript"></script>

        <!-- Director App -->
        <script src="web/js/Director/app.js" type="text/javascript"></script>

        <!-- Director dashboard demo (This is only for demo purposes) -->
        <script src="web/js/Director/dashboard.js" type="text/javascript"></script>
        <!-- Director for demo purposes -->
        <script type="text/javascript">
            $('input').on('ifChecked', function (event) {
                // var element = $(this).parent().find('input:checkbox:first');
                // element.parent().parent().parent().addClass('highlight');
                $(this).parents('li').addClass("task-done");
                console.log('ok');
            });
            $('input').on('ifUnchecked', function (event) {
                // var element = $(this).parent().find('input:checkbox:first');
                // element.parent().parent().parent().removeClass('highlight');
                $(this).parents('li').removeClass("task-done");
                console.log('not');
            });
        </script>
        <script>
            $('#noti-box, #noti-box-menu').slimScroll({
                height: '400px',
                size: '2px',
                BorderRadius: '5px'
            });

            $('input[type="checkbox"].flat-grey, input[type="radio"].flat-grey').iCheck({
                checkboxClass: 'icheckbox_flat-grey',
                radioClass: 'iradio_flat-grey'
            });
        </script>
        <script type="text/javascript">
            $(function () {
                "use strict";
                //BAR CHART
                var data = {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [
                        {
                            label: "Deposits",
                            fillColor: "rgba(220,220,220,0.2)",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: [65, 59, 80, 81, 56, 55, 40]
                        },
                        {
                            label: "Withdrawals",
                            fillColor: "rgba(151,187,205,0.2)",
                            strokeColor: "rgba(151,187,205,1)",
                            pointColor: "rgba(151,187,205,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(151,187,205,1)",
                            data: [28, 48, 40, 19, 86, 27, 70]
                        },
                        {
                            label: "Loans",
                            fillColor: "rgba(231,187,205,0.2)",
                            strokeColor: "rgba(231,187,205,1)",
                            pointColor: "rgba(231,187,205,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(151,187,205,1)",
                            data: [38, 6, 20, 39, 67, 37, 100]
                        }
                    ]
                };
                new Chart(document.getElementById("linechart").getContext("2d")).Line(data, {
                    responsive: true,
                    maintainAspectRatio: false,
                });

            });
            // Chart.defaults.global.responsive = true;
        </script>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script>
            $("#account_category").change(function () {
                var disabled = (this.value == "2" || this.value == "default");
                console.log(disabled);
                $("#account_name").prop("disabled", disabled);
            }).change(); //to trigger on load
        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                $("select").change(function () {
                    $(this).find("option:selected").each(function () {
                        var optionValue = $(this).attr("value");
                        if (optionValue) {
                            $(".box").not("." + optionValue).hide();
                            $("." + optionValue).fadeIn(700);
                        } else {
                            $(".box").fadeOut(700);
                        }
                    });
                }).change();
            });
			$(document).ready(function(){
    $(".double").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".boxing").not("." + optionValue).hide();
                $("." + optionValue).fadeIn(600);
            } else{
                $(".boxing").hide();
            }
        });
    }).change();
});
$(document).ready(function(){
    $(".one").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".boxed").not("." + optionValue).hide();
                $("." + optionValue).fadeIn(600);
            } else{
                $(".boxed").hide();
            }
        });
    }).change();
});
$(document).ready(function(){
    $(".tripple").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".boxout").not("." + optionValue).hide();
                $("." + optionValue).fadeIn(600);
            } else{
                $(".boxout").hide();
            }
        });
    }).change();
});
        </script>

        <!-- Include Required Prerequisites -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $(function () {
                $("#datepicker,#datepicker2").datepicker();
            });
        </script>

        <!--iziToast-->
        <script src="web/dist/js/vendor/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="web/dist/js/iziToast.min7012.js?v=115" type="text/javascript"></script>
        <script src="web/dist/js/demo29db.js?v=115.js" type="text/javascript"></script>
        <!--iziToast END-->

        <!-- End of basic scripts -->
        <?php
        /*         * *
         * Specify the scripts that are to be added.
         */
        if ($templateResource = TemplateResource::getResource('js')) {
            ?>
            <!-- Additional Scripts -->
            <?php
            foreach ($templateResource as $js) {
                $js = "web/$js";
                ?>
                <script src="<?php echo $js; ?>"></script>
                <?php
            }
            ?>
            <?php
        }
        ?>
        <?php if (!App::isLoggedIn()) { ?>
            <script>
            jQuery(document).ready(function () {
                App.initLogin();
            });
            </script>
        <?php } else { ?>
            <script>
                jQuery(document).ready(function () {
                    // initiate layout and plugins
                    App.init();
                    //App.setMainPage(true);

                });
            </script>
            <?php
        }
        ?>
    </body>
</html>
<?php } ?>