<?php

error_reporting(E_ERROR | E_PARSE);
require_once __DIR__ . '/../../vendor/autoload.php';

use Arax\Core\Commands\DbStarter;
use Arax\Core\Helpers\Lang;
use Arax\Core\Sql\Database;

$lang = new Lang('en');
print $lang->getMessage('welcome');

DbStarter::createTable('Student', 'users', 'This table is used to store users');
