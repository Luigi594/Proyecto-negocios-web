<h1>Empleados</h1>
<hr>

<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Puesto</th>
                <th>Telefono</th>
                <th>Fecha de Nacimiento</th>
                <th>Estado</th>
                <th><button class="btn primary" id="btnNuevo">Nuevo</button></th>
            </tr>
        </thead>
        <tbody class="bg-white">
            {{foreach Empleados}}
                <tr>                
                    <td>{{nombre}}</td>
                    <td>{{apellido}}</td>
                    <td>{{puestoId}}</td>
                    <td>{{telefono}}</td>
                    <td>{{fechaNacimiento}}</td>
                    <td>{{estado}}</td>
                    <td>
                        &nbsp; &nbsp; 
                        <a href="index.php?page=mnt.empleados.empleado&mode=UPD&idEmpleado={{idEmpleado}}">Editar</a>
                        &nbsp; &nbsp; 
                        <a href="index.php?page=mnt.empleados.empleado&mode=DEL&idEmpleado={{idEmpleado}}">Eliminar</a>
                    </td>
                </tr>
            {{endfor Empleados}}
        </tbody>
    </table>
</section>


<script>
    document.addEventListener('DOMContentLoaded', (e) => {

        let btnNuevo = document.getElementById("btnNuevo");
        btnNuevo.addEventListener('click',(e) => {

            e.preventDefault();
            e.stopPropagation();
            window.location.assign("index.php?page=mnt.empleados.empleado&mode=INS&idEmpleado=0")
        })
    });
</script>