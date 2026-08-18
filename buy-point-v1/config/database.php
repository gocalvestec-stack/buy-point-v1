<?php
declare(strict_types=1);
$host = getenv('DB_HOST') ?: 'localhost';
$db = getenv('DB_NAME') ?: 'buy_point';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$dsn = "mysql:host={$host};dbname={$db};charset=utf8mb4";
$options = [
 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
 PDO::ATTR_EMULATE_PREPARES => false,
];
try { $pdo = new PDO($dsn, $user, $pass, $options); }
catch (PDOException $e) { http_response_code(500); exit('Erro ao conectar ao banco de dados.'); }
