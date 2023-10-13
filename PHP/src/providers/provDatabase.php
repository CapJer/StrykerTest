<?php declare(strict_types=1);
class provDatabase
{
    private ?\PDO $dbConnection = null;

    public function __construct()
    {
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');
        $db = getenv('DB_DATABASE');
        $user = getenv('DB_USERNAME');
        $pass = getenv('DB_PASSWORD');

        if (is_string($user)) {
            try {
                $this->dbConnection = new \PDO(
                    "mysql:host=$host;port=$port;charset=utf8;dbname=$db",
                    $user,
                    $pass
                );
            } catch (\PDOException $e) {
                exit($e->getMessage());
            }
        }
    }

    public function getConnection(): ?\PDO
    {
        return $this->dbConnection;
    }
}
