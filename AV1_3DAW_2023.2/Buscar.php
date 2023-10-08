<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <title>Buscar</title>
    <style>
        a{
            margin: 45%;
            font-size:30px;
        }
        table{
            margin: auto;

        }
        button{
            margin-left: 50%;
            margin-right: 50%;
        }
        h1,p,h4 {
            text-align: center;
        }
        h4 {
            margin-left: -80px;
        }
        form{
            margin: auto;
        }
        #formulario {
            width: 320px;
            border: dotted 3px blue;
            margin: auto;
        }
        #botao {
            margin-left: 37%;
        }
    </style>
</head>
<body>
<h1>Formulário de busca</h1>
<form action="Buscar.php" id="formulario" method="POST">
    <fieldset style="border:0;" name="Produto">
        <label>ID do produto:
            <input type="text" id="id" name="id" placeholder="Digite o id do produto">
        </label><br><br>
        <input id="botao" type="submit" name="buscar" value="Buscar">
    </fieldset>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["buscar"])) {
    $id = $_POST["id"];
    buscar($id);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["alterar"])) {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $preco = $_POST["valor"];
    alterar($id, $nome, $preco);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["excluir"])) {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $preco = $_POST["valor"];
    excluir($id, $nome, $preco);
}

function buscar($id) {
    $encontrado = false;
    $dados = [];
    $arq = fopen("produtos.csv","r");
    $prod = fgetcsv($arq, 200, ",");
    $cabecalho = $prod;

    if ($arq !== FALSE) {
        while (($prod = fgetcsv($arq,200, ",")) !== FALSE) {
            if ($prod[0] == $id) {
                $dados = $prod;
                $encontrado = true;
            }
        }
        fclose($arq);
    }

    echo "<br>";
    if (!$encontrado) {
        echo "<p>O produto não foi encontrado no arquivo.</p>";
    } else {
        echo "<table>";
        echo "<h4>"."$cabecalho[0]"."&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;"//isso é para fazer tabulação
            ."$cabecalho[1]".
            "&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;"."$cabecalho[2]"."</h4>";
        echo "<tr>";
        echo "<td>";
        echo "<form action='Buscar.php' onsubmit='window.location.reload()' method='POST'>";
        echo "<input type='hidden' name='id' value='" . $dados[0] . "'>";
        echo "<input type='text' name='idM' value='" . $dados[0] . "'disabled>";
        echo "<input type='text' name='nome' value='" . $dados[1] . "'>";
        echo "R$<input type='text' name='valor' value='" . $dados[2] . "'>";
        echo "&emsp;";
        echo "<input type='submit' name='alterar' value='Alterar'>";
        echo "&emsp;";
        echo "<input type='submit' name='excluir' value='Excluir'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
    }
}
function excluir($id, $nome, $valor) {
    $encontrado = false;
    $dados = [];
    $arq = fopen("produtos.csv","r");
    if ($arq !== FALSE) {
        while (($prod = fgetcsv($arq,200, ",")) !== FALSE) {
            if ($prod[0] == $id && $prod[1] == $nome && $prod[2] == $valor) {
                $encontrado = true;
            } else {
                $dados[] = $prod;
            }
        }
        fclose($arq);
    }

    echo "<br>";
    if ($encontrado) {
        if(($arq = fopen("produtos.csv","w"))!== FALSE) {
            foreach ($dados as $linha){
                fputcsv($arq,$linha);
            }
            echo "<p>O produto foi Excluído do arquivo. </p>";
            fclose($arq);
        }
    } else {
        echo "<p>O produto não foi encontrado no arquivo.</p>";
    }
}
function alterar($id,$nome,$valor){
    $encontrado = false;
    $dados = [];
    $arq = fopen("produtos.csv", "r");
    if ($arq !== FALSE) {
        while (($prod = fgetcsv($arq, 200, ",")) !== FALSE) {
            if ($prod[0] == $id) {
                $encontrado = true;
                $prod[0] = $id;
                $prod[1] = $nome;
                $prod[2] = $valor;
            }
            $dados[] = $prod;
        }
        fclose($arq);
    }

    echo "<br>";
    if ($encontrado) {
        if (($arq = fopen("produtos.csv", "w")) !== FALSE) {
            foreach ($dados as $linha) {
                fputcsv($arq, $linha);
            }
            echo "<p>O produto foi alterado </p>";
            fclose($arq);
        }
    } else {
        echo "<p>O produto não foi encontrado no arquivo.</p>";
    }
}
?>

<br><br><br>
<a href='Incluir.php'>Incluir</a>
<br><br>
<a href='Exibir.php'>Exibir</a>
<br><br>

</body>

</html>