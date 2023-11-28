<?php
$idF = $_POST["idF"];
$nomeF = $_POST["nomeF"];
$cpfF = $_POST["cpfF"];
$salaP = $_POST["salaP"];
if ($idF == "" || $nomeF == "" || $cpfF == "" || $salaP == ""){
    $retorno=json_encode("Preencha todos os campos!");
    echo $retorno;
    exit;
}
$servidor = "localhost";
$username = "root";
$senha = "";
$database = "av2_3daw_2023_2";
$conn = new mysqli($servidor,$username,$senha,$database);
if ($conn->connect_error) {
    die("Conexao falhou, avise o administrador do sistema");
}
$comandoSQL = "INSERT INTO `Fiscal`(`idF`, `nomeF`, `cpfF`, `salaP`) VALUES ('$idF','$nomeF','$cpfF','$salaP')";
$resultado = $conn->query($comandoSQL);
if ($resultado=true){
    $retorno=json_encode("Fiscal Incluido com Sucesso");
} else {
    $retorno=json_encode("Problema na Inclusão do Fiscal");
}
echo $retorno;
?>
