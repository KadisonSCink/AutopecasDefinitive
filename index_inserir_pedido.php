<?php 
    include 'conexao.php';
    // pega clientes e peças para exibir no formulário
    $infcliente = "SELECT * FROM Clientes";
    $infpeca = "SELECT * FROM Pecas";
    $resultclient = $conn->query($infcliente);
    $resultpeca = $conn->query($infpeca);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inserir Pedido</title>
        <link rel="stylesheet" href="style3.css">
    </head>
    <body>
        <h2>Registrar Pedido</h2>
        <form action="inserir_pedido.php" method="post">
            <label for="Cliente">Cliente</label>
             <select name="cliente" required> <!--o required poderia ser POST, mas funciona -->
                <option value="">Selecione um cliente</option>
                <?php while ($cliente = $resultclient->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?php echo $cliente['id_cliente']; ?>">
                        <?php echo htmlspecialchars($cliente['nome']) . " - ID: " . $cliente['id_cliente']; ?>
                        <!-- htmlspecialchars: Essa função transforma caracteres especiais do HTML (como <, >, &, ", ') em suas representações de entidades HTML. 
                        MAS ELE NAO PRECISA SER USADO.-->
                    </option>
                <?php endwhile; ?>
            </select>
            <label for="Produto">Produto</label>
            <select name="peca" required>
                <option value="">Selecione uma peça</option>
                <?php while ($peca = $resultpeca->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?php echo $peca['id_peca'] ; ?>">
                        <?php echo htmlspecialchars($peca['nome'] . " - R$ " . number_format($peca['preco'], 2, ',', '.')); ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <label for="Quantidade">Quantidade</label>
            <input type="number" name="quantidade" min="1" required>

            <br><br>
            <input type="submit" value="Finalizar Pedido">
        </form>
        <div class="container">
            <a href="index.html" class="btn-menu">Voltar ao Menu</a>
        </div>
    </body>
</html>