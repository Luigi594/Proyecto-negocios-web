<h1>{{modeDsc}}</h1>
<hr>

<section class="container-m">
    <form action="index.php?page=mnt.ingredientes.ingrediente&mode={{mode}}&idIngrediente={{idIngrediente}}" method="post">
        <input type="hidden" name="crsxToken" value="{{crsxToken}}">
        {{ifnot isInsert}}
        <!-- Id ingrediente -->
        <fieldset class="row flex-center">
            <label for="idIngrediente" class="col-5">Id</label>
            <input class="col-7" type="text" name="idIngrediente" id="idIngrediente" value="{{idIngrediente}}" placeholder="" >
        </fieldset>
        {{endifnot isInsert}}

         <!-- Id de proveedor de Ingrediente  -->
        <fieldset class="row flex-center">
            <label class="col-5" for="idProveedor">Proveedor</label>
            <select class="col-7" name="idProveedor" id="idProveedor">
                {{foreach proveedoresOptions}}
                <option value="{{value}}" {{selected}}>{{text}}</option>
                {{endfor proveedoresOptions}}
            </select>
        </fieldset>
        
        <!-- Nombre de Ingrediente  -->
        <fieldset class="row flex-center">
            <label for="nombre" class="col-5">Nombre</label>
            <input class="col-7" type="text" name="nombre" id="nombre" value="{{nombre}}" placeholder="" >
        </fieldset>

        <!-- descripcion de Ingrediente  -->
        <fieldset class="row flex-center">
            <label for="descripcion" class="col-5">Descripcion</label>
            <input class="col-7" type="text" name="descripcion" id="descripcion" value="{{descripcion}}" placeholder="" >
        </fieldset>

        <!-- Precio de Ingrediente  -->
        <fieldset class="row flex-center">
            <label for="precio" class="col-5">Precio</label>
            <input class="col-7" type="text" name="precio" id="precio" value="{{precio}}" placeholder="" >
        </fieldset>

        <!-- Estado de Ingrediente  -->
        <fieldset class="row flex-center">
            <label class="col-5" for="estado">Estado</label>
            <select class="col-7" name="estado" id="estado">
                {{foreach estadoOptions}}
                <option value="{{value}}" {{selected}}>{{text}}</option>
                {{endfor estadoOptions}}
            </select>
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
                location.assign("index.php?page=mnt.ingredientes.ingredientes");
            })
        })
    </script>
</section>