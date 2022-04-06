<h1>Proveedores</h1>
<hr>

<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>NombreProveedor</th>
                <th>Empresa</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Estado</th>
                <th>Acciones</th>
                <th><button class="btn primary" id="btnNuevo">Nuevo</button></th>
            </tr>
        </thead>
        <tbody class="bg-white">
            {{foreach proveedores}}
                <tr>
                    <td>{{nombreProveedor}}&nbsp; &nbsp;</td>
                    <td>{{empresa}}</td>
                    <td>{{direccion}}</td>
                    <td>{{telefono}}</td>
                    <td>{{correo}}</td>
                    <td>{{estado}}</td>
                    <td>
                        &nbsp; &nbsp; 
                        <a href="index.php?page=mnt.proveedores.proveedor&mode=UPD&idProveedor={{idProveedor}}">Editar</a>
                        &nbsp; &nbsp; 
                        <a href="index.php?page=mnt.proveedores.proveedor&mode=DEL&idProveedor={{idProveedor}}">Eliminar</a>
                    </td>
                </tr>
            {{endfor proveedores}}
        </tbody>
    </table>
</section>


<script>
    document.addEventListener('DOMContentLoaded', (e) => {

        let btnNuevo = document.getElementById("btnNuevo");
        btnNuevo.addEventListener('click',(e) => {

            e.preventDefault();
            e.stopPropagation();
            window.location.assign("index.php?page=mnt.proveedores.proveedor&mode=INS&idProveedor=0")
        })
    });
</script>