<h1>Recetas</h1>
<hr>
<table>
    <thead>
        <tr>
            <td>Id</td>
            <td>Descripcion</td>
            <td>Estado</td>
            <td><a href="index.php?page=mnt.recetas.receta&mode=INS&idRecetas=0">Nuevo</a></td>
        </tr>
    </thead>
    <tbody>
        {{foreach recetas}}
            <tr>
                <td>{{idRecetas}}</td>
                <td>
                    <a href="index.php?page=mnt.recetas.receta&mode=DSP&idRecetas={{idRecetas}}">{{descripcion}}</a>
                </td>
                <td>{{estado}}</td>
                <td>
                    <a href="index.php?page=mnt.recetas.receta&mode=UPD&idRecetas={{idRecetas}}">Editar</a>
                    &nbsp; 
                    <a href="index.php?page=mnt.recetas.receta&mode=DEL&idRecetas={{idRecetas}}">Eliminar</a>
                </td>
            </tr>
        {{endfor recetas}}
    </tbody>
</table>