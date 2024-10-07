<?php
    if(!empty($_GET['id_pedido']) && !empty($_GET['id_peca'])){
        include 'conexao.php';
        $id = $_GET['id_pedido'];
        $sqlSelect = "SELECT * FROM pedidos WHERE id_pedido = $id";
        $resultado = $conn->prepare($sqlSelect);
        $resultado->execute();

        $id_peca = $_GET['id_peca'];
        
        //puxando a quantidade
        $QtdEstoque = $resultado->fetch(PDO::FETCH_ASSOC);
        $quantidade = $QtdEstoque['quantidade'];

        if($resultado->rowCount() > 0){
            $sqlDelete = "DELETE FROM pedidos WHERE id_pedido = $id";
            $resultDelete = $conn->prepare($sqlDelete);
            $resultDelete->execute();

            //selecionar a quantidade dessa peca
            $qtdAdd = "SELECT quantidade_estoque FROM pecas WHERE id_peca = $id_peca";
            $testQtdAdd = $conn->prepare($qtdAdd);
            $testQtdAdd->execute();
            $obterEstoque = $testQtdAdd->fetch(PDO::FETCH_ASSOC);
            $estoqueAtual = $obterEstoque['quantidade_estoque'];

            $novaQtd = $estoqueAtual + $quantidade;

            //atualiza o estoque
            $update = "UPDATE pecas SET quantidade_estoque = $novaQtd  WHERE id_peca = $id_peca";
            $testUpdate = $conn->prepare($update);
            $testUpdate->execute();
            header("Location:index_remover_pedido.php");
        }else{
            echo "ERRO AO TENTAR EXCLUIR O PEDIDO";
        }

    }
?>