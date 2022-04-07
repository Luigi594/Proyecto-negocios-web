<h1>{{modeDsc}}</h1>
<hr>

<section class="container-m">
    <form action="index.php?page=mnt.catalogos.catalogo&mode={{mode}}&idProducto={{idProducto}}" method="post">
        <input type="hidden" name="crsxToken" value="{{crsxToken}}">
        {{if isViewMode}}
        <!-- Id producto -->
        <fieldset class="row flex-center">
            <label for="idProducto" class="col-5">Id</label>
            <input class="col-7" type="text" name="idProducto" id="idProducto" value="{{idProducto}}" placeholder="" >
        </fieldset>
        {{endif isViewMode}}
        
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
                location.assign("index.php?page=mnt.catalogos.catalogos");
            })
        })
    </script>
</section>