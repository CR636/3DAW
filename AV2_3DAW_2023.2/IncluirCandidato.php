<?php
$idC = $_POST["idC"];
$nomeC = $_POST["nomeC"];
$cpfC = $_POST["cpfC"];
$rgC = $_POST["rgC"];
$emailC = $_POST["emailC"];
$cargoP = $_POST["cargoP"];
$salaP = $_POST["salaP"];
if ($idC == "" || $nomeC == "" || $cpfC == "" || $rgC == "" || $emailC == "" || $cargoP == "" || $salaP == ""){
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
$comandoSQLlimitecand = "SELECT * from `Candidatos` WHERE `salap` = '$salaP'";
$teste = $conn->query($comandoSQLlimitecand);
if ($teste->num_rows >= 50){
    $retorno=json_encode("Sala Cheia!");
    echo $retorno;
    exit;
}
$comandoSQL = "INSERT INTO `Candidatos`(`idC`, `nomeC`, `cpfC`, `rgC`, `emailC`, `cargoP`, `salaP`) VALUES ('$idC','$nomeC','$cpfC','$rgC','$emailC','$cargoP','$salaP')";
$resultado = $conn->query($comandoSQL);
if ($resultado=true){
    $retorno=json_encode("Candidato Incluido com Sucesso");
} else {
    $retorno=json_encode("Problema na Inclusão do Candidato");
}
echo $retorno;
?>
