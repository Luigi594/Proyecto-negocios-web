<h1>Ingredientes</h1>
<hr>
<table>
    <thead>
        <tr>
            <td>Codigo</td>
            <td>Codigo Proveedor</td>
            <td>Nombre</td>
            <td>Descripcion</td>
            <td>Precio</td>
            <td>Estado</td>
            <td><a href="index.php?page=mnt.ingredientes.ingrediente&mode=INS&idIngrediente=0">Nuevo</a></td>
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