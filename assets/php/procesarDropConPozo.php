<?php
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Content-Type: application/json; charset=utf-8');

include_once('conexion.php');
$results = array();
$json_array = [];

//ID DE LA TABLA POZO
$idPozo = $_GET['idPozo'];

//ID DE LA TABLA REGISTRO(psi), QUE TIENE COMO CLAVE FORANEA EL ID DE POZO
$idRegistro = $_GET['idRegistro'];

if(isset($_GET['idPozo']) && isset($_GET['idRegistro'])){

    if(!empty($_GET['idPozo']) && !empty($_GET['idRegistro'])){

        $query1 = "DELETE FROM psi WHERE id = '$idRegistro' AND idPozo = '$idPozo'";
        $rs1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));

        if($rs1 = true){
            $query2 = "DELETE FROM pozo WHERE id = '$idPozo'";
            $rs2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));

            if($rs2 = true){
                $json_array = array(
                    'resp' => "success",
                    'message' => "Datos Eliminados"
                );
                array_push($results, $json_array);
            }else{
                $json_array = array(
                    'resp' => "error",
                    'message' => "Datos Del Pozo No Eliminados, Se Eliminaron Los Registros"
                );
                array_push($results, $json_array);
    
            }

        }else{
            $json_array = array(
                'resp' => "error",
                'message' => "Datos No Eliminados"
            );
            array_push($results, $json_array);

        }
    }

}

//echo "Los datos a eliminar son:  idPozo: ". $idPozo . "   idRegistro: ". $idRegistro;

echo json_encode($results);
mysqli_close($conn);
?>