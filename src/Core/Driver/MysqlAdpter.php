<?

namespace Arax\Core\Driver;

use Arax\Core\Sql\Column;
use PDO;

class MysqlAdapter extends DriverAdapter
{
    private ?PDO $connection = null;
    private $request = null;
    private string $host;
    private string $port;
    private string $username;
    private string $password;
    private string $databaseName;

    public function __construct($host, $port, $username, $password, $databaseName)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->databaseName = $databaseName;
    }
    public function connect()
    {
        $connctionString = "mysql:host=$this->host;port=$this->port;dbname=$this->databaseName";
        $this->connection = new PDO($connctionString, $this->username, $this->password, array(
            PDO::ATTR_PERSISTENT => true
        ));
    }

    public function query(string $sql, $params = []): bool
    {
        if ($this->connection == null) {
            $this->connect();
        }
        foreach ($params as $key => $value) {
            $params[$key] =  $this->connection->quote($value);
        }
        $this->request = $this->connection->prepare($sql);
        return $this->request->execute($params);
    }

    public function fetch(string $sql, $params = [])
    {
        $this->query($sql, $params);
        $data = $this->request->fetchAll();
        $this->request = null;
        return $data;
    }

    public function insert(string $sql, $params = [])
    {
        $this->query($sql, $params);
        $this->request = null;
        return $this->connection->lastInsertId();
    }

    public function update(string $sql, $params = [])
    {
        $this->query($sql, $params);
        $rowsCount = $this->request->rowCount();
        $this->request = null;
        return $rowsCount;
    }

    public function delete(string $sql, $params = [])
    {
        $this->query($sql, $params);
        $this->request = null;
        return $this->connection->lastInsertId();
    }

    public function close()
    {
        $this->connection = null;
    }


    // get the type of the column base on SGBD
    // in our case is Mysql
    public function getType(int $type, $param = null): string
    {
        $columnType = '';
        switch ($type) {
            case Column::$BOOLEAN_TYPE:
                $columnType = 'TINYINT(1)';
                break;
            case Column::$INTEGER_TYPE:
                $columnType = 'INTEGER';
                break;
            case Column::$BIGINT_TYPE:
                $columnType = 'BIGINT';
                break;
            case Column::$DOUBLE_TYPE:
                $columnType = 'DOUBLE';
                break;
            case Column::$FLOAT_TYPE:
                $columnType = 'FLOAT' . ($param == null ? '' : '(' . $param . ')');
                break;
            case Column::$VARCHAR_TYPE:
                $columnType = 'VARCHAR(' . ($param == null ? '255' : $param) . ')';
                break;
            case Column::$TEXT_TYPE:
                $columnType = 'TEXT';
                break;
        }
        return $columnType;
    }
    public function createTable() {}

    // column definition
    public function createColumn(string $name, int $type, int $length = null, int $precision = null, bool $nullable = true, $defaultValue = null): string
    {
        $typeColumn = '';
        $nullableColumn = '';
        $defaultValueColumn = '';
        if ($type == Column::$FLOAT_TYPE) {
            $typeColumn = $this->getType($type, $precision);
        } elseif ($type == Column::$VARCHAR_TYPE) {
            $typeColumn = $this->getType($type, $length);
        } else {
            $typeColumn = $this->getType($type);
        }
        $nullableColumn = $nullable ? 'NULL' : 'NOT NULL';
        $defaultValueColumn = $defaultValue == null ? '' :  'DEFAULT ' . (($type == Column::$VARCHAR_TYPE || $type == Column::$TEXT_TYPE) ? '"' . $defaultValue . '"' : $defaultValue);
        $columnDefinition = $name . ' ' . $typeColumn;
        $columnDefinition .= ' ' . $nullableColumn;
        $columnDefinition .= ' ' . $defaultValueColumn;
        return $columnDefinition;
    }
}
