<?php declare(strict_types=1);
class provDatabase
{
    private ?\PDO $dbConnection = null;

    public function __construct()
    {

        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $db = $_ENV['DB_DATABASE'];
        $user = $_ENV['DB_USERNAME'];
        $pass = $_ENV['DB_PASSWORD'];

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
