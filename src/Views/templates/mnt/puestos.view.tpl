<h1>Puestos</h1>
<hr>
<table>
    <thead>
        <tr>
            <td>Id</td>
            <td>Descripcion</td>
            <td><a href="index.php?page=mnt.puestos.puesto&mode=INS&idPuesto=0">Nuevo</a></td>
        </tr>
    </thead>
    <tbody>
        {{foreach puestos}}
            <tr>
                <td>{{idPuesto}}</td>
                <td>
                    <a href="index.php?page=mnt.puestos.puesto&mode=DSP&idPuesto={{idPuesto}}">{{descripcion}}</a>
                </td>
                <td>
                    <a href="index.php?page=mnt.puestos.puesto&mode=UPD&idPuesto={{idPuesto}}">Editar</a>
                    &nbsp; 
                    <a href="index.php?page=mnt.puestos.puesto&mode=DEL&idPuestos={{idPuesto}}">Eliminar</a>
                </td>
            </tr>
        {{endfor puestos}}
    </tbody>
</table>