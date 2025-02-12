<?php

namespace Arax\Core\Sql;

use Arax\Core\Helpers\Tool;

class Database
{
    protected $databaseName;
    protected $driver;
    protected $host;
    protected $port;
    protected $username;
    protected $password;
    protected $prefix;
    protected $engine;
    protected $collation;
    protected $charset;
    protected $connection;


    public function __construct($connection = 'mysql')
    {
        $this->connection = $connection;
    }

    protected function loadConfiguration()
    {
        $path = __DIR__ . '/../../config/database.json';
        $content = file_get_contents($path);
        if ($content === false) {
            throw new \Exception("The file $path does not exist");
        }
        $config = json_decode($content, true);
        if (!isset($config['connections'][$this->connection])) {
            throw new \Exception("The connection $this->connection does not exist in the configuration file");
        }
        $configSelected = $config['connections'][$this->connection];
        $map = ['database' => 'databaseName'];
        Tool::convertArrayToObject($configSelected, $this, true, $map);
    }

    /**
     * the method is setter of all properties defined in the class object
     * @param string $attribute is the attribute to be set
     * @param mixed $value is the value to be set
     */
    public function setter(string $attribute, $value)
    {
        if (property_exists($this, $attribute)) {
            $this->{$attribute} = $value;
        }
    }
}
