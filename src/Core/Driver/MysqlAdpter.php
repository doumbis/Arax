<?

namespace Arax\Core\Driver;

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
        $this->request = null;
        return $this->connection->lastInsertId();
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

    public function execute()
    {
        echo "Executing Mysql database\n";
    }

    public function createColumn()
    {
        echo "Creating column in Mysql database\n";
    }

    public function alterColumn()
    {
        echo "Altering column in Mysql database\n";
    }

    public function dropColumn()
    {
        echo "Dropping column in Mysql database\n";
    }
}
