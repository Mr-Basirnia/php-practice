<?php

namespace App\Database;

use PDO;
use PDOStatement;

class PDOQueryBuilder
{
    protected PDO $pdo;
    protected string $table;
    protected array $values = [];
    private $conditions;
    /**
     * @var bool|PDOStatement
     */
    private $statement;

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

        $this->values = array_values($data);
        $this->execute("INSERT INTO {$this->table} ({$fields}) VALUES ({$placeholder})");

        return (int)$this->pdo->lastInsertId();
    }

    /**
     * @param string $sql
     * @return void
     */
    private function execute(string $sql): void
    {
        $this->statement = $this->pdo->prepare($sql);
        $this->statement->execute($this->values);
        $this->values = [];
    }

    public function update(array $data): int
    {
        $fields = [];
        foreach ($data as $colum => $value) {
            $fields[] = "{$colum}='{$value}'";
        }
        $fields = implode(',', $fields);

        $this->execute("UPDATE {$this->table} SET {$fields} WHERE {$this->conditions}");

        return $this->statement->rowCount();
    }

    public function delete(): int
    {
        $this->execute("DELETE FROM {$this->table} WHERE {$this->conditions}");

        return $this->statement->rowCount();
    }

    public function find($id)
    {
        return $this->where('id', $id)->first();
    }

    public function first(array $columns = ['*'])
    {
        $data = $this->get($columns);
        return empty($data) ? null : $data[0];
    }

    public function get(array $columns = ['*']): array
    {
        $columns = implode(',', $columns);
        $sql = "SELECT {$columns} FROM {$this->table} WHERE {$this->conditions}";

        $this->execute($sql);
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function where(string $column, string $value): PDOQueryBuilder
    {
        if (is_null($this->conditions)) {
            $this->conditions = "{$column}=?";
        } else {
            $this->conditions .= " and {$column}=?";
        }

        $this->values[] = $value;

        return $this;
    }

    public function findBy(string $column, string $value)
    {
        return $this->where($column, $value)->first();
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