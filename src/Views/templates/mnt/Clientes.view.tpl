<h1>Clientes</h1>
<hr>
<table>
    <thead>
        <tr>
            <td>Nombre</td>
            <td>Apellido</td>
            <td>Telefono</td>
            <td>RTN</td>
            <td>Fecha de Nacimiento</td>
            <td>Estado</td>
            <td><a href="index.php?page=mnt.clientes.cliente&mode=INS&idCliente=0">Nuevo</a></td>
        </tr>
    </thead>
    <tbody>
        {{foreach clientes}}
            <tr>
                <td>
                    <a href="index.php?page=mnt.clientes.cliente&mode=INS&idCliente={{idCliente}}">{{nombre}}</a>
                </td>
                <td>
                    <a href="index.php?page=mnt.clientes.cliente&mode=INS&idCliente={{idCliente}}">{{apellido}}</a>
                </td>
                <td>{{telefono}}</td>
                <td>{{rtn}}</td>
                <td>{{fechaNacimiento}}</td>
                <td>{{estado}}</td>
                <td>
                    <a href="index.php?page=mnt.clientes.cliente&mode=UPD&idCliente={{idCliente}}">Editar</a>
                    &nbsp; 
                    <a href="index.php?page=mnt.clientes.cliente&mode=DEL&idCliente={{idCliente}}">Eliminar</a>
                </td>
            </tr>
        {{endfor clientes}}
    </tbody>
</table>