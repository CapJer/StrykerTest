<?php declare(strict_types=1);

class tblBase
{
    private $className;
    protected $db;
    protected $object;
    public $dbError;

    public function __construct($db, $className){
        $this->className = $className;
        $this->db = $db;
    }

    public function GetAll() {
        $res = Array();
        $statement = "SELECT * FROM " . $this->className . " WHERE REC_STATE = 1";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($result as $data){
                $this->object->FillFromDB($data);
                array_push($res, $this->object->AsJSONObject());
            }
            return $res;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function GetByKey($Key) {
        $res = Array();
        $statement = "SELECT * FROM " . $this->className . " WHERE REC_STATE = 1 AND OBJECT_KEY = " . $Key;

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($result as $data){
                $this->object->FillFromDB($data);
                array_push($res, $this->object->AsJSONObject());
            }
            return $res;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function GetByFilter(Array $filters, string $sql) {
        $res = Array();
        try {
            $statement = $this->db->query($sql);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($result as $data){
                $this->object->FillFromDB($data);
                array_push($res, $this->object->AsJSONObject());
            }
            return $res;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function Create(Array $input, string $sql) {
        $this->object->ConvertToDBData($input);
        try {
            $statement = $this->db->prepare($sql);
            $this->object->GetPropertiesArray($statement);
            $res = $statement->execute();
            if(!$res) {
                $this->dbError = print_r($statement->errorInfo());
            }
            return $res;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function Update(Array $input, string $sql) {
        $this->object->ConvertToDBData($input);
        try {
            $statement = $this->db->prepare($sql);
            $this->object->GetPropertiesArray($statement, true);
            $res = $statement->execute();
            if(!$res) {
                $this->dbError = print_r($statement->errorInfo());
            }
            return $res;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function Delete($key) {
        $statement = "UPDATE " . $this->className . " SET REC_STATE = 2 WHERE OBJECT_KEY = :Key;";

        try {
            $statement = $this->db->prepare($statement);
            $statement->bindValue(':Key', $key, \PDO::PARAM_INT);
            $statement->execute();
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}
