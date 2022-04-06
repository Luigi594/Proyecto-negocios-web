<h1>Ingredientes</h1>
<hr>
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Codigo Proveedor</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Estado</th>
                <th><button class="btn primary" id="btnNuevo">Nuevo</button></th>
            </tr>
        </thead>
        <tbody>
            {{foreach ingredientes}}
                <tr>
                    <td>{{idIngrediente}}</td>
                    <td>{{idProveedor}}</td>
                    <td>
                        <a href="index.php?page=mnt.ingredientes.ingrediente&mode=DSP&idIngrediente={{idIngrediente}}">{{nombre}}</a>
                    </td>
                    <td>{{descripcion}}</td>
                    <td>{{precio}}</td>
                    <td>{{estado}}</td>
                    <td>
                        <a href="index.php?page=mnt.ingredientes.ingrediente&mode=UPD&idIngrediente={{idIngrediente}}">Editar</a>
                        &nbsp; 
                        <a href="index.php?page=mnt.ingredientes.ingrediente&mode=DEL&idIngrediente={{idIngrediente}}">Eliminar</a>
                    </td>
                </tr>
            {{endfor ingredientes}}
        </tbody>
    </table>
</section>

<script>
    document.addEventListener('DOMContentLoaded', (e) => {

        let btnNuevo = document.getElementById("btnNuevo");
        btnNuevo.addEventListener('click',(e) => {

            e.preventDefault();
            e.stopPropagation();
            window.location.assign("index.php?page=mnt.ingredientes.ingrediente&mode=INS&idIngrediente=0")
        })
    });
</script>