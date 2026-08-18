<?php
require_once __DIR__.'/config/init.php';
if($_SERVER['REQUEST_METHOD']!=='POST'){header('Location: login.php');exit;}
$login=trim((string)($_POST['login']??''));$senha=(string)($_POST['senha']??'');
if($login===''||$senha===''){$_SESSION['login_erro']='Preencha usuário e senha.';header('Location: login.php');exit;}
$s=$pdo->prepare("SELECT id,nome,usuario,email,senha,perfil,ativo FROM usuarios WHERE (usuario=? OR email=?) LIMIT 1");
$s->execute([$login,$login]);$u=$s->fetch();
if(!$u||!$u['ativo']||!password_verify($senha,$u['senha'])){$_SESSION['login_erro']='Usuário ou senha inválidos.';header('Location: login.php');exit;}
session_regenerate_id(true);
$_SESSION['usuario_id']=(int)$u['id'];$_SESSION['usuario_nome']=$u['nome'];$_SESSION['usuario_perfil']=$u['perfil'];
$pdo->prepare("UPDATE usuarios SET ultimo_login=NOW() WHERE id=?")->execute([$u['id']]);
if(!empty($_POST['lembrar']))setcookie('buy_point_login',$login,['expires'=>time()+2592000,'path'=>'/','secure'=>!empty($_SERVER['HTTPS']),'httponly'=>true,'samesite'=>'Lax']);
header('Location: dashboard.php');exit;
