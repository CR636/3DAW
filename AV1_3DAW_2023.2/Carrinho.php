<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <title>Carrinho de Produtos</title>
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
            padding-right: 60px;
        }

    </style>
</head>
<body>
<h1>Carrinho de produtos</h1>

<?php

$arq = fopen("carrinho.csv", "r");
if ($arq !== FALSE) {

        echo "<table>";
        $prod = fgetcsv($arq, 200, ",");
        echo "<h4>"."$prod[1]"."&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;"//isso é para fazer tabulação
             ."$prod[2]".
             "&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;"."$prod[3]"."</h4>";
    while (($prod = fgetcsv($arq, 200, ",")) !== FALSE) {
        echo "<tr>";
        echo "<td>";
        echo "<form action='Carrinho.php' method='POST'>";
        echo "<input type='hidden' name='id' value='" . $prod[0] . "'>";
        echo "<input type='text' name='nome' value='" . $prod[1] . "'>";
        echo "<input type='text' name='quant' value='" . $prod[3] . "'>";
        echo "R$<input type='text' name='valor' value='" . $prod[2] . "'>";
        echo "<input type='submit' value='Excluir'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";

    }
    echo "</table>";
}

?>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $valor = $_POST["valor"];
    $quant = $_POST["quant"];

    excluir($id,$nome, $valor, $quant);
}

function excluir($id,$nome, $valor, $quant) {
    $encontrado = false;
    $dados = [];
    $arq = fopen("carrinho.csv","r");
    if ($arq !== FALSE) {
        while (($prod = fgetcsv($arq,200, ",")) !== FALSE) {
            if ($prod[0] == $id && $prod[1] == $nome && $prod[2] == $valor && $prod[3] == $quant) {
                $encontrado = true;
            } else {
                $dados[] = $prod;
            }
        }
        fclose($arq);
    }

    echo "<br>";
    if ($encontrado) {
        if(($arq = fopen("carrinho.csv","w"))!== FALSE) {
            foreach ($dados as $linha){
                fputcsv($arq,$linha);
            }
            echo "<p>O produto foi Excluído do Carrinho, Por faver clique no Botão Atualizar Carrinho. </p>";
            fclose($arq);
        }
    } else {
        echo "<p>O produto não foi encontrado no arquivo do Carrinho.</p>";
    }
}
?>

<br><br><br>
<a href='Carrinho.php'>Atualizar Carrinho</a>
    <br>
<a href='Produtos.php'>Voltar para Produtos</a>
</body>

</html>
