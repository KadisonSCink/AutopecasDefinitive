<?php 
    include 'conexao.php';
    // $sql consulta todos os registros de clientes
    $sql = "SELECT * FROM clientes";
    $result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="styletabelas.css">
</head>
<body>
    <div>
        <h1>Lista de Clientes</h1>
        <h3>Caso tenha pedidos vinculados a um cliente e exclui-lo, os pedidos serão CANCELADOS.</h3>
        <table>
            <thead>
                <tr>
                    <th>ID-cliente</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Endereco</th>
                    <th>...</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($user_data = $result->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>";
                        echo "<td>" . $user_data['id_cliente'] . "</td>";
                        echo "<td>" . $user_data['nome'] . "</td>";
                        echo "<td>" . $user_data['email'] . "</td>";
                        echo "<td>" . $user_data['telefone'] . "</td>";
                        echo "<td>" . $user_data['endereco'] . "</td>";
                        echo "<td><a href='remover_cliente.php?id_cliente=" . $user_data['id_cliente'] . "'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-person-dash' viewBox='0 0 16 16'>
                        <path d='M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M11 12h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m0-7a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4'/>
                        <path d='M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z'/>
                        </svg></a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>