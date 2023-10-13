<?php declare(strict_types=1);

final class doProperty {
    public string $dbNamespace;
    public string $apiNamespace;
    private $defaultValue;
    private $valType;
    private $value = null;

    public function __construct($db, $api, $defaultValue, $valType) {
        $this->dbNamespace = $db;
        $this->apiNamespace = $api;
        $this->defaultValue = $defaultValue;
        $this->valType = $valType;
    }

    public function SetValue($val) {
        $this->value = $val;
    }

    public function GetValue() {
        if($this->value != null) {
            return $this->value;
        } else {
            return $this->defaultValue;
        }
    }

    public function GetType() {
        return $this->valType;
    }
}
