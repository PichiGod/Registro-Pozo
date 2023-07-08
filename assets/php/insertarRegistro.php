<?php
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
// header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/json; charset=utf-8');

include_once('conexion.php');
$results = array();
$json_array = [];

if (isset($_POST['idAdd']) && isset($_POST['PSIAdd']) && isset($_POST['FechaAdd'])) {

    if (!empty($_POST['idAdd']) && !empty($_POST['PSIAdd']) && !empty($_POST['FechaAdd'])) {

        $idPozo = $_POST['idAdd'];
        $psi = $_POST['PSIAdd'];
        $fecha = $_POST['FechaAdd'];

        $query = "INSERT INTO psi(idPozo ,PSI, Fecha) VALUES ('$idPozo', '$psi', '$fecha');";
        $rs = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if ($rs == true) {
            $json_array = array(
                "resp" => "success",
                "message" => "Actividad registrada"
            );
            array_push($results, $json_array);

        } else {
            $json_array = array(
                "resp" => "error",
                "message" => "Actividad NO registrada"
            );
            array_push($results, $json_array);
        }

    } else {
        $json_array = array(
            "resp" => "error",
            "message" => "Datos del Registro Vacios"
        );
        array_push($results, $json_array);
    }

} else {
    $json_array = array(
        "resp" => "error",
        "message" => "No Existe el envio de los datos del Registro"
    );
    array_push($results, $json_array);
}

echo json_encode($results);
mysqli_close($conn);

?>