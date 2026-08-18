<aside class="sidebar"><div class="brand"><span>BUY</span> POINT</div><nav>
<a href="dashboard.php">🏠 Dashboard</a><a href="produtos/index.php">📦 Produtos</a>
<a href="estoque/index.php">📊 Estoque</a><a href="estoque/movimentacoes.php">🔄 Movimentações</a>
<?php if(($_SESSION['usuario_perfil']??'')==='ADMIN'):?><a href="usuarios/index.php">👥 Usuários</a><?php endif;?>
<a href="logout.php">🚪 Sair</a></nav></aside>