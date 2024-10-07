<?php
    include 'conexao.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obter dados do formulário
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $quantidade_estoque = $_POST['quantidade_estoque'];
        
        // Verificar se a peça já existe
        $sql_verifica = "SELECT * FROM pecas WHERE nome = ?"; //Isso significa: "Selecione todas as colunas da tabela pecas onde o nome seja igual ao valor fornecido".
        $verifica = $conn->prepare($sql_verifica);
        $verifica->bindParam(1, $nome); //aqui ele fornece o valor de nome
        $verifica->execute();

        //pecaexistente recebe se tem ou nao outra peca com esse nome, se sim é TRUE
        $peca_existente = $verifica->fetch(PDO::FETCH_ASSOC);

        if ($peca_existente) {
            //atualiza quantidade
            $nova_quantidade = $peca_existente['quantidade_estoque'] + $quantidade_estoque;
            $sql_update = "UPDATE pecas SET quantidade_estoque = ? WHERE id_peca = ?";
            $update = $conn->prepare($sql_update);
            $update->bindParam(1, $nova_quantidade);//de fato atualiza a quantidade
            $update->bindParam(2, $peca_existente['id_peca']);//pra garantir que a peca modificada seja a certa.
            $update->execute();//executa tudo
            //deixar bonitin e mostrar que a peça foi cadastrada
            echo "<h1 style='color: #FF5733; text-align: center;'>Peça existente!</h1><p style='text-align: center;'>Estoque atualizado com sucesso!</p><p style='text-align: center;'>Cadastrar Outra?</p>";
            echo "<a href='index_inserir_peca.html'style='text-decoration: none; padding: 10px 20px; background-color: #28A745; color: white; border-radius: 5px;'>Cadastrar outra Peça</a>";
            echo "<script>alert('Peça existente!')</script>";

        }else {
            // Se a peça não existe, insere uma nova
            $sql = "INSERT INTO pecas(nome, descricao, preco, quantidade_estoque) VALUES (?,?,?,?)";
            $in = $conn->prepare($sql);
            $in->bindParam(1, $nome);
            $in->bindParam(2, $descricao);
            $in->bindParam(3, $preco);
            $in->bindParam(4, $quantidade_estoque);
            $in->execute();
            //deixar bonitin e mostrar que a peça foi cadastrada
            echo "<h1 style='color: #FF5733; text-align: center;'>Peça inserida com sucesso!</h1><p style='text-align: center;'>Deseja cadastrar outra?</p>";
            echo "<a href='index_inserir_peca.html'style='text-decoration: none; padding: 10px 20px; background-color: #28A745; color: white; border-radius: 5px;'>Cadastrar outra Peça</a>";
            echo "<script>alert('Peça cadastrada!')</script>";
        }

    }

?>