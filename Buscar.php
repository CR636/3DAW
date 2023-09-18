<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <title>Buscar</title>
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
            width: 350px;
            border: dotted 3px blue;
            margin: auto;
        }
    </style>
</head>
<body>
<h1>Formulário de busca</h1>
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

    buscar($nome, $preco, $descricao);
}

function buscar($nome, $preco, $descricao) {
    $encontrado = false;
    $cont=0;
    $arq = fopen("produtos.csv","r");
    if ($arq !== FALSE) {
        while (($prod = fgetcsv($arq,200, ";")) !== FALSE) {
            if ($prod[0] == $nome || $prod[1] == $preco || $prod[2] == $descricao) {
                $encontrado = true;
                $cont++;
                echo "<br>";
                echo "<p>Nome:".$prod[0]."<br>Preço:".$prod[1]."<br>Descrição:".$prod[2]."</p>";
            }
        }
        fclose($arq);
    }

    echo "<br>";
    if ($encontrado) {
        if($cont>1){
            echo "<p>O produto foi encontrado ".$cont." vezes no arquivo.</p>";
        } else {
            echo "<p>O produto foi encontrado ".$cont." vez no arquivo.</p>";
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
<button onclick="window.location.href='Alterar.php'">Alterar</button>
<br><br>
<button onclick="window.location.href='Excluir.php'">Excluir</button>
</body>

</html>