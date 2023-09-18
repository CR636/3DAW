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
<h1>Formulário de Alteração</h1>
<form action="Alterar.php" id="formulario" method="POST">
    <fieldset style="border:0;" name="Produto">
        <label>Nome Antigo:
            <input type="text" id="nome" name="nome" placeholder="Digite o nome do produto">
        </label><br>
        <label>Nome Novo:
            <input type="text" id="nomeAlt" name="nomeAlt" placeholder="Digite o nome do produto">
        </label><br>
        <label>Preço Antigo(em R$):
            <input type="text" id="preco" name="preco" placeholder="Digite o preço do produto">
        </label><br>
        <label>Preço Novo(em R$):
            <input type="text" id="precoAlt" name="precoAlt" placeholder="Digite o preço do produto">
        </label><br>
        <label>Descrição Antiga:
            <input type="text" id="descricao" name="descricao" placeholder="Digite a descrição do produto">
        </label><br>
        <label>Descrição Nova:
            <input type="text" id="descricaoAlt" name="descricaoAlt" placeholder="Digite a descrição do produto">
        </label><br><br>
        <input id="botao" type="submit" value="Enviar">
    </fieldset>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $descricao = $_POST["descricao"];
    $nomeAlt = $_POST["nomeAlt"];
    $precoAlt = $_POST["precoAlt"];
    $descricaoAlt = $_POST["descricaoAlt"];

    alterar($nome, $preco, $descricao,$nomeAlt ,$precoAlt ,$descricaoAlt);
}

function alterar($nome, $preco, $descricao,$nomeAlt ,$precoAlt ,$descricaoAlt) {
    $encontrado = false;
    $dados = [];
    $arq = fopen("produtos.csv","r");
    if ($arq !== FALSE) {
        while (($prod = fgetcsv($arq,200, ";")) !== FALSE) {
            if ($prod[0] == $nome && $prod[1] == $preco && $prod[2] == $descricao) {
                $encontrado = true;
                $prod[0]=$nomeAlt;
                $prod[1]=$precoAlt;
                $prod[2]=$descricaoAlt;
            }
            $dados[] = $prod;
        }
        fclose($arq);
    }

    echo "<br>";
    if ($encontrado) {
        if(($arq = fopen("produtos.csv","w"))!== FALSE) {
            foreach ($dados as $linha){
                fputcsv($arq,$linha);
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
<button onclick="window.location.href='Incluir.php'">Voltar para Incluir</button>
<br><br>
<button onclick="window.location.href='Exibir.php'">Exibir</button>
<br><br>
<button onclick="window.location.href='Buscar.php'">Buscar</button>
<br><br>
<button onclick="window.location.href='Excluir.php'">Excluir</button>
</body>

</html>