<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/json; charset=utf-8');

include_once('conexion.php');
$results = array();
$json_array = [];

//ID DE LA TABLA POZO
$idPozo = $_POST['idPozo'];

//ID DE LA TABLA REGISTRO(psi), QUE TIENE COMO CLAVE FORANEA EL ID DE POZO
$idRegistro = $_POST['idRegistro'];

//Nombre del pozo en la tabla pozo
// $nombre = $_POST['NombreEdit'];

//PSI de la tabla psi, asociado con la id del pozo y su id de registro
$psi = $_POST['PSIEdit'];

//Fecha de la tabla psi, asociado con la id del pozo y su id de registro
$fecha = $_POST['FechaEdit'];

if(isset($_POST['idPozo']) && isset($_POST['idRegistro']) && isset($_POST['PSIEdit']) && isset($_POST['FechaEdit'])){

    if(!empty($_POST['idPozo']) && !empty($_POST['idRegistro']) && !empty($_POST['PSIEdit']) && !empty($_POST['FechaEdit'])){

        $query = "UPDATE psi SET PSI='$psi', Fecha='$fecha' WHERE idPozo='$idPozo' AND id='$idRegistro';";
        $rs = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if($rs){
            $json_array = array(
                "resp" => "success",
                "message" => "Datos Actualizados"
            );
            array_push($results, $json_array);

        }else{
            $json_array = array(
                "resp" => "error",
                "message" => "Datos no actualizados"
            );
            array_push($results, $json_array);
        }

    }else{
        $json_array = array(
            "resp" => "error",
            "message" => "Datos del Registro Vacios"
        );
        array_push($results, $json_array);
    }

}else{
    $json_array = array(
        "resp" => "error",
        "message" => "No Existe el envio de los datos del Registro"
    );
    array_push($results, $json_array);
};

echo "Estos son los datos mandados por Ajax: idPozo: " . $idPozo . "idRegistro: " . $idRegistro . "PSI: " . $psi . "Fecha: ". $fecha;

echo json_encode($results);
mysqli_close($conn);
?>