<?php
//global.inc.php

require_once 'includes/Medoo.php';
require_once 'includes/Helper.class.php';

use Medoo\Medoo;

// config database
$db = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'databasename',
    'server' => 'localhost',
    'username' => 'databaseuser',
    'password' => 'databasepass'
]);

// config API
$merchant_id = "fa57491f-1ec6-42b6-a386-81639fda7d2b";
$secret_key = "y3SSLfzou3Bu";

date_default_timezone_set('Asia/Ho_Chi_Minh');