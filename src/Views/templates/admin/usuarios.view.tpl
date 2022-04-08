<section class="container-fluid min-vh-100">

  <h3 class="my-4 text-center">Gestión de Usuarios</h3>
  
  <div class="d-flex-inline">
    <form method="POST" action="index.php?page=admin_usuarios">
      <div class="form-row">
        <div class="col-8">
          <input type="search" class="form-control" id="UsuarioBusqueda" name="UsuarioBusqueda" value="{{UsuarioBusqueda}}" placeholder="Ingrese su busqueda">
        </div>
        <div class="col-2">
          <button type="submit" class="btn btn-primary mb-2" id="btnBuscar" name="btnBuscar">Buscar</button>
        </div>
      </div>
    </form> 
  </div>

  <div class="table-responsive">
    <table class="table">
      <thead class="thead-light">
        <tr>
          <th class="text-center align-middle">Código</th>
          <th class="text-center align-middle">Correo</th>
          <th class="text-center align-middle">Nombre del usuario</th>
          <th class="text-center align-middle">Fecha de ingreso</th>
          <th class="text-center align-middle">Estado de la contraseña</th>
          <th class="text-center align-middle">Fecha de expiración de la contraseña</th>
          <th class="text-center align-middle">Estado del usuario</th>
          <th class="text-center align-middle">Fecha en que se cambio la contraseña</th>
          <th class="text-center align-middle">Tipo de usuario</th>
          <th class="text-center align-middle"><button type="button" class="btn btn-primary my-2" id="btnAdd">Nuevo</button></th>
        </tr>
      </thead>
      <tbody>
        {{foreach items}}
          <tr>
            <td class="text-center align-middle">{{UsuarioId}}</td>
            <td class="text-center align-middle">{{UsuarioEmail}}</td>
            <td class="text-center align-middle"><a href="index.php?page=admin_usuario&mode=DSP&UsuarioId={{UsuarioId}}">{{UsuarioNombre}}</a></td>
            <td class="text-center align-middle">{{UsuarioFching}}</td>
            <td class="text-center align-middle">{{UsuarioPswdEst}}</td>
            <td class="text-center align-middle">{{UsuarioPswdExp}}</td>
            <td class="text-center align-middle">{{UsuarioEst}}</td>
            <td class="text-center align-middle">{{UsuarioPswdChg}}</td>
            <td class="text-center align-middle">{{UsuarioTipo}}</td>
            <td class="text-center align-middle">
              <form action="index.php" method="get">
                  <input type="hidden" name="page" value="admin_usuario"/>
                  <input type="hidden" name="mode" value="UPD" />
                  <input type="hidden" name="UsuarioId" value={{UsuarioId}} />
                  <button type="submit" class="btn btn-primary my-1">Editar</button>
              </form>
              <form action="index.php" method="get">
                  <input type="hidden" name="page" value="admin_usuario"/>
                  <input type="hidden" name="mode" value="DEL" />
                  <input type="hidden" name="UsuarioId" value={{UsuarioId}} />
                  <button type="submit" class="btn btn-danger my-1">Eliminar</button>
              </form>
            </td>
          </tr>
          {{endfor items}}
      </tbody>
    </table>
  </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", function () {
     document.getElementById("btnAdd").addEventListener("click", function (e) {
       e.preventDefault();
       e.stopPropagation();
       window.location.assign("index.php?page=admin_usuario&mode=INS&UsuarioId=0");
     });
   });
</script>