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
            h1 {
                text-align: center;
            }
            p {
                text-align: center;
            }
        </style>
    </head>
    <body>
    <h1>Exibindo produtos</h1>
    <?php
    /*$linhas = file("produtos.csv");
    echo "<table>";
    foreach ($linhas as $linha) {
        echo "<tr>";

        $colunas = explode(",", $linha);
        foreach ($colunas as $coluna) {
            echo "<td>" . $coluna . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";*/
    $arq = fopen("produtos.csv","r");
    if ($arq !== FALSE) {
        while (($prod = fgetcsv($arq,200, ",")) !== FALSE) {
                echo "<br>";
                echo "<p><strong>Nome:</strong>".$prod[0]."<br><strong>Preço:</strong>".$prod[1]."<br><strong>Descrição:</strong>".$prod[2]."</p>";
            }
        }
    fclose($arq);
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