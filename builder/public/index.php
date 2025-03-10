<?php
require('../vendor/autoload.php');

use App\MySQLQueryBuilder;
use App\LiteralQueryBuilder;

echo "=== Tests du MySQLQueryBuilder ===\n";

# TODO: Creer un QueryBuilder
# Ecrire une requête en chainant des methodes
# Afficher la requête

// Création d'une instance du Query Builder
$queryBuilder = new MySQLQueryBuilder();

// Test 1: Requête simple
$query1 = $queryBuilder
    ->select(['name', 'email'])
    ->from('users')
    ->where('age > 18')
    ->getSQL();

echo "Test 1 - Requête simple:\n";
echo $query1 . "\n\n";

// Reset pour une nouvelle requête
$queryBuilder->reset();

// Test 2: Requête plus complexe
$query2 = $queryBuilder
    ->select(['products.name', 'categories.name as category', 'products.price'])
    ->from('products')
    ->where('products.price > 100')
    ->where('products.stock > 0')
    ->orderBy('products.price', 'DESC')
    ->limit(5)
    ->getSQL();

echo "Test 2 - Requête complexe:\n";
echo $query2 . "\n\n";

echo "\n=== Tests du LiteralQueryBuilder ===\n";

// Création d'une instance du Literal Query Builder
$literalBuilder = new LiteralQueryBuilder();

// Test 1: Requête simple en français
$literal1 = $literalBuilder
    ->select(['nom', 'email'])
    ->from('utilisateurs')
    ->where('age > 18')
    ->getSQL();

echo "Test 1 - Description en français (requête simple):\n";
echo $literal1 . "\n\n";

// Reset pour une nouvelle requête
$literalBuilder->reset();

// Test 2: Requête complexe en français
$literal2 = $literalBuilder
    ->select(['produits.nom', 'categories.nom en tant que catégorie', 'produits.prix'])
    ->from('produits')
    ->where('produits.prix > 100')
    ->where('produits.stock > 0')
    ->orderBy('produits.prix', 'DESC')
    ->limit(5)
    ->getSQL();

echo "Test 2 - Description en français (requête complexe):\n";
echo $literal2 . "\n\n";