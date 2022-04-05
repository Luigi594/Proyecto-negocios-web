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
            <td><a>Nuevo</a></td>
        </tr>
    </thead>
    <tbody>
        {{foreach clientes}}
            <tr>
                <td>
                    <a>{{nombre}}</a>
                </td>
                <td>{{apellido}}</td>
                <td>{{telefono}}</td>
                <td>{{rtn}}</td>
                <td>{{fechaNacimiento}}</td>
                <td>{{estado}}</td>
                <td>
                    <a>Editar</a>
                    &nbsp; 
                    <a>Eliminar</a>
                </td>
            </tr>
        {{endfor clientes}}
    </tbody>
</table>