<h1>{{modeDsc}}</h1>
<hr>

<section class="container-m">
    <form action="index.php?page=mnt.empleados.empleado&mode={{mode}}&id={{idEmpleado}}" method="post">

        {{ifnot isInsert}}
        <fieldset class="row flex-center">
            <label for="idEmpleado" class="col-5">Código</label>
            <input class="col-7" type="text" name="idEmpleado" value="{{idEmpleado}}" {{if isRead}} {{readonly}} {{endif isRead}}>
        </fieldset>
        {{endifnot isInsert}}

        <fieldset class="row flex-center">
            <label for="nombre" class="col-5">Nombre</label>
            <input class="col-7" type="text" name="nombre"  value="{{nombre}}" {{if isRead}} {{readonly}} {{endif isRead}}>
        </fieldset>

        <fieldset class="row flex-center">
            <label for="apellido" class="col-5">Apellido</label>
            <input class="col-7" type="text" name="apellido"  value="{{apellido}}" {{if isRead}} {{readonly}} {{endif isRead}}>
        </fieldset>

        <fieldset class="row flex-center">
            <label class="col-5" for="puestoId">Puesto</label>
            <select class="col-7" name="puestoId" id="puestoId">
                {{foreach puestosIdOptions}}
                <option value="{{value}}" {{selected}}>{{text}}</option>
                {{endfor puestosIdOptions}}
            </select>
        </fieldset>

        <fieldset class="row flex-center">
            <label for="telefono" class="col-5">Teléfono</label>
            <input class="col-7" type="text" name="telefono"  value="{{telefono}}" {{if isRead}} {{readonly}} {{endif isRead}}>
        </fieldset>

        <fieldset class="row flex-center">
            <label for="fechaNacimiento" class="col-5">Fecha de Nacimiento</label>
            <input class="col-7" type="date" name="fechaNacimiento" value="{{fechaNacimiento}}" {{if isRead}} {{readonly}} {{endif isRead}}>
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
            window.location.assign("index.php?page=mnt.empleados.empleadoss");
        })
    });
</script>