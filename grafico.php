<?php
//promt
//Make a page that displays a line graph using JavaScript, HTML

include_once('assets/php/conexion.php');

//ID DE LA TABLA POZO
$idPozo = $_GET['id'];

//Nombre del Pozo 
$NombrePozo = $_GET['Pozo'];

$psi = [];
$fecha = [];

$labels = array();
$data = array();

$query = "SELECT PSI, Fecha FROM psi WHERE idPozo = '$idPozo' ORDER BY Fecha ASC;";

$rs = mysqli_query($conn, $query) or die(mysqli_error($conn));
$count = mysqli_num_rows($rs);

if ($count > 0) {
    while ($row = mysqli_fetch_array($rs)) {
        $fecha = array($row["Fecha"]);
        $psi = array($row["PSI"]);

        array_push($labels, $fecha);
        array_push($data, $psi);
    }
    ;
} else {
    echo "Error en la matrix";
}

// echo $count;
// json_encode($data);
// json_encode($labels);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Grafico de Pozo</title>

    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- JQUEY -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <h1 class="mt-3 ms-5">Programa para registrar pozos y mostrar graficos</h1>
        <h2 class="ps-4 ms-5 mb-4">- Hecho por José Duarte</h2>

        <h4 class="mt-5">Grafico de: <?php echo $NombrePozo?></h4>

        <a href="index.php" class="btn btn-primary" type="button">Volver al principio</a>
    </div>

    <div class="container">

        <canvas id="myChart"></canvas>

    </div>

    <footer class="footer text-center mt-5">
        <div class="container-fluid">
            <div class="row">
                <!-- Footer Social Icons-->
                <div class="col text-white">
                    <h4 class="text-uppercase my-4">Mi red social</h4>
                    <a class="btn btn-outline-light btn-social mx-1" href="https://github.com/PichiGod"><i
                            class="fab fa-fw fa-github"></i></a>
                </div>
            </div>
            <!-- Copyright Section-->
            <div class="copyright col py-4 text-center text-white">
                <div class="container"><small>Copyright &copy; José Duarte 2023</small></div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>


        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels) ?>,
                datasets: [{
                    label: 'PSI',
                    data: <?php echo json_encode($data) ?>,
                    backgroundColor: 'rgba(0, 0, 255, 0.2)',
                    borderColor: 'rgb(0, 0, 255)',
                    borderWidth: 1
                }]
            },
            options: {
                title: {
                    text: 'Temperature over the year'
                },
                scales: {
                    yAxes: {
                        ticks: {
                            beginAtZero: true
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>