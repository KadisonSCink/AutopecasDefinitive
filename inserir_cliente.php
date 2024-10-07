<?php
    include 'conexao.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obter dados do formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $endereco = $_POST['endereco'];

        //aqui, consulta pra saber se o email digitado já foi usado
        $consultaEmail =  "SELECT id_cliente FROM clientes WHERE email = ?";
        $consulta = $conn->prepare($consultaEmail);
        $consulta->bindParam(1, $email);
        $consulta->execute();

        //se o numero de linha com esse email for maior que zero, Dá erro.
        if ($consulta->rowCount() > 0) {
            //Infoma que o email já está sendo usado
            echo "<h1 style='color: #FF5733; text-align: center;'>Este Email já está em uso!</h1><p style='text-align: center;'>Por favor, use OUTRO.</p>";
            echo "<a href='index_inserir_cliente.html'style='text-decoration: none; padding: 10px 20px; background-color: #28A745; color: white; border-radius: 5px;'>VOLTAR</a>";
            echo "<script>alert('Email já cadastrado')</script>";
            
        }
        else{
            //o $sql recebe a consulta, e logo após isso, as informações são inseridas
            $sql = "INSERT INTO clientes(nome, email, telefone, endereco) VALUES (?,?,?,?)";
            $in = $conn->prepare($sql);
            $in->bindParam(1, $nome);
            $in->bindParam(2, $email);
            $in->bindParam(3, $telefone);
            $in->bindParam(4, $endereco);
            $in->execute();

            //Infoma que Deu certo
            echo "<h1 style='color: #5cb85c; text-align: center;'>Cliente Cadastrado com sucesso!</h1><p style='text-align: center;'>Deseja cadastrar outro?</p>";
            echo "<a href='index_inserir_cliente.html'style='text-decoration: none; padding: 10px 20px; background-color: #28A745; color: white; border-radius: 5px;'>Cadastrar outro cliente</a>";
            echo "<script>alert('Cliente Cadastrado!')</script>";
        }
    }
?>
