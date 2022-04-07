<h1>{{modeDsc}}</h1>
<hr>

<section class="container-m">
    <form action="index.php?page=mnt.carritos.carrito&mode={{mode}}&id={{id}}" method="post">
        <input type="hidden" name="crsxToken" value="{{crsxToken}}">
        {{if isViewMode}}

        <fieldset class="row flex-center">
            <label for="id" class="col-5">Id</label>
            <input class="col-7" type="text" name="id" id="id" value="{{id}}"{{if isRead}} {{readonly}} {{endif isRead}}>
        </fieldset>
        {{endif isViewMode}}
        

        <fieldset class="row flex-center">
            <label for="clienteId" class="col-5">Cliente Id</label>
            <input class="col-7" type="text" name="clienteId" id="clienteId" value="{{clienteId}}" {{if isRead}} {{readonly}} {{endif isRead}} >
        </fieldset>

       
        <fieldset class="row flex-center">
            <label for="productoId" class="col-5">Producto Id</label>
            <input class="col-7" type="text" name="productoId" id="productoId" value="{{productoId}}" {{if isRead}} {{readonly}} {{endif isRead}} >
        </fieldset>

       
        <fieldset class="row flex-center">
            <label for="cantidad" class="col-5">Cantidad</label>
            <input class="col-7" type="text" name="cantidad" id="cantidad" value="{{cantidad}}" {{if isRead}} {{readonly}} {{endif isRead}} >
        </fieldset>

        <fieldset class="row flex-center">
            <label for="precio" class="col-5">Precio</label>
            <input class="col-7" type="text" name="precio" id="precio" value="{{precio}}" {{if isRead}} {{readonly}} {{endif isRead}} >
        </fieldset>

         <fieldset class="row flex-center">
            <label for="fechahora" class="col-5">FechaHora</label>
            <input class="col-7" type="text" name="fechahora" id="fechahora" value="{{fechahora}}" {{if isRead}} {{readonly}} {{endif isRead}} >
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
                location.assign("index.php?page=mnt.carritos.carritos");
            })
        })
    </script>
</section>