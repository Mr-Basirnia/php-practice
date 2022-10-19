<?php

namespace App\Database;

use PDO;

class PDOQueryBuilder
{
    protected PDO $pdo;
    protected string $table;
    protected array $conditions = [];
    protected array $values = [];

    /**
     * The function takes a PDODatabaseConnection object as an argument, and sets the $pdo property to the PDO connection object
     *
     * @param PDODatabaseConnection $pdo This is the PDO connection object.
     */
    public function __construct(PDODatabaseConnection $pdo)
    {
        $this->pdo = $pdo->getConnection();
    }

    /**
     * This function sets the table name to be used in the query.
     *
     * @param string $table The table you want to select from.
     *
     * @return PDOQueryBuilder The PDOQueryBuilder object.
     */
    public function table(string $table): PDOQueryBuilder
    {
        $this->table = $table;
        return $this;
    }

    /**
     * It takes an array of data, creates a placeholder for each value, creates a comma separated list of fields, creates a
     * comma separated list of placeholders, creates a SQL statement, and executes the statement
     *
     * @param array $data an array of data to be inserted into the database.
     *
     * @return int The last inserted id.
     */
    public function create(array $data): int
    {
        $placeholder = [];
        foreach ($data as $ignored) {
            $placeholder[] = '?';
        }

        $placeholder = implode(',', $placeholder);
        $fields = implode(',', array_keys($data));

        $sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$placeholder})";
        $this->pdo->prepare($sql)->execute(array_values($data));

        return intval($this->pdo->lastInsertId());
    }

    public function where(string $colum, string $value): PDOQueryBuilder
    {
        $this->conditions[] = "{$colum}=?";
        $this->values[] = $value;

        return $this;
    }

    public function update(array $data): int
    {
        $fields = [];
        foreach ($data as $colum => $value) {
            $fields[] = "{$colum}='{$value}'";
        }
        $fields = implode(',', $fields);
        $conditions = implode(' and ', $this->conditions);

        $result = $this->pdo->prepare("UPDATE {$this->table} SET {$fields} WHERE {$conditions}");
        $result->execute($this->values);

        return $result->rowCount();
    }

    public function delete(): int
    {
        $conditions = implode(' and ', $this->conditions);

        $result = $this->pdo->prepare("DELETE FROM {$this->table} WHERE {$conditions}");
        $result->execute($this->values);

        return $result->rowCount();
    }

    public function get(array $columns = ['*']): array
    {
        $conditions = implode(' and ', $this->conditions);
        $columns = implode(',', $columns);
        $sql = "SELECT {$columns} FROM {$this->table} WHERE {$conditions}";

        $result = $this->pdo->prepare($sql);
        $result->execute($this->values);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function truncateALlTables()
    {
        $tables = $this->pdo->prepare('SHOW TABLES');
        $tables->execute();

        foreach ($tables->fetchAll(PDO::FETCH_COLUMN) as $table) {
            $this->pdo->prepare('TRUNCATE TABLE `' . $table . '`')->execute();
        }
    }

    public function beginTransaction()
    {
        $this->pdo->beginTransaction();
    }

    public function rollBack()
    {
        $this->pdo->rollBack();
    }
}