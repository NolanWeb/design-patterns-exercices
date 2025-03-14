<?php

namespace App;

class MySQLQueryBuilder implements QueryBuilderInterface
{
    private array $fields = [];
    private string $table = '';
    private array $conditions = [];
    private ?int $limit = null;
    private ?string $orderBy = null;
    private string $orderDirection = 'ASC';

    public function select(array $fields): self
    {
        $this->fields = $fields;
        return $this;
    }

    public function from(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function where(string $condition): self
    {
        $this->conditions[] = $condition;
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    public function orderBy(string $field, string $direction = 'ASC'): self
    {
        $this->orderBy = $field;
        $this->orderDirection = strtoupper($direction);
        return $this;
    }

    public function getSQL(): string
    {
        if (empty($this->table)) {
            throw new \InvalidArgumentException("Table name is required");
        }

        $query = [];
        
        // SELECT
        $query[] = 'SELECT ' . (empty($this->fields) ? '*' : implode(', ', $this->fields));
        
        // FROM
        $query[] = 'FROM ' . $this->table;
        
        // WHERE
        if (!empty($this->conditions)) {
            $query[] = 'WHERE ' . implode(' AND ', $this->conditions);
        }
        
        // ORDER BY
        if ($this->orderBy !== null) {
            $query[] = 'ORDER BY ' . $this->orderBy . ' ' . $this->orderDirection;
        }
        
        // LIMIT
        if ($this->limit !== null) {
            $query[] = 'LIMIT ' . $this->limit;
        }
        
        return implode(' ', $query);
    }

    public function reset(): void
    {
        $this->fields = [];
        $this->table = '';
        $this->conditions = [];
        $this->limit = null;
        $this->orderBy = null;
        $this->orderDirection = 'ASC';
    }
}