<h1>{{modeDsc}}</h1>
<hr>

<section class="container-m">
    <form action="index.php?page=mnt.proveedores.proveedor&mode={{mode}}&id={{idProveedor}}" method="post">

        {{ifnot isInsert}}
        <fieldset class="row flex-center">
            <label for="idProveedor" class="col-5">Código</label>
            <input class="col-7" type="text" name="idProveedor" value="{{idProveedor}}" {{if isRead}} {{readonly}} {{endif isRead}}>
        </fieldset>
        {{endifnot isInsert}}

        <fieldset class="row flex-center">
            <label for="nombreProveedor" class="col-5">Nombre del Proveedor</label>
            <input class="col-7" type="text" name="nombreProveedor"  value="{{nombreProveedor}}" {{if isRead}} {{readonly}} {{endif isRead}}>
        </fieldset>

        <fieldset class="row flex-center">
            <label for="empresa" class="col-5">Empresa</label>
            <input class="col-7" type="text" name="empresa"  value="{{empresa}}" {{if isRead}} {{readonly}} {{endif isRead}}>
        </fieldset>

        <fieldset class="row flex-center">
            <label for="telefono" class="col-5">Teléfono</label>
            <input class="col-7" type="text" name="telefono"  value="{{telefono}}" {{if isRead}} {{readonly}} {{endif isRead}}>
        </fieldset>

        <fieldset class="row flex-center">
            <label for="direccion" class="col-5">Direccion</label>
            <input class="col-7" type="text" name="direccion"  value="{{direccion}}" {{if isRead}} {{readonly}} {{endif isRead}}>
        </fieldset>

        <fieldset class="row flex-center">
            <label for="correo" class="col-5">Correo</label>
            <input class="col-7" type="text" name="correo" value="{{correo}}" {{if isRead}} {{readonly}} {{endif isRead}}>
        </fieldset>

        <fieldset class="row flex-center">
            <label class="col-5" for="estado">Estado</label>
            <select class="col-7" name="estado" id="estado" {{if isRead}} {{readonly}} {{endif isRead}}>
                {{foreach estadoOpciones}}

                    <option value="{{value}}" {{selected}}>{{text}}</option>
                {{endfor estadoOpciones}}
            </select>
        </fieldset>

        <fieldset class="row flex-center">
            <button type="submit" name="btnConfirmar" class="btn primary">Confirmar</button>&nbsp;&nbsp;&nbsp;
            <button type="button" id="btnCancelar" class="btn danger">Cancelar</button>
        </fieldset>        
    </form>
</section>

<script>
    
    document.addEventListener("DOMContentLoaded", (e) => {

        let btnCancelar = document.getElementById("btnCancelar");
        btnCancelar.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            window.location.assign("index.php?page=mnt.proveedores.proveedores");
        })
    });
</script>