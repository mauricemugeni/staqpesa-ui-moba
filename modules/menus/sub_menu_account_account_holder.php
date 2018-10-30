<?php
require_once WPATH . "modules/classes/Users.php";
$users = new Users();
?>
<!--Mini Menu -->
<ul class="nav nav-pills">
    <?php if (isset($_SESSION['account'])) { ?>
        <li role="presentation" <?php if (is_menu_set('view_accounts_individual')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_accounts_individual" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Account Details
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_account_holders_individual')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_account_holders_individual" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Account Holder Details
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_account_holder_occupations_individual')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_account_holder_occupations_individual" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Occupation Details
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_contacts_individual')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?add_contact&ref_type=<?php echo $users->getUserRefTypeId('ACCOUNT HOLDER'); ?>" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Account Holder Contact Details
            </a>
        </li>
        <li role="presentation" <?php if (is_menu_set('view_account_nominees_individual')) { ?> class="active" <?php } ?>>
            <a class="dropdown-toggle" href="?view_account_nominees_individual" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-archive"></i>Account Nominee Details
            </a>
        </li>
    <?php } ?>
</ul>
<!--Mini Menu END -->