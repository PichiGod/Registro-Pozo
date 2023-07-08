<?php
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
// header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/json; charset=utf-8');

include_once('conexion.php');

$results = array();
$json_array = [];
$PSI_results = [];

$query = "SELECT pozo.id, psi.id AS idRegistro, pozo.Nombre, psi.PSI, psi.Fecha FROM pozo INNER JOIN psi on pozo.id = psi.idPozo;";
$rs    = mysqli_query($conn, $query) or die(mysqli_error($conn));
$count = mysqli_num_rows($rs);

if($count> 0){
    $json_array = array(
        "resp" => "success",
        "message" => "hay pozos registrados"
    );
    array_push($results, $json_array);

    while($row = mysqli_fetch_array($rs)){
        $json_array = array(
            "id" => $row['id'],
            "idPozo" => $row['idRegistro'],
            "Nombre" => $row['Nombre'],
            "PSI" => $row['PSI'],
            "Fecha" => $row['Fecha']
        );

        array_push($results, $json_array);
    };
}else{
    $json_array = array(
        "resp" => "error",
        "message" => "No hay pozos registrados"
    );
    array_push($results, $json_array);
}

echo json_encode($results);
mysqli_close($conn);
?>