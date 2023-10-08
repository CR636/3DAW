<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Incluir</title>
    <style>
        a{
            margin: 45%;
            font-size:30px;
        }
        form {
            width: 270px;
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
        #submit {
            margin-left: 35%;
        }
    </style>
</head>
<body>
<?php
$idProdutos = [];
$i=0;
$arq = fopen("produtos.csv", "r");
$prod = fgetcsv($arq, 200, ",");
while ($prod = fgetcsv($arq, 200, ",")) {
    $idProdutos [$i]= $prod[0];
    $i++;
}
fclose($arq);
?>

<h1>Formulário de inclusão</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit='location.reload()' id="formulario" method="POST" >
    <fieldset style="border:0;" name="Produto">
        <input type='hidden' name='id' value='<?php echo $idProdutos[$i-1]+1;?>'>
        <label>ID do Produto:(Valor auto preenchido)<br>
        <input type='text' name='idm' value='<?php echo $idProdutos[$i-1]+1;?>'disabled>
        </label><br><br>
        <label>Nome do Produto:<br>
        <input type='text' name='nome' placeholder="Digite o nome do produto" required>
        </label><br><br>
        <label>Valor do produto:<br>
        R$<input type='text' name='valor' placeholder="Digite Valor do Produto">
        </label><br><br>
        <input id="submit" type='submit' value='Adicionar'>
    </fieldset>
    </form>
    <br><br>
<a href='Exibir.php'>Exibir</a>
<br><br>
<a href='Buscar.php'>Buscar</a>
<br><br>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $preco = $_POST["valor"];


    $arquivo = fopen("produtos.csv", "a") or die("deu erro");

    $linhaID = $id.",";
    $linhaNome = $nome.",";
    $linhaPreco = $preco."\n";

    fwrite($arquivo, $linhaID);
    fwrite($arquivo, $linhaNome);
    fwrite($arquivo, $linhaPreco);
    fclose($arquivo);
    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
}
?>
</body>
</html>

