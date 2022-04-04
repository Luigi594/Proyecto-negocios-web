<h1>Productos</h1>
<hr>
<table>
    <thead>
        <tr>
            <td>Codigo</td>
            <td>Codigo Receta</td>
            <td>Nombre</td>
            <td>Descripcion</td>
            <td>Precio</td>
            <td>Estado</td>
            <td><a href="index.php?page=mnt.productos.producto&mode=INS&idProducto=0">Nuevo</a></td>
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