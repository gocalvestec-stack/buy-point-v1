<?php
require_once __DIR__.'/config/init.php';
if (!empty($_SESSION['usuario_id'])) { header('Location: dashboard.php'); exit; }
$erro=$_SESSION['login_erro']??''; unset($_SESSION['login_erro']);
?>
<!doctype html><html lang="pt-BR"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>BUY POINT - Login</title><link rel="icon" href="assets/favicon.svg" type="image/svg+xml"><link rel="stylesheet" href="assets/css/style.css">
</head><body class="login-page"><div class="login-card">
<div class="brand"><span>BUY</span> POINT</div><p class="muted">Sistema de gestão</p>
<?php if($erro):?><div class="alert danger"><?=htmlspecialchars($erro)?></div><?php endif;?>
<form action="autenticar.php" method="post">
<label>Usuário ou e-mail</label><input name="login" required autocomplete="username" autofocus>
<label>Senha</label><input type="password" name="senha" required autocomplete="current-password">
<label class="check"><input type="checkbox" name="lembrar" value="1"> Lembrar login</label>
<button class="btn primary full">ENTRAR</button></form><div class="login-footer">BUY POINT V1</div>
</div></body></html>