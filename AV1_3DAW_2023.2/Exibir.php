<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <title>Exibir</title>
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
            h1 {
                text-align: center;
            }
            h4 {
                text-align: center;
                margin-left: -80px;
            }

        </style>
    </head>
    <body>
    <h1>Exibindo produtos</h1>
    <?php
     $encontrado = false;
    $arq = fopen("produtos.csv","r");
    $prod = fgetcsv($arq, 200, ",");

    if ($arq !== FALSE) {
        echo "<table>";
        echo "<h4>"."$prod[0]"."&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;"//isso é para fazer tabulação
            ."$prod[1]".
            "&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;"."$prod[2]"."</h4>";
        while (($prod = fgetcsv($arq,200, ",")) !== FALSE) {
                echo "<tr>";
                echo "<td>";
                echo "<form action=".$_SERVER['PHP_SELF']." onsubmit='window.location.reload()' method='POST'>";
                echo "<input type='hidden' name='id' value='" . $prod[0] . "'>";
                echo "<input type='text' name='idM' value='" . $prod[0] . "'disabled>";
                echo "<input type='text' name='nome' value='" . $prod[1] . "'>";
                echo "R$<input type='text' name='valor' value='" . $prod[2] . "'>";
                echo "&emsp;";
                echo "<input type='submit' name='alterar' value='Alterar'>";
                echo "&emsp;";
                echo "<input type='submit' name='excluir' value='Excluir'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        echo "</table>";
        }
        fclose($arq);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["alterar"])) {
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $preco = $_POST["valor"];
        alterar($id, $nome, $preco);
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["excluir"])) {
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $preco = $_POST["valor"];
        excluir($id, $nome, $preco);
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
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
    <a href="Incluir.php">Incluir</a>
    <br><br>
    <a href="Buscar.php">Buscar</a>
    <br><br>
    </body>

</html>