<?php

require WPATH . "core/include.php";
$currentPage = "";

if ( is_menu_set('logout') != "" ) 
    App::logOut();
else if ( is_menu_set('home') != ""){
    $currentPage = WPATH . "modules/login.php";
    set_title("ICT Innovators Hub Cooperative | Login");
}

else if ( is_menu_set('generatepdf') != ""){
    $currentPage = WPATH . "modules/read/generatepdf.php";
    set_title("Sample PDF");
}

// Component 1
else if ( is_menu_set('dashboard') != ""){
    $currentPage = WPATH . "modules/admin/home.php";
    set_title("ICT Innovators Hub Cooperative | Dashboard");
}

// Component 2
else if (is_menu_set('forgot_password') != "") {
    $currentPage = WPATH . "modules/forgot_password.php";
    set_title("ICT Innovators Hub Cooperative | Forgot Password");
}

// Component 3
else if (is_menu_set('reset_password') != "") {
    $currentPage = WPATH . "modules/reset_password.php";
    set_title("ICT Innovators Hub Cooperative | Reset Password");
}

// Component 4
else if ( is_menu_set('settings') != ""){
    $currentPage = WPATH . "modules/admin/settings.php";
    set_title("ICT Innovators Hub Cooperative | Settings");
}

// Component 5
else if ( is_menu_set('banking') != ""){
    $currentPage = WPATH . "modules/banking.php";
    set_title("ICT Innovators Hub Cooperative | Banking");
}

// Component 6
else if ( is_menu_set('account_unregistered') != ""){
    $currentPage = WPATH . "modules/account_unregistered.php";
    set_title("ICT Innovators Hub Cooperative | Guest User");
}

// Component 7
else if ( is_menu_set('guest_loans') != ""){
    $currentPage = WPATH . "modules/account_unregistered.php";
    set_title("ICT Innovators Hub Cooperative | Guest User");
}

// Component 8
else if ( is_menu_set('guest_deposits') != ""){
    $currentPage = WPATH . "modules/account_unregistered.php";
    set_title("ICT Innovators Hub Cooperative | Guest User");
}

// Component 9
else if ( is_menu_set('guest_shares') != ""){
    $currentPage = WPATH . "modules/account_unregistered.php";
    set_title("ICT Innovators Hub Cooperative | Guest User");
}

// Component 10
else if ( is_menu_set('guest_withdrawals') != ""){
    $currentPage = WPATH . "modules/account_unregistered.php";
    set_title("ICT Innovators Hub Cooperative | Guest User");
}

// Component 11
else if ( is_menu_set('guest_account_to_account_transfers') != ""){
    $currentPage = WPATH . "modules/account_unregistered.php";
    set_title("ICT Innovators Hub Cooperative | Guest User");
}

// Component 12
else if ( is_menu_set('guest_transactions') != ""){
    $currentPage = WPATH . "modules/account_unregistered.php";
    set_title("ICT Innovators Hub Cooperative | Guest User");
}

// Component 13
else if ( is_menu_set('guest_projects') != ""){
    $currentPage = WPATH . "modules/account_unregistered.php";
    set_title("ICT Innovators Hub Cooperative | Guest User");
}

// Component 14
else if ( is_menu_set('guest_contacts') != ""){
    $currentPage = WPATH . "modules/account_unregistered.php";
    set_title("ICT Innovators Hub Cooperative | Guest User");
}

// Component 15
else if ( is_menu_set('guest_next_of_kins') != ""){
    $currentPage = WPATH . "modules/account_unregistered.php";
    set_title("ICT Innovators Hub Cooperative | Guest User");
}

// Component 16
else if ( is_menu_set('engage_loan_calculator') != ""){
    $currentPage = WPATH . "modules/add/engage_loan_calculator.php";
    set_title("ICT Innovators Hub Cooperative | Loan Calculator");
}

// Component 17
else if ( is_menu_set('add_sector') != ""){
    $currentPage = WPATH . "modules/add/add_sector.php";
    set_title("ICT Innovators Hub Cooperative | Add Sector");
}

// Component 18
else if ( is_menu_set('add_branch') != ""){
    $currentPage = WPATH . "modules/add/add_branch.php";
    set_title("ICT Innovators Hub Cooperative | Add Branch");
}

// Component 19
else if ( is_menu_set('add_loan_type') != ""){
    $currentPage = WPATH . "modules/add/add_loan_type.php";
    set_title("ICT Innovators Hub Cooperative | Add Loan Type");
}

// Component 20
else if ( is_menu_set('add_account_category') != ""){
    $currentPage = WPATH . "modules/add/add_account_category.php";
    set_title("ICT Innovators Hub Cooperative | Add Account Category");
}

// Component 21
else if ( is_menu_set('add_account_holder') != ""){
    $currentPage = WPATH . "modules/add/add_account_holder.php";
    set_title("ICT Innovators Hub Cooperative | Add Account Holder");
}

// Component 22
else if ( is_menu_set('add_account_type') != ""){
    $currentPage = WPATH . "modules/add/add_account_type.php";
    set_title("ICT Innovators Hub Cooperative | Account Type");
}

// Component 23
else if ( is_menu_set('add_business_form') != ""){
    $currentPage = WPATH . "modules/add/add_business_form.php";
    set_title("ICT Innovators Hub Cooperative | Add Business Form");
}

// Component 24
else if ( is_menu_set('add_business_type') != ""){
    $currentPage = WPATH . "modules/add/add_business_type.php";
    set_title("ICT Innovators Hub Cooperative | Add Business Type");
}

// Component 25
else if ( is_menu_set('add_contact') != ""){
    $currentPage = WPATH . "modules/add/add_contact.php";
    set_title("ICT Innovators Hub Cooperative | Add Contacts");
}

// Component 26
else if ( is_menu_set('add_default_charge_rate') != ""){
    $currentPage = WPATH . "modules/add/add_default_charge_rate.php";
    set_title("ICT Innovators Hub Cooperative | Add Default Charge Rate");
}

// Component 27
else if ( is_menu_set('add_deposit') != ""){
    $currentPage = WPATH . "modules/add/add_deposit.php";
    set_title("ICT Innovators Hub Cooperative | Customer Deposit");
}

// Component 28
else if ( is_menu_set('add_shares') != ""){
    $currentPage = WPATH . "modules/add/add_shares.php";
    set_title("ICT Innovators Hub Cooperative | Shares Deposit");
}

// Component 29
else if ( is_menu_set('add_account_to_account_transfer') != ""){
    $currentPage = WPATH . "modules/add/add_account_to_account_transfer.php";
    set_title("ICT Innovators Hub Cooperative | Account To Account Transfer");
}

// Component 30
else if ( is_menu_set('add_account_to_account_transfer_next') != ""){
    $currentPage = WPATH . "modules/add/add_account_to_account_transfer_next.php";
    set_title("Site Title | Account To Account Transfer");
}

// Component 31
else if ( is_menu_set('add_instalment_frequency') != ""){
    $currentPage = WPATH . "modules/add/add_instalment_frequency.php";
    set_title("ICT Innovators Hub Cooperative | Add Instalment Frequency");
}

// Component 32
else if ( is_menu_set('add_loan') != ""){
    $currentPage = WPATH . "modules/add/add_loan.php";
    set_title("ICT Innovators Hub Cooperative | Add Loan");
}

// Component 33
else if ( is_menu_set('add_loan_business_data') != ""){
    $currentPage = WPATH . "modules/add/add_loan_business_data.php";
    set_title("ICT Innovators Hub Cooperative | Add Loan Business Data ");
}

// Component 34
else if ( is_menu_set('add_loan_contact_person') != ""){
    $currentPage = WPATH . "modules/add/add_loan_contact_person.php";
    set_title("ICT Innovators Hub Cooperative | Add Loan Contact Person ");
}

// Component 35
else if ( is_menu_set('add_loan_external_data') != ""){
    $currentPage = WPATH . "modules/add/add_loan_external_data.php";
    set_title("ICT Innovators Hub Cooperative | Add Loan External Data");
}

// Component 36
else if ( is_menu_set('add_loan_data') != ""){
    $currentPage = WPATH . "modules/add/add_loan_data.php";
    set_title("ICT Innovators Hub Cooperative | Add Loan External Data");
}

// Component 37
else if ( is_menu_set('add_loan_guarantor') != ""){
    $currentPage = WPATH . "modules/add/add_loan_guarantor.php";
    set_title("ICT Innovators Hub Cooperative | Add Loan Guarantor");
}

// Component 38
else if ( is_menu_set('add_loan_guarantor2') != ""){
    $currentPage = WPATH . "modules/add/add_loan_guarantor2.php";
    set_title("ICT Innovators Hub Cooperative | Add Loan Another Guarantor");
}

// Component 39
else if ( is_menu_set('add_loan_next') != ""){
    $currentPage = WPATH . "modules/add/add_loan_next.php";
    set_title("ICT Innovators Hub Cooperative | Customer Loan Request");
}

// Component 40
else if ( is_menu_set('add_marital_status') != ""){
    $currentPage = WPATH . "modules/add/add_marital_status.php";
    set_title("ICT Innovators Hub Cooperative | Add Marital Status");
} 

// Component 41
else if ( is_menu_set('add_next_of_kins') != ""){
    $currentPage = WPATH . "modules/add/add_next_of_kins.php";
    set_title("ICT Innovators Hub Cooperative | Add Next of Kin");
}

// Component 42
else if ( is_menu_set('add_position') != ""){
    $currentPage = WPATH . "modules/add/add_position.php";
    set_title("ICT Innovators Hub Cooperative | Add Position");
}

// Component 43
else if ( is_menu_set('add_response') != ""){
    $currentPage = WPATH . "modules/add/add_response.php";
    set_title("ICT Innovators Hub Cooperative | Add Response");
}

// Component 44
else if ( is_menu_set('add_staff') != ""){
    $currentPage = WPATH . "modules/add/add_staff.php";
    set_title("ICT Innovators Hub Cooperative | Add Staff");
}

// Component 45
else if ( is_menu_set('add_status') != ""){
    $currentPage = WPATH . "modules/add/add_status.php";
    set_title("ICT Innovators Hub Cooperative | Add Status");
}

// Component 46
else if ( is_menu_set('add_transaction_type') != ""){
    $currentPage = WPATH . "modules/add/add_transaction_type.php";
    set_title("ICT Innovators Hub Cooperative | Add Transaction Type");
}

// Component 47
else if ( is_menu_set('add_role') != ""){
    $currentPage = WPATH . "modules/add/add_role.php";
    set_title("ICT Innovators Hub Cooperative | Add Role");
}

// Component 48
else if ( is_menu_set('add_user_type') != ""){
    $currentPage = WPATH . "modules/add/add_user_type.php";
    set_title("ICT Innovators Hub Cooperative | Add User Type");
}

// Component 49
else if ( is_menu_set('add_withdrawal') != ""){
    $currentPage = WPATH . "modules/add/add_withdrawal.php";
    set_title("ICT Innovators Hub Cooperative | Customer Withdrawal");
}

// Component 50
else if ( is_menu_set('transitional_add_deposit') != ""){
    $currentPage = WPATH . "modules/add/transitional_add_deposit.php";
    set_title("ICT Innovators Hub Cooperative | Customer Deposit(Transitional)");
}

// Component 51
else if ( is_menu_set('transitional_add_loan') != ""){
    $currentPage = WPATH . "modules/add/transitional_add_loan.php";
    set_title("ICT Innovators Hub Cooperative | Customer Loan(Transitional)");
}

// Component 52
else if ( is_menu_set('transitional_add_withdrawal') != ""){
    $currentPage = WPATH . "modules/add/transitional_add_withdrawal.php";
    set_title("ICT Innovators Hub Cooperative | Customer Withdrawal(Transitional)");
}

// Component 53
else if ( is_menu_set('transitional_update_account') != ""){
    $currentPage = WPATH . "modules/update/transitional_update_account.php";
    set_title("ICT Innovators Hub Cooperative | Update Account(Transitional)");
}

// Component 54
else if ( is_menu_set('update_account') != ""){
    $currentPage = WPATH . "modules/update/update_account.php";
    set_title("ICT Innovators Hub Cooperative | Update Account");
}

// Component 55
else if ( is_menu_set('update_account_category') != ""){
    $currentPage = WPATH . "modules/update/update_account_category.php";
    set_title("ICT Innovators Hub Cooperative | Update Account Category Details");
}

// Component 56
else if ( is_menu_set('update_account_holder') != ""){
    $currentPage = WPATH . "modules/update/update_account_holder.php";
    set_title("ICT Innovators Hub Cooperative | Update Account Holder Details");
}

// Component 57
else if ( is_menu_set('update_account_type') != ""){
    $currentPage = WPATH . "modules/update/update_account_type.php";
    set_title("ICT Innovators Hub Cooperative | Update Account Type");
}

// Component 58
else if ( is_menu_set('update_branch') != ""){
    $currentPage = WPATH . "modules/update/update_branch.php";
    set_title("ICT Innovators Hub Cooperative | Update Branch");
}

// Component 59
else if ( is_menu_set('update_business_form') != ""){
    $currentPage = WPATH . "modules/update/update_business_form.php";
    set_title("ICT Innovators Hub Cooperative | Update Business Form");
}

// Component 60
else if ( is_menu_set('update_business_plan') != ""){
    $currentPage = WPATH . "modules/update/update_business_plan.php";
    set_title("ICT Innovators Hub Cooperative | Update Business Plan");
}

// Component 61
else if ( is_menu_set('update_business_type') != ""){
    $currentPage = WPATH . "modules/update/update_business_type.php";
    set_title("ICT Innovators Hub Cooperative | Update Business Type");
}

// Component 62
else if ( is_menu_set('update_contact') != ""){
    $currentPage = WPATH . "modules/update/update_contact.php";
    set_title("ICT Innovators Hub Cooperative | Update Contact");
}

// Component 63
else if ( is_menu_set('update_default_charge_rate') != ""){
    $currentPage = WPATH . "modules/update/update_default_charge_rate.php";
    set_title("ICT Innovators Hub Cooperative | Update Default Change Rate");
}

// Component 64
else if ( is_menu_set('update_instalment_frequency') != ""){
    $currentPage = WPATH . "modules/update/update_instalment_frequency.php";
    set_title("ICT Innovators Hub Cooperative | Update Instalment Frequency Details");
}

// Component 65
else if ( is_menu_set('update_loan') != ""){
    $currentPage = WPATH . "modules/update/update_loan.php";
    set_title("ICT Innovators Hub Cooperative | Update Loan Details");
}

// Component 66
else if ( is_menu_set('update_loan_balance') != ""){
    $currentPage = WPATH . "modules/update/update_loan_balance.php";
    set_title("ICT Innovators Hub Cooperative | Update Loan Balance");
}

// Component 67
else if ( is_menu_set('update_loan_balance_next') != ""){
    $currentPage = WPATH . "modules/update/update_loan_balance_next.php";
    set_title("ICT Innovators Hub Cooperative | Settle Loan");
}

// Component 68
else if ( is_menu_set('update_loan_business_data') != ""){
    $currentPage = WPATH . "modules/update/update_loan_business_data.php";
    set_title("ICT Innovators Hub Cooperative | Update Loan Business Data Details");
}

// Component 69
else if ( is_menu_set('update_loan_contact_person') != ""){
    $currentPage = WPATH . "modules/update/update_loan_contact_person.php";
    set_title("ICT Innovators Hub Cooperative | Update Loan Contact Person Details");
}

// Component 70
else if ( is_menu_set('update_loan_data') != ""){
    $currentPage = WPATH . "modules/update/update_loan_data.php";
    set_title("ICT Innovators Hub Cooperative | Update Loan Data Details");
}

// Component 71
else if ( is_menu_set('update_loan_external_data') != ""){
    $currentPage = WPATH . "modules/update/update_loan_external_data.php";
    set_title("ICT Innovators Hub Cooperative | Update Loan External Data Details");
}

// Component 72
else if ( is_menu_set('update_loan_guarantor') != ""){
    $currentPage = WPATH . "modules/update/update_loan_guarantor.php";
    set_title("ICT Innovators Hub Cooperative | Update Loan Guarantor Details");
}

// Component 73
else if ( is_menu_set('update_loan_processing_fees') != ""){
    $currentPage = WPATH . "modules/update/update_loan_processing_fees.php";
    set_title("ICT Innovators Hub Cooperative | Update Loan Processing Fee");
}

// Component 74
else if ( is_menu_set('update_loan_type') != ""){
    $currentPage = WPATH . "modules/update/update_loan_type.php";
    set_title("ICT Innovators Hub Cooperative | Update Account Category");
}

// Component 75
else if ( is_menu_set('update_marital_status') != ""){
    $currentPage = WPATH . "modules/update/update_marital_status.php";
    set_title("ICT Innovators Hub Cooperative | Update Marital Status Details");
}

// Component 76
else if ( is_menu_set('update_next_of_kin') != ""){
    $currentPage = WPATH . "modules/update/update_next_of_kin.php";
    set_title("ICT Innovators Hub Cooperative | Update Next of Kin Details");
}

// Component 77
else if ( is_menu_set('update_position') != ""){
    $currentPage = WPATH . "modules/update/update_position.php";
    set_title("ICT Innovators Hub Cooperative | Update Position Details");
}

// Component 78
else if ( is_menu_set('update_profpicture') != ""){
    $currentPage = WPATH . "modules/update/update_profpicture.php";
    set_title("ICT Innovators Hub Cooperative | Update Profile Picture");
}

// Component 79
else if ( is_menu_set('update_response') != ""){
    $currentPage = WPATH . "modules/update/update_response.php";
    set_title("ICT Innovators Hub Cooperative | Update Response Details");
}

// Component 80
else if ( is_menu_set('update_signature') != ""){
    $currentPage = WPATH . "modules/update/update_signature.php";
    set_title("ICT Innovators Hub Cooperative | Update Signature");
}

// Component 81
else if ( is_menu_set('update_staff') != ""){
    $currentPage = WPATH . "modules/update/update_staff.php";
    set_title("ICT Innovators Hub Cooperative | Update Staff Details");
}

// Component 82
else if ( is_menu_set('update_status') != ""){
    $currentPage = WPATH . "modules/update/update_status.php";
    set_title("ICT Innovators Hub Cooperative | Update Status Details");
}

// Component 83
else if ( is_menu_set('update_transaction_type') != ""){
    $currentPage = WPATH . "modules/update/update_transaction_type.php";
    set_title("ICT Innovators Hub Cooperative | Update Transaction Type Details");
}

// Component 84
else if ( is_menu_set('update_role') != ""){
    $currentPage = WPATH . "modules/update/update_role.php";
    set_title("ICT Innovators Hub Cooperative | Update Role Details");
}

// Component 85
else if ( is_menu_set('update_user_type') != ""){
    $currentPage = WPATH . "modules/update/update_user_type.php";
    set_title("ICT Innovators Hub Cooperative | Update User Type Details");
}

// Component 86
else if ( is_menu_set('view_branches') != ""){
    $currentPage = WPATH . "modules/read/view_branches.php";
    set_title("ICT Innovators Hub Cooperative | Branches");
}

// Component 87
else if ( is_menu_set('view_sectors') != ""){
    $currentPage = WPATH . "modules/read/view_sectors.php";
    set_title("ICT Innovators Hub Cooperative | Sectors");
}

// Component 88
else if ( is_menu_set('view_inbox_messages') != ""){
    $currentPage = WPATH . "modules/read/view_inbox_messages.php";
    set_title("ICT Innovators Hub Cooperative | Inbox Messages");
}

// Component 89
else if ( is_menu_set('update_sector') != ""){
    $currentPage = WPATH . "modules/update/update_sector.php";
    set_title("ICT Innovators Hub Cooperative | Update Sector");
}

// Component 90
else if ( is_menu_set('update_inbox_message') != ""){
    $currentPage = WPATH . "modules/update/update_inbox_message.php";
    set_title("ICT Innovators Hub Cooperative | Update Inbox Message");
}

// Component 91
else if ( is_menu_set('transitional_view_account') != ""){
    $currentPage = WPATH . "modules/read/transitional_view_accounts.php";
    set_title("ICT Innovators Hub Cooperative | Accounts(Transitional)");
}

// Component 92
else if ( is_menu_set('transitional_view_accounts_individual') != ""){
    $currentPage = WPATH . "modules/read/transitional_view_accounts_individual.php";
    set_title("ICT Innovators Hub Cooperative | Accounts Details(Transitional)");
}

// Component 93
else if ( is_menu_set('view_account_categories') != ""){
    $currentPage = WPATH . "modules/read/view_account_categories.php";
    set_title("ICT Innovators Hub Cooperative | Account Categories");
}

// Component 94
else if ( is_menu_set('view_account_categories_individual') != ""){
    $currentPage = WPATH . "modules/read/view_account_categories_individual.php";
    set_title("ICT Innovators Hub Cooperative | Account Categories Individual");
}

// Component 95
else if ( is_menu_set('view_sectors_individual') != ""){
    $currentPage = WPATH . "modules/read/view_sectors_individual.php";
    set_title("ICT Innovators Hub Cooperative | Sectors Individual");
}

// Component 96
else if ( is_menu_set('view_account_holders') != ""){
    $currentPage = WPATH . "modules/read/view_account_holders.php";
    set_title("ICT Innovators Hub Cooperative | Account Holders");
}

// Component 97
else if ( is_menu_set('view_account_holders_individual') != ""){
    $currentPage = WPATH . "modules/read/view_account_holders_individual.php";
    set_title("ICT Innovators Hub Cooperative | Account Holders Details");
}

// Component 98
else if ( is_menu_set('view_account_holders_individual_account') != ""){
    $currentPage = WPATH . "modules/read/view_account_holders_individual_account.php";
    set_title("ICT Innovators Hub Cooperative | Account Holders Details(MORE)");
}

// Component 99
else if ( is_menu_set('view_account_types') != ""){
    $currentPage = WPATH . "modules/read/view_account_types.php";
    set_title("ICT Innovators Hub Cooperative | Account Types");
}

// Component 100
else if ( is_menu_set('view_account_types_individual') != ""){
    $currentPage = WPATH . "modules/read/view_account_types_individual.php";
    set_title("ICT Innovators Hub Cooperative | Account Types Details");
}

// Component 101
else if ( is_menu_set('view_accounts') != ""){
    $currentPage = WPATH . "modules/read/view_accounts.php";
    set_title("ICT Innovators Hub Cooperative | Accounts");
}

// Component 102
else if ( is_menu_set('view_accounts_individual') != ""){
    $currentPage = WPATH . "modules/read/view_accounts_individual.php";
    set_title("ICT Innovators Hub Cooperative | Accounts Details");
}

// Component 103
else if ( is_menu_set('view_branches_individual') != ""){
    $currentPage = WPATH . "modules/read/view_branches_individual.php";
    set_title("ICT Innovators Hub Cooperative | Branches Details");
}

// Component 104
else if ( is_menu_set('view_business_forms') != ""){
    $currentPage = WPATH . "modules/read/view_business_forms.php";
    set_title("ICT Innovators Hub Cooperative | Business Forms");
}

// Component 105
else if ( is_menu_set('view_business_forms_individual') != ""){
    $currentPage = WPATH . "modules/read/view_business_forms_individual.php";
    set_title("ICT Innovators Hub Cooperative | Business Form Details");
}

// Component 106
else if ( is_menu_set('view_business_types') != ""){
    $currentPage = WPATH . "modules/read/view_business_types.php";
    set_title("ICT Innovators Hub Cooperative | Business Types");
}

// Component 107
else if ( is_menu_set('view_business_types_individual') != ""){
    $currentPage = WPATH . "modules/read/view_business_types_individual.php";
    set_title("ICT Innovators Hub Cooperative | Business Types Details");
}

// Component 108
else if ( is_menu_set('view_contacts') != ""){
    $currentPage = WPATH . "modules/read/view_contacts.php";
    set_title("ICT Innovators Hub Cooperative | Contacts");
}

// Component 109
else if ( is_menu_set('view_contacts_individual') != ""){
    $currentPage = WPATH . "modules/read/view_contacts_individual.php";
    set_title("ICT Innovators Hub Cooperative | Contacts Details");
}

// Component 110
else if ( is_menu_set('view_default_charge_rates') != ""){
    $currentPage = WPATH . "modules/read/view_default_charge_rates.php";
    set_title("ICT Innovators Hub Cooperative | Default Charge Rates");
}

// Component 111
else if ( is_menu_set('view_default_charge_rates_individual') != ""){
    $currentPage = WPATH . "modules/read/view_default_charge_rates_individual.php";
    set_title("ICT Innovators Hub Cooperative | Default Charge Rates Details");
}

// Component 112
else if ( is_menu_set('view_account_deposits') != ""){
    $currentPage = WPATH . "modules/read/view_deposits.php";
    set_title("ICT Innovators Hub Cooperative | Deposits");
}

// Component 113
else if ( is_menu_set('view_deposits') != ""){
    $currentPage = WPATH . "modules/read/view_deposits.php";
    set_title("ICT Innovators Hub Cooperative | Deposits");
}

// Component 114
else if ( is_menu_set('view_account_shares') != ""){
    $currentPage = WPATH . "modules/read/view_shares.php";
    set_title("ICT Innovators Hub Cooperative | Shares");
}

// Component 115
else if ( is_menu_set('view_shares') != ""){
    $currentPage = WPATH . "modules/read/view_shares.php";
    set_title("ICT Innovators Hub Cooperative | Shares");
}

// Component 116
else if ( is_menu_set('view_my_account_to_account_transfers') != ""){
    $currentPage = WPATH . "modules/read/view_account_to_account_transfers.php";
    set_title("ICT Innovators Hub Cooperative | Account To Account Transfers");
}

// Component 117
else if ( is_menu_set('view_account_to_account_transfers') != ""){
    $currentPage = WPATH . "modules/read/view_account_to_account_transfers.php";
    set_title("ICT Innovators Hub Cooperative | Account To Account Transfers");
}

// Component 118
else if ( is_menu_set('view_instalment_frequencies') != ""){
    $currentPage = WPATH . "modules/read/view_instalment_frequencies.php";
    set_title("ICT Innovators Hub Cooperative | Instalment Frequencies");
}

// Component 119
else if ( is_menu_set('view_instalment_frequencies_individual') != ""){
    $currentPage = WPATH . "modules/read/view_instalment_frequencies_individual.php";
    set_title("ICT Innovators Hub Cooperative | Instalment Frequency Details");
}

// Component 120
else if ( is_menu_set('view_loan_repayments') != ""){
    $currentPage = WPATH . "modules/read/view_loan_repayments.php";
    set_title("ICT Innovators Hub Cooperative | Loan Repayments");
}

// Component 121
else if ( is_menu_set('view_account_loan_repayments') != ""){
    $currentPage = WPATH . "modules/read/view_loan_repayments.php";
    set_title("ICT Innovators Hub Cooperative | Loan Repayments");
}

// Component 122
else if ( is_menu_set('view_loan_business_data') != ""){
    $currentPage = WPATH . "modules/read/view_loan_business_data.php";
    set_title("ICT Innovators Hub Cooperative | Loan Business Data");
}

// Component 123
else if ( is_menu_set('view_account_loan_business_data') != ""){
    $currentPage = WPATH . "modules/read/view_loan_business_data.php";
    set_title("ICT Innovators Hub Cooperative | Loan Business Data");
}

// Component 124
else if ( is_menu_set('view_loan_business_data_individual') != ""){
    $currentPage = WPATH . "modules/read/view_loan_business_data_individual.php";
    set_title("ICT Innovators Hub Cooperative | Loan Business Data Details");
}

// Component 125
else if ( is_menu_set('view_loan_contact_persons') != ""){
    $currentPage = WPATH . "modules/read/view_loan_contact_persons.php";
    set_title("ICT Innovators Hub Cooperative | Loan Contact Persons");
}

// Component 126
else if ( is_menu_set('view_loan_contact_persons_individual') != ""){
    $currentPage = WPATH . "modules/read/view_loan_contact_persons_individual.php";
    set_title("ICT Innovators Hub Cooperative | Loan Contact Persons Details");
}

// Component 127
else if ( is_menu_set('view_loan_data') != ""){
    $currentPage = WPATH . "modules/read/view_loan_data.php";
    set_title("ICT Innovators Hub Cooperative | Loan Data");
}

// Component 128
else if ( is_menu_set('view_loan_data_individual') != ""){
    $currentPage = WPATH . "modules/read/view_loan_data_individual.php";
    set_title("ICT Innovators Hub Cooperative | Loan Data Details");
}

// Component 129
else if ( is_menu_set('view_investor_project_bids') != ""){
    $currentPage = WPATH . "modules/read/view_investor_project_bids.php";
    set_title("ICT Innovators Hub Cooperative | My Project Bids");
}

// Component 130
else if ( is_menu_set('view_loan_external_data') != ""){
    $currentPage = WPATH . "modules/read/view_loan_external_data.php";
    set_title("ICT Innovators Hub Cooperative | Loan External Data");
}

// Component 131
else if ( is_menu_set('view_loan_external_data_individual') != ""){
    $currentPage = WPATH . "modules/read/view_loan_external_data_individual.php";
    set_title("ICT Innovators Hub Cooperative | Loan External Data Details");
}

// Component 132
else if ( is_menu_set('view_loan_guarantors') != ""){
    $currentPage = WPATH . "modules/read/view_loan_guarantors.php";
    set_title("ICT Innovators Hub Cooperative | Loan Guarantors");
}

// Component 133
else if ( is_menu_set('view_account_loan_guarantors') != ""){
    $currentPage = WPATH . "modules/read/view_loan_guarantors.php";
    set_title("ICT Innovators Hub Cooperative | Loan Guarantors");
}

// Component 134
else if ( is_menu_set('borrowing_tac') != ""){
    $currentPage = WPATH . "modules/borrowing_tac.php";
    set_title("ICT Innovators Hub Cooperative | Membership and Borrowing Terms and Conditions");
}

// Component 135
else if ( is_menu_set('website_tac') != ""){
    $currentPage = WPATH . "modules/website_tac.php";
    set_title("ICT Innovators Hub Cooperative | Website Terms and Conditions");
}

// Component 136
else if ( is_menu_set('help') != ""){
    $currentPage = WPATH . "modules/help.php";
    set_title("ICT Innovators Hub Cooperative | Help");
}

// Component 137
else if ( is_menu_set('view_loan_guarantors_individual') != ""){
    $currentPage = WPATH . "modules/read/view_loan_guarantors_individual.php";
    set_title("ICT Innovators Hub Cooperative | Loan Guarantors Details");
}

// Component 138
else if ( is_menu_set('view_loan_processing_fees') != ""){
    $currentPage = WPATH . "modules/read/view_loan_processing_fees.php";
    set_title("ICT Innovators Hub Cooperative | Loan Processing Fees");
}

// Component 139
else if ( is_menu_set('add_loan_processing_fees') != ""){
    $currentPage = WPATH . "modules/add/add_loan_processing_fees.php";
    set_title("ICT Innovators Hub Cooperative | Add Loan Processing Fees");
}

// Component 140
else if ( is_menu_set('view_loan_processing_fees_individual') != ""){
    $currentPage = WPATH . "modules/read/view_loan_processing_fees_individual.php";
    set_title("ICT Innovators Hub Cooperative | Loan Processing Fees Details");
}

// Component 141
else if ( is_menu_set('view_loan_types') != ""){
    $currentPage = WPATH . "modules/read/view_loan_types.php";
    set_title("ICT Innovators Hub Cooperative | Loan Types");
}

// Component 142
else if ( is_menu_set('view_loan_types_individual') != ""){
    $currentPage = WPATH . "modules/read/view_loan_types_individual.php";
    set_title("ICT Innovators Hub Cooperative | Loan Type Details");
}

// Component 143
else if ( is_menu_set('view_loans') != ""){
    $currentPage = WPATH . "modules/read/view_loans.php";
    set_title("ICT Innovators Hub Cooperative | Loans");
}

// Component 144
else if ( is_menu_set('view_account_loans') != ""){
    $currentPage = WPATH . "modules/read/view_loans.php";
    set_title("ICT Innovators Hub Cooperative | My Loans");
}

// Component 145
else if ( is_menu_set('view_loans_individual') != ""){
    $currentPage = WPATH . "modules/read/view_loans_individual.php";
    set_title("ICT Innovators Hub Cooperative | Loans Dettails");
}

// Component 146
else if ( is_menu_set('view_marital_statuses') != ""){
    $currentPage = WPATH . "modules/read/view_marital_statuses.php";
    set_title("ICT Innovators Hub Cooperative | Marital Statuses");
}

// Component 147
else if ( is_menu_set('view_marital_statuses_individual') != ""){
    $currentPage = WPATH . "modules/read/view_marital_statuses_individual.php";
    set_title("ICT Innovators Hub Cooperative | Marital Statuses Details");
}

// Component 148
else if ( is_menu_set('view_next_of_kins') != ""){
    $currentPage = WPATH . "modules/read/view_next_of_kins.php";
    set_title("ICT Innovators Hub Cooperative | Next of Kins");
}

// Component 149
else if ( is_menu_set('view_next_of_kins_individual') != ""){
    $currentPage = WPATH . "modules/read/view_next_of_kins_individual.php";
    set_title("ICT Innovators Hub Cooperative | Next of Kins Details");
}

// Component 150
else if ( is_menu_set('view_positions') != ""){
    $currentPage = WPATH . "modules/read/view_positions.php";
    set_title("ICT Innovators Hub Cooperative | Positions");
}

// Component 151
else if ( is_menu_set('view_positions_individual') != ""){
    $currentPage = WPATH . "modules/read/view_positions_individual.php";
    set_title("ICT Innovators Hub Cooperative | Positions Details");
}

// Component 152
else if ( is_menu_set('view_responses') != ""){
    $currentPage = WPATH . "modules/read/view_responses.php";
    set_title("ICT Innovators Hub Cooperative | Responses");
}

// Component 153
else if ( is_menu_set('view_responses_individual') != ""){
    $currentPage = WPATH . "modules/read/view_responses_individual.php";
    set_title("ICT Innovators Hub Cooperative | Responses Details");
}

// Component 154
else if ( is_menu_set('view_staff') != ""){
    $currentPage = WPATH . "modules/read/view_staff.php";
    set_title("ICT Innovators Hub Cooperative | Staff");
}

// Component 155
else if ( is_menu_set('view_staff_individual') != ""){
    $currentPage = WPATH . "modules/read/view_staff_individual.php";
    set_title("ICT Innovators Hub Cooperative | Staff Details");
}

// Component 156
else if ( is_menu_set('view_statuses') != ""){
    $currentPage = WPATH . "modules/read/view_statuses.php";
    set_title("ICT Innovators Hub Cooperative | Statuses");
}

// Component 157
else if ( is_menu_set('view_statuses_individual') != ""){
    $currentPage = WPATH . "modules/read/view_statuses_individual.php";
    set_title("ICT Innovators Hub Cooperative | Status Details");
}

// Component 158
else if ( is_menu_set('view_transaction_types') != ""){
    $currentPage = WPATH . "modules/read/view_transaction_types.php";
    set_title("ICT Innovators Hub Cooperative | Transation Types");
}

// Component 159
else if ( is_menu_set('view_transaction_types_individual') != ""){
    $currentPage = WPATH . "modules/read/view_transaction_types_individual.php";
    set_title("ICT Innovators Hub Cooperative | Transation Type Details");
}

// Component 160
else if ( is_menu_set('view_account_transactions') != ""){
    $currentPage = WPATH . "modules/read/view_transactions.php";
    set_title("ICT Innovators Hub Cooperative | Transations");
}

// Component 161
else if ( is_menu_set('view_transactions') != ""){
    $currentPage = WPATH . "modules/read/view_transactions.php";
    set_title("ICT Innovators Hub Cooperative | Transations");
}

// Component 162
else if ( is_menu_set('view_roles') != ""){
    $currentPage = WPATH . "modules/read/view_roles.php";
    set_title("ICT Innovators Hub Cooperative | Roles");
}

// Component 163
else if ( is_menu_set('view_roles_individual') != ""){
    $currentPage = WPATH . "modules/read/view_roles_individual.php";
    set_title("ICT Innovators Hub Cooperative | Role Details");
}

// Component 164
else if ( is_menu_set('view_user_types') != ""){
    $currentPage = WPATH . "modules/read/view_user_types.php";
    set_title("ICT Innovators Hub Cooperative | User Types");
}

// Component 165
else if ( is_menu_set('view_user_types_individual') != ""){
    $currentPage = WPATH . "modules/read/view_user_types_individual.php";
    set_title("ICT Innovators Hub Cooperative | User Types Details");
}

// Component 166
else if ( is_menu_set('view_account_withdrawals') != ""){
    $currentPage = WPATH . "modules/read/view_withdrawals.php";
    set_title("ICT Innovators Hub Cooperative | Withdrawals");
}

// Component 167
else if ( is_menu_set('view_withdrawals') != ""){
    $currentPage = WPATH . "modules/read/view_withdrawals.php";
    set_title("ICT Innovators Hub Cooperative | Withdrawals");
}

// Component 168
else if ( is_menu_set('view_withdrawals_individual') != ""){
    $currentPage = WPATH . "modules/read/view_withdrawals_individual.php";
    set_title("ICT Innovators Hub Cooperative | Withdrawals Details");
}

// Component 169
//else if ( is_menu_set('basic_form') != ""){
//    $currentPage = WPATH . "modules/basic_form.html";
//    set_title("ICT Innovators Hub Cooperative | Home");
//}

// Component 170
//else if ( is_menu_set('general') != ""){
//    $currentPage = WPATH . "modules/general.html";
//    set_title("ICT Innovators Hub Cooperative | Home");
//}

// Component 171
//else if ( is_menu_set('simple') != ""){
//    $currentPage = WPATH . "modules/simple.html";
//    set_title("ICT Innovators Hub Cooperative | Home");
//}

// Component 172
else if ( is_menu_set('accounts') != ""){
    $currentPage = WPATH . "modules/admin/accounts.php";
    set_title("ICT Innovators Hub Cooperative | Accounts");
}

// Component 173
else if ( is_menu_set('add_account') != ""){
    $currentPage = WPATH . "modules/add/add_account.php";
    set_title("ICT Innovators Hub Cooperative | Add Account");
}

// Component 174
else if ( is_menu_set('add_account_next') != ""){
    $currentPage = WPATH . "modules/add/add_account_next.php";
    set_title("ICT Innovators Hub Cooperative | Add Account");
}

// Component 175
else if ( is_menu_set('add_account_banking') != ""){
    $currentPage = WPATH . "modules/add/add_account_banking.php";
    set_title("ICT Innovators Hub Cooperative | Add Account");
}

// Component 176
//else if ( is_menu_set('add_account3') != ""){
//    $currentPage = WPATH . "modules/add/add_account.php";
//    set_title("ICT Innovators Hub Cooperative | Add Accounts");
//}

// Component 177
else if ( is_menu_set('add_financing_method') != ""){
    $currentPage = WPATH . "modules/add/add_financing_method.php";
    set_title("ICT Innovators Hub Cooperative | Add Financing Method");
}

// Component 178
else if ( is_menu_set('view_financing_methods') != ""){
    $currentPage = WPATH . "modules/read/view_financing_methods.php";
    set_title("ICT Innovators Hub Cooperative | Financing Methods");
}

// Component 179
else if ( is_menu_set('view_financing_methods_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_financing_methods.php";
    set_title("ICT Innovators Hub Cooperative | Financing Methods");
}

// Component 180
else if ( is_menu_set('view_financing_methods_individual') != ""){
    $currentPage = WPATH . "modules/read/view_financing_methods_individual.php";
    set_title("ICT Innovators Hub Cooperative | Financing Methods Details");
}

// Component 181
else if ( is_menu_set('update_financing_method') != ""){
    $currentPage = WPATH . "modules/update/update_financing_method.php";
    set_title("ICT Innovators Hub Cooperative | Update Financing Method");
}

// Component 182
else if ( is_menu_set('add_funding_type') != ""){
    $currentPage = WPATH . "modules/add/add_funding_type.php";
    set_title("ICT Innovators Hub Cooperative | Add Funding Type");
}

// Component 183
else if ( is_menu_set('view_funding_types_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_funding_types.php";
    set_title("ICT Innovators Hub Cooperative | Funding Types");
}

// Component 184
else if ( is_menu_set('view_funding_types') != ""){
    $currentPage = WPATH . "modules/read/view_funding_types.php";
    set_title("ICT Innovators Hub Cooperative | Funding Types");
}

// Component 185
else if ( is_menu_set('view_funding_types_individual') != ""){
    $currentPage = WPATH . "modules/read/view_funding_types_individual.php";
    set_title("ICT Innovators Hub Cooperative | Funding Type Details");
}

// Component 186
else if ( is_menu_set('update_funding_type') != ""){
    $currentPage = WPATH . "modules/update/update_funding_type.php";
    set_title("ICT Innovators Hub Cooperative | Update Funding Type");
}

// Component 187
else if ( is_menu_set('add_investor') != ""){
    $currentPage = WPATH . "modules/add/add_investor.php";
    set_title("ICT Innovators Hub Cooperative | Add Investor");
}

// Component 188
else if ( is_menu_set('add_guest_user') != ""){
    $currentPage = WPATH . "modules/add/add_guest_user.php";
    set_title("ICT Innovators Hub Cooperative | Add Guest User");
}

// Component 189
else if ( is_menu_set('add_system_administrator') != ""){
    $currentPage = WPATH . "modules/add/add_system_administrator.php";
    set_title("ICT Innovators Hub Cooperative | Add System Administrator");
}

// Component 190
else if ( is_menu_set('view_guest_users') != ""){
    $currentPage = WPATH . "modules/read/view_guest_users.php";
    set_title("ICT Innovators Hub Cooperative | Guest Users");
}

// Component 191
else if ( is_menu_set('view_guest_users_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_guest_users.php";
    set_title("ICT Innovators Hub Cooperative | Guest Users");
}

// Component 192
else if ( is_menu_set('view_system_administrators_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_system_administrators.php";
    set_title("ICT Innovators Hub Cooperative | System Administrators");
}

// Component 193
else if ( is_menu_set('view_system_administrators') != ""){
    $currentPage = WPATH . "modules/read/view_system_administrators.php";
    set_title("ICT Innovators Hub Cooperative | System Administrators");
}

// Component 194
else if ( is_menu_set('view_investors') != ""){
    $currentPage = WPATH . "modules/read/view_investors.php";
    set_title("ICT Innovators Hub Cooperative | Investors");
}

// Component 195
else if ( is_menu_set('view_guest_users_individual') != ""){
    $currentPage = WPATH . "modules/read/view_guest_users_individual.php";
    set_title("ICT Innovators Hub Cooperative | Guest User Details");
}

// Component 196
else if ( is_menu_set('view_system_administrators_individual') != ""){
    $currentPage = WPATH . "modules/read/view_system_administrators_individual.php";
    set_title("ICT Innovators Hub Cooperative | System Administrator Details");
}

// Component 197
else if ( is_menu_set('view_investors_individual') != ""){
    $currentPage = WPATH . "modules/read/view_investors_individual.php";
    set_title("ICT Innovators Hub Cooperative | Investor Details");
}

// Component 198
else if ( is_menu_set('update_guest_user') != ""){
    $currentPage = WPATH . "modules/update/update_guest_user.php";
    set_title("ICT Innovators Hub Cooperative | Update Guest User");
}

// Component 199
else if ( is_menu_set('update_system_administrator') != ""){
    $currentPage = WPATH . "modules/update/update_system_administrator.php";
    set_title("ICT Innovators Hub Cooperative | Update System Administrator");
}

// Component 200
else if ( is_menu_set('update_investor') != ""){
    $currentPage = WPATH . "modules/update/update_investor.php";
    set_title("ICT Innovators Hub Cooperative | Update Investor");
}

// Component 201
else if ( is_menu_set('add_investor_type') != ""){
    $currentPage = WPATH . "modules/add/add_investor_type.php";
    set_title("ICT Innovators Hub Cooperative | Add Investor Type");
}

// Component 202
else if ( is_menu_set('view_investor_types') != ""){
    $currentPage = WPATH . "modules/read/view_investor_types.php";
    set_title("ICT Innovators Hub Cooperative | Investor Types");
}

// Component 203
else if ( is_menu_set('view_investor_types_individual') != ""){
    $currentPage = WPATH . "modules/read/view_investor_types_individual.php";
    set_title("ICT Innovators Hub Cooperative | Investor Type Details");
}

// Component 204
else if ( is_menu_set('update_investor_type') != ""){
    $currentPage = WPATH . "modules/update/update_investor_type.php";
    set_title("ICT Innovators Hub Cooperative | Update Investor Type");
}

// Component 205
else if ( is_menu_set('add_project') != ""){
    $currentPage = WPATH . "modules/add/add_project.php";
    set_title("ICT Innovators Hub Cooperative | Add Project");
}

// Component 206
else if ( is_menu_set('view_projects') != ""){
    $currentPage = WPATH . "modules/read/view_projects.php";
    set_title("ICT Innovators Hub Cooperative | Projects");
}

// Component 207
else if ( is_menu_set('view_account_projects') != ""){
    $currentPage = WPATH . "modules/read/view_projects.php";
    set_title("ICT Innovators Hub Cooperative | Projects");
}

// Component 208
else if ( is_menu_set('view_investor_projects') != ""){
    $currentPage = WPATH . "modules/read/view_projects.php";
    set_title("ICT Innovators Hub Cooperative | Projects");
}

// Component 209
else if ( is_menu_set('view_unbidded_projects') != ""){
    $currentPage = WPATH . "modules/read/view_unbidded_projects.php";
    set_title("ICT Innovators Hub Cooperative | Unbidded Projects");
}

// Component 210
else if ( is_menu_set('view_member_projects') != ""){
    $currentPage = WPATH . "modules/read/view_member_projects.php";
    set_title("ICT Innovators Hub Cooperative | My Projects");
}

// Component 211
else if ( is_menu_set('view_projects_individual') != ""){
    $currentPage = WPATH . "modules/read/view_projects_individual.php";
    set_title("ICT Innovators Hub Cooperative | Project Details");
}

// Component 212
else if ( is_menu_set('update_project') != ""){
    $currentPage = WPATH . "modules/update/update_project.php";
    set_title("ICT Innovators Hub Cooperative | Update Project");
}

// Component 213
else if ( is_menu_set('add_project_bid') != ""){
    $currentPage = WPATH . "modules/add/add_project_bid.php";
    set_title("ICT Innovators Hub Cooperative | Add Project Bid");
}

// Component 214
else if ( is_menu_set('view_project_bids') != ""){
    $currentPage = WPATH . "modules/read/view_project_bids.php";
    set_title("ICT Innovators Hub Cooperative | Project Bids");
}

// Component 215
else if ( is_menu_set('view_bids_on_project') != ""){
    $currentPage = WPATH . "modules/read/view_bids_on_project.php";
    set_title("ICT Innovators Hub Cooperative | Project Bids");
}

// Component 216
else if ( is_menu_set('view_account_project_bids') != ""){
    $currentPage = WPATH . "modules/read/view_project_bids.php";
    set_title("ICT Innovators Hub Cooperative | My Project Bids");
}

// Component 217
else if ( is_menu_set('view_project_bids_individual') != ""){
    $currentPage = WPATH . "modules/read/view_project_bids_individual.php";
    set_title("ICT Innovators Hub Cooperative | Project Bid Details");
}

// Component 218
else if ( is_menu_set('update_project_bid') != ""){
    $currentPage = WPATH . "modules/update/update_project_bid.php";
    set_title("ICT Innovators Hub Cooperative | Update Project Bid");
}

// Component 219
else if ( is_menu_set('add_system_privilege') != ""){
    $currentPage = WPATH . "modules/add/add_system_privilege.php";
    set_title("ICT Innovators Hub Cooperative | Add System Privilege");
}

// Component 220
else if ( is_menu_set('view_system_privileges') != ""){
    $currentPage = WPATH . "modules/read/view_system_privileges.php";
    set_title("ICT Innovators Hub Cooperative | System Privileges");
}

// Component 221
else if ( is_menu_set('view_system_privileges_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_system_privileges.php";
    set_title("ICT Innovators Hub Cooperative | System Privileges");
}

// Component 222
else if ( is_menu_set('update_system_privilege') != ""){
    $currentPage = WPATH . "modules/update/update_system_privilege.php";
    set_title("ICT Innovators Hub Cooperative | Update System Privilege");
}

// Component 223
else if ( is_menu_set('view_system_privileges_individual') != ""){
    $currentPage = WPATH . "modules/read/view_system_privileges_individual.php";
    set_title("ICT Innovators Hub Cooperative | System Privilege Details");
}

// Component 224
else if ( is_menu_set('view_user_privileges') != ""){
    $currentPage = WPATH . "modules/read/view_user_privileges.php";
    set_title("ICT Innovators Hub Cooperative | User Privileges");
}

// Component 225
else if ( is_menu_set('view_user_privileges_individual') != ""){
    $currentPage = WPATH . "modules/read/view_user_privileges_individual.php";
    set_title("ICT Innovators Hub Cooperative | User Privilege Details");
}

// Component 226
else if ( is_menu_set('update_user_type_privilege') != ""){
    $currentPage = WPATH . "modules/update/update_user_type_privilege.php";
    set_title("ICT Innovators Hub Cooperative | Update User Type Privilege");
}

// Component 227
else if ( is_menu_set('add_system_component') != ""){
    $currentPage = WPATH . "modules/add/add_system_component.php";
    set_title("ICT Innovators Hub Cooperative | Add System Component");
}

// Component 228
else if ( is_menu_set('view_system_components') != ""){
    $currentPage = WPATH . "modules/read/view_system_components.php";
    set_title("ICT Innovators Hub Cooperative | System Components");
}

// Component 229
else if ( is_menu_set('view_system_components_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_system_components.php";
    set_title("ICT Innovators Hub Cooperative | System Components");
}

// Component 230
else if ( is_menu_set('view_system_components_individual') != ""){
    $currentPage = WPATH . "modules/read/view_system_components_individual.php";
    set_title("ICT Innovators Hub Cooperative | System Component Details");
}

// Component 231
else if ( is_menu_set('update_system_component') != ""){
    $currentPage = WPATH . "modules/update/update_system_component.php";
    set_title("ICT Innovators Hub Cooperative | Update System Component");
}

// Component 232
else if ( is_menu_set('update_institution') != ""){
    $currentPage = WPATH . "modules/update/update_institution.php";
    set_title("ICT Innovators Hub Cooperative | Update Institution");
}

// Component 233
else if ( is_menu_set('add_institution') != ""){
    $currentPage = WPATH . "modules/add/add_institution.php";
    set_title("ICT Innovators Hub Cooperative | Add Institution");
}

// Component 234
else if ( is_menu_set('view_institutions') != ""){
    $currentPage = WPATH . "modules/read/view_institutions.php";
    set_title("ICT Innovators Hub Cooperative | Institutions");
}

// Component 235
else if ( is_menu_set('view_institutions_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_institutions.php";
    set_title("ICT Innovators Hub Cooperative | Institutions");
}

// Component 236
else if ( is_menu_set('view_institutions_individual') != ""){
    $currentPage = WPATH . "modules/read/view_institutions_individual.php";
    set_title("ICT Innovators Hub Cooperative | Institution Details");
}

// Component 237
else if ( is_menu_set('add_privilege_to_role') != ""){
    $currentPage = WPATH . "modules/add/add_privilege_to_role.php";
    set_title("ICT Innovators Hub Cooperative | Add Privilege to Role");
}

// Component 238
else if ( is_menu_set('view_role_privileges') != ""){
    $currentPage = WPATH . "modules/read/view_role_privileges.php";
    set_title("ICT Innovators Hub Cooperative | Privilege to Roles");
}

// Component 239
else if ( is_menu_set('view_projects_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_projects.php";
    set_title("ICT Innovators Hub Cooperative | Projects");
}

// Component 240
else if ( is_menu_set('view_investors_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_investors.php";
    set_title("ICT Innovators Hub Cooperative | Investors");
}

// Component 241
else if ( is_menu_set('view_account_categories_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_account_categories.php";
    set_title("ICT Innovators Hub Cooperative | Account Categories");
}

// Component 242
else if ( is_menu_set('view_account_types_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_account_types.php";
    set_title("ICT Innovators Hub Cooperative | Account Types");
}

// Component 243
else if ( is_menu_set('view_branches_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_branches.php";
    set_title("ICT Innovators Hub Cooperative | Branches");
}

// Component 244
else if ( is_menu_set('view_loan_processing_fees_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_loan_processing_fees.php";
    set_title("ICT Innovators Hub Cooperative | Loan Processing Fees");
}

// Component 245
else if ( is_menu_set('view_business_forms_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_business_forms.php";
    set_title("ICT Innovators Hub Cooperative | Business Forms");
}

// Component 246
else if ( is_menu_set('view_business_types_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_business_types.php";
    set_title("ICT Innovators Hub Cooperative | Business Types");
}

// Component 247
else if ( is_menu_set('view_contacts_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_contacts.php";
    set_title("ICT Innovators Hub Cooperative | Contacts");
}

// Component 248
else if ( is_menu_set('view_default_charge_rates_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_default_charge_rates.php";
    set_title("ICT Innovators Hub Cooperative | Default Charge Rates");
}

// Component 249
else if ( is_menu_set('view_deposits_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_deposits.php";
    set_title("ICT Innovators Hub Cooperative | Deposits");
}

// Component 250
else if ( is_menu_set('view_shares_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_shares.php";
    set_title("ICT Innovators Hub Cooperative | Shares");
}

// Component 251
else if ( is_menu_set('view_instalment_frequencies_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_instalment_frequencies.php";
    set_title("ICT Innovators Hub Cooperative | Instalment Frequencies");
}

// Component 252
else if ( is_menu_set('view_loan_business_data_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_loan_business_data.php";
    set_title("ICT Innovators Hub Cooperative | Loan Business Data");
}

// Component 253
else if ( is_menu_set('view_loan_contact_persons_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_loan_contact_persons.php";
    set_title("ICT Innovators Hub Cooperative | Loan Contact Persons");
}

// Component 254
else if ( is_menu_set('view_loan_data_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_loan_data.php";
    set_title("ICT Innovators Hub Cooperative | Loan Data");
}

// Component 255
else if ( is_menu_set('view_loan_external_data_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_loan_external_data.php";
    set_title("ICT Innovators Hub Cooperative | Loan External Data");
}

// Component 256
else if ( is_menu_set('view_loan_guarantors_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_loan_guarantors.php";
    set_title("ICT Innovators Hub Cooperative | Loan Guarantors");
}

// Component 257
else if ( is_menu_set('view_loan_types_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_loan_types.php";
    set_title("ICT Innovators Hub Cooperative | Loan Types");
}

// Component 258
else if ( is_menu_set('view_loans_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_loans.php";
    set_title("ICT Innovators Hub Cooperative | Loans");
}

// Component 259
else if ( is_menu_set('view_marital_statuses_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_marital_statuses.php";
    set_title("ICT Innovators Hub Cooperative | Marital Statuses");
}

// Component 260
else if ( is_menu_set('view_next_of_kins_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_next_of_kins.php";
    set_title("ICT Innovators Hub Cooperative | Next of kins");
}

// Component 261
else if ( is_menu_set('view_positions_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_positions.php";
    set_title("ICT Innovators Hub Cooperative | Positions");
}

// Component 262
else if ( is_menu_set('view_responses_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_responses.php";
    set_title("ICT Innovators Hub Cooperative | Responses");
}

// Component 263
else if ( is_menu_set('view_roles_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_roles.php";
    set_title("ICT Innovators Hub Cooperative | Roles");
}

// Component 264
else if ( is_menu_set('view_staff_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_staff.php";
    set_title("ICT Innovators Hub Cooperative | Staff Members");
}

// Component 265
else if ( is_menu_set('view_statuses_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_statuses.php";
    set_title("ICT Innovators Hub Cooperative | Statuses");
}

// Component 266
else if ( is_menu_set('view_transaction_types_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_transaction_types.php";
    set_title("ICT Innovators Hub Cooperative | Transaction Types");
}

// Component 267
else if ( is_menu_set('view_user_types_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_user_types.php";
    set_title("ICT Innovators Hub Cooperative | System User Types");
}

// Component 268
else if ( is_menu_set('view_withdrawals_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_withdrawals.php";
    set_title("ICT Innovators Hub Cooperative | Withdrawals");
}

// Component 269
else if ( is_menu_set('view_accounts_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_accounts.php";
    set_title("ICT Innovators Hub Cooperative | Accounts");
}

// Component 270
else if ( is_menu_set('view_account_holders_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_account_holders.php";
    set_title("ICT Innovators Hub Cooperative | Account Holders");
}


// Component 271
else if ( is_menu_set('add_job_advertisement') != ""){
    $currentPage = WPATH . "modules/add/add_job_advertisement.php";
    set_title("ICT Innovators Hub Cooperative::Innovators Hub | Add Job Advertisement");
}

// Component 272
else if ( is_menu_set('view_job_advertisements') != ""){
    $currentPage = WPATH . "modules/read/view_job_advertisements.php";
    set_title("ICT Innovators Hub Cooperative::Innovators Hub | Jobs");
}

// Component 273
else if ( is_menu_set('view_job_advertisements_individual') != ""){
    $currentPage = WPATH . "modules/read/view_job_advertisements_individual.php";
    set_title("ICT Innovators Hub Cooperative::Innovators Hub | Job Advertisement Details");
}

// Component 274
else if ( is_menu_set('update_job_advertisement') != ""){
    $currentPage = WPATH . "modules/update/update_job_advertisement.php";
    set_title("ICT Innovators Hub Cooperative::Innovators Hub | Update Job Advertisement Details");
}

// Component 275
else if ( is_menu_set('view_job_advertisements_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_job_advertisements.php";
    set_title("ICT Innovators Hub Cooperative | Job Advertisements");
}

// Component 276
else if ( is_menu_set('view_job_applications') != ""){
    $currentPage = WPATH . "modules/read/view_job_applications.php";
    set_title("ICT Innovators Hub Cooperative::Innovators Hub | Job Applications");
}

// Component 277
else if ( is_menu_set('view_job_applications_individual') != ""){
    $currentPage = WPATH . "modules/read/view_job_applications_individual.php";
    set_title("ICT Innovators Hub Cooperative::Innovators Hub | Job Application Details");
}

// Component 278
else if ( is_menu_set('view_job_applications_notifications') != ""){
    $currentPage = WPATH . "modules/read/view_job_applications.php";
    set_title("ICT Innovators Hub Cooperative | Job Applications");
}

// Component 279
else if ( is_menu_set('add_account_former') != ""){
    $currentPage = WPATH . "modules/add/add_account_former.php";
    set_title("ICT Innovators Hub Cooperative | Former Account");
} 

// Component 280
//else if ( is_menu_set('view_mentors') != ""){
//    $currentPage = WPATH . "modules/read/view_mentors.php";
//    set_title("ICT Innovators Hub Cooperative | Mentors");
//}

// Component 281
//else if ( is_menu_set('view_mentors_notifications') != ""){
//    $currentPage = WPATH . "modules/read/view_mentors.php";
//    set_title("ICT Innovators Hub Cooperative | Mentors");
//}

// Component 282
else if ( is_menu_set('add_personal_occupation_details') != ""){
    $currentPage = WPATH . "modules/add/add_personal_occupation_details.php";
    set_title("ICT Innovators Hub Cooperative | Add Personal Occupation Details");
}

// Component 283
else if ( is_menu_set('add_group_account_details') != ""){
    $currentPage = WPATH . "modules/add/add_group_account_details.php";
    set_title("ICT Innovators Hub Cooperative | Add Group Account Details");
}

// Component 284
else if ( is_menu_set('add_business_account_details') != ""){
    $currentPage = WPATH . "modules/add/add_business_account_details.php";
    set_title("ICT Innovators Hub Cooperative | Add Business Account Details");
}

// Component 285
else if ( is_menu_set('add_account_nominee') != ""){
    $currentPage = WPATH . "modules/add/add_account_nominee.php";
    set_title("ICT Innovators Hub Cooperative | Add Account Nominee");
}

// Mpesa
else if (is_menu_set('saf_validation') != "") {
    $currentPage = WPATH . "modules/payments/saf_validation.php";
} else if (is_menu_set('saf_confirmation') != "") {
    $currentPage = WPATH . "modules/payments/saf_confirmation.php";
} else if (is_menu_set('saf_registration') != "") {
    $currentPage = WPATH . "modules/payments/saf_registration.php";
}

else if (!empty($_GET)) {
    App::redirectTo("?");
}

else{
    $currentPage = WPATH . "modules/login.php";
    if ( App::isLoggedIn() ) {
		set_title("Home | ICT Innovators Hub Cooperative");                
	}        
}

if (App::isAjaxRequest())
    include $currentPage;
else {
    require WPATH . "core/template/layout.php";
}
?>