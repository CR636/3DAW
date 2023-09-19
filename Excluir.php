<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <title>Alterar</title>
    <style>
        button{
            margin-left: 50%;
            margin-right: 50%;
        }
        h1 {
            text-align: center;
        }
        p{
            text-align: center;
        }
        form {
            width: 360px;
            border: dotted 3px blue;
            margin: auto;
        }
        #botao {
            margin-left: 140px;
        }
    </style>
</head>
<body>
<h1>Formulário de Exclusão</h1>
<form action="Buscar.php" id="formulario" method="POST">
    <fieldset style="border:0;" name="Produto">
        <label>Nome:
            <input type="text" id="nome" name="nome" placeholder="Digite o nome do produto">
        </label><br>
        <label>Preço(em R$):
            <input type="text" name="preco" placeholder="Digite o preço do produto">
        </label><br>
        <label>Descrição:
            <input type="text" id="descricao" name="descricao" placeholder="Digite a descrição do produto">
        </label><br>
        <input id="botao" type="submit" value="Enviar">
    </fieldset>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $descricao = $_POST["descricao"];

    excluir($nome, $preco, $descricao);
}

function excluir($nome, $preco, $descricao) {
    $encontrado = false;
    $dados = [];
    $arq = fopen("produtos.csv","r");
    if ($arq !== FALSE) {
        while (($prod = fgetcsv($arq,200, ",")) !== FALSE) {
            if ($prod[0] == $nome && $prod[1] == $preco && $prod[2] == $descricao) {
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
?>
<br><br><br>
<button onclick="window.location.href='Incluir.php'">Voltar para Incluir</button>
<br><br>
<button onclick="window.location.href='Exibir.php'">Exibir</button>
<br><br>
<button onclick="window.location.href='Buscar.php'">Buscar</button>
<br><br>
<button onclick="window.location.href='Alterar.php'">Alterar</button>
</body>

</html>