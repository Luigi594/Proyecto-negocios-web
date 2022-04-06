<h1>Clientes</h1>
<hr>

<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Telefono</th>
                <th>RTN</th>
                <th>Fecha de Nacimiento</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            {{foreach clientes}}
                <tr>
                    <td>{{nombre}}</td>
                    <td>{{apellido}}</td>
                    <td>{{telefono}}</td>
                    <td>
                        <a href="index.php?page=mnt.clientes.cliente&mode=DSP&idCliente={{idCliente}}">{{rtn}}</a>
                    </td>
                    <td>{{fechaNacimiento}}</td>
                    <td>{{estado}}</td>
                    <td>
                        <button class="btn primary" id="btnNuevo">Nuevo</button>
                        &nbsp; &nbsp; 
                        <a href="index.php?page=mnt.clientes.cliente&mode=UPD&idCliente={{idCliente}}">Editar</a>
                        &nbsp; &nbsp; 
                        <a href="index.php?page=mnt.clientes.cliente&mode=DEL&idCliente={{idCliente}}">Eliminar</a>
                    </td>
                </tr>
            {{endfor clientes}}
        </tbody>
    </table>
</section>


<script>
    document.addEventListener('DOMContentLoaded', (e) => {

        let btnNuevo = document.getElementById("btnNuevo");
        btnNuevo.addEventListener('click',(e) => {

            e.preventDefault();
            e.stopPropagation();
            window.location.assign("index.php?page=mnt.clientes.cliente&mode=INS&idCliente=0")
        })
    });
</script>