<?php

namespace app\core;

use app\core\Application;
use PDO;

abstract class Model {

    abstract public static function tableName(): string;
    abstract public static function tableColumns(): array;
    abstract public static function rules(): array;

    public static function prepare($sql) {
        return Application::$app->db->pdo->prepare($sql);
    }

    public static function getLastId() {
        return Application::$app->db->pdo->lastInsertId();
    }

    public function __construct($data = []) {
        foreach($data as $key => $value) {
            if(property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function delete() {
        if ($this->id !== null) {
            $tableName = $this->tableName();
            $sql = "DELETE FROM $tableName WHERE id=:id";
            $statement = self::prepare($sql);
            $statement->bindValue(":id", $this->id);
            $status = $statement->execute();
    
            if (!$status) {
                $errorInfo = $statement->errorInfo();
                $errorMsg = $errorInfo[2];
                throw new Exception($errorMsg, 500);
            }

            $this->id = null;
        }
    }

    public static function findById($id) {
        $object = null;
        $tableName = static::tableName();
        $sql = "SELECT * FROM $tableName WHERE id=:id";
        $statement = self::prepare($sql);
        $statement->bindValue(":id", $id);
        $status = $statement->execute();
    
        if (!$status) {
            $errorInfo = $statement->errorInfo();
            $errorMsg = $errorInfo[2];
            throw new Exception($errorMsg, 500);
        }

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row !== false) {
            $object = new static($row);
        }

        return $object;
    }

    public static function findAll() {
        $objects = [];
        $tableName = static::tableName();
        $sql = "SELECT * FROM $tableName";
        $statement = self::prepare($sql);
        $status = $statement->execute();
    
        if (!$status) {
            $errorInfo = $statement->errorInfo();
            $errorMsg = $errorInfo[2];
            throw new Exception($errorMsg, 500);
        }

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $objects[] = new static($row);
        }

        return $objects;
    }

    public function save() {
        $tableName = $this->tableName();
        $tableColumns = $this->tableColumns();

        if ($this->id === null) {
            unset($tableColumns["id"]);
            $params = array_map(fn($attr) => ":$attr", $tableColumns);
            $sql = "INSERT INTO $tableName (" . implode(",", $tableColumns) . ") " .
                   "VALUES (" . implode(",", $params) . ")";
        }
        else {
            $sql = "UPDATE $tableName SET ";
            foreach ($tableColumns as $tableColumn) {
                $sql .= "$tableColumn=:$tableColumn,";
            }
            $sql = rtrim($sql, ",");
            $sql .= " WHERE id=:id";
        }
        $statement = self::prepare($sql);
        foreach ($tableColumns as $tableColumn) {
            $statement->bindValue(":$tableColumn", $this->{$tableColumn});
        }
        $status = $statement->execute();

        if (!$status) {
            $errorInfo = $statement->errorInfo();
            $errorMsg = $errorInfo[2];
            throw new Exception($errorMsg, 500);
        }

        if ($this->id === null) {
            $this->id = self::getLastId();
        }
    }
}