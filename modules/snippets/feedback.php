<?php

$_SESSION['add_record_success'] = "<div class='alert alert-success'>
                                               <button data-dismiss='alert' class='close close-sm' type='button'>
                                                    <i class='fa fa-times'></i>
                                               </button>"
        . $_SESSION['feedback_message']
        . "</div>";

$_SESSION['add_record_fail'] = "<div class='alert alert-block alert-danger'>
                                        <button data-dismiss='alert' class='close close-sm' type='button'>
                                            <i class='fa fa-times'></i>
                                        </button>"
        . $_SESSION['feedback_message']
        . "</div>";
?>