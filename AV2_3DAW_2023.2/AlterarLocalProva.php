<?php
$idC = $_POST["idC"];
$localProva = $_POST["localProva"];
$servidor = "localhost";
$username = "root";
$senha = "";
$database = "av2_3daw_2023_2";
if ($idC == "" || $localProva == ""){
    $retorno=json_encode("Preencha todos os campos!");
    echo $retorno;
    exit;
}
$conn = new mysqli($servidor,$username,$senha,$database);
if ($conn->connect_error) {
    die("Conexao falhou, avise o administrador do sistema");
}
$comandoSQL = "UPDATE `Candidatos` SET localProva='$localProva' = WHERE 'idC' = '$idC'";
$resultado = $conn->query($comandoSQL);

if ($resultado=true){
    $retorno=json_encode("Local de Prova Alterado com Sucesso");
} else {
    $retorno=json_encode("Usuário não encontrado! ou deu problma na consulta!");
}

echo $retorno;
?>