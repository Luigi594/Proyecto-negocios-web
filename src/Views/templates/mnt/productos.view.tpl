<h1>Productos</h1>
<hr>
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Codigo Receta</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Estado</th>
                <th><button class="btn primary" id="btnNuevo">Nuevo</button></th>
            </tr>
        </thead>
        <tbody>
            {{foreach productos}}
                <tr>
                    <td>{{idProducto}}</td>
                    <td>{{idReceta}}</td>
                    <td>
                        <a href="index.php?page=mnt.productos.producto&mode=DSP&idProducto={{idProducto}}">{{nombre}}</a>
                    </td>
                    <td>{{descripcion}}</td>
                    <td>{{precio}}</td>
                    <td>{{estado}}</td>
                    <td>
                        <a href="index.php?page=mnt.productos.producto&mode=UPD&idProducto={{idProducto}}">Editar</a>
                        &nbsp; 
                        <a href="index.php?page=mnt.productos.producto&mode=DEL&idProducto={{idProducto}}">Eliminar</a>
                    </td>
                </tr>
            {{endfor productos}}
        </tbody>
    </table>
</section>

<script>
    document.addEventListener('DOMContentLoaded', (e) => {

        let btnNuevo = document.getElementById("btnNuevo");
        btnNuevo.addEventListener('click',(e) => {

            e.preventDefault();
            e.stopPropagation();
            window.location.assign("index.php?page=mnt.productos.producto&mode=INS&idProducto=0")
        })
    });
</script>