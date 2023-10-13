<?php declare(strict_types=1);
require __DIR__ . "/doProperty.php";
use http\QueryString;

final class doBase {
    protected array $properties = Array();

    public function __construct() {
        $this->properties["ObjectKey"] = new doProperty("OBJECT_KEY", "ObjectKey", null, \PDO::PARAM_INT);
        $this->properties["CreationDate"] =  new doProperty("CREATION_DT", "CreationDate", date('Y-m-d H:i:s'), \PDO::PARAM_STR);
        $this->properties["ModificationDate"] =  new doProperty("MODIFICATION_DT", "ModificationDate", date('Y-m-d H:i:s'), \PDO::PARAM_STR);
        $this->properties["RecState"] =  new doProperty("REC_STATE", "RecState", 1, \PDO::PARAM_INT);
    }

    public function GetPropertiesArray(\PDOStatement $statement, bool $isUpdating = false): void {
        foreach ($this->properties as $val) {
            if ($val->dbNamespace != "CREATION_DT" && $val->dbNamespace != "REC_STATE" && $isUpdating) {
                $statement->bindValue(':' . $val->dbNamespace, $val->GetValue(), $val->GetType());
            } else if (!$isUpdating) {
                $statement->bindValue(':' . $val->dbNamespace, $val->GetValue(), $val->GetType());
            }
        }
    }

    public function ConvertToDBData($input) {
        foreach ($this->properties as $val) {
            if($input[$val->apiNamespace] != null) {
                $val->SetValue(urldecode($input[$val->apiNamespace]));
            }
        }
    }

    public function FillFromDB(array $dbData) {
        foreach($this->properties as $val){
            $val->SetValue($dbData[$val->dbNamespace]);
        }
    }

    public function AsJSONObject() {
        $arr = Array();
        foreach ($this->properties as $val) {
            $arr[$val->apiNamespace] = $val->GetValue();
        }
        return $arr;
    }
}

