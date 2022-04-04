<h1>{{modeDsc}}</h1>
<hr>

<section class="container-m">
    <form action="index.php?page=mnt.productos.producto&mode={{mode}}&idProducto={{idProducto}}" method="post">
        <input type="hidden" name="crsxToken" value="{{crsxToken}}">
        {{ifnot isInsert}}
        <!-- Id producto -->
        <fieldset class="row flex-center">
            <label for="idProducto" class="col-5">Id</label>
            <input class="col-7" type="text" name="idProducto" id="idProducto" value="{{idProducto}}" placeholder="" >
        </fieldset>
        {{endifnot isInsert}}

         <!-- Id de receta de Producto  -->
        <fieldset class="row flex-center">
            <label class="col-5" for="idReceta">Receta</label>
            <select class="col-7" name="idReceta" id="idReceta">
                {{foreach recetasOptions}}
                <option value="{{value}}" {{selected}}>{{text}}</option>
                {{endfor recetasOptions}}
            </select>
        </fieldset>
        
        <!-- Nombre de Producto  -->
        <fieldset class="row flex-center">
            <label for="nombre" class="col-5">Nombre</label>
            <input class="col-7" type="text" name="nombre" id="nombre" value="{{nombre}}" placeholder="" >
        </fieldset>

        <!-- descripcion de Producto  -->
        <fieldset class="row flex-center">
            <label for="descripcion" class="col-5">Descripcion</label>
            <input class="col-7" type="text" name="descripcion" id="descripcion" value="{{descripcion}}" placeholder="" >
        </fieldset>

        <!-- Precio de Producto  -->
        <fieldset class="row flex-center">
            <label for="precio" class="col-5">Precio</label>
            <input class="col-7" type="text" name="precio" id="precio" value="{{precio}}" placeholder="" >
        </fieldset>

        <!-- Estado de Producto  -->
        <fieldset class="row flex-center">
            <label class="col-5" for="estado">Estado</label>
            <select class="col-7" name="estado" id="estado">
                {{foreach estadoOptions}}
                <option value="{{value}}" {{selected}}>{{text}}</option>
                {{endfor estadoOptions}}
            </select>
        </fieldset>
        <fieldset class="row flex-center">
            <button type="submit" name="btnConfirmar" class="btn primary">Confirmar</button>&nbsp;&nbsp;&nbsp;
            <button type="submit" id="btnCancelar" class="btn danger">Cancelar</button>
        </fieldset>        
    </form>
    <script>
        document.addEventListener("DOMContentLoaded", (e) => {
            document.getElementById("btnCancelar").addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation(); 
                location.assign("index.php?page=mnt.productos.productos");
            })
        })
    </script>
</section>