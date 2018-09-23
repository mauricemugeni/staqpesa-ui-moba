<?php
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
?>
<!--Mini Menu -->
<ul class="nav nav-pills">
    <?php if (isset($_SESSION['account_type_details']) AND $_SESSION['account_type_details']['name'] == "PERSONAL ACCOUNT") { ?>
        <li role="presentation" <?php if (is_menu_set('add_account')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?add_account" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Account Details
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('add_account_holder')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?add_account_holder" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Account Holder Details
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('add_personal_occupation_details')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?add_personal_occupation_details" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Occupation Details
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('add_contact')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?add_contact&ref_type=<?php echo $users->getUserRefTypeId('ACCOUNT HOLDER'); ?>" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Account Holder Contact Details
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('add_account_nominee')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?add_account_nominee" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Account Nominee Details
            </a>
        </li>
    <?php } else if (isset($_SESSION['account_type_details']) AND $_SESSION['account_type_details']['name'] == "GROUP/JOINT ACCOUNT") { ?>
        <li role="presentation" <?php if (is_menu_set('add_account')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?add_account" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Account Details
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('add_account_holder')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?add_account_holder" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Account Holder Details
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('add_personal_occupation_details')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?add_personal_occupation_details" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Occupation Details
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('add_contact')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?add_contact&ref_type=<?php echo $users->getUserRefTypeId('ACCOUNT HOLDER'); ?>" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Account Holder Contact Details
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('add_account_nominee')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?add_account_nominee" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Account Nominee Details
            </a>
        </li>
    <?php } else if (isset($_SESSION['account_type_details']) AND $_SESSION['account_type_details']['name'] == "BUSINESS ACCOUNT") { ?>
        <li role="presentation" <?php if (is_menu_set('add_account')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?add_account" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Account Details
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('add_account_holder')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?add_account_holder" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Account Holder Details
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('add_personal_occupation_details')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?add_personal_occupation_details" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Occupation Details
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('add_contact')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?add_contact&ref_type=<?php echo $users->getUserRefTypeId('ACCOUNT HOLDER'); ?>" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Account Holder Contact Details
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('add_account_nominee')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?add_account_nominee" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Account Nominee Details
            </a>
        </li>
    <?php } ?>
</ul>
<!--Mini Menu END -->