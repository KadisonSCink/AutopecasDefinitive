<?php 
    include 'conexao.php';

    $sql = "SELECT * FROM pecas";
    $result = $conn->query($sql);

    ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peças</title>
    <link rel="stylesheet" href="styletabelas.css">
</head>
<body>
    <div>
        <h1>Lista de Peças</h1>
        <table>
            <thead>
                <tr>
                    <th>ID-PEÇA</th>
                    <th>NOME</th>
                    <th>DESCRIÇÃO</th>
                    <th>PREÇO</th>
                    <th>ESTOQUE</th>
                    <th>...</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    while($user_data = $result->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>";
                        echo "<td>" . $user_data['id_peca'] . "</td>";
                        echo "<td>" . $user_data['nome'] . "</td>";
                        echo "<td>" . $user_data['descricao'] . "</td>";
                        echo "<td>" . $user_data['preco'] . "</td>";
                        echo "<td>" . $user_data['quantidade_estoque'] . "</td>";
                        echo "<td><a href='remover_peca.php?id_peca=" . $user_data['id_peca'] . "'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z'/><path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z'/></svg></a></td>";
                        echo "</tr>";
                    }
                    
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>