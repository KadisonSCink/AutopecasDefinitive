<?php
    if(!empty($_GET['id_peca'])){
        include 'conexao.php';
        $id = $_GET['id_peca'];
        $sqlSelect = "SELECT * FROM pecas WHERE id_peca = $id";
        $resultado = $conn->prepare($sqlSelect);
        $resultado->execute();

        if($resultado->rowCount() > 0){
            $sqlDelete = "DELETE FROM pecas WHERE id_peca = $id";
            $resultDelete = $conn->prepare($sqlDelete);
            $resultDelete->execute();
            header("Location: index_remover_peca.php");
            
        }else{
            echo "ERRO AO TENTAR EXCLUIR A PEÇA";
        }

    }
?>