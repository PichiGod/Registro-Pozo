<?php

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Programa - Web</title>

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
    <h1 class="mt-3 ms-5">Programa para registrar pozos y mostrar graficos</h1>
    <h2 class="ps-4 ms-5 mb-4">- Hecho por José Duarte</h2>

    <div class="container">
        <h2>Pozos registrados </h2>
        <div class="form-group mx-2">
            <label for="registro">Filtar por:</label>
            <select id="registro" class="form-control" name="filtrar" onchange="registro()">
                <option value="IdDes" selected>ID -Descendiente</option>
                <option value="IdAsc">ID -Ascendiente</option>
                <option value='FechaDes'>Fecha -Descendiente</option>
                <option value='FechaAsc'>Fecha -Ascendiente</option>
            </select>
        </div>
        <table id="tableselect" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre del pozo</th>
                    <th scope="col">PSI </th>
                    <th scope="col">Fecha </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>

                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>

                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>@twitter</td>
                    <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="container">

        <h2>Registrar pozo</h2>
        <form>
            <div class="mb-3">
                <label for="idNombre" class="form-label">Nombre del pozo</label>
                <input type="text" class="form-control" name="Nombre" id="idNombre" placeholder="Nombre">
            </div>
            <div class="mb-3">
                <label for="idPSI" class="form-label">PSI</label>
                <input type="number" class="form-control" name="PSI" id="idPSI" placeholder="PSI">
            </div>
            <div class="mb-3">
                <label for="idFecha" class="form-label">Fecha de registro</label>
                <input type="datetime-local" class="form-control" name="Fecha" id="idFecha">
            </div>
            <div class="mb-3">
                <button type="button" class="btn btn-primary" onclick="return insertar()">Registrar</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>

        <div id="resp"></div>

    </div>

    <div class="container" id="AddRegistro">

        <h2>Añadir registro a pozo existente</h2>
        <form>
            <div class="form-group mx-2">
                <label for="Add">Filtar por:</label>
                <select id="idAdd" class="form-control" name="Add">
                    <option value="" selected>Seleccionar Pozo</option>
                    <option value="IdAsc">Pozo de prueba Xdee</option>
                    <option value='FechaDes'>Pozo de prueba Xdee</option>
                    <option value='FechaAsc'>Pozo de prueba Xdee</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="idPSIAdd" class="form-label">PSI</label>
                <input type="text" class="form-control" id="idPSIAdd" placeholder="PSI">
            </div>
            <div class="mb-3">
                <label for="idFechaAdd" class="form-label">Fecha y hora de registro</label>
                <input type="datetime-local" class="form-control" id="idFechaAdd" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <button type="button" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
        <div id="resp"></div>


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

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="assets/js/index.js">

    </script>

    <script>
        seleccion();
        function registro() {
            let option = document.getElementById('registro').value;
            if (option == 'IdDes') {
                console.log('hola, id des');
                selectIDDesc(0);
            }
            else if (option == 'IdAsc') {
                console.log('Hola, id Asc');
                selectIDAsc(0);
            }
            else if (option == 'FechaDes') {
                console.log('Hola, Fecha Des');
                sortTableByDateAsc(3);
            }
            else if (option == 'FechaAsc') {
                console.log('Hola, Fecha Asc');
                sortTableByDateDesc(3);
            }
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>