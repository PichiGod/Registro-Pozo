<?php
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
// header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/json; charset=utf-8');

include_once('conexion.php');
$results = array();
$json_array = [];

if (isset($_POST['Nombre']) && isset($_POST['PSI']) && isset($_POST['Fecha'])) {

    if (!empty($_POST['Nombre']) && !empty($_POST['PSI']) && !empty($_POST['Fecha'])) {

        $nombre = $_POST['Nombre'];
        $psi = $_POST['PSI'];
        $fecha = $_POST['Fecha'];

        $query = "INSERT INTO pozo(nombre) VALUES ('$nombre')";
        $rs = mysqli_query($conn, $query) or die(mysqli_error($conn));


        if ($rs == true) {



            $getIDPozo = "SELECT id FROM pozo WHERE Nombre = '$nombre'";
            $rsIDPozo = mysqli_query($conn, $getIDPozo) or die(mysqli_error($conn));
            $count = mysqli_num_rows($rsIDPozo);

            if ($count > 0) {

                $row = mysqli_fetch_row($rsIDPozo);
                $queryPSI = "INSERT INTO psi(idPozo, PSI, Fecha) Values ('$row[0]','$psi', '$fecha')";
                $rsPSI = mysqli_query($conn, $queryPSI) or die(mysqli_error($conn));
                if ($rsPSI = true) {
                    $json_array = array(
                        "resp" => "success",
                        "message" => "Pozo Registrado Exitosamente"
                    );
                    array_push($results, $json_array);
                } else {
                    $json_array = array(
                        "resp" => "error",
                        "message" => "Pozo NO Registrado Correctamente. Error en Registar la actividad"
                    );
                    array_push($results, $json_array);
                }

            } else {
                $json_array = array(
                    "resp" => "error",
                    "message" => "No se encontro el pozo seleccionado"
                );
                array_push($results, $json_array);
            }


        } else {
            $json_array = array(
                "resp" => "error",
                "message" => "usuarios NO registrados"
            );
            array_push($results, $json_array);
        }

    } else {
        $json_array = array(
            "resp" => "error",
            "message" => "Datos de Usuarios Vacios"
        );
        array_push($results, $json_array);
    }

} else {
    $json_array = array(
        "resp" => "error",
        "message" => "No Existe el envio de los datos de usuarios"
    );
    array_push($results, $json_array);
}

echo json_encode($results);
mysqli_close($conn);
?>