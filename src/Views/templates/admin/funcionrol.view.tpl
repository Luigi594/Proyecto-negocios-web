<section class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card my-5 w-100">
      <div class="card-header">
        <h3 class="text-center">{{mode_dsc}}</h3>
      </div>
      <div class="card-body"> 
        <form class="form" method="post" action="index.php?page=admin_funcionrol&mode={{mode}}&RolId={{RolId}}&FuncionId={{FuncionId}}">
          
          {{if notDisplayIns}}
          <div class="form-group col-md-2">
            <label for="RolId">Código Rol</label>
            <input type="hidden" class="form-control" id="RolId" name="RolId" value="{{RolId}}"/>
            <input readonly type="text" class="form-control" name="RolIdDummy" value="{{RolId}}"/>
          </div>

          <div class="form-group col-md-4">
            <label for="FuncionId">Código Función</label>
            <input type="hidden" class="form-control" id="FuncionId" name="FuncionId" value="{{FuncionId}}"/>
            <input readonly type="text" class="form-control" name="FuncionIdDummy" value="{{FuncionId}}"/>
          </div>
          {{endif notDisplayIns}}

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

          {{if onlyDisplayIns}}
          <div class="form-group col-md-4">
            <label for="FuncionId2">Función</label>
            <br/>
            <select class="form-control" id="FuncionId2" name="FuncionId2" {{if readonly}}disabled{{endif readonly}}>
               {{foreach funciones}}
                <option value="{{FuncionId}}">{{FuncionDsc}}</option>
               {{endfor funciones}}
            </select>
          </div>
          {{endif onlyDisplayIns}}

          {{if notDisplayIns}}
          <div class="form-group col-md-4">
            <label for="FuncionRolEst">Estado</label>
            <br/>
            <select class="form-control" id="FuncionRolEst" name="FuncionRolEst" {{if readonly}}disabled{{endif readonly}}>
                <option value="ACT" {{FuncionRolEst_ACT}}>Activo</option>
                <option value="INA" {{FuncionRolEst_INA}}>Inactivo</option>
            </select>
          </div>
          {{endif notDisplayIns}}

          {{if notDisplayIns}}
          <div class="form-group col-md-4">
            <label for="FuncionExp">Fecha de expiración</label>
            <input type="date" class="form-control" id="FuncionExp" name="FuncionExp" value="{{FuncionExp}}" min="{{minimumDate}}" {{if readonly}}disabled{{endif readonly}}>
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
          window.location.assign("index.php?page=admin_funcionesroles");
        });
    });
  </script>

    
  
  
