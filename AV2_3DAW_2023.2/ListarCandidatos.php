<?php
$salaP = $_POST["salaP"];
$servidor = "localhost";
$username = "root";
$senha = "";
$database = "av2_3daw_2023_2";
if ($salaP == ""){
    $retorno=json_encode("Preencha todos os campos!");
    echo $retorno;
    exit;
}
$conn = new mysqli($servidor,$username,$senha,$database);
if ($conn->connect_error) {
    die("Conexao falhou, avise o administrador do sistema");
}
$comandoSQL = "SELECT * from 'Candidatos' WHERE 'sala' = '$salaP'";
$resultado = $conn->query($comandoSQL);

$arrCandidatos[] = array();
$i = 0;
While ($linha = $resultado->fetch_assoc()){
    $arrCandidatos[$i] = $linha;
    $i++;
}
if ($resultado=true){
    $retorno=json_encode($arrCandidatos);
} else {
    $retorno=json_encode("Sala não encontrada! ou deu problma na consulta!");
}

echo $retorno;
?>