<h1>Recetas</h1>
<hr>
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Descripcion</th>
                <th>Estado</th>
                <th><button class="btn primary" id="btnNuevo">Nuevo</button></th>
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
</section>

<script>
    document.addEventListener('DOMContentLoaded', (e) => {

        let btnNuevo = document.getElementById("btnNuevo");
        btnNuevo.addEventListener('click',(e) => {

            e.preventDefault();
            e.stopPropagation();
            window.location.assign("index.php?page=mnt.recetas.receta&mode=INS&idRecetas=0")
        })
    });
</script>