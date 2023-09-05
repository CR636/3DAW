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
            h4 {
                text-align: center;
            }
        </style>
    </head>
    <body>
    <h4>Nome&emsp;Preço&emsp;Descrição</h4>
    <?php
    $linhas = file("produtos.csv");
    echo "<table>";
    foreach ($linhas as $linha) {
        echo "<tr>";

        $colunas = explode(";", $linha);
        foreach ($colunas as $coluna) {
            echo "<td>" . $coluna . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    ?>
    <br><br><br>
    <button onclick="window.location.href='Incluir.php'">Voltar para Incluir</button>
    </body>

