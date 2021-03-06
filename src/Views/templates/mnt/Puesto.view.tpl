<h1>{{modeDsc}}</h1>
<hr>

<section class="container-m">
    <form action="index.php?page=mnt.puestos.puesto&mode={{mode}}&idPuesto={{idPuesto}}" method="post">
        <input type="hidden" name="crsxToken" value="{{crsxToken}}">
        {{ifnot isInsert}}
        <!-- Id Puesto -->
        <fieldset class="row flex-center">
            <label for="idPuesto" class="col-5">Id</label>
            <input class="col-7" type="text" name="idPuesto" id="idPuesto" value="{{idPuesto}}" placeholder="" >
        </fieldset>
        {{endifnot isInsert}}

        <!-- descripcion de la Puesto  -->
        <fieldset class="row flex-center">
            <label for="descripcion" class="col-5">Descripcion</label>
            <input class="col-7" type="text" name="descripcion" id="descripcion" value="{{descripcion}}" placeholder="" >
        </fieldset>
        
        <fieldset class="row flex-center">

            <div class="col-xs-12 mt-5">
                <div class="center-block">
                    <button type="submit" name="btnConfirmar" class="btn primary">Confirmar</button>&nbsp;&nbsp;&nbsp;
                    <button type="button" id="btnCancelar" class="btn danger">Cancelar</button>
                </div> 
            </div>
        </fieldset>
    </form>
    <script>
        document.addEventListener("DOMContentLoaded", (e) => {
            document.getElementById("btnCancelar").addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation(); 
                location.assign("index.php?page=mnt.puestos.puestos");
            })
        })
    </script>
</section>