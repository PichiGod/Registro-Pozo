<?php

include_once('assets/php/conexion.php');

//ID DE LA TABLA POZO
$idPozo = $_GET['id'];

//ID DE LA TABLA REGISTRO, QUE TIENE COMO CLAVE FORANEA EL ID DE POZO
$idRegistro = $_GET['idRegistro'];

$query = "SELECT pozo.id, pozo.Nombre, psi.PSI, psi.Fecha FROM pozo INNER JOIN psi WHERE pozo.id = '$idPozo' AND psi.id = '$idRegistro'";
$rs = mysqli_query($conn, $query) or die(mysqli_error($conn));
$count = mysqli_num_rows($rs);

if ($count > 0) {
    $row = mysqli_fetch_row($rs);
} else {
    $row = 'Error en la matrix';
    echo $row;
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- JQUEY -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
</head>

<body>

    <h1 class='mt-3 ms-3'>Eliminar registro</h1>

    <div class='container'>
        <form>
            <div class="my-3">
                <label for="idNombreEdit" class="form-label">Nombre del pozo</label>
                <input type="text" name="NombreEdit" class="form-control" id="idNombreEdit" value="<?php echo $row[1] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="idPSIEdit" class="form-label">PSI</label>
                <input type="number" name="PSIEdit" class="form-control" id="idPSIEdit" value="<?php echo $row[2] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="idFechaEdit" class="form-label">Fecha y hora de registro</label>
                <input type="datetime-local" name="FechaEdit" class="form-control" id="idFechaEdit" value="<?php echo $row[3] ?>" disabled>
            </div>
            <div class="mb-3">
                <button type="button" class="btn btn-primary" onclick="return eliminarSinPozo()">Eliminar Registro</button>
                <button type="button" class="btn btn-secondary" onclick="return eliminarConPozo()">Eliminar Todos los Registros y su Pozo correspondiente</button>
                <!-- <input class="form-control" type="submit" name=""> -->
            </div>

            <input type="hidden" name="idPozo" id="idPozo" value="<?php echo $idPozo ?>" name="idPozo">
            <input type="hidden" name="idRegistro" id="idRegistro" value="<?php echo $idRegistro ?>" name="idRegistro">
        </form>
        <div id="resp"></div>
    </div>

    <div class="container">
        <a href="index.php" class="btn btn-primary" type="button">Volver al principio</a>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="assets/js/index.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
</body>

</html>