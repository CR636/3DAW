<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <title>Exibir-Produtos</title>
    <style>
        table{
            margin: auto;

        }
        a{
            margin: 40%;
            font-size:30px;
        }
        h1 {
            text-align: center;
        }
        p {
            text-align: center;
        }
        h4 {
            text-align: center;
        }
    </style>
</head>
<body>
<h1>Exibindo produtos</h1>
<?php

$arq = fopen("produtos.csv", "r");
if ($arq !== FALSE) {

        echo "<table>";
        $prod = fgetcsv($arq, 200, ",");
        echo "<h4>"."$prod[1]"."&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;"//isso é para fazer tabulação
             ."$prod[2]".
             "&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;"."QUANTIDADE"."</h4>";
    while (($prod = fgetcsv($arq, 200, ",")) !== FALSE) {
        echo "<tr>";
        echo "<td>";
        echo "<form action='Produtos.php' method='POST'>";
        echo "<input type='hidden' name='id' value='" . $prod[0] . "'>";
        echo "<input type='text' name='nome' value='" . $prod[1] . "'>";
        echo "R$<input type='text' name='valor' value='" . $prod[2] . "'>";
        echo "<input type='text' name='quant' placeholder='Digite a quantidade de produtos'>";
        echo "<input type='submit' value='Adicionar'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";

    }
    echo "</table>";
}
fclose($arq);
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $preco = $_POST["valor"];
    $quant = $_POST["quant"];
    $precoTotal = (int)$preco * (int)$quant;

    $arquivo = fopen("carrinho.csv", "a") or die("deu erro");

    $linhaId = $id.",";
    $linhaNome = $nome.",";
    $linhaPreco = $precoTotal.",";
    $quant = $quant."\n";

    fwrite($arquivo, $linhaId);
    fwrite($arquivo, $linhaNome);
    fwrite($arquivo, $linhaPreco);
    fwrite($arquivo, $quant);
    fclose($arquivo);
    echo "<p>Está Feito!</p>";
}
?>





<br><br><br>

<a href='Carrinho.php'>Ir para o Carrinho</a>

</body>

</html>