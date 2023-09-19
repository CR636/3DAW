<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <title>Exibir</title>
        <style>
            table{
                margin: auto;

            }
            button{
                margin-left: 50%;
                margin-right: 50%;
            }
            h4,h1 {
                text-align: center;
            }
        </style>
    </head>
    <body>
    <h1>Exibindo produtos</h1>
    <h4>Nome&emsp;Preço&emsp;Descrição</h4>
    <?php
    $linhas = file("produtos.csv");
    echo "<table>";
    foreach ($linhas as $linha) {
        echo "<tr>";

        $colunas = explode(",", $linha);
        foreach ($colunas as $coluna) {
            echo "<td>" . $coluna . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    ?>
    <br><br><br>
    <button onclick="window.location.href='Incluir.php'">Voltar para Incluir</button>
    <br><br>
    <button onclick="window.location.href='Buscar.php'">Buscar</button>
    <br><br>
    <button onclick="window.location.href='Alterar.php'">Alterar</button>
    <br><br>
    <button onclick="window.location.href='Excluir.php'">Excluir</button>
    </body>

</html>