function seleccion() {
  $.ajax({
    type: "POST",
    url: "assets/php/seleccion.php",
    dataType: "json",
    beforeSend: function () {
      console.log("Esperando los datos del BACK");
    },
    success: function (resp) {
      console.log(resp);
      let tableselect = `<table>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre del pozo</th>
                            <th scope="col">PSI</th>
                            <th scope="col">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>`;
      for (i = 1; i <= resp.length - 1; i++) {
        tableselect += `<tr>
                                   <th scope="row">${resp[i].id}</th>
                                   <td>${resp[i].Nombre}</td>
                                   <td>${resp[i].PSI}</td>
                                   <td>${resp[i].Fecha}</td>
                                   <td><a href="modificar.php?id=${resp[i].id}&idRegistro=${resp[i].idPozo}">Modificar</a></td>
                                   <td><a href="eliminar.php?id=${resp[i].id}&idRegistro=${resp[i].idPozo}">Eliminar</a></td>
                                   <td><a href="grafico.php?id=${resp[i].id}&Pozo=${resp[i].Nombre}">Grafico</a></td>
                               </tr>`;
      }

      tableselect += `</tbody>
                </table>`;

      let add = `<div>
      <h2>Añadir registro a pozo existente</h2>
      <form>
          <div class="form-group mb-3">
              <label for="Add">Registrar Actividad a Pozo:</label>
              <select id="idAdd" class="form-control" name="Add">
                  <option value="" selected>Seleccionar Pozo</option>`;

      for (i = 1; i <= resp.length - 1; i++) {
        add += `<option value="${resp[i].id}">${resp[i].id} -${resp[i].Nombre}</option>`;
      }

      add += `</select>
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
              <button type="button" class="btn btn-primary" onclick="return insertarRegistro()">Registrar</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
          </div>
      </form>
      <div id="resp"></div>
      </div>`;
      console.log(tableselect);
      $("#tableselect").html(tableselect);
      $("#AddRegistro").html(add);
    },
    fail: function (jqXHR, textStatus, errorThown) {
      console.log(textStatus, errorThown);
    },
    error: function (jqXHR, textStatus, errorThown) {
      console.log(textStatus, errorThown);
    },
  });
}

function selectIDDesc(colNum) {
  let tbody = tableselect.querySelector("tbody");

  let rowsArray = Array.from(tbody.rows);

  // compare(a, b) compares two rows, need for sorting
  let compare;

  compare = function (rowA, rowB) {
    return rowA.cells[colNum].innerHTML - rowB.cells[colNum].innerHTML;
  };

  rowsArray.sort(compare);

  tbody.append(...rowsArray);

  console.log("Filtrado Desc");
}

function selectIDAsc(colNum) {
  let tbody = tableselect.querySelector("tbody");

  let rowsArray = Array.from(tbody.rows);

  // compare(a, b) compares two rows, need for sorting
  let compare;

  compare = function (rowA, rowB) {
    return rowB.cells[colNum].innerHTML - rowA.cells[colNum].innerHTML;
  };

  rowsArray.sort(compare);

  tbody.append(...rowsArray);

  console.log("Filtrado Asc");
}

function sortTableByDateAsc(column) {
  // Get all the rows in the table.
  var tbody = tableselect.querySelector("tbody");

  let rowsArray = Array.from(tbody.rows);

  // Sort the rows by the date in the specified column.
  let compare;

  compare = function (row1, row2) {
    var date1 = row1.cells[column].innerHTML;
    var date2 = row2.cells[column].innerHTML;
    // Convert the dates to Date objects.
    var date1Obj = new Date(date1);
    var date2Obj = new Date(date2);
    // Compare the dates and return the appropriate result.
    if (date1Obj < date2Obj) {
      return -1;
    } else if (date1Obj > date2Obj) {
      return 1;
    } else {
      return 0;
    }
  };

  rowsArray.sort(compare);

  tbody.append(...rowsArray);
}

function sortTableByDateDesc(column) {
  // Get all the rows in the table.
  var tbody = tableselect.querySelector("tbody");

  let rowsArray = Array.from(tbody.rows);
  // Sort the rows by the date in the specified column.

  let compare;
  compare = function (row1, row2) {
    var date1 = row1.cells[column].innerHTML;
    var date2 = row2.cells[column].innerHTML;
    // Convert the dates to Date objects.
    var date1Obj = new Date(date1);
    var date2Obj = new Date(date2);
    // Compare the dates and return the appropriate result.
    if (date1Obj > date2Obj) {
      return -1;
    } else if (date1Obj < date2Obj) {
      return 1;
    } else {
      return 0;
    }
  };

  rowsArray.sort(compare);

  tbody.append(...rowsArray);
}

function insertar() {
  let params = {
    Nombre: document.getElementById("idNombre").value,
    PSI: document.getElementById("idPSI").value,
    Fecha: document.getElementById("idFecha").value,
  };

  console.log(params);
  $.ajax({
    type: "POST",
    url: "assets/php/insertar.php",
    dataType: "json",
    data: params,
    beforeSend: function () {
      console.log("Insertando los datos del BACK");
    },
    success: function (resp) {
      console.log(resp);
      if (resp[0].resp == "success") {
        document.getElementById(
          "resp"
        ).innerHTML = `<div class="alert alert-success" role="alert">
                ${resp[0].message}
              </div>`;
      }
      if (resp[0].resp == "error") {
        document.getElementById(
          "resp"
        ).innerHTML = `<div class="alert alert-danger" role="alert">
                ${resp[0].message}
              </div>`;
      }
      seleccion();
    },
    fail: function (jqXHR, textStatus, errorThown) {
      console.log(textStatus, errorThown);
    },
    error: function (jqXHR, textStatus, errorThown) {
      console.log(textStatus, errorThown);
    },
  });
}

function insertarRegistro() {
  let params = {
    idAdd: document.getElementById("idAdd").value,
    PSIAdd: document.getElementById("idPSIAdd").value,
    FechaAdd: document.getElementById("idFechaAdd").value
  };

  console.log(params);
  $.ajax({
    type: "POST",
    url: "assets/php/insertarRegistro.php",
    dataType: "json",
    data: params,
    beforeSend: function () {
      console.log("Insertando los datos del BACK");
    },
    success: function (resp) {
      console.log(resp);
      if (resp[0].resp == "success") {
        document.getElementById(
          "resp"
        ).innerHTML = `<div class="alert alert-success" role="alert">
                ${resp[0].message}
              </div>`;
      }
      if (resp[0].resp == "error") {
        document.getElementById(
          "resp"
        ).innerHTML = `<div class="alert alert-danger" role="alert">
                ${resp[0].message}
              </div>`;
      }
      seleccion();
    },
    fail: function (jqXHR, textStatus, errorThown) {
      console.log(textStatus, errorThown);
    },
    error: function (jqXHR, textStatus, errorThown) {
      console.log(textStatus, errorThown);
    },
  });
}

function modificar() {
  let params = {
    idPozo: document.getElementById("idPozo").value,
    idRegistro: document.getElementById("idRegistro").value,
    NombreEdit: document.getElementById("idNombreEdit").value,
    PSIEdit: document.getElementById("idPSIEdit").value,
    FechaEdit: document.getElementById("idFechaEdit").value,
  };

  console.log(params);
  $.ajax({
    type: "POST",
    url: "assets/php/procesarModificacion.php",
    dataType: "json",
    data: params,
    beforeSend: function () {
      console.log("Actualizando los datos del BACK");
    },
    success: function (resp) {
      console.log(resp);
      if (resp[0].resp == "success") {
        document.getElementById(
          "resp"
        ).innerHTML = `<div class="alert alert-success" role="alert">${resp[0].message}</div>`;
      }
      if (resp[0].resp == "error") {
        document.getElementById(
          "resp"
        ).innerHTML = `<div class="alert alert-danger" role="alert">
                ${resp[0].message}
              </div>`;
      }
    },
    fail: function (jqXHR, textStatus, errorThown) {
      console.log(textStatus, errorThown);
    },
    error: function (jqXHR, textStatus, errorThown) {
      console.log(textStatus, errorThown);
    },
  });
}

function eliminarSinPozo() {
  let params = {
    idPozo: document.getElementById("idPozo").value,
    idRegistro: document.getElementById("idRegistro").value,
  };

  console.log(params);
  $.ajax({
    type: "GET",
    url: "assets/php/procesarDropSinPozo.php",
    dataType: "json",
    data: params,
    beforeSend: function () {
      console.log("Eliminando los datos del BACK");
    },
    success: function (resp) {
      console.log(resp);
      if (resp[0].resp == "success") {
        document.getElementById(
          "resp"
        ).innerHTML = `<div class="alert alert-success" role="alert">
                ${resp[0].message}
              </div>`;
      }
      if (resp[0].resp == "error") {
        document.getElementById(
          "resp"
        ).innerHTML = `<div class="alert alert-danger" role="alert">
                ${resp[0].message}
              </div>`;
      }
      seleccion();
    },
    fail: function (jqXHR, textStatus, errorThown) {
      console.log(textStatus, errorThown);
    },
    error: function (jqXHR, textStatus, errorThown) {
      console.log(textStatus, errorThown);
    },
  });
}

function eliminarConPozo() {
  let params = {
    idPozo: document.getElementById("idPozo").value,
    idRegistro: document.getElementById("idRegistro").value,
  };

  console.log(params);
  $.ajax({
    type: "GET",
    url: "assets/php/procesarDropConPozo.php",
    dataType: "json",
    data: params,
    beforeSend: function () {
      console.log("Eliminando los datos del BACK");
    },
    success: function (resp) {
      console.log(resp);
      if (resp[0].resp == "success") {
        document.getElementById(
          "resp"
        ).innerHTML = `<div class="alert alert-success" role="alert">
                ${resp[0].message}
              </div>`;
      }
      if (resp[0].resp == "error") {
        document.getElementById(
          "resp"
        ).innerHTML = `<div class="alert alert-danger" role="alert">
                ${resp[0].message}
              </div>`;
      }
      seleccion();
    },
    fail: function (jqXHR, textStatus, errorThown) {
      console.log(textStatus, errorThown);
    },
    error: function (jqXHR, textStatus, errorThown) {
      console.log(textStatus, errorThown);
    },
  });
}
