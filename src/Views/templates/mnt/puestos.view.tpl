<h1>Puestos</h1>
<hr>
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Descripcion</th>
                <th><button class="btn primary" id="btnNuevo">Nuevo</button></th>
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
                        <a href="index.php?page=mnt.puestos.puesto&mode=DEL&idPuesto={{idPuesto}}">Eliminar</a>
                    </td>
                </tr>
            {{endfor puestos}}
        </tbody>
    </table>
</section>

<script>
    document.addEventListener('DOMContentLoaded', (e) => {

        let btnNuevo = document.getElementById("btnNuevo");
        btnNuevo.addEventListener('click',(e) => {

            e.preventDefault();
            e.stopPropagation();
            window.location.assign("index.php?page=mnt.puestos.puesto&mode=INS&idPuesto=0")
        })
    });
</script>