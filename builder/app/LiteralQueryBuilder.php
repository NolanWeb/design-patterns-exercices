<?php

namespace App;

class LiteralQueryBuilder implements QueryBuilderInterface
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
            throw new \InvalidArgumentException("La table est requise");
        }

        $phrases = [];
        
        // SELECT
        $phrases[] = 'Je sélectionne ' . (empty($this->fields) ? 'tous les champs' : implode(', ', $this->fields));
        
        // FROM
        $phrases[] = 'de la table ' . $this->table;
        
        // WHERE
        if (!empty($this->conditions)) {
            $phrases[] = 'où ' . implode(' et ', $this->conditions);
        }
        
        // ORDER BY
        if ($this->orderBy !== null) {
            $direction = $this->orderDirection === 'ASC' ? 'croissant' : 'décroissant';
            $phrases[] = 'trié par ' . $this->orderBy . ' en ordre ' . $direction;
        }
        
        // LIMIT
        if ($this->limit !== null) {
            $phrases[] = 'limité à ' . $this->limit . ' résultats';
        }
        
        return implode(', ', $phrases) . '.';
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
