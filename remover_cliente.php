<?php
    if(!empty($_GET['id_cliente'])){
        include 'conexao.php';
        $id = $_GET['id_cliente'];

        $sqlSelect = "SELECT * FROM clientes WHERE id_cliente = $id";
        $resultado = $conn->prepare($sqlSelect);
        $resultado->execute();

        // Verifica se o pedido existe
        $sqlSelectPedido = "SELECT * FROM pedidos WHERE id_cliente = $id";
        $stmtSelectPedido = $conn->prepare($sqlSelectPedido);
        $stmtSelectPedido->execute();

        if($resultado->rowCount() > 0){

            // Para cada pedido, atualiza o estoque da peça 
            while($pedido = $stmtSelectPedido->fetch(PDO::FETCH_ASSOC)){
                $id_peca = $pedido['id_peca'];
                $quantidade = $pedido['quantidade'];

                // Atualiza o estoque, restaurando a quantidade da peça
                $sqlUpdateEstoque = "UPDATE pecas SET quantidade_estoque = quantidade_estoque + $quantidade WHERE id_peca = $id_peca";
                $stmtUpdateEstoque = $conn->prepare($sqlUpdateEstoque);
                $stmtUpdateEstoque->execute();
            }
            //só pra remover os pedidos do cliente à ser deeletado
            $sqlDeletePedidos = "DELETE FROM pedidos WHERE id_cliente = $id";
            $resultDeletePedidos = $conn->prepare($sqlDeletePedidos);
            $resultDeletePedidos->execute();
            
            //deletar de fato o cliente
            $sqlDelete = "DELETE FROM clientes WHERE id_cliente = $id";
            $resultDelete = $conn->prepare($sqlDelete);
            $resultDelete->execute();
            header("Location: index_remover_cliente.php");
            
        }else{
            echo "ERRO AO TENTAR EXCLUIR O CLIENTE";
        }

    }
?>