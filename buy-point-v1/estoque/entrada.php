<?php
require_once __DIR__.'/../config/init.php';require_once __DIR__.'/../auth/verificar.php';
$produtos=$pdo->query("SELECT id,codigo,nome,estoque FROM produtos WHERE ativo=1 ORDER BY nome")->fetchAll();$erro='';
if($_SERVER['REQUEST_METHOD']==='POST'){ $pid=(int)$_POST['produto_id'];$q=(float)$_POST['quantidade'];$obs=trim($_POST['observacao']??'');
try{ $pdo->beginTransaction();$s=$pdo->prepare("SELECT estoque FROM produtos WHERE id=? AND ativo=1 FOR UPDATE");$s->execute([$pid]);$p=$s->fetch();
if(!$p||$q<=0||(False))throw new RuntimeException('Quantidade inválida ou estoque insuficiente.');
$pdo->prepare("UPDATE produtos SET estoque=estoque+? WHERE id=?")->execute([$q,$pid]);
$pdo->prepare("INSERT INTO movimentacoes_estoque(produto_id,usuario_id,tipo,quantidade,observacao) VALUES(?,?,?,?,?)")->execute([$pid,$_SESSION['usuario_id'],'ENTRADA',$q,$obs]);
$pdo->commit();header('Location:index.php');exit;}catch(Throwable $e){if($pdo->inTransaction())$pdo->rollBack();$erro=$e->getMessage();}}
?>
<!doctype html><html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Entrada de estoque</title><link rel="stylesheet" href="../assets/css/style.css"></head><body><?php include __DIR__.'/../partials/menu.php';?><main class="main"><h1>Entrada de estoque</h1><?php if($erro):?><div class="alert danger"><?=htmlspecialchars($erro)?></div><?php endif;?><div class="panel"><form method="post">
<label>Produto<select name="produto_id" required><option value="">Selecione...</option><?php foreach($produtos as $p):?><option value="<?=$p['id']?>"><?=htmlspecialchars($p['codigo'].' - '.$p['nome'].' | estoque: '.$p['estoque'])?></option><?php endforeach;?></select></label>
<label>Quantidade<input type="number" name="quantidade" min="0.01" step="0.01" required></label><label>Observação<textarea name="observacao"></textarea></label>
<div class="actions"><a class="btn" href="index.php">Cancelar</a><button class="btn primary">Registrar entrada</button></div></form></div></main></body></html>