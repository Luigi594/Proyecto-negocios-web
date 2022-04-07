<h1>Catalogo de Productos</h1>
<hr>
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>Id</td>
                <th>Nombre</td>
                <th>Descripcion</td>
                <th>Precio</td>
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
