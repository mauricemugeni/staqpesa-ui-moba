<?php
//Change host name, database type, database, username, password
require "Database.php";

//Database::setUp(array(
//	'dsn' => 'mysql:host=localhost;dbname=eic;',
//	'username' => 'root',
//	'password' => 'sogoni1608'
//    ));

Database::setUp(array(
	'dsn' => 'mysql:host=localhost;dbname=euniquec_frame;',
	'username' => 'euniquec_eic',
	'password' => 'euniquec_eic@1234'
    ));

//Database::setUp(array(
//	'dsn' => 'mysql:host=localhost;dbname=reflexco_eic;',
//	'username' => 'reflexco_eic',
//	'password' => 'eic#1234'
//    ));

                            
