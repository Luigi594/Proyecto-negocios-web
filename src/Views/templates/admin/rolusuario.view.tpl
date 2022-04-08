<section class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card my-5 w-100">
      <div class="card-header">
        <h3 class="text-center">{{mode_dsc}}</h3>
      </div>
      <div class="card-body"> 
        <form class="form" method="post" action="index.php?page=admin_rolusuario&mode={{mode}}&UsuarioId={{UsuarioId}}&RolId={{RolId}}">
          
        {{if notDisplayIns}}
        <div class="form-group col-md-2">
            <label for="FuncionId">Código Usuario</label>
            <input type="hidden" class="form-control" id="UsuarioId" name="UsuarioId" value="{{UsuarioId}}"/>
            <input readonly type="text" class="form-control" name="UsuarioIdDummy" value="{{UsuarioId}}"/>
        </div>

        <div class="form-group col-md-4">
            <label for="RolId">Código Rol</label>
            <input type="hidden" class="form-control" id="RolId" name="RolId" value="{{RolId}}"/>
            <input readonly type="text" class="form-control" name="RolIdDummy" value="{{RolId}}"/>
        </div>
        {{endif notDisplayIns}}

        {{if onlyDisplayIns}}
        <div class="form-group col-md-8">
        <label for="UsuarioId2">Usuario</label>
        <br/>
        <select class="form-control" id="UsuarioId2" name="UsuarioId2" {{if readonly}}disabled{{endif readonly}}>
            {{foreach usuarios}}
            <option value="{{UsuarioId}}">{{UsuarioNombre}} | {{UsuarioEmail}} | {{UsuarioTipo}}</option>
            {{endfor usuarios}}
        </select>
        </div>
        {{endif onlyDisplayIns}}

        {{if onlyDisplayIns}}
        <div class="form-group col-md-4">
        <label for="Roles">Roles</label>
        <br/>
        <select class="form-control" id="RolId2" name="RolId2" {{if readonly}}disabled{{endif readonly}}>
            {{foreach roles}}
            <option value="{{RolId}}">{{RolDsc}}</option>
            {{endfor roles}}
        </select>
        </div>
        {{endif onlyDisplayIns}}

        {{if notDisplayIns}}
        <div class="form-group col-md-4">
        <label for="RolUsuarioEst">Estado del Rol para el Usuario</label>
        <br/>
        <select class="form-control" id="RolUsuarioEst" name="RolUsuarioEst" {{if readonly}}disabled{{endif readonly}}>
            <option value="ACT" {{RolUsuarioEst_ACT}}>Activo</option>
            <option value="INA" {{RolUsuarioEst_INA}}>Inactivo</option>
        </select>
        </div>
        {{endif notDisplayIns}}
    
        {{if allInfoDisplayed}}
        <div class="form-group col-md-4">
            <label for="UsuarioNombre">Nombre del Usuario</label>
            <br/>
            <input type="text" readonly class="form-control" id="UsuarioNombre" name="UsuarioNombre" value="{{UsuarioNombre}}" maxlength="128"/>
        </div>
        {{endif allInfoDisplayed}}

        {{if allInfoDisplayed}}
        <div class="form-group col-md-4">
            <label for="UsuarioEmail">Correo del Usuario</label>
            <br/>
            <input type="text" readonly class="form-control" id="UsuarioEmail" name="UsuarioEmail" value="{{UsuarioEmail}}" maxlength="128"/>
        </div>
        {{endif allInfoDisplayed}}

        {{if allInfoDisplayed}}
        <div class="form-group col-md-4">
            <label for="UsuarioTipo">Tipo de Usuario</label>
            <br/>
            <input type="text" readonly class="form-control" id="UsuarioTipo" name="UsuarioTipo" value="{{UsuarioTipo}}" maxlength="128"/>
        </div>
        {{endif allInfoDisplayed}}
      
        {{if allInfoDisplayed}}
        <div class="form-group col-md-4">
            <label for="RolUsuarioFch">Fecha de asignación</label>
            <br/>
            <input type="text" readonly class="form-control" id="RolUsuarioFch" name="RolUsuarioFch" value="{{RolUsuarioFch}}" maxlength="128"/>
        </div>
        {{endif allInfoDisplayed}}

        {{if notDisplayIns}}
        <div class="form-group col-md-4">
            <label for="RolUsuarioExp">Fecha de expiración</label>
            <input type="date" class="form-control" id="RolUsuarioExp" name="RolUsuarioExp" value="{{RolUsuarioExp}}" min="{{minimumDate}}" {{if readonly}}disabled{{endif readonly}}>
        </div>
        {{endif notDisplayIns}}

        {{if hasErrors}}
        <section>
            <ul>
            {{foreach aErrors}}
                <li class="text-danger my-2">{{this}}</li>
            {{endfor aErrors}}
            </ul>
        </section>
        {{endif hasErrors}}

        <button type="button" class="btn btn-warning mt-2 ml-3 mr-2" id="btnCancelar" name="btnCancelar">Cancelar</button>
        {{if showaction}}
        <button type="submit" class="btn btn-primary mt-2 mr-2" id="btnGuardar" name="btnGuardar">Guardar</button>
        {{endif showaction}}
        </form>
      </div>
    </div>
  </section>
  
  <script>
    document.addEventListener("DOMContentLoaded", function(){
        document.getElementById("btnCancelar").addEventListener("click", function(e){
          e.preventDefault();
          e.stopPropagation();
          window.location.assign("index.php?page=admin_rolesusuarios");
        });
    });
  </script>

    
  
  
