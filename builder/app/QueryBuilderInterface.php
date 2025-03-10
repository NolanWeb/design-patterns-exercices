<?php

# TODO: Créer une classe QueryBuilder en utilisant le design pattern Builder

namespace App;

interface QueryBuilderInterface
{
    public function select(array $fields): self;
    public function from(string $table): self;
    public function where(string $condition): self;
    public function limit(int $limit): self;
    public function orderBy(string $field, string $direction = 'ASC'): self;
    public function getSQL(): string;
    public function reset(): void;
}