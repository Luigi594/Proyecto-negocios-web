<h1>Catalogo de Productos</h1>
<hr>
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            {{foreach productos}}
                <tr>
                    <td>{{idProducto}}</td>
                    <td>{{nombre}}</td>
                    <td>{{descripcion}}</td>
                    <td>{{precio}}</td>
                    <td>
                        <a href="index.php?page=mnt.catalogos.catalogo&mode=DSP&idProducto={{idProducto}}">Agregar</a>
                    </td>
                </tr>
            {{endfor productos}}
        </tbody>
    </table>
</section>
