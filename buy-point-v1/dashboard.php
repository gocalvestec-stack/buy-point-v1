<?php
require_once __DIR__.'/config/init.php';require_once __DIR__.'/auth/verificar.php';
$total=(int)$pdo->query("SELECT COUNT(*) FROM produtos WHERE ativo=1")->fetchColumn();
$estoque=(float)$pdo->query("SELECT COALESCE(SUM(estoque),0) FROM produtos WHERE ativo=1")->fetchColumn();
$baixo=(int)$pdo->query("SELECT COUNT(*) FROM produtos WHERE ativo=1 AND estoque<=estoque_minimo")->fetchColumn();
$mov=$pdo->query("SELECT m.tipo,m.quantidade,m.criado_em,p.nome,u.nome usuario FROM movimentacoes_estoque m JOIN produtos p ON p.id=m.produto_id LEFT JOIN usuarios u ON u.id=m.usuario_id ORDER BY m.id DESC LIMIT 8")->fetchAll();
?>
<!doctype html><html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Dashboard</title><link rel="stylesheet" href="assets/css/style.css"></head><body>
<?php include __DIR__.'/partials/menu.php';?><main class="main"><h1>Dashboard</h1><p class="muted">Olá, <?=htmlspecialchars($_SESSION['usuario_nome'])?>.</p>
<div class="cards"><div class="card"><span>Produtos</span><strong><?=$total?></strong></div><div class="card"><span>Estoque total</span><strong><?=number_format($estoque,2,',','.')?></strong></div><div class="card"><span>Estoque baixo</span><strong><?=$baixo?></strong></div></div>
<div class="panel"><h2>Últimas movimentações</h2><table><thead><tr><th>Produto</th><th>Tipo</th><th>Quantidade</th><th>Usuário</th><th>Data</th></tr></thead><tbody>
<?php foreach($mov as $m):?><tr><td><?=htmlspecialchars($m['nome'])?></td><td><span class="tag <?=$m['tipo']==='ENTRADA'?'green':'red'?>"><?=$m['tipo']?></span></td><td><?=number_format($m['quantidade'],2,',','.')?></td><td><?=htmlspecialchars($m['usuario']??'-')?></td><td><?=date('d/m/Y H:i',strtotime($m['criado_em']))?></td></tr><?php endforeach;?>
<?php if(!$mov):?><tr><td colspan="5" class="muted">Nenhuma movimentação.</td></tr><?php endif;?></tbody></table></div></main></body></html>