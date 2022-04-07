<section class="container-fluid min-vh-100">

    <h3 class="my-4 text-center">Gestión de Funciones para Roles</h3>
    
    <div class="d-flex-inline">
      <form method="POST" action="index.php?page=admin_funcionesroles">
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
            <th class="text-center align-middle">Código Rol</th>
            <th class="text-center align-middle">Código Función</th>
            <th class="text-center align-middle">Estado</th>
            <th class="text-center align-middle">Fecha de expiración</th>
            <th class="text-center align-middle"><button type="button" class="btn btn-primary my-2" id="btnAdd">Nuevo</button></th>
          </tr>
        </thead>
        <tbody>
          {{foreach items}}
            <tr>
              <td class="text-center align-middle">{{RolId}}</td>
              <td class="text-center align-middle"><a href="index.php?page=admin_funcionrol&mode=DSP&RolId={{RolId}}&FuncionId={{FuncionId}}">{{FuncionId}}</a></td>
              <td class="text-center align-middle">{{FuncionRolEst}}</td>
              <td class="text-center align-middle">{{FuncionExp}}</td>
              <td class="text-center align-middle">
                <form action="index.php" method="get">
                    <input type="hidden" name="page" value="admin_funcionrol"/>
                    <input type="hidden" name="mode" value="UPD" />
                    <input type="hidden" name="RolId" value={{RolId}} />
                    <input type="hidden" name="FuncionId" value={{FuncionId}} />
                    <button type="submit" class="btn btn-primary my-1">Editar</button>
                </form>
                <form action="index.php" method="get">
                    <input type="hidden" name="page" value="admin_funcionrol"/>
                    <input type="hidden" name="mode" value="DEL" />
                    <input type="hidden" name="RolId" value={{RolId}} />
                    <input type="hidden" name="FuncionId" value={{FuncionId}} />
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
         window.location.assign("index.php?page=admin_funcionrol&mode=INS&RolId=0&FuncionId=0");
       });
     });
  </script>