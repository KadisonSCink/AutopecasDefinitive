<?php 
    include 'conexao.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Este bloco será executado se o formulário foi enviado via POST
        $id_cliente = $_POST['cliente'];
        $id_peca = $_POST['peca'];
        $quantidade = $_POST['quantidade'];
        
        // Obter o preço da peça selecionada
        $sqlPreco = "SELECT preco FROM pecas WHERE id_peca = ?";
        $stmt = $conn->prepare($sqlPreco);
        $stmt->bindParam(1, $id_peca);
        $stmt->execute();
        $precoPeca = $stmt->fetchColumn(); //precopeca recebe o preço da peca, esse fetchcolumn é porque já se espera que na consulta só tenha 1 coluna já que é só preço.
    
        //Seleciona a quantidade estoque da peca pedida
        $select = "SELECT quantidade_estoque FROM pecas WHERE id_peca = ?";
        $testaSelect = $conn->prepare($select);
        $testaSelect->bindParam(1, $id_peca);
        $testaSelect->execute();

        //Pegando a quantidade de estoque
        $pegaQtd = $testaSelect->fetch(PDO::FETCH_ASSOC);
        $qtdEstoque = $pegaQtd['quantidade_estoque'];
        
        //verificar se tem estoque para o pedido
        if($qtdEstoque < $quantidade){
            echo "<h1 style='color: red; text-align: center;'>Quantidade solicitada é maior que o estoque disponível!</h1>";
            echo "<p style='text-align: center;'>Estoque disponível: $qtdEstoque</p>";
            echo "<p style='text-align: center;'><a href='index_inserir_pedido.php' style='text-decoration: none; padding: 10px 20px; background-color: #dc3545; color: white; border-radius: 5px;'>Voltar e corrigir pedido</a></p>";
            exit;
        }else{
            //atualiza o estoque retirando oque já está em pedido
            $novaQtd = $qtdEstoque - $quantidade;
            $sqlquantidade = "UPDATE pecas SET quantidade_estoque = ? WHERE id_peca = ?";
            $atualiza_estoque = $conn->prepare($sqlquantidade);
            $atualiza_estoque->bindParam(1, $novaQtd);//de fato atualiza a quantidade
            $atualiza_estoque->bindParam(2, $id_peca);//pra garantir que a peca modificada seja a certa.
            $atualiza_estoque->execute();//executa tudo

            // Calcular o valor total
            $valor_total = $precoPeca * $quantidade;

            // Inserir o pedido na tabela pedidos
            $sqlPedido = "INSERT INTO pedidos (id_cliente, data_pedido, valor_total, id_peca, quantidade) VALUES (?, NOW(), ?, ?, ?)"; // o now é pra inserir a data e horas
            $stmtPedido = $conn->prepare($sqlPedido);
            $stmtPedido->bindParam(1, $id_cliente);
            $stmtPedido->bindParam(2, $valor_total);
            $stmtPedido->bindParam(3, $id_peca);
            $stmtPedido->bindParam(4, $quantidade);
            
            //sVerifica se ocorreu bem e inseriu
            if ($stmtPedido->execute()) {
                echo "<h1 style='color: #5cb85c; text-align: center;'>PEDIDO REGISTRADO COM SUCESSO</h1><p style='text-align: center;'>Deseja registrar outro?</p>";
                echo "<a href='index_inserir_pedido.php'style='text-decoration: none; padding: 10px 20px; background-color: #28A745; color: white; border-radius: 5px;'>Registrar outro pedido</a>";
                echo "<script>alert('Pedido Registrado!')</script>";
            } else {
                echo "Erro ao inserir o pedido.";
            }
        }
    }
?>
