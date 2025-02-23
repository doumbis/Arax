<?php

error_reporting(E_ERROR | E_PARSE);
require_once __DIR__ . '/../../vendor/autoload.php';

use Arax\Core\Commands\DbStarter;
use Arax\Core\Helpers\Config;
use Arax\Core\Helpers\Lang;
use Arax\Core\Sql\Database;

$lang = new Lang('en');
Config::readConfigFile(__DIR__ . '/../database.json', $lang);

$dbstart = new DbStarter($lang);
$dbstart->migrate();
