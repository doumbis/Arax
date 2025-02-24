<?

namespace Arax\Core\Driver;

abstract class  DriverAdapter
{

    abstract public function connect();
    abstract public function query(string $sql, $params = []);
    abstract public function close();
    abstract public function getType(int $type): string;

    abstract public function fetch(string $sql, $params = []);
    abstract public function insert(string $sql, $params = []);
    abstract public function update(string $sql, $params = []);
    abstract public function delete(string $sql, $params = []);
    abstract public function createTable();
    abstract public function createColumn(string $name, int $type, int $length, int $precision, bool $nullable, $defaultValue): string;
}
