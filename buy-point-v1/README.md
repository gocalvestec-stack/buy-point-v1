# BUY POINT V1

Sistema PHP + MySQL com login, painel administrativo, usuários, produtos, estoque, entradas, saídas e histórico.

## Requisitos
PHP 8+ e MySQL/MariaDB com PDO MySQL.

## Instalação
1. Importe `banco/banco.sql` no MySQL.
2. Configure `config/database.php` ou DB_HOST, DB_NAME, DB_USER e DB_PASS.
3. Publique a pasta em um servidor PHP.
4. Abra `login.php`.

## Acesso inicial
Usuário: `admin`
Senha: `Admin@123`

Troque a senha em produção.

Esta é uma V1 funcional/base. Para produção, adicione CSRF, recuperação de senha, permissões por módulo, auditoria, paginação e configuração de ambiente.
