<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Incluir</title>
    <style>
        form {
            width: 350px;
            border: dotted 3px blue;
            margin: auto;
        }
        h1 {
            text-align: center;
        }
        button{
            margin-left: 49%;
            margin-right: 49%;
        }
    </style>
</head>
<body>
<h1>Formulário</h1>
<form action="Incluir.php" id="formulario" method="POST">
    <fieldset style="border:0;" name="Produto">
        <label>Nome*:
            <input type="text" id="nome" name="nome" placeholder="Digite o nome do produto" required>
        </label><br>
        <label>Preço*(em R$):
            <input type="text" name="preco" placeholder="Digite o preço do produto" required>
        </label><br>
        <label>Descrição*:
            <input type="text" id="descricao" name="descricao" placeholder="Digite a descrição do produto" required>
        </label><br>
        <input id="botao" type="submit" value="Enviar">
    </fieldset>
    </form>
    <br><br>
<button onclick="window.location.href='Exibir.php'">Exibir</button>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $descricao = $_POST["descricao"];


    $arquivo = fopen("produtos.csv", "a") or die("deu erro");


    $linhaNome = $nome.";";
    $linhaPreco = $preco.";";
    $linhaDescricao = $descricao."\n";


    fwrite($arquivo, $linhaNome);
    fwrite($arquivo, $linhaPreco);
    fwrite($arquivo, $linhaDescricao);
    fclose($arquivo);
    echo "Está Feito!";
}
?>
</body>
</html>

